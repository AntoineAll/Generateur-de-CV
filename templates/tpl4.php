<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; }
        body { font-family: Helvetica, sans-serif; margin: 0; padding: 0; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        .sidebar { width: 30%; background: #1e272e; color: #ffffff; vertical-align: top; padding: 30px 20px; height: 297mm; }
        .main { width: 70%; padding: 40px; vertical-align: top; background: #ffffff; }
        .gold { color: #f1c40f; }
        .section-title { color: #f1c40f; border-bottom: 1px solid #f1c40f; padding-bottom: 5px; margin: 25px 0 15px 0; text-transform: uppercase; }
    </style>
</head>
<body>
    <table>
        <tr>
            <td class="sidebar">
                <h1 class="gold" style="margin:0; font-size:24px;"><?= mb_strtoupper($cv['prenom']) ?><br><?= mb_strtoupper($cv['nom']) ?></h1>
                <p style="margin-top:10px; opacity: 0.8;"><?= htmlspecialchars($cv['titre']) ?></p>

                <div class="section-title">Contact</div>
                <p><?= htmlspecialchars($cv['email']) ?><br><?= htmlspecialchars($cv['telephone']) ?></p>

                <div class="section-title">Langues</div>
                <?php foreach ($cv['langue_nom'] as $i => $nom): if(!empty($nom)): ?>
                    <p><?= htmlspecialchars($nom) ?><br><span class="gold"><?= htmlspecialchars($cv['langue_niveau'][$i]) ?></span></p>
                <?php endif; endforeach; ?>

                <div class="section-title">Loisirs</div>
                <?php foreach ($cv['interet_nom'] as $nom): if(!empty($nom)): ?>
                    <div style="margin-bottom:5px;">• <?= htmlspecialchars($nom) ?></div>
                <?php endif; endforeach; ?>
            </td>
            <td class="main">
                <div class="section-title" style="color:#1e272e; border-color:#1e272e;">Résumé</div>
                <p style="line-height: 1.6;"><?= nl2br(htmlspecialchars($cv['resume'])) ?></p>

                <div class="section-title" style="color:#1e272e; border-color:#1e272e;">Parcours Professionnel</div>
                <?php foreach ($cv['experience_titre'] as $i => $titre): if(!empty($titre)): ?>
                    <div style="margin-bottom:20px; border-left: 3px solid #f1c40f; padding-left:15px;">
                        <div style="font-weight:bold; font-size:12px;"><?= htmlspecialchars($titre) ?></div>
                        <div style="color:#666;"><?= htmlspecialchars($cv['experience_etab'][$i]) ?> | <?= htmlspecialchars($cv['experience_debut'][$i]) ?></div>
                        <p style="margin-top:5px;"><?= nl2br(htmlspecialchars($cv['experience_desc'][$i])) ?></p>
                    </div>
                <?php endif; endforeach; ?>

                <div class="section-title" style="color:#1e272e; border-color:#1e272e;">Diplômes</div>
                <?php foreach ($cv['formation_titre'] as $i => $titre): if(!empty($titre)): ?>
                    <p><strong><?= htmlspecialchars($titre) ?></strong> - <?= htmlspecialchars($cv['formation_etab'][$i]) ?> (<?= htmlspecialchars($cv['formation_fin'][$i]) ?>)</p>
                <?php endif; endforeach; ?>
            </td>
        </tr>
    </table>
</body>
</html>