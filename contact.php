<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | CV Gen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        
        /* On reprend le dégradé mais en plus petit pour le haut de page */
        .top-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-bottom: -50px; /* Pour faire remonter la carte sur le dégradé */
        }

        .contact-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 40px;
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
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">CV GEN</a>
            <div class="ms-auto">
                <a href="cv.php" class="nav-link d-inline-block text-white px-3">Générer mon CV</a>
                <a href="modeles.php" class="nav-link d-inline-block text-white px-3">Modèles</a>
                <a href="contact.php" class="nav-link d-inline-block text-white px-3 fw-bold">Contact</a>
                <a href="account.php" class="nav-link d-inline-block text-white px-3 fw-bold">Mon compte</a>
            </div>
        </div>
    </nav>

    <div class="top-banner">
        <h1 class="fw-bold">Contactez-nous</h1>
    </div>

    <main class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                                <button type="submit" class="btn btn-send shadow">Envoyer le message</button>
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