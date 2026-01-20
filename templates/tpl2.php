<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; }
        body { font-family: Helvetica, sans-serif; margin: 0; padding: 0; font-size: 11px; color: #2d3436; }
        table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        .main { width: 65%; padding: 40px; vertical-align: top; }
        .sidebar { width: 35%; background: #ecfdf5; color: #064e3b; padding: 30px 20px; vertical-align: top; height: 297mm; }
        .section-header { color: #065f46; font-size: 14px; border-left: 4px solid #065f46; padding-left: 10px; margin: 25px 0 12px 0; font-weight: bold; text-transform: uppercase; }
        .photo { width: 120px; height: 120px; border: 4px solid #065f46; margin-bottom: 20px; }
    </style>
</head>
<body>
    <table>
        <tr>
            <td class="main">
                <h1 style="color:#065f46; margin:0; font-size:28px;"><?= htmlspecialchars($cv['prenom'].' '.$cv['nom']) ?></h1>
                <p style="font-size:16px; color:#666; margin: 5px 0 30px 0;"><?= htmlspecialchars($cv['titre']) ?></p>

                <div class="section-header">Résumé</div>
                <p style="line-height: 1.5;"><?= nl2br(htmlspecialchars($cv['resume'])) ?></p>

                <div class="section-header">Expériences</div>
                <?php foreach ($cv['experience_titre'] as $i => $titre): if(!empty($titre)): ?>
                    <div style="margin-bottom:15px;">
                        <strong><?= htmlspecialchars($titre) ?></strong><br>
                        <small style="color:#666;"><?= htmlspecialchars($cv['experience_etab'][$i]) ?> | <?= htmlspecialchars($cv['experience_debut'][$i]) ?></small>
                        <p style="margin-top:5px;"><?= nl2br(htmlspecialchars($cv['experience_desc'][$i])) ?></p>
                    </div>
                <?php endif; endforeach; ?>

                <div class="section-header">Formations</div>
                <?php foreach ($cv['formation_titre'] as $i => $titre): if(!empty($titre)): ?>
                    <div style="margin-bottom:10px;">
                        <strong><?= htmlspecialchars($titre) ?></strong><br>
                        <?= htmlspecialchars($cv['formation_etab'][$i]) ?> (<?= htmlspecialchars($cv['formation_fin'][$i]) ?>)
                    </div>
                <?php endif; endforeach; ?>
            </td>
            <td class="sidebar">
                <?php if (!empty($cv['photo_embed'])): ?><img src="<?= $cv['photo_embed'] ?>" class="photo"><?php endif; ?>
                <div class="section-header">Contact</div>
                <p><?= htmlspecialchars($cv['email']) ?><br><?= htmlspecialchars($cv['telephone']) ?></p>
                
                <div class="section-header">Compétences</div>
                <?php foreach ($cv['competence_nom'] as $nom): if(!empty($nom)): ?>
                    <div style="margin-bottom:5px;">• <?= htmlspecialchars($nom) ?></div>
                <?php endif; endforeach; ?>

                <div class="section-header">Langues</div>
                <?php foreach ($cv['langue_nom'] as $i => $nom): if(!empty($nom)): ?>
                    <p><strong><?= htmlspecialchars($nom) ?></strong>: <?= htmlspecialchars($cv['langue_niveau'][$i]) ?></p>
                <?php endif; endforeach; ?>
            </td>
        </tr>
    </table>
</body>
</html>