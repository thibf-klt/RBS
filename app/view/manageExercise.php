<?php
if (!isset($_SESSION["email"])) {
    header("Location: ./?action=connexion");
    exit();
}
?>
<div class="logout">
    <?php if (isset($_SESSION['email'])): ?>
        <p>Bonjour, <?= htmlspecialchars($_SESSION['email']) ?></p>
        <a href="index.php?action=logout">
            <button class="buttonService">Se déconnecter</button>
        </a>
    <?php endif; ?>
</div>
<main id="manageExercise">

    <!-- ===== Add an exercise ===== -->
    <div id="exercise">
        <h1>Charger un exercice pour un.e client.e</h1>
        <?php if (!empty($erreur)): ?>
            <p style="color:red;"><?= htmlspecialchars($erreur) ?></p>
        <?php endif; ?>
        <?php if (!empty($succes)): ?>
            <p style="color:green;"><?= htmlspecialchars($succes) ?></p>
        <?php endif; ?>
        <form action="./?action=createExercise" method="POST"
              enctype="multipart/form-data" class="formGrid">
            <label for="idClient">Client&nbsp;:</label><br>
            <select name="idClient" id="idClient" required>
                <option value="">-- Sélectionner un.e client.e --</option>
                <?php foreach ($users as $u): ?>
                    <option value="<?= $u["idUser"] ?>">
                        <?= htmlspecialchars($u["firstName"] . " " . $u["name"]) ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>
            <label for="title">Titre de l'exercice&nbsp;:</label><br>
            <input type="text" id="title" name="title"
                   placeholder="Titre de l'exercice" required/><br><br>
            <label for="exercisePdf">Fichier PDF (optionnel)&nbsp;:</label><br>
            <input type="file" id="exercisePdf" name="exercisePdf"
                   accept=".pdf"/><br><br>
            <label for="exerciseMedia">Média (optionnel)&nbsp;:</label><br>
            <input type="file" id="exerciseMedia" name="exerciseMedia"
                   accept=".mp3,.mp4"/><br><br>
            <p id="fileError" style="color:red; display:none;">
                Veuillez fournir au moins un fichier (PDF ou média).
            </p>
            <input type="submit" value="Ajouter la session d'exercice"
                   class="buttonSophro"/>
        </form>
    </div>

    <!-- ===== Delete an exercise ===== -->
    <div id="deleteExercise">
        <h1>Supprimer un exercice</h1>
        <?php if (isset($_GET['succes'])): ?>
            <p style="color:green;">Exercice supprimé avec succès.</p>
        <?php elseif (isset($_GET['erreur'])): ?>
            <p style="color:red;">Erreur lors de la suppression.</p>
        <?php endif; ?>
        <form action="./?action=deleteExercise" method="POST" class="formGrid">
            <label for="idClientDelete">Client&nbsp;:</label><br>
            <select name="idClient" id="idClientDelete" required>
                <option value="">-- Sélectionner un.e client.e --</option>
                <?php foreach ($users as $u): ?>
                    <option value="<?= $u["idUser"] ?>">
                        <?= htmlspecialchars($u["firstName"] . " " . $u["name"]) ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>
            <label for="listExercicesUser">Exercice&nbsp;:</label><br>
            <select name="idExercise" id="listExercicesUser" required>
                <option value="">-- Sélectionner un exercice --</option>
            </select><br><br>
            <input type="submit" value="Supprimer l'exercice" class="buttonService"/>
        </form>
    </div>

</main>
