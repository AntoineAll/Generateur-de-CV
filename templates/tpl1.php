<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; }
        body { font-family: 'Helvetica', sans-serif; margin: 0; padding: 0; color: #333; font-size: 11px; }
        .tpl-container { width: 100%; border-collapse: collapse; table-layout: fixed; height: 297mm; }
        .tpl-sidebar { width: 35%; background: #f8f9fa; color: #212529; vertical-align: top; padding: 30px 20px; }
        .tpl-main { width: 65%; background: #ffffff; vertical-align: top; padding: 35px 40px; }
        .section-header { border-bottom: 2px solid #004aad; color: #004aad; font-weight: bold; margin-bottom: 15px; padding-bottom: 5px; font-size: 10px; text-transform: uppercase; }
        .preview-photo { width: 125px; height: 125px; border: 3px solid #004aad; border-radius: 50%; margin-bottom: 20px; display: block; margin-left: auto; margin-right: auto; }
        .badge-item { display: inline-block; background: #f1f3f5; color: #343a40; border: 1px solid #dee2e6; padding: 4px 8px; border-radius: 4px; margin-right: 4px; margin-bottom: 6px; font-weight: bold; font-size: 9px; }
        .block-item { margin-bottom: 18px; }
    </style>
</head>
<body>
    <table class="tpl-container">
        <tr>
            <td class="tpl-sidebar">
                <?php if (!empty($cv['photo_embed'])): ?>
                    <img src="<?= $cv['photo_embed'] ?>" class="preview-photo">
                <?php endif; ?>
                <h2 style="font-size: 18px; margin-bottom: 5px;"><?= mb_strtoupper($cv['prenom'] . ' ' . $cv['nom']) ?></h2>
                <p style="color: #004aad; font-weight: bold; margin-bottom: 10px;"><?= htmlspecialchars($cv['titre']) ?></p>
                <div style="font-size: 10px; margin-bottom: 25px;">
                    <?= htmlspecialchars($cv['email']) ?><br><?= htmlspecialchars($cv['telephone']) ?>
                </div>

                <div class="section-header">Compétences</div>
                <?php foreach ($cv['competence_nom'] as $i => $nom): if(!empty($nom)): ?>
                    <span class="badge-item"><?= htmlspecialchars($nom) ?> <?= !empty($cv['competence_niveau'][$i]) ? '('.htmlspecialchars($cv['competence_niveau'][$i]).')' : '' ?></span>
                <?php endif; endforeach; ?>

                <div class="section-header" style="margin-top:25px;">Langues</div>
                <?php foreach ($cv['langue_nom'] as $i => $nom): if(!empty($nom)): ?>
                    <div style="margin-bottom:5px"><strong><?= htmlspecialchars($nom) ?></strong> : <?= htmlspecialchars($cv['langue_niveau'][$i]) ?></div>
                <?php endif; endforeach; ?>
            </td>
            <td class="tpl-main">
                <div class="section-header">Profil</div>
                <div style="font-style: italic; opacity: 0.9; margin-bottom: 25px; line-height: 1.6;"><?= nl2br(htmlspecialchars($cv['resume'])) ?></div>

                <div class="section-header">Expériences Professionnelles</div>
                <?php foreach ($cv['experience_titre'] as $i => $titre): if(!empty($titre)): ?>
                    <div class="block-item">
                        <div style="font-weight:bold; font-size:12px;"><?= htmlspecialchars($titre) ?></div>
                        <div style="color:#6c757d; font-size:10px;"><?= htmlspecialchars($cv['experience_etab'][$i]) ?> | <?= htmlspecialchars($cv['experience_debut'][$i]) ?> - <?= htmlspecialchars($cv['experience_fin'][$i]) ?></div>
                        <div style="margin-top:5px; white-space: pre-line;"><?= htmlspecialchars($cv['experience_desc'][$i]) ?></div>
                    </div>
                <?php endif; endforeach; ?>

                <div class="section-header">Formations</div>
                <?php foreach ($cv['formation_titre'] as $i => $titre): if(!empty($titre)): ?>
                    <div class="block-item">
                        <div style="font-weight:bold;"><?= htmlspecialchars($titre) ?></div>
                        <div style="color:#6c757d; font-size:10px;"><?= htmlspecialchars($cv['formation_etab'][$i]) ?> | <?= htmlspecialchars($cv['formation_debut'][$i]) ?> - <?= htmlspecialchars($cv['formation_fin'][$i]) ?></div>
                    </div>
                <?php endif; endforeach; ?>

                <div class="section-header">Centres d'intérêt</div>
                <?php foreach ($cv['interet_nom'] as $nom): if(!empty($nom)): ?>
                    <span class="badge-item"><?= htmlspecialchars($nom) ?></span>
                <?php endif; endforeach; ?>
            </td>
        </tr>
    </table>
</body>
</html>