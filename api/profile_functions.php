<?php 
    require_once 'connection.php'; 
  
    function fetchTopSellers($conn) {
      $query = "SELECT * FROM `top_venditori` where nome <> '-' LIMIT 10";
      
      return $conn->query($query);
    }

    function getProfile($conn, $userId) {
      $query = "SELECT * FROM `utenti_con_valutazione` WHERE id_utente='". $userId ."'";

      $result = $conn->query($query);
      return $result->fetch_assoc();
    }

    function getReceivedOffers($conn, $userId) {
      $query = "SELECT * FROM `transazione` join annunci_completi on transazione.prodotto = annunci_completi.id_annuncio where transazione.venditore = '$userId' order by transazione.data DESC";
 
      return $conn->query($query);    
    }

    function getSentOffers($conn, $userId) {
      $query = "SELECT * FROM `transazione` join annunci_completi on transazione.prodotto = annunci_completi.id_annuncio where transazione.acquirente = '$userId' order by transazione.data DESC";

      return $conn->query($query);
    }

    function getMessagesContacts($conn, $userId) {
      $query = "SELECT destinatario, annuncio, mittente FROM messaggio where destinatario = '$userId' GROUP by destinatario, annuncio, mittente";

      return $conn->query($query);
    }

    function getLastMessage($conn, $sender, $recipient, $ad) {
      $query = "SELECT testo, mittente, data_invio, visualizzato FROM messaggio WHERE (destinatario = '$recipient' AND mittente = '$sender' OR destinatario='$sender' AND mittente='$recipient') AND annuncio = '$ad' AND data_invio = (SELECT MAX(data_invio) FROM messaggio WHERE (destinatario = '$recipient' AND mittente = '$sender' OR destinatario='$sender' AND mittente='$recipient') AND annuncio = '$ad')";

      $result = $conn->query($query);
      return $result->fetch_assoc();
    }
?>