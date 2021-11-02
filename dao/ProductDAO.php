<?php 

    require_once __DIR__ . '/DAO.php';

    class ProductDAO extends DAO {

        public function advancedAllSearch($query, $bindValue, $data) {
            $strip = $this->advancedSearchCategory('SELECT * FROM `strip` ' . $query , $bindValue, $data);
            $plaat = $this->advancedSearchCategory('SELECT * FROM `plaat` ' . $query , $bindValue, $data);
            $object = $this->advancedSearchCategory('SELECT * FROM `object` ' . $query , $bindValue, $data);
            $boek = $this->advancedSearchCategory('SELECT * FROM `boek` ' . $query , $bindValue, $data);
            $beeld = $this->advancedSearchCategory('SELECT * FROM `beeld` ' . $query , $bindValue, $data);
            return array_merge($strip, $plaat, $object, $boek, $beeld);
        }

        public function advancedSearchCategory($query, $bindValue, $data){
            $stmt = $this->pdo->prepare($query);
            foreach($bindValue as $bv){
                $stmt->bindValue(':' . $bv, '%' . $data[$bv] . '%' );
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function simpleSearch($value){
            $strip = $this->searchStrip(array(
                'itemId' => $value,
                'photo' => $value,
                'titel' => $value,
                'serie' => $value,
                'serieNummer' => $value,
                'datum' => $value,
                'periode' => $value,
                'scenario' => $value,
                'tekeningen' => $value,
                'kleuren' => $value,
                'type' => $value,
                'gesigneerd' => $value,
                'uitgever' => $value,
                'auteursrecht' => $value,
                'paginas' => $value,
                'kaft' => $value,
                'ISBN' => $value,
                'land' => $value,
                'taal' => $value,
                'gesloten_hoogte' => $value,
                'gesloten_breedte' => $value,
                'open_hoogte' => $value,
                'open_breedte' => $value,
                'beschrijving' => $value,
                'status' => $value,
                'zaal' => $value,
            ));

            $plaat = $this->searchPlaat(array(
                'itemId' => $value,
                'photo' => $value,
                'titel' => $value,
                'serie' => $value,
                'serieNummer' => $value,
                'datum' => $value,
                'periode' => $value,
                'scenario' => $value,
                'tekeningen' => $value,
                'kleuren' => $value,
                'type' => $value,
                'gesigneerd' => $value,
                'uitgever' => $value,
                'auteursrecht' => $value,
                'land' => $value,
                'taal' => $value,
                'bruto_hoogte' => $value,
                'bruto_breedte' => $value,
                'netto_hoogte' => $value,
                'netto_breedte' => $value,
                'beschrijving' => $value,
                'status' => $value,
                'zaal' => $value
            ));

            $object = $this->searchObjecten(array(
                'itemId' => $value,
                'photo' => $value,
                'titel' => $value,
                'serie' => $value,
                'serieNummer' => $value,
                'datum' => $value,
                'periode' => $value,
                'scenario' => $value,
                'tekeningen' => $value,
                'kleuren' => $value,
                'type' => $value,
                'materiaal' => $value,
                'gesigneerd' => $value,
                'uitgever' => $value,
                'auteursrecht' => $value,
                'land' => $value,
                'taal' => $value,
                'hoogte' => $value,
                'breedte' => $value,
                'diepte' => $value,
                'diameter' => $value,
                'beschrijving' => $value,
                'status' => $value,
                'zaal' => $value
            ));

            $boeken = $this->searchBoeken(array(
                'itemId' => $value,
                'photo' => $value,
                'titel' => $value,
                'serie' => $value,
                'serieNummer' => $value,
                'datum' => $value,
                'periode' => $value,
                'scenario' => $value,
                'tekeningen' => $value,
                'kleuren' => $value,
                'type' => $value,
                'gesigneerd' => $value,
                'uitgever' => $value,
                'auteursrecht' => $value,
                'paginas' => $value,
                'kaft' => $value,
                'ISBN' => $value,
                'land' => $value,
                'taal' => $value,
                'gesloten_hoogte' => $value,
                'gesloten_breedte' => $value,
                'open_hoogte' => $value,
                'open_breedte' => $value,
                'beschrijving' => $value,
                'status' => $value,
                'zaal' => $value
            ));

            $beelden = $this->searchBeelden(array(
                'itemId' => $value,
                'photo'  => $value,
                'titel' => $value,
                'serie' => $value,
                'serieNummer' => $value,
                'datum' => $value,
                'periode' => $value,
                'scenario' => $value,
                'tekeningen' => $value,
                'kleuren' => $value,
                'beeldhouder' => $value,
                'type' => $value,
                'materiaal' => $value,
                'gesigneerd' => $value,
                'uitgever' => $value,
                'auteursrecht' => $value,
                'land' => $value,
                'taal' => $value,
                'hoogte' => $value,
                'breedte' => $value,
                'diameter' => $value,
                'diepte' => $value,
                'beschrijving' => $value,
                'status' => $value,
                'zaal' => $value
            ));

            return $result = array_merge($strip, $plaat, $object, $boeken, $beelden);
        }

        public function advancedSearch($data){

            $strip = $this->searchStrip(array(
                'itemId' => $data['itemId'],
                'photo' => " ",
                'titel' => $data['titel'],
                'serie' => $data['serie'],
                'serieNummer' => $data['serieNummer'],
                'datum' => $data['datum'],
                'periode' => $data['periode'],
                'scenario' => $data['scenario'],
                'tekeningen' => $data['tekeningen'],
                'kleuren' => $data['kleuren'],
                'type' => $data['type'],
                'gesigneerd' => $data['gesigneerd'],
                'uitgever' => $data['uitgever'],
                'auteursrecht' => " ",
                'paginas' => " ",
                'kaft' => " ",
                'ISBN' => " ",
                'land' => $data['land'],
                'taal' => $data['taal'],
                'gesloten_hoogte' => " ",
                'gesloten_breedte' => " ",
                'open_hoogte' => " ",
                'open_breedte' => " ",
                'beschrijving' => $data['beschrijving'],
                'status' => $data['status'],
                'zaal' => $data['zaal'],
            ));

            $plaat = $this->searchPlaat(array(
                'itemId' => $data['itemId'],
                'titel' => $data['titel'],
                'serie' => $data['serie'],
                'serieNummer' => $data['serieNummer'],
                'datum' => $data['datum'],
                'periode' => $data['periode'],
                'scenario' => $data['scenario'],
                'tekeningen' => $data['tekeningen'],
                'kleuren' => $data['kleuren'],
                'type' => $data['type'],
                'gesigneerd' => $data['gesigneerd'],
                'uitgever' => $data['uitgever'],
                'auteursrecht' => $data['auteursrecht'],
                'land' => $data['land'],
                'taal' => $data['taal'],
                'bruto_hoogte' => " ",
                'bruto_breedte' => " ",
                'netto_hoogte' => " ",
                'netto_breedte' => " ",
                'beschrijving' => $data['beschrijving'],
                'status' => $data['status'],
                'zaal' => $data['zaal']
            ));

            $object = $this->searchObjecten(array(
                'itemId' => $data['itemId'],
                'titel' => $data['titel'],
                'serie' => $data['serie'],
                'serieNummer' => $data['serieNummer'],
                'datum' => $data['datum'],
                'periode' => $data['periode'],
                'scenario' => $data['scenario'],
                'tekeningen' => $data['tekeningen'],
                'kleuren' => $data['kleuren'],
                'type' => $data['type'],
                'materiaal' => ' ',
                'gesigneerd' => $data['gesigneerd'],
                'uitgever' => $data['uitgever'],
                'auteursrecht' => $data['auteursrecht'],
                'land' => $data['land'],
                'taal' => $data['taal'],
                'hoogte' => " ",
                'breedte' => " ",
                'diepte' => " ",
                'diameter' => " ",
                'beschrijving' => $data['beschrijving'],
                'status' => $data['status'],
                'zaal' => $data['zaal']
            ));

            $boeken = $this->searchBoeken(array(
                'itemId' => $data['itemId'],
                'photo' => " ",
                'titel' => $data['titel'],
                'serie' => $data['serie'],
                'serieNummer' => $data['serieNummer'],
                'datum' => $data['datum'],
                'periode' => $data['periode'],
                'scenario' => $data['scenario'],
                'tekeningen' => $data['tekeningen'],
                'kleuren' => $data['kleuren'],
                'type' => $data['type'],
                'gesigneerd' => $data['gesigneerd'],
                'uitgever' => $data['uitgever'],
                'auteursrecht' => " ",
                'paginas' => " ",
                'kaft' => " ",
                'ISBN' => " ",
                'land' => $data['land'],
                'taal' => $data['taal'],
                'gesloten_hoogte' => " ",
                'gesloten_breedte' => " ",
                'open_hoogte' => " ",
                'open_breedte' => " ",
                'beschrijving' => $data['beschrijving'],
                'status' => $data['status'],
                'zaal' => $data['zaal'],
            ));

            $beelden = $this->searchBeelden(array(
                'itemId' => $data['itemId'],
                'titel' => $data['titel'],
                'serie' => $data['serie'],
                'serieNummer' => $data['serieNummer'],
                'datum' => $data['datum'],
                'periode' => $data['periode'],
                'scenario' => $data['scenario'],
                'tekeningen' => $data['tekeningen'],
                'kleuren' => $data['kleuren'],
                'beeldhouder' => ' ',
                'type' => $data['type'],
                'materiaal' => ' ',
                'gesigneerd' => $data['gesigneerd'],
                'uitgever' => $data['uitgever'],
                'auteursrecht' => $data['auteursrecht'],
                'land' => $data['land'],
                'taal' => $data['taal'],
                'hoogte' => " ",
                'breedte' => " ",
                'diameter' => " ",
                'diepte' =>  " " ,
                'beschrijving' => $data['beschrijving'],
                'status' => $data['status'],
                'zaal' => $data['zaal']
            ));

            return $result = array_merge($strip, $plaat, $object, $boeken, $beelden);
        }

        public function searchStrip($data){
            $sql = "SELECT * 
                    FROM `strip`
                    WHERE `titel` LIKE :titel 
                    OR `itemId` LIKE :itemId
                    -- OR `photo` LIKE :photo
                    OR `serie` LIKE :serie
                    OR `serie-nummer` LIKE :serieNummer
                    OR `datum` LIKE :datum
                    OR `periode` LIKE :periode
                    OR `scenario` LIKE :scenario
                    OR `tekeningen` LIKE :tekeningen
                    OR `kleuren` LIKE :kleuren
                    OR `type` LIKE :type
                    OR `gesigneerd` LIKE :gesigneerd
                    OR `uitgever` LIKE :uitgever
                    OR `auteursrecht` LIKE :auteursrecht
                    OR `paginas` LIKE :paginas
                    OR `kaft` LIKE :kaft
                    OR `ISBN` LIKE :ISBN
                    OR `land` LIKE :land
                    OR `taal` LIKE :taal
                    OR `beschrijving` LIKE :beschrijving
                    OR `gesloten_hoogte` LIKE :gesloten_hoogte
                    OR `gesloten_breedte` LIKE :gesloten_breedte
                    OR `open_hoogte` LIKE :open_hoogte
                    OR `open_breedte` LIKE :open_breedte
                    OR `status` LIKE :status
                    OR `zaal` LIKE :zaal";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':itemId', '%' . $data['itemId'] . '%');
            // $stmt->bindValue(':photo', '%' . $data['photo'] . '%'); 
            $stmt->bindValue(':titel', '%' . $data['titel'] . '%');
            $stmt->bindValue(':serie', '%' . $data['serie'] . '%');
            $stmt->bindValue(':serieNummer', '%' . $data['serieNummer'] . '%');
            $stmt->bindValue(':datum', '%' . $data['datum'] . '%');
            $stmt->bindValue(':periode', '%' . $data['periode'] . '%');
            $stmt->bindValue(':scenario', '%' . $data['scenario'] . '%');
            $stmt->bindValue(':tekeningen', '%' . $data['tekeningen'] . '%');
            $stmt->bindValue(':kleuren', '%' . $data['kleuren'] . '%');
            $stmt->bindValue(':type', '%' . $data['type'] . '%');
            $stmt->bindValue(':gesigneerd', '%' . $data['gesigneerd'] . '%');
            $stmt->bindValue(':uitgever', '%' . $data['uitgever'] . '%');
            $stmt->bindValue(':auteursrecht', '%' . $data['auteursrecht'] . '%');
            $stmt->bindValue(':paginas', '%' . $data['paginas'] . '%');
            $stmt->bindValue(':kaft', '%' . $data['kaft'] . '%');
            $stmt->bindValue(':ISBN', '%' . $data['ISBN'] . '%');
            $stmt->bindValue(':land', '%' . $data['land'] . '%');
            $stmt->bindValue(':taal', '%' . $data['taal'] . '%');
            $stmt->bindValue(':gesloten_hoogte', '%' . $data['gesloten_hoogte'] . '%');
            $stmt->bindValue(':gesloten_breedte', '%' . $data['gesloten_breedte'] . '%');
            $stmt->bindValue('open_hoogte', '%' . $data['open_hoogte'] . '%');
            $stmt->bindValue('open_breedte', '%' . $data['open_breedte'] . '%');
            $stmt->bindValue(':beschrijving', '%' . $data['beschrijving'] . '%');
            $stmt->bindValue(':status', '%' . $data['status'] . '%');
            $stmt->bindValue(':zaal', '%' . $data['zaal'] . '%');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        public function searchPlaat($data) {
            $sql = "SELECT * FROM `plaat`
                    WHERE `itemId` LIKE :itemId
                    -- OR `photo` LIKE :photo
                    OR `titel` LIKE :titel
                    OR `serie` LIKE :serie
                    OR `serie-nummer` LIKE :serieNummer
                    OR `datum` LIKE :datum
                    OR `periode` LIKE :periode
                    OR `scenario` LIKE :scenario
                    OR `tekeningen` LIKE :tekeningen
                    OR `kleuren` LIKE :kleuren
                    OR `type` LIKE :type
                    OR `gesigneerd` LIKE :gesigneerd
                    OR `uitgever` LIKE :uitgever
                    OR `auteursrecht` LIKE :auteursrecht
                    OR `land` LIKE :land
                    OR `taal` LIKE :taal
                    OR `bruto_hoogte` LIKE :bruto_hoogte
                    OR `bruto_breedte` LIKE :bruto_breedte
                    OR `netto_hoogte` LIKE :netto_hoogte
                    OR `netto_breedte` LIKE :netto_breedte
                    OR `beschrijving` LIKE :beschrijving
                    OR `status` LIKE :status
                    OR `zaal` LIKE :zaal";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':itemId', '%' . $data['itemId'] . '%');
            // $stmt->bindValue(':photo', '%' . $data['photo'] . '%');
            $stmt->bindValue(':titel', '%' . $data['titel'] . '%');
            $stmt->bindValue(':serie', '%' . $data['serie'] . '%');
            $stmt->bindValue(':serieNummer', '%' . $data['serieNummer'] . '%');
            $stmt->bindValue(':datum', '%' . $data['datum'] . '%');
            $stmt->bindValue(':periode', '%' . $data['periode'] . '%');
            $stmt->bindValue(':scenario', '%' . $data['scenario'] . '%');
            $stmt->bindValue(':tekeningen', '%' . $data['tekeningen'] . '%');
            $stmt->bindValue(':kleuren', '%' . $data['kleuren'] . '%');
            $stmt->bindValue(':type', '%' . $data['type'] . '%');
            $stmt->bindValue(':gesigneerd', '%' . $data['gesigneerd'] . '%');
            $stmt->bindValue(':uitgever', '%' . $data['uitgever'] . '%');
            $stmt->bindValue(':auteursrecht', '%' . $data['auteursrecht'] . '%');
            $stmt->bindValue(':land', '%' . $data['land'] . '%');
            $stmt->bindValue(':taal', '%' . $data['taal'] . '%');
            $stmt->bindValue(':bruto_hoogte', '%' . $data['bruto_hoogte'] . '%');
            $stmt->bindValue(':bruto_breedte', '%' . $data['bruto_breedte'] . '%');
            $stmt->bindValue(':netto_hoogte', '%' . $data['netto_hoogte'] . '%');
            $stmt->bindValue(':netto_breedte', '%' . $data['netto_breedte'] . '%');            
            $stmt->bindValue(':beschrijving', '%' . $data['beschrijving'] . '%');
            $stmt->bindValue(':status', '%' . $data['status'] . '%');
            $stmt->bindValue(':zaal', '%' . $data['zaal'] . '%');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function searchObjecten($data){
            $sql = "SELECT * 
                    FROM `object`
                    WHERE `itemId` LIKE :itemId
                    -- OR `photo` LIKE :photo
                    OR `titel` LIKE :titel
                    OR `serie` LIKE :serie 
                    OR `serie-nummer` LIKE :serieNummer
                    OR `datum` LIKE :datum
                    OR `periode` LIKE :periode
                    OR `scenario` LIKE :scenario   
                    OR `tekeningen` LIKE :tekeningen
                    OR `kleuren` LIKE :kleuren
                    OR `type` LIKE :type
                    OR `materiaal` LIKE :materiaal
                    OR `gesigneerd` LIKE :gesigneerd
                    OR `uitgever` LIKE :uitgever
                    OR `auteursrecht` LIKE :auteursrecht
                    OR `land` LIKE :land
                    OR `taal` LIKE :taal
                    OR `hoogte` LIKE :hoogte
                    OR `breedte` LIKE :breedte
                    OR `diepte` LIKE :diepte
                    OR `diameter` LIKE :diameter
                    OR `beschrijving` LIKE :beschrijving
                    OR `status` LIKE :status
                    OR `zaal` LIKE :zaal";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':itemId', '%' . $data['itemId'] . '%');
            // $stmt->bindValue(':photo', '%' . $data['photo'] . '%');
            $stmt->bindValue(':titel', '%' . $data['titel'] . '%');
            $stmt->bindValue(':serie', '%' . $data['serie'] . '%');
            $stmt->bindValue(':serieNummer', '%' . $data['serieNummer'] . '%');
            $stmt->bindValue(':datum', '%' . $data['datum'] . '%');
            $stmt->bindValue(':periode', '%' . $data['periode'] . '%');
            $stmt->bindValue(':scenario', '%' . $data['scenario'] . '%');
            $stmt->bindValue(':tekeningen', '%' . $data['tekeningen'] . '%');
            $stmt->bindValue(':kleuren', '%' . $data['kleuren'] . '%');
            $stmt->bindValue(':type', '%' . $data['type'] . '%');
            $stmt->bindValue(':materiaal', '%' . $data['materiaal'] . '%');
            $stmt->bindValue(':gesigneerd', '%' . $data['gesigneerd'] . '%');
            $stmt->bindValue(':uitgever', '%' . $data['uitgever'] . '%');
            $stmt->bindValue(':auteursrecht', '%' . $data['auteursrecht'] . '%');
            $stmt->bindValue(':land', '%' . $data['land'] . '%');
            $stmt->bindValue(':taal', '%' . $data['taal'] . '%');
            $stmt->bindValue(':hoogte', '%' . $data['hoogte'] . '%');
            $stmt->bindValue(':breedte', '%' . $data['breedte'] . '%');
            $stmt->bindValue(':diameter', '%' . $data['diameter'] . '%');
            $stmt->bindValue(':diepte', '%' . $data['diepte'] . '%');
            $stmt->bindValue(':beschrijving', '%' . $data['beschrijving'] . '%');
            $stmt->bindValue(':status', '%' . $data['status'] . '%');
            $stmt->bindValue(':zaal', '%' . $data['zaal'] . '%');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function searchBoeken($data){
            $sql = "SELECT * 
                    FROM  `boek`
                    WHERE `itemId` LIKE :itemId
                    -- OR `photo` LIKE :photo
                    OR `titel` LIKE :titel
                    OR `serie` LIKE :serie 
                    OR `serie-nummer` LIKE :serieNummer
                    OR `datum` LIKE :datum
                    OR `periode` LIKE :periode
                    OR `scenario` LIKE :scenario   
                    OR `tekeningen` LIKE :tekeningen
                    OR `kleuren` LIKE :kleuren
                    OR `type` LIKE :type
                    OR `gesigneerd` LIKE :gesigneerd
                    OR `uitgever` LIKE :uitgever
                    OR `auteursrecht` LIKE :auteursrecht
                    OR `paginas` LIKE :paginas
                    OR `kaft` LIKE :kaft
                    OR `ISBN` LIKE :ISBN
                    OR `land` LIKE :land
                    OR `taal` LIKE :taal
                    OR `gesloten_hoogte` LIKE :gesloten_hoogte
                    OR `gesloten_breedte` LIKE :gesloten_breedte
                    OR `open_hoogte` LIKE :open_hoogte
                    OR `open_breedte` LIKE :open_breedte
                    OR `beschrijving` LIKE :beschrijving
                    OR `status` LIKE :status
                    OR `zaal` LIKE :zaal";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':itemId', '%' . $data['itemId'] . '%');
            // $stmt->bindValue(':photo', '%' . $data['photo'] . '%');
            $stmt->bindValue(':titel', '%' . $data['titel'] . '%');
            $stmt->bindValue(':serie', '%' . $data['serie'] . '%');
            $stmt->bindValue(':serieNummer', '%' . $data['serieNummer'] . '%');
            $stmt->bindValue(':datum', '%' . $data['datum'] . '%');
            $stmt->bindValue(':periode', '%' . $data['periode'] . '%');
            $stmt->bindValue(':scenario', '%' . $data['scenario'] . '%');
            $stmt->bindValue(':tekeningen', '%' . $data['tekeningen'] . '%');
            $stmt->bindValue(':kleuren', '%' . $data['kleuren'] . '%');
            $stmt->bindValue(':type', '%' . $data['type'] . '%');
            $stmt->bindValue(':gesigneerd', '%' . $data['gesigneerd'] . '%');
            $stmt->bindValue(':uitgever', '%' . $data['uitgever'] . '%');
            $stmt->bindValue(':auteursrecht', '%' . $data['auteursrecht'] . '%');
            $stmt->bindValue(':paginas', '%' . $data['paginas'] . '%');
            $stmt->bindValue(':kaft', '%' . $data['kaft'] . '%');
            $stmt->bindValue(':ISBN', '%' . $data['ISBN'] . '%');
            $stmt->bindValue(':land', '%' . $data['land'] . '%');
            $stmt->bindValue(':taal', '%' . $data['taal'] . '%');
            $stmt->bindValue(':gesloten_hoogte', '%' . $data['gesloten_hoogte'] . '%');
            $stmt->bindValue(':gesloten_breedte', '%' . $data['gesloten_breedte'] . '%');
            $stmt->bindValue('open_hoogte', '%' . $data['open_hoogte'] . '%');
            $stmt->bindValue('open_breedte', '%' . $data['open_breedte'] . '%');
            $stmt->bindValue(':beschrijving', '%' . $data['beschrijving'] . '%');
            $stmt->bindValue(':status', '%' . $data['status'] . '%');
            $stmt->bindValue(':zaal', '%' . $data['zaal'] . '%');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function searchbeelden($data){
            $sql = "SELECT * 
                    FROM  `beeld`
                    WHERE `itemId` LIKE :itemId
                    -- OR `photo` LIKE :photo
                    OR `titel` LIKE :titel
                    OR `serie` LIKE :serie 
                    OR `serie-nummer` LIKE :serieNummer
                    OR `datum` LIKE :datum
                    OR `periode` LIKE :periode
                    OR `scenario` LIKE :scenario   
                    OR `tekeningen` LIKE :tekeningen
                    OR `kleuren` LIKE :kleuren
                    OR `beeldhouder` LIKE :beeldhouder
                    OR `type` LIKE :type
                    OR `materiaal` LIKE :materiaal
                    OR `gesigneerd` LIKE :gesigneerd
                    OR `uitgever` LIKE :uitgever
                    OR `auteursrecht` LIKE :auteursrecht
                    OR `land` LIKE :land
                    OR `taal` LIKE :taal
                    OR `hoogte` LIKE :hoogte
                    OR `breedte` LIKE :breedte
                    OR `diepte` LIKE :diepte
                    OR `diameter` LIKE :diameter
                    OR `beschrijving` LIKE :beschrijving
                    OR `status` LIKE :status
                    OR `zaal` LIKE :zaal";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':itemId', '%' . $data['itemId'] . '%');
            // $stmt->bindValue(':photo', '%' . $data['photo'] . '%');
            $stmt->bindValue(':titel', '%' . $data['titel'] . '%');
            $stmt->bindValue(':serie', '%' . $data['serie'] . '%');
            $stmt->bindValue(':serieNummer', '%' . $data['serieNummer'] . '%');
            $stmt->bindValue(':datum', '%' . $data['datum'] . '%');
            $stmt->bindValue(':periode', '%' . $data['periode'] . '%');
            $stmt->bindValue(':scenario', '%' . $data['scenario'] . '%');
            $stmt->bindValue(':tekeningen', '%' . $data['tekeningen'] . '%');
            $stmt->bindValue(':kleuren', '%' . $data['kleuren'] . '%');
            $stmt->bindValue(':beeldhouder', '%' . $data['beeldhouder'] . '%');
            $stmt->bindValue(':type', '%' . $data['type'] . '%');
            $stmt->bindValue(':materiaal', '%' . $data['materiaal'] . '%');
            $stmt->bindValue(':gesigneerd', '%' . $data['gesigneerd'] . '%');
            $stmt->bindValue(':uitgever', '%' . $data['uitgever'] . '%');
            $stmt->bindValue(':auteursrecht', '%' . $data['auteursrecht'] . '%');
            $stmt->bindValue(':land', '%' . $data['land'] . '%');
            $stmt->bindValue(':taal', '%' . $data['taal'] . '%');
            $stmt->bindValue(':beschrijving', '%' . $data['beschrijving'] . '%');
            $stmt->bindValue(':hoogte', '%' . $data['hoogte'] . '%');
            $stmt->bindValue(':breedte', '%' . $data['breedte'] . '%');
            $stmt->bindValue(':diameter', '%' . $data['diameter'] . '%');
            $stmt->bindValue(':diepte', '%' . $data['diepte'] . '%');
            $stmt->bindValue(':status', '%' . $data['status'] . '%');
            $stmt->bindValue(':zaal', '%' . $data['zaal'] . '%');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        public function uploadBulk($data){
            $sql = "INSERT INTO `bulk` (`image`, `category`, `user`, `time`) VALUES (:image, :category, :user, :time)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':image', $data['image']);
            $stmt->bindValue(':category', $data['category']);
            $stmt->bindValue(':user', $data['user']);
            $stmt->bindValue(':time', $data['time']);
            return $stmt->execute();
        }

        public function getItemForBulkById($id){
            $sql = "SELECT * FROM `bulk` WHERE `id` = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getNewItemsFromBulk($category){
            $sql = "SELECT * FROM `bulk` WHERE `category` = :category";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':category', $category);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function deleteFromBulk($id){
            $sql = "DELETE FROM `bulk` WHERE `id` = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        }


        public function previousStripId(){
            $sql = "SELECT * FROM `strip` ORDER BY `id` DESC limit 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function previousPlaatId(){
            $sql = "SELECT * FROM `plaat` ORDER BY `id` DESC limit 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function previousObjectId(){
            $sql = "SELECT * FROM `object` ORDER BY `id` DESC limit 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function previousBoekId(){
            $sql = "SELECT * FROM `boek` ORDER BY `id` DESC limit 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function previousBeeldId(){
            $sql = "SELECT * FROM `beeld` ORDER BY `id` DESC limit 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function addNewStrip($data){
            $sql = "INSERT INTO `strip` 
                    (`itemId`, `photo`, `titel`, `serie`, `serie-nummer`, `datum`, `periode`, `scenario`, `tekeningen`, `kleuren`, `type`, `gesigneerd`, `uitgever`, `auteursrecht`, `paginas`, `kaft`, `ISBN`, `land`, `taal`, `gesloten_hoogte`, `gesloten_breedte`, `open_hoogte`, `open_breedte`, `beschrijving`, `status`, `zaal`)
                    VALUES
                    (:itemId, :photo, :titel, :serie, :serieNummer, :datum, :periode, :scenario, :tekeningen, :kleuren, :type, :gesigneerd, :uitgever, :auteursrecht, :paginas, :kaft, :ISBN, :land, :taal, :gesloten_hoogte, :gesloten_breedte, :open_hoogte, :open_breedte, :beschrijving, :status, :zaal)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':itemId', $data['itemId']);
            $stmt->bindValue(':photo', $data['photo']);
            $stmt->bindValue(':titel', $data['titel']);
            $stmt->bindValue(':serie', $data['serie']);
            $stmt->bindValue(':serieNummer', $data['serieNummer']);
            $stmt->bindValue(':datum', $data['datum']);
            $stmt->bindValue(':periode', $data['periode']);
            $stmt->bindValue(':scenario', $data['scenario']);
            $stmt->bindValue(':tekeningen', $data['tekeningen']);
            $stmt->bindValue(':kleuren', $data['kleuren']);
            $stmt->bindValue(':type', $data['type']);
            $stmt->bindValue(':gesigneerd', $data['gesigneerd']);
            $stmt->bindValue(':uitgever', $data['uitgever']);
            $stmt->bindValue(':auteursrecht', $data['auteursrecht']);
            $stmt->bindValue(':paginas', $data['paginas']);
            $stmt->bindValue(':kaft', $data['kaft']);
            $stmt->bindValue(':ISBN', $data['ISBN']);
            $stmt->bindValue(':land', $data['land']);
            $stmt->bindValue(':taal', $data['taal']);
            $stmt->bindValue(':gesloten_hoogte', $data['gesloten_hoogte']);
            $stmt->bindValue(':gesloten_breedte', $data['gesloten_breedte']);
            $stmt->bindValue(':open_hoogte', $data['open_hoogte']);
            $stmt->bindValue(':open_breedte', $data['open_breedte']);
            $stmt->bindValue(':beschrijving', $data['beschrijving']);
            $stmt->bindValue(':status', $data['status']);
            $stmt->bindValue(':zaal', $data['zaal']);
            $stmt->execute();

            $sql = "INSERT INTO `strip_backup` 
                    (`itemId`, `photo`, `titel`, `serie`, `serie-nummer`, `datum`, `periode`, `scenario`, `tekeningen`, `kleuren`, `type`, `gesigneerd`, `uitgever`, `auteursrecht`, `paginas`, `kaft`, `ISBN`, `land`, `taal`, `gesloten_hoogte`, `gesloten_breedte`, `open_hoogte`, `open_breedte`, `beschrijving`, `status`, `zaal`)
                    VALUES
                    (:itemId, :photo, :titel, :serie, :serieNummer, :datum, :periode, :scenario, :tekeningen, :kleuren, :type, :gesigneerd, :uitgever, :auteursrecht, :paginas, :kaft, :ISBN, :land, :taal, :gesloten_hoogte, :gesloten_breedte, :open_hoogte, :open_breedte, :beschrijving, :status, :zaal)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':itemId', $data['itemId']);
            $stmt->bindValue(':photo', $data['photo']);
            $stmt->bindValue(':titel', $data['titel']);
            $stmt->bindValue(':serie', $data['serie']);
            $stmt->bindValue(':serieNummer', $data['serieNummer']);
            $stmt->bindValue(':datum', $data['datum']);
            $stmt->bindValue(':periode', $data['periode']);
            $stmt->bindValue(':scenario', $data['scenario']);
            $stmt->bindValue(':tekeningen', $data['tekeningen']);
            $stmt->bindValue(':kleuren', $data['kleuren']);
            $stmt->bindValue(':type', $data['type']);
            $stmt->bindValue(':gesigneerd', $data['gesigneerd']);
            $stmt->bindValue(':uitgever', $data['uitgever']);
            $stmt->bindValue(':auteursrecht', $data['auteursrecht']);
            $stmt->bindValue(':paginas', $data['paginas']);
            $stmt->bindValue(':kaft', $data['kaft']);
            $stmt->bindValue(':ISBN', $data['ISBN']);
            $stmt->bindValue(':land', $data['land']);
            $stmt->bindValue(':taal', $data['taal']);
            $stmt->bindValue(':gesloten_hoogte', $data['gesloten_hoogte']);
            $stmt->bindValue(':gesloten_breedte', $data['gesloten_breedte']);
            $stmt->bindValue(':open_hoogte', $data['open_hoogte']);
            $stmt->bindValue(':open_breedte', $data['open_breedte']);
            $stmt->bindValue(':beschrijving', $data['beschrijving']);
            $stmt->bindValue(':status', $data['status']);
            $stmt->bindValue(':zaal', $data['zaal']);
            $stmt->execute();
        }

        public function addNewPlaat($data){
            $sql = "INSERT INTO `plaat` 
                    (`itemId`, `photo`, `titel`, `serie`, `serie-nummer`, `datum`, `periode`, `scenario`, `tekeningen`, `kleuren`, `type`, `gesigneerd`, `uitgever`, `auteursrecht`, `land`, `taal`, `bruto_hoogte`, `bruto_breedte`, `netto_hoogte`, `netto_breedte`, `beschrijving`, `status`, `zaal`)
                    VALUES
                    (:itemId, :photo, :titel, :serie, :serieNummer, :datum, :periode, :scenario, :tekeningen, :kleuren, :type, :gesigneerd, :uitgever, :auteursrecht, :land, :taal, :bruto_hoogte, :bruto_breedte, :netto_hoogte, :netto_breedte, :beschrijving, :status, :zaal)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':itemId', $data['itemId']);
            $stmt->bindValue(':photo', $data['photo']);
            $stmt->bindValue(':titel', $data['titel']);
            $stmt->bindValue(':serie', $data['serie']);
            $stmt->bindValue(':serieNummer', $data['serieNummer']);
            $stmt->bindValue(':datum', $data['datum']);
            $stmt->bindValue(':periode', $data['periode']);
            $stmt->bindValue(':scenario', $data['scenario']);
            $stmt->bindValue(':tekeningen', $data['tekeningen']);
            $stmt->bindValue(':kleuren', $data['kleuren']);
            $stmt->bindValue(':type', $data['type']);
            $stmt->bindValue(':gesigneerd', $data['gesigneerd']);
            $stmt->bindValue(':uitgever', $data['uitgever']);
            $stmt->bindValue(':auteursrecht', $data['auteursrecht']);
            $stmt->bindValue(':land', $data['land']);
            $stmt->bindValue(':taal', $data['taal']);
            $stmt->bindValue(':bruto_hoogte', $data['bruto_hoogte']);
            $stmt->bindValue(':bruto_breedte', $data['bruto_breedte']);
            $stmt->bindValue(':netto_hoogte', $data['netto_hoogte']);
            $stmt->bindValue(':netto_breedte', $data['netto_breedte']);
            $stmt->bindValue(':beschrijving', $data['beschrijving']);
            $stmt->bindValue(':status', $data['status']);
            $stmt->bindValue(':zaal', $data['zaal']);
            $stmt->execute();

            $sql = "INSERT INTO `plaat_backup` 
            (`itemId`, `photo`, `titel`, `serie`, `serie-nummer`, `datum`, `periode`, `scenario`, `tekeningen`, `kleuren`, `type`, `gesigneerd`, `uitgever`, `auteursrecht`, `land`, `taal`, `bruto_hoogte`, `bruto_breedte`, `netto_hoogte`, `netto_breedte`, `beschrijving`, `status`, `zaal`)
            VALUES
            (:itemId, :photo, :titel, :serie, :serieNummer, :datum, :periode, :scenario, :tekeningen, :kleuren, :type, :gesigneerd, :uitgever, :auteursrecht, :land, :taal, :bruto_hoogte, :bruto_breedte, :netto_hoogte, :netto_breedte, :beschrijving, :status, :zaal)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':itemId', $data['itemId']);
    $stmt->bindValue(':photo', $data['photo']);
    $stmt->bindValue(':titel', $data['titel']);
    $stmt->bindValue(':serie', $data['serie']);
    $stmt->bindValue(':serieNummer', $data['serieNummer']);
    $stmt->bindValue(':datum', $data['datum']);
    $stmt->bindValue(':periode', $data['periode']);
    $stmt->bindValue(':scenario', $data['scenario']);
    $stmt->bindValue(':tekeningen', $data['tekeningen']);
    $stmt->bindValue(':kleuren', $data['kleuren']);
    $stmt->bindValue(':type', $data['type']);
    $stmt->bindValue(':gesigneerd', $data['gesigneerd']);
    $stmt->bindValue(':uitgever', $data['uitgever']);
    $stmt->bindValue(':auteursrecht', $data['auteursrecht']);
    $stmt->bindValue(':land', $data['land']);
    $stmt->bindValue(':taal', $data['taal']);
    $stmt->bindValue(':bruto_hoogte', $data['bruto_hoogte']);
    $stmt->bindValue(':bruto_breedte', $data['bruto_breedte']);
    $stmt->bindValue(':netto_hoogte', $data['netto_hoogte']);
    $stmt->bindValue(':netto_breedte', $data['netto_breedte']);
    $stmt->bindValue(':beschrijving', $data['beschrijving']);
    $stmt->bindValue(':status', $data['status']);
    $stmt->bindValue(':zaal', $data['zaal']);
    $stmt->execute();
        }

        public function addNewObject($data){
            $sql = "INSERT INTO `object` 
                    (`itemId`, `photo`, `titel`, `serie`, `serie-nummer`, `datum`, `periode`, `scenario`, `tekeningen`, `kleuren`, `type`, `materiaal`, `gesigneerd`, `uitgever`, `auteursrecht`, `land`, `taal`, `hoogte`, `breedte`, `diepte`, `diameter`, `beschrijving`, `status`, `zaal`)
                    VALUES
                    (:itemId, :photo, :titel, :serie, :serieNummer, :datum, :periode, :scenario, :tekeningen, :kleuren, :type, :materiaal, :gesigneerd, :uitgever, :auteursrecht, :land, :taal, :hoogte, :breedte, :diepte, :diameter, :beschrijving, :status, :zaal)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':itemId', $data['itemId']);
            $stmt->bindValue(':photo', $data['photo']);
            $stmt->bindValue(':titel', $data['titel']);
            $stmt->bindValue(':serie', $data['serie']);
            $stmt->bindValue(':serieNummer', $data['serieNummer']);
            $stmt->bindValue(':datum', $data['datum']);
            $stmt->bindValue(':periode', $data['periode']);
            $stmt->bindValue(':scenario', $data['scenario']);
            $stmt->bindValue(':tekeningen', $data['tekeningen']);
            $stmt->bindValue(':kleuren', $data['kleuren']);
            $stmt->bindValue(':type', $data['type']);
            $stmt->bindValue(':materiaal', $data['materiaal']);
            $stmt->bindValue(':gesigneerd', $data['gesigneerd']);
            $stmt->bindValue(':uitgever', $data['uitgever']);
            $stmt->bindValue(':auteursrecht', $data['auteursrecht']);
            $stmt->bindValue(':land', $data['land']);
            $stmt->bindValue(':taal', $data['taal']);
            $stmt->bindValue(':hoogte', $data['hoogte']);
            $stmt->bindValue(':breedte', $data['breedte']);
            $stmt->bindValue(':diepte', $data['diepte']);
            $stmt->bindValue(':diameter', $data['diameter']);
            $stmt->bindValue(':beschrijving', $data['beschrijving']);
            $stmt->bindValue(':hoogte',  $data['hoogte']);
            $stmt->bindValue(':breedte', $data['breedte'] );
            $stmt->bindValue(':diameter', $data['diameter']);
            $stmt->bindValue(':diepte', $data['diepte'] );
            $stmt->bindValue(':status', $data['status']);
            $stmt->bindValue(':zaal', $data['zaal']);
            $stmt->execute();

            $sql = "INSERT INTO `object_backup` 
            (`itemId`, `photo`, `titel`, `serie`, `serie-nummer`, `datum`, `periode`, `scenario`, `tekeningen`, `kleuren`, `type`, `materiaal`, `gesigneerd`, `uitgever`, `auteursrecht`, `land`, `taal`, `hoogte`, `breedte`, `diepte`, `diameter`, `beschrijving`, `status`, `zaal`)
            VALUES
            (:itemId, :photo, :titel, :serie, :serieNummer, :datum, :periode, :scenario, :tekeningen, :kleuren, :type, :materiaal, :gesigneerd, :uitgever, :auteursrecht, :land, :taal, :hoogte, :breedte, :diepte, :diameter, :beschrijving, :status, :zaal)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':itemId', $data['itemId']);
    $stmt->bindValue(':photo', $data['photo']);
    $stmt->bindValue(':titel', $data['titel']);
    $stmt->bindValue(':serie', $data['serie']);
    $stmt->bindValue(':serieNummer', $data['serieNummer']);
    $stmt->bindValue(':datum', $data['datum']);
    $stmt->bindValue(':periode', $data['periode']);
    $stmt->bindValue(':scenario', $data['scenario']);
    $stmt->bindValue(':tekeningen', $data['tekeningen']);
    $stmt->bindValue(':kleuren', $data['kleuren']);
    $stmt->bindValue(':type', $data['type']);
    $stmt->bindValue(':materiaal', $data['materiaal']);
    $stmt->bindValue(':gesigneerd', $data['gesigneerd']);
    $stmt->bindValue(':uitgever', $data['uitgever']);
    $stmt->bindValue(':auteursrecht', $data['auteursrecht']);
    $stmt->bindValue(':land', $data['land']);
    $stmt->bindValue(':taal', $data['taal']);
    $stmt->bindValue(':hoogte', $data['hoogte']);
    $stmt->bindValue(':breedte', $data['breedte']);
    $stmt->bindValue(':diepte', $data['diepte']);
    $stmt->bindValue(':diameter', $data['diameter']);
    $stmt->bindValue(':beschrijving', $data['beschrijving']);
    $stmt->bindValue(':hoogte',  $data['hoogte']);
    $stmt->bindValue(':breedte', $data['breedte'] );
    $stmt->bindValue(':diameter', $data['diameter']);
    $stmt->bindValue(':diepte', $data['diepte'] );
    $stmt->bindValue(':status', $data['status']);
    $stmt->bindValue(':zaal', $data['zaal']);
    $stmt->execute();
        }

        public function addNewBoek($data){
            $sql = "INSERT INTO `boek` 
                    (`itemId`, `photo`, `titel`, `serie`, `serie-nummer`, `datum`, `periode`, `scenario`, `tekeningen`, `kleuren`, `type`, `gesigneerd`, `uitgever`, `auteursrecht`, `paginas`, `kaft`, `ISBN`, `land`, `taal`, `gesloten_hoogte`, `gesloten_breedte`, `open_hoogte`, `open_breedte`, `beschrijving`, `status`, `zaal`)
                    VALUES
                    (:itemId, :photo, :titel, :serie, :serieNummer, :datum, :periode, :scenario, :tekeningen, :kleuren, :type, :gesigneerd, :uitgever, :auteursrecht, :paginas, :kaft, :ISBN, :land, :taal, :gesloten_hoogte, :gesloten_breedte, :open_hoogte, :open_breedte, :beschrijving, :status, :zaal)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':itemId', $data['itemId']);
            $stmt->bindValue(':photo', $data['photo']);
            $stmt->bindValue(':titel', $data['titel']);
            $stmt->bindValue(':serie', $data['serie']);
            $stmt->bindValue(':serieNummer', $data['serieNummer']);
            $stmt->bindValue(':datum', $data['datum']);
            $stmt->bindValue(':periode', $data['periode']);
            $stmt->bindValue(':scenario', $data['scenario']);
            $stmt->bindValue(':tekeningen', $data['tekeningen']);
            $stmt->bindValue(':kleuren', $data['kleuren']);
            $stmt->bindValue(':type', $data['type']);
            $stmt->bindValue(':gesigneerd', $data['gesigneerd']);
            $stmt->bindValue(':uitgever', $data['uitgever']);
            $stmt->bindValue(':auteursrecht', $data['auteursrecht']);
            $stmt->bindValue(':paginas', $data['paginas']);
            $stmt->bindValue(':kaft', $data['kaft']);
            $stmt->bindValue(':ISBN', $data['ISBN']);
            $stmt->bindValue(':land', $data['land']);
            $stmt->bindValue(':taal', $data['taal']);
            $stmt->bindValue(':gesloten_hoogte', $data['gesloten_hoogte']);
            $stmt->bindValue(':gesloten_breedte', $data['gesloten_breedte']);
            $stmt->bindValue(':open_hoogte', $data['open_hoogte']);
            $stmt->bindValue(':open_breedte', $data['open_breedte']);
            $stmt->bindValue(':beschrijving', $data['beschrijving']);
            $stmt->bindValue(':status', $data['status']);
            $stmt->bindValue(':zaal', $data['zaal']);
            $stmt->execute();

            $sql = "INSERT INTO `boek_backup` 
            (`itemId`, `photo`, `titel`, `serie`, `serie-nummer`, `datum`, `periode`, `scenario`, `tekeningen`, `kleuren`, `type`, `gesigneerd`, `uitgever`, `auteursrecht`, `paginas`, `kaft`, `ISBN`, `land`, `taal`, `gesloten_hoogte`, `gesloten_breedte`, `open_hoogte`, `open_breedte`, `beschrijving`, `status`, `zaal`)
            VALUES
            (:itemId, :photo, :titel, :serie, :serieNummer, :datum, :periode, :scenario, :tekeningen, :kleuren, :type, :gesigneerd, :uitgever, :auteursrecht, :paginas, :kaft, :ISBN, :land, :taal, :gesloten_hoogte, :gesloten_breedte, :open_hoogte, :open_breedte, :beschrijving, :status, :zaal)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':itemId', $data['itemId']);
    $stmt->bindValue(':photo', $data['photo']);
    $stmt->bindValue(':titel', $data['titel']);
    $stmt->bindValue(':serie', $data['serie']);
    $stmt->bindValue(':serieNummer', $data['serieNummer']);
    $stmt->bindValue(':datum', $data['datum']);
    $stmt->bindValue(':periode', $data['periode']);
    $stmt->bindValue(':scenario', $data['scenario']);
    $stmt->bindValue(':tekeningen', $data['tekeningen']);
    $stmt->bindValue(':kleuren', $data['kleuren']);
    $stmt->bindValue(':type', $data['type']);
    $stmt->bindValue(':gesigneerd', $data['gesigneerd']);
    $stmt->bindValue(':uitgever', $data['uitgever']);
    $stmt->bindValue(':auteursrecht', $data['auteursrecht']);
    $stmt->bindValue(':paginas', $data['paginas']);
    $stmt->bindValue(':kaft', $data['kaft']);
    $stmt->bindValue(':ISBN', $data['ISBN']);
    $stmt->bindValue(':land', $data['land']);
    $stmt->bindValue(':taal', $data['taal']);
    $stmt->bindValue(':gesloten_hoogte', $data['gesloten_hoogte']);
    $stmt->bindValue(':gesloten_breedte', $data['gesloten_breedte']);
    $stmt->bindValue(':open_hoogte', $data['open_hoogte']);
    $stmt->bindValue(':open_breedte', $data['open_breedte']);
    $stmt->bindValue(':beschrijving', $data['beschrijving']);
    $stmt->bindValue(':status', $data['status']);
    $stmt->bindValue(':zaal', $data['zaal']);
    $stmt->execute();
        }

        public function addNewBeeld($data){
            $sql = "INSERT INTO `beeld` 
                    (`itemId`, `photo`, `titel`, `serie`, `serie-nummer`, `datum`, `periode`, `scenario`, `tekeningen`, `kleuren`, `beeldhouder`, `type`, `materiaal`, `gesigneerd`, `uitgever`, `auteursrecht`, `land`, `taal`, `hoogte`, `breedte`, `diepte`, `diameter`, `beschrijving`, `status`, `zaal`)
                    VALUES
                    (:itemId, :photo, :titel, :serie, :serieNummer, :datum, :periode, :scenario, :tekeningen, :kleuren, :beeldhouder, :type, :materiaal, :gesigneerd, :uitgever, :auteursrecht, :land, :taal, :hoogte, :breedte, :diepte, :diameter, :beschrijving, :status, :zaal)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':itemId', $data['itemId']);
            $stmt->bindValue(':photo', $data['photo']);
            $stmt->bindValue(':titel', $data['titel']);
            $stmt->bindValue(':serie', $data['serie']);
            $stmt->bindValue(':serieNummer', $data['serieNummer']);
            $stmt->bindValue(':datum', $data['datum']);
            $stmt->bindValue(':periode', $data['periode']);
            $stmt->bindValue(':scenario', $data['scenario']);
            $stmt->bindValue(':tekeningen', $data['tekeningen']);
            $stmt->bindValue(':kleuren', $data['kleuren']);
            $stmt->bindValue(':beeldhouder', $data['beeldhouder']);
            $stmt->bindValue(':type', $data['type']);
            $stmt->bindValue(':materiaal', $data['materiaal']);
            $stmt->bindValue(':gesigneerd', $data['gesigneerd']);
            $stmt->bindValue(':uitgever', $data['uitgever']);
            $stmt->bindValue(':auteursrecht', $data['auteursrecht']);
            $stmt->bindValue(':land', $data['land']);
            $stmt->bindValue(':taal', $data['taal']);
            $stmt->bindValue(':hoogte', $data['hoogte']);
            $stmt->bindValue(':breedte', $data['breedte']);
            $stmt->bindValue(':diepte', $data['diepte']);
            $stmt->bindValue(':diameter', $data['diameter']);
            $stmt->bindValue(':beschrijving', $data['beschrijving']);
            $stmt->bindValue(':status', $data['status']);
            $stmt->bindValue(':zaal', $data['zaal']);
            $stmt->execute();

            $sql = "INSERT INTO `beeld_backup` 
            (`itemId`, `photo`, `titel`, `serie`, `serie-nummer`, `datum`, `periode`, `scenario`, `tekeningen`, `kleuren`, `beeldhouder`, `type`, `materiaal`, `gesigneerd`, `uitgever`, `auteursrecht`, `land`, `taal`, `hoogte`, `breedte`, `diepte`, `diameter`, `beschrijving`, `status`, `zaal`)
            VALUES
            (:itemId, :photo, :titel, :serie, :serieNummer, :datum, :periode, :scenario, :tekeningen, :kleuren, :beeldhouder, :type, :materiaal, :gesigneerd, :uitgever, :auteursrecht, :land, :taal, :hoogte, :breedte, :diepte, :diameter, :beschrijving, :status, :zaal)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':itemId', $data['itemId']);
    $stmt->bindValue(':photo', $data['photo']);
    $stmt->bindValue(':titel', $data['titel']);
    $stmt->bindValue(':serie', $data['serie']);
    $stmt->bindValue(':serieNummer', $data['serieNummer']);
    $stmt->bindValue(':datum', $data['datum']);
    $stmt->bindValue(':periode', $data['periode']);
    $stmt->bindValue(':scenario', $data['scenario']);
    $stmt->bindValue(':tekeningen', $data['tekeningen']);
    $stmt->bindValue(':kleuren', $data['kleuren']);
    $stmt->bindValue(':beeldhouder', $data['beeldhouder']);
    $stmt->bindValue(':type', $data['type']);
    $stmt->bindValue(':materiaal', $data['materiaal']);
    $stmt->bindValue(':gesigneerd', $data['gesigneerd']);
    $stmt->bindValue(':uitgever', $data['uitgever']);
    $stmt->bindValue(':auteursrecht', $data['auteursrecht']);
    $stmt->bindValue(':land', $data['land']);
    $stmt->bindValue(':taal', $data['taal']);
    $stmt->bindValue(':hoogte', $data['hoogte']);
    $stmt->bindValue(':breedte', $data['breedte']);
    $stmt->bindValue(':diepte', $data['diepte']);
    $stmt->bindValue(':diameter', $data['diameter']);
    $stmt->bindValue(':beschrijving', $data['beschrijving']);
    $stmt->bindValue(':status', $data['status']);
    $stmt->bindValue(':zaal', $data['zaal']);
    $stmt->execute();
        }


        public function deleteStrip($itemId){
            $sql = "DELETE FROM `strip` WHERE `itemId` = :itemId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':itemId', $itemId);
            $stmt->execute();
        }

        public function deletePlaat($itemId){
            $sql = "DELETE FROM `plaat` WHERE `itemId` = :itemId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':itemId', $itemId);
            $stmt->execute(); 
        }

        public function deleteObject($itemId){
            $sql = "DELETE FROM `object` WHERE `itemId` = :itemId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue('itemId', $itemId);
            $stmt->execute();
        }

        public function deleteBoek($itemId){
            $sql = "DELETE FROM `boek` WHERE `itemId` = :itemId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue('itemId', $itemId);
            $stmt->execute();
        }

        public function deleteBeeld($itemId){
            $sql = "DELETE FROM `beeld` WHERE `itemId` = :itemId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue('itemId', $itemId);
            $stmt->execute();
        }

        public function getStripByItemiD($itemId){
            $sql = "SELECT * FROM `strip` WHERE `itemId` = :itemId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue('itemId', $itemId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }

        public function getPlaatByItemiD($itemId){
            $sql = "SELECT * FROM `plaat` WHERE `itemId` = :itemId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue('itemId', $itemId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }

        public function getObjectByItemiD($itemId){
            $sql = "SELECT * FROM `object` WHERE `itemId` = :itemId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue('itemId', $itemId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }

        public function getBoekByItemiD($itemId){
            $sql = "SELECT * FROM `boek` WHERE `itemId` = :itemId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue('itemId', $itemId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }

        public function getBeeldByItemiD($itemId){
            $sql = "SELECT * FROM `beeld` WHERE `itemId` = :itemId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue('itemId', $itemId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function updateStrip($data, $photo){
            $sql = "UPDATE `strip` SET 
                    `photo` = :photo,
                    `titel` = :titel,
                    `serie` = :serie,
                    `serie-nummer` = :serieNummer,
                    `datum` = :datum,
                    `periode` = :periode,
                    `scenario` = :scenario,
                    `tekeningen` = :tekeningen,
                    `kleuren` = :kleuren,
                    `type` = :type,
                    `gesigneerd` = :gesigneerd,
                    `uitgever` = :uitgever,
                    `auteursrecht` = :auteursrecht,
                    `paginas` = :paginas,
                    `kaft` = :kaft,
                    `ISBN` = :ISBN,
                    `land` = :land,
                    `taal` = :taal,
                    `gesloten_hoogte` = :gesloten_hoogte,
                    `gesloten_breedte` = :gesloten_breedte,
                    `open_hoogte` = :open_hoogte,
                    `open_breedte` = :open_breedte,
                    `beschrijving` = :beschrijving,
                    `status` = :status,
                    `zaal` = :zaal
                    WHERE `itemId` = :itemId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':itemId', $data['itemId']);
            $stmt->bindValue(':photo', $photo);
            $stmt->bindValue(':titel', $data['titel']);
            $stmt->bindValue(':serie', $data['serie']);
            $stmt->bindValue(':serieNummer', $data['serieNummer']);
            $stmt->bindValue(':datum', $data['datum']);
            $stmt->bindValue(':periode', $data['periode']);
            $stmt->bindValue(':scenario', $data['scenario']);
            $stmt->bindValue(':tekeningen', $data['tekeningen']);
            $stmt->bindValue(':kleuren', $data['kleuren']);
            $stmt->bindValue(':type', $data['type']);
            $stmt->bindValue(':gesigneerd', $data['gesigneerd']);
            $stmt->bindValue(':uitgever', $data['uitgever']);
            $stmt->bindValue(':auteursrecht', $data['auteursrecht']);
            $stmt->bindValue(':paginas', $data['paginas']);
            $stmt->bindValue(':kaft', $data['kaft']);
            $stmt->bindValue(':ISBN', $data['ISBN']);
            $stmt->bindValue(':land', $data['land']);
            $stmt->bindValue(':taal', $data['taal']);
            $stmt->bindValue(':gesloten_hoogte', $data['gesloten_hoogte']);
            $stmt->bindValue(':gesloten_breedte', $data['gesloten_breedte']);
            $stmt->bindValue(':open_hoogte', $data['open_hoogte']);
            $stmt->bindValue(':open_breedte', $data['open_breedte']);
            $stmt->bindValue(':beschrijving', $data['beschrijving']);
            $stmt->bindValue(':status', $data['status']);
            $stmt->bindValue(':zaal', $data['zaal']);
            $stmt->execute();
        }

        public function updatePlaat($data, $photo){
            $sql = "UPDATE `plaat` SET 
                `photo` = :photo,
                `titel` = :titel,
                `serie` = :serie,
                `serie-nummer` = :serieNummer,
                `datum` = :datum,
                `periode` = :periode,
                `scenario` = :scenario,
                `tekeningen` = :tekeningen,
                `kleuren` = :kleuren,
                `type` = :type,
                `gesigneerd` = :gesigneerd,
                `uitgever` = :uitgever,
                `auteursrecht` = :auteursrecht,
                `land` = :land,
                `taal` = :taal,
                `bruto_hoogte` = :bruto_hoogte,
                `bruto_breedte` = :bruto_breedte,
                `netto_hoogte` = :netto_hoogte,
                `netto_breedte` = :netto_breedte,
                `beschrijving` = :beschrijving,
                `status` = :status,
                `zaal` = :zaal
                WHERE `itemId` = :itemId"; 
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':itemId', $data['itemId']);
            $stmt->bindValue(':photo', $photo);
            $stmt->bindValue(':titel', $data['titel']);
            $stmt->bindValue(':serie', $data['serie']);
            $stmt->bindValue(':serieNummer', $data['serieNummer']);
            $stmt->bindValue(':datum', $data['datum']);
            $stmt->bindValue(':periode', $data['periode']);
            $stmt->bindValue(':scenario', $data['scenario']);
            $stmt->bindValue(':tekeningen', $data['tekeningen']);
            $stmt->bindValue(':kleuren', $data['kleuren']);
            $stmt->bindValue(':type', $data['type']);
            $stmt->bindValue(':gesigneerd', $data['gesigneerd']);
            $stmt->bindValue(':uitgever', $data['uitgever']);
            $stmt->bindValue(':auteursrecht', $data['auteursrecht']);
            $stmt->bindValue(':land', $data['land']);
            $stmt->bindValue(':taal', $data['taal']);
            $stmt->bindValue(':bruto_hoogte', $data['bruto_hoogte']);
            $stmt->bindValue(':bruto_breedte', $data['bruto_breedte']);
            $stmt->bindValue(':netto_hoogte', $data['netto_hoogte']);
            $stmt->bindValue(':netto_breedte', $data['netto_breedte']);
            $stmt->bindValue(':beschrijving', $data['beschrijving']);
            $stmt->bindValue(':status', $data['status']);
            $stmt->bindValue(':zaal', $data['zaal']);
            $stmt->execute();
        }

        public function updateObject($data, $photo){
            $sql = "UPDATE `object` SET 
                `photo` = :photo,
                `titel` = :titel,
                `serie` = :serie,
                `serie-nummer` = :serieNummer,
                `datum` = :datum,
                `periode` = :periode,
                `scenario` = :scenario,
                `tekeningen` = :tekeningen,
                `kleuren` = :kleuren,
                `type` = :type,
                `materiaal` = :materiaal,
                `gesigneerd` = :gesigneerd,
                `uitgever` = :uitgever,
                `auteursrecht` = :auteursrecht,
                `land` = :land,
                `taal` = :taal,
                `hoogte` = :hoogte,
                `breedte` = :breedte,
                `diepte` = :diepte,
                `diameter` = :diameter,
                `beschrijving` = :beschrijving,
                `status` = :status,
                `zaal` = :zaal
                WHERE `itemId` = :itemId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':itemId', $data['itemId']);
            $stmt->bindValue(':photo', $photo);
            $stmt->bindValue(':titel', $data['titel']);
            $stmt->bindValue(':serie', $data['serie']);
            $stmt->bindValue(':serieNummer', $data['serieNummer']);
            $stmt->bindValue(':datum', $data['datum']);
            $stmt->bindValue(':periode', $data['periode']);
            $stmt->bindValue(':scenario', $data['scenario']);
            $stmt->bindValue(':tekeningen', $data['tekeningen']);
            $stmt->bindValue(':kleuren', $data['kleuren']);
            $stmt->bindValue(':type', $data['type']);
            $stmt->bindValue(':materiaal', $data['materiaal']);
            $stmt->bindValue(':gesigneerd', $data['gesigneerd']);
            $stmt->bindValue(':uitgever', $data['uitgever']);
            $stmt->bindValue(':auteursrecht', $data['auteursrecht']);
            $stmt->bindValue(':land', $data['land']);
            $stmt->bindValue(':taal', $data['taal']);
            $stmt->bindValue(':hoogte', $data['hoogte']);
            $stmt->bindValue(':breedte', $data['breedte']);
            $stmt->bindValue(':diepte', $data['diepte']);
            $stmt->bindValue(':diameter', $data['diameter']);
            $stmt->bindValue(':beschrijving', $data['beschrijving']);
            $stmt->bindValue(':hoogte', $data['hoogte']);
            $stmt->bindValue(':breedte', $data['breedte'] );
            $stmt->bindValue(':diameter', $data['diameter'] );
            $stmt->bindValue(':diepte', $data['diepte'] );
            $stmt->bindValue(':status', $data['status']);
            $stmt->bindValue(':zaal', $data['zaal']);
            $stmt->execute();  
        }

        public function updateBoek($data, $photo){
            $sql = "UPDATE `boek` SET 
                `photo` = :photo,
                `titel` = :titel,
                `serie` = :serie,
                `serie-nummer` = :serieNummer,
                `datum` = :datum,
                `periode` = :periode,
                `scenario` = :scenario,
                `tekeningen` = :tekeningen,
                `kleuren` = :kleuren,
                `type` = :type,
                `gesigneerd` = :gesigneerd,
                `uitgever` = :uitgever,
                `auteursrecht` = :auteursrecht,
                `paginas` = :paginas,
                `kaft` = :kaft,
                `ISBN` = :ISBN,
                `land` = :land,
                `taal` = :taal,
                `gesloten_hoogte` = :gesloten_hoogte,
                `gesloten_breedte` = :gesloten_breedte,
                `open_hoogte` = :open_hoogte,
                `open_breedte` = :open_breedte,
                `beschrijving` = :beschrijving,
                `status` = :status,
                `zaal` = :zaal
                WHERE `itemId` = :itemId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':itemId', $data['itemId']);
            $stmt->bindValue(':photo', $photo);
            $stmt->bindValue(':titel', $data['titel']);
            $stmt->bindValue(':serie', $data['serie']);
            $stmt->bindValue(':serieNummer', $data['serieNummer']);
            $stmt->bindValue(':datum', $data['datum']);
            $stmt->bindValue(':periode', $data['periode']);
            $stmt->bindValue(':scenario', $data['scenario']);
            $stmt->bindValue(':tekeningen', $data['tekeningen']);
            $stmt->bindValue(':kleuren', $data['kleuren']);
            $stmt->bindValue(':type', $data['type']);
            $stmt->bindValue(':gesigneerd', $data['gesigneerd']);
            $stmt->bindValue(':uitgever', $data['uitgever']);
            $stmt->bindValue(':auteursrecht', $data['auteursrecht']);
            $stmt->bindValue(':paginas', $data['paginas']);
            $stmt->bindValue(':kaft', $data['kaft']);
            $stmt->bindValue(':ISBN', $data['ISBN']);
            $stmt->bindValue(':land', $data['land']);
            $stmt->bindValue(':taal', $data['taal']);
            $stmt->bindValue(':gesloten_hoogte', $data['gesloten_hoogte']);
            $stmt->bindValue(':gesloten_breedte', $data['gesloten_breedte']);
            $stmt->bindValue(':open_hoogte', $data['open_hoogte']);
            $stmt->bindValue(':open_breedte', $data['open_breedte']);
            $stmt->bindValue(':beschrijving', $data['beschrijving']);
            $stmt->bindValue(':status', $data['status']);
            $stmt->bindValue(':zaal', $data['zaal']);
            $stmt->execute();
        }

        public function updateBeeld($data, $photo){
            $sql = "UPDATE `beeld` SET 
                `photo` = :photo,
                `titel` = :titel,
                `serie` = :serie,
                `serie-nummer` = :serieNummer,
                `datum` = :datum,
                `periode` = :periode,
                `scenario` = :scenario,
                `tekeningen` = :tekeningen,
                `kleuren` = :kleuren,
                `beeldhouder` = :beeldhouder,
                `type` = :type,
                `materiaal` = :materiaal,
                `gesigneerd` = :gesigneerd,
                `uitgever` = :uitgever,
                `auteursrecht` = :auteursrecht,
                `land` = :land,
                `taal` = :taal,
                `hoogte` = :hoogte,
                `breedte` = :breedte,
                `diepte` = :diepte,
                `diameter` = :diameter,
                `beschrijving` = :beschrijving,
                `status` = :status,
                `zaal` = :zaal
                WHERE `itemId` = :itemId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':itemId', $data['itemId']);
            $stmt->bindValue(':photo', $photo);
            $stmt->bindValue(':titel', $data['titel']);
            $stmt->bindValue(':serie', $data['serie']);
            $stmt->bindValue(':serieNummer', $data['serieNummer']);
            $stmt->bindValue(':datum', $data['datum']);
            $stmt->bindValue(':periode', $data['periode']);
            $stmt->bindValue(':scenario', $data['scenario']);
            $stmt->bindValue(':tekeningen', $data['tekeningen']);
            $stmt->bindValue(':kleuren', $data['kleuren']);
            $stmt->bindValue(':beeldhouder', $data['beeldhouder']);
            $stmt->bindValue(':type', $data['type']);
            $stmt->bindValue(':materiaal', $data['materiaal']);
            $stmt->bindValue(':gesigneerd', $data['gesigneerd']);
            $stmt->bindValue(':uitgever', $data['uitgever']);
            $stmt->bindValue(':auteursrecht', $data['auteursrecht']);
            $stmt->bindValue(':land', $data['land']);
            $stmt->bindValue(':taal', $data['taal']);
            $stmt->bindValue(':hoogte', $data['hoogte']);
            $stmt->bindValue(':breedte', $data['breedte']);
            $stmt->bindValue(':diepte', $data['diepte']);
            $stmt->bindValue(':diameter', $data['diameter']);
            $stmt->bindValue(':beschrijving', $data['beschrijving']);
            $stmt->bindValue(':status', $data['status']);
            $stmt->bindValue(':zaal', $data['zaal']);
            $stmt->execute();
        }

        public function getAllBulk(){
            $sql = "SELECT * FROM `bulk`";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function deleteAllBulk(){
            $sql = "TRUNCATE TABLE `bulk`";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        }

        public function getRecentBulk(){
            $date = $this->getMostRecentBulkDate();
            $sql = "SELECT * FROM `bulk` WHERE `time` = :time";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':time', $date['time']);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function deleteRecentBulk(){
            $date = $this->getMostRecentBulkDate();
            $sql = "DELETE FROM `bulk` WHERE `time` = :time";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':time', $date['time']);
            $stmt->execute();
        }

        public function getMostRecentBulkDate() {
            $sql = "SELECT `time` FROM `bulk` ORDER BY `id` DESC limit 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
        public function getBulkOnCategory($category) {
            $sql = "SELECT * FROM `bulk` WHERE `category` = :category";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':category', $category);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function deleteBulkOnCategory($category){
            $sql = "DELETE FROM `bulk` WHERE `category` = :category";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':category', $category);
            $stmt->execute();
        }
    }
?>
