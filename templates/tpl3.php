<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; }
        body { font-family: 'Helvetica', sans-serif; margin: 0; padding: 0; }
        .header { background: white; text-align: center; padding: 40px; border-bottom: 5px solid #6c5ce7; }
        .container { padding: 30px; }
        .col-left { width: 30%; float: left; }
        .col-right { width: 65%; float: right; }
        .title { color: #6c5ce7; text-transform: uppercase; letter-spacing: 2px; border-bottom: 1px solid #ddd; padding-bottom: 5px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="header">
        <h1><?php echo htmlspecialchars($cv['prenom'] . ' ' . $cv['nom']); ?></h1>
        <h3 style="color: #6c5ce7;"><?php echo htmlspecialchars($cv['titre']); ?></h3>
        <p><?php echo htmlspecialchars($cv['email']); ?> | <?php echo htmlspecialchars($cv['telephone']); ?></p>
    </div>

    <div class="container">
        <div class="col-left">
            <h4 class="title">Compétences</h4>
            <?php foreach ($cv['competence_nom'] as $nom): ?>
                <div style="background: #f3f0ff; margin-bottom: 5px; padding: 5px;"><?php echo htmlspecialchars($nom); ?></div>
            <?php endforeach; ?>
        </div>

        <div class="col-right">
            <h4 class="title">Parcours</h4>
            <?php foreach ($cv['experience_titre'] as $i => $titre): ?>
                <div style="margin-bottom: 15px;">
                    <span style="float: right; color: #666;"><?php echo htmlspecialchars($cv['experience_debut'][$i]); ?></span>
                    <strong><?php echo htmlspecialchars($titre); ?></strong><br>
                    <small><?php echo htmlspecialchars($cv['experience_etab'][$i]); ?></small>
                    <p style="font-size: 11px;"><?php echo htmlspecialchars($cv['experience_desc'][$i]); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>