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
        <h3 class="ltext-103 cl5">I TUOI ANNUNCi</h3>
      </div>

      <div>
        <h5 class="p-t-20 m-b-20">
          In questa sezione trovi tutti i tuoi annunci, puoi vederli, eliminarli o riattivarli a tuo piacimento!
        </h5>
      </div>

      <div style="height: auto;max-height: 1050px;min-height:450px;overflow:scroll; padding-top:20px;overflow-x:hidden;margin-bottom:40px">

        <?php
        require_once 'api/ads_functions.php';
        $userId = $_SESSION['userID'];

        $resultMyAds = getMyAds($conn, $userId);

        $numRows = $resultMyAds->num_rows;
        $index = 0;


        if ($resultMyAds->num_rows > 0) {
          while ($item = $resultMyAds->fetch_assoc()) {
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
                  <label style="font-size:12px;color: gray; position: absolute;bottom:80px">Stato:  ' . $item['stato_annuncio'] . '</label>
                  <label style="font-size:12px;color: gray; position: absolute;bottom:50px">Visibilità:  ' . $item['visibilita'] . '</label>
                  <label style="font-size:12px;color: gray; position: absolute;bottom:20px">Data di pubblicazione:  ' . $data . '</label>
                  <label style="font-size:12px;color: gray; position: absolute;bottom:-10px"> ' . $item['categoria'] . '  -  ' . $item['sottocategoria'] . '</label>
                </div>
                <div class="col-md-6" style="margin-left: 250px">
                  <label style="font-size:12px;color: gray; position: absolute;bottom:50px">Osservatori: ' . $item['num_osservatori'] . '</label>
                  <label style="font-size:12px;color: gray; position: absolute;bottom:20px">Condizione: ' . $item['condizione_prodotto'] . '</label>
                  <label style="font-size:12px;color: gray; position: absolute;bottom:-10px">Prodotto: ' . $item['nome_prodotto'] . '</label>
                </div>
              </div>
  
              <div class="form-group col-md-2">
                <p style="font-size:18px;color:#0062cc;margin-top:-2px;">' . $item['prezzo'] . '€</p>
              </div>
  
              <div class="form-group col-md-1">';



            if ($item['stato_annuncio'] == 'In vendita') {
              echo '<button
              class="flex-c-m stext-101 cl0 bg1 bor1" style="background-color:red; color: white;pointer: cursor;width: 90px;height: 35px;margin-top:-9px;margin-left:-10px" data-toggle="modal" data-target="#deleteAd" onclick="updateId(' . $item['id_annuncio'] . ')" 
              >
              Elimina
              </button>';
            } else {
              if ($item['stato_annuncio'] !== 'Venduto') {
                echo '<button class="check_button flex-c-m stext-101 cl0 bg1 bor1 hov-btn2 trans-04" style="width: 90px;height: 35px;margin-top:-9px;margin-left:-10px" data-toggle="modal" data-target="#reactivateAd" id_annuncio="' . $item['id_annuncio'] . '" data="' . $item['data_inserimento'] . '" stato="' . $item['condizione_prodotto'] . '" stato_annuncio="' . $item['stato_annuncio'] . '">
                riattiva
              </button>';
                echo '<button hidden data-toggle="modal" data-target="#reactivateAd" id="' . $item['id_annuncio'] . '"></button>';
              }
            }

            echo '</div>';

            if ($index !== $numRows) {
              echo '<div style="width:100%; height:0.4px; background: #818182; margin-top:40px;"></div>';
            }

            echo '</div>
          </div>';
          }
        } else {
          echo '<div class="row m-b-30">				
          <div class="col-md-6 p-r-30" style="height:80px;overflow:hidden;">
            <label style="font-size:18px">Non hai pubblicato nessun annuncio...</label>
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
  require_once 'components/deleteAdModal.php';
  require_once 'components/reactivateAdModal.php';
  ?>

  <script>
    var elements = document.getElementsByClassName("check_button");

    for (var i = 0; i < elements.length; i++) {
      elements[i].addEventListener('click', (event) => {
        event.stopImmediatePropagation();

        var id = event.target.getAttribute("id_annuncio");
        var data = event.target.getAttribute("data").split(' ')[0].split('-');
        var status = event.target.getAttribute("stato");
        var adStatus = event.target.getAttribute("stato_annuncio");

        if (adStatus == 'Venduto') {
          swal('Attenzione', "Non è possibile riattivare un annuncio venduto!", "warning");
          return;
        }

        if (status == 'Usato') {
          var date = new Date();
          // code for handling when a used product cannot be reactivated
          const today = new Date(date.getFullYear(), date.getMonth(), date.getDate()) // this is only for getting rid of hours minutes etc..
          const insertDate = new Date(data[0], data[1] - 1, data[2])

          if (today - insertDate >= 259200000) {
            swal('Attenzione', "Non è possibile riattivare un annuncio relativo a un prodotto usato dopo 3 giorni dalla sua pubblicazione!", "warning");
            return;
          }
        }

        // if reactivation is allowed prompt the user to do it
        updateId(id)
        document.getElementById(id.toString()).click()

      });
    }

    const updateId = (id) => {
      document.getElementById('product').value = id;
    }

    const handleReactivate = () => {
      const adId = document.getElementById('product').value;

      $.ajax({
        type: 'POST',
        url: 'api/ads_ajax_calls.php',
        data: {
          reactivate: true,
          adId: adId,
        },
        success: (data) => {
          window.location.replace('./myAds.php?reactivationsuccessful=1');
        },
        error: ({
          responseJSON
        }) => {
          swal('Errore', "C'è stato un errore nella riattivazione. Riprova più tardi", "error");
          console.log(responseJSON)
        }
      });
    }
  </script>

</body>

</html>