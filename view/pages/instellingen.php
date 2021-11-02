<?php if($_SESSION['currentUser']): ?>
    <article class="settings__container">
    <h2 class="pageTitle">Instellingen</h2>
    <section>
        <h3 class="users__content--title pageTitle">verander wachtwoord</h3>
        <form  action="index.php?page=instellingen" method="POST">
            <input type="hidden" name="action" value="password">
            <input type="hidden" name="id" value="<?php echo $_SESSION['currentUser']['id']; ?>">
            <div class="users__content--formItem">
                <label class="inputTitle" for="password">Nieuw Wachtwoord</label>
                <input class="inputField__search--large inputField__search" type="password" name="password" required>   
            </div>
            <div class="users__content--formItem">
                <label class="inputTitle" for="password_repeat">Herhaal Nieuw Wachtwoord</label>
                <input class="inputField__search--large inputField__search" type="password" name="password__repeat" required>
            </div>
            <input class="button1" type="submit" name="submit" value="aanpassen">
        </form>
    </section>
    <section>
        <h3 class="users__content--title pageTitle">verander e-mailadres</h3>
        <form  action="index.php?page=instellingen" method="POST">
            <input type="hidden" name="action" value="mail">
            <input type="hidden" name="id" value="<?php echo $_SESSION['currentUser']['id']; ?>">
            <div class="users__content--formItem">
                <label class="inputTitle" for="password">Nieuw e-mailadres</label>
                <input class="inputField__search--large inputField__search" type="mail" name="mail" value="<?php echo $_SESSION['currentUser']['mail']; ?>" required>   
            </div>
            <input class="button1" type="submit" name="submit" value="aanpassen">
        </form>
    </section> 
    </article>



<?php else: header('Location: index.php'); endif; ?>