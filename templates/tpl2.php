<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; }
        body { font-family: 'Helvetica', sans-serif; margin: 0; padding: 0; font-size: 11px; }
        .tpl-container { width: 100%; border-collapse: collapse; table-layout: fixed; height: 297mm; }
        .tpl-sidebar { width: 35%; background: #ecfdf5; color: #064e3b; vertical-align: top; padding: 30px 20px; }
        .tpl-main { width: 65%; background: #ffffff; vertical-align: top; padding: 35px 40px; }
        .section-header { border-bottom: 2px solid #065f46; color: #065f46; font-weight: bold; margin-bottom: 15px; padding-bottom: 5px; font-size: 10px; text-transform: uppercase; }
        .badge-item { display: inline-block; background: #ffffff; color: #064e3b; border: 1px solid #065f46; padding: 4px 8px; border-radius: 4px; margin-right: 4px; margin-bottom: 6px; font-weight: bold; }
    </style>
</head>
<body>
    <table class="tpl-container">
        <tr>
            <td class="tpl-main">
                <h1 style="color:#065f46; margin:0; font-size:24px;"><?= mb_strtoupper($cv['prenom'] . ' ' . $cv['nom']) ?></h1>
                <p style="font-size:14px; font-weight:bold; color:#666;"><?= htmlspecialchars($cv['titre']) ?></p>
                
                <div class="section-header" style="margin-top:30px;">Profil</div>
                <div style="font-style: italic; margin-bottom: 20px;"><?= nl2br(htmlspecialchars($cv['resume'])) ?></div>

                <div class="section-header">Expériences Professionnelles</div>
                <?php foreach ($cv['experience_titre'] as $i => $titre): if(!empty($titre)): ?>
                    <div style="margin-bottom:15px;">
                        <div style="font-weight:bold; color:#065f46; font-size:12px;"><?= htmlspecialchars($titre) ?></div>
                        <div style="font-size:10px; color:#666;"><?= htmlspecialchars($cv['experience_etab'][$i]) ?> | <?= htmlspecialchars($cv['experience_debut'][$i]) ?> - <?= htmlspecialchars($cv['experience_fin'][$i]) ?></div>
                        <div style="margin-top:5px; white-space: pre-line;"><?= htmlspecialchars($cv['experience_desc'][$i]) ?></div>
                    </div>
                <?php endif; endforeach; ?>

                <div class="section-header">Centres d'intérêt</div>
                <?php foreach ($cv['interet_nom'] as $nom): if(!empty($nom)): ?>
                    <span class="badge-item" style="background:#f1f3f5; border:1px solid #dee2e6; color:#333;"><?= htmlspecialchars($nom) ?></span>
                <?php endif; endforeach; ?>
            </td>
            <td class="tpl-sidebar">
                <?php if (!empty($cv['photo_embed'])): ?>
                    <img src="<?= $cv['photo_embed'] ?>" style="width:125px; height:125px; border:3px solid #065f46; border-radius:50%; margin-bottom:20px; display:block; margin: 0 auto 20px;">
                <?php endif; ?>
                <div class="section-header">Contact</div>
                <div style="font-size:10px; margin-bottom:25px;">
                    <?= htmlspecialchars($cv['email']) ?><br><?= htmlspecialchars($cv['telephone']) ?>
                </div>
                <div class="section-header">Compétences</div>
                <?php foreach ($cv['competence_nom'] as $i => $nom): if(!empty($nom)): ?>
                    <span class="badge-item"><?= htmlspecialchars($nom) ?></span>
                <?php endif; endforeach; ?>
            </td>
        </tr>
    </table>
</body>
</html>