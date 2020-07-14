<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

            <div class='imageTitle'>
            <h1>Billet simple pour l'Alaska</h1>
            <p id ="anchorLastPosts"><a href='#derniersbillets'>Voir les derniers chapitres<a></p>    
</div>
<section id='billet'>
    
    <h2 id='derniersbillets'>Derniers billets du blog :</h2>


    <?php
    while ($data = $posts->fetch())
    {
    ?>
    <div class="news">
        <div class="container_post_features">
          <h3><a href="index.php?action=post&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']) ?></a></h3> 
            <i>( mis à jour le <?= $data['creation_date_fr'] ?> )
                <?php if(isset($_SESSION['id']) AND isset($_SESSION['login']))
                    {
                    ?>
                    <a href="index.php?action=formChangePost&amp;id=<?= $data['id'] ?>" >Modifier </a> /
                    <a href="index.php?action=deletePost&amp;id=<?= $data['id'] ?>" >Supprimer </a>
                    <?php
                     }    
                    ?>
            </i>
           <p><?php echo substr($data['content'], 0, 500) . '[...]';?><p>
        </div>
        
        
        <p>
            <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Lire le chapitre</a></em>
        </p>
    </div>

    <?php
}
$posts->closeCursor();

/* Si on est sur la première page, on n'a pas besoin d'afficher de lien
 * vers la précédente. On va donc ne l'afficher que si on est sur une autre
 * page que la première */

$page = (!empty($_GET['page']) ? $_GET['page'] : 1);
if ($page> 1):
    ?><a href="?page=<?php echo $page - 1; ?>">Page précédente</a> — <?php
endif;

/* On va effectuer une boucle autant de fois que l'on a de pages */
for ($i = 1; $i <= $countPosts; $i++):
    ?><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a> <?php
endfor;

/* Avec le nombre total de pages, on peut aussi masquer le lien
 * vers la page suivante quand on est sur la dernière */
if ($page < $countPosts):
    ?>— <a href="?page=<?php echo $page + 1; ?>">Page suivante</a><?php
endif;


?>

</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>