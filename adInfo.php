<!DOCTYPE html>
<html lang="it">

<head>
  <title>Annuncio</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <?php
  require_once 'components/imports.php';
  require_once 'components/header.php';
  ?>
</head>
<style>
  .emp-profile {
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
  }

  .profile-img {
    text-align: center;
    height: 87%;
    max-height: 450px;
  }

  .profile-img img {
    width: 90%;
    height: 80%;
    max-height: 360px;
    object-fit: cover;
    border-radius: 5%;
  }

  .profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    height: 50%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
  }

  .profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
  }

  .profile-head h5 {
    color: #333;
  }

  .profile-head h6 {
    color: #0062cc;
  }

  .profile-edit-btn {
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
    background-color: #717fe0;
  }

  .proile-rating {
    font-size: 12px;
    color: #818182;
  }

  .proile-rating span {
    color: #495057;
    font-size: 15px;
    font-weight: 600;
  }

  .profile-head .nav-tabs {
    margin-bottom: 5%;
  }

  .profile-head .nav-tabs .nav-link {
    font-weight: 600;
    border: none;
  }

  .profile-head .nav-tabs .nav-link.active {
    border: none;
    border-bottom: 2px solid #0062cc;
  }

  .profile-work {
    padding: 14%;
    margin-top: -10%;
  }

  .profile-work p {
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
  }

  .profile-work a {
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
  }

  .profile-work ul {
    list-style: none;
  }

  .profile-tab label {
    font-weight: 600;
  }

  .profile-tab p {
    font-weight: 600;
    color: #0062cc;
  }
</style>

<body class="animsition" id="body">


  <?php
  require_once 'components/sidebar.php';
  require_once 'components/scripts.php';
  ?>

  <section class="bg0 p-t-23 m-t-125">
    <div class="container">
      <div class="p-b-10">
        <h3 class="ltext-103 cl5">Annuncio</h3>
      </div>
      <?php
      require_once 'api/ads_functions.php';
      $adId = $_REQUEST['adId'];

      $result = getAdInfo($conn, $adId);

      if ($result['immagine']) {
        $path = $result['immagine'];
      } else {
        $path = 'na.png';
      }

      $id = $result['id_annuncio'];

      if (isset($_SESSION['logged_in'])) {
        $observe = observeAd($conn, $userId, $id);
      } else {
        $observe = false;
      }

      $addedClass = $observe ? 'js-addedwish-b2' : '';

      ?>
      <input hidden id="seller" value="<?php echo $result['venditore'] ?>" />
      <input hidden id="product" value="<?php echo $result['id_annuncio'] ?>" />
      <div class="row m-t-60 m-b-40">
        <div class="col-md-4">
          <div class="profile-img">
            <img src="ads_images/<?php echo $path ?>" alt="profile_image" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="profile-head">
            <div style="height:325px;">
              <h4 class="m-b-5" id="adTitle">
                <?php
                echo $result['titolo'];
                if ($result['stato_annuncio'] == 'Scaduto' || $result['stato_annuncio'] == 'Venduto') {
                  echo ' - ' . $result['stato_annuncio'];
                }
                ?>
              </h4>
              <a href="profileInfo.php?userid=<?php echo $result['venditore'] ?>">
                <h6>
                  <?php
                  echo 'di ' . $result['nome'] . ' ' . $result['cognome'];
                  ?>
                </h6>
              </a>
              <div class="row" style="margin-top: 6%;">
                <p class="proile-rating m-l-15">PREZZO : <span class="m-l-10" style="color:#0062cc;">
                    <?php
                    echo $result['prezzo'] . '€';
                    ?></span></p>
              </div>
              <p class="proile-rating" style="margin-top: 4%;">CATEGORIA : <span class="m-l-10">
                  <?php
                  echo $result['categoria'];
                  ?></span></p>
              <p class="proile-rating m-t-10">SOTTOCATEGORIA : <span class="m-l-10">
                  <?php
                  echo $result['sottocategoria'];
                  ?></span> </p>
              <p class="proile-rating m-t-30 m-b-10">DESCRIZIONE : </p>
              <span style="margin-bottom:10%;">
                <?php
                echo $result['descrizione'];
                ?></span>
            </div>
            <ul class="nav nav-tabs">
            </ul>
          </div>
        </div>
        <?php
        if (isset($_SESSION['userID']) && $_SESSION['userID'] == $result['venditore']) {
          if ($result['stato_annuncio'] == 'Scaduto') {
            echo '
					<button type="button" id="modal_button" class="flex-c-m stext-101 cl0 size-126 bg1 bor1 hov-btn4 p-lr-15 trans-04" data-toggle="modal" data-target="#exampleModal">
            riattiva
          </button>';
          }
          echo '<div class="row">
          <button
					class="flex-c-m stext-101 cl0 size-126 bg1 bor1 m-l-25" style="background-color:red; color: white;pointer: cursor;" data-toggle="modal" data-target="#deleteAd"
					>
					Elimina
					</button>
				  </div>';
        } else {
          if ($result['stato_annuncio'] !== 'Venduto') {
            echo '<div class="row">
					<button type="button" id="modal_button" class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04" data-toggle="modal" data-target="#offerModal" style="margin-top:-8px">
            fai un offerta
          </button>
				</div>';
          }
        }
        ?>
      </div>
      <div class="row">
        <div class="col-md-4 m-t-20" style="height: 200px">
          <div class="profile-work">
            <div class="row m-l-4" style="margin-top: -50%">
              <!-- <img src="images/icons/heart.png" alt="ICON" style="width: 25px; height: 25px; margin-top: 27px" /> -->
              <button class="btn-addwish-b2 dis-block js-addwish-b2 <?php echo $addedClass ?>" onclick="observeHandler(this, false, true)" id="<?php echo $result['id_annuncio'] ?>" style="margin-top:-3px">
                <img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON" style="margin-left:2px; height:22px;margin-top:31px;margin-left:-0.5px" />
                <img class="icon-heart2 dis-block trans-04" src="images/icons/icon-heart-02.png" alt="ICON" style="margin-left:2px; height:22px;margin-top:-21px;margin-left:-0.5px" />
              </button>
              <p class="proile-rating m-l-15"><?php echo $result['num_osservatori'] . ' osservatori' ?><span class="m-l-10"></span> </p>
            </div>
          </div>
          <div class="profile-work">
            <div class="row m-l-4" style="margin-top: -60%">
              <img src="images/icons/location-pointer.png" alt="ICON" style="width: 25px; height: 25px; margin-top: 25px" />
              <p class="proile-rating m-l-10"><?php echo $result['citta_residenza'] . ', ' . $result['provincia_residenza'] ?><span class="m-l-10"></span> </p>
            </div>
          </div>
          <div class="profile-work">
            <div class="row m-l-4" style="margin-top: -70%">
              <img src="images/icons/icon-email.png" alt="ICON" style="width: 25px; height: 20px; margin-top: 30px" />
              <p class="proile-rating m-l-10"><?php echo $result['email'] ?><span class="m-l-10"></span> </p>
            </div>
          </div>
          <div class="profile-work">
            <div class="row m-l-4" style="margin-top: -80%">
              <img src="images/icons/rating.png" alt="ICON" style="width: 25px; height: 25px; margin-top: 23px" />
              <p class="proile-rating m-l-10">
                <?php
                if ($result['valutazione_venditore']) {
                  echo bcdiv($result['valutazione_venditore'], 1, 1) . '/5';
                } else {
                  echo 'Il venditore non ha valutazioni';
                }
                ?>
              </p>
            </div>
          </div>
          <?php
          if (isset($_SESSION['userID']) && $_SESSION['userID'] !== $result['venditore'] && $result['stato_annuncio'] !== 'Venduto') {
            echo '<div class="profile-work">
              <center>
                <button type="button" id="message_button" class="flex-c-m stext-101 cl0 size-126 bg1 bor1 hov-btn4 p-lr-15 trans-04" data-toggle="modal" data-target="#messageModal" style="margin-top:-75%">
                  Contatta venditore
                </button>
              </center>
            </div>';
          }
          ?>
        </div>
        <div class="col-md-8" style="margin-top:-30px">
          <p class="proile-rating m-b-10" style="font-size:14px;">
            INFORMAZIONI SUL PRODOTTO :
          </p>
          <div class="row">
            <p class="proile-rating m-t-10 col-md-5">PRODOTTO : <span class="m-l-10">
                <?php
                echo $result['nome_prodotto'];
                ?></span> </p>
            <p class="proile-rating m-t-10 col-md-4">CONDIZIONE PRODOTTO : <span class="m-l-10">
                <?php
                echo $result['condizione_prodotto'];
                ?></span> </p>
          </div>
          <div class="row">
            <p class="proile-rating m-t-10 col-md-5">
              <?php
              if ($result['condizione_prodotto'] == 'Usato') {
                echo 'USURA';
              } else {
                echo 'GARANZIA';
              }
              ?> : <span class="m-l-10">
                <?php
                if ($result['condizione_prodotto'] == 'Usato') {
                  echo $result['usura'];
                } else {
                  if ($result['garanzia']) {
                    echo 'Si';
                  } else {
                    echo 'No';
                  }
                }
                ?></span> </p>
            <p class="proile-rating m-t-10 col-md-7">
              <?php
              if ($result['condizione_prodotto'] == 'Usato') {
                echo 'INIZIO UTILIZZO :';
              } else {
                if ($result['garanzia']) {
                  echo 'FINE COPERTURA :';
                } else {
                  echo '';
                }
              }
              ?><span class="m-l-10">
                <?php

                if ($result['condizione_prodotto'] == 'Usato') {
                  $date = explode("-", str_split($result['inizio_utilizzo'], 10)[0]);
                  echo $date[2] . '-' . $date[1] . '-' . $date[0];
                } else {
                  if ($result['garanzia']) {
                    $date = explode("-", str_split($result['fine_copertura'], 10)[0]);
                    echo $date[2] . '-' . $date[1] . '-' . $date[0];
                  } else {
                    echo '';
                  }
                }
                ?></span> </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php
  require_once 'components/footer.php';
  require_once 'components/offerModal.php';
  require_once 'components/messageModal.php';
  require_once 'components/deleteAdModal.php';
  ?>
</body>

</html>