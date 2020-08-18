<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<section>
    
   <h2>Commentaires signalés</h2>
    
    <?php
    if (isset($reportedComments)){
        foreach ($reportedComments as $reportedComment)
        {
        ?>
        <div class='containerReportedComment'>
            <p><strong><?= htmlspecialchars($reportedComment->author()) ?></strong> le <?= $reportedComment->comment_date_fr() ?>
                <a href='index.php?action=allowComment&amp;id=<?= $reportedComment->id() ?>' onclick="return confirm('Etes vous sûre de vouloir autoriser ce commentaire ?');">Autoriser </a> /
                <a href='index.php?action=deleteComment&amp;id=<?= $reportedComment->id() ?>' onclick="return confirm('Etes vous sûre de vouloir supprimer ce commentaire ?');">Supprimer</a>
            </p>
            <p class ='comment'><?= nl2br(htmlspecialchars($reportedComment->com())) ?></p>
        </div>
        <?php
        }
    } else {
    ?> <p class='containerReportedComment'> Aucun commentaire signalé <p>
    <?php
    }
    ?>

</section>
<p class='returnListPosts'><a href="index.php">Retour à la liste des billets</a></p>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>