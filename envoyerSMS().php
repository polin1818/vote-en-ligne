function envoyerSMS($telephone, $message) {
    // URL de l'API Textbelt
    $url = 'https://textbelt.com/text';

    // Votre clé API Textbelt
    $api_key = 'textbelt';  // Remplacez par votre propre clé API

    // Préparation des données à envoyer à l'API
    $data = array(
        'phone' => $telephone,   // Le numéro de téléphone au format international
        'message' => $message,   // Le message à envoyer
        'key' => $api_key        // Votre clé API
    );

    // Initialisation de cURL
    $ch = curl_init($url);
    
    // Configuration de la requête cURL
    curl_setopt($ch, CURLOPT_POST, 1);  // Envoi d'une requête POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));  // Données envoyées dans le POST
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Retourner la réponse de l'API

    // Exécution de la requête cURL et récupération de la réponse
    $response = curl_exec($ch);
    
    // Vérification d'éventuelles erreurs cURL
    if (curl_errno($ch)) {
        echo 'Erreur cURL: ' . curl_error($ch);
    }
    
    // Fermeture de la session cURL
    curl_close($ch);

    // Traitement de la réponse de l'API
    $response_data = json_decode($response, true);
    if ($response_data['success']) {
        echo "Le message a été envoyé avec succès à $telephone";
    } else {
        echo "Erreur lors de l'envoi du message à $telephone: " . $response_data['error'];
    }
}
