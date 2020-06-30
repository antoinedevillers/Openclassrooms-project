<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
        <link href="style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> </p>
            <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <h1>Mon super blog !</h1><h2> Modifier le commentaire </h2>
        <form action="index.php?action=changeComment&amp;id=<?= $comment['id']?>" method="post">
            
            <div>
                <input id="postId" name="postId" type="hidden" value="<?= $comment['post_id'] ?>">
                <label for="comment">Commentaire</label><br />
                <textarea id="comment" name="comment"></textarea>
            </div>
            <div>
                <input type="submit" />
            </div>
        </form>
    </body>
</html>