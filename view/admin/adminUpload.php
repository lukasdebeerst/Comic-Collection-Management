<?php if($_SESSION['currentUser']): if($_SESSION['currentUser']['status'] === 'Admin'): ?>
    <div class="admin__addBulk--pageContainer">
        <article class="admin__addBulk--container ">
            <h2 class="pageTitle">Nieuwe bulk toevoegen</h2>
            <span class="admin__addBulk--error"><?php if(!empty($_SESSION['error'])){ echo $_SESSION['error'];} ?></span>
            <span class="admin__addBulk--succes"><?php if(!empty($_SESSION['succes'])){ echo $_SESSION['succes'];} ?></span>
            <form class="admin__addBulk--container" action="index.php?page=adminUpload" method="POST" enctype="multipart/form-data">
                <div class="admin__addBulk--categories">
                    <span class="inputTitle" >Category</span>
                    <div class="admin__addBulk--radiobutton">
                        <input class="admin__addBulk--radio" type="radio" name="category" id="Strips" value="Strips" required>
                        <label class="admin__addBulk--radioLabel" for="Strips">Strips</label>
                        <input class="admin__addBulk--radio" type="radio" name="category" id="Platen" value="Platen">
                        <label class="admin__addBulk--radioLabel" for="Platen">Platen</label>
                        <input class="admin__addBulk--radio" type="radio" name="category" id="Objecten" value="Objecten">
                        <label class="admin__addBulk--radioLabel" for="Objecten">Objecten</label>
                        <input class="admin__addBulk--radio" type="radio" name="category" id="Boeken" value="Boeken">
                        <label class="admin__addBulk--radioLabel" for="Boeken">Boeken</label>
                        <input class="admin__addBulk--radio" type="radio" name="category" id="Beelden" value="Beelden">
                        <label class="admin__addBulk--radioLabel" for="Beelden">Beelden</label>
                    </div>

                </div>
                <div class="admin__addBulk--uploadContainer">
                    <input class="admin__addBulk--upload" type="file" name="images[]" id="images" accept="image/png, image/jpeg, image/tiff" multiple="multiple" required>
                    <span>ondersteunde bestanden: PNG, JPEG, TIFF</span>
                    <span>maximum opslagruimte: 512 Mb (1000 items)</span>
                </div>
                <div class="addItems__submit admin__addBulk--submit"><input class="button1"  type="submit" name="action" value="submit"></div>
            </form>
        </article>
        <article>
            <h2 class="pageTitle">Verwijder Bulk</h2>
            <form class="deleteBulk__form" action="index.php?page=deleteBulk" method="POST">
                <button class="button1 deleteBulk__button" type="submit" name="delete" value="allBulk">Verwijder volledige bulk</button>
                <button class="button1 deleteBulk__button" type="submit" name="delete" value="recentBulk">Verwijder meest recente bulk</button>
            </form>
            <form class="deleteBulk__Category" action="index.php?page=deleteBulk" method="POST">
                <h3 class="deleteBulk__Category--title">Verwijder op categorie</h3>
                <label class="inputTitle deleteBulk__Category--label" for="category">Categorie</label>
                <select class="inputField__search inputField__search--large" name="category">
                    <option value="Strips">Strips</option>
                    <option value="Platen">Platen</option>
                    <option value="Objecten">Objecten</option>
                    <option value="Boeken">Boeken</option>
                    <option value="Beelden">Beelden</option>
                </select>
                <button class="button1 deleteBulk__button" type="submit" name="delete" value="deleteCategory">Category verwijderen</button>
            </form>
        </article>
    </div>
    
    
    <?php else: header('Location: index.php'); endif; endif;?>
