<?php 
  function moveImage($from, $name, $surname) {
    if ($from == 'reg') {
      $destination = '../profile_images/';
      $fileName = $_FILES['image_upload']['name'];
      $tempName = $_FILES['image_upload']['tmp_name'];
      $extension = pathinfo($fileName, PATHINFO_EXTENSION);
      $size= $_FILES['image_upload']['size'];
      $redirect = 'Location: ../register.php?';
    } else {
      $destination = '../ads_images/';
      $fileName = $_FILES['image']['name'];
      $tempName = $_FILES['image']['tmp_name'];
      $extension = pathinfo($fileName, PATHINFO_EXTENSION);
      $size= $_FILES['image']['size'];
      $redirect = 'Location: ../insertAd.php?';
    }
  
    if (isset($fileName) && !empty($fileName)) {
      if ($size < 1048576*2) { // 2MB MAXIMUM SIZE
        $file = substr($name, 0, 3) . substr($surname, 0, 3) . rand(0,10000);
        $renamedFile = 'upload' . strtolower($file) . '.' . $extension;
        if (!move_uploaded_file($tempName, $destination . $renamedFile)) {
          header($redirect . 'uploadError=1');
          die();
        }
      } else {
        header($redirect . 'sizeError=1');
        die();
      }
    }
    return $renamedFile;
  }
?>