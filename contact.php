<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | CV Gen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f8f9fa; 
            min-height: 100vh; 
            display: flex; 
            flex-direction: column; 
        }
        
        .top-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-bottom: -50px;
            padding-top: 60px;
            position: relative;
            z-index: 1; 
        }

        .contact-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 40px;
            position: relative;
            z-index: 2;
        }

        .btn-send {
            background: #764ba2;
            border: none;
            border-radius: 50px;
            padding: 10px 30px;
            color: white;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-send:hover {
            background: #667eea;
            transform: translateY(-2px);
            color: white;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            .top-banner { 
                height: 180px; 
                margin-bottom: -30px;
            }
            .top-banner h1 { 
                font-size: 1.6rem; 
                margin-bottom: 20px;
            }
            .contact-card { 
                padding: 25px 20px; 
                margin: 0 15px; /* Évite que la carte ne touche les bords du téléphone sinon le rendu est sale */
            }
            footer.fixed-bottom { 
                position: relative; 
                margin-top: 40px; 
            }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.html">CV GEN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    <a href="cv.php" class="nav-link text-white px-3">Générer mon CV</a>
                    <a href="modeles.php" class="nav-link text-white px-3">Modèles</a>
                    <a href="contact.php" class="nav-link text-white px-3 fw-bold active">Contact</a>
                    <a href="account.php" class="nav-link text-white px-3">Mon Compte</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="top-banner">
        <h1 class="fw-bold">Contactez-nous</h1>
    </div>

    <main class="container mb-5 flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card contact-card bg-white">
                    <p class="text-center text-muted mb-4">Une question sur le générateur ? Une idée d'amélioration ? N'hésitez pas à nous écrire.</p>
                    
                    <form action="#" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nom</label>
                                <input type="text" name="nom" class="form-control form-control-lg bg-light border-0" placeholder="Votre nom" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control form-control-lg bg-light border-0" placeholder="votre @email.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Sujet</label>
                                <input type="text" name="sujet" class="form-control form-control-lg bg-light border-0" placeholder="De quoi s'agit-il ?" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Message</label>
                                <textarea name="message" class="form-control bg-light border-0" rows="5" placeholder="Dites-nous tout..." required></textarea>
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-send shadow w-100 d-md-inline-block d-block">Envoyer le message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-3 bg-white border-top mt-auto fixed-bottom">
        <div class="container text-center text-muted">
            <p class="mb-0 small">&copy; 2026 Antoine ALLARD - Tous droits réservés.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>