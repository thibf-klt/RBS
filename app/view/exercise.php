<div class="logout">
<?php if (isset($_SESSION['email'])): ?>
    <p>Bonjour, <?= htmlspecialchars($_SESSION['email']) ?></p>
    <a href="index.php?action=logout"> 
        <button class="buttonService">Se déconnecter</button>
    </a>
<?php endif; ?>
</div>
<div class="protocol">
    <h1>Pour obtenir vos exercices, cliquez sur le.s lien.s ci-dessous.</h1>

    <?php if (!empty($protocols)) : ?>
            <thead>
                <tr>
                    <?php foreach (array_keys($protocols[0]) as $colonne) : ?>
                        <th><?= htmlspecialchars($colonne) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($protocols as $row) : ?>
                    <tr>
                        <?php foreach ($row as $valeur) : ?>
                            <td><?= htmlspecialchars($valeur) ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Pas d'exercice à votre nom.</p>
    <?php endif; ?>
</div>
</body>
</html>