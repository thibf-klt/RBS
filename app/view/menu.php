<?php
require_once ROOT . "/app/model/authentification.php";
?>

<nav class="menu" role="navigation">
  
  <i class="fa-solid fa-bars" id="burger"></i>
  
  <ul id="nav-menu">
    <li><a href="index.php?action=presentation">Qui suis-je ?</a></li>
    <li><a href="index.php?action=prestation">Mes prestations</a></li>
    <li><a href="index.php?action=post">Mes articles</a></li>
    <li><a href="index.php?action=testimony">Témoignages</a></li>
    <li><?php if (isLoggedOn()): ?>
        <?php if (isAdmin()): ?>
            <a href="index.php?action=backoffice">Espace personnel</a>
        <?php else: ?>
            <a href="index.php?action=personalSpace">Espace personnel</a>
        <?php endif; ?>
    <?php else: ?>
        <a href="index.php?action=authentification">Espace personnel</a>
    <?php endif; ?></li>
    <li><a href="index.php?action=contact">Contact</a></li>
  </ul>
</nav>
