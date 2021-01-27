<!DOCTYPE html>
<html lang="it">

<head>
	<title>Inserimento Annuncio</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php
	session_start();
	if (isset($_SESSION['logged_in'])) {
		if ($_SESSION["ruolo"] == 'a') {
			header('Location: index.php?unauthorized=1');
		}
	} else {
		header('Location: index.php?unauthorized=1');
	}
	require_once 'components/imports.php';
	$from = 'insert';
	require_once 'components/header.php';
	?>
</head>


<body class="animsition" id="body">

	<?php
	require_once 'components/sidebar.php';
	$error = 'Questo campo è obbligatorio';
	?>

	<section class="bg0 p-t-23 p-b-20 m-t-125 m-b-70">

		<div class="container">

			<div class="p-b-10">
				<h3 class="ltext-103 cl5">INSERISCI ANNUNCIO</h3>
			</div>

			<div style="height: auto;max-height: 1050px;overflow:scroll; padding-top:20px;overflow-x:hidden">

				<form method="POST" action="api/adInsertion.php" enctype="multipart/form-data">
					<div class="form-row">

						<div class="col-md-6 form-row">
							<div class="col-md-">
								<img hidden id="imagePreview" alt="image" style="margin-right: 20px; width: 100px; height: 100px; border-radius:5%; border: solid 2px #717fe0; background-color: lightgray;object-fit:cover;" />
								<div id="uploadPreview" style="margin-right: 20px; width: 100px; height: 100px; border-radius:5%; border: solid 2px #717fe0; background-color: lightgray"></div>
							</div>

							<div class="col-md-8 m-t-12 m-b-40">
								<p>Scegli un immagine da caricare: (Max 2MB)</p>

								<input class="m-t-20" type="file" name="image" id="upload_image" />
								<p class="m-b-10" style="color:red;"><?php echo $_REQUEST["imageError"] ?? '' ?></p>
							</div>
						</div>

						<div class="form-group col-md-6">
							<label>Titolo</label>
							<div class="wrap-input1 w-full p-b-4 ">
								<input class="input1 bg-none plh1 stext-107 cl7" name="title" placeholder="Nome" />
								<div class="focus-input1 trans-04"></div>
							</div>
							<p class="m-b-40" style="color:red;"><?php if (isset($_REQUEST["titleError"])) {
																											echo $error;
																										} ?></p>

							<label for="Cognome">Descrizione</label>
							<div class="wrap-input1 w-full p-b-4">
								<input class="input1 bg-none plh1 stext-107 cl7" name="description" placeholder="Descrizione" />
								<div class="focus-input1 trans-04"></div>
							</div>
							<p class="m-b-50" style="color:red;"><?php if (isset($_REQUEST["descriptionError"])) {
																											echo $error;
																										} ?></p>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-3">
							<label for="Nome">Prezzo</label>
							<div class="wrap-input1 w-full p-b-4">
								<input class="input1 bg-none plh1 stext-107 cl7 m-t-18" type="number" name="price" placeholder="Prezzo" />
								<div class="focus-input1 trans-04"></div>
							</div>
							<p style="color:red;"><?php if (isset($_REQUEST["priceError"])) {
																			echo $error;
																		} ?></p>
						</div>
						<div class="form-group col-md-1">
						</div>
						<div class="form-group col-md-4">
							<label for="Regione">Categoria</label>
							<div style="width:100%" class="size-204 respon6-next">
								<div class="rs1-select2 bor8 bg0">
									<select class="js-select2" name="category" id="category">
										<option disabled selected>Scegli...</option>
										<option>Abbigliamento</option>
										<option>Elettrodomestici</option>
										<option>Foto e video</option>
										<option>Hobby</option>
									</select>
									<div class="dropDownSelect2"></div>
								</div>
								<p style="color:red;"><?php if (isset($_REQUEST["categoryError"])) {
																				echo $error;
																			} ?></p>
							</div>
						</div>
						<div class="form-group col-md-4">
							<label for="Provincia">Sottocategoria</label>
							<div style="width:100%" class="size-204 respon6-next">
								<div class="rs1-select2 bor8 bg0">
									<select class="js-select2" name="subcategory" id="subcategory">
										<option disabled selected>Scegli...</option>
									</select>
									<div class="dropDownSelect2"></div>
								</div>
							</div>
							<p style="color:red;"><?php if (isset($_REQUEST["subcategoryError"])) {
																			echo $error;
																		} ?></p>
						</div>
					</div>

					<hr />
					<div class="m-t-25">
						<label>Zona di pubblicazione:</label><br>
					</div>

					<div class="form-row">
						<div class="form-group col-md-4">
							<label for="Regione">Regione</label>
							<div style="width:100%" class="size-204 respon6-next">
								<div class="rs1-select2 bor8 bg0">
									<select class="js-select2" name="publishing_region" id="publishing_region" onchange="onChangeRegion(this)">
										<option disabled>Scegli...</option>
									</select>
									<div class="dropDownSelect2"></div>
								</div>
							</div>
							<p style="color:red;"><?php if (isset($_REQUEST["publishing_regionError"])) {
																			echo $error;
																		} ?></p>
						</div>
						<div class="form-group col-md-4">
							<label for="Provincia">Provincia</label>
							<div style="width:100%" class="size-204 respon6-next">
								<div class="rs1-select2 bor8 bg0">
									<select class="js-select2" name="publishing_province" id="publishing_province" onchange="onChangeProvince(this)">
										<option disabled>Scegli...</option>
									</select>
									<div class="dropDownSelect2"></div>
								</div>
							</div>
							<p style="color:red;"><?php if (isset($_REQUEST["publishing_provinceError"])) {
																			echo $error;
																		} ?></p>
						</div>
						<div class="form-group col-md-4">
							<label for="Citta">Città</label>
							<div style="width:100%" class="size-204 respon6-next">
								<div class="rs1-select2 bor8 bg0">
									<select class="js-select2" name="publishing_city" id="publishing_city">
										<option disabled>Scegli...</option>
									</select>
									<div class="dropDownSelect2"></div>
								</div>
							</div>
							<p style="color:red;"><?php if (isset($_REQUEST["publishing_cityError"])) {
																			echo $error;
																		} ?></p>
						</div>

					</div>

					<hr />
					<div class="m-t-25">
						<label>Impostazioni di visibilità:</label><br>
					</div>

					<div class="form-row">
						<div class="form-group col-md-4">
							<label for="Regione">Visibilità</label>
							<div style="width:100%" class="size-204 respon6-next">
								<div class="rs1-select2 bor8 bg0">
									<select class="js-select2" name="visibility" id="visibility">
										<option disabled selected>Scegli...</option>
										<option>Pubblica</option>
										<option>Privata</option>
										<option>Ristretta</option>
									</select>
									<div class="dropDownSelect2"></div>
								</div>
							</div>
							<p style="color:red;"><?php if (isset($_REQUEST["visibilityError"])) {
																			echo $error;
																		} ?></p>
						</div>
						<div class="form-group col-md-4">
							<label id="restriction_method_label">Restrizione per: (solo per visibilità ristretta)</label>
							<div style="width:100%" class="size-204 respon6-next">
								<div class="rs1-select2 bor8 bg0">
									<select class="js-select2" name="restriction_method" id="restriction_method">
										<option disabled selected>Scegli...</option>
									</select>
									<div class="dropDownSelect2"></div>
								</div>
							</div>
							<p style="color:red;"><?php if (isset($_REQUEST["restriction_methodError"])) {
																			echo $error;
																		} ?></p>
						</div>
						<div class="form-group col-md-4">
							<label id="restriction_label">Inserisci restrizione: (solo per visibilità ristretta)</label>
							<div style="width:100%" class="size-204 respon6-next">
								<div class="rs1-select2 bor8 bg0">
									<select class="js-select2" name="restriction" id="restriction">
										<option disabled selected>Scegli...</option>
									</select>
									<div class="dropDownSelect2"></div>
								</div>
							</div>
							<p style="color:red;"><?php if (isset($_REQUEST["restrictionError"])) {
																			echo $error;
																		} ?></p>
						</div>
					</div>

					<hr />
					<div class="m-t-25">
						<label>Informazioni sul prodotto:</label><br>
					</div>
					<div class="form-row">
						<div class="form-group col-md-3">
							<label>Nome prodotto</label>
							<div class="wrap-input1 w-full p-b-4 m-t-18">
								<input class="input1 bg-none plh1 stext-107 cl7" name="product_name" placeholder="Nome" />
								<div class="focus-input1 trans-04"></div>
							</div>
							<p style="color:red;"><?php if (isset($_REQUEST["product_nameError"])) {
																			echo $error;
																		} ?></p>
						</div>
						<div class="form-group col-md-3">
							<label>Condizione</label>
							<div style="width:100%" class="size-204 respon6-next">
								<div class="rs1-select2 bor8 bg0">
									<select class="js-select2" name="product_condition" id="product_condition">
										<option disabled selected>Scegli...</option>
										<option>Nuovo</option>
										<option>Usato</option>
									</select>
									<div class="dropDownSelect2"></div>
								</div>
							</div>
							<p style="color:red;"><?php if (isset($_REQUEST["product_conditionError"])) {
																			echo $error;
																		} ?></p>
						</div>
						<div class="form-group col-md-3">
							<label id="warranty_label">Garanzia/Usura</label>
							<div style="width:100%" class="size-204 respon6-next">
								<div class="rs1-select2 bor8 bg0">
									<select class="js-select2" name="warranty" id="warranty">
										<option disabled selected>Scegli...</option>
									</select>
									<div class="dropDownSelect2"></div>
								</div>
								<p style="color:red;"><?php if (isset($_REQUEST["warrantyError"])) {
																				echo $error;
																			} ?></p>
							</div>
						</div>
						<div class="form-group col-md-3">
							<label id="warranty_period">Fine copertura/Inizio utilizzo</label>
							<div style="width:100%" class="size-204 respon6-next">
								<div class="wrap-input1 w-full p-b-4 m-t-18">
									<input class="input1 bg-none plh1 stext-107 cl7" type="date" name="warranty_period" placeholder="Data" />
									<div class="focus-input1 trans-04"></div>
								</div>
								<p style="color:red;"><?php if (isset($_REQUEST["warranty_periodError"])) {
																				echo $error;
																			} ?></p>
							</div>
						</div>
					</div>


					<div class="form-row m-t-60">
						<div class="form-group col-md-5">
						</div>
						<div class="form-group col-md-2">
							<input class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04" type='submit' value="INSERISCI ANNUNCIO" />
						</div>
					</div>
				</form>

			</div>
		</div>
	</section>

	<?php
	require_once 'components/scripts.php';
	require_once 'components/footer.php';
	?>

	<script>
		if ("<?php echo $_REQUEST['insertionerror'] ?? '' ?>") {
			swal('Errore', "Non è stato possibile inserire l'annuncio. Riprova più tardi", "error");
		}

		var region = "<?php echo $_SESSION['regione']  ?? '' ?>"

		// fullfil region field with autoselected value = region of residency of the publisher
		$.ajax({
			type: 'POST',
			url: 'api/geographical_ajax_calls.php',
			data: {
				regions: true,
			},
			success: (response) => {
				var select = document.getElementById('publishing_region');

				select.innerHTML = '';

				for (i = 0; i < response.length; i++) {
					var ifSel = response[i].regione == region ? "selected" : "";
					select.insertAdjacentHTML('beforeend', "<option  " + ifSel + " >" + response[i].regione + "</option>");
				}

			},
			error: ({
				responseJSON
			}) => {
				console.log(responseJSON)
			}
		});

		var provincia = "<?php echo $_SESSION['provincia'] ?? '' ?>"

		const getProvinces = (region) => {
			$.ajax({
				type: 'POST',
				url: 'api/geographical_ajax_calls.php',
				data: {
					provinces: true,
					region: region,
				},
				success: (response) => {
					var select = document.getElementById('publishing_province');

					select.innerHTML = '<option disabled selected>Scegli...</option>';

					for (i = 0; i < response.length; i++) {
						var ifSel = response[i].provincia == provincia ? "selected" : "";
						select.insertAdjacentHTML('beforeend', "<option  " + ifSel + " >" + response[i].provincia + "</option>");
					}

				},
				error: ({
					responseJSON
				}) => {
					console.log(responseJSON)
				}
			});
		}

		getProvinces(region)

		const getCities = (province) => {
			$.ajax({
				type: 'POST',
				url: 'api/geographical_ajax_calls.php',
				data: {
					cities: true,
					province: province,
				},
				success: (response) => {
					var select = document.getElementById('publishing_city');

					var selected = "<?php echo $_SESSION['città'] ?? '' ?>"

					select.innerHTML = '<option disabled selected>Scegli...</option>';

					for (i = 0; i < response.length; i++) {
						var ifSel = response[i].comune == selected ? "selected" : "";
						select.insertAdjacentHTML('beforeend', "<option  " + ifSel + " >" + response[i].comune + "</option>");
					}

				},
				error: ({
					responseJSON
				}) => {
					console.log(responseJSON, 'response')
				}
			});
		}
		getCities(provincia)

		const onChangeRegion = (select) => {
			var region = select.value;

			document.getElementById('publishing_city').innerHTML = "<option disabled selected>Scegli...</option>";

			getProvinces(region);
		}

		const onChangeProvince = (select) => {
			var province = select.value;

			getCities(province)
		}

		if ("<?php echo $_REQUEST['uploadError'] ?? '' ?>") {
			swal('Errore', "C'è stato un errore nel caricamento della foto", "error");
		}

		if ("<?php echo $_REQUEST['sizeError'] ?? '' ?>") {
			swal('Errore', "La foto selezionata è troppo grande. Dimensione massima: 2MB", "error");
		}
	</script>

</body>

</html>