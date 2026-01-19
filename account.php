<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Compte | CV Gen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Historique de mes CV</h2>
            <a href="index.php" class="btn btn-outline-secondary">Retour</a>
        </div>

        <div class="row g-3">
            <?php
            $file = 'cv_history.json';
            if (file_exists($file)):
                $history = array_reverse(json_decode(file_get_contents($file), true));
                foreach ($history as $entry): ?>
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($entry['prenom'] . ' ' . $entry['nom']); ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $entry['titre']; ?></h6>
                                <p class="small text-muted">Généré le <?php echo $entry['date_gen']; ?></p>
                                
                                <form action="export.php" method="POST">
                                    <?php foreach ($entry as $key => $val): ?>
                                        <?php if (!is_array($val)): ?>
                                            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo htmlspecialchars($val); ?>">
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <button type="submit" class="btn btn-primary btn-sm w-100">Télécharger PDF</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; 
            else: ?>
                <p>Aucun CV généré pour le moment.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>