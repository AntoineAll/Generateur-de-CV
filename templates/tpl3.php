<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; }
        body { font-family: Helvetica, sans-serif; margin: 0; padding: 0; font-size: 11px; }
        .header { background: #6c5ce7; color: white; text-align: center; padding: 35px; }
        table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        .col { padding: 30px; vertical-align: top; }
        .title { color: #6c5ce7; border-bottom: 1px solid #ddd; padding-bottom: 5px; margin-bottom: 15px; text-transform: uppercase; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin:0; font-size:26px;"><?= mb_strtoupper($cv['prenom'].' '.$cv['nom']) ?></h1>
        <div style="font-size:16px; margin:5px 0;"><?= htmlspecialchars($cv['titre']) ?></div>
        <p><?= htmlspecialchars($cv['email']) ?> | <?= htmlspecialchars($cv['telephone']) ?></p>
    </div>
    <table>
        <tr>
            <td class="col" style="width: 35%; background: #f9f8ff; height: 220mm;">
                <div class="title">Compétences</div>
                <?php foreach ($cv['competence_nom'] as $nom): if(!empty($nom)): ?>
                    <div style="background:white; padding:5px; margin-bottom:5px; border: 1px solid #eee;"><?= htmlspecialchars($nom) ?></div>
                <?php endif; endforeach; ?>

                <div class="title">Langues</div>
                <?php foreach ($cv['langue_nom'] as $i => $nom): if(!empty($nom)): ?>
                    <p><strong><?= htmlspecialchars($nom) ?></strong> (<?= htmlspecialchars($cv['langue_niveau'][$i]) ?>)</p>
                <?php endif; endforeach; ?>
            </td>
            <td class="col" style="width: 65%;">
                <div class="title">Résumé</div>
                <p><?= nl2br(htmlspecialchars($cv['resume'])) ?></p>

                <div class="title">Expériences</div>
                <?php foreach ($cv['experience_titre'] as $i => $titre): if(!empty($titre)): ?>
                    <div style="margin-bottom:15px;">
                        <strong><?= htmlspecialchars($titre) ?></strong><br>
                        <small style="color:#666;"><?= htmlspecialchars($cv['experience_etab'][$i]) ?> | <?= htmlspecialchars($cv['experience_debut'][$i]) ?></small>
                        <p style="margin-top:5px;"><?= nl2br(htmlspecialchars($cv['experience_desc'][$i])) ?></p>
                    </div>
                <?php endif; endforeach; ?>

                <div class="title">Formations</div>
                <?php foreach ($cv['formation_titre'] as $i => $titre): if(!empty($titre)): ?>
                    <p><strong><?= htmlspecialchars($titre) ?></strong><br><?= htmlspecialchars($cv['formation_etab'][$i]) ?> (<?= htmlspecialchars($cv['formation_fin'][$i]) ?>)</p>
                <?php endif; endforeach; ?>
            </td>
        </tr>
    </table>
</body>
</html>