<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éditeur de CV | CV Gen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        html, body { height: 100vh; margin: 0; overflow: hidden; font-family: 'Inter', sans-serif; background-color: #f1f3f5; }
        .app-container { display: flex; flex-direction: column; height: 100vh; }
        header { flex-shrink: 0; background: #212529; color: white; padding: 10px 20px; }
        .editor-zone { display: flex; flex-grow: 1; overflow: hidden; }
        .form-column { flex: 0 0 50%; overflow-y: auto; padding: 25px; border-right: 1px solid #dee2e6; }
        .preview-column { flex: 0 0 50%; background: #525961; display: flex; justify-content: center; align-items: flex-start; padding: 20px; overflow: hidden; }

        #cv-sheet { 
            background: white; width: 100%; max-width: 550px; height: 100%; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.3); 
            display: block; font-size: 0.82rem; overflow-y: auto;
            position: relative;
        }

        /* --- STRUCTURES DES TEMPLATES --- */
        .tpl-sidebar { width: 35%; float: left; padding: 20px; background: #f8f9fa; min-height: 100%; }
        .tpl-main { width: 65%; float: left; padding: 20px; }
        .tpl-header { width: 100%; display: none; padding: 20px; border-bottom: 2px solid #0d6efd; margin-bottom: 10px; }

        /* Template 2 : Sidebar à Droite */
        .template-2 .tpl-sidebar { float: right; border-left: 1px solid #eee; }
        .template-2 .tpl-main { float: left; }

        /* Template 3 : Header Top */
        .template-3 .tpl-header { display: block; text-align: center; }
        .template-3 .tpl-sidebar { width: 30%; }
        .template-3 .tpl-main { width: 70%; }

        /* Template 4 : Moderne Dark */
        .template-4 .tpl-header { display: block; background: #212529; color: white; text-align: right; }

        .preview-photo { width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 3px solid #0d6efd; margin-bottom: 10px; display: none; }
        .card { border: none; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .section-header { border-bottom: 2px solid #0d6efd; color: #0d6efd; font-weight: bold; margin-top: 12px; margin-bottom: 8px; font-size: 0.7rem; text-transform: uppercase; }
        .dynamic-block { background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 8px; padding: 15px; margin-bottom: 15px; position: relative; }
        .clearfix::after { content: ""; clear: both; display: table; }
    </style>
</head>
<body>

<div class="app-container">
    <header class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">CV GEN <small class="fw-normal opacity-50">| Éditeur</small></h5>
        <a href="index.php" class="btn btn-sm btn-outline-light">Retour Accueil</a>
    </header>

    <main class="editor-zone">
        <div class="form-column">
            <form action="export.php" method="POST" id="cvForm" enctype="multipart/form-data">
                
                <div class="card p-4 border-primary border">
                    <h6 class="fw-bold text-primary mb-3">Choix du Template Graphique</h6>
                    <select name="template_id" id="templateSelector" class="form-select" onchange="updateTemplate()">
                        <option value="1">Croquis 31 : Sidebar Gauche</option>
                        <option value="2">Croquis 35 : Sidebar Droite</option>
                        <option value="3">Croquis 37 : En-tête Centré</option>
                        <option value="4">Croquis 33 : Moderne Dark Header</option>
                    </select>
                </div>

                <div class="card p-4">
                    <h6 class="fw-bold mb-3 text-primary">Photo & Identité</h6>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="small fw-bold">Photo de profil (Optionnel)</label>
                            <input type="file" name="photo" id="inputPhoto" class="form-control form-control-sm" accept="image/*" onchange="previewImage(this)">
                        </div>
                        <div class="col-6"><input type="text" name="prenom" class="form-control form-control-sm" placeholder="Prénom" oninput="liveUpdate()"></div>
                        <div class="col-6"><input type="text" name="nom" class="form-control form-control-sm" placeholder="Nom" oninput="liveUpdate()"></div>
                        <div class="col-12"><input type="text" name="titre" class="form-control form-control-sm" placeholder="Titre professionnel" oninput="liveUpdate()"></div>
                        <div class="col-6"><input type="email" name="email" class="form-control form-control-sm" placeholder="Email" oninput="liveUpdate()"></div>
                        <div class="col-6"><input type="text" name="telephone" class="form-control form-control-sm" placeholder="Téléphone" oninput="liveUpdate()"></div>
                        <div class="col-12"><textarea name="resume" class="form-control form-control-sm" rows="2" placeholder="Résumé professionnel..." oninput="liveUpdate()"></textarea></div>
                    </div>
                </div>

                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 text-primary">Expériences</h6>
                        <button type="button" class="btn btn-primary btn-sm" onclick="addBlock('experience')">+</button>
                    </div>
                    <div id="container-experience"></div>
                </div>

                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 text-primary">Formations</h6>
                        <button type="button" class="btn btn-primary btn-sm" onclick="addBlock('formation')">+</button>
                    </div>
                    <div id="container-formation"></div>
                </div>

                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 text-primary">Compétences</h6>
                        <button type="button" class="btn btn-primary btn-sm" onclick="addBlock('competence')">+</button>
                    </div>
                    <div id="container-competence"></div>
                </div>

                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 text-primary">Langues</h6>
                        <button type="button" class="btn btn-primary btn-sm" onclick="addBlock('langue')">+</button>
                    </div>
                    <div id="container-langue"></div>
                </div>

                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 text-primary">Centres d'intérêt</h6>
                        <button type="button" class="btn btn-primary btn-sm" onclick="addBlock('interet')">+</button>
                    </div>
                    <div id="container-interet"></div>
                </div>

                <button type="submit" class="btn btn-success btn-lg w-100 py-3 shadow-lg fw-bold mb-5">GÉNÉRER LE PDF</button>
            </form>
        </div>

        <div class="preview-column">
            <div id="cv-sheet" class="template-1 clearfix">
                
                <div id="area-header" class="tpl-header"></div>

                <div class="tpl-sidebar text-center">
                    <img id="view-photo" src="" class="preview-photo mx-auto">
                    <div id="area-sidebar-identity">
                        <h2 id="view-name" class="fw-bold mb-1">PRÉNOM NOM</h2>
                        <p id="view-titre" class="text-primary fw-bold mb-1">Headline</p>
                    </div>
                    <div class="section-header">Contact</div>
                    <div id="view-contact" class="small text-muted mb-2"></div>
                    
                    <div class="section-header">Compétences</div>
                    <div id="view-competence" class="d-flex flex-wrap justify-content-center"></div>
                    
                    <div class="section-header">Langues</div>
                    <div id="view-langue" class="small"></div>
                </div>

                <div class="tpl-main">
                    <div id="area-main-identity"></div>
                    <div class="section-header">Résumé</div>
                    <div id="view-resume" class="mb-2 small" style="font-style: italic;"></div>

                    <div class="section-header">Expériences</div>
                    <div id="view-experience"></div>

                    <div class="section-header">Formations</div>
                    <div id="view-formation"></div>

                    <div class="section-header">Centres d'intérêt</div>
                    <div id="view-interet" class="small"></div>
                </div>

            </div>
        </div>
    </main>
</div>

<script>
    // --- GESTION DES TEMPLATES (SWITCH VISUEL en temps réel du template choisi) ---
    function updateTemplate() {
        const val = document.getElementById('templateSelector').value;
        const sheet = document.getElementById('cv-sheet');
        const header = document.getElementById('area-header');
        const sidebarId = document.getElementById('area-sidebar-identity');
        
        sheet.className = 'template-' + val + ' clearfix';

        if (val == "3" || val == "4") {
            header.innerHTML = sidebarId.innerHTML; 
            sidebarId.style.display = 'none';
        } else {
            header.innerHTML = '';
            sidebarId.style.display = 'block';
        }
        liveUpdate(); // Rafraîchir les données après le switch
    }

    // --- GESTION PHOTO ---
    function previewImage(input) {
        const preview = document.getElementById('view-photo');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // --- GESTION BLOCS DYNAMIQUES ---
    function addBlock(type) {
        const container = document.getElementById('container-' + type);
        const id = "id_" + Date.now();
        let html = '';

        if (type === 'competence' || type === 'langue') {
            const placeholder = type === 'competence' ? 'Compétence' : 'Langue';
            html = `<div class="row g-2 mb-2" id="${id}">
                <div class="col-6"><input type="text" name="${type}_nom[]" class="form-control form-control-sm" placeholder="${placeholder}" oninput="liveUpdate()"></div>
                <div class="col-4"><input type="text" name="${type}_niveau[]" class="form-control form-control-sm" placeholder="Niveau" oninput="liveUpdate()"></div>
                <div class="col-2"><button type="button" class="btn btn-outline-danger btn-sm w-100" onclick="removeBlock('${id}')">x</button></div>
            </div>`;
        } else if (type === 'interet') {
            html = `<div class="row g-2 mb-2" id="${id}">
                <div class="col-10"><input type="text" name="interet_nom[]" class="form-control form-control-sm" placeholder="Sport..." oninput="liveUpdate()"></div>
                <div class="col-2"><button type="button" class="btn btn-outline-danger btn-sm w-100" onclick="removeBlock('${id}')">x</button></div>
            </div>`;
        } else {
            html = `<div class="dynamic-block" id="${id}">
                <button type="button" class="btn-close btn-sm position-absolute top-0 end-0 m-2" onclick="removeBlock('${id}')"></button>
                <div class="row g-2">
                    <div class="col-6"><input type="text" name="${type}_titre[]" class="form-control form-control-sm fw-bold" placeholder="Intitulé" oninput="liveUpdate()"></div>
                    <div class="col-6"><input type="text" name="${type}_etab[]" class="form-control form-control-sm" placeholder="Lieu" oninput="liveUpdate()"></div>
                    <div class="col-6"><input type="text" name="${type}_debut[]" class="form-control form-control-sm" placeholder="Début" oninput="liveUpdate()"></div>
                    <div class="col-6"><input type="text" name="${type}_fin[]" class="form-control form-control-sm" placeholder="Fin" oninput="liveUpdate()"></div>
                    <div class="col-12"><textarea name="${type}_desc[]" class="form-control form-control-sm" rows="2" placeholder="Missions..." oninput="liveUpdate()"></textarea></div>
                </div>
            </div>`;
        }
        container.insertAdjacentHTML('beforeend', html);
    }

    function removeBlock(id) { document.getElementById(id).remove(); liveUpdate(); }

    // --- MISE À JOUR LIVE ---
    function liveUpdate() {
        const f = new FormData(document.getElementById('cvForm'));
        const name = (f.get('prenom') + ' ' + f.get('nom')).toUpperCase();
        
        // Ciblage par ID + s'assurer que si c'est déplacé dans le header, ça marche
        document.querySelectorAll('#view-name').forEach(el => el.innerText = name);
        document.querySelectorAll('#view-titre').forEach(el => el.innerText = f.get('titre') || "Headline");
        
        document.getElementById('view-contact').innerText = f.get('email') + (f.get('telephone') ? ' | ' + f.get('telephone') : '');
        document.getElementById('view-resume').innerText = f.get('resume');

        ['experience', 'formation'].forEach(type => {
            let h = '';
            const t = document.getElementsByName(type+'_titre[]');
            const e = document.getElementsByName(type+'_etab[]');
            const d = document.getElementsByName(type+'_debut[]');
            const fn = document.getElementsByName(type+'_fin[]');
            const ds = document.getElementsByName(type+'_desc[]');
            for(let i=0; i<t.length; i++) {
                if(t[i].value) h += `<div class='mb-2 text-start'><strong>${t[i].value}</strong> @ ${e[i].value}<br><small class='text-primary'>${d[i].value} - ${fn[i].value}</small><p class='m-0' style='font-size:0.7rem'>${ds[i].value}</p></div>`;
            }
            document.getElementById('view-'+type).innerHTML = h;
        });

        let cH = '';
        const cN = document.getElementsByName('competence_nom[]');
        const cL = document.getElementsByName('competence_niveau[]');
        for(let i=0; i<cN.length; i++) { 
            if(cN[i].value) cH += `<span class='badge bg-light text-dark border m-1'>${cN[i].value}${cL[i].value ? ' ('+cL[i].value+')' : ''}</span>`; 
        }
        document.getElementById('view-competence').innerHTML = cH;

        let lH = '';
        const lN = document.getElementsByName('langue_nom[]');
        const lV = document.getElementsByName('langue_niveau[]');
        for(let i=0; i<lN.length; i++) { if(lN[i].value) lH += `<div>• ${lN[i].value} <span class='text-muted'>${lV[i].value}</span></div>`; }
        document.getElementById('view-langue').innerHTML = lH;

        let iH = [];
        const iN = document.getElementsByName('interet_nom[]');
        for(let i=0; i<iN.length; i++) { if(iN[i].value) iH.push(iN[i].value); }
        document.getElementById('view-interet').innerText = iH.join(', ');
    }

    // Initialisation
    window.onload = updateTemplate;
</script>
</body>
</html>