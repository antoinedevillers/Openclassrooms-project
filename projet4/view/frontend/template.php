<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
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
            <?php if(!isset($_SESSION['id']) AND !isset($_SESSION['login']))
                    {
                    ?> <div class="messageBienvenue">Bienvenue sur le blog de Jean Forteroche</div>
                    <?php
                    } 
            if(isset($_SESSION['id']) AND isset($_SESSION['login']))
                    {?>
                    <div class="messageBienvenue">Bienvenue dans l'interface d'administration</div>
                    <?php
                    } 
                    ?>
    		<nav>
    			<ul>   				
                    <?php if(!isset($_SESSION['id']) AND !isset($_SESSION['login']))
                    {?> 
                        <li><a href='index.php'>Accueil<a></li>
        				<li><a href='index.php?action=formConnexionAdmin' >Connexion Administration</a></li>
                    <?php

                    }
                    if(isset($_SESSION['id']) AND isset($_SESSION['login']))
                    {?>
                        
                        <li><a href='index.php'>Accueil<a></li>
                        <li><a href=index.php?action=formCreatePost> Ajouter un billet</a></li>
                        <li><a href='index.php?action=reportedComments'>Commentaires signalés</a></li>
                        <li><a href=index.php?action=deconnexionAdmin> Deconnexion</a></li>
                    <?php
                    }
                    ?>

    			</ul>
    		</nav>
            
            </div>
    	</header>
        
        <?= $content ?>
        <footer>
        	Blog de Jean Fourterouche - Projet Openclassrooms
        </footer>
    </body>
</html>