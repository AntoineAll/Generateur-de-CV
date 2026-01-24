// Validation Bootstrap
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('cvForm');
    if (form) {
        form.addEventListener('submit', function (event) {
            if (!this.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            this.classList.add('was-validated');
        }, false);
    }
});

function escapeHtml(text) {
    if (!text) return "";
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function autoZoom() {
    const container = document.getElementById('previewContainer');
    const sheet = document.getElementById('cv-sheet');
    if (!container || !sheet) return;
    
    const isMobile = window.innerWidth < 992;
    if (isMobile) {
        const availableWidth = container.offsetWidth - 20;
        const scale = availableWidth / 794; 
        sheet.style.transform = `translateX(-50%) scale(${scale})`;
        const scaledHeight = 1122 * scale;
        container.style.height = (scaledHeight + 40) + "px";
    } else {
        container.style.height = "auto";
        const availableWidth = container.offsetWidth - 60;
        const availableHeight = container.offsetHeight - 60;
        const scale = Math.min(availableWidth / 794, availableHeight / 1122);
        sheet.style.transform = `scale(${scale})`;
    }
}

function updateTemplate() {
    const val = document.getElementById('templateSelector').value;
    const sheet = document.getElementById('cv-sheet');
    const header = document.getElementById('area-header');
    const sidebarId = document.getElementById('area-sidebar-identity');
    
    sheet.classList.remove('template-1', 'template-2', 'template-3', 'template-4');
    sheet.classList.add('template-' + val);
    
    if (val == "3" || val == "4") {
        header.innerHTML = sidebarId.innerHTML;
        header.style.display = 'block';
        sidebarId.style.display = 'none';
    } else {
        header.style.display = 'none';
        sidebarId.style.display = 'block';
    }
    liveUpdate();
}

function addBlock(type, data = null) {
    const container = document.getElementById('container-' + type);
    const id = "id_" + Math.random().toString(36).substr(2, 9);
    let html = '';
    const removeBtn = `<button type="button" class="btn-remove-block" onclick="removeBlock('${id}')"><i class="fa-solid fa-trash-can"></i></button>`;
    
    if (type === 'competence' || type === 'langue') {
        html = `<div class="row g-2 mb-2 align-items-center" id="${id}">
            <div class="col-5">
                <input type="text" name="${type}_nom[]" class="form-control form-control-sm" placeholder="${type}" value="${escapeHtml(data?.nom || '')}" oninput="liveUpdate()" required>
            </div>
            <div class="col-5">
                <input type="text" name="${type}_niveau[]" class="form-control form-control-sm" placeholder="Niveau" value="${escapeHtml(data?.niveau || '')}" oninput="liveUpdate()" required>
            </div>
            <div class="col-2 d-flex justify-content-end">${removeBtn}</div>
        </div>`;
    } else if (type === 'interet') {
        html = `<div class="row g-2 mb-2 align-items-center" id="${id}">
            <div class="col-10">
                <input type="text" name="interet_nom[]" class="form-control form-control-sm" placeholder="Activité" value="${escapeHtml(data?.nom || '')}" oninput="liveUpdate()" required>
            </div>
            <div class="col-2 d-flex justify-content-end">${removeBtn}</div>
        </div>`;
    } else {
        html = `<div class="dynamic-block" id="${id}">
            <div class="position-absolute top-0 end-0 m-2">${removeBtn}</div>
            <div class="row g-2">
                <div class="col-12 col-md-6"><input type="text" name="${type}_titre[]" class="form-control form-control-sm fw-bold" placeholder="Titre" value="${escapeHtml(data?.titre || '')}" oninput="liveUpdate()" required></div>
                <div class="col-12 col-md-6"><input type="text" name="${type}_etab[]" class="form-control form-control-sm" placeholder="Lieu" value="${escapeHtml(data?.etab || '')}" oninput="liveUpdate()" required></div>
                <div class="col-6"><input type="text" name="${type}_debut[]" class="form-control form-control-sm" placeholder="Début" value="${escapeHtml(data?.debut || '')}" oninput="liveUpdate()" required></div>
                <div class="col-6"><input type="text" name="${type}_fin[]" class="form-control form-control-sm" placeholder="Fin" value="${escapeHtml(data?.fin || '')}" oninput="liveUpdate()" required></div>
                <div class="col-12"><textarea name="${type}_desc[]" class="form-control form-control-sm" rows="2" placeholder="Détails..." oninput="liveUpdate()" required>${escapeHtml(data?.desc || '')}</textarea></div>
            </div>
        </div>`;
    }
    container.insertAdjacentHTML('beforeend', html);
    liveUpdate();
}

function removeBlock(id) { 
    const el = document.getElementById(id);
    if(el) el.remove(); 
    liveUpdate(); 
}

function liveUpdate() {
    const formEl = document.getElementById('cvForm');
    if (!formEl) return;
    const f = new FormData(formEl);
    const name = (f.get('prenom') + ' ' + f.get('nom')).trim().toUpperCase() || "PRÉNOM NOM";
    document.querySelectorAll('#view-name').forEach(el => el.textContent = name);
    document.querySelectorAll('#view-titre').forEach(el => el.textContent = f.get('titre') || "TITRE PROFESSIONNEL");
    
    const contactHtml = (f.get('email') ? `<div>${escapeHtml(f.get('email'))}</div>` : '') + (f.get('telephone') ? `<div>${escapeHtml(f.get('telephone'))}</div>` : '');
    document.querySelectorAll('#view-contact').forEach(el => el.innerHTML = contactHtml);
    document.querySelectorAll('#view-resume').forEach(el => el.innerHTML = escapeHtml(f.get('resume')));

    ['experience', 'formation'].forEach(type => {
        let h = '';
        const t = document.getElementsByName(type+'_titre[]'), e = document.getElementsByName(type+'_etab[]'), d = document.getElementsByName(type+'_debut[]'), fn = document.getElementsByName(type+'_fin[]'), ds = document.getElementsByName(type+'_desc[]');
        for(let i=0; i<t.length; i++) if(t[i].value) h += `<div class="block-item"><div class='fw-bold' style='font-size:0.9rem'>${escapeHtml(t[i].value)}</div><div class='text-muted small'>${escapeHtml(e[i].value)} | ${escapeHtml(d[i].value)} - ${escapeHtml(fn[i].value)}</div><div class='mt-1' style='font-size:0.75rem; white-space: pre-line;'>${escapeHtml(ds[i].value || '')}</div></div>`;
        const viewEl = document.getElementById('view-'+type);
        if(viewEl) viewEl.innerHTML = h;
    });

    let cH = ''; const cN = document.getElementsByName('competence_nom[]'), cL = document.getElementsByName('competence_niveau[]');
    for(let i=0; i<cN.length; i++) if(cN[i].value) cH += `<span class='badge-item'>${escapeHtml(cN[i].value)}${cL[i].value ? ' ('+escapeHtml(cL[i].value)+')' : ''}</span>`;
    const viewComp = document.getElementById('view-competence');
    if(viewComp) viewComp.innerHTML = cH;

    let lH = ''; const lN = document.getElementsByName('langue_nom[]'), lV = document.getElementsByName('langue_niveau[]');
    for(let i=0; i<lN.length; i++) if(lN[i].value) lH += `<div style="margin-bottom:5px"><strong>${escapeHtml(lN[i].value)}</strong> : ${escapeHtml(lV[i].value)}</div>`;
    const viewLang = document.getElementById('view-langue');
    if(viewLang) viewLang.innerHTML = lH;

    let iH = ''; const iN = document.getElementsByName('interet_nom[]');
    for(let i=0; i<iN.length; i++) if(iN[i].value) iH += `<span class='badge-item'>${escapeHtml(iN[i].value)}</span>`;
    const viewInt = document.getElementById('view-interet');
    if(viewInt) viewInt.innerHTML = iH;
}

function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { 
            const p = document.getElementById('view-photo'); 
            p.src = e.target.result; 
            p.style.display = 'block'; 
        }
        reader.readAsDataURL(input.files[0]);
    }
}

window.onresize = autoZoom;