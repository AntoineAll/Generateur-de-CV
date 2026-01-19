<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; }
        body { font-family: 'Helvetica', sans-serif; margin: 0; padding: 0; color: #2d3436; font-size: 12px; }
        .main { width: 65%; padding: 40px; float: left; }
        .sidebar { width: 35%; background: #ecfdf5; color: #064e3b; padding: 30px 20px; position: absolute; right: 0; top: 0; bottom: 0; }
        .section-header { color: #065f46; font-size: 16px; border-left: 4px solid #065f46; padding-left: 10px; margin: 30px 0 15px 0; font-weight: bold; }
        .name-header { color: #065f46; font-size: 28px; margin-bottom: 5px; }
        .photo { width: 130px; height: 130px; border: 4px solid #065f46; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="main">
        <h1 class="name-header"><?php echo htmlspecialchars($cv['prenom'] . ' ' . $cv['nom']); ?></h1>
        <p style="font-size: 16px; color: #666;"><?php echo htmlspecialchars($cv['titre']); ?></p>

        <div class="section-header">Résumé</div>
        <p><?php echo nl2br(htmlspecialchars($cv['resume'])); ?></p>

        <div class="section-header">Expériences</div>
        <?php foreach ($cv['experience_titre'] as $i => $titre): ?>
            <div style="margin-bottom: 20px;">
                <strong><?php echo htmlspecialchars($titre); ?></strong><br>
                <small><?php echo htmlspecialchars($cv['experience_etab'][$i]); ?> (<?php echo htmlspecialchars($cv['experience_debut'][$i]); ?> - <?php echo htmlspecialchars($cv['experience_fin'][$i]); ?>)</small>
                <p><?php echo nl2br(htmlspecialchars($cv['experience_desc'][$i])); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="sidebar">
        <?php if (!empty($cv['photo_embed'])): ?>
            <img src="<?php echo $cv['photo_embed']; ?>" class="photo">
        <?php endif; ?>
        <h3>Contact</h3>
        <p>Email: <?php echo htmlspecialchars($cv['email']); ?></p>
        <p>Tél: <?php echo htmlspecialchars($cv['telephone']); ?></p>
        
        <h3>Langues</h3>
        <?php foreach ($cv['langue_nom'] as $i => $nom): ?>
            <p><strong><?php echo htmlspecialchars($nom); ?></strong>: <?php echo htmlspecialchars($cv['langue_niveau'][$i]); ?></p>
        <?php endforeach; ?>
    </div>
</body>
</html>