<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<h2> Ajouter un nouveau billet </h2>
        <form action="index.php?action=addPost" method="post">
            <div>
                <label for="title">Titre</label><br />
                <input type="text" id="title" name="title" />
            </div>
            <div>
                <label for="content">Contenu</label><br />
                <textarea id="content" name="content"></textarea>
            </div>
            <div>
                <input type="submit" value="Ajouter"/>
            </div>
        </form>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>