<?php
require_once "../vendor/autoload.php";

if(isset($_GET['action']) AND  $_GET['action'] == 'insert'){
    $test = new TestRunner();
    echo "Doctrine : [".$test->execDoctrineTest()."]\r";
    echo "Propel : [".$test->execPropelTest()."]\r";
    echo "SQL : [".$test->execSqlTest()."]\r";
    exit;
}

$runner = new TestRunner();
$articles = $runner->getDoctrineArticles();
$time_get_result_doctrine = $runner->getChrono();

$articles_propel = $runner->getPropelArticles();
$time_get_result_propel = $runner->getChrono();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>php-orm-benchmarker</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/custom-css.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">
    <div class="header">
        <nav>
            <ul class="nav nav-pills pull-right">
                <li role="presentation" class="active"><a href="#">Home</a></li>
            </ul>
        </nav>
        <h3 class="text-muted">php-orm-benchmarker</h3>
    </div>

    <div class="jumbotron">
        <h1>Jumbotron heading</h1>
        <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <p><a class="btn btn-lg btn-success" href="?action=insert" role="button">Inserer les données</a></p>
    </div>
    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#doctrine" id="doctrine-tab" role="tab" data-toggle="tab" aria-controls="doctrine" aria-expanded="true">Doctrine <span class="label label-warning"><?php echo round($time_get_result_doctrine, 4); ?> s</span></a></li>
            <li role="presentation" class=""><a href="#propel" role="tab" id="propel-tab" data-toggle="tab" aria-controls="propel" aria-expanded="false">Propel <span class="label label-warning"><?php echo round($time_get_result_propel, 4); ?> s</span></a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="doctrine" aria-labelledby="doctrine-tab">

                    <h2><?php echo count($articles); ?> élément(s) récupéré(s) en <?php echo $time_get_result_doctrine;?></h2>
                    <?php foreach($articles as $article){ ?>
                        <div class="col-lg-12">
                            <h3><?php echo $article->getTitre(); ?><small>par <?php echo $article->getAuteur()->getPseudo(); ?></small></h3>
                            <p><?php echo $article->getContenu(); ?></p>
                        </div>
                    <?php } ?>

            </div>
            <div role="tabpanel" class="tab-pane fade" id="propel" aria-labelledby="propel-tab">
                <h2><?php echo count($articles_propel); ?> élément(s) récupéré(s) en <?php echo $time_get_result_propel;?></h2>
                <?php foreach($articles_propel as $article){ ?>
                    <div class="col-lg-12">
                        <h3><?php echo $article->getTitre(); ?><small>par <?php echo $article->getAuteur()->getPseudo(); ?></small></h3>
                        <p><?php echo $article->getContenu(); ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>


    <footer class="footer">
        <p>&copy; Company 2014</p>
    </footer>

</div> <!-- /container -->

<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
