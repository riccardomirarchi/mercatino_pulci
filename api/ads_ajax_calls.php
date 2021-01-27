<?php 
  require_once 'connection.php';
  session_start();

  function handleError($result, $conn) {
    if(!$result) {
      header('Content-type: application/json');
      echo json_encode(array(
        'error' => array(
          'msg' => $conn->error,
        )));
      throw new Exception;
    }
  }

  function addWatchlist($conn) {
    if (isset($_SESSION['userID'])) {
      $userId = $_SESSION['userID'];
    }
    
    $adId = $_POST['adId'];

    if ($_POST['insert']) {
      $query = "INSERT INTO `osservati` VALUES ('". $userId ."', '". $adId ."')";
    } else {
      $query = "DELETE FROM `osservati` WHERE `osservati`.`annuncio` = '$adId' AND `osservati`.`utente` = '$userId'";
    }
   
    $result = $conn->query($query);
    
    handleError($result, $conn);
	}
	
  if (isset($_POST['watchlist'])) {
    addWatchlist($conn);
  }

  function deleteAd($conn) {
    $adId = $_POST['adId'];

    $query = "UPDATE `annuncio` SET `stato` = 'Eliminato' WHERE `annuncio`.`id` = '$adId'";
   
    $result = $conn->query($query);

    handleError($result, $conn);
	}

	if (isset($_POST['delete'])) {
    deleteAd($conn);
  }

  function reactivateAd($conn) {
    $adId = $_REQUEST['adId'];

    $query = "UPDATE `annuncio` SET `stato` = 'In vendita' WHERE `annuncio`.`id` = '$adId'";
   
		$result = $conn->query($query);
		
		handleError($result, $conn);

    $query = "UPDATE `annuncio` SET `data_inserimento` = CURRENT_TIMESTAMP WHERE `annuncio`.`id` = '$adId'";

    $dateResult = $conn->query($query);

    handleError($dateResult && $result, $conn);
	}
	
	if (isset($_POST['reactivate'])) {
    reactivateAd($conn);
  }

  function offerHandler($conn) {
    if (isset($_SESSION['userID'])) {
      $buyerId = $_SESSION['userID'];
    }
    $sellerId = $_REQUEST['seller'];
    $productId = $_REQUEST['adId'];
    $amount = $_REQUEST['amount'];
    $method = $_REQUEST['method'];

    if (!$method || !$amount) {
			header('Content-type: application/json');
      echo json_encode(array(
        "error" => array(
          'msg' => 'Riempi tutti i campi!',
        ),
			));
			return;
    }

    $query="INSERT INTO `transazione` (`acquirente`, `venditore`, `prodotto`, `metodo`, `somma`, `data`) VALUES ('$buyerId', '$sellerId', '$productId', '$method', '$amount', CURRENT_TIMESTAMP)";

    $result = $conn->query($query);

		handleError($result, $conn);
		
		header('Content-type: application/json');
    echo json_encode(array(
      "success" => array(
        'msg' => 'offer sent successfully',
        'status' => 'ok',
        ),
    ));
	}
	
	if (isset($_POST['offerHandler'])) {
		offerHandler($conn);
	}

	function updateAdStatus($conn) {
		$query = "UPDATE annuncio JOIN prodotto ON annuncio.id = prodotto.annuncio SET stato = 'Scaduto' WHERE (date(annuncio.data_inserimento) + interval 3 day <= CURRENT_DATE AND prodotto.condizione='Usato' AND annuncio.stato='In vendita') OR (date(annuncio.data_inserimento) + interval 10 day <= CURRENT_DATE AND prodotto.condizione='Nuovo' AND annuncio.stato='In vendita')";
   
    $result = $conn->query($query);

		handleError($result, $conn);
		
		header('Content-type: application/json');
    echo json_encode(array(
      "statusUpdate" => array(
        "affected_rows" => $conn->affected_rows,
      )
    ));
	}

	if (isset($_POST['updateStatus'])) {
		updateAdStatus($conn);
	}
?>