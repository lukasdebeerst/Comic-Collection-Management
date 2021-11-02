<?php if($_SESSION['currentUser']):?>
<form action="index.php?page=Catalogus" method="POST">
    <button name="export" value="pdf">Generate PDF</button>
</form>


<?php else: header('Location: index.php'); endif; ?>