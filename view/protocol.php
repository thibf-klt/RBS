<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Protocoles</title>
</head>
<body>
    <h2>Pour obtenir votre protocole, cliquez sur le lien ci-dessous.</h2>

    <?php if (!empty($protocols)) : ?>
        
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
        <p>Pas de protocole à votre nom.</p>
    <?php endif; ?>

</body>
</html>