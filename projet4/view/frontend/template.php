<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
        <meta name="description" content="Blog de Jean Forteroche - Nouveau livre: Billet simple pour l'Alaska">

        <!-- Open Graph data -->
        <meta property="og:title" content="Billet simple pour l'Alaska"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="antoinedevillers.fr/projet4/"/>
        <meta property="og:image" content="http://antoinedevillers.fr/projet4/image1.jpg"/>
        <meta property="og:description" content="Blog de Jean Forteroche - Nouveau livre: Billet simple pour l'Alaska"/>

        <!-- Twitter Card data -->
        <meta name="twitter:card" content="Bienvenue sur le blog de Jean Forteroche">
        <meta name="twitter:title" content="Billet simple pour l'Alaska">
        <meta name="twitter:description" content="Blog de Jean Forteroche - Nouveau livre: Billet simple pour l'Alaska">
        <meta name="twitter:image" content="http://antoinedevillers.fr/projet4/image1.jpg">

        <link href="public/css/style.css" rel="stylesheet" /> 

        <script src="https://cdn.tiny.cloud/1/tx44sw0b4t9r973kejl4lp9wya91he4k0foak06n3fll02dq/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
         <script>
            tinymce.init({
            selector: '#mytextarea'
,
            });
        </script>
    </head>
        
    <body>
    	<header>
            <?php 
            if(!isset($_SESSION['id']) AND !isset($_SESSION['login']))
                {
                ?> 
                <div class="messageBienvenue">Bienvenue sur le blog de Jean Forteroche</div>
                <?php
                } 
            if(isset($_SESSION['id']) AND isset($_SESSION['login']))
                {
                ?>
                <div class="messageBienvenue">Bienvenue dans l'interface d'administration</div>
                <?php
                } 
                ?>
            <div class='btn_navigation'>
                <div class='barre'></div>
                <div class='barre'></div>
                <div class='barre'></div>
            </div>
    		<nav>
    			<ul>   				
                    <?php 
                    if(!isset($_SESSION['id']) AND !isset($_SESSION['login']))
                    {
                    ?> 
                    <li><a href='index.php'>Accueil</a></li>
    				<li><a href='index.php?action=formConnexionAdmin' >Connexion Administration</a></li>
                    <?php
                    }
                    if(isset($_SESSION['id']) AND isset($_SESSION['login']))
                    {
                    ?>
                        
                    <li><a href='index.php'>Accueil</a></li>
                    <li><a href='index.php?action=formCreatePost'> Ajouter un billet</a></li>
                    <li><a href='index.php?action=reportedComments'>Commentaires signalés</a></li>
                    <li><a href='index.php?action=deconnexionAdmin'> Deconnexion</a></li>
                    <?php
                    }
                    ?>
    			</ul>
    		</nav>
    	</header>
        
        <?= $content ?>

        <footer>
        	Blog de Jean Forteroche - Projet Openclassrooms
        </footer>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="public/js/menuBurger.js"></script>
        <script src="public/js/deletePost.js"></script>
    </body>
</html>