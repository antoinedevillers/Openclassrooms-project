<h2> Ajouter un nouveau billet </h2>
        <form action="index.php?action=insertPost&amp;id=<?= $post['id'] ?>" method="post">
            <div>
                <label for="title">Titre</label><br />
                <input type="text" id="title" name="title" />
            </div>
            <div>
                <label for="post">Contenu</label><br />
                <textarea id="post" name="post"></textarea>
            </div>
            <div>
                <input type="submit" value="Ajouter"/>
            </div>
        </form>