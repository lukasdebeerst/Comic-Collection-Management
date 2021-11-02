<?php if($_SESSION['currentUser']): if($_SESSION['currentUser']['status'] === 'Admin'): ?>
<div class="users__container">
    <article class="users__allUsers">
        <h2 class="users__pageTitle pageTitle">Alle gebruikers</h2>
        <a class="users__newUser--link"  href="index.php?page=users&action=new">Nieuwe gebruiker toevoegen</a>
        <div class="allUsers">
            <?php foreach($allUsers as $user):?>
                <a href="index.php?page=users&id=<?php echo $user['id'] ?>" class="user__card card">
                    <span class="user__card--name"><?php echo $user['firstName'] . ' ' . $user['lastName']; ?></span>
                    <span><?php echo $user['mail'];?></span>    
                </a>
            <?php endforeach; ?>    
        </div>
    </article>
    <article class="users__detail--container">
        <span class="admin__users--succes"><?php if(!empty($_SESSION['succes'])){ echo $_SESSION['succes'];} ?></span>
        <?php if(!empty($currentUser)): ?>
        <div class="users__detail--headerContainer">
            <p class="pageTitle"><?php echo $currentUser['firstName'] . ' ' . $currentUser['lastName']; ?></p>
            <span><?php echo $currentUser['mail'] . ' - ' .  $currentUser['status'];?></span>
        </div>
        <div class="users__form--container">
            <section>
                <h3 class="users__content--title pageTitle">verander naam</h3>
                <form  action="index.php?page=users&id=<?php echo $currentUser['id'] ?>" method="POST">
                    <input type="hidden" name="action" value="name">
                    <input type="hidden" name="id" value="<?php echo $currentUser['id'] ?>">
                    <div class="users__content--formItem">
                        <label class="inputTitle" for="firstName">Voornaam</label>
                        <input class="inputField__search--large inputField__search" type="text" name="firstName" value="<?php echo $currentUser['firstName'] ?>" required>   
                    </div>
                    <div class="users__content--formItem">
                        <label class="inputTitle" for="lastName">Achternaam</label>
                        <input class="inputField__search--large inputField__search" type="text" name="lastName" value="<?php echo $currentUser['lastName']; ?>" required>
                    </div>

                    <input class="button1" type="submit" name="submit" value="aanpassen">
                </form>
            </section>
            <section>
                <h3 class="users__content--title pageTitle">verander wachtwoord</h3>
                <span class="admin__addBulk--error"><?php if(!empty($_SESSION['passwordError'])){ echo $_SESSION['passwordError'];} ?></span>
                <form  action="index.php?page=users&id=<?php echo $currentUser['id'] ?>" method="POST">
                    <input type="hidden" name="action" value="password">
                    <input type="hidden" name="id" value="<?php echo $currentUser['id'] ?>">
                    <div class="users__content--formItem">
                        <label class="inputTitle" for="password">Nieuw Wachtwoord</label>
                        <input class="inputField__search--large inputField__search" type="password" name="password" >   
                    </div>
                    <div class="users__content--formItem">
                        <label class="inputTitle" for="password_repeat">Herhaal Nieuw Wachtwoord</label>
                        <input class="inputField__search--large inputField__search" type="password" name="password__repeat">
                    </div>

                    <input class="button1" type="submit" name="submit" value="aanpassen">
                </form>
            </section>
            <section>
                <h3 class="users__content--title pageTitle">verander status</h3>
                <form  action="index.php?page=users&id=<?php echo $currentUser['id'] ?>" method="POST">
                    <input type="hidden" name="action" value="status">
                    <input type="hidden" name="id" value="<?php echo $currentUser['id'] ?>">
                    <div class="users__content--formItem">
                        <label class="inputTitle" for="firstName">kies status</label>
                        <select class="inputField__search inputField__search--large" name="status">
                            <option value="Admin" <?php if($currentUser['status'] === 'Admin'){ echo ' selected';} ?>>Admin</option>
                            <option value="User" <?php if($currentUser['status'] === 'User'){ echo ' selected'; } ?> >User</option>
                        </select> 
                    </div>
                    <input class="button1" type="submit" name="submit" value="aanpassen">
                </form>
            </section>
            <section>
                <h3 class="users__content--title pageTitle">verander e-mailadres</h3>
                <form  action="index.php?page=users&id=<?php echo $currentUser['id'] ?>" method="POST">
                    <input type="hidden" name="action" value="mail">
                    <input type="hidden" name="id" value="<?php echo $currentUser['id'] ?>">
                    <div class="users__content--formItem">
                        <label class="inputTitle" for="password">Nieuw e-mailadres</label>
                        <input class="inputField__search--large inputField__search" type="mail" name="mail" value="<?php echo $currentUser['mail'] ?>" required>   
                    </div>
                    <input class="button1" type="submit" name="submit" value="aanpassen">
                </form>
            </section> 
            <?php if($_SESSION['currentUser']['id'] !== $currentUser['id']): ?>
            <section>
                <h3 class="users__content--title pageTitle">Gebruiker verwijderen</h3>
                <span class="users__delete--message">Weet je zeker dat je deze gebruiker wilt verwijderen?</span>
                <form  action="index.php?page=deleteUser" method="POST">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?php echo $currentUser['id'] ?>">
                    <input type="hidden" name="name" value="<?php echo $currentUser['firstName'] . ' ' . $currentUser['lastName']; ?>">
                    <button class="button1" type="submit" name="submit" value="aanpassen">Verwijderen</button>
                </form>
            </section> 
            <?php endif; ?>
        </div>
        <?php else: ?>
        <?php if(!empty($_GET['action'])): if($_GET['action'] === 'new'): ?>
            <h2 class="pageTitle">Nieuwe gebruiker toevoegen</h2>
            <span class="admin__addBulk--error"><?php if(!empty($_SESSION['error'])){ echo $_SESSION['error'];} ?></span>
            <form action="index.php?page=users&action=new" method="POST">
                <input type="hidden" name="action" value="new">
                <div class="users__content--formItem">
                        <label class="inputTitle" for="firstName">Voornaam</label>
                        <input class="inputField__search--large inputField__search" type="text" name="firstName" value="<?php if(!empty($_POST['firstName'])){ echo $_POST['firstName'];} ?>" required>   
                    </div>
                    <div class="users__content--formItem">
                        <label class="inputTitle" for="lastName">Achternaam</label>
                        <input class="inputField__search--large inputField__search" type="text" name="lastName" value="<?php if(!empty($_POST['lastName'])){ echo $_POST['lastName'];} ?>"  required>
                    </div>
                    <div class="users__content--formItem">
                        <label class="inputTitle" for="mail">E-mailadres</label>
                        <input class="inputField__search--large inputField__search" type="text" name="mail" value="<?php if(!empty($_POST['mail'])){ echo $_POST['mail'];} ?>" required>
                    </div>
                    <div class="users__content--formItem">
                        <span class="admin__addBulk--error"><?php if(!empty($_SESSION['passwordError'])){ echo $_SESSION['passwordError'];} ?></span>
                        <label class="inputTitle" for="password">Wachtwoord</label>
                        <input class="inputField__search--large inputField__search" type="password" name="password" required>   
                    </div>
                    <div class="users__content--formItem">
                        <label class="inputTitle" for="password_repeat">Herhaal Wachtwoord</label>
                        <input class="inputField__search--large inputField__search" type="password" name="password__repeat" required>
                    </div>
                    <div class="users__content--formItem">
                        <label class="inputTitle" for="firstName">kies status</label>
                        <select class="inputField__search inputField__search--large" name="status">
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                        </select> 
                    </div>
                    <input class="button1" type="submit" name="submit" value="aanmaken">

            </form>
        <?php endif; else: ?>
        <p class="users__emptyUser">Kies een gebruiker.</p>
        <?php endif; endif; ?>
    </article>
</div>

<?php endif; endif; ?>