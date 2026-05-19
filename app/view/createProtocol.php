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
    
    <form action="./?action=#" method="POST" class="form">
        <label for="firstName">Prénom&nbsp;client.e&nbsp;:</label>
        <input type="text" name="firstName" placeholder="Prénom client.e" required aria-label="Entrez le prénom client.e" aria-required="true"/><br />
        <label for="name">Nom&nbsp;client.e&nbsp;:</label>
        <input type="text" name="name" placeholder="Nom client.e" required aria-label="Entrez le nom client.e" aria-required="true"/><br />
        <label for="protocol">Parcourir l'ordinateur pour ajouter le protocole:</label><br>
        <input type="file"
        id="protocol" name="protocol"
        accept="file/pdf, file/dotx">
        <a href="index.php?action=addProtocol"> 
        <button class="buttonSophro">Ajouter le protocole</button>
    </a>    
</form>
    
    
    
</div>
</body>
</html>