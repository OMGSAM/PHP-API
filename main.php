<!DOCTYPE html>
<html>
<body>
<form method="GET" action="">
    <label for="pays">Entrez un pays :</label>
    <input type="text" id="pays" name="pays" required>
    <button type="submit">Soumettre</button>
</form>


<?php
if (isset($_GET['pays'])) {
    $pays = urlencode($_GET['pays']); // Sécuriser l'entrée utilisateur pour l'URL

    // Construire l'URL de l'API
    $url = "http://universities.hipolabs.com/search?country=$pays"; // Remplacez par l'URL réelle de l'API

    // Initialiser la session cURL
    $ch = curl_init();

    // Configurer les options cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Exécuter la requête et récupérer la réponse
    $response = curl_exec($ch);

    // Vérifier si une erreur cURL s'est produite
    if(curl_errno($ch)) {
        echo "Erreur cURL: " . curl_error($ch);
    }

    // Fermer la session cURL
    curl_close($ch);

    // Vérifier si la réponse est valide
    if ($response) {
        $data = json_decode($response, true); 

        // Traitez les données de l'API ici, par exemple les afficher
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    } else {
        echo "Aucune donnée trouvée pour le pays spécifié.";
    }
} else {
    echo "Veuillez spécifier un pays.";
}
?>

</body>
</html>
