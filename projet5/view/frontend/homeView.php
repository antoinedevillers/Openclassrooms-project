<?php $title = 'Antoine Devillers Développeur Web'; ?>

<?php ob_start(); ?>

<div class='imageTitle'>
    <h1>Antoine Devillers Développeur Web</h1>    
</div>
<section id='billet'>
    
    <h2 id='derniers_articles'>Derniers Articles</h2>

    <?php
    foreach ($articles as $article) {

    ?>
    <div class="news">
        <div class="container_article_features">
            <h3><a href="index.php?action=article&amp;id=<?= $article->id() ?>"><?= htmlspecialchars($article->title()) ?></a></h3> 

            <i>( mis à jour le <?= $article->creation_date_fr() ?> )</i>

                <?php if(isset($_SESSION['id']) AND isset($_SESSION['login'])){
                ?>
                    <a href="index.php?action=formChangeArticle&amp;id=<?= $article->id() ?>" >Modifier </a> /
                    <a class='btn_deleteArticle' href="index.php?action=deleteArticle&amp;id=<?= $article->id() ?>" onclick="return confirm('Etes vous sûre de vouloir supprimer ce billet ?');" >Supprimer </a>
                <?php
                 }    
                ?>
           <p><?php echo substr($article->content(), 0, 500) . '[...]';?><p>
        </div>
        <p>
            <em><a href="index.php?action=article&amp;id=<?= $article->id() ?>">Lire l'article</a></em>
        </p>
    </div>

    <?php
    }

    /* Si on est sur la première page, on n'a pas besoin d'afficher de lien
     * vers la précédente. On va donc ne l'afficher que si on est sur une autre
     * page que la première */
    ?>
    <div class='pagination'>
    <?php
        $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
        if ($page> 1):
            ?><a href="?page=<?php echo $page - 1; ?>#derniersbillets">Page précédente</a> — <?php
        endif;

        /* On va effectuer une boucle autant de fois que l'on a de pages */
        for ($i = 1; $i <= $countArticles; $i++):
            ?><a href="?page=<?php echo $i; ?>#derniersbillets"><?php echo $i; ?></a> <?php
        endfor;

        /* Avec le nombre total de pages, on peut aussi masquer le lien
         * vers la page suivante quand on est sur la dernière */
        if ($page < $countArticles):
            ?>— <a href="?page=<?php echo $page + 1; ?>#derniersbillets">Page suivante</a><?php
        endif;
        ?>
    </div>
    <h2>
        Portfolio
    </h2>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>