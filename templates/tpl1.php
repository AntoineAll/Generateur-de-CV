<!DOCTYPE html>
<html>
<head>
    <style>
        @page { margin: 0; }
        body { font-family: 'Helvetica', sans-serif; margin: 0; padding: 0; color: #333; }
        
        .sidebar { position: absolute; left: 0; top: 0; bottom: 0; width: 300px; background: #2c3e50; color: white; padding: 40px 20px; }
        .main { margin-left: 340px; padding: 40px; }
        
        .photo { width: 150px; height: 150px; border-radius: 50%; border: 4px solid #fff; margin-bottom: 20px; }
        .section-title { border-bottom: 2px solid #3498db; color: #3498db; text-transform: uppercase; margin-top: 30px; margin-bottom: 15px; font-size: 14px; }
        .item { margin-bottom: 15px; }
        .item-title { font-weight: bold; font-size: 16px; }
        .item-meta { color: #7f8c8d; font-size: 12px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <?php if (!empty($cv['photo_embed'])): ?>
            <img src="<?php echo $cv['photo_embed']; ?>" class="photo">
        <?php endif; ?>
        
        <h1 style="font-size: 24px; margin-bottom: 5px;"><?php echo mb_strtoupper($cv['prenom'] . ' ' . $cv['nom']); ?></h1>
        <p style="color: #3498db; font-weight: bold;"><?php echo $cv['titre']; ?></p>
        
        <div class="section-title" style="color: white; border-color: white;">Contact</div>
        <p style="font-size: 12px;"><?php echo $cv['email']; ?><br><?php echo $cv['telephone']; ?></p>
    </div>

    <div class="main">
        <div class="section-title">Profil</div>
        <p style="font-size: 13px; line-height: 1.6;"><?php echo nl2br($cv['resume']); ?></p>

        <div class="section-title">Expériences</div>
        <?php foreach ($cv['experience_titre'] as $i => $titre): ?>
            <div class="item">
                <div class="item-title"><?php echo $titre; ?></div>
                <div class="item-meta"><?php echo $cv['experience_etab'][$i]; ?> | <?php echo $cv['experience_debut'][$i]; ?> - <?php echo $cv['experience_fin'][$i]; ?></div>
                <div style="font-size: 12px;"><?php echo nl2br($cv['experience_desc'][$i]); ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>