
<?php

// Partie "Requête"
$db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
/* On commence par récupérer le nombre d'éléments total. Comme c'est une requête,
 * il ne faut pas oublier qu'on ne récupère pas directement le nombre.
 * Ici, comme la requête ne contient aucune donnée client pour fonctionner,
 * on peut l'exécuter ainsi directement */
$req = $db->query('SELECT COUNT(id) AS nb_billets FROM billets'); 
$nombredElementsTotal = $req->fetchColumn(); 



// Partie "Liens"
/* On calcule le nombre de pages */
$nombreDePages = ceil($nombredElementsTotal / $limite);


/* Si on est sur la première page, on n'a pas besoin d'afficher de lien
 * vers la précédente. On va donc ne l'afficher que si on est sur une autre
 * page que la première */
if ($page > 1):
    ?><a href="?page=<?php echo $page - 1; ?>">Page précédente</a> — <?php
endif;

/* On va effectuer une boucle autant de fois que l'on a de pages */
for ($i = 1; $i <= $nombreDePages; $i++):
    ?><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a> <?php
endfor;

/* Avec le nombre total de pages, on peut aussi masquer le lien
 * vers la page suivante quand on est sur la dernière */
if ($page < $nombreDePages):
    ?>— <a href="?page=<?php echo $page + 1; ?>">Page suivante</a><?php
endif;
?>