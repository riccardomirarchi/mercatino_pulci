<?php
if (!isset($from)) {
	session_start();
}
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
?>
<header class="header-v3">
	<!-- Header desktop -->
	<div class="container-menu-desktop trans-03">
		<div class="wrap-menu-desktop">
			<nav class="limiter-menu-desktop p-l-45">

				<ul class="logo">
					<li>
						<a href="index.php" style="font-size:20px"> Mercatino Delle Pulci </a>
					</li>
				</ul>

				<!-- Menu desktop -->
				<div class="menu-desktop">
					<ul class="main-menu">
						<li>
							<a href="showcase.php">Annunci</a>
						</li>

						<li>
							<a href="topsellers.php">Top Venditori</a>
						</li>

						<?php

						require_once 'api/header_functions.php';

						if (isset($_SESSION["logged_in"])) {
							$offerCount = headerOfferCount($conn, $userId);

							if ($offerCount) {
								echo
								'<li class="label1 js-show-sidebar-offers" data-label1="' . $offerCount . '" onclick="showOffers()">
								<a style="cursor:pointer;">Proposte</a>
							</li>';
							} else {
								echo '	<li class="js-show-sidebar-offers" onclick="showOffers()">
								<a style="cursor:pointer;">Proposte</a>
							</li>';
							}
						}


						if (isset($_SESSION["logged_in"])) {
							$messageCount = headerMessageCount($conn, $userId);

							if ($messageCount) {
								echo
								'<li class="label1" data-label1="' . $messageCount . '" id="messagesHeader">
								<a href="messages.php">Messaggi</a>
							</li>';
							} else {
								echo
								'<li>
								<a href="messages.php" id="messagesHeader">Messaggi</a>
							</li>';
							}
						}
						if (isset($_SESSION["logged_in"]) && ($_SESSION["ruolo"] == 'v' || $_SESSION["ruolo"] == 'e')) {
							echo '<li>
                  <div class="p-l-45">
                    <a href="insertAd.php"
                      class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04"
                    >
                      Inserisci Annuncio
                    </a>
                  </div>
                </li>';
						}
						?>
					</ul>
				</div>

				<div class="wrap-icon-header flex-w flex-r-m h-full">

					<?php
					if (isset($_SESSION["logged_in"])) {
						echo
						'<div class="flex-c-m h-full p-r-25 bor6">
							<a
							href="profileInfo.php?userid=' . $_SESSION["userID"] . '" class="flex-c-m stext-101 cl0 size-126 bg1 bor1 hov-btn4 p-lr-15 trans-04"
							>
							Profilo
							</a>
						</div>';
					} else {
						echo
						'<div class="flex-c-m h-full p-r-25 bor6">
							<button
							class="flex-c-m stext-101 cl0 size-126 bg1 bor1 hov-btn4 p-lr-15 trans-04 js-show-modal1"
							>
							Accedi
							</button>
						</div>';
					}
					?>
					<div class="flex-c-m h-full p-lr-19">
						<div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
							<i class="zmdi zmdi-menu"></i>
						</div>
					</div>
				</div>
			</nav>
		</div>
	</div>

	<!-- Header Mobile -->
	<div class="wrap-header-mobile">
		<!-- Logo moblie -->
		<div class="logo-mobile">
			<a class="logo" style="font-size:20px"> Mercatino Delle Pulci </a>
		</div>

		<!-- Button show menu -->
		<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</div>
	</div>

	<!-- Menu Mobile -->
	<div class="menu-mobile">
		<ul class="main-menu-m">
			<li>
				<a href="index.php">Home</a>
				<span class="arrow-main-menu-m">
					<i class="fa fa-angle-right" aria-hidden="true"></i>
				</span>
			</li>

			<li>
				<a href="showcase.php">Annunci</a>
			</li>

			<li>
				<a href="topsellers.php">Top venditori</a>
			</li>

			<li>
				<a href="insertAd.php">Inserisci annuncio</a>
			</li>

			<li>
				<a href="about.html">About</a>
			</li>

			<li>
				<a href="contact.html">Contact</a>
			</li>
		</ul>
	</div>

	<?php
	require_once 'loginModal.php';
	require_once 'offerSidebar.php';
	if (isset($_REQUEST['loginError'])) {
		$error = $_REQUEST['loginError'];
	}
	?>
	<script>
		if ("<?php echo $error ?? '' ?>") {
			$('.js-modal1').addClass('show-modal1');
		}
	</script>
</header>