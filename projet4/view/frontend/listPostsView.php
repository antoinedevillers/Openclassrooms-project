<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<section id='billet'>
    
    <p>Derniers billets du blog :</p>


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
        </div>
        
        
        <p>
            <?= nl2br($data['content']) ?>
            <br />
            <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Lire la suite</a></em>
        </p>
    </div>

    <?php
}
$posts->closeCursor();
?>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>