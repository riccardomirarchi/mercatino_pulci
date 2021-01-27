<?php
require_once './api/profile_functions.php';
?>
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
  }

  .profile-img img {
    width: 70%;
    height: 80%;
    object-fit: cover;
    border-radius: 5%;
    border-color: #717fe0;
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

  .price {
    font-weight: 600;
    color: #0062cc;
  }

  .method {
    font-weight: 600;
    color: gray;
  }

  .profile-tab p {
    font-weight: 600;
    color: #0062cc;
  }
</style>

<aside class="wrap-sidebar" id="js-sidebar-offers">
  <div class="s-full" onclick="hideOffers()"></div>

  <div class="sidebar flex-col-l p-t-22">
    <div class="flex-r w-full p-b-15 p-r-27">
      <div class="col-md-10 profile-head">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="received-tab" data-toggle="tab" href="#received" role="tab" aria-controls="received" aria-selected="true">Ricevute</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="sent-tab" data-toggle="tab" href="#sent" role="tab" aria-controls="sent" aria-selected="false">Inviate</a>
          </li>
        </ul>
      </div>
      <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 col-md-1" onclick="hideOffers()">
        <i class="zmdi zmdi-close"></i>
      </div>
    </div>

    <div class="sidebar-content w-full h-full p-lr-40 js-pscroll">

      <div class="tab-content profile-tab" id="myTabContent">

        <div class="tab-pane fade show active" id="received" role="tabpanel" aria-labelledby="received-tab">
          <?php
          $received = getReceivedOffers($conn, $userId);

          if ($received->num_rows > 0) {
            while ($item = $received->fetch_assoc()) {

              $buyer = $item['acquirente'];

              $userInfo = getProfile($conn, $buyer);

              $val = ($userInfo['puntualita_acquirente'] + $userInfo['serieta_acquirente']) / 2;

              if ($item['immagine']) {
                $path = $item['immagine'];
              } else {
                $path = 'na.png';
              }

              echo '<div>
              <div class="row">
                <div class="col-md-3">
                  <img src="ads_images/' . $path . '" alt="ads_image" style="height: 80px; width: 80px; object-fit: cover;" />
                </div>
                <div class="col-md-7">
                  <label style="margin-left:10px">' . mb_strimwidth($item['titolo'], 0, 42, '...')  . '</label>
                  <label style="font-size:12px;color: gray; position: absolute;bottom:-11px;margin-left:10px">in ' . $item['sottocategoria'] . '</label>
                </div>
                <div class="col-md-2 price">
                  <p>' . $item['prezzo'] . '€</p>
                </div>
              </div>
              <div class="row m-t-20">
                <div class="col-md-8">
                  <label>da: ' . $userInfo['nome'] . ' ' . $userInfo['cognome'] . '</label>
                </div>
                <div class="col-md-4">
                  <label style="margin-left:15%">Val. <span class="method">' . bcdiv($val, 1, 1)  . '/5</span></label>
                </div>
              </div>
              <div class="row m-t-10 m-b-30">
                <div class="col-md-2">
                  <label>Prezzo: <span class="price">' . $item['somma'] . '€</span></label>
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                  <label>Metodo: <span class="method">' . $item['metodo'] . '</span></label>
                </div>
                <div class="col-md-4">
                  <label>Stato: <span class="method">' . $item['stato'] . '</span></label>
                </div>
                </div>';
              if ($item['stato'] == 'Proposta') {
                echo '<div class="row">
                <div class="col-md-6 price">
                  <center>
                    <button onclick="acceptOffer(' . $item['id'] . ',' . $item['prodotto'] . ')" class="flex-c-m stext-101 cl0 bg1 bor1 hov-btn2 trans-04" style="width: 90px;height: 35px;">
                      accetta
                    </button>
                  </center>
                </div>
                <div class="col-md-6 price">
                  <center>
                    <button onclick="quitOffer(' . $item['id'] . ')"class="flex-c-m stext-101 cl0 bg1 bor1 hov-btn2 trans-04" style="width: 90px;height: 35px;">
                      rifiuta
                    </button>
                  </center>
                </div>
              </div>';
              } else if ($item['stato'] == 'Accettata') {

                if ($item['puntualita_acquirente'] != null && $item['serieta_acquirente'] != null) {
                  echo "<div class='row'>
                  <div class='col-md-12 price'>
                    <center>
                    <label><span style='font-size:13px' class='method'>Hai gia valutato l'acquirente:</span></label>
                    <label><span style='font-size:13px' class='method'>Serietà: " . $item['serieta_acquirente'] . "/5 ,  Puntualità: " . $item['puntualita_acquirente'] . "/5</span></label>
                    </center>
                  </div>
                </div>";
                } else {
                  echo '<div class="col-md-12 price">
                <center>
                  <button class="flex-c-m stext-101 cl0 bg1 bor1 hov-btn2 trans-04" style="width: 170px;height: 35px;" data-toggle="modal" data-target="#rateModal" onclick="rateBuyer(' . $item['id'] . ')">
                    Valuta acquirente
                  </button>
                </center>
              </div>';
                }
              } else if ($item['stato'] == 'Rifiutata') {
                echo '<div class="row">
                <div class="col-md-12 price">
                  <center>
                  <label><span style="font-size:13px" class="method">Hai rifiutato questa offerta.</span></label>
                  </center>
                </div>
              </div>';
              }

              echo '<ul class="nav nav-tabs m-t-30 m-b-40">
              </ul>
            </div>';
            }
          } else {
            echo '<div class="row m-b-30">				
      					<div class="col-md-12 p-r-30" style="height:80px;overflow:hidden;">
      						<label>Non ci sono proposte per i tuoi annunci.</label>
      					</div>
      				</div>';
          }
          ?>
        </div>

        <div class="tab-pane fade" id="sent" role="tabpanel" aria-labelledby="sent-tab">
          <?php
          $sent = getSentOffers($conn, $userId);

          if ($sent->num_rows > 0) {
            while ($item = $sent->fetch_assoc()) {

              $buyer = $item['acquirente'];

              $userInfo = getProfile($conn, $buyer);

              $val = ($userInfo['puntualita_acquirente'] + $userInfo['serieta_acquirente']) / 2;

              if ($item['immagine']) {
                $path = $item['immagine'];
              } else {
                $path = 'na.png';
              }

              echo '<div>
          <div class="row">
            <div class="col-md-3">
              <img src="ads_images/' . $path . '" alt="profile_image" style="height: 80px; width: 80px; object-fit: cover;" />
            </div>
            <div class="col-md-7">
              <label style="margin-left:10px">' . mb_strimwidth($item['titolo'], 0, 42, '...')  . '</label>
              <label style="font-size:12px;color: gray; position: absolute;bottom:-11px;margin-left:10px">in ' . $item['sottocategoria'] . '</label>
            </div>
            <div class="col-md-2 price">
              <p>' . $item['prezzo'] . '€</p>
            </div>
          </div>
          <div class="row m-t-20 m-b-20">
            <div class="col-md-2">
              <label>Prezzo: <span class="price">' . $item['somma'] . '€</span></label>
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-4">
              <label>Metodo: <span class="method">' . $item['metodo'] . '</span></label>
            </div>
            <div class="col-md-4">
              <label>Stato: <span class="method">' . $item['stato'] . '</span></label>
            </div>
          </div>';

              if ($item['stato'] == 'Proposta') {
                echo '<div class="row">
                  <div class="col-md-12 price">
                    <center>
                    <label><span style="font-size:13px" class="method">Attendi che il venditore accetti o rifiuti la proposta...</span></label>
                    </center>
                  </div>
                </div>';
              } else if ($item['stato'] == 'Accettata') {

                if ($item['puntualita_venditore'] != null && $item['serieta_venditore'] != null) {
                  echo "<div class='row'>
                  <div class='col-md-12 price'>
                    <center>
                    <label><span style='font-size:13px' class='method'>Hai gia valutato il venditore:</span></label>
                    <label><span style='font-size:13px' class='method'>Serietà: " . $item['serieta_venditore'] . "/5 ,  Puntualità: " . $item['puntualita_venditore'] . "/5</span></label>
                    </center>
                  </div>
                </div>";
                } else {
                  echo '<div class="col-md-12 price">
                  <center>
                    <button class="flex-c-m stext-101 cl0 bg1 bor1 hov-btn2 trans-04" style="width: 170px;height: 35px;" data-toggle="modal" data-target="#rateModal" onclick="rateSeller(' . $item['id'] . ')">
                      Valuta venditore
                    </button>
                  </center>
                </div>';
                }
              } else if ($item['stato'] == 'Rifiutata') {
                echo '<div class="row">
                <div class="col-md-12 price">
                  <center>
                  <label><span style="font-size:13px" class="method">Il venditore ha rifiutato la tua offerta</span></label>
                  </center>
                </div>
              </div>';
              }

              echo '<ul class="nav nav-tabs m-t-30 m-b-40">
                </ul>
              </div>';
            }
          } else {
            echo '<div class="row m-b-30">				
      					<div class="col-md-12 p-r-30" style="height:80px;overflow:hidden;">
      						<label>Non hai inviato proposte per annunci.</label>
      					</div>
      				</div>';
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <?php
  require_once './components/ratingModal.php';
  ?>
</aside>