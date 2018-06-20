<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title><?php echo $title; ?></title>

	<!-- Bootstrap core CSS -->
	<link href="<?php echo $assetDirectory; ?>bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css" rel="stylesheet">
	<link href="<?php echo $assetDirectory; ?>bootstrap/4.0.0/css/komatsu_custom.css" rel="stylesheet">

	<!-- Custom Fonts -->
<!--	<link-->
<!--		href='https://fonts.googleapis.com/css?family=Libre+Franklin:400,100,100italic,200,200italic,300,300italic,400italic,500,600,500italic,600italic,700,700italic,800,900,800italic,900italic'-->
<!--		rel='stylesheet' type='text/css'>-->
<!--	<link href='https://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700' rel='stylesheet' type='text/css'>-->
<!--	<link href='https://fonts.googleapis.com/css?family=Patrick+Hand+SC' rel='stylesheet' type='text/css'>-->

	<!-- Custom styles for this template -->
<!--	<link href="--><?php //echo $assetDirectoryCustom; ?><!--simplesidebar/css/simple-sidebar.css" rel="stylesheet"-->
<!--		  type="text/css">-->
<!--	<link href="--><?php //echo $assetDirectoryCustom; ?><!--css/sticky-footer-navbar.css" rel="stylesheet" type="text/css">-->
	<link href="<?php echo $assetDirectoryCustom; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $assetDirectoryCustom; ?>css/jBox.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $assetDirectoryCustom; ?>css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $assetDirectoryCustom; ?>css/parsley.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $assetDirectoryCustom; ?>css/komatsuna_custom.css" rel="stylesheet" type="text/css">

	<script src="<?php echo $assetDirectory; ?>jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
	<script src="<?php echo $assetDirectoryCustom; ?>js/jquery-ui.min.js" type="text/javascript"></script>
	<script src="<?php echo $assetDirectoryCustom; ?>js/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
	<script src="<?php echo $assetDirectory; ?>popper/popper.min.js"></script>
	<script src="<?php echo $assetDirectory; ?>bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="<?php echo $assetDirectoryCustom; ?>js/jBox.min.js" type="text/javascript"></script>
	<script src="<?php echo $assetDirectoryCustom; ?>js/datatables.min.js" type="text/javascript"></script>
	<script src="<?php echo $assetDirectoryCustom; ?>js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
	<script src="<?php echo $assetDirectoryCustom; ?>js/dataTables.responsive.min.js" type="text/javascript"></script>
	<script src="<?php echo $assetDirectoryCustom; ?>js/parsley.min.js" type="text/javascript"></script>
	<script src="<?php echo $assetDirectoryCustom; ?>js/parsley.comparison.js" type="text/javascript"></script>
	<script src="<?php echo $assetDirectoryCustom; ?>js/moment.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/font-awesome/fontawesome-all.js'); ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/bootstrap/4.0.0/js/bootstrap4-parsley.inc.js'); ?>" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
</head>

<body>

	<?php if(APPLICATION_ENVIRONMENT=='DEVELOPMENT') { ?>
	<nav class="navbar navbar-expand-md navbar-development" style="background-color: darkred !important;color: #ffffff !important;">
		Development environment
	</nav>
	<?php } ?>

	<nav class="navbar navbar-expand-md navbar-dark">
		<a class="navbar-brand" href="<?php echo base_url('index.php/app/index'); ?>"><img src="<?php echo $assetDirectory; ?>img/komatsu-logo.png" style="height:25px;"></a>
		<span class="application-name">Maintenance Log</span>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="<?php echo base_url('index.php/app/index'); ?>">Home</a>
				</li>
				<?php if ($_SESSION['role'] === 'admin') { ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage</a>
					<div class="dropdown-menu" aria-labelledby="dropdown01">

						<a class="dropdown-item" href="<?php echo base_url('index.php/app/checklists'); ?>">Checklists</a>
						<a class="dropdown-item" href="<?php echo base_url('index.php/app/checklistItems'); ?>">Checklist Items</a>
						<a class="dropdown-item" href="<?php echo base_url('index.php/app/components/index'); ?>">Components</a>
						<a class="dropdown-item" href="<?php echo base_url('index.php/app/componentTypes/index'); ?>">Component Types</a>
						<a class="dropdown-item" href="<?php echo base_url('index.php/app/manufacturers/index'); ?>">Equipment Manufacturers</a>
						<a class="dropdown-item" href="<?php echo base_url('index.php/app/equipmentmodel/index'); ?>">Equipment Models</a>
						<a class="dropdown-item" href="<?php echo base_url('index.php/app/equipmentTypes/index'); ?>">Equipment Types</a>
						<a class="dropdown-item" href="<?php echo base_url('index.php/app/equipmentunit/index'); ?>">Equipment Units</a>
						<a class="dropdown-item" href="<?php echo base_url('index.php/app/fluidTypes/index'); ?>">Fluid Types</a>
						<a class="dropdown-item" href="<?php echo base_url('index.php/app/mileageChoices/index'); ?>">Mileage Choices</a>
						<a class="dropdown-item" href="<?php echo base_url('index.php/app/addReminderRecipient'); ?>">Reminder Recipients</a>
						<a class="dropdown-item" href="<?php echo base_url('index.php/app/smrChoices/index'); ?>">SMR Choices</a>
						<a class="dropdown-item" href="<?php echo base_url('index.php/app/timeChoices/index'); ?>">Time Choices</a>
						<a class="dropdown-item" href="<?php echo base_url('index.php/app/users/index'); ?>">Users</a>

					</div>
				</li>
				<?php } ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reporting</a>
					<div class="dropdown-menu" aria-labelledby="dropdown01">

						<a class="dropdown-item" href="<?php echo base_url('index.php/reporting/output/screen/maintenance_log_reminders'); ?>">Maintenance Log Reminders</a>
						<a class="dropdown-item" href="<?php echo base_url('index.php/reporting/output/screen/service_logs'); ?>">Log Entry Report</a>
						<a class="dropdown-item" href="<?php echo base_url('index.php/reporting/output/screen/pmservice_reminders'); ?>">PM Service Reminders</a>
						<a class="dropdown-item" href="<?php echo base_url('index.php/reporting/output/screen/equipment_list'); ?>">Equipment List</a>
						<a class="dropdown-item" href="<?php echo base_url('index.php/reporting/output/screen/fuel_used'); ?>">Fluids Used</a>
						<a class="dropdown-item" href="<?php echo base_url('index.php/reporting/output/screen/smr_used'); ?>">Mileage Used</a>
						<a class="dropdown-item" href="<?php echo base_url('index.php/reporting/output/screen/inspection_entry'); ?>">Inspection Entry</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Help</a>
					<div class="dropdown-menu" aria-labelledby="dropdown01">
						<a class="dropdown-item" href="<?php echo base_url('index.php/app/about'); ?>">About</a>
					</div>
				</li>
			</ul>
			<span class="my-2 my-lg-0">
				Logged in as <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?></strong>.&nbsp;&nbsp;<a
					class="smallCaps" href="<?php echo base_url('index.php/auth/logout'); ?>">Log Out</a>
			</span>
		</div>
	</nav>

	<main role="main">

		<div class="container-fluid">
			<!-- Example row of columns -->
			<div class="row application-row">
				<div class="col-sm-12 col-md-12 col-lg-12" style="margin-top:25px;">

					<?php echo $body; ?>

				</div>
			</div>

		</div> <!-- /container -->

	</main>

	<footer class="footer">
		<div class="container-fluid">
			<span>Copyright &copy; <?php echo date("Y"); ?> Komatsu NA.</span>
			Application version: <strong><?php echo APPLICATION_VERSION; ?></strong>
		</div>
	</footer>

</body>
</html>
