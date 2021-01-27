<?php 
  require_once 'connection.php'; 
  require_once 'moveImage.php';
  session_start();

  if (isset($_SESSION)) {
    $userId = $_SESSION["userID"];
    $name = $_SESSION['nome'];
    $surname = $_SESSION['cognome'];
  }
    
  $info = $_REQUEST;
  $errors = '';

  // empty field checks
  require_once 'checkInsertionErrors.php';
  
  if ($errors) {
    header("Location: ../insertAd.php?" . $errors);
  } else {

    $from ='ad_insertion';

    $renamedFile = moveImage($from, $name, $surname);
    
    if ($restriction_method == 'Città') {
      $visibility_field = 'citta_visibilita';
    } else if ($restriction_method == 'Provincia') {
      $visibility_field = 'provincia_visibilita';
    } else {
      $visibility_field = 'regione_visibilita';
    }

    if ($product_condition == 'Nuovo') {
      $warranty = $warranty == 'Si' ? true : 0;
      $warranty_ending = $warranty == 'Si' ? $warranty_period : '';
    } else {
      $use = $warranty;
      $warranty = '';
      $initial_use = $warranty_period;
    }

    $transactionQuery = "START TRANSACTION";
    
    $queryAd = "INSERT INTO `annuncio` (`id`, `venditore`, `titolo`, `descrizione`, `stato`, `data_inserimento`, `citta`, `provincia`, `regione`, `visibilita`, `immagine`, `$visibility_field`)    
    VALUES(
        NULL,
        '$userId',
        '$title',
        '$description',
        'In vendita',
        CURRENT_TIMESTAMP,
        '$publishing_city',
        '$publishing_province',
        '$publishing_region',
        '$visibility',
        NULLIF('$renamedFile',''),
        NULLIF('$restriction','')
    )";
    $resultInit = $conn->query($transactionQuery);
    $resultAd = $conn->query($queryAd);

    $idQuery="SELECT MAX(id) as id FROM annuncio";
    $id = $conn->query($idQuery);
    $id = $id->fetch_assoc();
    $id = $id['id'];

    $queryProduct = "INSERT INTO prodotto(`annuncio`, `nome`, `categoria`, `sottocategoria`, `prezzo`, `condizione`, `garanzia`, `fine_copertura`, `usura`, `inizio_utilizzo`)
      VALUES(
        '$id',
        '$product_name',
        '$category',
        '$subcategory',
        '$price',
        '$product_condition',
        NULLIF('$warranty',''),
        NULLIF('$warranty_ending',''),
        NULLIF('$use',''),
        NULLIF('$initial_use','')
    );";

    $commitQuery = "COMMIT";
    $resultProduct = $conn->query($queryProduct);
    $resultCommit = $conn->query($commitQuery);

    // echo 'init: ' .$resultInit . ' ad: '. $resultAd . ' prod: ' . $resultProduct . ' comm: '. $resultCommit;

    if ($resultInit && $resultAd && $resultProduct && $resultCommit) {
      header("Location: ../adInfo.php?insertionsuccessful=1&adId=" . $id);
    } else {
      header("Location: ../insertAd.php?insertionerror=1");
    }
  }
?>