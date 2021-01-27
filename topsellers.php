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

	<section class="bg0 p-t-23 p-b-130 m-t-125">
		<div class="container" style="min-height:550px">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">Top Venditori</h3>
			</div>

			<div>
				<h5 class="p-tb-20">
					In questa sezione puoi trovare i venditori top della piattaforma,
					ovvero coloro che hanno ottenuto valutazioni elevate e che hanno
					effettuato il maggior numero di vendite nell'ultimo mese!
				</h5>
			</div>

			<div class="row isotope-grid p-t-50">

				<?php
				require_once 'api/profile_functions.php';
			
				$result = fetchTopSellers($conn);

				if ($result->num_rows > 0) {

					while ($row = $result->fetch_assoc()) {

						if ($row["immagine"]) {
							$path = $row["immagine"];
						} else {
							$path = "avatar.png";
						}

						echo
							'<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
            		<div class="block2">
									<div class="block2-pic hov-img0">
										
										<img src="profile_images/' . $path . '"  />
			
										<a href="profileInfo.php?userid=' . $row["id_utente"] . '" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
											Mostra
										</a>
									</div>
  
									<div class="block2-txt flex-w flex-t p-t-14">
										<div class="block2-txt-child1 flex-col-l">
											<a href="profileInfo.php?userid=' . $row["id_utente"] . '" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
												' . $row["nome"] . ' ' . $row["cognome"] . '
											</a>
			
											<span class="stext-105 cl3">
											Annunci Venduti: ' . $row["numero_vendite"] . '
											
											</span>
										</div>
			
										<div class="block2-txt-child2 flex-r p-t-3 font16">
											' .  bcdiv($row["media_valutazioni"], 1, 1) . '/5' . '
										</div>
              		</div>
            		</div>
          		</div>';
					}
				} else {
					echo
						'<h6 class="p-l-15">
							Al momento non ci sono informazioni riguardo ai venditori. Torna più tardi.
						</h6>';
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