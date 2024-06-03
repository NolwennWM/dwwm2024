<?php
// J'indique quels sites ont accès à mon API
header("Access-Control-Allow-Origin: *");
// J'indique le format des données retournées par l'API
header("Content-Type: application/json; charset=UTF-8");
// La durée maximal de la requête
header("Access-Control-Max-Age: 3600");
// On indique la possibilité d'échanger des identifiants avec l'API
header("Access-Control-Allow-Credentials: true");
// Quels sont les entêtes acceptées venant d'une requête exterieur.
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

/**
 * Affiche la réponse de l'API
 *
 * @param array $data données à afficher
 * @param integer $status code de status http
 * @param string $message message de status
 * @return void
 */
function sendResponse(array $data, int $status, string $message)
{
    http_response_code($status);
    echo json_encode([
        "data"=>$data,
        "status"=>$status,
        "message"=>$message
    ]);
    exit;
}
/**
 * Sauvegarde un message d'erreur
 * Ou retourne la totalité des erreurs
 *
 * @param boolean $property nom du message d'erreur
 * @param boolean $message  contenu du message d'erreur
 * @return array|void
 */
function setError($property = false, $message = false)
{
    static $error = [];
    if(!$property || !$message)return ["violations"=>$error];
    $error[] = [
        "propertyPath"=> $property,
        "message"=>$message
    ];
}
?>