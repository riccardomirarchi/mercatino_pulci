<?php 
  require_once 'connection.php'; 
  session_start();

  function loginHandler($conn) {
    if($_REQUEST["email"] && $_REQUEST["password"]) {
      $email =  $_REQUEST["email"];
      $password = $_REQUEST["password"];

      $query = "SELECT * FROM `utente` WHERE email = '".$email."'";
      $result = $conn->query($query);

      $row = $result->fetch_assoc();

      if ($row["password"] == '-') {
        header("Location: ../index.php?loginError=userDeleted"); 
        return;
      }

      if ($result -> num_rows > 0 && $row["email"] == $email && password_verify($password, $row["password"])) {
        $_SESSION["logged_in"] = true; 
        $_SESSION["email"] = $email;
        $_SESSION["userID"] = $row["id"];
        $_SESSION["ruolo"] = $row["ruolo"];
        $_SESSION["regione"] = $row["regione"];
        $_SESSION["provincia"] = $row["provincia"];
        $_SESSION["città"] = $row["citta"];
        $_SESSION["nome"] = $row["nome"];
        $_SESSION["cognome"] = $row["cognome"];

        header("Location: ../index.php");
      } else { 
        if ($result -> num_rows > 0) {
          header("Location: ../index.php?loginError=userexists");
        } else {
          header("Location: ../index.php?loginError=incorrectuser");
        }
      }
    } else {
      header("Location: ../index.php?loginError=emptyfields"); 
    }
  }

  if (isset($_REQUEST['loginSubmit'])) {
    loginHandler($conn);
  }

  function logoutHandler() {
    session_destroy();
    session_unset();
    
    header("Location: ../index.php");
  }

  if (isset($_REQUEST['logoutSubmit'])) {
    logoutHandler();
  }
?>