<?php
    require_once 'connection.php'; 
    // session_start();
    if (isset($_SESSION['userID'])) {
      $userId = $_SESSION['userID'];
    }

    function getMyAds($conn, $userId) {
      $query = "SELECT * FROM `annunci_completi` WHERE venditore = '$userId' ORDER BY data_inserimento DESC";

      return $conn->query($query);
    }

    function getMyWatchlist($conn, $userId) {
      $query = "SELECT * FROM osservati JOIN annunci_completi ON osservati.annuncio = annunci_completi.id_annuncio WHERE osservati.utente = '$userId'";

      return $conn->query($query);
    }

    function getAds($conn) {
      $query = "SELECT * FROM `annunci_completi` WHERE stato_annuncio = 'In vendita'";

      return $conn->query($query);
    }

    function getAdInfo($conn, $adId) {
      $query = "SELECT * FROM `annunci_completi` JOIN `utenti_con_valutazione` ON annunci_completi.venditore = utenti_con_valutazione.id_utente WHERE id_annuncio ='$adId'";

      $result = $conn->query($query);

      return $result->fetch_assoc();
    }

    function observeAd($conn, $userId, $id) {
      $query = "SELECT * FROM osservati where annuncio = '$id' AND utente = '$userId'";
    
      $response = $conn->query($query);

      if ($response->num_rows > 0) {
        $observe = true;
      } else {
        $observe = false;
      }

      return $observe;
    }

    function getSoldAds($conn, $userId) {
      $query = "SELECT * FROM annunci_completi WHERE stato_annuncio = 'Venduto' AND venditore='". $userId ."'";
      return $conn->query($query);
    }
  
    function getBoughtAds($conn,$userId) {
      $query = "SELECT titolo, immagine, categoria, sottocategoria, prezzo, id_annuncio FROM transazione JOIN annunci_completi ON transazione.prodotto = annunci_completi.id_annuncio where stato = 'Accettata' and acquirente='". $userId ."'";
      return $conn->query($query);
    }
?>