<?php if(!empty($_SESSION['currentUser'])): ?>
<div class="homeScreenContainer">
    <article class="homeScreen__header">
        <h2 class="pageTitle pageTitle--index">Dag <?php echo $_SESSION['currentUser']['firstName']; ?></h2>
        <div>
            <a class="homeScreen__header--link" href="index.php?page=instellingen">profiel instellingen</a>
<?php if($_SESSION['currentUser']['status'] === "Admin"): ?><a class="homeScreen__header--link" href="index.php?page=adminUpload">Bulk toevoegen</a><?php endif; ?>
        </div>
    </article>
    <article>
        <form class="homeScreen__search" action="index.php?page=results&view=list" method="POST">
            <label for="search" class="homeScreen__search--label">Welke werken zoek je?</label>
            <input type="hidden" name="activity" value="search">
            <input class="homeScreen__searchField" type="text" name="search" placeholder="items zoeken" required>
            <!-- <input class="homeScreen__searchButton" type="submit" name="action" value="Zoeken"> -->
            <div class="addItems__submit homeScreen__searchButton"><button class="button1" type="submit" name="action" value="Zoeken">Zoeken</button></div>
        </form>
    </article>
    <article>
        <h2 class="homeScreen__navigation--title pageTitle">Acties</h2>
        <nav class="homeScreen__navigation">
                <a class="homeScreen__button homeScreen__button--search" href="index.php?page=addItems">
                    <span class="homeScreen__button--text">+</span>
                    <span >Nieuwe items toevoegen</span>
                </a>
                <a class="homeScreen__button homeScreen__button--primary" href="index.php?page=search">
                    <img class="homeScreen__button--icon" src="assets/homeScreen__search.png" alt="items zoeken"> 
                    <span>Items Zoeken</span>
                </a>
                <a class="homeScreen__button homeScreen__button--delete" href="index.php?page=search&action=delete">
                    <img class="homeScreen__button--icon" src="assets/homeScreen__trashcan.png" alt="items verwijderen"> 
                    <span>Items verwijderen</span>
                </a>
                <a class="homeScreen__button homeScreen__button--primary" href="index.php?page=search&action=update">
                    <img class="homeScreen__button--icon" src="assets/homeScreen__edit.png" alt="items aanpassen" > 
                    <span>Items Wijzigen</span>
                </a>
        </nav>
    </article>
    <!-- <article>
        <h2 class="homeScreen__navigation--title pageTitle">Handleiding</h2>
        <section class="handleiding__section">
            <h3 class="handleiding__title">Een werk uploaden</h3>
            <p>1. Zorg dat iemand met Admin-status een bulk kan uploaden om door 'bulk toevoegen' te klikken op de homepagina</p>
            <p>2. Ga naar <a href="index.php?page=addItems">nieuwe items toevoegen</a>. Hier kan u verschillende categorieën aanduiden. Tussen de haakjes ziet u hoeveel nieuwe items beschikbaar zijn. </p>
            <p>3. Vul alle velden in op het formulier en klik op opslaan</p>
            <p>4. Het item is nu toegevoegd aan de database</p>
        </section>
        <section class="handleiding__section">
            <h3 class="handleiding__title">Een werk aanpassen</h3>
            <p>1. Ga naar <a href="index.php?page=search&action=update">Items Wijzigen</a>.</p>
            <p>2. Doe een zoekactie naar je gewenste werk.</p>
            <p>3. Klik op je gewenste item en pas je gewenste parameter aan.</p>
            <p>4. Klik op opslaan.</p>
            <p>5. Het item is nu aangepast</p>
        </section>
        <section class="handleiding__section">
            <h3 class="handleiding__title">Een werk verwijderen</h3>
            <p>1. Ga naar <a href="index.php?page=search&action=delete">Items verwijderen</a>.</p>
            <p>2. Doe een zoekactie naar je gewenste werk.</p>
            <p>3. Klik op je gewenste item. Klik daarna op verwijderen.</p>
            <p>4. Je item is nu verwijderd.</p>
        </section>

    </article> -->
</div>

<?php else: header('Location: index.php'); endif; ?>
