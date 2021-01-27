<?php 
  require_once 'connection.php';

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

  function getProvinces($conn) {
    if (isset($_REQUEST['region'])) {
      $region = $_REQUEST['region'];
    } else {
      $region= null;
    }

    if ($region) {
      $provinceQuery = "SELECT DISTINCT provincia FROM `comuni_completi` WHERE regione = '$region' ORDER BY provincia";
    } else {
      $provinceQuery = "SELECT DISTINCT provincia FROM `comuni_completi` ORDER BY provincia";
    }

    $result = $conn->query($provinceQuery);
    
    handleError($result, $conn);

    $provinces = array();

    while($province = $result->fetch_assoc()) {
      $provinces[] = $province;
    }
    header('Content-type: application/json');
    echo json_encode($provinces);

  }

  if (isset($_POST['provinces'])) {
    getProvinces($conn);
  }

  function getRegions($conn) {
    $regionQuery = "SELECT DISTINCT regione FROM `comuni_completi` ORDER BY regione";

    $result = $conn->query($regionQuery);

    handleError($result, $conn);

    $regions = array();

    while($region = $result->fetch_assoc()) {
      $regions[] = $region;
    }
    header('Content-type: application/json');
    echo json_encode($regions);
  }

  if (isset($_POST['regions'])) {
    getRegions(($conn));
  }

  function getCities($conn) {
    if (isset($_REQUEST['province'])) {
      $province = $_REQUEST['province'];
    } else {
      $province= null;
    }

    if ($province) {
      $citiesQuery = "SELECT DISTINCT comune FROM `comuni_completi` WHERE provincia = '$province' ORDER BY comune";
    } else {
      $citiesQuery = "SELECT DISTINCT comune FROM `comuni_completi` ORDER BY comune";
    }

    $result = $conn->query($citiesQuery);

    handleError($result, $conn);

    $cities = array();

    while($city = $result->fetch_assoc()) {
      $cities[] = $city;
    }
    header('Content-type: application/json');
    echo json_encode($cities);
  }

  if (isset($_POST['cities'])) {
    getCities($conn);
  }

  function getRestrictionResult($conn) {
    if (isset( $_REQUEST['restriction'])) {
      $restriction = $_REQUEST['restriction'];
    }
    
    if ($restriction == 'Città') {
      $query = "SELECT DISTINCT comune FROM `comuni_completi` ORDER BY comune";
    } else if ($restriction == 'Provincia') {
      $query = "SELECT DISTINCT provincia FROM `comuni_completi` ORDER BY provincia";
    } else if ($restriction == 'Regione') {
      $query = "SELECT DISTINCT regione FROM `comuni_completi` ORDER BY regione";
    }

    $result = $conn->query($query);

    handleError($result, $conn);

    $items = array();

    while($item = $result->fetch_assoc()) {
      $items[] = $item;
    }
    header('Content-type: application/json');
    echo json_encode($items);
  }

  if (isset($_POST['getRestriction'])) {
    getRestrictionResult($conn);
  }
?>