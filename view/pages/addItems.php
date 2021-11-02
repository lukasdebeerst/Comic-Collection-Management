<?php if($_SESSION['currentUser']): ?>
<?php if(empty($_SESSION['category'])){$_SESSION['category'] = 'Strips';} ?>
<div class="addItems__zoomContainer">
<article class="addItems__Outsidecontainer">
    <div class="addItems__headerContainer">
        <h2 class="pageTitle addItems__Pagetitle">Items toevoegen</h2>
        <a class="addItems__addempty--icon" href="index.php?page=addEmptyItem">&plus;</a>
    </div>
    <span class="admin__addBulk--succes"><?php if(!empty($_SESSION['succes'])){ echo $_SESSION['succes']; } ?></span>
    <div class="addItems__container fiche--container--content" >
<form action="index.php?page=addItems" method="POST">
    <button class="addItems__category--button button1 <?php if(!empty($_SESSION['category'])){ if($_SESSION['category'] === 'Strips'){ echo 'addItems__button--selected'; }} ?>" type="submit" name="category" value="Strips">Strips (<?php echo $numberOfStrips; ?>)</button>
    <button class="addItems__category--button button1 <?php if(!empty($_SESSION['category'])){ if($_SESSION['category'] === 'Platen'){ echo 'addItems__button--selected'; }} ?>" type="submit" name="category" value="Platen">Platen (<?php echo $numberOfPlaten; ?>)</button>
    <button class="addItems__category--button button1 <?php if(!empty($_SESSION['category'])){ if($_SESSION['category'] === 'Objecten'){ echo 'addItems__button--selected'; }} ?>" type="submit" name="category" value="Objecten">Objecten (<?php echo $numberOfObjecten; ?>)</button>
    <button class="addItems__category--button button1 <?php if(!empty($_SESSION['category'])){ if($_SESSION['category'] === 'Boeken'){ echo 'addItems__button--selected'; }} ?>" type="submit" name="category" value="Boeken">Boeken (<?php echo $numberOfBoeken; ?>)</button>
    <button class="addItems__category--button button1 <?php if(!empty($_SESSION['category'])){ if($_SESSION['category'] === 'Beelden'){ echo 'addItems__button--selected'; }} ?>" type="submit" name="category" value="Beelden">Beelden (<?php echo $numberOfBeelden; ?>)</button>
</form>
<?php 
    if(!empty($_SESSION['category'])):
    if(!empty($_SESSION['itemsToAdd'])):
    if(!empty($_GET['key'])){
        $key = $_GET['key'];
    } else {
        $key = 0;
    }
    $item = $_SESSION['itemsToAdd'][$key];
?>
<form action="index.php?page=addItems" method="POST">
    <input type="hidden" name="key" value="<?php echo $key; ?>">
    <button class="addItems__shuffle" type="submit" name="addItemsAction" value="previous">< Vorige</button>
    <button class="addItems__shuffle" type="submit" name="addItemsAction" value="next">Volgende ></button>
</form>

    <div><img class="fiche__content--image" src="<?php echo $item['image']; ?>" alt="<?php echo $item['image']; ?>" height="200"></div>
    <span class="js__error admin__addBulk--error"></span>
    <form action="index.php?page=addItemDelete" method="POST">
    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
    <input type="hidden" name="image" value="<?php echo $item['image']; ?>">
    <button class="button1" type="submit" name="addItemsDelete" value="delete">Verwijderen</button>
</form>
    <form class="addItems__form" action="index.php?page=addItems" method="POST">
        <div class="addItems__form--content">
        <input type="hidden" name="photo" value="<?php echo $item['image']; ?>">
        <input type="hidden" name="bulkId" value="<?php echo $item['id']; ?>">
        <input type="hidden" name="key" value="<?php echo $key?>">
        <div class="advancedSearch__form">
        <section>
        <div class="advancedSearch__items">
            <h3 class="smallTitle">Algemeen</h3>
            <label class="inputTitle" for="titel">Titel *</label>
            <input class="inputField__search inputField__search--large" type="text" name="titel" required>
            <label class="inputTitle" for="serie">Serie</label>
            <input class="inputField__search inputField__search--large" type="text" name="serie">
            <label class="inputTitle" for="SerieNummer">Serie Nummer</label>
            <input class="inputField__search inputField__search--large" type="number" name="serieNummer">
            <label class="inputTitle" for="datum">Datum</label>
            <input class="inputField__search inputField__search--large" type="text" name="datum">
            <label class="inputTitle" for="periode">Periode *</label>
            <select class="inputField__search inputField__search--large" name="periode" required >
                <option value=" ">-- kies een optie --</option>
                <?php foreach($periodes as $periode): ?>
                <option value="<?php echo $periode['value']; ?>"><?php echo $periode['value']; ?></option>
                <?php endforeach; ?>
            </select>
            <label class="inputTitle" for="land">Land *</label>
            <span class="js__input--error"></span>
            <input type="text" class="inputField__search inputField__search--large inputfield__countries" list="countries"  autocomplete="off" name="land" required>        
            <datalist id="countries" class="datalist__countries"></datalist>        
            <label class="inputTitle" for="taal">Taal *</label>
            <select class="inputField__search inputField__search--large" name="taal" required >
                <option value=" ">-- kies een optie --</option>
                <?php foreach($talen as $taal): ?>
                <option value="<?php echo $taal['value']; ?>"><?php echo $taal['value']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php if($_SESSION['category'] !== 'Alle'): ?>
            <div class="advancedSearch__items">
                <h3 class="smallTitle">Formaat</h3>
                <?php if($_SESSION['category'] === "Strips" || $_SESSION['category'] === "Boeken"): ?>
                <label class="inputTitle" for="closed_h">Gesloten *</label>
                <div class="input__size--container">
                    <input class="inputField__search inputField__search--small" type="number" name="gesloten_hoogte" step="0.01" required>
                    <span class="inputTitle inputField__spacer">x</span>
                    <input class="inputField__search inputField__search--small" type="number" name="gesloten_breedte" step="0.01" required>
                </div>
                    <label class="inputTitle" for="open_h">Open *</label>
                    <div class="input__size--container">
                    <input class="inputField__search inputField__search--small" type="number" name="open_hoogte" step="0.01" required>
                    <span class="inputTitle inputField__spacer">x</span>
                    <input class="inputField__search inputField__search--small" type="number" name="open_breedte" step="0.01" required>
                </div>
                <?php endif; ?>
                <?php if($_SESSION['category'] === "Platen"): ?>
                <label class="inputTitle" for="closed_h">Bruto (met rand) *</label>
                <div class="input__size--container">
                    <input class="inputField__search inputField__search--small" type="number" name="bruto_hoogte" step="0.01" required>
                    <span class="inputTitle inputField__spacer">x</span>
                    <input class="inputField__search inputField__search--small" type="number" name="bruto_breedte" step="0.01" required>
                </div>
                <label class="inputTitle" for="open_h">Netto (zonder rand) *</label>
                <div class="input__size--container">
                    <input class="inputField__search inputField__search--small" type="number" name="netto_hoogte" step="0.01" required>
                    <span class="inputTitle inputField__spacer">x</span>
                    <input class="inputField__search inputField__search--small" type="number" name="netto_breedte" step="0.01" required>
                </div>
                <?php endif; ?>
                <?php if($_SESSION['category'] === "Objecten" || $_SESSION['category'] === "Beelden"): ?>
                <div class="input_objects--container">
                    <div class="input_objects--items">
                        <div class="input_objects--item"> 
                            <label class="inputTitle" for="hoogte">Hoogte *</label>
                            <input class="inputField__search inputField__search--small" type="text" name="hoogte" step="0.01" required>
                        </div>
                        <div class="input_objects--item">
                            <label class="inputTitle" for="breedte">Breedte *</label>
                            <input class="inputField__search inputField__search--small" type="text" name="breedte" step="0.01" required>
                        </div>
                    </div>
                    <div class="input_objects--items">
                        <div class="input_objects--item">
                            <label class="inputTitle" for="diepte">Diepte *</label>
                            <input class="inputField__search inputField__search--small" type="text" name="diepte" step="0.01" required>
                        </div>
                        <div class="input_objects--item">
                            <label class="inputTitle" for="diameter">Diameter *</label>
                            <input class="inputField__search inputField__search--small" type="text" name="diameter" step="0.01" required>
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
            <input type="text" class="inputField__search inputField__search--large inputfield__scenario" list="scenario"  autocomplete="off" name="scenario" required> 
            <datalist id="scenario" class="datalist__scenario"></datalist>
            <label class="inputTitle" for="tekeningen">Tekeningen *</label>
            <span class="js__input--error"></span>
            <input type="text" class="inputField__search inputField__search--large inputfield__tekeningen" list="tekeningen"  autocomplete="off" name="tekeningen" required> 
            <datalist id="tekeningen" class="datalist__tekeningen"></datalist>
            <label class="inputTitle" for="kleuren">Kleuren</label>
            <span class="js__input--error"></span>
            <input type="text" class="inputField__search inputField__search--large inputfield__kleuren" list="kleuren"  autocomplete="off" name="kleuren"> 
            <datalist id="kleuren" class="datalist__kleuren"></datalist>
            <label class="inputTitle" for="type">Type *</label>
            <select class="inputField__search inputField__search--large" name="type" required>
                <option value=" "> -- Kies een optie -- </option>
                <?php if($_SESSION['category'] === "Strips"): foreach($typeStrip as $strip): ?>
                    <option value="<?php echo $strip['value'] ?>"><?php echo $strip['value'] ?></option>
                <?php endforeach; endif; ?>
                <?php if($_SESSION['category'] === "Boeken"): foreach($typeBoek as $boek): ?>
                    <option value="<?php echo $boek['value'] ?>"><?php echo $boek['value'] ?></option>
                <?php endforeach; endif; ?>
                <?php if($_SESSION['category'] === "Objecten" || $_SESSION['category'] === "Beelden"): foreach($typeObjectBeeld as $boek): ?>
                    <option value="<?php echo $boek['value'] ?>"><?php echo $boek['value'] ?></option>
                <?php endforeach; endif; ?>
                <?php if($_SESSION['category'] === "Platen"): foreach($typePlaat as $plaat): ?>
                    <option value="<?php echo $plaat['value'] ?>"><?php echo $plaat['value'] ?></option>
                <?php endforeach; endif; ?>
            </select>
            <?php if($_SESSION['category'] === "Objecten" || $_SESSION['category'] === 'Beelden'): ?>
            <label class="inputTitle" for="type">Materiaal *</label>
            <select class="inputField__search inputField__search--large" name="materiaal" required>
                <option value=" "> -- Kies een optie -- </option>
                <?php foreach($materialen as $materiaal): ?>
                <option value="<?php echo $materiaal['value']; ?>"><?php echo $materiaal['value']; ?></option>
                <?php endforeach; ?>
            </select>
            <?php endif; ?>
            <?php if($_SESSION['category'] === 'Beelden'): ?>
            <label class="inputTitle" for="type">Beeldhouder *</label>
            <span class="js__input--error"></span>
            <input type="text" class="inputField__search inputField__search--large inputfield__beeldhouder" list="beeldhouders" name="beeldhouder"  autocomplete="off" required> 
            <datalist id="beeldhouders" class="datalist__beeldhouder"></datalist>
            <?php endif; ?>
        </div>
        <div class="advancedSearch__items">
            <h3 class="smallTitle">Beschrijving</h3>
            <label class="inputTitle" for="description">Beschrijving</label>
            <textarea class="inputField__search inputField__description" name="beschrijving" cols="30" rows="10"></textarea>
        </div>
        </section>
        <section>
        <div class="advancedSearch__items">
            <h3 class="smallTitle">Museum</h3>
            <label class="inputTitle" for="status">Status</label>
            <select class="inputField__search inputField__search--large"  name="status">
                <option value=" "> -- Kies een optie -- </option>
                <?php foreach($statussen as $status): ?>
                <option value="<?php echo $status['value']; ?>"><?php echo $status['value']; ?></option>
                <?php endforeach; ?>
            </select>
            <label class="inputTitle" for="zaal">Zaal</label>
            <select class="inputField__search inputField__search--large" name="zaal">
                <option value=""> -- Kies een optie -- </option>
                <?php foreach($zalen as $zaal):  ?>
                    <option value="<?php echo $zaal['value']; ?>"><?php echo $zaal['value']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="advancedSearch__items">
            <h3 class="smallTitle">Details</h3>
            <label class="inputTitle" for="gesigneerd">Gesigneerd *</label>
            <select class="inputField__search inputField__search--large" name="gesigneerd" required>
            <option value=" "> -- Kies een optie -- </option>
                <?php foreach($signeren as $signeerd): ?>
                <option value="<?php echo $signeerd['value']; ?>"><?php echo $signeerd['value']; ?></option>
                <?php endforeach; ?>
            </select>
            <label class="inputTitle" for="uitgever">Uitgever *</label>
            <span class="js__input--error"></span>
            <input type="text" class="inputField__search inputField__search--large inputfield__uitgevers" list="uitgevers" name="uitgever"  autocomplete="off" required>        
            <datalist id="uitgevers" class="datalist__uitgevers"></datalist>        
            <label class="inputTitle" for="auteursrecht">Auteursrecht</label>
            <select class="inputField__search inputField__search--large" name="auteursrecht">
                <option value=" "> -- Kies een optie -- </option>
                <?php foreach($auteursrechten as $recht): ?>
                    <option value="<?php echo $recht['value']; ?>"><?php echo $recht['value']; ?></option>
                <?php  endforeach;?>
            </select>

            <?php if($_SESSION['category'] === "Strips" || $_SESSION['category'] === "Boeken"): ?>
            <label class="inputTitle" for="paginas">Pagina's *</label>
            <input class="inputField__search inputField__search--large" type="text" name="paginas" required>
            <label class="inputTitle" for="kaft">Kaft *</label>
            <select class="inputField__search inputField__search--large"  name="kaft" required>
                <option value=" "> -- Kies een optie -- </option>
                <?php foreach($kaften as $kaft): ?>
                <option value="<?php echo $kaft['value']; ?>"><?php echo $kaft['value']; ?></option>
                <?php endforeach; ?>
            </select>
            <label class="inputTitle" for="ISBN">ISBN *</label>
            <input class="inputField__search inputField__search--large" type="number" name="ISBN" required>
            <?php endif ?>
        </div>
    </section>
</div>
</div>
    <span class="addItems__verplicht">* Dit veld is verplicht</span>
    <div class="addItems__submit"><button class="button1 js__submitbutton" type="submit" name="action" value="submit">Opslaan</button></div>
    </article>
    </form>
<?php else: ?>
    <?php if(!empty($_SESSION['category'])): ?>
    <p class="addItems__empty">De <?php echo $_SESSION['category']; ?> zijn up to date!</p>
    <?php else: ?>
    <p class="addItems__empty">De database is up to date!</p>    
<?php endif; endif; endif; ?>
<div class="imageZoom__container">
    <span class="imageZoom__close">&times</span>
    <img class="imageZoom__image" src="<?php echo $item['image'] ?>" alt="Nieuw Item Toevoegen">
</div>


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