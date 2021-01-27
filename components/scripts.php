<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<script>
	$(".js-select2").each(function() {
		$(this).select2({
			minimumResultsForSearch: 20,
			dropdownParent: $(this).next(".dropDownSelect2"),
		});
	});
</script>
<!--===============================================================================================-->
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="vendor/slick/slick.min.js"></script>
<script src="js/slick-custom.js"></script>
<!--===============================================================================================-->
<script src="vendor/parallax100/parallax100.js"></script>
<script>
	$(".parallax100").parallax100();
</script>
<!--===============================================================================================-->
<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<script>
	$(".gallery-lb").each(function() {
		// the containers for all your galleries
		$(this).magnificPopup({
			delegate: "a", // the selector for gallery item
			type: "image",
			gallery: {
				enabled: true,
			},
			mainClass: "mfp-fade",
		});
	});
</script>
<!--===============================================================================================-->
<script src="vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script>
	$(".js-pscroll").each(function() {
		$(this).css("position", "relative");
		$(this).css("overflow", "hidden");
		var ps = new PerfectScrollbar(this, {
			wheelSpeed: 1,
			scrollingThreshold: 1000,
			wheelPropagation: false,
		});

		$(window).on("resize", function() {
			ps.update();
		});
	});
</script>

<script src="js/main.js"></script>

<!-- from now on it's my own code :) -->

<script>
	// asyncronously updating the status of all ads in the database
	$.ajax({
		type: 'POST',
		url: 'api/ads_ajax_calls.php',
		data: {
			updateStatus: true,
		},
		success: (response) => {
			console.log(response);
		},
		error: ({
			responseJSON
		}) => {
			console.log(responseJSON)
		}
	});

	$(document).ready(function() {
		$("#category").change(function() {
			var val = $(this).val();
			if (val == "Abbigliamento") {
				$("#subcategory").html("<option>Accessori</option><option>Borse</option><option>Scarpe</option><option>Vestiti</option><option>Altro</option>");
			} else if (val == "Elettrodomestici") {
				$("#subcategory").html("<option>Aspirapolveri</option><option>Caffettiere</option><option>Frullatori</option><option>Tostapane</option><option>Altro</option>");
			} else if (val == "Foto e video") {
				$("#subcategory").html("<option>Accessori</option><option>Macchine fotografiche</option><option>Microfoni</option><option>Telecamere</option><option>Altro</option>");
			} else if (val == "Hobby") {
				$("#subcategory").html("<option>Film e DVD</option><option>Giocattoli</option><option>Libri e riviste</option><option>Musica</option><option>Altro</option>");
			} else {
				$("#subcategory").html("<option disabled selected>Scegli...</option>");
			}
		});
	});
</script>

<script>
	$(document).ready(function() {
		$("#visibility").change(function() {
			var val = $(this).val();
			if (val == "Ristretta") {
				$("#restriction_method").html("<option disabled selected>Scegli...</option><option>Regione</option><option>Provincia</option><option>Città</option>");
				$("#restriction_method_label").html("<label id='restriction_method_label'>Restrizione per: </label>");
				$("#restriction_label").html("<label>Inserisci restrizione:</label");
			} else {
				$("#restriction_method").html("<option disabled selected>Scegli...</option>");
				$("#restriction").html("<option disabled selected>Scegli...</option>");
			}
		});
	});
</script>

<script>
	$(document).ready(function() {
		$("#restriction_method").change(function() {
			var val = $(this).val();

			$("#restriction_label").html("<label>Seleziona " + val.toLowerCase() + ":</label");

			$.ajax({
				type: 'POST',
				url: 'api/geographical_ajax_calls.php',
				data: {
					getRestriction: true,
					restriction: val,
				},
				success: (response) => {
					var select = document.getElementById('restriction');

					if (val == 'Provincia') {
						select.innerHTML = "";
						for (i = 0; i < response.length; i++) {
							select.insertAdjacentHTML('beforeend', "<option>" + response[i].provincia + "</option>");
						}
					} else if (val == 'Città') {
						select.innerHTML = "";
						for (i = 0; i < response.length; i++) {
							select.insertAdjacentHTML('beforeend', "<option>" + response[i].comune + "</option>");
						}
					} else {
						select.innerHTML = "";
						for (i = 0; i < response.length; i++) {
							select.insertAdjacentHTML('beforeend', "<option>" + response[i].regione + "</option>");
						}
					}
				},
				error: ({
					responseJSON
				}) => {
					console.log(responseJSON)
				}
			});
		});
	});
</script>

<script>
	$(document).ready(function() {
		$("#product_condition").change(function() {
			var val = $(this).val();

			var newLabel = val == 'Nuovo' ? 'Garanzia' : 'Usura';
			var newPeriodLabel = val == 'Nuovo' ? 'Fine Copertura' : 'Inizio Utilizzo';

			$("#warranty_label").html("<label>" + newLabel + ":</label");

			$("#warranty_period").html("<label>" + newPeriodLabel + ":</label");

			if (val == "Nuovo") {
				$("#warranty").html("<option>Si</option><option>No</option>");
			} else if (val == "Usato") {
				$("#warranty").html("<option>Pari al nuovo</option><option>Buono</option><option>Medio</option><option>Usurato</option>");
			}

		});
	});
</script>

<script>
	$(document).ready(function() {
		$("#warranty").change(function() {
			var val = $(this).val();

			if (val == "No") {
				$("#warranty_period").html("<label>Fine copertura: (Non compilare)</label");
			} else if (val == "Si") {
				$("#warranty_period").html("<label>Fine copertura: </label");
			}

		});
	});
</script>
<script>
	const seller = () => {
		document.getElementById("venditore").checked = !document.getElementById("venditore").checked;
	}

	const buyer = () => {
		document.getElementById("acquirente").checked = !document.getElementById("acquirente").checked;
	}
</script>

<script>
	const card = () => {
		document.getElementById("card").checked = !document.getElementById("card").checked;
		if (document.getElementById("person").checked && document.getElementById("card").checked) {
			document.getElementById("person").checked = false;
		}
	}

	const person = () => {
		document.getElementById("person").checked = !document.getElementById("person").checked;
		if (document.getElementById("person").checked && document.getElementById("card").checked) {
			document.getElementById("card").checked = false;
		}
	}
</script>

<script>
	$(document).ready(function() {
		$("#upload_image").change(function() {
			document.getElementById('uploadPreview').hidden = true;
			document.getElementById('imagePreview').src = window.URL.createObjectURL(this.files[0]);
			document.getElementById('imagePreview').hidden = false;
		});
	});
</script>

<script>
	const showOffers = () => {
		document.getElementById('js-sidebar-offers').classList.add("show-sidebar");
		document.getElementById('body').style.overflowY = "hidden";
		document.getElementById('body').style.overflow = "hidden";
	}

	const hideOffers = () => {
		document.getElementById('js-sidebar-offers').classList.remove("show-sidebar");
		document.getElementById('body').style.overflowY = "visible";
		document.getElementById('body').style.overflow = "visible";
	}

	var url = window.location.pathname.split('/');

	// code for accepting a user's offer
	const acceptOffer = (id, productId) => {
		$.ajax({
			type: 'POST',
			url: 'api/profile_ajax_calls.php',
			data: {
				offerResponse: true,
				offerId: id,
				response: 'Accettata',
				productId: productId,
			},
			success: () => {
				if (window.location.search) {
					window.location.replace(url[url.length - 1] + window.location.search + '&acceptedsuccessful=1');
				} else {
					window.location.replace(url[url.length - 1] + '?acceptedsuccessful=1');
				}
			},
			error: ({
				responseJSON
			}) => {
				swal('Errore', "C'è stato un problema. Riprova più tardi", "error");
				console.log(responseJSON)
			}
		});
	}

	// code for quitting a user's offer
	const quitOffer = (id) => {
		$.ajax({
			type: 'POST',
			url: 'api/profile_ajax_calls.php',
			data: {
				offerResponse: true,
				offerId: id,
				response: 'Rifiutata',
			},
			success: () => {
				if (window.location.search) {
					window.location.replace(url[url.length - 1] + window.location.search + '&refusedsuccessful=1');
				} else {
					window.location.replace(url[url.length - 1] + '?refusedsuccessful=1');
				}
			},
			error: ({
				responseJSON
			}) => {
				swal('Errore', "C'è stato un problema. Riprova più tardi", "error");
				console.log(responseJSON)
			}
		});
	}

	const rateBuyer = (id) => {
		document.getElementById('exampleModalLongTitle').innerHTML = 'Valuta acquirente';
		document.getElementById('transactionId').value = id
	}

	const rateSeller = (id) => {
		document.getElementById('exampleModalLongTitle').innerHTML = 'Valuta venditore';
		document.getElementById('transactionId').value = id
	}


	// code to handle evaluation of a user
	const eval = () => {
		const role = document.getElementById('exampleModalLongTitle').innerHTML.split(' ')[1];
		const serieta = document.getElementById('serieta').value;
		const puntualita = document.getElementById('puntualita').value;

		const transactionId = document.getElementById('transactionId').value;

		$.ajax({
			type: 'POST',
			url: 'api/profile_ajax_calls.php',
			data: {
				evalUser: true,
				role: role,
				serieta: serieta,
				puntualita: puntualita,
				transactionId: transactionId,
			},
			success: () => {
				if (window.location.search) {
					window.location.replace(url[url.length - 1] + window.location.search + '&evalsuccessful=1');
				} else {
					window.location.replace(url[url.length - 1] + '?evalsuccessful=1');
				}
			},
			error: ({
				responseJSON
			}) => {
				swal('Errore', "C'è stato un problema. Riprova più tardi", "error");
				console.log(responseJSON)
			}
		});
	}

	// adding to wishlist handler
	const observeHandler = (button, watchlist, adInfo) => {
		var id = button.id;
		var title = button.parentElement.parentElement.children[0].children[0].textContent;

		if ("<?php echo $_SESSION['logged_in']  ?? '' ?>" == false) {
			swal('Errore', "Operazione non disponibile se non loggati", "error");
			return;
		}

		if (!document.getElementById(id).classList.contains("js-addedwish-b2")) {
			// async code to handle change in the db
			$.ajax({
				type: 'POST',
				url: 'api/ads_ajax_calls.php',
				data: {
					watchlist: true,
					adId: id,
					insert: true,
				},
				success: (data) => {
					document.getElementById(id).classList.add("js-addedwish-b2");
					if (!adInfo) button.parentElement.children[0].textContent = parseInt(button.parentElement.children[0].textContent) + 1;

					if (watchlist) {
						button.parentElement.parentElement.children[1].children[2].children[0].textContent = 'Osservatori: ' + (parseInt(button.parentElement.parentElement.children[1].children[2].children[0].textContent.split(': ')[1]) + 1);
						button.parentElement.children[0].textContent = 'più info';
					}
					if (adInfo) {
						button.parentElement.children[1].textContent = (parseInt(button.parentElement.children[1].textContent.split(' ')[0]) + 1) + ' osservatori'
					}
					swal(title, "Aggiunto ai tuoi osservati!", "success");
				},
				error: ({
					responseJSON
				}) => {
					swal('Errore', "C'è stato un problema. Riprova più tardi", "error");
					console.log(responseJSON)
				}
			});
		} else {
			// async code to handle change in the db
			$.ajax({
				type: 'POST',
				url: 'api/ads_ajax_calls.php',
				data: {
					watchlist: true,
					adId: id,
				},
				success: (data) => {
					document.getElementById(id).classList.remove("js-addedwish-b2");
					if (!adInfo) button.parentElement.children[0].textContent = parseInt(button.parentElement.children[0].textContent) - 1;

					if (watchlist) {
						button.parentElement.parentElement.children[1].children[2].children[0].textContent = 'Osservatori: ' + (parseInt(button.parentElement.parentElement.children[1].children[2].children[0].textContent.split(': ')[1]) - 1);
						button.parentElement.children[0].textContent = 'più info';
					}

					if (adInfo) {
						button.parentElement.children[1].textContent = (parseInt(button.parentElement.children[1].textContent.split(' ')[0]) - 1) + ' osservatori'
					}
					swal(title, "Rimosso dai tuoi osservati!", "error");
				},
				error: ({
					responseJSON
				}) => {
					swal('Errore', "C'è stato un problema. Riprova più tardi", "error");
					console.log(responseJSON)
				}
			});
		}

	}

	const changeSerieta = (value) => {
		document.getElementById('serieta').value = value;
	}

	const changePuntualita = (value) => {
		document.getElementById('puntualita').value = value;
	}

	// popup handlers
	if ("<?php echo $_REQUEST['insertionsuccessful'] ?? '' ?>") {
		swal('Successo', "Annuncio inserito con successo", "success");
	}

	if ("<?php echo $_REQUEST['deletesuccessful'] ?? '' ?>") {
		swal('Successo', "Annuncio eliminato con successo", "success");
	}

	if ("<?php echo $_REQUEST['reactivationsuccessful'] ?? '' ?>") {
		swal('Successo', "Annuncio riattivato con successo", "success");
	}

	if ("<?php echo $_REQUEST['evalsuccessful'] ?? '' ?>") {
		swal('Successo', "Recensione utente mandata con successo", "success");
		showOffers();
	}

	if ("<?php echo $_REQUEST['acceptedsuccessful'] ?? '' ?>") {
		swal('Successo', "Offerta accettata con successo", "success");
		showOffers();
	}

	if ("<?php echo $_REQUEST['refusedsuccessful'] ?? '' ?>") {
		swal('Successo', "Offerta rifiutata con successo", "success");
		showOffers();
	}

	const handleOffer = () => {
		if ("<?php echo $_SESSION['logged_in'] ?? '' ?>") {
			if ("<?php echo $_SESSION['ruolo'] ?? '' ?>" == "v") {
				swal('Errore', "Devi essere un acquirente per poter inviare un offerta", "error");
				return;
			}
		} else {
			swal('Errore', "Devi essere loggato per poter inviare un offerta", "error");
			return;
		}

		var amount = document.getElementById('offer').value;
		var card = document.getElementById('card').checked;
		var person = document.getElementById('person').checked;

		var method = card ? 'Carta' : person ? 'Persona' : '';

		var sellerId = document.getElementById('seller').value;
		var product = document.getElementById('product').value;

		$.ajax({
			type: 'POST',
			url: 'api/ads_ajax_calls.php',
			data: {
				offerHandler: true,
				seller: sellerId,
				adId: product,
				amount: amount,
				method: method,
			},
			success: (response) => {
				console.log(response)
				if (response) {
					if (response.error) {
						swal('Errore', response.error.msg, "error");
						return
					}
				}
				$('#closeModalOffer').click();
				swal('Successo', "offerta inviata con successo", "success");
			},
			error: ({
				responseJSON
			}) => {
				swal('Errore', "Si è verificato un errore. Riprova più tardi", "error");
				console.log(responseJSON)
			}
		});
	}

	const handleMessage = () => {

		if (!"<?php echo $_SESSION['logged_in'] ?? '' ?>") {
			swal('Errore', "Devi essere loggato per poter inviare un messaggio", "error");
			return;
		}

		var sellerID = document.getElementById('seller').value;
		var product = document.getElementById('product').value;

		var message = document.getElementById('message').value;

		$.ajax({
			type: 'POST',
			url: 'api/profile_ajax_calls.php',
			data: {
				messageHandler: true,
				recipient: sellerID,
				adId: product,
				message: message,
			},
			success: () => {
				$('#message_button').click()
				swal('Successo', "messaggio inviato con successo", "success");
			},
			error: ({
				responseJSON
			}) => {
				console.log(responseJSON);
				swal("Attenzione", "C'è stato un errore con l'invio del messaggio. Riprova più tardi.", "error")
			}
		});
	}

	// code for deleting ads
	const handleDelete = () => {
		var product = document.getElementById('product').value;
		$.ajax({
			type: 'POST',
			url: 'api/ads_ajax_calls.php',
			data: {
				delete: true,
				adId: product,
			},
			success: (data) => {
				if (window.location.search) {
					if (url[url.length - 1] == 'adInfo.php') {
						window.location.replace('showcase.php?deletesuccessful=1');
						return;
					}
					window.location.replace((url[url.length - 1] + window.location.search + '&deletesuccessful=1').replace('reactivationsuccessful=1', ''));
				} else {
					if (url[url.length - 1] == 'adInfo.php') {
						window.location.replace('showcase.php?deletesuccessful=1');
						return;
					}
					window.location.replace((url[url.length - 1] + '?deletesuccessful=1').replace('reactivationsuccessful=1', ''));
				}
			},
			error: ({
				responseJSON
			}) => {
				swal('Errore', "C'è stato un errore nell'eliminazione. Riprova più tardi", "error");
				console.log(responseJSON)
			}
		});
	}

	// offers popup message
	$.ajax({
		type: 'POST',
		url: 'api/profile_ajax_calls.php',
		data: {
			offersPopup: true,
		},
		success: (response) => {
			if (response.warning) {
				console.log(response)
				return;
			}
			if (response.length == 1) {
				swal('Proposta', 'Hai ricevuto una proposta di acquisto da ' + response[0].nome + " " + response[0].cognome + " per l'annuncio " + response[0].titolo + ", vai nella sezione proposte per visualizzarla!", "warning");
			} else if (response.length > 1) {
				swal('Proposta', 'Hai ricevuto ' + response.length + ' proposte di acquisto, vai nella sezione proposte per visualizzarle!', "warning");
			}
		},
		error: ({
			responseJSON
		}) => {
			console.log(responseJSON, 'offersPopup error')
		}
	});
</script>