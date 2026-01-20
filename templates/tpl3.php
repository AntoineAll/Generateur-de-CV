<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; }
        body { font-family: 'Helvetica', sans-serif; margin: 0; padding: 0; font-size: 11px; }
        .tpl-header { height: 160px; padding: 40px 20px; text-align: center; border-bottom: 4px solid #6c5ce7; background: white; box-sizing: border-box; }
        .tpl-container { width: 100%; border-collapse: collapse; table-layout: fixed; }
        .tpl-sidebar { width: 35%; background: #f3f0ff; color: #2d3436; vertical-align: top; padding: 30px 20px; height: 230mm; }
        .tpl-main { width: 65%; background: #ffffff; vertical-align: top; padding: 35px 40px; }
        .section-header { border-bottom: 2px solid #6c5ce7; color: #6c5ce7; font-weight: bold; margin-bottom: 15px; padding-bottom: 5px; text-transform: uppercase; font-size: 10px; }
        .badge-item { display: inline-block; background: #f1f3f5; color: #343a40; border: 1px solid #dee2e6; padding: 4px 10px; border-radius: 4px; margin-right: 6px; margin-bottom: 8px; font-size: 9px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="tpl-header">
        <h1 style="margin: 0; font-size: 24px;"><?= mb_strtoupper($cv['prenom'] . ' ' . $cv['nom']) ?></h1>
        <div style="color: #6c5ce7; font-weight: bold; font-size: 14px; margin-top: 5px;"><?= htmlspecialchars($cv['titre']) ?></div>
        <div style="font-size: 11px; color: #666; margin-top: 10px;"><?= htmlspecialchars($cv['email']) ?> | <?= htmlspecialchars($cv['telephone']) ?></div>
    </div>
    <table class="tpl-container">
        <tr>
            <td class="tpl-sidebar">
                <div class="section-header">Compétences</div>
                <?php foreach ($cv['competence_nom'] as $nom): if(!empty($nom)): ?>
                    <div style="background:#fff; border:1px solid #6c5ce7; padding:6px; margin-bottom:6px; border-radius:4px; color:#6c5ce7; font-weight:bold; font-size:9px;"><?= htmlspecialchars($nom) ?></div>
                <?php endif; endforeach; ?>
            </td>
            <td class="tpl-main">
                <div class="section-header">Profil</div>
                <div style="font-style: italic; margin-bottom: 25px;"><?= nl2br(htmlspecialchars($cv['resume'])) ?></div>
                <div class="section-header">Expériences</div>
                <?php foreach ($cv['experience_titre'] as $i => $titre): if(!empty($titre)): ?>
                    <div style="margin-bottom:15px;">
                        <div style="font-weight:bold; font-size:12px;"><?= htmlspecialchars($titre) ?></div>
                        <div style="color:#666; font-size:10px;"><?= htmlspecialchars($cv['experience_etab'][$i]) ?> | <?= htmlspecialchars($cv['experience_debut'][$i]) ?></div>
                        <div style="margin-top:5px; white-space: pre-line;"><?= htmlspecialchars($cv['experience_desc'][$i]) ?></div>
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