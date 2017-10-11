<?php
include 'header.php';
include '../src/functions.php';
// include '../connect_bdd.php';	
// $bdd = mysqli_connect(SERVEUR, USER, PASSWORD, DATABASE);
?>

<!-- Start Banner -->

<div class="row col-xs-offset-1 col-xs-10 banner">
    <img src="http://via.placeholder.com/1920x500" alt="#" />
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

<div class="row col-xs-offset-1 col-xs-10 actu">
    <h2>Notre Actualité</h2>
    <hr />
    <div class="col-xs-4 imgblog">
        <img src="http://via.placeholder.com/800x800" alt="">
    </div>
    <div class="col-xs-4 imginsta">
        <div class="row">
            <img class="col-xs-6" src="http://via.placeholder.com/550x550" alt="">
            <img class="col-xs-6" src="http://via.placeholder.com/250x250" alt="">
        </div>
    </div>
    <div class="col-xs-4 imgblog">
        <img src="http://via.placeholder.com/500x500" alt="">
    </div>
</div>
<div class="row col-xs-offset-1 col-xs-10">
    <div class="col-xs-4 imginsta">
        <div class="row">
            <img class="col-xs-6" src="http://via.placeholder.com/250x250" alt="">
            <img class="col-xs-6" src="http://via.placeholder.com/250x250" alt="">
        </div>
    </div>
		<div class="col-xs-4 imgblog">
			<img class="imgup" src="http://via.placeholder.com/500x500" alt="">
		</div>
    <div class="col-xs-4 imginsta">
        <div class="row">
            <img class="col-xs-6" src="http://via.placeholder.com/250x250" alt="">
            <img class="col-xs-6" src="http://via.placeholder.com/250x250" alt="">
        </div>
    </div>
</div>
<!-- End Actu / Img Insta, Blog -->

<!-- Start About us -->
<div class="row col-xs-offset-1 col-xs-10 aboutus">
    <h2>Qui sommes-nous</h2>
    <hr />
        <img class="col-xs-offset-1 col-xs-4" src="http://via.placeholder.com/800x800" alt="">
        <p class="col-xs-6">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin efficitur arcu vel justo posuere, et vehicula nibh interdum. Aliquam viverra ornare fringilla. Cras blandit et sem quis iaculis. Nullam placerat mi sed mauris finibus, sed ullamcorper nunc rhoncus. Proin dapibus lacus sit amet eros accumsan porta. Aliquam at pellentesque odio. Curabitur dictum malesuada sem non tincidunt. Morbi semper id risus finibus finibus.
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin efficitur arcu vel justo posuere, et vehicula nibh interdum. Aliquam viverra ornare fringilla. Cras blandit et sem quis iaculis. Nullam placerat mi sed mauris finibus, sed ullamcorper nunc rhoncus. Proin dapibus lacus sit amet eros accumsan porta. Aliquam at pellentesque odio. Curabitur dictum malesuada sem non tincidunt. Morbi semper id risus finibus finibus.
        </p>
</div>
<!-- End About us -->

<!-- Start Partner -->

<div class="row col-xs-offset-1 col-xs-10 partner">
    <h2>Où nous trouvez</h2>
    <hr />
        <div class="col-xs-offset-1 col-xs-1 imgpartner">
            <img src="http://via.placeholder.com/500x500" alt="#" />
        </div>
        <div class="col-xs-2 txtpartner">
            <p>
                <a class="namepartner" href="#">Partenaire 1</a><br/>
                <a class="urlpartner" href="#">www.adresse1.com</a>
            </p>
        </div>
        <div class="col-xs-offset-1 col-xs-1 imgpartner">
            <img src="http://via.placeholder.com/500x500" alt="#" />
        </div>
        <div class="col-xs-2 txtpartner">
            <p>
                <a class="namepartner" href="#">Partenaire 1</a><br>
                <a class="urlpartner" href="#">www.adresse1.com</a>
            </p>
        </div>
        <div class="col-xs-offset-1 col-xs-1 imgpartner">
                <img src="http://via.placeholder.com/500x500" alt="#" />
        </div>
        <div class="col-xs-2 txtpartner">
            <p>
                <a class="namepartner" href="#">Partenaire 1</a><br>
                <a class="urlpartner" href="#">www.adresse1.com</a>
            </p>
        </div>
</div>
<!-- End Partner -->

<?php include 'footer.php'; ?>
