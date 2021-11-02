<?php if(empty($_SESSION['currentUser'])): ?>
<article class="loginContainer">
    <header >
            <a href="index.php" class="header">
                <div class="header__logo">
                    <img src="./assets/headerLogo.png" alt="CAMH Logo" height="60"  width="48">
                    <h1 class="headerTitle">CAMH</h1>
                    <p class="headerSubTitle">Comic Art Museum And Hotel</p>
                </div>  
            </a>
            
    </header>
    <div class="card loginContent">
        <h2 class="smallTitle">Login</h2>
        <?php if(!empty($_SESSION['error'])): ?>
        <span class="inputError authError"><?php echo $_SESSION['error']; ?></span>
        <?php endif; ?>
        <form class="authForm" action="index.php" method="POST">
            <label class="inputTitle" for="email">Mail</label>
            <input class="inputField" type="text" name="email" />
            <label class="inputTitle" for="password">Password</label>
            <input class="inputField" type="password" name="password" />
            <input class="button1" type="submit" name="action" value="login" />
        </form>
        <p> Problemen bij het inloggen?</p>
        <a class="link" href="mailto:xavier@camh.be">Contacteer de webmaster</a>
    </div>
    
</article>
<?php else: header('Location: index.php?page=homeScreen'); endif; ?>