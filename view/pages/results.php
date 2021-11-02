<?php if($_SESSION['currentUser']):?>
<?php 
if(!empty($_SESSION['results'])){
    $items = $_SESSION['results']; 
    $firstItem = reset($items);
}

?>
    <div class="results__container">
        <article class="results__header">
            <h2 class="pageTitle">Zoekresultaten</h2>
            <div class="results__header__controlsContainer">
                <div>
                    <div>
                        <a href="index.php?page=search<?php if($_SESSION['activity'] === 'delete'){ echo '&action=delete';}if($_SESSION['activity'] === 'update'){ echo '&action=update';} ?>">Opnieuw zoeken</a>
                        <span> - </span>
                        <a href="index.php?page=export">Export</a>
                    </div>
                </div>
                <?php if($_GET['view'] === 'fiche'): ?>
                    <div>
                        <form action="index.php?page=results&view=fiche&id=<?php echo $_GET['id']; ?>&key=<?php echo $_GET['key']; ?>" method="post">
                        <input type="hidden" name="id" value="<?php if(!empty($ficheItem)){ echo $ficheItem['itemId']; } ?>">
                        <button class="results__fiche--shuffle" type="submit" name="ficheAction" value="previous">< Vorige</button>
                        <button class="results__fiche--shuffle" type="submit" name="ficheAction" value="next">Volgende ></button>
                    </form>
                </div>
                <?php endif; ?>
                <?php if($_SESSION['activity'] === 'search'): ?>
                    <nav>
                        <a class="results__nav--item <?php if($_GET['view'] === "list"){ echo " results__nav--item--selected";} ?>" href="index.php?page=results&view=list">Lijst</a>
                        <?php if(!empty($firstItem)): ?><a class="results__nav--item <?php if($_GET['view'] === "fiche"){ echo " results__nav--item--selected";} ?>" href="index.php?page=results&view=fiche&id=<?php echo $firstItem['id'] ?>&key=0">Fiche</a><?php endif; ?>
                            <a class="results__nav--item <?php if($_GET['view'] === "photo"){ echo " results__nav--item--selected";} ?>" href="index.php?page=results&view=photo">Fotoalbum</a>
                            <a class="results__nav--item <?php if($_GET['view'] === "location"){ echo " results__nav--item--selected";} ?>" href="index.php?page=results&view=location">Museum</a>
                        </nav>
                        <?php endif; ?>

            </div>   
        </article>
                <div class="results__error--container"><span class="results__error"><?php if(!empty($_SESSION['error'])){ echo $_SESSION['error'];} ?></span></div>
                <article>
            <?php if(!empty($_SESSION['succes'])):?>
                <div class="succesMessage"><p class="succesMessage--text"><?php echo $_SESSION['succes']; ?></p></div>
            <?php endif; ?>
            <h2 class="hide">Items</h2>
            <?php if(empty($items)): ?>
                <p class="results__error">Er zijn geen items gevonden</p>
            <?php else: ?>

            <!-- list view -->
                <?php if($_GET['view'] === 'list'): ?>
                <div class="results__list--container">
                    <?php if($_SESSION['activity'] === "search" || $_SESSION['activity'] === "update"): ?>
                    <div>
                    <div class="results__content--list">
                        <span class="results__content--title">Foto</span>
                        <span class="results__content--title">ID</span>
                        <span class="results__content--title">Titel</span>
                        <span class="results__content--title">Scenario</span>
                        <span class="results__content--title">Tekeningen</span>
                        <span class="results__content--title">Datum</span>  
                    </div>                  
                    <?php foreach($items as $key => $item): ?>
                    <form class="results__content--list"
                        <?php if(!empty($_SESSION['activity'])): ?>
                            <?php 
                            // if($_SESSION['activity'] === "delete"){ echo 'action="index.php?page=deleteItem"';}
                            if($_SESSION['activity'] === "update"){ echo 'action="index.php?page=updateItem"';}
                            if($_SESSION['activity'] === "search"){ echo 'action="index.php?page=results&view=fiche&id=' . $item['itemId'] . '&key=' . $key . '"';}
                            ?>
                        <?php else: ?>
                        action="index.php?page=results&view=fiche&id=<?php echo $item['itemId']; ?>"
                        <?php endif; ?>
                        method="POST">
                        <button class="results__content--photoButton"><img src="<?php echo $item['photo'] ?>" alt="<?php echo $item['id'] ?>" width="190"></button>                        
                        <button class="results__content--item"><?php echo $item["itemId"] ?></button>
                        <button class="results__content--item"><?php echo $item["titel"] ?></button>
                        <button class="results__content--item"><?php echo $item["scenario"] ?></button>
                        <button class="results__content--item"><?php echo $item["tekeningen"] ?></button>
                        <button class="results__content--item"><?php echo $item["datum"] ?></button>
                        <?php if($_SESSION['activity'] === 'update'): ?>
                        <input type="hidden" name="itemId" value="<?php echo $item["itemId"] ?>">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="location" value="list">
                        <?php endif; ?>
                    </form> 
                    <?php endforeach; endif;?>
                    <?php if($_SESSION['activity'] === 'delete'): ?>
                        <form  action="index.php?page=deleteItem" method="POST">
                        <div class="results__delete--container">
                            <div>
                                <button class="button1 results__delete--button" type="submit" name="action" value="deleteMultipleItems">Verwijder geslecteerde items</button>
                                <span class="delete__SelectAll">Selecteer alle items</span>
                            </div>
                            <div class="results__content--list--delete">
                                <span></span>
                                <span class="results__content--title">Foto</span>
                                <span class="results__content--title">ID</span>
                                <span class="results__content--title">Titel</span>
                                <span class="results__content--title">Scenario</span>
                                <span class="results__content--title">Tekeningen</span>
                                <span class="results__content--title">Datum</span>  
                            </div>  

                            <div class="results__content--list--delete">
                                <?php foreach($items as $key => $item): ?>
                                    <input class="results__content--delete-checkbox" type="checkbox" name="deleteItem[]" value="<?php echo $item['itemId']; ?>">
                                    <input type="hidden" name="key[<?php echo $item['itemId'];   ?>]" value="<?php echo $key; ?>">
                                    <img class="results__content--delete--image" src="<?php echo $item['photo'] ?>" alt="<?php echo $item['id'] ?>" height="100">
                                    <p><?php echo $item["itemId"] ?></p>
                                    <p><?php echo $item["titel"] ?></p>
                                    <p><?php echo $item["scenario"] ?></p>
                                    <p><?php echo $item["tekeningen"] ?></p>
                                    <p><?php echo $item["datum"] ?></p>
                                <?php endforeach; ?>
                            </div>   
                            </form>
                        </div>
                    <?php endif; ?>     
                    </div>
                </div>
                <?php endif; ?>


            <!-- museum view -->
                <?php if($_GET['view'] === 'location'): ?>
                    <div class="results__list--container">
                <div class="results__content--location">
                    <span class="results__content--title">Foto</span>
                    <span class="results__content--title">ID</span>
                    <span class="results__content--title">Titel</span>
                    <span class="results__content--title">Status</span>
                    <span class="results__content--title">Zaal</span>                
                    <?php foreach($items as $item): ?>
                        <img src="<?php echo $item['photo'] ?>" alt="<?php echo $item['id'] ?>" height="90">
                        <div class="results__content--item"><span><?php echo $item["itemId"] ?></span></div>
                        <div class="results__content--item"><span><?php echo $item["titel"] ?></span></div>
                        <div class="results__content--item"><span><?php echo $item["status"] ?></span></div>
                        <div class="results__content--item"><span><?php echo $item["zaal"] ?></span></div>
                    <?php endforeach;?> 
                </div> 
                </div>
                <?php endif; ?>

            <!-- Photo view -->
                <?php if($_GET['view'] === 'photo'): ?>
                <div class="results__photo--container">
                <?php foreach($items as $key => $item):?>
                <div class="results__photo--content">
                    <div class="results__photo--photo"><img class="fiche__content--image" src="<?php echo $item['photo'] ?>" alt="<?php echo $item['id'] ?>" height="200"></div>
                    <div class="results__photo--data">
                        <a class="results__photo--link results__photo--link--title" href="index.php?page=results&view=fiche&id=<?php echo $item['itemId'] ?>&key=<?php echo $key; ?>" class="results__photo--title"><?php echo $item['titel'] ?></a>
                        <a class="results__photo--link" href="index.php?page=results&view=fiche&id=<?php echo $item['itemId'] ?>&key=<?php echo $key; ?>"><?php echo $item['scenario'];  ?></a>
                        <a class="results__photo--link" href="index.php?page=results&view=fiche&id=<?php echo $item['itemId'] ?>&key=<?php echo $key; ?>"><?php echo $item['itemId']; ?></a>
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="imageZoom__container">
                    <span class="imageZoom__close">&times</span>
                    <img class="imageZoom__image"  alt="vergrote foto">
                </div>        
                </div>
                <?php endif; ?>

            <!-- fiche view -->
              <?php if($_GET['view'] === 'fiche'): if(!empty($_SESSION['ficheItem'])): $ficheItem = $_SESSION['ficheItem'];?>
              <div class="fiche--container">
                <div class="fiche--container--content">
                        <div class="fiche__header--container">
                            <h3 class="pageTitle fiche--container--title"><?php echo $ficheItem['titel'] ?></h3>
                            <div class="fiche__header--actions">
                                <!-- form delete -->
                                <form action="index.php?page=deleteItem" method="POST">
                                    <input type="hidden" name="photo" value="<?php echo $ficheItem['photo']; ?>">
                                    <input type="hidden" name="itemId" value="<?php echo $ficheItem['itemId'] ?>">
                                    <input type="hidden" name="titel" value="<?php echo  $ficheItem['titel'] ?>">
                                    <input type="hidden" name="activity" value="fiche">
                                    <input type="hidden" name="key" value="<?php echo $_GET['key']; ?>">
                                    <button class="button1" type="submit" name="action" value="delete">Verwijderen</button>
                                </form>
                                <!-- form update -->
                                <form action="index.php?page=updateItem" method="POST">
                                    <input type="hidden" name="itemId" value="<?php echo $ficheItem["itemId"] ?>">
                                    <input type="hidden" name="location" value="fiche">
                                    <input type="hidden" name="key" value="<?php echo $_GET['key'] ?>">
                                    <button class="button1" type="submit" name="action" value="update">aanpassen</button>
                                </form>  
                            </div>
                        </div>
                        <div class="fiche__content--headerSubContent">
                            <p><?php echo $ficheItem['itemId'];?></p>
                            <p><?php if(!empty($ficheItem['serie'])){ echo " - " . $ficheItem['serie'];} if(!empty($ficheItem['serie-nummer'])){echo ' (' . $ficheItem['serie-nummer'] . ')';} ?></p>
                        </div>
                        
                      <article class="fiche__content">
                          <section class="fiche__content--photo">
                            <img class="fiche__content--image" src="<?php echo $ficheItem['photo']; ?>" alt="<?php echo $ficheItem['id'] ?>" height="400" >
                            <h4 class="fiche__content--title fiche__content--title--format">Formaat</h4>
                            <?php if(!empty($ficheItem['gesloten_hoogte'])): ?>
                            <div class="fiche__content--table">
                                <span class="ficheItem__Itemtitel">Gesloten</span>
                                <p><?php echo $ficheItem['gesloten_hoogte'] . ' x ' . $ficheItem['gesloten_breedte']; ?></p>
                                <span class="ficheItem__Itemtitel">Open</span>
                                <p><?php echo $ficheItem['open_hoogte'] . ' x ' . $ficheItem['open_breedte']; ?></p>
                            </div>
                            <?php endif; ?>
                            <?php if(!empty($ficheItem['hoogte'])): ?>
                              <div class="fiche__content--table">
                                <span class="ficheItem__Itemtitel">hoogte</span>
                                <p><?php echo $ficheItem['hoogte']; ?></p>
                                <span class="ficheItem__Itemtitel">breedte</span>
                                <p><?php echo $ficheItem['breedte']; ?></p>
                                <span class="ficheItem__Itemtitel">diepte</span>
                                <p><?php echo $ficheItem['diepte']; ?></p>
                                <span class="ficheItem__Itemtitel">diameter</span>
                                <p><?php echo $ficheItem['diameter']; ?></p>
                            </div>
                            <?php endif; ?>
                            <?php if(!empty($ficheItem['bruto_hoogte'])): ?>
                                <div class="fiche__content--table">
                                <span class="ficheItem__Itemtitel">Bruto</span>
                                <p><?php echo $ficheItem['bruto_hoogte'] . ' x ' . $ficheItem['bruto_breedte']; ?></p>
                                <span class="ficheItem__Itemtitel">Netto</span>
                                <p><?php echo $ficheItem['netto_hoogte'] . ' x ' . $ficheItem['netto_breedte']; ?></p>
                            </div>
                            <?php endif; ?>
                            <div class="fiche__content--table">
                            <?php if(!empty($ficheItem['materiaal'])): ?>
                                <span class="ficheItem__Itemtitel">Materiaal</span>
                                <p><?php echo $ficheItem['materiaal']; ?></p>
                            <?php endif; ?>
                            <?php if(!empty($ficheItem['type'])): ?>
                                <span class="ficheItem__Itemtitel">Type</span>
                                <p><?php echo $ficheItem['type']; ?></p>
                            <?php endif; ?>
                            </div>
                          </section>
                          <section>
                              <?php if(!empty($ficheItem['beschrijving'])): ?>
                                <h4 class="fiche__content--title">Beschrijving</h4>
                                <p class="fiche__content--description"><?php echo $ficheItem['beschrijving']; ?></p>
                              <?php endif; ?>
                              <h4 class="fiche__content--title">Artiesten</h4>
                              <div class="fiche__content--table">
                                  <span class="ficheItem__Itemtitel">Scenario</span>
                                  <p><?php echo $ficheItem['scenario']; ?></p>
                                  <span class="ficheItem__Itemtitel">Tekeningen</span>
                                  <p><?php echo $ficheItem['tekeningen']; ?></p>
                                  <?php if(!empty($ficheItem['kleuren'])): ?>
                                  <span class="ficheItem__Itemtitel">Kleuren</span>
                                  <p><?php echo $ficheItem['kleuren']; ?></p>
                                  <?php endif; ?>
                                  <?php if(!empty($ficheItem['beeldhouder'])): ?>
                                    <span class="ficheItem__Itemtitel">Beeldhouder</span>
                                  <p><?php echo $ficheItem['beeldhouder']; ?></p>
                                  <?php endif; ?>
                              </div>
                              <h4 class="fiche__content--title">Tijd en Locatie</h4>
                              <div class="fiche__content--table">
                                  <?php if(!empty($ficheItem['datum'])): ?>
                                  <span class="ficheItem__Itemtitel">Datum</span>
                                  <p><?php echo $ficheItem['datum']; ?></p>
                                  <?php endif; ?>
                                  <span class="ficheItem__Itemtitel">Periode</span>
                                  <p><?php echo $ficheItem['periode']; ?></p>
                                  <span class="ficheItem__Itemtitel">Land</span>
                                  <p><?php echo $ficheItem['land']; ?></p>
                                  <span class="ficheItem__Itemtitel">Taal</span>
                                  <p><?php echo $ficheItem['taal']; ?></p>
                              </div>

                          </section>
                          <section>
                              <h4 class="fiche__content--title">Extra</h4>
                              <div class="fiche__content--table">
                                  <span class="ficheItem__Itemtitel">Gesigneerd</span>
                                  <p><?php echo $ficheItem['gesigneerd']; ?></p>
                                  <span class="ficheItem__Itemtitel">Uitgever</span>
                                  <p><?php echo $ficheItem['uitgever']; ?></p>
                                  <span class="ficheItem__Itemtitel">Auteursrecht</span>
                                  <p><?php echo $ficheItem['auteursrecht']; ?></p>
                                  <?php if(!empty($ficheItem['paginas'])): ?>
                                  <span class="ficheItem__Itemtitel">Paginas</span>
                                  <p><?php echo $ficheItem['paginas']; ?></p>
                                  <?php endif; ?>
                                  <?php if(!empty($ficheItem['kaft'])): ?>
                                  <span class="ficheItem__Itemtitel">Kaft</span>
                                  <p><?php echo $ficheItem['kaft']; ?></p>
                                  <?php endif; ?>
                                  <?php if(!empty($ficheItem['ISBN'])): ?>
                                  <span class="ficheItem__Itemtitel">ISBN</span>
                                  <p><?php echo $ficheItem['ISBN']; ?></p>
                                  <?php endif; ?>
                              </div>
                              <h4 class="fiche__content--title">Status</h4>
                              <div class="fiche__content--table">
                                  <?php if(!empty($ficheItem['status'])): ?>
                                  <span class="ficheItem__Itemtitel">status</span>
                                  <p><?php echo $ficheItem['status']; ?></p>
                                  <?php endif; if(!empty($ficehItem['zaal'])): ?>
                                  <span class="ficheItem__Itemtitel">Zaal</span>
                                  <p><?php echo $ficheItem['zaal']; ?></p>
                                  <?php endif; ?>
                              </div>
                          </section>
                      </article>
                </div>
                <div class="imageZoom__container">
                    <span class="imageZoom__close">&times</span>
                    <img class="imageZoom__image" src="<?php echo $ficheItem['photo'] ?>" alt="Nieuw Item Toevoegen">
                </div>                    
              </div> 
              <?php else: header('Location: index.php?page=resultsview=list'); endif; ?>     
              <?php endif; ?> 
            <?php endif; ?>

        </article> 
    </div>
    <script>
        const $button = document.querySelector(`.delete__SelectAll`);
        const $checkboxes = document.querySelectorAll(`.results__content--delete-checkbox`);

        if($button){
            $button.addEventListener("click", () => {
                if($button.innerHTML === "Selecteer alle items"){
                    for (let i = 0; i < $checkboxes.length; i++) {
                        $checkboxes[i].checked = true;
                    }
                    $button.innerHTML = "Selectie ongedaan maken";
                } else if($button.innerHTML === "Selectie ongedaan maken"){
                    for (let i = 0; i < $checkboxes.length; i++) {
                        $checkboxes[i].checked = false;
                    }
                    $button.innerHTML = "Selecteer alle items";
                }
    
            })
        }



    </script>
<?php else: header('Location: index.php'); endif; ?>