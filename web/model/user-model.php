<?php 

function getClient($clientEmail) {
    $db = acmeConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword 
    FROM clients
    WHERE clientEmail =:email';
    $stmt = $db -> prepare($sql);
    $stmt -> bindValue(':email', $clientEmail, PDO::PARAM_STR);
    $stmt -> execute();
    $clientData = $stmt -> fetch(PDO::FETCH_ASSOC);
    $stmt -> closeCursor();
    return $clientData;
}

?>