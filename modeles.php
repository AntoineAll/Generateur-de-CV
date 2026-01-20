<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nos Modèles | CV GEN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --grad: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        body { background-color: #f8f9fa; padding-top: 80px; }
        .navbar { background: var(--grad) !important; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }

        .template-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
            background: white;
            overflow: hidden;
        }

        .template-card:hover { transform: translateY(-10px); }

        .img-container {
            height: 420px;
            overflow: hidden;
            background: #f1f1f1;
            display: flex;
            align-items: flex-start;
            border-bottom: 1px solid #eee;
        }

        .img-container img {
            width: 100%;
            height: auto;
            transition: transform 0.5s ease;
        }

        .template-card:hover img { transform: scale(1.03); }

        .btn-choose {
            background: var(--grad);
            border: none;
            border-radius: 25px;
            font-weight: bold;
            padding: 10px 20px;
            transition: 0.3s;
        }
        
        .btn-choose:hover { opacity: 0.9; transform: scale(1.02); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.html">CV GEN</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link d-inline-block text-white px-3" href="index.html">Accueil</a>
            <a class="nav-link d-inline-block text-white px-3 fw-bold" href="modeles.php">Modèles</a>
            <a class="nav-link d-inline-block text-white px-3" href="contact.php">Contact</a>
            <a class="nav-link d-inline-block text-white px-3" href="account.php">Mon Compte</a>
        </div>
    </div>
</nav>

<div class="container my-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold display-6">Choisissez votre design</h2>
        <p class="text-muted">Cliquez sur un modèle pour commencer votre personnalisation.</p>
    </div>

    <div class="row g-4">
        <?php
        // Config des templates que j'ai
        $templates = [
            1 => ["nom" => "Bleu Royal", "desc" => "Classique & Professionnel"],
            2 => ["nom" => "Vert Émeraude", "desc" => "Moderne & Aéré"],
            3 => ["nom" => "Ultra Violet", "desc" => "Tech & Minimaliste"],
            4 => ["nom" => "Midnight & Gold", "desc" => "Élégant & Premium"]
        ];

        foreach ($templates as $id => $info): ?>
        <div class="col-md-6 col-lg-3">
            <div class="card template-card h-100">
                <div class="img-container">
                    <img src="assets/img/tpl<?php echo $id; ?>.png" 
                         alt="Aperçu <?php echo $info['nom']; ?>" 
                         onerror="this.src='https://via.placeholder.com/400x560?text=Image+PNG+manquante'">
                </div>
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="fw-bold mb-1"><?php echo $info['nom']; ?></h5>
                    <p class="text-muted small mb-3 flex-grow-1"><?php echo $info['desc']; ?></p>
                    <a href="cv.php?tpl=<?php echo $id; ?>" class="btn btn-primary btn-choose w-100">
                        Choisir ce modèle
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<footer class="py-3 bg-white border-top fixed-bottom">
    <div class="container text-center text-muted">
        <p class="mb-0 small">&copy; 2026 Antoine ALLARD - Tous droits réservés.</p>
    </div>
</footer>

</body>
</html>