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
    <p>recherche du client/ajout de protocole, parcourir l'ordi</p>
    <a href="index.php?action=addProtocol"> 
        <button class="buttonSophro">Ajouter le protocole</button>
    </a>
</div>
</body>
</html>