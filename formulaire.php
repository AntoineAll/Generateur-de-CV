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
        header { flex-shrink: 0; background: #212529; color: white; padding: 10px 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        
        .editor-zone { display: flex; flex-grow: 1; overflow: hidden; }

        /* GAUCHE : Formulaire avec son propre scroll */
        .form-column { flex: 0 0 50%; overflow-y: auto; padding: 25px; border-right: 1px solid #dee2e6; }
        
        /* DROITE : Aperçu fixe qui s'adapte à la hauteur */
        .preview-column { flex: 0 0 50%; background: #525961; display: flex; justify-content: center; align-items: flex-start; padding: 20px; overflow: hidden; }

        #cv-sheet { 
            background: white; width: 100%; max-width: 550px; height: 100%; 
            padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); 
            display: flex; flex-direction: column; font-size: 0.85rem;
        }

        .card { border: none; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .section-header { border-bottom: 2px solid #0d6efd; color: #0d6efd; font-weight: bold; margin-top: 15px; margin-bottom: 10px; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; }
        .dynamic-block { background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 8px; padding: 15px; margin-bottom: 15px; position: relative; }
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
            <form action="export.php" method="POST" id="cvForm">
                
                <div class="card p-4">
                    <h6 class="fw-bold mb-3 text-primary">Informations Générales</h6>
                    <div class="row g-3">
                        <div class="col-6"><input type="text" name="prenom" class="form-control form-control-sm" placeholder="Prénom" oninput="liveUpdate()"></div>
                        <div class="col-6"><input type="text" name="nom" class="form-control form-control-sm" placeholder="Nom" oninput="liveUpdate()"></div>
                        <div class="col-12"><input type="text" name="titre" class="form-control form-control-sm" placeholder="Titre professionnel (ex: Développeur PHP)" oninput="liveUpdate()"></div>
                        <div class="col-6"><input type="email" name="email" class="form-control form-control-sm" placeholder="Email" oninput="liveUpdate()"></div>
                        <div class="col-6"><input type="text" name="telephone" class="form-control form-control-sm" placeholder="Téléphone" oninput="liveUpdate()"></div>
                        <div class="col-12"><textarea name="resume" class="form-control form-control-sm" rows="3" placeholder="Résumé professionnel..." oninput="liveUpdate()"></textarea></div>
                    </div>
                </div>

                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 text-primary">Expériences professionnelles</h6>
                        <button type="button" class="btn btn-primary btn-sm" onclick="addBlock('experience')">+ Ajouter</button>
                    </div>
                    <div id="container-experience"></div>
                </div>

                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 text-primary">Formations</h6>
                        <button type="button" class="btn btn-primary btn-sm" onclick="addBlock('formation')">+ Ajouter</button>
                    </div>
                    <div id="container-formation"></div>
                </div>

                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 text-primary">Compétences</h6>
                        <button type="button" class="btn btn-primary btn-sm" onclick="addBlock('competence')">+ Ajouter</button>
                    </div>
                    <div id="container-competence"></div>
                </div>

                <button type="submit" class="btn btn-success btn-lg w-100 py-3 shadow-lg fw-bold mb-5">GÉNÉRER LE PDF</button>
            </form>
        </div>

        <div class="preview-column">
            <div id="cv-sheet">
                <div class="text-center">
                    <h2 id="view-name" class="fw-bold mb-1">NOM PRÉNOM</h2>
                    <p id="view-titre" class="text-primary fw-bold mb-1">Headline du profil</p>
                    <div class="small text-muted" id="view-contact">Contact Info</div>
                </div>
                
                <hr>
                <div id="view-resume" class="mb-2" style="font-style: italic;"></div>

                <div class="section-header">Expériences Professionnelles</div>
                <div id="view-experience" style="overflow: hidden;"></div>

                <div class="section-header">Formations</div>
                <div id="view-formation"></div>

                <div class="section-header">Compétences</div>
                <div id="view-competence" class="d-flex flex-wrap"></div>
            </div>
        </div>
    </main>
</div>

<script>
    function addBlock(type) {
        const container = document.getElementById('container-' + type);
        const id = "id_" + Date.now();
        let html = '';

        if (type === 'competence') {
            html = `
            <div class="row g-2 mb-2" id="${id}">
                <div class="col-6"><input type="text" name="comp_nom[]" class="form-control form-control-sm" placeholder="Compétence" oninput="liveUpdate()"></div>
                <div class="col-4"><input type="text" name="comp_niveau[]" class="form-control form-control-sm" placeholder="Niveau" oninput="liveUpdate()"></div>
                <div class="col-2"><button type="button" class="btn btn-outline-danger btn-sm w-100" onclick="removeBlock('${id}')">x</button></div>
            </div>`;
        } else {
            html = `
            <div class="dynamic-block" id="${id}">
                <button type="button" class="btn-close btn-sm position-absolute top-0 end-0 m-2" onclick="removeBlock('${id}')"></button>
                <div class="row g-2">
                    <div class="col-6"><input type="text" name="${type}_titre[]" class="form-control form-control-sm fw-bold" placeholder="Intitulé" oninput="liveUpdate()"></div>
                    <div class="col-6"><input type="text" name="${type}_etab[]" class="form-control form-control-sm" placeholder="Lieu / Entreprise" oninput="liveUpdate()"></div>
                    <div class="col-6"><input type="text" name="${type}_debut[]" class="form-control form-control-sm" placeholder="Date début" oninput="liveUpdate()"></div>
                    <div class="col-6"><input type="text" name="${type}_fin[]" class="form-control form-control-sm" placeholder="Date fin (facultatif)" oninput="liveUpdate()"></div>
                    <div class="col-12"><textarea name="${type}_desc[]" class="form-control form-control-sm" rows="2" placeholder="Description..." oninput="liveUpdate()"></textarea></div>
                </div>
            </div>`;
        }
        container.insertAdjacentHTML('beforeend', html);
    }

    function removeBlock(id) { document.getElementById(id).remove(); liveUpdate(); }

    function liveUpdate() {
        const f = new FormData(document.getElementById('cvForm'));
        document.getElementById('view-name').innerText = (f.get('prenom') + ' ' + f.get('nom')).toUpperCase();
        document.getElementById('view-titre').innerText = f.get('titre') || "Headline";
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
                if(t[i].value) h += `<div class='mb-2'><strong>${t[i].value}</strong> @ ${e[i].value}<br><small class='text-primary'>${d[i].value} - ${fn[i].value}</small><p class='m-0' style='font-size:0.75rem'>${ds[i].value}</p></div>`;
            }
            document.getElementById('view-'+type).innerHTML = h;
        });

        let cH = '';
        const cN = document.getElementsByName('comp_nom[]');
        const cL = document.getElementsByName('comp_niveau[]');
        for(let i=0; i<cN.length; i++) { if(cN[i].value) cH += `<span class='badge bg-light text-dark border m-1'>${cN[i].value} : ${cL[i].value}</span>`; }
        document.getElementById('view-competence').innerHTML = cH;
    }
</script>
</body>
</html>