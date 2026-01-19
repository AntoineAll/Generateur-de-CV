<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; }
        body { font-family: 'Helvetica', sans-serif; margin: 0; padding: 0; background: #fff; }
        .top-bar { background: #1e272e; color: #f1c40f; padding: 50px; text-align: right; }
        .sidebar { position: absolute; top: 180px; left: 0; bottom: 0; width: 250px; background: #1e272e; color: white; padding: 30px; }
        .content { margin-left: 320px; padding-top: 30px; padding-right: 50px; }
        .gold-title { color: #f1c40f; border-bottom: 1px solid #f1c40f; padding-bottom: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="top-bar">
        <h1 style="margin: 0; font-size: 35px;"><?php echo htmlspecialchars($cv['prenom'] . ' ' . $cv['nom']); ?></h1>
        <div style="font-size: 18px;"><?php echo htmlspecialchars($cv['titre']); ?></div>
    </div>

    <div class="sidebar">
        <h4 class="gold-title">Contact</h4>
        <p style="font-size: 11px;"><?php echo htmlspecialchars($cv['email']); ?></p>
        <p style="font-size: 11px;"><?php echo htmlspecialchars($cv['telephone']); ?></p>

        <h4 class="gold-title" style="margin-top: 40px;">Langues</h4>
        <?php foreach ($cv['langue_nom'] as $i => $nom): ?>
            <p style="font-size: 11px;"><?php echo htmlspecialchars($nom); ?> : <?php echo htmlspecialchars($cv['langue_niveau'][$i]); ?></p>
        <?php endforeach; ?>
    </div>

    <div class="content">
        <h4 style="color: #1e272e; text-transform: uppercase;">Expériences</h4>
        <?php foreach ($cv['experience_titre'] as $i => $titre): ?>
            <div style="margin-bottom: 20px; border-left: 3px solid #f1c40f; padding-left: 15px;">
                <div style="font-weight: bold;"><?php echo htmlspecialchars($titre); ?></div>
                <div style="color: #666; font-size: 11px;"><?php echo htmlspecialchars($cv['experience_etab'][$i]); ?> | <?php echo htmlspecialchars($cv['experience_debut'][$i]); ?> - <?php echo htmlspecialchars($cv['experience_fin'][$i]); ?></div>
                <p style="font-size: 12px;"><?php echo nl2br(htmlspecialchars($cv['experience_desc'][$i])); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>