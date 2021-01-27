<!DOCTYPE html>
<html lang="it">

<head>
  <title>Home</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <?php
  require_once 'components/imports.php';
  require_once 'components/header.php';
  ?>
</head>

<body class="animsition" id="body">
  <?php
  require_once 'components/sidebar.php';
  ?>

  <!-- Slider -->
  <section class="section-slide">
    <div class="wrap-slick1 rs2-slick1">
      <div class="slick1">
        <div class="item-slick1 bg-overlay1" style="background-image: url(images/slide-05.jpg)" data-thumb="images/thumb-01.jpg" data-caption="Pubblica">
          <div class="container h-full">
            <div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
              <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                <span class="ltext-202 txt-center cl0 respon2">
                  In questa piattaforma puoi
                </span>
              </div>

              <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                <h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
                  Pubblicare i tuoi annunci
                </h2>
              </div>

              <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                <a href="register.php" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                  registrati
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="item-slick1 bg-overlay1" style="background-image: url(images/slide-06.jpg)" data-thumb="images/thumb-02.jpg" data-caption="Fai offerte">
          <div class="container h-full">
            <div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
              <div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
                <span class="ltext-202 txt-center cl0 respon2">
                  puoi anche
                </span>
              </div>

              <div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
                <h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
                  fare offerte e...
                </h2>
              </div>
            </div>
          </div>
        </div>

        <div class="item-slick1 bg-overlay1" style="background-image: url(images/slide-07.jpg)" data-thumb="images/thumb-03.jpg" data-caption="Concludi affari">
          <div class="container h-full">
            <div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
              <div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
                <span class="ltext-202 txt-center cl0 respon2">
                  ..infine
                </span>
              </div>

              <div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
                <h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
                  concludere affari con molta facilità
                </h2>
              </div>

              <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                <a href="showcase.php" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                  iniziamo
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="wrap-slick1-dots p-lr-10"></div>
    </div>
  </section>

  <!-- Banner -->
  <div class="sec-banner bg0 p-t-95 p-b-55">
    <div class="container">

      <div class="p-b-10 m-b-40">
        <h3 class="ltext-103 cl5">Le nostre categorie</h3>
      </div>

      <div class="row">
        <div class="col-md-6 p-b-30 m-lr-auto">
          <!-- Block1 -->
          <div class="block1 wrap-pic-w">
            <img src="images/banner-04.jpg" alt="IMG-BANNER" />

            <a href="showcase.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
              <div class="block1-txt-child1 flex-col-l">
                <span class="block1-name ltext-102 trans-04 p-b-8">
                  Abbigliamento
                </span>

                <span class="block1-info stext-102 trans-04">
                  Accessori
                </span>
                <span class="block1-info stext-102 trans-04">
                  Borse
                </span>
                <span class="block1-info stext-102 trans-04">
                  Scarpe
                </span>
                <span class="block1-info stext-102 trans-04">
                  Vestiti
                </span>
              </div>

              <div class="block1-txt-child2 p-b-4 trans-05">
                <div class="block1-link stext-101 cl0 trans-09">Visita annunci</div>
              </div>
            </a>
          </div>
        </div>

        <div class="col-md-6 p-b-30 m-lr-auto">
          <!-- Block1 -->
          <div class="block1 wrap-pic-w">
            <img src="images/elettrodomestici.png" alt="IMG-BANNER" style="height:100%" />

            <a href="showcase.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
              <div class="block1-txt-child1 flex-col-l">
                <span class="block1-name ltext-102 trans-04 p-b-8">
                  Elettrodomestici
                </span>

                <span class="block1-info stext-102 trans-04">
                  Aspirapolveri
                </span>
                <span class="block1-info stext-102 trans-04">
                  Caffettiere
                </span>
                <span class="block1-info stext-102 trans-04">
                  Frullatori
                </span>
                <span class="block1-info stext-102 trans-04">
                  Tostapane
                </span>
              </div>

              <div class="block1-txt-child2 p-b-4 trans-05">
                <div class="block1-link stext-101 cl0 trans-09">Visita annunci</div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-md-6 p-b-30 m-lr-auto">
          <!-- Block1 -->
          <div class="block1 wrap-pic-w">
            <img src="images/foto_video.jpg" alt="IMG-BANNER" />

            <a href="showcase.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
              <div class="block1-txt-child1 flex-col-l">
                <span class="block1-name ltext-102 trans-04 p-b-8">
                  Foto e video
                </span>

                <span class="block1-info stext-102 trans-04">
                  Accessori
                </span>
                <span class="block1-info stext-102 trans-04">
                  Macchine fotografiche
                </span>
                <span class="block1-info stext-102 trans-04">
                  Microfoni
                </span>
                <span class="block1-info stext-102 trans-04">
                  Telecamere
                </span>
              </div>

              <div class="block1-txt-child2 p-b-4 trans-05">
                <div class="block1-link stext-101 cl0 trans-09">Visita annunci</div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-md-6 p-b-30 m-lr-auto">
          <!-- Block1 -->
          <div class="block1 wrap-pic-w">
            <img src="images/hobby.jpg" alt="IMG-BANNER" />

            <a href="showcase.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
              <div class="block1-txt-child1 flex-col-l">
                <span class="block1-name ltext-102 trans-04 p-b-8">
                  Hobby
                </span>

                <span class="block1-info stext-102 trans-04">
                  Film e DVD
                </span>
                <span class="block1-info stext-102 trans-04">
                  Giocattoli
                </span>
                <span class="block1-info stext-102 trans-04">
                  Libri e riviste
                </span>
                <span class="block1-info stext-102 trans-04">
                  Musica
                </span>
              </div>

              <div class="block1-txt-child2 p-b-4 trans-05">
                <div class="block1-link stext-101 cl0 trans-09">Visita annunci</div>
              </div>
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>

  <?php
  require_once 'components/footer.php';
  require_once 'components/scripts.php';
  ?>

  <script>
    if ("<?php echo $_REQUEST['connectionError'] ?? '' ?>") {
      swal('Attenzione', "C'è stato un errore nella connessione al database. Ritorna più tardi", "warning");
    }
    if ("<?php echo $_REQUEST['unauthorized'] ?? '' ?>") {
      swal('Errore', "Non sei autorizzato ad effettuare questa operazione", "error");
    }
    if ("<?php echo $_REQUEST['deleteUserStatus'] ?? ''?>") {
      swal('Successo', "Utente eliminato con successo", "success");
    }
  </script>

</body>

</html>