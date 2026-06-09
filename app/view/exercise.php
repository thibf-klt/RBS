<div class="logout">
<?php if (isset($_SESSION['email'])): ?>
    <p>Bonjour, <?= htmlspecialchars($_SESSION['email']) ?></p>
    <div class="choice">
    <a href="index.php?action=logout"> 
        <button class="buttonService">Se déconnecter</button>
    </a>
    <a href="index.php?action=personalSpace"> 
        <button class="buttonService">Retour menu</button>
    </a>
    </div> 
<?php endif; ?>
</div>

<div id="getExercise">
    <h1>Pour obtenir vos exercices, cliquez sur le(s) lien(s) ci-dessous.</h1>

    <?php if (!empty($exercises)) : ?>
        <table class="tableExercises">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Exercice</th>
                    <th>Document</th>
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
                                <a href="./?action=downloadExercisePdf&file=<?= urlencode($row['pdf_path']) ?>" class="btn-download">
                                    PDF
                                </a>
                            <?php else: ?>
                                Aucun PDF
                            <?php endif; ?>
                        </td>
                        
                        <td>
                            <?php if (!empty($row['media_path'])): ?>
                                <a href="./?action=downloadMedia&file=<?= urlencode($row['media_path']) ?>" class="btn-download">
                                    Média
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

