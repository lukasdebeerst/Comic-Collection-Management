<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>CAMH</title>
  <link rel="stylesheet" type="text/css" href="css/main.css?version=1">

</head>
<body>
    <article class="headerContainer <?php if(empty($_SESSION['currentUser'])){ echo " visibility" ;} ?> ">
        <header>
            <a href="index.php" class="header">
                <div class="header__logo">
                    <img src="./assets/headerLogo.png" alt="CAMH Logo" height="60"  width="48">
                    <h1 class="headerTitle">CAMH</h1>
                    <p class="headerSubTitle">Comic Art Museum And Hotel</p>
                </div>  
            </a>
            
        </header>
        <span class="header__hoofdTitel">Beheer Stripcollectie</span>
        <?php if($_SESSION['currentUser']): ?>
        <div class="navContainer">
            <nav>
                <a class="menuItem" href="index.php">Start</a>
                <!-- <a class="menuItem" href="">Overzicht</a>
                <a class="menuItem" href="">Catalogus</a>
                <a class="menuItem" href="">Etiketten</a>
                <a class="menuItem" href="">Waarde</a> -->
                <div class="navigation__profile">
                    <button class=" menuItem navigation__profile--button ">Je profiel
                    </button>
                    <div class="navigation__profile--content">
                        <a href="index.php?page=instellingen" class="menuItem">Instellingen</a>
                        <form action="index.php" method="POST">
                            <button class="menuItem--logout menuItem " type="submit" name="action" value="logout">Uitloggen</button> 
                        </form>
                    </div>
                </div>
                <?php if($_SESSION['currentUser']['status'] === 'Admin'): ?>
                <!-- <a class="menuItem" href="index.php?page=admin">Admin</a> -->
                <div class="navigation__profile">
                <button class=" menuItem navigation__profile--button">Admin
                    </button>
                    <div class="navigation__profile--content">
                        <a class="menuItem" href="index.php?page=adminUpload">Items toevoegen</a>
                        <a class="menuItem" href="index.php?page=users">Gebruikers</a>
                    </div>
                </div>
                <?php endif; ?>
            </nav>     
        </div>
        <?php endif; ?>
    </article>
    <main class="main <?php if(empty($_SESSION['currentUser'])){ echo " noBackground" ;} ?> " >
        <?php echo $content; ?>   
        <script src="./js/script.js"></script> 
    </main>
    <footer class="footer">
        <p><a class="footer__link"  href="https://www.camh.be/">Copyright Comic Art Museum</a>, Gent - 2020</p>
        <p>Voor ondersteuning kan je contact opnemen met de <a class="footer__link" href="mailto:xavier.debeerst@camh.be">webmaster</a>.</p>
    </footer>
</body>
</html>
