<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éditeur de CV | CV Gen</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* --- CONFIGURATION GLOBALE --- */
        html, body { 
            height: 100vh; 
            margin: 0; 
            overflow: hidden; 
            font-family: 'Inter', sans-serif; 
            background-color: #f1f3f5; 
        }

        .app-container { 
            display: flex; 
            flex-direction: column; 
            height: 100vh; 
        }

        header { 
            flex-shrink: 0; 
            background: #212529; 
            color: white; 
            padding: 10px 20px; 
        }

        /* --- ZONE D'ÉDITION (GAUCHE) --- */
        .editor-zone { 
            display: flex; 
            flex-grow: 1; 
            overflow: hidden; 
        }
        
        .form-column { 
            flex: 0 0 40%; 
            overflow-y: auto; 
            padding: 25px; 
            border-right: 1px solid #dee2e6; 
        }

        .card { 
            border: none; 
            border-radius: 10px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.05); 
            margin-bottom: 20px; 
        }

        .dynamic-block { 
            background: #f8f9fa; 
            border: 1px solid #e9ecef; 
            border-radius: 8px; 
            padding: 15px; 
            margin-bottom: 15px; 
            position: relative; 
        }

        /* --- ZONE DE PRÉVISUALISATION (DROITE) --- */
        .preview-column { 
            flex: 0 0 60%; 
            background: #525961; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            overflow: hidden; 
            position: relative;
        }

        #cv-sheet { 
            background: white; 
            width: 210mm; 
            height: 297mm; 
            box-shadow: 0 20px 50px rgba(0,0,0,0.4); 
            display: flex; 
            flex-direction: column; 
            transform: scale(0.28); 
            transform-origin: center center;
            flex-shrink: 0;
        }

        .tpl-container { display: flex; flex: 1; width: 100%; overflow: hidden; }
        .tpl-sidebar { width: 35%; padding: 30px 25px; display: flex; flex-direction: column; gap: 25px; }
        .tpl-main { width: 65%; padding: 35px; display: flex; flex-direction: column; gap: 35px; }
        
        /* --- THÈMES --- */
        .template-1 { --main-color: #004aad; --side-bg: #f8f9fa; --text-side: #212529; }

        .template-2 { --main-color: #065f46; --side-bg: #ecfdf5; --text-side: #064e3b; }
        .template-2 .tpl-container { flex-direction: row-reverse; }
    
        .template-3 { --main-color: #6c5ce7; --side-bg: #f3f0ff; --text-side: #2d3436; }
        .template-3 .tpl-header { display: block; text-align: center; border-bottom: 4px solid var(--main-color) !important; padding: 40px 20px; }

        .template-4 { --main-color: #f1c40f; --side-bg: #1e272e; --text-side: #ffffff; }
        .template-4 .tpl-header { display: block; background: #000000; color: white; text-align: right; border-bottom: none; padding: 40px 20px; }
        .template-4 #view-contact, .template-4 #view-langue { color: rgba(255,255,255,0.8) !important; }

        .tpl-sidebar { background: var(--side-bg) !important; color: var(--text-side); }
        .section-header { border-bottom: 2px solid var(--main-color) !important; color: var(--main-color) !important; font-weight: bold; margin-bottom: 12px; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.8px; }
        .text-primary { color: var(--main-color) !important; }
        .preview-photo { border: 3px solid var(--main-color) !important; width: 120px; height: 120px; object-fit: cover; border-radius: 50%; margin-bottom: 15px; display: none; }
        .tpl-header { display: none; width: 100%; background: white; }

        .badge-item { 
            display: inline-block; 
            background: #f1f3f5;
            color: #343a40;    
            border: 1px solid #dee2e6; 
            padding: 4px 10px; 
            border-radius: 4px; 
            margin: 2px; 
            font-size: 0.72rem; 
            font-weight: 600; 
        }

        .template-4 .badge-item { 
            background: #34495e !important; 
            color: #ffffff !important; 
            border-color: #4b6584 !important;
        }
    </style>
</head>
<body>

    <div class="app-container">
        <header class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">CV GEN <small class="fw-normal opacity-50">| Studio</small></h5>
            <a href="index.php" class="btn btn-sm btn-outline-light">Retour Accueil</a>
        </header>

        <main class="editor-zone">
            <div class="form-column">
                <form action="export.php" method="POST" id="cvForm" enctype="multipart/form-data">
                    
                    <div class="card p-3 border-primary border">
                        <label class="fw-bold mb-2">Modèle & Contraste</label>
                        <select name="template_id" id="templateSelector" class="form-select" onchange="updateTemplate()">
                            <option value="1" selected>Modèle Bleu Royal (Classique)</option>
                            <option value="2">Modèle Vert Émeraude (Inversé)</option>
                            <option value="3">Modèle Ultra Violet (Moderne)</option>
                            <option value="4">Modèle Midnight & Gold (Premium)</option>
                        </select>
                    </div>

                    <div class="card p-4">
                        <h6 class="fw-bold mb-3 text-primary">Photo & Identité</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <input type="file" name="photo" class="form-control form-control-sm" accept="image/*" onchange="previewImage(this)">
                            </div>
                            <div class="col-6">
                                <input type="text" name="prenom" class="form-control form-control-sm" placeholder="Prénom" oninput="liveUpdate()">
                            </div>
                            <div class="col-6">
                                <input type="text" name="nom" class="form-control form-control-sm" placeholder="Nom" oninput="liveUpdate()">
                            </div>
                            <div class="col-12">
                                <input type="text" name="titre" class="form-control form-control-sm" placeholder="Titre professionnel" oninput="liveUpdate()">
                            </div>
                            <div class="col-6">
                                <input type="email" name="email" class="form-control form-control-sm" placeholder="Email" oninput="liveUpdate()">
                            </div>
                            <div class="col-6">
                                <input type="text" name="telephone" class="form-control form-control-sm" placeholder="Téléphone" oninput="liveUpdate()">
                            </div>
                            <div class="col-12">
                                <textarea name="resume" class="form-control form-control-sm" rows="3" placeholder="Résumé professionnel..." oninput="liveUpdate()"></textarea>
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
                <div id="cv-sheet" class="template-3">
                    <div id="area-header" class="tpl-header"></div>
                    
                    <div class="tpl-container">
                        <div class="tpl-sidebar">
                            <img id="view-photo" src="" class="preview-photo mx-auto">
                            <div id="area-sidebar-identity">
                                <h2 id="view-name" class="fw-bold mb-1" style="font-size: 1.3rem;">PRÉNOM NOM</h2>
                                <p id="view-titre" class="text-primary fw-bold mb-2" style="font-size: 0.85rem;">TITRE PROFESSIONNEL</p>
                                <div class="small mb-2" id="view-contact"></div>
                            </div>
                            <div>
                                <div class="section-header">Compétences</div>
                                <div id="view-competence" class="d-flex flex-wrap"></div>
                            </div>
                            <div>
                                <div class="section-header">Langues</div>
                                <div id="view-langue" class="small d-flex flex-column gap-1"></div>
                            </div>
                        </div>

                        <div class="tpl-main">
                            <div>
                                <div class="section-header">Profil</div>
                                <div id="view-resume" class="small" style="font-style: italic; opacity: 0.9; line-height: 1.5;"></div>
                            </div>
                            <div>
                                <div class="section-header">Expériences Professionnelles</div>
                                <div id="view-experience" class="d-flex flex-column gap-3"></div>
                            </div>
                            <div>
                                <div class="section-header">Formations</div>
                                <div id="view-formation" class="d-flex flex-column gap-3"></div>
                            </div>
                            <div>
                                <div class="section-header">Centres d'intérêt</div>
                                <div id="view-interet" class="d-flex flex-wrap gap-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Zoom automatique du CV
        function autoZoom()
        {
            const container = document.getElementById('previewContainer');
            const sheet = document.getElementById('cv-sheet');
            const availableHeight = container.offsetHeight - 40; 
            const sheetHeight = 1122; 
            const scale = availableHeight / sheetHeight;
            sheet.style.transform = `scale(${scale})`;
        }

        // Changement de modèle visuel
        function updateTemplate() 
        {
            const val = document.getElementById('templateSelector').value;
            const sheet = document.getElementById('cv-sheet');
            const header = document.getElementById('area-header');
            const sidebarId = document.getElementById('area-sidebar-identity');
            
            sheet.className = 'template-' + val;
            
            if (val == "3" || val == "4") 
            {
                header.innerHTML = sidebarId.innerHTML;
                header.style.display = 'block';
                sidebarId.style.display = 'none';
            } 
            
            else 
            {
                header.innerHTML = '';
                header.style.display = 'none';
                sidebarId.style.display = 'block';
            }
            liveUpdate();
        }

        // Ajout de blocs (Expériences, etc.)
        function addBlock(type) 
        {
            const container = document.getElementById('container-' + type);
            const id = "id_" + Date.now();
            let html = '';

            if (type === 'competence' || type === 'langue') 
            {
                html = `
                    <div class="row g-2 mb-2" id="${id}">
                        <div class="col-6"><input type="text" name="${type}_nom[]" class="form-control form-control-sm" placeholder="${type}" oninput="liveUpdate()"></div>
                        <div class="col-4"><input type="text" name="${type}_niveau[]" class="form-control form-control-sm" placeholder="Niveau" oninput="liveUpdate()"></div>
                        <div class="col-2"><button type="button" class="btn btn-outline-danger btn-sm w-100" onclick="removeBlock('${id}')">x</button></div>
                    </div>`;
            } 
            
            else if (type === 'interet')
            {
                html = `
                    <div class="row g-2 mb-2" id="${id}">
                        <div class="col-10"><input type="text" name="interet_nom[]" class="form-control form-control-sm" placeholder="Activité" oninput="liveUpdate()"></div>
                        <div class="col-2"><button type="button" class="btn btn-outline-danger btn-sm w-100" onclick="removeBlock('${id}')">x</button></div>
                    </div>`;
            } 
            
            else 
            {
                html = `
                    <div class="dynamic-block" id="${id}">
                        <button type="button" class="btn-close btn-sm position-absolute top-0 end-0 m-2" onclick="removeBlock('${id}')"></button>
                        <div class="row g-2">
                            <div class="col-6"><input type="text" name="${type}_titre[]" class="form-control form-control-sm fw-bold" placeholder="Titre" oninput="liveUpdate()"></div>
                            <div class="col-6"><input type="text" name="${type}_etab[]" class="form-control form-control-sm" placeholder="Lieu" oninput="liveUpdate()"></div>
                            <div class="col-6"><input type="text" name="${type}_debut[]" class="form-control form-control-sm" placeholder="Début" oninput="liveUpdate()"></div>
                            <div class="col-6"><input type="text" name="${type}_fin[]" class="form-control form-control-sm" placeholder="Fin" oninput="liveUpdate()"></div>
                            <div class="col-12"><textarea name="${type}_desc[]" class="form-control form-control-sm" rows="2" placeholder="Détails..." oninput="liveUpdate()"></textarea></div>
                        </div>
                    </div>`;
            }
            container.insertAdjacentHTML('beforeend', html);
        }

        function removeBlock(id)
        { 
            document.getElementById(id).remove(); 
            liveUpdate(); 
        }

        // Mise à jour du CV en direct
        function liveUpdate()
        {
            const f = new FormData(document.getElementById('cvForm'));
            const name = (f.get('prenom') + ' ' + f.get('nom')).trim().toUpperCase();
            
            document.querySelectorAll('#view-name').forEach(el => el.innerText = name || "PRÉNOM NOM");
            document.querySelectorAll('#view-titre').forEach(el => el.innerText = f.get('titre') || "TITRE PROFESSIONNEL");
            
            const email = f.get('email'), tel = f.get('telephone');
            const contactHtml = (email ? `<div>${email}</div>` : '') + (tel ? `<div>${tel}</div>` : '');
            document.querySelectorAll('#view-contact').forEach(el => el.innerHTML = contactHtml);
            
            document.getElementById('view-resume').innerText = f.get('resume');

            ['experience', 'formation'].forEach(type =>
            {
                let h = '';
                const t = document.getElementsByName(type+'_titre[]'), 
                      e = document.getElementsByName(type+'_etab[]'), 
                      d = document.getElementsByName(type+'_debut[]'), 
                      fn = document.getElementsByName(type+'_fin[]'), 
                      ds = document.getElementsByName(type+'_desc[]');
                for(let i=0; i<t.length; i++) 
                {
                    if(t[i].value)
                    {
                        h += `<div>
                                <div class='fw-bold' style='font-size:0.9rem'>${t[i].value}</div>
                                <div class='text-muted small'>${e[i].value} | ${d[i].value} - ${fn[i].value}</div>
                                <div class='mt-1' style='font-size:0.75rem; white-space: pre-line;'>${ds[i].value}</div>
                              </div>`;
                    }
                }
                document.getElementById('view-'+type).innerHTML = h;
            });

            let cH = '';
            const cN = document.getElementsByName('competence_nom[]'), 
                  cL = document.getElementsByName('competence_niveau[]');
            for(let i=0; i<cN.length; i++)
            { 
                if(cN[i].value) cH += `<span class='badge-item'>${cN[i].value}${cL[i].value ? ' ('+cL[i].value+')' : ''}</span>`; 
            }
            document.getElementById('view-competence').innerHTML = cH;

            let lH = '';
            const lN = document.getElementsByName('langue_nom[]'), 
                  lV = document.getElementsByName('langue_niveau[]');
            for(let i=0; i<lN.length; i++)
            { 
                if(lN[i].value) lH += `<div><strong>${lN[i].value}</strong> : ${lV[i].value}</div>`; 
            }
            document.getElementById('view-langue').innerHTML = lH;

            let iH = '';
            const iN = document.getElementsByName('interet_nom[]');
            for(let i=0; i<iN.length; i++)
            { 
                if(iN[i].value) iH += `<span class='badge-item'>${iN[i].value}</span>`; 
            }
            document.getElementById('view-interet').innerHTML = iH;
        }

        // Prévisualisation photo
        function previewImage(input)
        {
            if (input.files && input.files[0])
            {
                const reader = new FileReader();
                reader.onload = e => 
                { 
                    const p = document.getElementById('view-photo'); 
                    p.src = e.target.result; 
                    p.style.display = 'block'; 
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        window.onload = () => { updateTemplate(); autoZoom(); };
        window.onresize = autoZoom;
    </script>
</body>
</html>