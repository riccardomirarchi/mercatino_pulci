<?php 
  require_once 'connection.php';
  require_once 'moveImage.php';
  session_start();
  
  function registrationHandler($conn) {
    $info = $_REQUEST;
    $errors = '';

    require_once 'checkRegErrors.php';

    if ($errors) {
      header("Location: ../register.php?" . $errors);
    } else {

      $from ='reg';

      $renamedFile = moveImage($from, $name, $surname);

      if ($renamedFile) {
        $query = "INSERT INTO `utente`(
          `id`,
          `nome`,
          `cognome`,
          `email`,
          `password`,
          `cf`,
          `ruolo`,
          `indirizzo`,
          `citta`,
          `provincia`,
          `regione`,
          `immagine`
      )
      VALUES(
          NULL,
          '". $name ."',
          '". $surname ."',
          '". $email ."',
          '". $hashed_password ."',
          '". $CF ."',
          '". $role ."',
          '". $address ."',
          '". $city ."',
          '". $province ."',
          '". $region ."',
          '". $renamedFile ."'
      )";
      } else {
        $query = "INSERT INTO `utente` VALUES(
          NULL,
          '". $name ."',
          '". $surname ."',
          '". $email ."',
          '". $hashed_password ."',
          '". $CF ."',
          '". $role ."',
          '". $address ."',
          '". $city ."',
          '". $province ."',
          '". $region ."',
          NULL
      )";
      }
  
      $result = $conn->query($query);

      if ($result) {
        header("Location: ../register.php?registrationSuccessful=1");
      } else {
        header("Location: ../register.php?registrationError=1");
      }
    }
  }

  if (isset($_REQUEST['registrationSubmit'])) {
    registrationHandler($conn);
  }

  function removeUser($conn) {
    if (isset($_SESSION['userID'])) {
      $userId = $_SESSION['userID'];
    }
    
    $query = "UPDATE `utente` SET `nome` = '-', `cognome` = '-', `immagine` = NULL, `password` = '-', `cf` = '-', `ruolo` = '-', `indirizzo` = '-', `citta` = '-', `provincia` = '-', `regione` = '-' WHERE `utente`.`id` ='". $userId ."'";
    $result = $conn->query($query);

    if ($result) {
      // delete all the ads from the deleted user
      $query = "UPDATE `annuncio` SET `stato` = 'Eliminato'  WHERE `venditore` = '". $userId ."'";
      $update = $conn->query($query);

      if ($update) {
        // just to make sure the deleted user will be logged out from the platform
        session_destroy();
        session_unset();
        // then nav back to the index with success status
        header('Location: ../index.php?deleteUserStatus=1');
      } else {
        header('Location: ../profileInfo.php?deleteUserStatus=0&userid=' . $userId);
      }
    } else {
      header('Location: ../profileInfo.php?deleteUserStatus=0&userid=' . $userId);
    }
  }

  if (isset($_REQUEST['removeUserSubmit'])) {
    removeUser($conn);
  }

  function changeUserRole($conn) {
    if (isset($_SESSION['userID'])) {
      $userId = $_SESSION['userID'];
    }
  
    if ($_REQUEST['acquirente'] && $_REQUEST['venditore']) {
      $role = 'e';
    } else if ($_REQUEST['acquirente']) {
      $role = 'a';
    } else if ($_REQUEST['venditore']) {
      $role = 'v';
    }

    if (!$role) {
      header('Location: ../profileInfo.php?selectionError=1&userid=' . $userId);
    } else {
      $query = "UPDATE `utente` SET `ruolo` = '". $role ."' WHERE `utente`.`id` = '". $userId ."'";
      $result = $conn->query($query);

      if ($result) {
        $_SESSION['ruolo'] = $role;
        header('Location: ../profileInfo.php?updateSuccessful=1&userid=' . $userId);
      } else {
        header('Location: ../profileInfo.php?updateError=1&userid=' . $userId);
      }
    }
  }

  if (isset($_REQUEST['changeUserRole'])) {
    changeUserRole($conn);
  }
?>