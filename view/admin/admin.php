<?php if(!empty($_SESSION['currentUser'])): ?> 
<?php if($_SESSION['currentUser']['status'] === 'Admin'): ?>
<article class="mainContainer">
    <nav><a class="button1 admin__button" href="index.php?page=adminUpload">Nieuwe bulk toevoegen</a></nav>
</article>








<?php else: header('Location: index.php'); endif; ?>
<?php else: header('Location: index.php'); endif; ?>