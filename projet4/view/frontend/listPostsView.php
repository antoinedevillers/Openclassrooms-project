<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<section id='billet'>
    
    <?php

    // SI je suis connecté en tant qu'admin, le formulaire pour ajouter un billet s'affichera
    if(isset($_SESSION['id']) AND isset($_SESSION['login']))
    {
        echo 'Bienvenue ' . $_SESSION['login'] . ' en tant qu\'administrateur';
    ?>

        <p><a href=index.php?action=deconnexionAdmin> Deconnexion</a></p>
        <p><a href=index.php?action=addPost> Ajouter un billet</a><p>
    <?php
        
    }
    ?>
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

<?php require('template.php'); ?>