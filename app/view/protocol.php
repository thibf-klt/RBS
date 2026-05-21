<div class="logout">
<?php if (isset($_SESSION['email'])): ?>
    <p>Bonjour, <?= htmlspecialchars($_SESSION['email']) ?></p>
    <a href="index.php?action=logout"> 
        <button class="buttonService">Se déconnecter</button>
    </a>
<?php endif; ?>
</div>
<div class="protocol">
    <h1>Pour obtenir votre protocole, cliquez sur le lien ci-dessous.</h1>

    <a href="index.php?action=download&file=document.pdf" class="buttonSophro">Télécharger</a>
</div>
</body>
</html>