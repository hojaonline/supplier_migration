<link id="bootstrap-css" rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="styles/style.css">
<link rel="stylesheet" href="styles/jquery.dataTables.min.css">
<link rel="stylesheet" href="styles/jquery.dataTables_themeroller.css">
<link rel="stylesheet" href="styles/font-awesome.min.css">



<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/main.js"></script>

<?php require 'dbconf.php';?>
<div class="container">
	<h3>Supplier Globalization</h3>
<hr/>

<div class="row">
	<div class="col-md-12">
		<div class="tabbable-panel">
			<div class="tabbable-line">
				<ul class="nav nav-tabs ">
					<li class="active"><a href="#tab_default_1" data-toggle="tab"> Globalize Suppliers</a></li>
					<li><a href="#tab_default_2" data-toggle="tab"> Suppliers with Images </a></li>
					<li><a href="#tab_default_3" data-toggle="tab"> Suppliers with out Images </a></li>
				</ul>
				<div class="tab-content">
					<!-- Tab 1 for Form for globalization -->
					<div class="tab-pane active" id="tab_default_1">
						<?php include 'globalization.php'; ?>
					</div>
					<!-- Tab 2 for Supplier with Images  -->
					<div class="tab-pane" id="tab_default_2">
					 	<?php include 'supplierimages.php'; ?>
					</div>
					<!-- Tab 3 for Supplier without Images  -->
					<div class="tab-pane" id="tab_default_3">
						<?php include 'suppliernoimages.php'; ?>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>


