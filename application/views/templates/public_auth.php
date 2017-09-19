<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <!--link rel="icon" href="../../favicon.ico"-->

        <title>Signin Template for Bootstrap</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo $assetDirectory; ?>css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Komatsu NA custom CSS -->
        <link href="<?php echo $assetDirectoryCustom; ?>css/bootstrap.min.css" rel="stylesheet">

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="<?php echo $assetDirectory; ?>css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <!--link href="<?php echo $assetDirectory; ?>signin.css" rel="stylesheet"-->

        <link href='https://fonts.googleapis.com/css?family=Libre+Franklin:400,100,100italic,200,200italic,300,300italic,400italic,500,600,500italic,600italic,700,700italic,800,900,800italic,900italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Patrick+Hand+SC' rel='stylesheet' type='text/css'>
        
        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="<?php echo $assetDirectory; ?>js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="container">

            <div class="row" style="margin-top: 10px;margin-bottom:10px;">
                <div class="col-md-4 col-md-offset-4">
                    
                    <?php echo $body; ?>
                    
                </div>
            </div>

        </div> <!-- /container -->


        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="<?php echo $assetDirectory; ?>js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>