<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // On nettoie les données
    $prenom = htmlspecialchars($_POST['prenom'] ?? '');
    $nom = htmlspecialchars($_POST['nom'] ?? '');
    $titre = htmlspecialchars($_POST['titre'] ?? '');
    
    // On récupère les tableaux d'expériences
    $exp_titres = $_POST['exp_titre'] ?? [];
    $exp_entreprises = $_POST['exp_entreprise'] ?? [];

    // On prépare le HTML pour le PDF (très simple car Dompdf est capricieux)
    $html = "
    <html>
    <head>
        <style>
            body { font-family: sans-serif; color: #333; }
            h1 { color: #764ba2; border-bottom: 2px solid #764ba2; }
            .exp { margin-bottom: 15px; }
            .job { font-weight: bold; }
        </style>
    </head>
    <body>
        <h1>$prenom $nom</h1>
        <h3>$titre</h3>
        <hr>
        <h4>EXPÉRIENCES PROFESSIONNELLES</h4>";
    
    foreach ($exp_titres as $key => $val) {
        $t = htmlspecialchars($val);
        $e = htmlspecialchars($exp_entreprises[$key]);
        $html .= "<div class='exp'><span class='job'>$t</span> chez $e</div>";
    }

    $html .= "</body></html>";

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("CV_$nom.pdf");
}