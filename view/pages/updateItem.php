<?php if($_SESSION['currentUser']): if(!empty($item)):?>
    <article class="updateItems">
    <h2 class="pageTitle">Item wijzigen</h2>
    <form  action="<?php if($_POST['location'] === 'list'){ echo "index.php?page=results&view=list";} if($_POST['location'] === "fiche"){ echo "index.php?page=results&view=fiche&id=" . $item['itemId'] . "&key=" . $_POST['key']; } ?>" method="POST" enctype="multipart/form-data">
        <span class="js__error admin__addBulk--error"></span>
        <input type="hidden" name="category" value="<?php echo $cat; ?>">
        <div class="updateItems__container">
        <section>
        <div class="advancedSearch__items">
            <h3 class="smallTitle">Algemeen</h3>
            <label class="inputTitle" for="id">Foto *</label>
            <input type="file" accept="image/png, image/jpeg, image/tiff" name="images[]" id="images">
            <input type="hidden" name="oldPhoto" value="<?php echo $item["photo"] ?>">
            <label class="inputTitle" for="id">ID *</label>
            <input class="inputField__search inputField__search--small" type="text" name="itemId" value="<?php echo $item["itemId"]; ?>" required>
            <label class="inputTitle" for="titel">Titel*</label>
            <input class="inputField__search inputField__search--large" type="text" name="titel" value="<?php echo $item["titel"]; ?>" required>
            <label class="inputTitle" for="serie">Serie</label>
            <input class="inputField__search inputField__search--large" type="text" name="serie" value="<?php if(!empty($item["serie"])){ echo $item["serie"]; }?>">
            <label class="inputTitle" for="SerieNummer">Serie Nummer</label>
            <input class="inputField__search inputField__search--large" type="number" name="serieNummer" value="<?php if(!empty($item["serie-nummer"])){ echo $item["serie-nummer"];} ?>">
            <label class="inputTitle" for="datum">Datum</label>
            <input class="inputField__search inputField__search--large" type="text" name="datum" value="<?php if(!empty($item['datum'])){ echo $item["datum"];}?>">
            <label class="inputTitle" for="periode">Periode *</label>
            <select class="inputField__search inputField__search--large" name="periode" required >
                <option value=" ">-- kies een optie --</option>
                <?php foreach($periodes as $periode): ?>
                <option value="<?php echo $periode['value']; ?>" <?php if($item['periode'] === $periode['value']){ echo " selected";} ?>><?php echo $periode['value']; ?></option>
                <?php endforeach; ?>
            </select>
            <label class="inputTitle" for="land">Land *</label>
            <span class="js__input--error"></span>
            <input type="text" class="inputField__search inputField__search--large inputfield__countries" list="countries" name="land"  autocomplete="off" value="<?php echo $item["land"]; ?>" required>        
            <datalist id="countries" class="datalist__countries"></datalist>       
            <label class="inputTitle" for="taal">Taal *</label>
            <select class="inputField__search inputField__search--large" name="taal" required >
                <option value=" ">-- kies een optie --</option>
                <?php foreach($talen as $taal): ?>
                <option value="<?php echo $taal['value']; ?>" <?php if($item['taal'] === $taal['value']){ echo " selected";} ?> ><?php echo $taal['value']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php if($cat !== 'Alle'): ?>
            <div class="advancedSearch__items">
                <h3 class="smallTitle">Formaat</h3>
                <?php if($cat === "Strips" || $cat === "Boeken"): ?>
                <label class="inputTitle" for="closed_h">Gesloten *</label>
                <div class="input__size--container">
                    <input class="inputField__search inputField__search--small" type="text" name="gesloten_hoogte" step="0.01" value="<?php echo $item['gesloten_hoogte']; ?>"  required>
                    <span class="inputTitle inputField__spacer">x</span>
                    <input class="inputField__search inputField__search--small" type="text" name="gesloten_breedte" step="0.01" value="<?php echo $item['gesloten_breedte']; ?>" required>
                </div>
                    <label class="inputTitle" for="open_h">Open *</label>
                    <div class="input__size--container">
                    <input class="inputField__search inputField__search--small" type="text" name="open_hoogte" step="0.01" value="<?php echo $item['open_hoogte']; ?>" required>
                    <span class="inputTitle inputField__spacer">x</span>
                    <input class="inputField__search inputField__search--small" type="text" name="open_breedte" step="0.01" value="<?php echo $item['open_breedte']; ?>" required>
                </div>    
                <?php endif; ?>
                <?php if($cat === "Platen"): ?>
                <label class="inputTitle" for="closed_h">Bruto (met rand) *</label>
                <div class="input__size--container">
                    <input class="inputField__search inputField__search--small" type="text" name="bruto_hoogte" step="0.01" value="<?php echo $item['bruto_hoogte']; ?>" required>
                    <span class="inputTitle inputField__spacer">x</span>
                    <input class="inputField__search inputField__search--small" type="text" name="bruto_breedte" step="0.01" value="<?php echo $item['bruto_breedte']; ?>" required>
                </div>
                <label class="inputTitle" for="open_h">Netto (zonder rand) *</label>
                <div class="input__size--container">
                    <input class="inputField__search inputField__search--small" type="text" name="netto_hoogte" step="0.01" value="<?php echo $item['netto_hoogte']; ?>" required>
                    <span class="inputTitle inputField__spacer">x</span>
                    <input class="inputField__search inputField__search--small" type="text" name="netto_breedte" step="0.01" value="<?php echo $item['netto_breedte']; ?>" required>
                </div>    
                <?php endif; ?>
                <?php if($cat === "Objecten" || $cat === "Beelden"): ?>
                <div class="input_objects--container">
                    <div class="input_objects--items">
                        <div class="input_objects--item"> 
                            <label class="inputTitle" for="hoogte">Hoogte *</label>
                            <input class="inputField__search inputField__search--small" type="text" name="hoogte" step="0.01" value="<?php echo $item['hoogte']; ?>" required>
                        </div>
                        <div class="input_objects--item">
                            <label class="inputTitle" for="breedte">Breedte *</label>
                            <input class="inputField__search inputField__search--small" type="text" name="breedte" step="0.01" value="<?php echo $item['breedte']; ?>" required>
                        </div>
                    </div>
                    <div class="input_objects--items">
                        <div class="input_objects--item">
                            <label class="inputTitle" for="diepte">Diepte *</label>
                            <input class="inputField__search inputField__search--small" type="text" name="diepte" step="0.01" value="<?php echo $item['diepte']; ?>" required>
                        </div>
                        <div class="input_objects--item">
                            <label class="inputTitle" for="diameter">Diameter *</label>
                            <input class="inputField__search inputField__search--small" type="text" name="diameter" step="0.01" value="<?php echo $item['diameter'] ?>" required>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        <?php  endif;?>
        </section>
        <section>
        <div class="advancedSearch__items">
            <h3 class="smallTitle">Artiest</h3>
            <label class="inputTitle" for="scenario">Scenario *</label>
            <span class="js__input--error"></span>
            <input type="text" class="inputField__search inputField__search--large inputfield__scenario" list="scenario" name="scenario"  autocomplete="off" value="<?php echo $item['scenario']; ?>" required> 
            <datalist id="scenario" class="datalist__scenario"></datalist>
            <label class="inputTitle" for="tekeningen">Tekeningen *</label>
            <span class="js__input--error"></span>
            <input type="text" class="inputField__search inputField__search--large inputfield__tekeningen" list="tekeningen" name="tekeningen"  autocomplete="off" value="<?php echo $item['tekeningen']; ?>" required> 
            <datalist id="tekeningen" class="datalist__tekeningen"></datalist>
            <label class="inputTitle" for="kleuren">Kleuren</label>
            <span class="js__input--error"></span>
            <input type="text" class="inputField__search inputField__search--large inputfield__kleuren" list="kleuren" name="kleuren"  autocomplete="off" value="<?php if(!empty($item['kleuren'])){ echo $item['kleuren'];}?>"> 
            <datalist id="kleuren" class="datalist__kleuren"></datalist>
            <label class="inputTitle" for="type">Type *</label>
            <select class="inputField__search inputField__search--large" name="type" required>
                <option value=" "> -- Kies een optie -- </option>
                <?php if(substr($item['itemId'], 0, 2) === '01'): foreach($typeStrip as $strip): ?>
                    <option value="<?php echo $strip['value'] ?>" <?php if($item['type'] === $strip['value']){ echo ' selected';} ?>><?php echo $strip['value']; ?></option>
                <?php endforeach; endif; ?> 
                <?php if(substr($item['itemId'], 0, 2) === '04'): foreach($typeBoek as $boek): ?>
                    <option value="<?php echo $boek['value'] ?>" <?php if($item['type'] === $boek['value']){ echo ' selected';} ?>><?php echo $boek['value']; ?></option>
                <?php endforeach; endif; ?>
                <?php if(substr($item['itemId'], 0, 2) === '03' || substr($item['itemId'], 0, 2) === '05'): foreach($typeObjectBeeld as $object): ?>
                    <option value="<?php echo $object['value'] ?>" <?php if($item['type'] === $object['value']){ echo ' selected';} ?>><?php echo $object['value']; ?></option>
                <?php endforeach; endif; ?>
                <?php if(substr($item['itemId'], 0, 2) === '02'): foreach($typePlaat as $plaat): ?>
                    <option value="<?php echo $plaat['value'] ?>" <?php if($item['type'] === $plaat['value']){ echo ' selected';}?> ><?php echo $plaat['value']; ?></option>
                <?php endforeach; endif; ?>
            </select>
            <label class="inputTitle" for="type">Materiaal *</label>
            <select class="inputField__search inputField__search--large" name="materiaal" required>
                <option value=" "> -- Kies een optie -- </option>
                <?php foreach($materialen as $materiaal): ?>
                <option value="<?php echo $materiaal['value']; ?>" <?php if($item['materiaal'] === $materiaal['value']){ echo " selected";} ?>><?php echo $materiaal['value']; ?></option>
                <?php endforeach; ?>
            </select>
            <?php if($cat === "Beelden"): ?>
            <label class="inputTitle" for="type">Beeldhouder *</label>
            <span class="js__input--error"></span>
            <input type="text" class="inputField__search inputField__search--large inputfield__beeldhouder" list="beeldhouders" name="beeldhouder"  autocomplete="off" value="<?php echo $item['beeldhouder']; ?>" required> 
            <datalist id="beeldhouders" class="datalist__beeldhouder"></datalist>
            <?php endif; ?>
        </div>
        <div class="advancedSearch__items">
            <h3 class="smallTitle">Beschrijving</h3>
            <label class="inputTitle" for="description">Beschrijving</label>
            <textarea class="inputField__search" name="beschrijving" cols="30" rows="10"><?php if(!empty($item['beschrijving'])){ echo $item['beschrijving'];} ?></textarea>
        </div>
        </section>
        <section>
        <div class="advancedSearch__items">
            <h3 class="smallTitle">Museum</h3>
            <label class="inputTitle" for="status">Status</label>
            <select class="inputField__search inputField__search--large"  name="status">
                <option value=" "> -- Kies een optie -- </option>
                <?php foreach($statussen as $status): ?>
                <option value="<?php echo $status['value']; ?>" <?php if($item['status'] === $status['value']){ echo ' selected';} ?>><?php echo $status['value']; ?></option>
                <?php endforeach; ?>
            </select>
            <label class="inputTitle" for="zaal">Zaal</label>
            <select class="inputField__search inputField__search--large" name="zaal">
            <option value=""> -- Kies een optie -- </option>
                <?php foreach($zalen as $zaal):  ?>
                    <option value="<?php echo $zaal['value']; ?>" <?php if($item['zaal'] === $zaal['value']){ echo ' selected';} ?> ><?php echo $zaal['value']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="advancedSearch__items">
            <h3 class="smallTitle">Details</h3>
            <label class="inputTitle" for="gesigneerd">Gesigneerd *</label>
            <select class="inputField__search inputField__search--large" name="gesigneerd" required>
            <option value=" "> -- Kies een optie -- </option>
                <?php foreach($signeren as $signeerd): ?>
                <option value="<?php echo $signeerd['value']; ?>" <?php if($item['gesigneerd'] === $signeerd['value']){ echo ' selected';} ?>><?php echo $signeerd['value']; ?></option>
                <?php endforeach; ?>
            </select>
            <label class="inputTitle" for="uitgever">Uitgever *</label>
            <span class="js__input--error"></span>
            <input type="text" class="inputField__search inputField__search--large inputfield__uitgevers" list="uitgevers" name="uitgever"  autocomplete="off" value="<?php echo $item['uitgever']; ?>" required>        
            <datalist id="uitgevers" class="datalist__uitgevers"></datalist>   
            <label class="inputTitle" for="auteursrecht">Auteursrecht</label>
            <select class="inputField__search inputField__search--large" name="auteursrecht">
                <option value=" "> -- Kies een optie -- </option>
                <?php foreach($auteursrechten as $recht): ?> 
                    <option value="<?php echo $recht['value']; ?>"  <?php if($item['auteursrecht'] === $recht['value']){ echo ' selected';} ?>><?php echo $recht['value']; ?></option>
                <?php  endforeach;?>
            </select>

            <?php if($cat === "Strips" || $cat === "Boeken"): ?>
            <label class="inputTitle" for="paginas">Pagina's *</label>
            <input class="inputField__search inputField__search--large" type="text" name="paginas" value="<?php echo $item['paginas']; ?>" required>
            <label class="inputTitle" for="kaft">Kaft *</label>
            <select class="inputField__search inputField__search--large"  name="kaft" required>
                <option value=" "> -- Kies een optie -- </option>
                <?php foreach($kaften as $kaft): ?>
                <option value="<?php echo $kaft['value']; ?>" <?php if($item['kaft'] === $kaft['value']){ echo " selected";} ?>><?php echo $kaft['value']; ?></option>
                <?php endforeach; ?>
            </select>
            <label class="inputTitle" for="ISBN">ISBN *</label>
            <input class="inputField__search inputField__search--large" type="number" name="ISBN" value="<?php echo $item['ISBN']; ?>" required>
            <?php endif ?>
        </div>
        </section>
        </div>
        <span class="updateItems__verplicht">* Dit veld is verplicht</span>
        <div class="addItems__submit"><button class="button1 js__submitbutton updateItems__submit" type="submit" name="actiony" value="submit">Aanpassingen opslaan</button></div>
    </form>
</article>
<?php else: ?>
    <p>Dit item is niet gevonden.</p>
    <a href="index.php">Terug</a>
<?php endif; ?>
<script>

const $input__scenario = document.querySelector(`.inputfield__scenario`);
const $input__tekeningen = document.querySelector(`.inputfield__tekeningen`);
const $input__kleuren = document.querySelector(`.inputfield__kleuren`);
const $input__countries = document.querySelector(`.inputfield__countries`);
const $input__uitgevers = document.querySelector(`.inputfield__uitgevers`);
const $input__beeldhouders = document.querySelector(`.inputfield__beeldhouder`);

const $submitButton = document.querySelector(`.js__submitbutton`);
const $error = document.querySelector(`.js__error`);

const $datalist__scenario = document.querySelector(`.datalist__scenario`);
const $datalist__tekeningen = document.querySelector(`.datalist__tekeningen`);
const $datalist__kleuren = document.querySelector(`.datalist__kleuren`);
const $datalist__countries = document.querySelector(`.datalist__countries`);
const $datalist__uitgevers = document.querySelector(`.datalist__uitgevers`);
const $datalist__beeldhouders = document.querySelector(`.datalist__beeldhouder`);


const $php_artists = <?php echo json_encode($artiesten); ?>;
const $php_countries = <?php echo json_encode($landen); ?>;
const $php_uitgevers = <?php echo json_encode($uitgevers); ?>;
const $artists = [];
const $countries = [];
const $uitgevers = [];

$php_artists.forEach($item => {
    $artists.push($item.value);
});

$php_countries.forEach($item => {
    $countries.push($item.value);
});

$php_uitgevers.forEach($item => {
    $uitgevers.push($item.value);
});


const eventListener = (input, array, datalist) => {
    input.addEventListener('input', e => {
        console.log(input.previousElementSibling);
        if(e.currentTarget.value.length > 3){
            const items = findItems(array, e.currentTarget.value);
            if(items){
            createDatalist(datalist, items);
            itemCheck(input, items);
        }
    }
});
}

const findItems = (array, value) => {
    return array.filter(item => item.toLowerCase().indexOf(value.toLowerCase()) > -1);
}

const createDatalist = (datalist, items) => {
    let options = ' ';
    let itemCount;
    if(items.length > 25){
        itemCount = 25;
    } else {
        itemCount = items.length;
    }
    for(let i = 0; i < itemCount; i++){
        options += `<option value="${items[i]}" >`;
    }
    datalist.innerHTML = options;
}

const itemCheck = (input, items) => {
    input.addEventListener('focusout', e => {
        console.log(input.value);
        if(!items.includes(input.value)){
            input.previousElementSibling.innerHTML = "Gelieve een geldige waarde te kiezen";
            $submitButton.disabled = true;
        } else {
            input.previousElementSibling.innerHTML = " ";
            $submitButton.disabled = false;  
        }
    })
}

eventListener($input__scenario, $artists, $datalist__scenario);
eventListener($input__tekeningen, $artists, $datalist__tekeningen);
eventListener($input__kleuren, $artists, $datalist__kleuren);
eventListener($input__countries, $countries, $datalist__countries);
eventListener($input__uitgevers, $uitgevers, $datalist__uitgevers);
eventListener($input__beeldhouders, $artists, $datalist__beeldhouders);

</script>
<?php else: header('Location: index.php'); endif; ?>