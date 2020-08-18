<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
        <meta name="description" content="Antoine Devillers Développeur Web">

        <!-- Open Graph data -->
        <meta property="og:title" content="Antoine Devillers Développeur Web"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="antoinedevillers.fr/projet5/"/>
        <meta property="og:image" content="http://antoinedevillers.fr/projet5/image1.jpg"/>
        <meta property="og:description" content="Antoine Devillers Développeur Web"/>

        <!-- Twitter Card data -->
        <meta name="twitter:card" content="Antoine Devillers Développeur Web">
        <meta name="twitter:title" content="Antoine Devillers Développeur Web">
        <meta name="twitter:description" content="Antoine Devillers Développeur Web">
        <meta name="twitter:image" content="http://antoinedevillers.fr/projet5/image1.jpg">

        <link href="public/css/style.css" rel="stylesheet" /> 
        <script src="https://kit.fontawesome.com/ba5ac1c788.js" crossorigin="anonymous"></script>
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
                    <li><a href='index.php'>Accueil<a></li>
    				<li><a href='index.php?action=articles' >Articles</a></li>
                    <li><a href='index.php'>Portfolio<a></li>
                    <li><a href=index.php?action=contact> Contact</a></li>
                    <li><a href=index.php?action=connexionAdmin> <i class="fa fa-user-o" aria-hidden="true"></i></a></li>
                    <?php
                    }
                    if(isset($_SESSION['id']) AND isset($_SESSION['login']))
                    {
                    ?>
                        
                    <li><a href='index.php'>Accueil<a></li>
                    <li><a href='index.php?action=articles' >Articles</a></li>
                    <li><a href='index.php'>Portfolio<a></li>
                    <li><a href=index.php?action=formCreateArticle> Ajouter un article</a></li>
                    <li><a href='index.php?action=reportedComments'>Commentaires signalés</a></li>
                    <li><a href=index.php?action=deconnexionAdmin><i class="fa fa-user-times" aria-hidden="true"></i></a></li>

                    <?php
                    }
                    ?>
    			</ul>
    		</nav>
    	</header>
        
        <?= $content ?>

        <footer>
        	<div>
                <p> Contact </p>
                <p> Mail </p>
                <p> Phone number </p>   
            </div>
            <div>
                <p> RGPD </p>
                <p> Mentions légales</p>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="public/js/menuBurger.js"></script>
        <script src="public/js/deletePost.js"></script>
    </body>
</html>