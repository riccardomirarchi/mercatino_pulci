<?php
if (isset($_REQUEST['loginError'])) {
	if ($_REQUEST['loginError'] == 'userexists') {
		$error = "L'utente esiste ma la password è sbagliata";
	} else if ($_REQUEST['loginError'] == 'incorrectuser') {
		$error = "Maill e password sono errati";
	} else if ($_REQUEST['loginError'] == 'emptyfields') {
		$error = "Riempi entrambi i campi!";
	} else {
		$error = "L'utente è stato eliminato";
	}
}
?>
<div class="wrap-modal1 js-modal1 p-t-60 p-b-20" style="width:50%;display:flex;padding-top:10%; margin-left:25%;margin-right:25%">
	<div class="overlay-modal1 js-hide-modal1"></div>

	<div class="container">
		<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent" style="padding-left:10%;padding-right:10%">
			<button class="how-pos3 hov3 trans-04 js-hide-modal1">
				<img src="images/icons/icon-close.png" alt="CLOSE" />
			</button>

			<div class="p-b-10">
				<h4 class="ltext-102 cl5 textalign m-b-50">Effettua il login per usufruire dei servizi</h4>
			</div>

			<center>
				<form style="width:50%" action="api/login_synchronous_functions.php?loginSubmit=1" method="POST">
					<div class="wrap-input1 w-full p-b-4 m-b-25">
						<input class="input1 bg-none plh1 stext-107 cl7" type="email" name="email" placeholder="Email" />
						<div class="focus-input1 trans-04"></div>
					</div>

					<div class="wrap-input1 w-full p-b-4 m-b-10">
						<input class="input1 bg-none plh1 stext-107 cl7" type="password" name="password" placeholder="Password" autocomplete="on" />
						<div class="focus-input1 trans-04"></div>
					</div>

					<div class="w-full p-b-4 m-b-30">
						<p style="color:red;"><?php if (isset($_REQUEST['loginError'])) {
																		echo $error;
																	} ?></p>

					</div>

					<div class="w-full p-b-4 m-b-30">
						<h6 style="font-family: Poppins-Regular; font-size: 12px;line-height: 1.2857;">Non hai un account? <a href="register.php">Registrati</a></h6>

					</div>


					<center class="p-t-18">
						<button class="flex-c-m stext-101 cl0 size-126 bg1 bor1 hov-btn4 p-lr-15 trans-04">
							ACCEDI
						</button>
					</center>
				</form>
			</center>
		</div>
	</div>
</div>