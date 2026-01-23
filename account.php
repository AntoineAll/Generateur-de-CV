<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte | CV Gen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; }
        .card { transition: transform 0.2s; border: none; border-radius: 12px; }
        .card:hover { transform: translateY(-5px); }
        .history-title { color: #2d3436; font-weight: 800; }
        
        details {
            background: #f8f9fa;
            padding: 12px;
            border-radius: 8px;
            margin-top: 10px;
            border: 1px solid #e9ecef;
        }
        summary {
            cursor: pointer;
            font-weight: 600;
            font-size: 0.85rem;
            color: #0d6efd;
            list-style: none;
        }
        summary::-webkit-details-marker { display: none; }
        summary:before {
            content: "▶ ";
            display: inline-block;
            transition: transform 0.2s;
            font-size: 0.7rem;
            margin-right: 5px;
        }
        details[open] summary:before { transform: rotate(90deg); }
        
        .info-preview {
            font-size: 0.8rem;
            color: #444;
            margin-top: 10px;
            max-height: 400px; 
            overflow-y: auto;
            border-top: 1px solid #dee2e6;
            padding-top: 10px;
        }
        .section-title {
            text-transform: uppercase;
            font-size: 0.7rem;
            font-weight: bold;
            color: #0d6efd;
            margin-top: 12px;
            margin-bottom: 5px;
            display: block;
            border-bottom: 1px dashed #ccc;
        }
        .item-detail { margin-bottom: 10px; padding-left: 5px; border-left: 2px solid #0d6efd; }
        .badge-date { font-size: 0.7rem; background-color: #dfe6e9; color: #2d3436; }
        .desc-text { font-size: 0.75rem; color: #636e72; white-space: pre-line; margin-top: 3px; }
        .badge-skill { background: #e9ecef; padding: 2px 6px; border-radius: 4px; display: inline-block; margin: 2px; font-size: 0.7rem; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="history-title mb-0">Historique de mes CV</h2>
                <p class="text-muted">Retrouvez, modifiez ou régénérez vos créations</p>
            </div>
            <a href="index.html" class="btn btn-outline-dark px-4 shadow-sm">Retour</a>
        </div>

        <div class="row g-4">
            <?php
            $file = 'cv_history.json';
            if (file_exists($file)):
                $history = array_reverse(json_decode(file_get_contents($file), true));
                foreach ($history as $entry): ?>
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0 fw-bold"><?php echo htmlspecialchars($entry['prenom'] . ' ' . $entry['nom']); ?></h5>
                                    <span class="badge badge-date p-2 rounded-pill"><?php echo $entry['date_gen']; ?></span>
                                </div>
                                <h6 class="card-subtitle mb-3 text-primary"><?php echo htmlspecialchars($entry['titre']); ?></h6>
                                
                                <details>
                                    <summary>Voir le détail complet</summary>
                                    <div class="info-preview">
                                        <span class="section-title">Infos Personnelles</span>
                                        <strong>Email:</strong> <?php echo htmlspecialchars($entry['email']); ?><br>
                                        <strong>Tel:</strong> <?php echo htmlspecialchars($entry['telephone']); ?><br>
                                        <div class="mt-2 text-muted desc-text italic"><em><?php echo htmlspecialchars($entry['resume']); ?></em></div>

                                        <?php if(!empty($entry['experience_titre'])): ?>
                                            <span class="section-title">Expériences</span>
                                            <?php foreach($entry['experience_titre'] as $i => $titre): ?>
                                                <div class="item-detail">
                                                    <strong><?php echo htmlspecialchars($titre); ?></strong><br>
                                                    <small><?php echo htmlspecialchars($entry['experience_etab'][$i]); ?> (<?php echo htmlspecialchars($entry['experience_debut'][$i]); ?> - <?php echo htmlspecialchars($entry['experience_fin'][$i]); ?>)</small>
                                                    <div class="desc-text"><?php echo htmlspecialchars($entry['experience_desc'][$i]); ?></div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                        <?php if(!empty($entry['formation_titre'])): ?>
                                            <span class="section-title">Formations</span>
                                            <?php foreach($entry['formation_titre'] as $i => $titre): ?>
                                                <div class="item-detail">
                                                    <strong><?php echo htmlspecialchars($titre); ?></strong><br>
                                                    <small><?php echo htmlspecialchars($entry['formation_etab'][$i]); ?> (<?php echo htmlspecialchars($entry['formation_debut'][$i]); ?> - <?php echo htmlspecialchars($entry['formation_fin'][$i]); ?>)</small>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                        <?php if(!empty($entry['competence_nom'])): ?>
                                            <span class="section-title">Compétences</span>
                                            <div class="mb-2">
                                                <?php foreach($entry['competence_nom'] as $i => $nom): ?>
                                                    <span class="badge-skill"><?php echo htmlspecialchars($nom); ?> (<?php echo htmlspecialchars($entry['competence_niveau'][$i]); ?>)</span>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(!empty($entry['langue_nom'])): ?>
                                            <span class="section-title">Langues</span>
                                            <?php foreach($entry['langue_nom'] as $i => $nom): ?>
                                                <div><strong><?php echo htmlspecialchars($nom); ?></strong>: <?php echo htmlspecialchars($entry['langue_niveau'][$i]); ?></div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                        <?php if(!empty($entry['interet_nom'])): ?>
                                            <span class="section-title">Intérêts</span>
                                            <div>
                                                <?php foreach($entry['interet_nom'] as $nom): ?>
                                                    <span class="badge-skill"><?php echo htmlspecialchars($nom); ?></span>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </details>

                                <div class="mt-auto pt-3">
                                    <form action="export.php" method="POST" class="mb-2">
                                        <?php foreach ($entry as $k => $v): 
                                            if (is_array($v)): foreach($v as $sv): ?>
                                                <input type="hidden" name="<?=$k?>[]" value="<?=htmlspecialchars($sv)?>">
                                            <?php endforeach; else: ?>
                                                <input type="hidden" name="<?=$k?>" value="<?=htmlspecialchars($v)?>">
                                        <?php endif; endforeach; ?>
                                        <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm">
                                            <i class="fa-solid fa-file-pdf me-2"></i>Régénérer le PDF
                                        </button>
                                    </form>

                                    <form action="cv.php" method="POST">
                                        <?php foreach ($entry as $k => $v): 
                                            if (is_array($v)): foreach($v as $sv): ?>
                                                <input type="hidden" name="<?=$k?>[]" value="<?=htmlspecialchars($sv)?>">
                                            <?php endforeach; else: ?>
                                                <input type="hidden" name="<?=$k?>" value="<?=htmlspecialchars($v)?>">
                                        <?php endif; endforeach; ?>
                                        <button type="submit" class="btn btn-outline-primary w-100 fw-bold shadow-sm">
                                            <i class="fa-solid fa-pen-to-square me-2"></i>Reprendre l'édition
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; 
            else: ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Aucun historique disponible.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>