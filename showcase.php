<!DOCTYPE html>
<html lang="it">

<head>
	<title>Vetrina</title>
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

	<!-- Ads -->
	<section class="bg0 p-t-23 p-b-130 m-t-125">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">Annunci</h3>
			</div>

			<div>
				<h5 class="p-tb-20">
					In questa sezione trovi tutti gli annunci a tua disposizione! Filtra o cerca gli annunci a tuo piacimento!
				</h5>
			</div>

			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						Tutti
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".Abbigliamento">
						Abbigliamento
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".Elettrodomestici">
						Elettrodomestici
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".Foto">
						Foto e video
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".Hobby">
						Hobby
					</button>
				</div>

				<div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter" style="padding-left:10px;padding-right:10px">
						<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
						<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Sottocategorie
					</div>

					<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search" onclick="" id="zone_filter">
						<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
						<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Zona
					</div>
				</div>


				<?php
				require_once 'components/zoneFilterComponent.php';
				require_once 'components/filterComponent.php';
				?>
			</div>

			<div class="row isotope-grid" style="min-height:340px">
				<?php
				require_once 'api/ads_functions.php';

				$result = getAds($conn);

				if ($result->num_rows > 0) {

					while ($item = $result->fetch_assoc()) {

						// code for skipping private ads, visible only to their publisher


						if (isset($_SESSION['userID'])) {
							if ($item['visibilita'] == 'Privata' && $item['venditore'] !== $_SESSION['userID']) {
								continue;
							}
							// code for skipping restricted ads, visible only to those user whose address in the restriction method given by the publisher
							if ($item['provincia_visibilita']) {
								$restriction = $item['provincia_visibilita'];
								$user = $_SESSION['provincia'];
							} else if ($item['regione_visibilita']) {
								$restriction = $item['regione_visibilita'];
								$user = $_SESSION['regione'];
							} else if ($item['citta_visibilita']) {
								$restriction = $item['citta_visibilita'];
								$user = $_SESSION['città'];
							}

							if ($item['visibilita'] == 'Ristretta' && $restriction !== $user) {
								continue;
							}
						} else {
							if ($item['visibilita'] == 'Privata' || $item['visibilita'] == 'Ristretta') {
								continue;
							}
						}


						if ($item["immagine"]) {
							$path = $item["immagine"];
						} else {
							$path = "na.png";
						}

						if ($item["categoria"] != 'Foto e video') {
							$category = $item["categoria"];
						} else {
							$category = 'Foto';
						}

						if ($item["sottocategoria"] == 'Altro' || $item["sottocategoria"] == 'Accessori') {
							$subcategory = $item["sottocategoria"] . $item["categoria"];
						} else {
							$subcategory = $item["sottocategoria"];
						}

						$id = $item['id_annuncio'];

						if (isset($_SESSION['logged_in'])) {
							$observe = observeAd($conn, $userId, $id);
						} else {
							$observe = false;
						}

						$addedClass = $observe ? 'js-addedwish-b2' : '';


						echo
						'<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item ' . $category . ' ' . $subcategory . ' ' . str_replace(" ", "-", $item["provincia"]) . ' ' . $item["regione"] . ' ">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-pic hov-img0">
									<img src="ads_images/' .  $path . '"/>
		
									<a href="adInfo.php?adId=' . $item['id_annuncio'] . '" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
										Dettagli
									</a>
								</div>
		
								<div class="block2-txt flex-w flex-t p-t-14">
									<div class="block2-txt-child1 flex-col-l">
										<a href="adInfo.php?adId=' . $item['id_annuncio'] . '" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6" style="height:55px">
											' . $item["titolo"] . '
										</a>
		
										<span class="stext-105 cl3"> ' . $item['citta'] . ', ' . $item['provincia'] . ' </span>
										<span class="stext-105 cl3"> ' . $item['prezzo'] . '€ </span>
									</div>
		
									<div class="block2-txt-child2 flex-r p-t-3" style="position:absolute;bottom:40px;left:86%">
										<span class="stext-105 cl3" style="margin-right:3px;font-size:14px">' . $item['num_osservatori'] . '</span>
										<button class="btn-addwish-b2 dis-block pos-relative js-addwish-b2 ' . $addedClass . '" onclick="observeHandler(this, false, false)" id=' . $item['id_annuncio'] . '>
											<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON" />
											<img class="icon-heart2 dis-block trans-04 ab-t-l" style="margin-top:2px;" src="images/icons/icon-heart-02.png" alt="ICON" />
										</button>
									</div>
								</div>
							</div>
						</div>';
					}
				} else {
					echo
					'<h6 class="p-l-15">
							Al momento non ci sono annunci disponibili.
						</h6>';
				}

				?>
				<h6 hidden class="p-l-15" id="noResults">
					Nessun annuncio rispecchia la tua ricerca.
				</h6>


				<!-- Pagination 
				<div class="flex-c-m flex-w w-full p-t-38">
					<a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
						1
					</a>

					<a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7"> 2 </a>
				</div> -->
			</div>
	</section>

	<?php
	require_once 'components/footer.php';
	require_once 'components/scripts.php';
	?>

</body>

</html>
<script>
	if ("<?php echo $_REQUEST['deletesuccessful'] ?? '' ?>") {
		swal('Successo', "annuncio eliminato con successo", "success");
	}

	const fullfilRegions = () => {
		$.ajax({
			type: 'POST',
			url: 'api/geographical_ajax_calls.php',
			data: {
				regions: true
			},
			success: (response) => {
				var select = document.getElementById('filter_region');

				select.innerHTML = '<option disabled selected value="default">Scegli...</option>';

				for (i = 0; i < response.length; i++) {
					select.insertAdjacentHTML('beforeend', "<option>" + response[i].regione + "</option>");
				}
			},
			error: ({
				responseJSON
			}) => {
				console.log(responseJSON)
			}
		});
	}

	const fullfilProvinces = () => {
		$.ajax({
			type: 'POST',
			url: 'api/geographical_ajax_calls.php',
			data: {
				provinces: true
			},
			success: (response) => {
				var select = document.getElementById('filter_province');

				select.innerHTML = '<option disabled selected value="default">Scegli...</option>';

				for (i = 0; i < response.length; i++) {
					select.insertAdjacentHTML('beforeend', "<option>" + response[i].provincia + "</option>");
				}
			},
			error: (
				responseJSON
			) => {
				console.log(responseJSON)
			}
		})
	}

	document.getElementById('zone_filter').addEventListener('click', () => {
		if (document.getElementById('zone_filter').classList.contains('show-search')) {
			fullfilRegions();
			fullfilProvinces();
		}
	})

	var $topeContainer = $(".isotope-grid");
	var $filter = $(".filter-tope-group");

	const changeZoneFilter = (select, region) => {
		var value = select.value;

		if (region) {
			fullfilProvinces()
		} else {
			fullfilRegions()
		}

		$topeContainer.isotope({
			filter: '.' + value.split(" ").join("-")
		});

		setNoResults();
	}

	const setNoResults = () => {
		if (!$topeContainer.data("isotope").filteredItems.length) {
			$("#noResults").removeAttr("hidden");
		} else {
			$("#noResults").attr("hidden", true);
		}
	}

	// filter items on button click
	$filter.each(function() {
		$filter.on("click", "button", function() {
			var filterValue = $(this).attr("data-filter");
			$topeContainer.isotope({
				filter: filterValue
			});

			setNoResults();
		});
	});

	var isotopeButton = $(".filter-tope-group button");

	$(isotopeButton).each(function() {
		$(this).on("click", function() {
			for (var i = 0; i < isotopeButton.length; i++) {
				$(isotopeButton[i]).removeClass("how-active1");
			}

			$(this).addClass("how-active1");
		});
	});
</script>