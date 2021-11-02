<?php if($_SESSION['currentUser']):?>
<article class="mainContainer">
    <div class="search__header">
        <h2 class="pageTitle">Items zoeken 
        <?php if(!empty($_GET['action'])){
            if($_GET['action'] === 'delete'){
                echo 'om te verwijderen';
            } 
            if($_GET['action'] === 'update'){
                echo 'om te wijzigen';
            }
        } ?></h2>
        
    </div>
    <form class="simpleSearch__form" action="index.php?page=results&view=list" method="POST">
        <input type="hidden" name="activity" value="<?php
            if(!empty($_GET['action'])){
                if($_GET['action'] === 'delete'){
                    echo 'delete';
                }
                if($_GET['action'] === 'update'){
                    echo 'update';
                }
            } else {
                echo 'search';
            }
        ?>">
        <input class="homeScreen__searchField" type="text" name="search" placeholder="items zoeken" required>
        <input class="search__searchButton button1" type="submit" name="action" value="Zoeken">
        <!-- <a href="index.php?page=advancedSearch&view=alle" class="advancedSearch__link">Open geavanceerd zoeken</a> -->
    </form>
    <form action="index.php?page=advancedSearch&view=alle" method="POST">
        <input type="hidden" name="activity" value="<?php
            if(!empty($_GET['action'])){
                if($_GET['action'] === 'delete'){
                    echo 'delete';
                }
                if($_GET['action'] === 'update'){
                    echo 'update';
                }
            } else {
                echo 'search';
            }
        ?>">        
        <input  class="advancedSearch__link" type="submit" name="action" value="Open Geavanceerd zoeken">
    </form>
</article>
<?php else: header('Location: index.php'); endif; ?>