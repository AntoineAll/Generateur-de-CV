<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; }
        body { font-family: 'Helvetica', sans-serif; margin: 0; padding: 0; font-size: 11px; }
        .tpl-header { height: 160px; background: #000; color: #fff; text-align: right; padding: 40px 50px; box-sizing: border-box; }
        .tpl-container { width: 100%; border-collapse: collapse; table-layout: fixed; }
        .tpl-sidebar { width: 35%; background: #1e272e; color: #ffffff; vertical-align: top; padding: 30px 20px; height: 230mm; }
        .tpl-main { width: 65%; background: #ffffff; vertical-align: top; padding: 35px 40px; }
        .section-header { border-bottom: 2px solid #f1c40f; color: #f1c40f; font-weight: bold; margin-bottom: 15px; padding-bottom: 5px; text-transform: uppercase; font-size: 10px; }
        .badge-item { display: inline-block; background: #34495e; color: #fff; border: 1px solid #4b6584; padding: 4px 10px; border-radius: 4px; margin-right: 6px; margin-bottom: 8px; font-size: 9px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="tpl-header">
        <h1 style="margin: 0; font-size: 28px; letter-spacing: 2px;"><?= mb_strtoupper($cv['prenom'] . ' ' . $cv['nom']) ?></h1>
        <div style="color: #f1c40f; font-size: 16px; font-weight: bold;"><?= htmlspecialchars($cv['titre']) ?></div>
    </div>
    <table class="tpl-container">
        <tr>
            <td class="tpl-sidebar">
                <div class="section-header">Contact</div>
                <div style="font-size:10px; margin-bottom:25px; color: #fff;">
                    <?= htmlspecialchars($cv['email']) ?><br><?= htmlspecialchars($cv['telephone']) ?>
                </div>
                <div class="section-header">Compétences</div>
                <?php foreach ($cv['competence_nom'] as $nom): if(!empty($nom)): ?>
                    <span class="badge-item"><?= htmlspecialchars($nom) ?></span>
                <?php endif; endforeach; ?>
            </td>
            <td class="tpl-main">
                <div class="section-header" style="color:#1e272e; border-color:#1e272e;">Profil</div>
                <div style="font-style: italic; margin-bottom: 20px; line-height: 1.6;"><?= nl2br(htmlspecialchars($cv['resume'])) ?></div>
                
                <div class="section-header" style="color:#1e272e; border-color:#1e272e;">Expériences Professionnelles</div>
                <?php foreach ($cv['experience_titre'] as $i => $titre): if(!empty($titre)): ?>
                    <div style="margin-bottom: 20px; border-left: 3px solid #f1c40f; padding-left: 15px;">
                        <div style="font-weight: bold; font-size: 12px;"><?= htmlspecialchars($titre) ?></div>
                        <div style="color: #7f8c8d; font-size: 10px;"><?= htmlspecialchars($cv['experience_etab'][$i]) ?> | <?= htmlspecialchars($cv['experience_debut'][$i]) ?></div>
                        <div style="margin-top: 5px; white-space: pre-line; font-size: 10px;"><?= htmlspecialchars($cv['experience_desc'][$i]) ?></div>
                    </div>
                <?php endif; endforeach; ?>

                <div class="section-header" style="color:#1e272e; border-color:#1e272e;">Centres d'intérêt</div>
                <?php foreach ($cv['interet_nom'] as $nom): if(!empty($nom)): ?>
                    <span class="badge-item" style="background:#f1f3f5; color:#333; border-color:#ddd;"><?= htmlspecialchars($nom) ?></span>
                <?php endif; endforeach; ?>
            </td>
        </tr>
    </table>
</body>
</html>