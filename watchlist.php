<!DOCTYPE html>
<html lang="it">


<head>
  <title>Top Venditori</title>
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

  <section class="bg0 p-t-23 p-b-80 m-t-125">
    <div class="container">

      <div class="p-b-10">
        <h3 class="ltext-103 cl5">osservati</h3>
      </div>

      <div>
        <h5 class="p-t-20 m-b-20">
          In questa sezione trovi gli annunci che hai aggiunto ai tuoi preferiti!
        </h5>
      </div>

      <div style="height: auto;max-height: 1050px;min-height: 520px;overflow:scroll; padding-top:20px;overflow-x:hidden; margin-bottom:40px">

        <?php
        require_once 'api/ads_functions.php';

        $resultWatchlist = getMyWatchlist($conn, $userId);

        $numRows = $resultWatchlist->num_rows;
        $index = 0;

        if ($resultWatchlist->num_rows > 0) {
          while ($item = $resultWatchlist->fetch_assoc()) {
            $index += 1;
            if ($item['immagine']) {
              $path = $item['immagine'];
            } else {
              $path = 'na.png';
            }

            $date = explode("-", str_split($item['data_inserimento'], 10)[0]);
            $data = $date[2] . '-' . $date[1] . '-' . $date[0];

            echo '<div style="width: 100%">
            <div class="form-row profile-head m-t-60">
              <div class="form-group col-md-3">
                <div class="col-md-5">
                  <img src="ads_images/' . $path . '" alt="ad_image" style="height: 225px; width: 225px;object-fit:cover" />
                </div>
              </div>
  
              <div class="form-group col-md-6">
                <label style="margin-top:-8px;color:black">' . $item['titolo'] . '</label>
                <label style="margin-top:15px; height: 37px;width:80%; color:gray;opacity:0.8">' . $item['descrizione'] . '</label>
                <div class="col-md-6" style="margin-top: 160px; margin-left:-13px">
                  <label style="font-size:12px;color: gray; position: absolute;bottom:50px">Osservatori:  ' . $item['num_osservatori'] . '</label>
                  <label style="font-size:12px;color: gray; position: absolute;bottom:20px">Data di pubblicazione:  ' . $data . '</label>
                  <label style="font-size:12px;color: gray; position: absolute;bottom:-10px"> ' . $item['categoria'] . '  -  ' . $item['sottocategoria'] . '</label>
                </div>
                <div class="col-md-6" style="margin-left: 250px">
                  <label style="font-size:12px;color: gray; position: absolute;bottom:20px">Condizione: ' . $item['condizione_prodotto'] . '</label>
                  <label style="font-size:12px;color: gray; position: absolute;bottom:-10px">Prodotto: ' . $item['nome_prodotto'] . '</label>
                </div>
              </div>
  
              <div class="form-group col-md-2">
                <p style="font-size:18px;color:#0062cc;margin-top:-2px;">' . $item['prezzo'] . '€</p>
              </div>
  
              <div class="form-group col-md-1">
              <a href="adInfo.php?adId=' . $item['id_annuncio'] . '" class="flex-c-m stext-101 cl0 bg1 bor1 hov-btn2 trans-04" style="width: 90px;height: 35px;margin-top:-9px;margin-left:-10px">
                più info
              </a>
                <button style="position:absolute;bottom:0px;right: 15px" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2 js-addedwish-b2" onclick="observeHandler(this, true, false)" id=' . $item['id_annuncio'] . '>
										<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON" />
										<img class="icon-heart2 dis-block trans-04 ab-t-l" style="margin-top:0px;" src="images/icons/icon-heart-02.png" alt="ICON" />
									</button>
              </div>';

            if ($index !== $numRows) {
              echo '<div style="width:100%; height:0.4px; background: #818182; margin-top:40px;"></div>';
            }

            echo '</div>
          </div>';
          }
        } else {
          echo '<div class="row m-b-30">				
            <div class="col-md-6 p-r-30" style="height:80px;overflow:hidden;">
              <label style="font-size:18px">Non stai osservando nessun annuncio...</label>
            </div>
          </div>';
        }
        ?>
      </div>
    </div>
  </section>

  <?php
  require_once 'components/footer.php';
  require_once 'components/scripts.php';
  ?>

</body>

</html>