<?php
// include '../connect_bdd.php';
// $bdd = mysqli_connect(SERVEUR, USER, PASSWORD, DATABASE);
?>

<?php
date_default_timezone_set('UTC');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="AtelierO">
    <meta name="author" content="WildCodeSchool">
    <title>Atelier'O</title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded:300,400,700|Open+Sans:300,400,700" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">

</head>

<body>

<div class="container-fluid">
    <header>
        <hr/>
        <!-- START PANEL PRINCIPAL -->
        <h2>ADMINISTRATION L'ATELIER'O</h2>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs panel-primary nav-justified">
            <li role="presentation" class="active"><a href="#accueil" aria-controls="accueil" role="tab"
                                                      data-toggle="tab">Accueil</a></li>
            <li role="presentation"><a href="#blog" aria-controls="blog" role="tab" data-toggle="tab">Blog</a></li>
            <li role="presentation"><a href="#shop" aria-controls="shop" role="tab" data-toggle="tab">Shop</a></li>
        </ul>

    </header>

    <div class="panel panel-primary">
        <div class="panel-body">
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- START accueil pannel -->
                <div role="tabpanel" class="tab-pane active" id="accueil">

                    <div class="panel panel-info">
                        <div class="panel-heading"><b>Bannière actuelle</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-10 col-xs-offset-1">
                                    <span href="#" class="thumbnail">
                                        <img src="http://via.placeholder.com/1920x400" alt="Placeholder">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>

                    <div class="panel panel-info">
                        <div class="panel-heading"><b>Envoyer une nouvelle bannière</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <form action="">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder='Choisissez un fichier...'/>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button">Parcourrir</button>
                                                </span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-default pull-right">Envoyer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>

                    <div class="panel panel-info">
                        <div class="panel-heading"><b>Qui sommes nous ?</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <form action="">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder='Choisissez un fichier...'/>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button">Parcourrir</button>
                                                </span>
                                            </div>
                                            <br/>
                                            <div>
                                                <textarea class="aboutus" id="aboutus"></textarea>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-default pull-right">Envoyer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                </div>
                <!-- END accueil pannel -->

                <!-- START blog pannel -->
                <div role="tabpanel" class="tab-pane" id="blog">

                </div>
                <!-- END blog pannel -->

                <!-- START shop pannel -->
                <div role="tabpanel" class="tab-pane" id="shop">
                    <h1>On verra bien :D</h1>
                </div>
                <!-- END shop pannel -->

            </div>
        </div>
    </div>
    <!-- END PANEL PRINCIPAL -->

    <footer>
    </footer>

</div> <!-- // Close the container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script src="assets/js/jquery-3.2.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- include summernote js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
<script>
    $(document).ready(function() {
        $('#aboutus').summernote({
            focus: false,
        });

    });
</script>
</body>
</html>