<?php 
  if ($info['title']) {
    $title = $info['title'];
  } else {
    $errors .= 'titleError=1&';  
  }

  if ($info['description']) {
    $description = $info['description'];
  } else {
    $errors .= 'descriptionError=1&';
  }

  if ($info['price']) {
    $price = $info['price'];
  } else {
    $errors .= 'priceError=1&';
  }

  if ($info['category']) {
    $category = $info['category'];
  } else {
    $errors .= 'categoryError=1&';
  }

  if ($info['subcategory']) {
    $subcategory = $info['subcategory'];
  } else {
    $errors .= 'subcategoryError=1&';
  }

  if ($info['publishing_region']) {
    $publishing_region = $info['publishing_region'];
  } else {
    $errors .= 'publishing_regionError=1&';
  }

  if ($info['publishing_province']) {
    $publishing_province = $info['publishing_province'];
  } else {
    $errors .= 'publishing_provinceError=1&';
  }

  if ($info['publishing_city']) {
    $publishing_city = $info['publishing_city'];
  } else {
    $errors .= 'publishing_cityError=1&';
  }

  if ($info['visibility']) {
    $visibility = $info['visibility'];
  } else {
    $errors .= 'visibilityError=1&';
  }

  if ($visibility == 'Ristretta' && !$info['restriction_method']) {
    $errors .= 'restriction_methodError=1&';
  } else {
    $restriction_method = $info['restriction_method'];
  }

  if ($visibility == 'Ristretta' && !$info['restriction']) {
    $errors .= 'restrictionError=1&';
  } else {
    $restriction = $info['restriction'];
  }

  if ($info['product_name']) {
    $product_name = $info['product_name'];
  } else {
    $errors .= 'product_nameError=1&';
  }

  if ($info['product_condition']) {
    $product_condition = $info['product_condition'];
  } else {
    $errors .= 'product_conditionError=1&';
  }

  if ($info['warranty']) {
    $warranty = $info['warranty'];
  } else {
    $errors .= 'warrantyError=1&';
  }
 
  if (!($product_condition == 'Nuovo' && $warranty == 'No')) {
    if ($info['warranty_period']) {
      $warranty_period = $info['warranty_period'];
    } else {
      $errors .= 'warranty_periodError=1';
    }
  }
?>