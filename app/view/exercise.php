<div class="logout">
<?php if (isset($_SESSION['email'])): ?>
    <p>Bonjour, <?= htmlspecialchars($_SESSION['email']) ?></p>
    <a href="index.php?action=logout"> 
        <button class="buttonService">Se déconnecter</button>
    </a>
<?php endif; ?>
</div>

<div id="getExercise">
    <h1>Pour obtenir vos exercices, cliquez sur le(s) lien(s) ci-dessous.</h1>

    <?php if (!empty($exercises)) : ?>
        <table class="table-exercises">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Exercice</th>
                    <th>Document PDF</th>
                    <th>Média</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exercises as $row) : ?>
                    <tr>
                        <td><?= htmlspecialchars($row['date_']) ?></td>
                        <td><?= htmlspecialchars($row['ex_title']) ?></td>
                        
                        <td>
                            <?php if (!empty($row['pdf_path'])): ?>
                                <a href="<?= htmlspecialchars($row['pdf_path']) ?>" download class="btn-download">
                                    Télécharger le PDF
                                </a>
                            <?php else: ?>
                                Aucun PDF
                            <?php endif; ?>
                        </td>
                        
                        <td>
                            <?php if (!empty($row['media_path'])): ?>
                                <a href="<?= htmlspecialchars($row['media_path']) ?>" download class="btn-download">
                                    Télécharger le Média
                                </a>
                            <?php else: ?>
                                Aucun Média
                            <?php endif; ?>
                        </td>
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