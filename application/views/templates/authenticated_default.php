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

    <title><?php echo $title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $assetDirectory; ?>css/bootstrap.min.css" rel="stylesheet">

    <?php /***
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--link href="<?php echo $assetDirectory; ?>css/ie10-viewport-bug-workaround.css" rel="stylesheet"-->
    ***/ ?>

    <!-- Custom Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Libre+Franklin:400,100,100italic,200,200italic,300,300italic,400italic,500,600,500italic,600italic,700,700italic,800,900,800italic,900italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Patrick+Hand+SC' rel='stylesheet' type='text/css'>
    
    <!-- Custom styles for this template -->
    <link href="<?php echo $assetDirectoryCustom; ?>simplesidebar/css/simple-sidebar.css" rel="stylesheet">
    <link href="<?php echo $assetDirectoryCustom; ?>css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="<?php echo $assetDirectoryCustom; ?>css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="<?php echo $assetDirectoryCustom; ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="//code.jboxcdn.com/0.4.8/jBox.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/b-1.4.2/b-colvis-1.4.2/r-2.2.0/datatables.min.css"/>
    <link href="<?php echo $assetDirectoryCustom; ?>css/komatsuna_custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script src="<?php echo $assetDirectoryCustom; ?>js/jquery.min.js"></script>
    <script src="<?php echo $assetDirectoryCustom; ?>js/jquery-ui.min.js"></script>
    <script src="<?php echo $assetDirectoryCustom; ?>js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <?php /***<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>***/?>
    
    <script src="//code.jboxcdn.com/0.4.8/jBox.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/b-1.4.2/b-colvis-1.4.2/r-2.2.0/datatables.min.js"></script>
  </head>

  <body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <!--li class="sidebar-brand">
                    <a href="#">
                        Start Bootstrap
                    </a>
                </li-->
                <li>
                    <a href="<?php echo base_url('app/index'); ?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo base_url('app/log_entry'); ?>">Enter Service Log</a>
                </li>
                <li>
                    <a href="<?php echo base_url('app/employees/index'); ?>">Edit Employees</a>
                </li>
                <li>
                    <a href="<?php echo base_url('app/users/index'); ?>">Edit Users</a>
                </li>
                <li>
                    <a href="<?php echo base_url('app/manufacturers/index'); ?>">Edit Manufacturers</a>
                </li>
                <li>
                    <a href="<?php echo base_url('app/equipment/index'); ?>">Edit Equipment</a>
                </li>
                <li>
                    <a href="<?php echo base_url('app/equipmentTypes/index'); ?>">Edit Equipment Types</a>
                </li>
                <li>
                    <a href="<?php echo base_url('app/fluidTypes/index'); ?>">Edit Fluid Types</a>
                </li>
                <li>
                    <a href="<?php echo base_url('app/appSettings'); ?>">Edit App Settings</a>
                </li>
                <li>
                    <a href="<?php echo base_url('app/reporting/index'); ?>">Reporting</a>
                </li>
                <li>
                    <a href="<?php echo base_url('auth/logout'); ?>">Log Out</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        
                        <table>
                            <tr>
                                <td>
                                    <a href="#" id="menu-toggle" class="btn btn-sm">
                                        <span class="glyphicon glyphicon-menu-hamburger"></span>
                                    </a>
                                </td>
                                <td>
                                    <img src="<?php echo $assetDirectoryCustom; ?>img/025_Gloria_blue_nega_r.jpg">
                                    <h5>Maintenance Log Application</h5>
                                </td>
                            </tr>
                        </table>
                        
                    </div>
                    <div class="col-lg-4">
                        
                        Logged in as <strong><?php echo $_SESSION['first_name']; ?> <?php echo $_SESSION['last_name']; ?></strong>.
                        
                    </div>
                </div>
                
                <div class="row app-content-wrapper">
                    <div class="col-md-8 col-md-offset-2">
                        
                        <?php echo $body; ?>
                        
                    </div>
                </div>
                
                <?php /***
                <div class="row">
                    <div class="col-lg-12">
                        
                        
                        <p>&nbsp;</p>
                        
                        <div class="col-md-4 col-md-offset-4">

                            <?php echo $body; ?>

                        </div>
                    </div>
                </div>
                ***/ ?>
                
            </div>
        </div>
        <!-- /#page-content-wrapper -->
        <?php /****
        <footer class="footer">
            <div class="container" style="padding-left:35px;padding-top:15px;">
                <p>Copyright &copy; <?php echo date("Y"); ?> Komatsu NA. All Rights Reserved.</p>
            </div>
        </footer> ****/ ?>
    </div>
    <!-- /#wrapper -->
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="<?php echo $assetDirectory; ?>js/bootstrap.min.js"></script>
    <?php /***<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--script src="<?php echo $assetDirectory; ?>js/ie10-viewport-bug-workaround.js"></script-->***/ ?>
    
    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script> 
      
  </body>
</html>