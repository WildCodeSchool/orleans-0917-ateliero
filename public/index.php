<?php
include 'header.php';
include '../src/functions.php';
// include '../connect_bdd.php';	
// $bdd = mysqli_connect(SERVEUR, USER, PASSWORD, DATABASE);
?>

<!-- Start Banner -->

<div class="row">
	<div class="banner">
		<img src="http://via.placeholder.com/200x550" alt="#" />
	</div>
	<p class="col-xs-offset-8 col-xs-4">
		<cite>
			<span class="fa fa-quote-left" aria-hidden="true"></span>
			L'Atelier'O vous donne de l'amour.
			<span class="fa fa-quote-right" aria-hidden="true"></span>
		</cite>
	</p>
</div>
<!-- End Banner -->

<!-- Start Actu / Img Insta, Blog -->

<h2>Notre Actualité</h2>
<hr />
<div class="row">
		<div class="col-xs-4">
			<img src="http://via.placeholder.com/200x200" alt="">
		</div>
		<div id="imginsta" class="col-xs-4">
			<img src="http://via.placeholder.com/100x100" alt="">
			<img src="http://via.placeholder.com/100x100" alt="">
		</div>
		<div class="col-xs-4">
			<img src="http://via.placeholder.com/200x200" alt="">
		</div>

		<div class="col-xs-4">
			<img src="http://via.placeholder.com/100x100" alt="">
			<img src="http://via.placeholder.com/100x100" alt="">
		</div>
		<div class="col-xs-4">
			<img src="http://via.placeholder.com/200x200" alt="">
		</div>
		<div class="col-xs-4">
			<img src="http://via.placeholder.com/100x100" alt="">
			<img src="http://via.placeholder.com/100x100" alt="">
		</div>			
</div>
<!-- End Actu / Img Insta, Blog -->

<!-- Start About us -->

<h2>Qui sommes-nous</h2>
<hr />
<div class="row">
	<div class="col-xs-offset-1 col-xs-4">
			<img src="http://via.placeholder.com/300x200" alt="">
	</div>
	<div class="col-xs-offset-1 col-xs-5">
		<p>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin efficitur arcu vel justo posuere, et vehicula nibh interdum. Aliquam viverra ornare fringilla. Cras blandit et sem quis iaculis. Nullam placerat mi sed mauris finibus, sed ullamcorper nunc rhoncus. Proin dapibus lacus sit amet eros accumsan porta. Aliquam at pellentesque odio. Curabitur dictum malesuada sem non tincidunt. Morbi semper id risus finibus finibus.</p>
	</div>
</div>
<!-- End About us -->

<!-- Start Partner -->

<h2>Où nous trouvez</h2>
<hr />
<div class="row">
	<div class="col-xs-2">
		<img src="http://via.placeholder.com/100x100" alt="#" />
	</div>
	<div class="col-xs-2">
		<p>
			<a href="#">Partenaire 1</a><br/>
			<a href="#">www.adresse1.com</a>
		</p>
	</div>
	<div class="col-xs-2">
		<img src="http://via.placeholder.com/100x100" alt="#" />
	</div>
	<div class="col-xs-2">
		<p><a href="#">Partenaire 1</a><br><a href="#">www.adresse1.com</a></p>
	</div>
	<div class="col-xs-2">
			<img src="http://via.placeholder.com/100x100" alt="#" />
	</div>
	<div class="col-xs-2">
		<p><a href="#">Partenaire 1</a><br><a href="#">www.adresse1.com</a></p>
	</div>
</div>
<!-- End Partner -->

<?php include 'footer.php'; ?>
