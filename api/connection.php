<?php
  $servername = "localhost";
  $username = "ric";
  $password = "admin";
  $db = "934586_mercatino_mirarchi";
  
  // tried to host the website on a remote server, ignore this setup
  // $servername = "fdb30.awardspace.net";
  // $username = "3634412_progweb";
  // $password = "Riccardo98abc";
  // $db = "3634412_progweb";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $db);

  // Check connection
  if ($conn->connect_error) {
    // handle failed connection
    echo 'Connessione non stabilita';
  } 
?>