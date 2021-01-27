<!DOCTYPE html>
<html lang="it">

<head>
	<title>Profilo</title>
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

	.profile-tab p {
		font-weight: 600;
		color: #0062cc;
	}
</style>

<body class="animsition" id="body">

	<?php
	require_once 'components/sidebar.php';
	?>

	<section class="bg0 p-t-23 p-b-50 m-t-125">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">Informazioni Utente</h3>
			</div>
			<?php
			require_once 'api/profile_functions.php';
			if (!isset($_REQUEST["userid"])) {
				header('./index.php');
			}

			$result = getProfile($conn, $_REQUEST["userid"]);

			if ($result['percorso_immagine']) {
				$path = $result['percorso_immagine'];
			} else {
				$path = 'avatar.png';
			}
			?>
			<div class="row m-t-60">
				<div class="col-md-4">
					<div class="profile-img">
						<img src="profile_images/<?php echo $path ?>" alt="profile_image" />
					</div>
				</div>
				<div class="col-md-6">
					<div class="profile-head">
						<h4 class="m-b-5" style="margin-top:1%">
							<?php echo $result['nome'] . " " . $result['cognome'] ?>
						</h4>
						<h6>
							<?php
							if ($result['ruolo'] == 'a') {
								echo 'Acquirente';
							} else if ($result['ruolo'] == 'v') {
								echo 'Venditore';
							} else {
								echo 'Venditore e Acquirente';
							}
							?>
						</h6>
						<p class="proile-rating" style="margin-top: 8%;">PUNTUALITÁ ACQUIRENTE : <span class="m-l-10">
								<?php
								if ($result["puntualita_acquirente"]) {
									echo bcdiv($result["puntualita_acquirente"], 1, 1) . '/5';
								} else {
									echo 'Non ci sono valutazioni';
								}
								?></span></p>
						<p class="proile-rating m-t-10">SERIETÁ ACQUIRENTE : <span class="m-l-10">
								<?php
								if ($result["serieta_acquirente"]) {
									echo bcdiv($result["serieta_acquirente"], 1, 1) . '/5';
								} else {
									echo 'Non ci sono valutazioni';
								}
								?></span> </p>
						<p class="proile-rating m-t-10">PUNTUALITÁ VENDITORE : <span class="m-l-10">
								<?php
								if ($result["puntualita_venditore"]) {
									echo bcdiv($result["puntualita_venditore"], 1, 1) . '/5';
								} else {
									echo 'Non ci sono valutazioni';
								}
								?></span> </p>
						<p class="proile-rating m-t-10">SERIETÁ VENDITORE : <span class="m-l-10">
								<?php
								if ($result["serieta_venditore"]) {
									echo bcdiv($result["serieta_venditore"], 1, 1) . '/5';
								} else {
									echo 'Non ci sono valutazioni';
								}
								?></span> </p>
						<p class="proile-rating m-t-10 m-b-40">VALUTAZIONI : <span class="m-l-10">
								<?php
								if ($result["num_valutazioni"]) {
									echo bcdiv($result["num_valutazioni"], 1, 0);
								} else {
									echo 'Non ci sono valutazioni';
								}
								?></span> </p>
						<p class="proile-rating m-b-10" style="font-size:14px;">
							ANNUNCI :
						</p>
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Venduti</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Acquistati</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="published-tab" data-toggle="tab" href="#published" role="tab" aria-controls="published" aria-selected="false">Pubblicati</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="watchlist-tab" data-toggle="tab" href="#watchlist" role="tab" aria-controls="watchlist" aria-selected="false">Osservati</a>
							</li>
						</ul>
					</div>
				</div>
				<?php
				if (isset($_SESSION['userID']) && $_SESSION['userID'] == $_REQUEST['userid']) {
					echo '<div class="row">
					<button style="margin-left:-2%" type="button" id="modal_button" class="flex-c-m stext-101 cl0 size-126 bg1 bor1 hov-btn4 p-lr-15 trans-04" data-toggle="modal" data-target="#exampleModal">
  					Modifica
					</button>
					<button
					class="flex-c-m stext-101 cl0 size-126 bg1 bor1 m-l-25" style="background-color:red; color: white;pointer: cursor;" data-toggle="modal" data-target="#deleteModal">
					Elimina
					</button>
				</div>';
				}
				?>
			</div>
			<div class="row">
				<div class="col-md-4" style="margin-top:1%">
					<div class="profile-work">
						<div class="row m-l-4" style="margin-top: -50%">
							<img src="images/icons/location-pointer.png" alt="ICON" style="width: 25px; height: 25px; margin-top: 29px" />
							<p class="proile-rating m-l-10"><?php echo $result['citta_residenza'] . ', ' . $result['provincia_residenza'] ?><span class="m-l-10"></span> </p>
						</div>
					</div>
					<div class="profile-work">
						<div class="row m-l-4" style="margin-top: -60%">
							<img src="images/icons/icon-email.png" alt="ICON" style="width: 25px; height: 20px; margin-top: 34px" />
							<p class="proile-rating m-l-10"><?php echo $result['email'] ?><span class="m-l-10"></span> </p>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="tab-content profile-tab" id="myTabContent">
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style="height: auto; min-height: 50px;max-height:250px;overflow:scroll; padding-right:15px;">
							<?php
							require_once 'api/ads_functions.php';

							$soldAds = getSoldAds($conn, $_REQUEST['userid']);

							if ($soldAds->num_rows > 0) {
								while ($item = $soldAds->fetch_assoc()) {
									if ($item['immagine']) {
										$path = $item['immagine'];
									} else {
										$path = 'na.png';
									}
									echo '<div class="row m-b-30">
									<div class="col-md-2" >
									<a href="adInfo.php?adId=' . $item['id_annuncio'] . '"> 
									<img src="ads_images/' . $path . '" alt="profile_image" style="height: 80px; width: 80px; object-fit:cover"/>
									</a>
									</div>
									<div class="col-md-6 p-r-30" style="height:80px;overflow:hidden;">
										<label style="margin-top:-5px">' . $item['titolo'] . '</label>
										<label style="font-size:12px;color: gray; position: absolute;bottom:-10px">' . $item['categoria'] . ' - ' . $item['sottocategoria'] . '</label>
									</div>
									<div class="col-md-4">
										<p>' . $item['prezzo'] . '€</p>
									</div>
								</div>';
								}
							} else {
								echo '<div class="row m-b-30">				
									<div class="col-md-6 p-r-30" style="height:80px;overflow:hidden;">
										<label>Nessun annuncio venduto</label>
									</div>
								</div>';
							}
							?>
						</div>
						<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="height: auto; min-height: 50px;max-height:250px;overflow:scroll; padding-right:15px;">
							<?php
							$boughtAds = getBoughtAds($conn, $_REQUEST['userid']);

							if ($boughtAds->num_rows > 0) {
								while ($item = $boughtAds->fetch_assoc()) {
									if ($item['immagine']) {
										$path = $item['immagine'];
									} else {
										$path = 'na.png';
									}
									echo '<div class="row m-b-30">
									<div class="col-md-2" >
									<a href="adInfo.php?adId=' . $item['id_annuncio'] . '"> 
									<img src="ads_images/' . $path . '" alt="profile_image" style="height: 80px; width: 80px; object-fit:cover"/>
									</a>
									</div>
									<div class="col-md-6 p-r-30" style="height:80px;overflow:hidden;">
										<label style="margin-top:-5px">' . $item['titolo'] . '</label>
										<label style="font-size:12px;color: gray; position: absolute;bottom:-10px">' . $item['categoria'] . ' - ' . $item['sottocategoria'] . '</label>
									</div>
									<div class="col-md-4">
										<p>' . $item['prezzo'] . '€</p>
									</div>
								</div>';
								}
							} else {
								echo '<div class="row m-b-30">				
									<div class="col-md-6 p-r-30" style="height:80px;overflow:hidden;">
										<label>Nessun annuncio acquistato</label>
									</div>
								</div>';
							}
							?>
						</div>
						<div class="tab-pane fade" id="published" role="tabpanel" aria-labelledby="published-tab" style="height: auto; min-height: 50px;max-height:250px;overflow:scroll; padding-right:15px;">
							<?php
							$resultMyAds = getMyAds($conn, $_REQUEST['userid']);

							if ($resultMyAds->num_rows > 0) {
								while ($item = $resultMyAds->fetch_assoc()) {
									if ($item['immagine']) {
										$path = $item['immagine'];
									} else {
										$path = 'na.png';
									}
									echo '<div class="row m-b-30">
									<div class="col-md-2" >
									<a href="adInfo.php?adId=' . $item['id_annuncio'] . '"> 
									<img src="ads_images/' . $path . '" alt="profile_image" style="height: 80px; width: 80px; object-fit:cover"/>
									</a>
									</div>
									<div class="col-md-6 p-r-30" style="height:80px;overflow:hidden;">
										<label style="margin-top:-5px">' . $item['titolo'] . '</label>
										<label style="font-size:12px;color: gray; position: absolute;bottom:-10px">' . $item['categoria'] . ' - ' . $item['sottocategoria'] . '</label>
									</div>
									<div class="col-md-4">
										<p>' . $item['prezzo'] . '€</p>
									</div>
								</div>';
								}
							} else {
								echo '<div class="row m-b-30">				
									<div class="col-md-6 p-r-30" style="height:80px;overflow:hidden;">
										<label>Nessun annuncio pubblicato</label>
									</div>
								</div>';
							}
							?>
						</div>
						<div class="tab-pane fade" id="watchlist" role="tabpanel" aria-labelledby="watchlist-tab" style="height: auto; min-height: 50px;max-height:250px;overflow:scroll; padding-right:15px;">
							<?php
							$resultWatchlist = getMyWatchlist($conn, $_REQUEST['userid']);

							if ($resultWatchlist->num_rows > 0) {
								while ($item = $resultWatchlist->fetch_assoc()) {
									if ($item['immagine']) {
										$path = $item['immagine'];
									} else {
										$path = 'na.png';
									}
									echo '<div class="row m-b-30">
									<div class="col-md-2" >
									<a href="adInfo.php?adId=' . $item['id_annuncio'] . '"> 
									<img src="ads_images/' . $path . '" alt="profile_image" style="height: 80px; width: 80px;object-fit:cover"/>
									</a>
									</div>
									<div class="col-md-6 p-r-30" style="height:80px;overflow:hidden;">
										<label style="margin-top:-5px">' . $item['titolo'] . '</label>
										<label style="font-size:12px;color: gray; position: absolute;bottom:-10px">' . $item['categoria'] . ' - ' . $item['sottocategoria'] . '</label>
									</div>
									<div class="col-md-4">
										<p>' . $item['prezzo'] . '€</p>
									</div>
								</div>';
								}
							} else {
								echo '<div class="row m-b-30">				
									<div class="col-md-6 p-r-30" style="height:80px;overflow:hidden;">
										<label>Nessun annuncio osservato</label>
									</div>
								</div>';
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	require_once 'components/footer.php';
	require_once 'components/scripts.php';
	require_once 'components/changeRoleModal.php';
	require_once 'components/deleteUserModal.php';
	if (isset($_REQUEST['selectionError'])) {
		$error = $_REQUEST['selectionError'];
	}
	?>
	<script>
		if ("<?php echo $error  ?? '' ?>") {
			$('#modal_button').click();
		}
		if ("<?php echo $_REQUEST['updateError'] ?? '' ?>") {
			swal('Error', "Non è stato possibile modificare l'utente. Riprova più tardi", "error");
		}
		if ("<?php echo $_REQUEST['updateSuccessful'] ?? '' ?>") {
			swal('Successo', "Profilo modificato con successo!", "success");
		}
		if ("<?php echo $_REQUEST['deleteUserStatus'] ?? '' ?>" == '0') {
			swal('Error', "Non è stato possibile eliminare l'utente. Riprova più tardi", "error");
		}
	</script>

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

</body>

</html>