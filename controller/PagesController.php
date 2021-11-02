<?php 
    require_once __DIR__ . '/Controller.php';
    require_once __DIR__ . '/../dao/ProductDAO.php';
    require_once __DIR__ . '/../dao/FormDAO.php';
    require_once __DIR__ . '/../dao/AuthenticationDAO.php';
    require_once __DIR__ . '/../dao/LogDAO.php';

    class PagesController extends Controller {

        function __construct() {
            $this->productDAO = new ProductDAO();
            $this->formDAO = new FormDAO();
            $this->authenticationDAO = new authenticationDAO();
            $this->logDAO = new LogDAO();
        }

        public function index(){
            $_SESSION['itemsToAdd'] = null;
            $_SESSION['results'] = null;
            $_SESSION['category'] = null;
        }

        public function search(){
            $_SESSION['results'] = null;
        }

        public function advancedSearch(){
            $_SESSION["searchCategory"] = 'Alle';
            if(!empty($_POST['category'])){
                if($_POST['category'] !== 'Alle'){
                    $_SESSION["searchCategory"] = $_POST['category'];
                }
            }
            $this->set('searchCategory', $_SESSION['searchCategory']);

            //input fields
            $periodes = $this->formDAO->getPeriode();
            $artiesten = $this->formDAO->getArtiesten();
            $staten = $this->formDAO->getStaat();
            $materialen = $this->formDAO->getMateriaal();
            $signeren = $this->formDAO->getGesigneerd();
            $uitgevers = $this->formDAO->getUitgever();
            $kaften = $this->formDAO->getKaft();
            $landen = $this->formDAO->getLanden();
            $talen = $this->formDAO->getTaal();
            $statussen = $this->formDAO->getStatus();
            $tentoonstellingen = $this->formDAO->getTentoonstelling();
            $typeStrip = $this->formDAO->getTypeStrip();
            $typeBoek = $this->formDAO->getTypeBoek();
            $typeObjectBeeld = $this->formDAO->getTypeObjectBeeld();
            $typePlaat = $this->formDAO->getTypePlaat();
            $zalen = $this->formDAO->getZaal();
            $auteursrechten = $this->formDAO->getAuteursrecht();
            $this->set('auteursrechten', $auteursrechten);
            $this->set('zalen', $zalen);
            $this->set('typePlaat', $typePlaat);
            $this->set('periodes', $periodes);
            $this->set('artiesten', $artiesten);
            $this->set('typeStrip', $typeStrip);
            $this->set('typeBoek', $typeBoek);
            $this->set('typeStrip', $typeStrip);
            $this->set('staten', $staten);
            $this->set('materialen', $materialen);
            $this->set('signeren', $signeren);
            $this->set('uitgevers', $uitgevers);
            $this->set('kaften', $kaften);
            $this->set('landen', $landen);
            $this->set('talen', $talen);
            $this->set('statussen', $statussen);
            $this->set('tentoonstellingen', $tentoonstellingen);

        }

        public function results(){
            if(!empty($_POST['activity'])){
                $_SESSION['activity'] = $_POST['activity'];
            }

            if(!empty($_POST['actiony'])){
                if($_POST['actiony'] === "submit"){
                    $filename = $_FILES['images']['name'][0];
                    $filePath = './images/'. $filename;
                    if($filePath === $_POST['oldPhoto'] || empty($filename)){
                        $filePath = $_POST['oldPhoto'];
                    } else {
                        if(file_exists($filePath)){
                            $_SESSION['error'] = "deze image bestaat al";
                            header('index.php?page=results');
                        } else {
                            move_uploaded_file($_FILES['images']['tmp_name'][0], $filePath);
                        }
                    }

                    if($_POST['category'] === "Strips"){
                            $this->productDAO->updateStrip($_POST, $filePath);
                            $this->logDAO->newAction($_SESSION['currentUser']['id'],'update_strip' . $_POST['itemId'], date('Y-m-d H:i:s')); 
                        } 
                        if($_POST['category'] === "Platen"){
                            $this->productDAO->updatePlaat($_POST,$filePath);
                            $this->logDAO->newAction($_SESSION['currentUser']['id'],'update_plaat' . $_POST['itemId'], date('Y-m-d H:i:s')); 
                        }
                        if($_POST['category'] === "Objecten"){
                            $this->productDAO->updateObject($_POST, $filePath);
                            $this->logDAO->newAction($_SESSION['currentUser']['id'],'update_object' . $_POST['itemId'], date('Y-m-d H:i:s')); 
                        }
                        if($_POST['category'] === "Boeken"){
                            $this->productDAO->updateBoek($_POST, $filePath);
                            $this->logDAO->newAction($_SESSION['currentUser']['id'],'update_boek' . $_POST['itemId'], date('Y-m-d H:i:s')); 
                        }
                        if($_POST['category'] === "Beelden"){
                            $this->productDAO->updateBeeld($_POST, $filePath);
                            $this->logDAO->newAction($_SESSION['currentUser']['id'],'update_beeld' . $_POST['itemId'], date('Y-m-d H:i:s')); 
                        }
                        $_SESSION['succes'] = "Item succesvol upgedate";
                    } 
            }
            
            if(!empty($_POST['action'])){
                if($_POST['action'] === 'Zoeken'){
                    if(!empty($_POST['search'])){
                        $_SESSION['action'] = $_POST['action'];
                        $items = $this->productDAO->simpleSearch($_POST['search']);   
                    }
                }
            }

             //Delete
             if(!empty($_POST['deleteAction'])){
                if($_POST['deleteAction'] === 'delete'){
                    $itemId = $_POST['itemId'];
                    $catId = substr($itemId, 0, 2);
                    if(!empty($catId)){
                        if($catId === '01'){
                            $this->productDAO->deleteStrip($_POST['itemId']);
                            $this->logDAO->newAction($_SESSION['currentUser']['id'],'delete_strip' . $_POST['itemId'], date('Y-m-d H:i:s')); 
                        }
                        if($catId === '02'){
                            $this->productDAO->deletePlaat($_POST['itemId']);
                            $this->logDAO->newAction($_SESSION['currentUser']['id'],'delete_plaat' . $_POST['itemId'], date('Y-m-d H:i:s')); 

                        }
                        if($catId === '03'){
                            $this->productDAO->deleteObject($_POST['itemId']);
                            $this->logDAO->newAction($_SESSION['currentUser']['id'],'delete_object' . $_POST['itemId'], date('Y-m-d H:i:s')); 

                        }
                        if($catId === '04'){
                            $this->productDAO->deleteBoek($_POST['itemId']);
                            $this->logDAO->newAction($_SESSION['currentUser']['id'],'delete_boek' . $_POST['itemId'], date('Y-m-d H:i:s')); 

                        }
                        if($catId === '05'){
                            $this->productDAO->deleteBeeld($_POST['itemId']);
                            $this->logDAO->newAction($_SESSION['currentUser']['id'],'delete_beeld' . $_POST['itemId'], date('Y-m-d H:i:s')); 
                        }
                        $key = $_POST['key'];
                        unset($_SESSION['results'][$key]);
                        $_SESSION['succes'] = "Item is succesvol verwijderd";    
                    }
                }
                if($_POST['deleteAction'] === "multipleDelete"){
                    if(!empty($_SESSION['deleteItems'])){
                        foreach($_SESSION['deleteItems'] as $item){
                            $itemId = $item['itemId'];
                            $catId = substr($itemId, 0, 2);
                            if(!empty($catId)){
                                if($catId === '01'){
                                    $this->productDAO->deleteStrip($itemId);
                                    $this->logDAO->newAction($_SESSION['currentUser']['id'],'delete_strip' . $itemId, date('Y-m-d H:i:s')); 
                                }
                                if($catId === '02'){
                                    $this->productDAO->deletePlaat($itemId);
                                    $this->logDAO->newAction($_SESSION['currentUser']['id'],'delete_plaat' . $itemId, date('Y-m-d H:i:s')); 
        
                                }
                                if($catId === '03'){
                                    $this->productDAO->deleteObject($itemId);
                                    $this->logDAO->newAction($_SESSION['currentUser']['id'],'delete_object' . $itemId, date('Y-m-d H:i:s')); 
        
                                }
                                if($catId === '04'){
                                    $this->productDAO->deleteBoek($itemId);
                                    $this->logDAO->newAction($_SESSION['currentUser']['id'],'delete_boek' . $itemId, date('Y-m-d H:i:s')); 
        
                                }
                                if($catId === '05'){
                                    $this->productDAO->deleteBeeld($itemId);
                                    $this->logDAO->newAction($_SESSION['currentUser']['id'],'delete_beeld' . $itemId, date('Y-m-d H:i:s')); 
                                }
                                $key = $item['key'];
                                unset($_SESSION['results'][$key]);
                            }
                        }
                        $_SESSION['succes'] = "Item is succesvol verwijderd";  
                    }
                }
            } 


            //Fiche View and controls


            if(!empty($_GET['view'])){
                if($_GET['view'] === 'fiche'){
                    if(!empty($_GET['id'])){
                        $itemId = $_GET['id'];
                        $catNumber = substr($itemId , 0, 2);
                        if($catNumber === '01'){
                            $_SESSION['ficheItem'] = $this->productDAO->getStripByItemiD($itemId);
                        }
                        if($catNumber === '02'){
                            $_SESSION['ficheItem'] = $this->productDAO->getPlaatByItemiD($itemId);
                            
                        }
                        if($catNumber === '03'){
                            $_SESSION['ficheItem'] = $this->productDAO->getObjectByItemiD($itemId);
                            
                        }
                        if($catNumber === '04'){
                            $_SESSION['ficheItem'] = $this->productDAO->getBoekByItemiD($itemId);
                        }
                        if($catNumber === '05'){
                            $_SESSION['ficheItem'] = $this->productDAO->getBeeldByItemiD($itemId);
                        }
                    }

                    if(!empty($_POST['ficheAction'])){

                        if($_POST['ficheAction'] === 'next'){
                            if($_GET['key'] !== array_key_last($_SESSION['results'])){
                                $all = count($_SESSION['results']);
                                $previousKey = array_search($_SESSION['ficheItem'], $_SESSION['results'], true);
                                $newKey = $previousKey + 1;
                                if(array_key_exists($newKey, $_SESSION['results'])){
                                    $id = $_SESSION['results'][$newKey]['itemId'];
                                    header('Location: index.php?page=results&view=fiche&id=' . $id . '&key=' . $newKey);
                                }
                            }
                        }
                        if($_POST['ficheAction'] === 'previous'){
                            if($_GET['key'] !== '0'){
                                $previousKey = array_search($_SESSION['ficheItem'], $_SESSION['results'], true);
                                $newKey = $previousKey - 1;
                                if(array_key_exists($newKey, $_SESSION['results'])){
                                    $id = $_SESSION['results'][$newKey]['itemId'];
                                    header('Location: index.php?page=results&view=fiche&id=' . $id . '&key=' . $newKey);
                                }
                            }
                        }
                    }
                }
            }
           
           
            if(!empty($_POST['search'])){
                if($_POST['search'] === 'submit_advanced'){
                        if($_SESSION['searchCategory'] === 'Strips'){
                            $tabel = '`strip`';
                        }
                        if($_SESSION['searchCategory'] === 'Platen'){
                            $tabel = '`plaat`';
                        }
                        if($_SESSION['searchCategory'] === 'Objecten'){
                            $tabel = '`object`';
                        }
                        if($_SESSION['searchCategory'] === 'Boeken'){
                            $tabel = '`boek`';
                        }
                        if($_SESSION['searchCategory'] === 'Beelden'){
                            $tabel = '`beeld`';
                        }
                        if($_SESSION['searchCategory'] === 'Alle'){
                            $tabel = '`alle`';
                        }

                        $query = 'SELECT * FROM ' . $tabel .  ' WHERE';
                        $bindValue = array();
                        

                        if(!empty($_POST['itemId'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `itemId` LIKE :itemId";
                            } else {
                                $query .= " AND `itemId` LIKE :itemId";
                            }
                            array_push($bindValue, 'itemId');
                        }

                        if(!empty($_POST['titel'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `titel` LIKE :titel";
                            } else {
                                $query .= " AND `titel` LIKE :titel";
                            }
                            array_push($bindValue, 'titel');
                        }

                        if(!empty($_POST['serie'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `serie` LIKE :serie";
                            } else {
                                $query .= " AND `serie` LIKE :serie";
                            }
                            array_push($bindValue, 'serie');
                        }

                        if(!empty($_POST['serieNummer'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `serieNummer` LIKE :serieNummer";
                            } else {
                                $query .= " AND `serieNummer` LIKE :serieNummer";
                            }
                            array_push($bindValue, 'serieNummer');
                        }

                        if(!empty($_POST['datum'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `datum` LIKE :datum";
                            } else {
                                $query .= " AND `datum` LIKE :datum";
                            }
                            array_push($bindValue, 'datum');
                        }

                        if(!empty($_POST['periode'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `periode` LIKE :periode";
                            } else {
                                $query .= " AND `periode` LIKE :periode";
                            }
                            array_push($bindValue, 'periode');
                        }

                        if(!empty($_POST['land'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `land` LIKE :land";
                            } else {
                                $query .= " AND `land` LIKE :land";
                            }
                            array_push($bindValue, 'land');
                        }

                        if(!empty($_POST['taal'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `taal` LIKE :taal";
                            } else {
                                $query .= " AND `taal` LIKE :taal";
                            }
                            array_push($bindValue, 'taal');
                        }

                        if(!empty($_POST['gesloten_hoogte'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `gesloten_hoogte` LIKE :gesloten_hoogte";
                            } else {
                                $query .= " AND `gesloten_hoogte` LIKE :gesloten_hoogte";
                            }
                            array_push($bindValue, 'gesloten_hoogte');
                        }


                        if(!empty($_POST['gesloten_breedte'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `gesloten_breedte` LIKE :gesloten_breedte";
                            } else {
                                $query .= " AND `gesloten_breedte` LIKE :gesloten_breedte";
                            }
                            array_push($bindValue, 'gesloten_breedte');
                        }

                        if(!empty($_POST['open_hoogte'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `open_hoogte` LIKE :open_hoogte";
                            } else {
                                $query .= " AND `open_hoogte` LIKE :open_hoogte";
                            }
                            array_push($bindValue, 'open_hoogte');
                        }

                        if(!empty($_POST['open_breedte'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `open_breedte` LIKE :open_breedte";
                            } else {
                                $query .= " AND `open_breedte` LIKE :open_breedte";
                            }
                            array_push($bindValue, 'open_breedte');
                        }

                        if(!empty($_POST['bruto_hoogte'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `bruto_hoogte` LIKE :bruto_hoogte";
                            } else {
                                $query .= " AND `bruto_hoogte` LIKE :bruto_hoogte";
                            }
                            array_push($bindValue, 'bruto_hoogte');
                        }

                        if(!empty($_POST['bruto_breedte'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `bruto_breedte` LIKE :bruto_breedte";
                            } else {
                                $query .= " AND `bruto_breedte` LIKE :bruto_breedte";
                            }
                            array_push($bindValue, 'bruto_breedte');
                        }

                        if(!empty($_POST['netto_hoogte'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `netto_hoogte` LIKE :netto_hoogte";
                            } else {
                                $query .= " AND `netto_hoogte` LIKE :netto_hoogte";
                            }
                            array_push($bindValue, 'netto_hoogte');
                        }

                        if(!empty($_POST['netto_breedte'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `netto_breedte` LIKE :netto_breedte";
                            } else {
                                $query .= " AND `netto_breedte` LIKE :netto_breedte";
                            }
                            array_push($bindValue, 'netto_breedte');
                        }

                        if(!empty($_POST['hoogte'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `hoogte` LIKE :hoogte";
                            } else {
                                $query .= " AND `hoogte` LIKE :hoogte";
                            }
                            array_push($bindValue, 'hoogte');
                        }

                        if(!empty($_POST['breedte'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `breedte` LIKE :breedte";
                            } else {
                                $query .= " AND `breedte` LIKE :breedte";
                            }
                            array_push($bindValue, 'breedte');
                        }

                        if(!empty($_POST['diepte'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `diepte` LIKE :diepte";
                            } else {
                                $query .= " AND `diepte` LIKE :diepte";
                            }
                            array_push($bindValue, 'diepte');
                        }

                        if(!empty($_POST['diameter'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `diameter` LIKE :diameter";
                            } else {
                                $query .= " AND `diameter` LIKE :diameter";
                            }
                            array_push($bindValue, 'diameter');
                        }

                        if(!empty($_POST['scenario'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `scenario` LIKE :scenario";
                            } else {
                                $query .= " AND `scenario` LIKE :scenario";
                            }
                            array_push($bindValue, 'scenario');
                        }

                        if(!empty($_POST['tekeningen'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `tekeningen` LIKE :tekeningen";
                            } else {
                                $query .= " AND `tekeningen` LIKE :tekeningen";
                            }
                            array_push($bindValue, 'tekeningen');
                        }

                        if(!empty($_POST['kleuren'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `kleuren` LIKE :kleuren";
                            } else {
                                $query .= " AND `kleuren` LIKE :kleuren";
                            }
                            array_push($bindValue, 'kleuren');
                        }

                        if(!empty($_POST['type'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `type` LIKE :type";
                            } else {
                                $query .= " AND `type` LIKE :type";
                            }
                            array_push($bindValue, 'type');
                        }

                        if(!empty($_POST['materiaal'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `materiaal` LIKE :materiaal";
                            } else {
                                $query .= " AND `materiaal` LIKE :materiaal";
                            }
                            array_push($bindValue, 'materiaal');
                        }

                        if(!empty($_POST['beeldhouders'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `beeldhouders` LIKE :beeldhouders";
                            } else {
                                $query .= " AND `beeldhouders` LIKE :beeldhouders";
                            }
                            array_push($bindValue, 'beeldhouders');
                        }

                        if(!empty($_POST['beschrijving'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `beschrijving` LIKE :beschrijving";
                            } else {
                                $query .= " AND `beschrijving` LIKE :beschrijving";
                            }
                            array_push($bindValue, 'beschrijving');
                        }

                        if(!empty($_POST['status'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `status` LIKE :status";
                            } else {
                                $query .= " AND `status` LIKE :status";
                            }
                            array_push($bindValue, 'status');
                        }

                        if(!empty($_POST['zaal'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `zaal` LIKE :zaal";
                            } else {
                                $query .= " AND `zaal` LIKE :zaal";
                            }
                            array_push($bindValue, 'zaal');
                        }

                        if(!empty($_POST['gesigneerd'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `gesigneerd` LIKE :gesigneerd";
                            } else {
                                $query .= " AND `gesigneerd` LIKE :gesigneerd";
                            }
                            array_push($bindValue, 'gesigneerd');
                        }

                        if(!empty($_POST['uitgevers'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `uitgevers` LIKE :uitgevers";
                            } else {
                                $query .= " AND `uitgevers` LIKE :uitgevers";
                            }
                            array_push($bindValue, 'uitgevers');
                        }

                        if(!empty($_POST['auteursrecht'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `auteursrecht` LIKE :auteursrecht";
                            } else {
                                $query .= " AND `auteursrecht` LIKE :auteursrecht";
                            }
                            array_push($bindValue, 'auteursrecht');
                        }

                        if(!empty($_POST['paginas'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `paginas` LIKE :paginas";
                            } else {
                                $query .= " AND `paginas` LIKE :paginas";
                            }
                            array_push($bindValue, 'paginas');
                        }

                        if(!empty($_POST['kaft'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `kaft` LIKE :kaft";
                            } else {
                                $query .= " AND `kaft` LIKE :kaft";
                            }
                            array_push($bindValue, 'kaft');
                        }

                        if(!empty($_POST['ISBN'])){
                            if($query === 'SELECT * FROM ' . $tabel .  ' WHERE'){
                                $query .= " `ISBN` LIKE :ISBN";
                            } else {
                                $query .= " AND `ISBN` LIKE :ISBN";
                            }
                            array_push($bindValue, 'ISBN');
                        }

                        if(!empty($bindValue)){
                            if($_SESSION['searchCategory'] === 'Alle'){
                                $sql = strstr($query, 'W');
                                $items = $this->productDAO->advancedAllSearch($sql, $bindValue, $_POST);
                            } else {
                                $items = $this->productDAO->advancedSearchCategory($query, $bindValue, $_POST);
                            }
                        }

                }
            }

            

            if(!empty($items)){
                $_SESSION['results'] = $items;
            } 
        }

        public function addItems(){

            //input fields
            $periodes = $this->formDAO->getPeriode();
            $artiesten = $this->formDAO->getArtiesten();
            $staten = $this->formDAO->getStaat();
            $materialen = $this->formDAO->getMateriaal();
            $signeren = $this->formDAO->getGesigneerd();
            $uitgevers = $this->formDAO->getUitgever();
            $kaften = $this->formDAO->getKaft();
            $landen = $this->formDAO->getLanden();
            $talen = $this->formDAO->getTaal();
            $statussen = $this->formDAO->getStatus();
            $tentoonstellingen = $this->formDAO->getTentoonstelling();
            $typeStrip = $this->formDAO->getTypeStrip();
            $typeBoek = $this->formDAO->getTypeBoek();
            $typeObjectBeeld = $this->formDAO->getTypeObjectBeeld();
            $typePlaat = $this->formDAO->getTypePlaat();
            $zalen = $this->formDAO->getZaal();
            $auteursrechten = $this->formDAO->getAuteursrecht();
            $this->set('auteursrechten', $auteursrechten);
            $this->set('zalen', $zalen);
            $this->set('typePlaat', $typePlaat);
            $this->set('periodes', $periodes);
            $this->set('artiesten', $artiesten);
            $this->set('typeStrip', $typeStrip);
            $this->set('typeBoek', $typeBoek);
            $this->set('typeObjectBeeld', $typeObjectBeeld);
            $this->set('staten', $staten);
            $this->set('materialen', $materialen);
            $this->set('signeren', $signeren);
            $this->set('uitgevers', $uitgevers);
            $this->set('kaften', $kaften);
            $this->set('landen', $landen);
            $this->set('talen', $talen);
            $this->set('statussen', $statussen);
            $this->set('tentoonstellingen', $tentoonstellingen);

            if(!empty($_POST['deleteItem'])){
                if($_POST['deleteItem'] === 'delete'){
                    $this->productDAO->deleteFromBulk($_POST['id']);
                    unlink($_POST['image']);
                    $_SESSION['succes'] = 'Het item is succesvol verwijderd';
                }
            }

             //submit item
             if(!empty($_POST['action'])){
                if($_POST['action'] === 'submit'){
                    $_POST['itemId'] = $this->generateId($_SESSION['category']);
                    if($_SESSION['category'] === 'Strips'){
                        $newStrip = $this->productDAO->addNewStrip($_POST);
                        $this->logDAO->newAction($_SESSION['currentUser']['id'],'add_strip', date('Y-m-d H:i:s')); 
                    }
                    if($_SESSION['category'] === 'Platen'){
                        $newPlaat = $this->productDAO->addNewPlaat($_POST);
                        $this->logDAO->newAction($_SESSION['currentUser']['id'],'add_plaat', date('Y-m-d H:i:s'));
                    }
                    if($_SESSION['category'] === 'Objecten'){
                        $newPlaat = $this->productDAO->addNewObject($_POST);
                        $this->logDAO->newAction($_SESSION['currentUser']['id'],'add_object', date('Y-m-d H:i:s'));
                    }
                    if($_SESSION['category'] === 'Boeken'){
                        $newPlaat = $this->productDAO->addNewBoek($_POST);
                        $this->logDAO->newAction($_SESSION['currentUser']['id'],'add_boek', date('Y-m-d H:i:s'));
                    }
                    if($_SESSION['category'] === 'Beelden'){
                        $newPlaat = $this->productDAO->addNewBeeld($_POST);
                        $this->logDAO->newAction($_SESSION['currentUser']['id'],'add_beeld', date('Y-m-d H:i:s'));
                    }
                    $this->productDAO->deleteFromBulk($_POST['bulkId']);
                    unset($_SESSION['itemsToAdd'][$_POST['key']]);
                    $_SESSION['succes'] = 'Items zijn succesvol toegevoegd';
                }
            }


            //choose category
            if(!empty($_POST['category'])){
                $_SESSION['category'] = $_POST['category'];
            }

            if(empty($_SESSION['category'])){
                $_SESSION['category'] = 'Strips';
            } 

            if(!empty($_SESSION['category'])){
                $_SESSION['itemsToAdd'] = $this->productDAO->getNewItemsFromBulk($_SESSION['category']);

            }



            if(!empty($_POST['addItemsAction']) && !empty($_SESSION['itemsToAdd'])){
                $currentKey = $_POST['key'];
                $allItems = count($_SESSION['itemsToAdd']) - 1;
                if($_POST['addItemsAction'] === 'next'){
                    if($currentKey == $allItems){
                        $newKey = $currentKey;
                    } else {
                        $newKey = $currentKey + 1;
                        
                    } 
                }
                if($_POST['addItemsAction'] === 'previous'){
                    if($currentKey == 0){
                        $newKey = $currentKey;
                    } else {
                        $newKey = $currentKey - 1;
                    }
                }
                header('Location: index.php?page=addItems&key=' . $newKey);
            }

           
    
            //get number of items
            $Strips = $this->productDAO->getNewItemsFromBulk('Strips');
            $Platen = $this->productDAO->getNewItemsFromBulk('Platen');
            $Objecten = $this->productDAO->getNewItemsFromBulk('Objecten');
            $Boeken = $this->productDAO->getNewItemsFromBulk('Boeken');
            $Beelden = $this->productDAO->getNewItemsFromBulk('Beelden');

            $numberOfStrips = count($Strips);
            $numberOfPlaten = count($Platen);
            $numberOfObjecten = count($Objecten);
            $numberOfBoeken = count($Boeken);
            $numberOfBeelden = count($Beelden);

            $this->set('numberOfStrips', $numberOfStrips);
            $this->set('numberOfPlaten', $numberOfPlaten);
            $this->set('numberOfObjecten', $numberOfObjecten);
            $this->set('numberOfBoeken', $numberOfBoeken);
            $this->set('numberOfBeelden', $numberOfBeelden);

        }

        public function generateId($category){
            if($category === 'Strips'){
                $previousItemKey = $this->productDAO->previousStripId();
                $previousItemKey = intval(substr($previousItemKey['itemId'], -4));
                $newKey = strval(str_pad($previousItemKey + 1, 4, "0", STR_PAD_LEFT));
                return '01-' . $newKey;
            }
            if($category === 'Platen'){
                $previousItemKey = $this->productDAO->previousPlaatId();
                $previousItemKey = intval(substr($previousItemKey['itemId'], -4));
                $newKey = strval(str_pad($previousItemKey + 1, 4, "0", STR_PAD_LEFT));
                return '02-' . $newKey; 
            }
            if($category === 'Objecten'){
                $previousItemKey = $this->productDAO->previousObjectId();
                $previousItemKey = intval(substr($previousItemKey['itemId'], -4));
                $newKey = strval(str_pad($previousItemKey + 1, 4, "0", STR_PAD_LEFT));
                return '03-' . $newKey; 
            }
            if($category === 'Boeken'){
                $previousItemKey = $this->productDAO->previousBoekId();
                $previousItemKey = intval(substr($previousItemKey['itemId'], -4));
                $newKey = strval(str_pad($previousItemKey + 1, 4, "0", STR_PAD_LEFT));
                return '04-' . $newKey; 
            }
            if($category === 'Beelden'){
                $previousItemKey = $this->productDAO->previousBeeldId();
                $previousItemKey = intval(substr($previousItemKey['itemId'], -4));
                $newKey = strval(str_pad($previousItemKey + 1, 4, "0", STR_PAD_LEFT));
                return '05-' . $newKey; 
            }
        }

        public function updateItem(){

            $periodes = $this->formDAO->getPeriode();
            $artiesten = $this->formDAO->getArtiesten();
            $staten = $this->formDAO->getStaat();
            $materialen = $this->formDAO->getMateriaal();
            $signeren = $this->formDAO->getGesigneerd();
            $uitgevers = $this->formDAO->getUitgever();
            $kaften = $this->formDAO->getKaft();
            $landen = $this->formDAO->getLanden();
            $talen = $this->formDAO->getTaal();
            $statussen = $this->formDAO->getStatus();
            $tentoonstellingen = $this->formDAO->getTentoonstelling();
            $typeStrip = $this->formDAO->getTypeStrip();
            $typeBoek = $this->formDAO->getTypeBoek();
            $typeObjectBeeld = $this->formDAO->getTypeObjectBeeld();
            $typePlaat = $this->formDAO->getTypePlaat();
            $zalen = $this->formDAO->getZaal();
            $auteursrechten = $this->formDAO->getAuteursrecht();
            $this->set('auteursrechten', $auteursrechten);
            $this->set('zalen', $zalen);
            $this->set('typePlaat', $typePlaat);
            $this->set('periodes', $periodes);
            $this->set('artiesten', $artiesten);
            $this->set('typeStrip', $typeStrip);
            $this->set('typeBoek', $typeBoek);
            $this->set('typeObjectBeeld', $typeObjectBeeld);
            $this->set('staten', $staten);
            $this->set('materialen', $materialen);
            $this->set('signeren', $signeren);
            $this->set('uitgevers', $uitgevers);
            $this->set('kaften', $kaften);
            $this->set('landen', $landen);
            $this->set('talen', $talen);
            $this->set('statussen', $statussen);
            $this->set('tentoonstellingen', $tentoonstellingen);

            if(!empty($_POST['itemId'])){
                $itemId = $_POST['itemId'];
                $catId = substr($itemId, 0, 2);
                if($catId === '01'){
                    $item = $this->productDAO->getStripByItemId($_POST['itemId']);
                    $cat = 'Strips';
                }
                if($catId === '02'){
                    $item = $this->productDAO->getPlaatByItemId($_POST['itemId']);
                    $cat = "Platen";
                }
                if($catId === '03'){
                    $item = $this->productDAO->getObjectByItemId($_POST['itemId']);
                    $cat = "Objecten";
                }
                if($catId === '04'){
                    $item = $this->productDAO->getBoekByItemId($_POST['itemId']);
                    $cat = "Boeken";
                }
                if($catId === '05'){
                    $item = $this->productDAO->getBeeldByItemId($_POST['itemId']);
                    $cat = "Beelden";
                }
                if($item){
                    $this->set('item', $item);
                    $this->set('cat', $cat);
                } else {
                    header('Location: index.php');
                }
            }

        }

        public function export(){
            if(!empty($_POST['export'])){
                if($_POST['export'] === "pdf"){
                }
            }
        }


        public function deleteItem(){
            if(!empty($_POST['action'])){
                if($_POST['action'] === "deleteMultipleItems"){
                    if(!empty($_POST['deleteItem'])){
                        $_SESSION['deleteItems'] = array();
                        foreach($_POST['deleteItem'] as $itemId){
                            $catId = substr($itemId, 0, 2);
                            if($catId === '01'){
                                $item = $this->productDAO->getStripByItemId($itemId);
                            }
                            if($catId === '02'){
                                $item = $this->productDAO->getPlaatByItemId($itemId);
                            }
                            if($catId === '03'){
                                $item = $this->productDAO->getObjectByItemId($itemId);
                            }
                            if($catId === '04'){
                                $item = $this->productDAO->getBoekByItemId($itemId);
                            }
                            if($catId === '05'){
                                $item = $this->productDAO->getBeeldByItemId($itemId);
                            }
                            $item['key'] = $_POST['key'][$itemId];
                            array_push($_SESSION['deleteItems'], $item);
                        }
                    } else {
                        header('Location: index.php?page=results&view=list');
                        
                    }
                    
                }
            }

        }


        public function instellingen(){
            if(!empty($_POST['action'])){
                if($_POST['action'] === 'password'){
                    if($_POST['password'] === $_POST['password__repeat']){
                        $hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $this->authenticationDAO->changeUserPassword($hashed, $_POST['id']);
                    }
                }

                if($_POST['action'] === 'mail'){
                    $this->authenticationDAO->changeUserMail($_POST);
                }
            }
        }


        public function addEmptyItem(){
            $periodes = $this->formDAO->getPeriode();
            $artiesten = $this->formDAO->getArtiesten();
            $staten = $this->formDAO->getStaat();
            $materialen = $this->formDAO->getMateriaal();
            $signeren = $this->formDAO->getGesigneerd();
            $uitgevers = $this->formDAO->getUitgever();
            $kaften = $this->formDAO->getKaft();
            $landen = $this->formDAO->getLanden();
            $talen = $this->formDAO->getTaal();
            $statussen = $this->formDAO->getStatus();
            $tentoonstellingen = $this->formDAO->getTentoonstelling();
            $typeStrip = $this->formDAO->getTypeStrip();
            $typeBoek = $this->formDAO->getTypeBoek();
            $typeObjectBeeld = $this->formDAO->getTypeObjectBeeld();
            $typePlaat = $this->formDAO->getTypePlaat();
            $zalen = $this->formDAO->getZaal();
            $auteursrechten = $this->formDAO->getAuteursrecht();
            $this->set('auteursrechten', $auteursrechten);
            $this->set('zalen', $zalen);
            $this->set('typePlaat', $typePlaat);
            $this->set('periodes', $periodes);
            $this->set('artiesten', $artiesten);
            $this->set('typeStrip', $typeStrip);
            $this->set('typeBoek', $typeBoek);
            $this->set('typeObjectBeeld', $typeObjectBeeld);
            $this->set('staten', $staten);
            $this->set('materialen', $materialen);
            $this->set('signeren', $signeren);
            $this->set('uitgevers', $uitgevers);
            $this->set('kaften', $kaften);
            $this->set('landen', $landen);
            $this->set('talen', $talen);
            $this->set('statussen', $statussen);
            $this->set('tentoonstellingen', $tentoonstellingen);

            if(!empty($_POST['category'])){
                $_SESSION['category'] = $_POST['category'];
            }

            if(!empty($_POST['action'])){
                if($_POST['action'] === 'submit'){
                    //foto verwerken;
                    $filename = $_FILES['images']['name'];
                    $filePath = './images/'. $filename ;
                    if(file_exists($filePath)){
                        $_SESSION['error'] = 'De foto bestaat al. Gelieve een andere foto te kiezen.';
                    } else {
                        if($_FILES['images']['size'] > 1000000000){
                            $_SESSION['error'] = "De foto is te groot";
                        } else {
                            move_uploaded_file($_FILES['images']['tmp_name'], $filePath);
                            $_POST['photo'] = $filePath;
                            $_POST['itemId'] = $this->generateId($_SESSION['category']);
                            //data uploaden
                            if($_SESSION['category'] === 'Strips'){
                                $newStrip = $this->productDAO->addNewStrip($_POST);
                                $this->logDAO->newAction($_SESSION['currentUser']['id'],'add_strip', date('Y-m-d H:i:s')); 
                            }
                            if($_SESSION['category'] === 'Platen'){
                                $newPlaat = $this->productDAO->addNewPlaat($_POST);
                                $this->logDAO->newAction($_SESSION['currentUser']['id'],'add_plaat', date('Y-m-d H:i:s'));
                            }
                            if($_SESSION['category'] === 'Objecten'){
                                $newPlaat = $this->productDAO->addNewObject($_POST);
                                $this->logDAO->newAction($_SESSION['currentUser']['id'],'add_object', date('Y-m-d H:i:s'));
                            }
                            if($_SESSION['category'] === 'Boeken'){
                                $newPlaat = $this->productDAO->addNewBoek($_POST);
                                $this->logDAO->newAction($_SESSION['currentUser']['id'],'add_boek', date('Y-m-d H:i:s'));
                            }
                            if($_SESSION['category'] === 'Beelden'){
                                $newPlaat = $this->productDAO->addNewBeeld($_POST);
                                $this->logDAO->newAction($_SESSION['currentUser']['id'],'add_beeld', date('Y-m-d H:i:s'));
                            }
                            $_SESSION['succes'] = "Item is succesvol toegevoegd";
                        }
                    }
                }
            }

        }

        public function addItemDelete() {

        }

    }

?>