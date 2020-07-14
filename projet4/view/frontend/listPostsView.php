<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

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
?>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>