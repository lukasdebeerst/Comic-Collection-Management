<?php if(!empty($_SESSION['currentUser'])):?>
<?php 
    if(!empty($_POST['action'])):
    if($_POST['action'] === 'delete'):
?>
<div class="deleteItem__content">
    <h2 class="pageTitle">Item Verwijderen</h2>
    <img  src="<?php echo $_POST['photo'] ?>" alt="<?php echo $_POST['itemId'] ?>" height="150">
    <p class="item__subTitle">Weet je zeker dat je item "<?php echo $_POST['titel'] . " (" . $_POST['itemId'] . ')'; ?> wilt verwijderen?</p>
    <form action="index.php?page=results&view=list" method="POST">
        <div class="delete__buttons">
            <button  class="delete__button1" type="submit" name="deleteAction" value="delete">Ik wil dit item verwijderen. </button>
            <button class="delete__button2" type="submit" name="deleteAction" value="cancel">Annuleren</button>       
        </div>
        <input type="hidden" name="key" value="<?php echo $_POST["key"]; ?>">
        <input type="hidden" name="itemId" value="<?php echo $_POST["itemId"]; ?>">
        <?php if($_POST['activity'] === 'fiche'): ?>
        <input type="hidden" name="activity" value="search">
        <?php else: ?>
        <input type="hidden" name="activity" value="delete">
        <?php endif; ?>
    </form>
</div>
<?php endif;?>


<?php if($_POST['action'] === 'deleteMultipleItems'): ?>
    <?php if(!empty($_SESSION['deleteItems'])): ?>
    <article>
        <h2 class="pageTitle">Items verwijderen</h2>
        <form action="index.php?page=results&view=list" method="POST">
            <div class="delete__buttons">
                <button  class="delete__button1" type="submit" name="deleteAction" value="multipleDelete">Ik wil deze items verwijderen. </button>
                <button class="delete__button2" type="submit" name="deleteAction" value="cancel">Annuleren</button>       
            </div>
            <input type="hidden" name="activity" value="delete">
        </form>
        <h3 class="multipleDelete__list--title">Verwijderde items</h3>
        <?php foreach($_SESSION['deleteItems'] as $item): ?>
        <div class="multipleDelete__list">
            <p><?php echo $item['itemId']; ?></p>
            <p><?php echo $item['titel']; ?></p>
        </div>
        <?php endforeach; ?>
    </article>
<?php endif; endif; ?> 
<?php else: header('Location: index.php'); endif; ?>
<?php else: header('Location: index.php'); endif; ?>