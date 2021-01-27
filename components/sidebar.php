<aside class="wrap-sidebar js-sidebar">
	<div class="s-full js-hide-sidebar"></div>

	<div class="sidebar flex-col-l p-t-22 p-b-25">
		<div class="flex-r w-full p-b-30 p-r-27">
			<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-sidebar">
				<i class="zmdi zmdi-close"></i>
			</div>
		</div>

		<div class="sidebar-content flex-w w-full p-lr-65 js-pscroll">
			<ul class="sidebar-link w-full">
				<li class="p-b-13">
					<a href="./index.php" class="stext-102 cl2 hov-cl1 trans-04">
						Home
					</a>
				</li>

				<?php
				if (isset($_SESSION['logged_in'])) {
					echo '<li class="p-b-13">
						<a href="./messages.php" class="stext-102 cl2 hov-cl1 trans-04"> Messaggi </a>
					</li>
	
					<li class="p-b-13">
						<a href="./watchlist.php" class="stext-102 cl2 hov-cl1 trans-04"> Osservati </a>
					</li>

					<li class="p-b-13">
						<a href="./myAds.php" class="stext-102 cl2 hov-cl1 trans-04"> I tuoi annunci </a>
					</li>
	
					<li class="p-b-13">
						<a href="./profileInfo.php?userid= ' . $_SESSION['userID'] .  '" class="stext-102 cl2 hov-cl1 trans-04"> Profilo </a>
					</li>
	
					<li class="p-b-13">
						<a href="api/login_synchronous_functions.php?logoutSubmit=1" class="stext-102 cl2 hov-cl1 trans-04"> Logout </a>
					</li>';
				} else {
					echo '<li class="p-b-13">
					<a href="./showcase.php" class="stext-102 cl2 hov-cl1 trans-04"> Annunci </a>
				</li>

				<li class="p-b-13">
					<a href="topsellers.php" class="stext-102 cl2 hov-cl1 trans-04"> Top Venditori </a>
				</li>
				
				<li class="p-b-13">
					<a href="register.php" class="stext-102 cl2 hov-cl1 trans-04"> Registrati </a>
				</li>';
				}

				?>
			</ul>
		</div>
	</div>
</aside>