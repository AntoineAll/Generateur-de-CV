<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        /* --- CONFIGURATION GLOBALE --- */
        @page { margin: 0; size: A4; }
        :root {
            /* Couleurs Template 3 */
            --main-color: #6c5ce7;   /* Violet */
            --side-bg: #f3f0ff;      /* Mauve très clair */
            --text-side: #2d3436;    /* Gris foncé */
            --header-bg: #ffffff;
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

        /* --- HEADER --- */
        .tpl-header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 48mm;
            background: var(--header-bg);
            border-bottom: 4px solid var(--main-color);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 0 20px;
            box-sizing: border-box;
            z-index: 10;
        }

        /* Prénom et Nom en Noir */
        h1 { margin: 0; color: #000000; font-size: 2.3rem; text-transform: uppercase; line-height: 1; }
        
        /* Titre Pro en Violet */
        .job-title { margin: 5px 0 10px 0; font-size: 1.1rem; color: var(--main-color); letter-spacing: 3px; text-transform: uppercase; font-weight: 600; }

        .contact-top {
            display: flex;
            flex-direction: column;
            gap: 2px;
            font-size: 0.85rem;
            color: #555;
        }

        /* --- CORPS --- */
        .tpl-sidebar {
            position: absolute;
            top: 48mm;
            left: 0;
            width: 75mm;
            height: calc(297mm - 48mm);
            background: var(--side-bg);
            padding: 25px 20px;
            box-sizing: border-box;
            color: var(--text-side);
        }

        .sidebar-photo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .preview-photo {
            width: 110px;
            height: 110px;
            border: 3px solid var(--main-color);
            border-radius: 50%;
            object-fit: cover;
        }

        .tpl-main {
            position: absolute;
            top: 48mm;
            left: 75mm;
            width: 135mm;
            height: calc(297mm - 48mm);
            padding: 30px 40px 30px 30px;
            box-sizing: border-box;
            background: #ffffff;
        }

        /* --- STYLES SECTIONS --- */
        .section-wrapper { margin-bottom: 22px; width: 100%; }

        .section-header {
            border-bottom: 2px solid var(--main-color);
            color: var(--main-color);
            font-weight: bold;
            margin-bottom: 12px;
            padding-bottom: 5px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            width: 85%; 
        }

        /* Titres Sidebar en Violet */
        .sidebar-header {
            border-bottom: 2px solid var(--main-color);
            color: var(--main-color);
            margin-bottom: 12px;
            padding-bottom: 5px;
            font-weight: bold;
            font-size: 0.82rem;
            text-transform: uppercase;
            width: 85%;
        }

        .small { 
            font-size: 0.85rem; 
            line-height: 1.4; 
            max-width: 85%; 
            word-wrap: break-word;
        }

        .badge-limit {
            max-width: 85%;
            display: block;
        }

        .badge-item {
            display: inline-block;
            background: rgba(108, 92, 231, 0.1);
            color: #000000; /* Texte des badges en noir */
            border: 1px solid rgba(108, 92, 231, 0.2);
            padding: 3px 8px;
            border-radius: 4px;
            margin-right: 4px;
            margin-bottom: 6px;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .fw-bold { font-weight: bold; }
        .text-muted { color: #666; font-size: 0.8rem; }
    </style>
</head>
<body>

<div class="tpl-container">
    <header class="tpl-header">
        <h1><?= htmlspecialchars($cv['prenom']) ?> <span class="fw-bold"><?= htmlspecialchars($cv['nom']) ?></span></h1>
        <div class="job-title"><?= htmlspecialchars($cv['titre'] ?? '') ?></div>
        
        <div class="contact-top">
            <?php if(!empty($cv['email'])): ?>
                <div><?= htmlspecialchars($cv['email']) ?></div>
            <?php endif; ?>
            <?php if(!empty($cv['telephone'])): ?>
                <div><?= htmlspecialchars($cv['telephone']) ?></div>
            <?php endif; ?>
        </div>
    </header>

    <aside class="tpl-sidebar">
        <?php if (!empty($cv['photo_embed'])): ?>
            <div class="sidebar-photo-container">
                <img src="<?= $cv['photo_embed'] ?>" class="preview-photo">
            </div>
        <?php endif; ?>

        <?php if (!empty($cv['competence_nom'])): ?>
        <div class="section-wrapper">
            <div class="sidebar-header">Compétences</div>
            <div class="badge-limit">
                <?php foreach($cv['competence_nom'] as $i => $nom): if(!empty($nom)): ?>
                    <span class="badge-item">
                        <?= htmlspecialchars($nom) ?>
                        <?= !empty($cv['competence_niveau'][$i]) ? '('.htmlspecialchars($cv['competence_niveau'][$i]).')' : '' ?>
                    </span>
                <?php endif; endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($cv['langue_nom'])): ?>
        <div class="section-wrapper">
            <div class="sidebar-header">Langues</div>
            <?php foreach($cv['langue_nom'] as $i => $nom): if(!empty($nom)): ?>
                <div class="small" style="margin-bottom:6px">
                    <strong><?= htmlspecialchars($nom) ?></strong> : <?= htmlspecialchars($cv['langue_niveau'][$i]) ?>
                </div>
            <?php endif; endforeach; ?>
        </div>
        <?php endif; ?>
    </aside>

    <main class="tpl-main">
        <?php if (!empty($cv['resume'])): ?>
        <div class="section-wrapper">
            <div class="section-header">Profil</div>
            <div class="small" style="white-space: pre-line; text-align: justify;">
                <?= htmlspecialchars($cv['resume']) ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($cv['experience_titre'])): ?>
        <div class="section-wrapper">
            <div class="section-header">Expériences</div>
            <?php foreach($cv['experience_titre'] as $i => $titre): if(!empty($titre)): ?>
                <div style="margin-bottom: 15px;">
                    <div class="fw-bold" style="font-size:0.9rem; color: #333;"><?= htmlspecialchars($titre) ?></div>
                    <div class="text-muted" style="margin-bottom: 4px; font-style: italic;">
                        <?= htmlspecialchars($cv['experience_etab'][$i] ?? '') ?> | 
                        <?= htmlspecialchars($cv['experience_debut'][$i] ?? '') ?> - <?= htmlspecialchars($cv['experience_fin'][$i] ?? '') ?>
                    </div>
                    <div class="small" style="white-space: pre-line;"><?= htmlspecialchars($cv['experience_desc'][$i] ?? '') ?></div>
                </div>
            <?php endif; endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($cv['formation_titre'])): ?>
        <div class="section-wrapper">
            <div class="section-header">Formations</div>
            <?php foreach($cv['formation_titre'] as $i => $titre): if(!empty($titre)): ?>
                <div style="margin-bottom: 12px;">
                    <div class="fw-bold" style="font-size:0.9rem;"><?= htmlspecialchars($titre) ?></div>
                    <div class="text-muted" style="margin-bottom: 2px;">
                        <?= htmlspecialchars($cv['formation_etab'][$i] ?? '') ?> | <?= htmlspecialchars($cv['formation_debut'][$i] ?? '') ?> - <?= htmlspecialchars($cv['formation_fin'][$i] ?? '') ?>
                    </div>
                    <?php if(!empty($cv['formation_desc'][$i])): ?>
                        <div class="small" style="white-space: pre-line;"><?= htmlspecialchars($cv['formation_desc'][$i]) ?></div>
                    <?php endif; ?>
                </div>
            <?php endif; endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($cv['interet_nom'])): ?>
        <div class="section-wrapper">
            <div class="section-header">Centres d'intérêt</div>
            <div class="badge-limit">
                <?php foreach($cv['interet_nom'] as $nom): if(!empty($nom)): ?>
                    <span class="badge-item"><?= htmlspecialchars($nom) ?></span>
                <?php endif; endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </main>
</div>

</body>
</html>