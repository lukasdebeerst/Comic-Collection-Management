 <?php 
    require_once __DIR__ . '/Controller.php';
    require_once __DIR__ . '/../dao/ProductDAO.php';
    require_once __DIR__ . '/../dao/AuthenticationDAO.php';
    require_once __DIR__ . '/../dao/LogDAO.php';

    class AdminController extends Controller {

        function __construct() {
            $this->productDAO = new ProductDAO();
            $this->authenticationDAO = new authenticationDAO();
            $this->logDAO = new LogDAO();
        }

        public function admin(){

        }

        public function adminUpload(){
            if(!empty($_POST['delete'])){
                if($_POST['delete'] === "deleteAllBulk"){
                    $this->productDAO->deleteAllBulk();
                }
                if($_POST['delete'] === "deleteRecentBulk"){
                    $this->productDAO->deleteRecentBulk();
                }
                if($_POST['delete'] === "deleteCategory"){
                    $this->productDAO->deleteBulkOnCategory($_POST['category']);
                }
                foreach($_SESSION['bulk'] as $item){
                    unlink($item['image']);
                }
                $_SESSION['succes'] = "Bulk is succesvol verwijderd.";
            }

            if(!empty($_POST['action'])){
                $countFiles = count($_FILES['images']['name']);
                
                $totalSize = 0;
                $fileExists = array();
                foreach($_FILES['images']['size'] as $item){
                    $totalSize += $item;
                }
                
                if($totalSize > 1000000000){
                    $_SESSION['error'] = "De bulk is te groot";
                } else {
                        for($i=0;$i<$countFiles;$i++){
                            $filename = $_FILES['images']['name'][$i];
                            $filePath = './images/'. $filename;
                            if(file_exists($filePath)){
                                array_push($fileExists, $filename);
                            } else {
                                move_uploaded_file($_FILES['images']['tmp_name'][$i], $filePath);
                                $upload = $this->productDAO->uploadBulk(array(
                                    'category' => $_POST['category'],
                                    'image' => $filePath,
                                    'user' => $_SESSION['currentUser']['firstName'] . ' ' . $_SESSION['currentUser']['lastName'],
                                    'time' => date('Y-m-d H:i:s')
                                ));
                                if($upload){
                                    $_SESSION['succes'] = "Bulk succesvol toegevoegd";
                                    $this->logDAO->newAction($_SESSION['currentUser']['id'],'add_bulk', date('Y-m-d H:i:s')); 
                                }
                            }    
                        }

                        if(!empty($fileExists)){
                            $errors  = implode(',', $fileExists);
                            $_SESSION['error'] = 'de file(s) ' . $errors .  ' bestaan al. Verander de naam en probeer opnieuw';
                        }   
                }
            }

        }

        public function deleteBulk(){
            
            if(!empty($_POST['delete'])){
                if($_POST['delete'] === 'allBulk'){
                    $_SESSION['bulk'] = $this->productDAO->getAllBulk();
                }

                if($_POST['delete'] === "recentBulk"){
                    $_SESSION['bulk'] = $this->productDAO->getRecentBulk();
                }

                if($_POST['delete'] === "deleteCategory"){
                    $_SESSION['bulk'] = $this->productDAO->getBulkOnCategory($_POST['category']);
                }

                if(!empty($_SESSION['bulk'])){
                    $strips = 0;
                    $platen = 0;
                    $objecten = 0;
                    $boeken = 0;
                    $beelden = 0;
                    foreach($_SESSION['bulk'] as $item) {
                        switch($item['category']){
                            case "Strips":
                                $strips += 1;
                                break;
                            case "Platen":
                                $platen += 1;
                                break;
                            case "Objecten":
                                $objecten += 1;
                                break;
                            case "Boeken":
                                $boeken += 1;
                                break;
                            case "Beelden":
                                $beelden += 1;
                                break;
                        }
                    }
                    $this->set('bulk', $_SESSION['bulk']);
                    $this->set("strips", $strips);
                    $this->set("platen", $platen);
                    $this->set("objecten", $objecten);
                    $this->set("boeken", $boeken);
                    $this->set("beelden", $beelden);
                }
            }

                
        }

        public function users() {
            if(!empty($_GET['id'])){
                $currentUser = $this->authenticationDAO->getUserById($_GET['id']);
                if($currentUser){
                    $this->set('currentUser', $currentUser);
                } else {
                    header('Location: index.php?page=users');
                }
            }

            if(!empty($_POST['action'])){
                if($_POST['action'] === 'name'){
                    $this->authenticationDAO->changeUserName($_POST);
                    $_SESSION['message'] = 'Naam is succesvol geupdate.';
                }
                if($_POST['action'] === 'status'){
                    $this->authenticationDAO->changeUserStatus($_POST);
                    $_SESSION['message'] = 'status is succesvol geupdate.';
                }
                if($_POST['action'] === 'password'){
                    if($_POST['password'] === $_POST['password__repeat']){
                        $hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $this->authenticationDAO->changeUserPassword($hashed, $_POST['id']);
                    } else {
                        $_SESSION['passwordError'] = "De 2 passwoorden kwamen niet overeen";
                    }
                }
                if($_POST['action'] === 'mail'){
                    $this->authenticationDAO->changeUserMail($_POST);
                }

                if($_POST['action'] === 'new'){
                    if($_POST['password'] === $_POST['password__repeat']){
                        $checkMail = $this->authenticationDAO->checkMail($_POST['mail']);
                        if(empty($checkMail)){
                                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                                $this->authenticationDAO->createNewUser($password, $_POST);
                                $_SESSION['succes'] = "De gebruiker is succesvol toegevoegd";
                                header('Location: index.php?page=users&action=new');                   
                        } else {
                            $_SESSION['error'] = "Dit e-mailadres is al gebruikt.";
                        }
                    } else {
                        $_SESSION['passwordError'] = "De 2 passwoorden kwamen niet overeen";
                    }
                }

            }

            if(!empty($_POST['deleteAction'])){
                if($_POST['deleteAction'] === "deleteUser"){
                    $this->authenticationDAO->deleteUser($_POST['id']);
                    $_SESSION['succes'] = "User is succesvol verwijderd";
                }
            }

            $allUsers = $this->authenticationDAO->getAllUsers();
            $this->set('allUsers', $allUsers);
        }

        public function deleteUser() {
            
        }

    }
?>