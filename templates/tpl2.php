<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; size: A4; }
        :root {
            --main-color: #065f46;
            --side-bg: #ecfdf5;
            --text-side: #064e3b;
        }
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

        /* --- SIDEBAR À DROITE --- */
        .tpl-sidebar {
            position: absolute;
            top: 0;
            right: 0;
            width: 75mm;
            height: 297mm;
            background: var(--side-bg);
            color: var(--text-side);
            padding: 25px 15px;
            box-sizing: border-box;
            z-index: 2;
        }

        /* --- MAIN À GAUCHE du CV--- */
        .tpl-main {
            position: absolute;
            top: 0;
            left: 0;
            width: 105mm; 
            height: 297mm;
            padding: 30px 0 30px 35px;
            box-sizing: border-box;
            background: #ffffff;
        }

        .section-wrapper { margin-bottom: 22px; width: 100%; }

        .section-header {
            border-bottom: 2px solid var(--main-color);
            color: var(--main-color);
            font-weight: bold;
            margin-bottom: 8px;
            padding-bottom: 5px;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: block;
        }

        .preview-photo {
            width: 120px;
            height: 120px;
            border: 3px solid var(--main-color);
            border-radius: 50%;
            margin: 0 auto 20px auto;
            display: block;
            object-fit: cover;
        }

        .badge-item {
            display: inline-block;
            background: #f1f3f5;
            color: #343a40;
            border: 1px solid #dee2e6;
            padding: 3px 8px;
            border-radius: 4px;
            margin-right: 4px;
            margin-bottom: 6px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .block-item { margin-bottom: 12px; }
        
        .fw-bold { font-weight: bold; }
        .small { font-size: 0.82rem; }
        .text-primary { color: var(--main-color) !important; }
        .text-muted { color: #6c757d; }
    </style>
</head>
<body>

<div class="tpl-container">
    <div class="tpl-main">
        <?php if (!empty($cv['resume'])): ?>
        <div class="section-wrapper">
            <div class="section-header">Profil</div>
            <div class="small" style="font-style: italic; line-height: 1.5; white-space: pre-line;">
                <?= htmlspecialchars($cv['resume']) ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($cv['experience_titre'])): ?>
        <div class="section-wrapper">
            <div class="section-header">Expériences Professionnelles</div>
            <?php foreach($cv['experience_titre'] as $i => $titre): if(!empty($titre)): ?>
                <div class="block-item">
                    <div class="fw-bold" style="font-size:0.85rem;"><?= htmlspecialchars($titre) ?></div>
                    <div class="text-muted small">
                        <?= htmlspecialchars($cv['experience_etab'][$i] ?? '') ?> | 
                        <?= htmlspecialchars($cv['experience_debut'][$i] ?? '') ?> - <?= htmlspecialchars($cv['experience_fin'][$i] ?? '') ?>
                    </div>
                    <div class="small" style="margin-top:2px; white-space: pre-line;">
                        <?= htmlspecialchars($cv['experience_desc'][$i] ?? '') ?>
                    </div>
                </div>
            <?php endif; endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($cv['formation_titre'])): ?>
        <div class="section-wrapper">
            <div class="section-header">Formations</div>
            <?php foreach($cv['formation_titre'] as $i => $titre): if(!empty($titre)): ?>
                <div class="block-item">
                    <div class="fw-bold" style="font-size:0.85rem;"><?= htmlspecialchars($titre) ?></div>
                    <div class="text-muted small">
                        <?= htmlspecialchars($cv['formation_etab'][$i] ?? '') ?> | 
                        <?= htmlspecialchars($cv['formation_debut'][$i] ?? '') ?> - <?= htmlspecialchars($cv['formation_fin'][$i] ?? '') ?>
                    </div>
                    <?php if(!empty($cv['formation_desc'][$i])): ?>
                    <div class="small" style="margin-top:2px; white-space: pre-line;">
                        <?= htmlspecialchars($cv['formation_desc'][$i]) ?>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endif; endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($cv['interet_nom'])): ?>
        <div class="section-wrapper">
            <div class="section-header">Centres d'intérêt</div>
            <div>
                <?php foreach($cv['interet_nom'] as $nom): if(!empty($nom)): ?>
                    <span class="badge-item"><?= htmlspecialchars($nom) ?></span>
                <?php endif; endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="tpl-sidebar">
        <?php if (!empty($cv['photo_embed'])): ?>
            <img src="<?= $cv['photo_embed'] ?>" class="preview-photo">
        <?php endif; ?>

        <h2 class="fw-bold" style="font-size: 1.2rem; margin-bottom: 5px; color: var(--main-color);">
            <?= mb_strtoupper(htmlspecialchars($cv['prenom'] . ' ' . $cv['nom'])) ?>
        </h2>
        <p class="fw-bold" style="font-size: 0.8rem; margin-bottom: 25px; color: #065f46;">
            <?= mb_strtoupper(htmlspecialchars($cv['titre'])) ?>
        </p>
        
        <div class="section-wrapper">
            <div class="section-header" style="border-bottom: 2px solid var(--text-side); color: var(--text-side);">Contact</div>
            <div class="small">
                <?php if(!empty($cv['email'])): ?>
                    <div style="word-break: break-all; margin-bottom: 8px;"><?= htmlspecialchars($cv['email']) ?></div>
                <?php endif; ?>
                <?php if(!empty($cv['telephone'])): ?>
                    <div style="margin-bottom: 8px;"><?= htmlspecialchars($cv['telephone']) ?></div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($cv['competence_nom'])): ?>
        <div class="section-wrapper">
            <div class="section-header" style="border-bottom: 2px solid var(--text-side); color: var(--text-side);">Compétences</div>
            <?php foreach($cv['competence_nom'] as $i => $nom): if(!empty($nom)): ?>
                <span class="badge-item">
                    <?= htmlspecialchars($nom) ?>
                    <?php if(!empty($cv['competence_niveau'][$i])): ?>
                        (<?= htmlspecialchars($cv['competence_niveau'][$i]) ?>)
                    <?php endif; ?>
                </span>
            <?php endif; endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($cv['langue_nom'])): ?>
        <div class="section-wrapper">
            <div class="section-header" style="border-bottom: 2px solid var(--text-side); color: var(--text-side);">Langues</div>
            <?php foreach($cv['langue_nom'] as $i => $nom): if(!empty($nom)): ?>
                <div class="small" style="margin-bottom:5px">
                    <strong><?= htmlspecialchars($nom) ?></strong> : <?= htmlspecialchars($cv['langue_niveau'][$i]) ?>
                </div>
            <?php endif; endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>