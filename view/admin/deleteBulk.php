<?php if($_SESSION['currentUser']): if($_SESSION['currentUser']['status'] === 'Admin'): ?>
<?php if(!empty($_SESSION['bulk'])): ?>
<div class="admin__addBulk--pageContainer">
    <h2 class="pageTitle">Bulk Verwijderen</h2>
    <p class='admin__deleteBulk--subtitle'>Zeker dat je de volledige Bulk definitief wilt verwijderen? </p>
    <form  class="deleteBulk__form" action="index.php?page=adminUpload" method="POST">
        <?php if($_POST['delete'] === "allBulk"): ?>
        <button class="button1 deleteBulk__button" type="submit" name="delete" value="deleteAllBulk">Volledige Bulk verwijderen.</button>
        <?php endif; ?>
        <?php if($_POST['delete'] === "recentBulk"): ?>
        <button class="button1 deleteBulk__button" type="submit" name="delete" value="deleteRecentBulk">Meest recente Bulk verwijderen</button>
        <?php endif; ?>
        <?php if($_POST['delete'] === "deleteCategory"): ?>
        <input type="hidden" name="category" value="<?php echo $_POST['category']; ?>">
        <button class="button1 deleteBulk__button" type="submit" name="delete" value="deleteCategory">Alle items uit "<?php echo $_POST['category']; ?>" verwijderen</button>
        <?php endif; ?>
    </form>
    <a href="index.php?page=adminUpload">Terug</a>
    <article class="deleteBulk__countContainer">
        <h3 class="hide">count</h3>
        <span class="deleteBulk__total">totaal: <?php echo count($bulk); ?></span>
        <section class="deleteBulk__count--category">
            <div class="deleteBulk__count--categoryItem">
                <span class="deleteBulk__total">Strips</span>
                <span><?php echo $strips; ?></span>
            </div>
            <div class="deleteBulk__count--categoryItem">
                <span class="deleteBulk__total">Platen</span>
                <span><?php echo $platen; ?></span>
            </div>
            <div class="deleteBulk__count--categoryItem">
                <span class="deleteBulk__total">Objecten</span>
                <span><?php echo $objecten; ?></span>
            </div>
            <div class="deleteBulk__count--categoryItem">
                <span class="deleteBulk__total">Boeken</span>
                <span><?php echo $boeken; ?></span>
            </div>
            <div class="deleteBulk__count--categoryItem">
                <span class="deleteBulk__total">Beelden</span>
                <span><?php echo $beelden; ?></span>
            </div>
        </section>
    </article>
    <article class="deleteBulk__itemsContainer">
        <?php foreach($bulk as $item): ?>
        <section class="deleteBulk__itemContainer">
            <span><?php echo substr($item['image'], 9); ?></span>
            <span><?php echo $item['category']; ?></span>
            <span><?php echo $item['user']; ?></span>
            <span><?php echo $item['time']; ?></span>
        </section>
        <?php endforeach; ?>
    </article>
    <?php else: ?>
    <article class="deleteBulk__emptyContainer">
        <h2 class="pageTitle">De bulk is momenteel leeg</h2>
        <a href="index.php?page=adminUpload">Terug</a>
    </article>
</div>
<?php endif; ?>
<?php else: header('Location: index.php'); endif; endif;?>