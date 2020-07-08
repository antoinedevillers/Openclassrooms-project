<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
    	<header>
    		<nav>
    			<ul>
    				<li><a href='index.php'>Accueil<a></li>
                    <?php if(!isset($_SESSION['id']) AND !isset($_SESSION['login']))
                    {?>
    				<li><a href='index.php?action=formConnexionAdmin' >Connexion Administration</a></li>
                    <?php
                    }
                    ?>
    			</ul>
    		</nav>
    	</header>
        <?= $content ?>
        <footer>
        	Blog de Jean Fourterouche - Projet Openclassrooms
        </footer>
    </body>
</html>