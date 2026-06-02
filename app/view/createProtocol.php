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
    <h1>Enregistrement d'un protocole client.e</h1>
    <form action="./?action=createProtocol" method="POST" enctype="multipart/form-data" class="formGrid">

        <label for="idClient">Client&nbsp;:</label><br>
        <select name="idClient" id="idClient" required>
        <option value="">-- Sélectionner un client --</option>
        <?php foreach ($users as $u): ?>
            <option value="<?= $u["idUser"] ?>">
                <?= htmlspecialchars($u["firstName"] . " " . $u["name"]) ?>
            </option>
        <?php endforeach; ?>
        </select><br>

        <label for="title">Titre du protocole&nbsp;:</label><br>
        <input type="text" id="title" name="title"
            placeholder="Titre du protocole" required/><br>

        <label for="protocol">Fichier PDF&nbsp;:</label><br>
        <input type="file" id="protocol" name="protocol" accept=".pdf" required/>

        <input type="submit" value="Ajouter le protocole" class="buttonSophro"/>
    </form>
</div>
<div id="deleteProtocol">

    <h1>Supprimer un protocole</h1>

        <form action="./?action=deleteProtocol" method="POST" class="formGrid">

            <label for="idClientDelete">Client&nbsp;:</label><br>
            <select name="idClient" id="idClientDelete" required>
                <option value="">-- Sélectionner un.e client.e --</option>
                <?php foreach ($users as $u): ?>
                    <option value="<?= $u["idUser"] ?>">
                        <?= htmlspecialchars($u["firstName"] . " " . $u["name"]) ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="listProtocolsUser">Protocole&nbsp;:</label><br>
            <select name="idProtocol" id="listProtocolsUser" required>
                <option value="">-- Sélectionner un protocole --</option>
            </select><br><br>

            <input type="submit" value="Supprimer le protocole"
                   class="buttonService"/>
        </form>
    </div>

</div>