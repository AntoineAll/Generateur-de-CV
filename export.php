<?php
// 1. Paramétrage des erreurs
ini_set('display_errors', 0); // Eviter d'afficher des erreurs qui polluent le binaire du PDF
error_reporting(E_ALL);

// 2. Chargement de Dompdf
require_once __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    
    // Nettoyage du tampon pour garantir le PDF propre
    if (ob_get_length()) ob_clean();

    // 3. Récupération de TOUTES les données du formulaire
    $data = $_POST;
    
    // Identifiant unique pour le stockage du CV et que cela ne se superpose pas avec les autres
    $data['id'] = $data['id'] ?? uniqid();
    $data['date_gen'] = date('d/m/Y H:i:s');
    $template_id = $data['template_id'] ?? '1';

    // 4. Sécurisation des Tableaux (évite les erreurs dans les templates si un champ est possiblement vide)
    $list_fields = [
        'experience_titre', 'experience_etab', 'experience_debut', 'experience_fin', 'experience_desc',
        'formation_titre', 'formation_etab', 'formation_debut', 'formation_fin',
        'competence_nom', 'competence_niveau',
        'langue_nom', 'langue_niveau'
    ];

    foreach ($list_fields as $field)
    {
        if (!isset($data[$field]) || !is_array($data[$field]))
        {
            $data[$field] = [];
        }
    }

    // 5. Gestion de la Photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) 
    {
        $type = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $img_content = file_get_contents($_FILES['photo']['tmp_name']);
        $data['photo_embed'] = 'data:image/' . $type . ';base64,' . base64_encode($img_content);
    } 
    // Si c'est une régénération depuis "Mon Compte", on garde l'ancienne photo si elle est déjà présente
    elseif (!isset($data['photo_embed'])) 
    {
        $data['photo_embed'] = '';
    }

    // 6.Sauvegarde dans le fichier local JSON
    $storage_file = 'cv_history.json';
    $history = [];
    if (file_exists($storage_file)) 
    {
        $history = json_decode(file_get_contents($storage_file), true);
    }

    // Mise à jour si l'ID existe, sinon on l'ajoute
    $updated = false;
    foreach ($history as $key => $entry) 
    {
        if (isset($entry['id']) && $entry['id'] === $data['id']) 
        {
            $history[$key] = $data;
            $updated = true;
            break;
        }
    }
    if (!$updated) 
    {
        $history[] = $data;
    }
    
    file_put_contents($storage_file, json_encode($history, JSON_PRETTY_PRINT));

    // 7. Préparation du rendu PDF
    ob_start();
    $cv = $data; // Var que j'utilise dans les fichiers tpl.php
    $tpl_path = __DIR__ . "/templates/tpl{$template_id}.php";

    if (file_exists($tpl_path))
    {
        include $tpl_path;
    }
    
    else 
    {
        die("Erreur fatale : Le template numéro {$template_id} n'existe pas.");
    }
    $html = ob_get_clean();

    // 8. Configuration de Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $options->set('defaultFont', 'Helvetica');

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // 9. Envoi du fichier
    $filename = "CV_" . preg_replace('/[^A-Za-z0-9]/', '_', $data['nom'] ?? 'SansNom') . ".pdf";
    $dompdf->stream($filename, ["Attachment" => true]);
    exit;

} else {
    // Si on accède au fichier sans POST, on va retourner à l'accueil
    header('Location: index.php');
    exit;
}