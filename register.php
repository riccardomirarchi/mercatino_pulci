<!DOCTYPE html>
<html lang="it">

<head>
	<title>Registrati</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php
	require_once 'components/imports.php';
	require_once 'components/header.php';
	?>
	<style>
		.role {
			display: inline-block;
			width: 150px;
			height: 50px;
			text-align: center;
			border: 1px solid #ddd;
			line-height: 50px;
			cursor: pointer;
			border-radius: 8px;
		}

		.role_input:checked+.role {
			background-color: #717fe0;
			color: #fff;
		}
	</style>
</head>

<body class="animsition" id="body">

	<?php
	require_once 'components/sidebar.php';
	$error = 'Questo campo è obbligatorio';
	?>

	<section class="bg0 p-t-23 p-b-20 m-t-125 m-b-70">

		<div class="container">

			<div class="p-b-10">
				<h3 class="ltext-103 cl5">Registrazione</h3>
			</div>

			<div style="height: auto;max-height: 1050px;overflow:scroll; padding-top:20px;overflow-x:hidden">

				<div style="width: 100%" class="products">

					<form method="POST" action="api/profile_synchronous_functions.php?registrationSubmit=1" enctype="multipart/form-data">

						<div class="form-row">

							<div class="col-md-6 form-row">
								<div class="col-md-">
									<img src="profile_images/avatar.png" id="image" alt="image" style="margin-right: 20px; width: 100px; height: 100px; border-radius:50%; border: solid 2px #717fe0;object-fit:cover" />
								</div>

								<div class="col-md-8 m-t-12 m-b-40">
									<p>Scegli un immagine da caricare: (Max: 2MB)</p>

									<input class="m-t-20" type="file" name="image_upload" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])" />
									<p class="m-b-10" style="color:red;"><?php echo $_REQUEST["imageError"] ?? '' ?></p>
								</div>
							</div>

							<div class="form-group col-md-6 m-l-8">
								<label for="Nome">Nome</label>
								<div class="wrap-input1 w-full p-b-4 ">
									<input class="input1 bg-none plh1 stext-107 cl7" name="name" placeholder="Nome" />
									<div class="focus-input1 trans-04"></div>
								</div>
								<p class="m-b-40" style="color:red;">
									<?php if (isset($_REQUEST["nameError"])) {
										echo $error;
									} ?></p>

								<label for="Cognome">Cognome</label>
								<div class="wrap-input1 w-full p-b-4">
									<input class="input1 bg-none plh1 stext-107 cl7" name="surname" placeholder="Cognome" />
									<div class="focus-input1 trans-04"></div>
								</div>
								<p class="m-b-40" style="color:red;">
									<?php if (isset($_REQUEST["surnameError"])) {
										echo $error;
									} ?></p>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="Nome">Codice Fiscale</label>
								<div class="wrap-input1 w-full p-b-4">
									<input class="input1 bg-none plh1 stext-107 cl7" name="CF" placeholder="Codice Fiscale" />
									<div class="focus-input1 trans-04"></div>
								</div>
								<p class="m-b-40" style="color:red;">
									<?php if (isset($_REQUEST["codeError"])) {
										if (isset($_REQUEST['lenerror'])) {
											echo 'Il codice fiscale deve contenere 16 caratteri';
										} else {
											echo $error;
										}
									} ?></p>
							</div>
							<div class="form-group col-md-6">
								<label for="Cognome">E-mail</label>
								<div class="wrap-input1 w-full p-b-4">
									<input class="input1 bg-none plh1 stext-107 cl7" type="email" name="email" placeholder="E-mail" />
									<div class="focus-input1 trans-04"></div>
								</div>
								<p class="m-b-40" style="color:red;">
									<?php if (isset($_REQUEST["emailError"])) {
										echo $error;
									} ?></p>
							</div>
						</div>
						<div class="form-group">
							<label for="Indirizzo">Indirizzo</label>
							<div class="wrap-input1 w-full p-b-4">
								<input class="input1 bg-none plh1 stext-107 cl7" name="address" placeholder="Indirizzo" />
								<div class="focus-input1 trans-04"></div>
							</div>
							<p class="m-b-40" style="color:red;">
								<?php if (isset($_REQUEST["addressError"])) {
									echo $error;
								} ?></p>
						</div>

						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="Regione">Regione</label>
								<div style="width:100%" class="size-204 respon6-next">
									<div class="rs1-select2 bor8 bg0">
										<select class="js-select2" name="region" id="region" onchange="onChangeRegion(this)">
											<option disabled selected>Scegli...</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>
								</div>
								<p class="" style="color:red;">
									<?php if (isset($_REQUEST["regionError"])) {
										echo $error;
									} ?></p>
							</div>
							<div class="form-group col-md-4">
								<label for="Provincia">Provincia</label>
								<div style="width:100%" class="size-204 respon6-next">
									<div class="rs1-select2 bor8 bg0">
										<select class="js-select2" name="province" id="provincia" onchange="onChangeProvince(this)">
											<option disabled selected>Scegli...</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>
								</div>
								<p class="" style="color:red;">
									<?php if (isset($_REQUEST["provinceError"])) {
										echo $error;
									} ?></p>
							</div>
							<div class="form-group col-md-4">
								<label for="Citta">Città</label>
								<div style="width:100%" class="size-204 respon6-next">
									<div class="rs1-select2 bor8 bg0">
										<select class="js-select2" name="city" id="citta">
											<option disabled selected>Scegli...</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>
								</div>
								<p class="" style="color:red;">
									<?php if (isset($_REQUEST["cityError"])) {
										echo $error;
									} ?></p>
							</div>

						</div>
						<p class="error"><?php echo $_REQUEST["errorind"] ?? '' ?></p>


						<hr />
						<center>
							<label>Seleziona la/le tipologia/e di account: (potrai cambiare questa scelta)</label><br>
							<div class="row m-b-30 m-t-10">
								<div class="col-md-6">
									<input type="checkbox" name="venditore" id="venditore" style="display:none;" class="role_input" />

									<label for="small" class="role" onclick="seller()">Venditore</label>
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="acquirente" id="acquirente" style="display:none;" class="role_input" />

									<label for="small" class="role" onclick="buyer()">Acquirente</label>
								</div>
							</div>

							<p class="" style="color:red;">
								<?php if (isset($_REQUEST["roleError"])) {
									echo $error;
								} ?></p>
						</center>
						<hr />

						<div class="form-row m-t-35">
							<div class="form-group col-md-4">
								<label for="Nome">Password</label>
								<div class="wrap-input1 w-full p-b-4">
									<input class="input1 bg-none plh1 stext-107 cl7" type="password" name="password" placeholder="Password" autocomplete="new-password" />
									<div class="focus-input1 trans-04"></div>
								</div>
								<p style="color:red;">
									<?php if (isset($_REQUEST["passwordError"])) {
										echo $error;
									} ?></p>
								<p class="m-b-40" style="color:red;"><?php echo $_REQUEST["matchError"] ?? '' ?></p>
							</div>
							<div class="form-group col-md-4">
								<label for="Cognome">Conferma Password</label>
								<div class="wrap-input1 w-full p-b-4">
									<input class="input1 bg-none plh1 stext-107 cl7" type="password" name="passwordConfirm" placeholder="Conferma Password" autocomplete="new-password" />
									<div class="focus-input1 trans-04"></div>
								</div>
								<p class="m-b-40" style="color:red;">
									<?php if (isset($_REQUEST["confirmError"])) {
										echo $error;
									} ?></p>
							</div>
							<div class="form-group col-md-1">
							</div>
							<div class="form-group col-md-2">
								<input type='submit' class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04" value='REGISTRATI' />
							</div>
							<div class="form-group col-md-1">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>


	<?php
	require_once 'components/footer.php';
	require_once 'components/scripts.php';
	?>

	<script>
		if ("<?php echo $_REQUEST['registrationSuccessful'] ?? '' ?>") {
			swal({
				title: "Successo",
				text: "Registrazione effettuata con successo. Ora procedi con l'autenticazione per usufruire dei servizi!",
				icon: "success"
			}).then(() => {
				$('.js-modal1').addClass('show-modal1');
			});
		} else if ("<?php echo $_REQUEST['registrationError'] ?? '' ?>") {
			swal({
				title: "Errore",
				text: "Non è stato possibile effettuare la registrazione. Riprova più tardi.",
				icon: "error"
			})
		}

		if ("<?php echo $_REQUEST['uploadError'] ?? '' ?>") {
			swal('Errore', "C'è stato un errore nel caricamento della foto", "error");
		}

		if ("<?php echo $_REQUEST['sizeError'] ?? '' ?>") {
			swal('Errore', "La foto selezionata è troppo grande. Dimensione massima: 2MB", "error");
		}

		// fullfil region select field
		$.ajax({
			type: 'POST',
			url: 'api/geographical_ajax_calls.php',
			data: {
				regions: true,
			},
			success: (response) => {
				var select = document.getElementById('region');

				select.innerHTML = '<option disabled selected>Scegli...</option>';

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


		const getProvinces = (region) => {
			$.ajax({
				type: 'POST',
				url: 'api/geographical_ajax_calls.php',
				data: {
					provinces: true,
					region: region,
				},
				success: (response) => {
					var select = document.getElementById('provincia');

					select.innerHTML = "<option disabled selected>Scegli...</option>";

					for (i = 0; i < response.length; i++) {
						select.insertAdjacentHTML('beforeend', "<option>" + response[i].provincia + "</option>");
					}
				},
				error: ({
					responseJSON
				}) => {
					console.log(responseJSON)
				}
			});
		}

		const getCities = (province) => {
			$.ajax({
				type: 'POST',
				url: 'api/geographical_ajax_calls.php',
				data: {
					cities: true,
					province: province,
				},
				success: (response) => {
					var select = document.getElementById('citta');

					select.innerHTML = "<option disabled selected>Scegli...</option>";

					for (i = 0; i < response.length; i++) {
						select.insertAdjacentHTML('beforeend', "<option>" + response[i].comune + "</option>");
					}
				},
				error: ({
					responseJSON
				}) => {
					console.log(responseJSON)
				}
			});
		}

		const onChangeRegion = (select) => {
			var region = select.value;

			document.getElementById('citta').innerHTML = "<option disabled selected>Scegli...</option>";

			getProvinces(region);
		}

		const onChangeProvince = (select) => {
			var province = select.value;

			getCities(province)
		}
	</script>

</body>

</html>