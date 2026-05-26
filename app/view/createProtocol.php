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

<div id="createProtocol">
    <h2>Ajout d'un protocole à un.e client.e</h2>

    <?php if (!empty($erreur)): ?>
        <p class="error"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <?php if (!empty($succes)): ?>
        <p class="success"><?= htmlspecialchars($succes) ?></p>
    <?php endif; ?>

    <!-- enctype obligatoire pour l'envoi de fichier -->
    <form action="./?action=createProtocol" method="POST" enctype="multipart/form-data" class="form">

        <label for="firstName">Prénom&nbsp;client.e&nbsp;:</label>
        <input type="text" id="firstName" name="firstName"
               placeholder="Prénom client.e" required
               aria-label="Entrez le prénom client.e" aria-required="true"/><br/>

        <label for="name">Nom&nbsp;client.e&nbsp;:</label>
        <input type="text" id="name" name="name"
               placeholder="Nom client.e" required
               aria-label="Entrez le nom client.e" aria-required="true"/><br/>

            <label for="title">Titre&nbsp;:</label>
        <input type="text" id="title" name="title"
               placeholder="Titre" required
               aria-label="Entrez le titre" aria-required="true"/><br/>

        <label for="protocol">Parcourir l'ordinateur pour ajouter le protocole&nbsp;:</label><br/>
        <input type="file" id="protocol" name="protocol"
               accept=".pdf" required
               aria-label="Sélectionnez un fichier PDF" aria-required="true"/><br/><br/>

        <!-- Le bouton submit doit être DANS le form, pas un lien -->
        <input type="submit" value="Ajouter le protocole" class="buttonSophro"/>

    </form>
</div>