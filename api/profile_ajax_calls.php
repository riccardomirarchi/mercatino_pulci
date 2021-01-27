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

  function evalUser($conn) {
    $role = $_REQUEST['role'];
    $serieta = $_REQUEST['serieta'];
    $puntualita = $_REQUEST['puntualita'];
    $transactionId = $_REQUEST['transactionId'];

    if ($role == 'acquirente') {
      $query = "UPDATE `transazione` SET `puntualita_acquirente` = '$puntualita', `serieta_acquirente` = '$serieta' WHERE `transazione`.`id` = '$transactionId'";
    } else {
      $query = "UPDATE `transazione` SET `puntualita_venditore` = '$puntualita', `serieta_venditore` = '$serieta' WHERE `transazione`.`id` = '$transactionId'";
    }
    
    $result = $conn->query($query);

    handleError($result, $conn);
  }

  if(isset($_POST['evalUser'])) {
    evalUser($conn);
	}

	function getMessages($conn) {
    $mittente = $_REQUEST['mittente'];
    $destinatario = $_SESSION['userID'];
    $ad = $_REQUEST['adId'];

    $query = "SELECT destinatario, mittente, testo, data_invio, visualizzato, immagine FROM messaggio JOIN utente ON messaggio.mittente = utente.id WHERE (destinatario = '$destinatario' AND mittente = '$mittente' OR destinatario = '$mittente' AND mittente = '$destinatario' OR destinatario = '$destinatario' OR mittente = '$mittente' OR destinatario = '$mittente' OR mittente = '$destinatario') AND annuncio = '$ad' ORDER BY data_invio";
   
		$result = $conn->query($query);
		
		handleError($result, $conn);

    $messages = array();

    while($message = $result->fetch_assoc()) {
      $messages[] = $message;
		}

		header('Content-type: application/json');
    echo json_encode($messages);
	}

	if(isset($_POST['getMessages'])) {
		getMessages($conn);
	}

	function getOfferPopup($conn) {
    if (isset($_SESSION['userID'])) {
      $userId = $_SESSION['userID'];
      $query = "SELECT nome, cognome, titolo FROM transazione join utente join annunci_completi on transazione.acquirente = utente.id and transazione.prodotto = annunci_completi.id_annuncio where transazione.venditore = '$userId' and visualizzato = false";
   
      $result = $conn->query($query);

      handleError($result, $conn);

      $offers = array();

      while($offer = $result->fetch_assoc()) {
        $offers[] = $offer;
      }
      header('Content-type: application/json');
      echo json_encode($offers);
      
      // lastly update visualizzato so next time the user comes in the popup won't be shown
      if ($result->num_rows > 0) {
        $query = "UPDATE transazione set visualizzato = true where venditore = '$userId'";
        $updateResult = $conn->query($query);	

        handleError($updateResult, $conn);
      }
    } else {
      header('Content-type: application/json');
      echo json_encode(array(
        'warning' => array(
          'msg' => 'cannot fetch offers of unlogged user',
        )));
    }
	}

	if(isset($_POST['offersPopup'])) {
		getOfferPopup($conn);
	}

	function messageHandler($conn) {
    if (isset($_SESSION['userID'])) {
      $sender = $_SESSION['userID'];
    }
    $recipient = $_REQUEST['recipient'];
    $adId = $_REQUEST['adId'];
    $message = $conn->real_escape_string($_REQUEST['message']);

    $query="INSERT INTO `messaggio` (`mittente`, `destinatario`, `annuncio`, `testo`) VALUES ('$sender', '$recipient', '$adId', '$message')";

		$result = $conn->query($query);
		
		handleError($result, $conn);
	}

	if (isset($_POST['messageHandler'])) {
		messageHandler($conn);
	}

	function offerResponse($conn) {
		$response = $_REQUEST['response'];
    $offerId = $_REQUEST['offerId'];
    $productId = $_REQUEST['productId'];

    $query = "UPDATE `transazione` SET `stato` = '$response' WHERE `transazione`.`id` = '$offerId'";
   
		$result = $conn->query($query);
		
		handleError($result, $conn);

    if ($response == 'Accettata') {
      // this is just to make sure that the other offers concerning the same product will be set to Rifiutata,
      // so just one offer about a product will be set to Accettata
      $query = "UPDATE `transazione` SET `stato` = 'Rifiutata' WHERE `transazione`.`prodotto` = '$productId' AND `transazione`.`id` <> '$offerId'";

      $resultUpdate = $conn->query($query);

      handleError($resultUpdate, $conn);
    }
	}

	if (isset($_POST['offerResponse'])) {
		offerResponse($conn);
	}

	function updateMessages($conn) {
    $sender = $_REQUEST['mittente'];
    if (isset($_SESSION['userID'])) {
      $recipient = $_SESSION['userID'];
    }
    $adId = $_REQUEST['adId'];

    $query="UPDATE `messaggio` SET `visualizzato` = true WHERE destinatario = '$recipient' AND mittente = '$sender' AND annuncio = '$adId'";

    $result = $conn->query($query);

    handleError($result, $conn);

		header('Content-type: application/json');
    echo json_encode(array(
      "messagesUpdate" => array(
        "affected_rows" => $conn->affected_rows,
      )
    ));
	}

	if (isset($_POST['updateMessages'])) {
		updateMessages($conn);
	}
?>