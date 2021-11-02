<?php if($_SESSION['currentUser']): if($_SESSION['currentUser']['status'] === 'Admin'): ?>
    <div class="admin__deleteUser--pageContainer">
        <h2 class="pageTitle">Zeker dat je de gebruiker "<?php echo $_POST['name']; ?>" wilt verwijderen?</h2>
        <p>Opgelet! Deze actie is niet omkeerbaar.</p>
        <form action="index.php?page=users" method="POST">
            <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
            <button class="button1 deleteUser__button" type="submit" name="deleteAction" value="deleteUser">Verwijder gebruiker</button>
        </form>
        <a href="index.php?page=users">Annuleren</a>
    </div>
<?php endif; endif; ?>