<?php 
  if ($info['name']) {
    $name = $info['name'];
  } else {
    $errors .= 'nameError=1&';  
  }

  if ($info['surname']) {
    $surname = $info['surname'];
  } else {
    $errors .= 'surnameError=1&';
  }

  if ($info['CF']) {
    if(strlen($info['CF']) < 16) {
      $errors .= 'codeError=1&lenerror=1';
    } 
    $CF = $info['CF']; 
  } else {
    $errors .= 'codeError=1&';
  }

  if ($info['email']) {
    $email = $info['email'];
  } else {
    $errors .= 'emailError=1&';
  }

  if ($info['address']) {
    $address = $info['address'];
    $address = $conn->real_escape_string($address);
  } else {
    $errors .= 'addressError=1&';
  }

  if ($info['region']) {
    $region = $info['region'];
  } else {
    $errors .= 'regionError=1&';
  }

  if ($info['province']) {
    $province = $info['province'];
  } else {
    $errors .= 'provinceError=1&';
  }

  if ($info['city']) {
    $city = $info['city'];
  } else {
    $errors .= 'cityError=1&';
  }

  if ($info['acquirente'] || $info['venditore']) {
    if ($info['acquirente'] == 'on' && $info['venditore'] == 'on') {
      $role = 'e';
    } else if ($info['venditore'] == 'on') {
      $role = 'v';
    } else {
      $role = 'a';
    }
  } else {
    $errors .= 'roleError=1&';
  }

  if ($info['password']) {
    $password = $info['password'];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
  } else {
    $errors .= 'passwordError=1&';
  }

  if (!$info['passwordConfirm']) {
    $errors .= 'confirmError=1&';
  }

  if ($info['password'] != $info['passwordConfirm']) {
    $errors .= 'matchError=Le due password non corrispondono&';
  }
?>