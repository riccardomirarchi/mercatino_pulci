<?php 
    require_once 'connection.php';
    if (isset($_SESSION['userID'])) {
      $userId = $_SESSION["userID"];
    }

    function headerMessageCount($conn, $userId) {
      $query = "SELECT * FROM `messaggio` WHERE  visualizzato = false AND destinatario='". $userId ."'";
      $result = $conn->query($query);

      return $result->num_rows;
    }
    
    function headerOfferCount($conn, $userId) {
      $query = "SELECT * FROM `transazione` where venditore = '$userId' and stato = 'proposta'";
      $result = $conn->query($query);

      return $result->num_rows;
    }
?>