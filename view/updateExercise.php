<div id="form">
    <h1>Ajout d'un exercice/protocole pour un client</h1>
        <form action=".php" method="post">

            <p><label for="title">Titre :</label>
                <input type="text" maxlength="30" name="title" id="title"
                    placeholder="Titre" value=<?= $_POST["title"] ?? '' ?>>
                <?php if (isset($errors['title'])) echo("<br><span class='error'>".$errors['title']."</span>"); ?>
            </p>
            <p><label for="content">Texte :</label>
                <input type="text" maxlength="300"  name="content" id="content"
                    placeholder="Texte de l'article" value=<?= $_POST["content"] ?? '' ?>>
                <?php if (isset($errors['content'])) echo("<br><span class='error'>".$errors['content']."</span>"); ?>
            </p>
            <p><label for="date">Date :</label>
                <input type="date" name="date" id="date"
                    placeholder="Date de publication" value=<?= $_POST["date"] ?? '' ?>>
                <?php if (isset($errors['date'])) echo("<br><span class='error'>".$errors['date']."</span>"); ?>
            </p>
            <p><input type="submit" class="button" value="Enregistrer"></p>
        </form>
</div>