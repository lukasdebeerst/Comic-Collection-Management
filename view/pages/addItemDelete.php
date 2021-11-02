<?php if($_SESSION['currentUser']): ?>
<?php if(!empty($_POST['addItemsDelete'])): ?>
<article class="addItemDelete__container">
    <h2 class="pageTitle">Weet je zeker dat je item "<?php echo substr($_POST['image'], 9); ?>" wilt verwijderen? </h2>
    <div>
        <img src="<?php echo $_POST['image']; ?>" alt="<?php echo substr($_POST['image'], 9); ?>" width="400px">
    </div>
    <form action="index.php?page=addItems" method="POST">
        <input type="hidden" name="id" value="<?php echo $_POST['id'] ?>">
        <input type="hidden" name="image" value="<?php echo $_POST['image'] ?>" >
        <button class="button1 addItemDelete__button" type="submit" name="deleteItem" value="delete">Verwijderen</button>
    </form>
    <a href="index.php?page=addItems">Annuleren</a>
</article>
<?php endif; else: header('Location: index.php'); endif; ?>