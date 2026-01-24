<?php 
$tpl_id = $_POST['template_id'] ?? ($_GET['tpl'] ?? 1);
if (!in_array($tpl_id, [1, 2, 3, 4])) { $tpl_id = 1; }
$d = $_POST;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éditeur de CV | CV Gen</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="css/cv.css">
</head>
<body>

    <div class="app-container">
        <header class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold d-none d-sm-block">CV GEN <small class="fw-normal opacity-50">| Editeur</small></h5>
            <h5 class="mb-0 fw-bold d-block d-sm-none">CV GEN</h5>
            <div class="d-flex gap-1 gap-md-2">
                <button type="button" onclick="window.location.href='cv.php?tpl=<?php echo $tpl_id; ?>';" class="btn btn-sm btn-light text-dark fw-bold">⟳ <span class="d-none d-md-inline">Réinitialiser</span></button>
                <a href="modeles.php" class="btn btn-sm btn-outline-info">Modèles</a>
                <a href="index.html" class="btn btn-sm btn-outline-light">Quitter</a>
            </div>
        </header>

        <main class="editor-zone">
            <div class="form-column">
                <form action="export.php" method="POST" id="cvForm" class="needs-validation" enctype="multipart/form-data" novalidate>
                    <div class="card p-3 border-primary border">
                        <label class="fw-bold mb-2">Modèle sélectionné</label>
                        <select name="template_id" id="templateSelector" class="form-select" onchange="updateTemplate()">
                            <option value="1" <?php echo ($tpl_id == 1) ? 'selected' : ''; ?>>Bleu Royal (Classique)</option>
                            <option value="2" <?php echo ($tpl_id == 2) ? 'selected' : ''; ?>>Vert Émeraude (Inversé)</option>
                            <option value="3" <?php echo ($tpl_id == 3) ? 'selected' : ''; ?>>Ultra Violet (Moderne)</option>
                            <option value="4" <?php echo ($tpl_id == 4) ? 'selected' : ''; ?>>Midnight & Gold (Premium)</option>
                        </select>
                    </div>

                    <div class="card p-4">
                        <h6 class="fw-bold mb-3 text-primary">Photo & Identité</h6>
                        <div class="row g-3">
                            <div class="col-12"><input type="file" name="photo" class="form-control form-control-sm" accept="image/*" onchange="previewImage(this)"></div>
                            <div class="col-6">
                                <input type="text" name="prenom" class="form-control form-control-sm" placeholder="Prénom" value="<?php echo htmlspecialchars($d['prenom'] ?? ''); ?>" oninput="liveUpdate()" required>
                                <div class="invalid-feedback">Prénom requis.</div>
                            </div>
                            <div class="col-6">
                                <input type="text" name="nom" class="form-control form-control-sm" placeholder="Nom" value="<?php echo htmlspecialchars($d['nom'] ?? ''); ?>" oninput="liveUpdate()" required>
                                <div class="invalid-feedback">Nom requis.</div>
                            </div>
                            <div class="col-12">
                                <input type="text" name="titre" class="form-control form-control-sm" placeholder="Titre professionnel" value="<?php echo htmlspecialchars($d['titre'] ?? ''); ?>" oninput="liveUpdate()" required>
                                <div class="invalid-feedback">Titre requis.</div>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="email" name="email" class="form-control form-control-sm" placeholder="Email" value="<?php echo htmlspecialchars($d['email'] ?? ''); ?>" oninput="liveUpdate()" required>
                                <div class="invalid-feedback">Email valide requis.</div>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" name="telephone" class="form-control form-control-sm" placeholder="Téléphone" value="<?php echo htmlspecialchars($d['telephone'] ?? ''); ?>" oninput="liveUpdate()" required>
                                <div class="invalid-feedback">Téléphone requis.</div>
                            </div>
                            <div class="col-12">
                                <textarea name="resume" class="form-control form-control-sm" rows="3" placeholder="Résumé professionnel..." oninput="liveUpdate()" required><?php echo htmlspecialchars($d['resume'] ?? ''); ?></textarea>
                                <div class="invalid-feedback">Un résumé est nécessaire.</div>
                            </div>
                        </div>
                    </div>

                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6>Expériences</h6>
                            <button type="button" class="btn btn-primary btn-sm" onclick="addBlock('experience')">+</button>
                        </div>
                        <div id="container-experience"></div>
                    </div>

                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6>Formations</h6>
                            <button type="button" class="btn btn-primary btn-sm" onclick="addBlock('formation')">+</button>
                        </div>
                        <div id="container-formation"></div>
                    </div>

                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6>Compétences</h6>
                            <button type="button" class="btn btn-primary btn-sm" onclick="addBlock('competence')">+</button>
                        </div>
                        <div id="container-competence"></div>
                    </div>

                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6>Langues</h6>
                            <button type="button" class="btn btn-primary btn-sm" onclick="addBlock('langue')">+</button>
                        </div>
                        <div id="container-langue"></div>
                    </div>

                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6>Centres d'intérêt</h6>
                            <button type="button" class="btn btn-primary btn-sm" onclick="addBlock('interet')">+</button>
                        </div>
                        <div id="container-interet"></div>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg w-100 py-3 shadow-lg fw-bold mb-5">GÉNÉRER LE PDF</button>
                </form>
            </div>

            <div class="preview-column" id="previewContainer">
                <div id="cv-sheet" class="template-1">
                    <div id="area-header" class="tpl-header"></div>
                    <div class="tpl-container">
                        <div class="tpl-sidebar">
                            <img id="view-photo" src="" class="preview-photo">
                            <div id="area-sidebar-identity">
                                <h2 id="view-name" class="fw-bold mb-1" style="font-size: 1.3rem;">PRÉNOM NOM</h2>
                                <p id="view-titre" class="text-primary fw-bold mb-2" style="font-size: 0.85rem;">TITRE PROFESSIONNEL</p>
                                <div class="small mb-3" id="view-contact"></div>
                            </div>
                            <div class="section-header">Compétences</div>
                            <div id="view-competence"></div>
                            <div class="section-header mt-4">Langues</div>
                            <div id="view-langue" class="small"></div>
                        </div>
                        <div class="tpl-main">
                            <div class="section-header">Profil</div>
                            <div id="view-resume" class="small mb-4" style="font-style: italic; opacity: 0.9; line-height: 1.6;"></div>
                            <div class="section-header">Expériences Professionnelles</div>
                            <div id="view-experience"></div>
                            <div class="section-header">Formations</div>
                            <div id="view-formation"></div>
                            <div class="section-header">Centres d'intérêt</div>
                            <div id="view-interet"></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="js/cv.js"></script>

    <script>
        // Initialisation de PHP avec JS
        window.onload = () => { 
            <?php
            $fields = [
                'experience' => ['titre', 'etab', 'debut', 'fin', 'desc'], 
                'formation' => ['titre', 'etab', 'debut', 'fin', 'desc'], 
                'competence' => ['nom', 'niveau'], 
                'langue' => ['nom', 'niveau'], 
                'interet' => ['nom']
            ];
            foreach($fields as $type => $keys) {
                if(!empty($d[$type.'_'.$keys[0]])) {
                    foreach($d[$type.'_'.$keys[0]] as $i => $val) {
                        $obj = [];
                        foreach($keys as $k) {
                            $v = str_replace(["\r","\n"],['','\n'], $d[$type.'_'.$k][$i] ?? '');
                            $obj[] = "$k:'".addslashes($v)."'";
                        }
                        echo "addBlock('$type', {".implode(',', $obj)."});";
                    }
                }
            }
            ?>
            updateTemplate(); 
            autoZoom();
            liveUpdate();
        };
    </script>
</body>
</html>