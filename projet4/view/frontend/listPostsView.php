<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<section id='billet'>
    
    <h1> Billet simple pour l'Alaska </h1>
    <p>Derniers billets du blog :</p>


    <?php
    while ($data = $posts->fetch())
    {
    ?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
            <?php if(isset($_SESSION['id']) AND isset($_SESSION['login']))
                    {
                    ?>
                    <p><a href="index.php?action=formChangePost&amp;id=<?= $data['id'] ?>" >Modifier le billet</a></p>
                    <?php
                }    
    ?>
        </h3>
        
        <p>
            <?= nl2br(htmlspecialchars($data['content'])) ?>
            <br />
            <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
        </p>
    </div>

    <?php
}
$posts->closeCursor();
?>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>