<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; size: A4; }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', Helvetica, Arial, sans-serif;
            color: #333;
            background: #ffffff;
            -webkit-print-color-adjust: exact;
        }

        .tpl-container {
            width: 210mm;
            height: 297mm;
            position: relative;
            background: white;
            overflow: hidden;
        }

        /* --- SIDEBAR --- */
        .tpl-sidebar {
            position: absolute;
            top: 0;
            left: 0;
            width: 75mm;
            height: 297mm;
            background: #f8f9fa;
            padding: 25px 15px;
            box-sizing: border-box;
            border-right: 1px solid #eee;
        }

        /* --- MAIN --- */
        .tpl-main {
            position: absolute;
            top: 0;
            left: 75mm;
            width: 135mm;
            height: 297mm;
            padding: 30px 35px;
            box-sizing: border-box;
            background: #ffffff;
        }

        .section-wrapper { margin-bottom: 22px; width: 100%; }

        .section-header {
            border-bottom: 2px solid #004aad;
            color: #004aad;
            font-weight: bold;
            margin-bottom: 4px;
            padding-bottom: 4px;
            font-size: 0.8rem;
            text-transform: uppercase;
            display: block;
            width: 85%;
        }

        .badge-container {
            width: 85%;
            display: block;
        }

        .badge-item {
            display: inline-block;
            background: #f1f3f5;
            color: #343a40;
            border: 1px solid #dee2e6;
            padding: 3px 7px;
            border-radius: 4px;
            margin-right: 4px;
            margin-bottom: 6px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .preview-photo {
            width: 110px;
            height: 110px;
            border: 3px solid #004aad;
            border-radius: 50%;
            margin: 0 auto 20px auto;
            display: block;
            object-fit: cover;
        }

        .block-item { margin-bottom: 15px; }
        .block-item div { margin: 0; }
        
        .fw-bold { font-weight: bold; }
        .small { font-size: 0.82rem; }
        .text-primary { color: #004aad !important; }
        .text-muted { color: #6c757d; }
    </style>
</head>
<body>

<div class="tpl-container">
    <div class="tpl-sidebar">
        <?php if (!empty($cv['photo_embed'])): ?>
            <img src="<?= $cv['photo_embed'] ?>" class="preview-photo">
        <?php endif; ?>

        <h2 class="fw-bold" style="font-size: 1.1rem; margin-bottom: 5px;">
            <?= mb_strtoupper(htmlspecialchars($cv['prenom'] . ' ' . $cv['nom'])) ?>
        </h2>
        <p class="text-primary fw-bold" style="font-size: 0.75rem; margin-bottom: 20px;">
            <?= mb_strtoupper(htmlspecialchars($cv['titre'])) ?>
        </p>
        
        <div class="small" style="margin-bottom: 25px;">
            <?php if(!empty($cv['email'])): ?>
                <div style="word-break: break-all; margin-bottom: 4px;"><?= htmlspecialchars($cv['email']) ?></div>
            <?php endif; ?>
            <?php if(!empty($cv['telephone'])): ?>
                <div><?= htmlspecialchars($cv['telephone']) ?></div>
            <?php endif; ?>
        </div>

        <?php if (!empty($cv['competence_nom'])): ?>
        <div class="section-wrapper">
            <div class="section-header">Compétences</div>
            <div class="badge-container">
                <?php foreach($cv['competence_nom'] as $i => $nom): if(!empty($nom)): ?>
                    <span class="badge-item">
                        <?= htmlspecialchars($nom) ?>
                        <?php if(!empty($cv['competence_niveau'][$i])): ?>
                            (<?= htmlspecialchars($cv['competence_niveau'][$i]) ?>)
                        <?php endif; ?>
                    </span>
                <?php endif; endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($cv['langue_nom'])): ?>
        <div class="section-wrapper">
            <div class="section-header">Langues</div>
            <div style="width: 85%;">
                <?php foreach($cv['langue_nom'] as $i => $nom): if(!empty($nom)): ?>
                    <div class="small" style="margin-bottom:5px">
                        <strong><?= htmlspecialchars($nom) ?></strong>: <span class="text-muted"><?= htmlspecialchars($cv['langue_niveau'][$i]) ?></span>
                    </div>
                <?php endif; endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="tpl-main">
        <?php if (!empty($cv['resume'])): ?>
        <div class="section-wrapper">
            <div class="section-header">Profil</div>
            <div class="small" style="font-style: italic; line-height: 1.4; white-space: pre-line; width: 85%;">
                <?= htmlspecialchars($cv['resume']) ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($cv['experience_titre'])): ?>
        <div class="section-wrapper">
            <div class="section-header">Expériences Professionnelles</div>
            <div style="width: 85%;">
                <?php foreach($cv['experience_titre'] as $i => $titre): if(!empty($titre)): ?>
                    <div class="block-item">
                        <div class="fw-bold" style="font-size:0.85rem;"><?= htmlspecialchars($titre) ?></div>
                        <div class="text-muted small">
                            <?= htmlspecialchars($cv['experience_etab'][$i] ?? '') ?> | 
                            <?= htmlspecialchars($cv['experience_debut'][$i] ?? '') ?> - <?= htmlspecialchars($cv['experience_fin'][$i] ?? '') ?>
                        </div>
                        <div class="small" style="margin-top:0px; white-space: pre-line;">
                            <?= htmlspecialchars($cv['experience_desc'][$i] ?? '') ?>
                        </div>
                    </div>
                <?php endif; endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($cv['formation_titre'])): ?>
        <div class="section-wrapper">
            <div class="section-header">Formations</div>
            <div style="width: 85%;">
                <?php foreach($cv['formation_titre'] as $i => $titre): if(!empty($titre)): ?>
                    <div class="block-item">
                        <div class="fw-bold" style="font-size:0.85rem;"><?= htmlspecialchars($titre) ?></div>
                        <div class="text-muted small">
                            <?= htmlspecialchars($cv['formation_etab'][$i] ?? '') ?> | 
                            <?= htmlspecialchars($cv['formation_debut'][$i] ?? '') ?> - <?= htmlspecialchars($cv['formation_fin'][$i] ?? '') ?>
                        </div>
                        <?php if(!empty($cv['formation_desc'][$i])): ?>
                        <div class="small" style="margin-top:0px; white-space: pre-line;">
                            <?= htmlspecialchars($cv['formation_desc'][$i]) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endif; endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($cv['interet_nom'])): ?>
        <div class="section-wrapper">
            <div class="section-header">Centres d'intérêt</div>
            <div class="badge-container">
                <?php foreach($cv['interet_nom'] as $nom): if(!empty($nom)): ?>
                    <span class="badge-item"><?= htmlspecialchars($nom) ?></span>
                <?php endif; endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>