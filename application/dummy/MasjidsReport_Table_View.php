<!DOCTYPE html>

<html>

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"/>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
		   
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>
<style>
body {
    overflow-y: scroll;
}
.form{
	position: fixed;
	margin-top: 50px;
	margin-left: 15%;
	height:calc(100% - 100px);
	width: 85%;
	background: #ffffff;
	transition: all 0.5s ease;
    overflow-y: auto;
}
.container{
	font-size: 12px;
}
.btn{
	float: right;
	margin-top: 10px;
	color: #223A68;
}
table{
	font-size: 16px;
}
a{
	 text-decoration: none;
}

</style>
<body>


<?php
	include '_sideBar.php';
?> 
 <section class="home-section">
	<nav>
		<div class="sidebar-button">
			<i class= "bx bx-menu sidebarBtn" style="color: #223A68; "></i>
			<span class="dashboard" style="color: #223A68; " ><b>List of Masjids</b></span>
		</div>
		<div class="col-sm-8">
			<a class="pull-right btn btn-success btn-xs" style="color:#fff" href="<?php echo site_url() ?>ExportMasjids"><i class="fa fa-file-excel-o"></i> Export Data</a>
		</div>
	 </section><br>
	 
	
<div class="form">

	<div>
		<h2 style="display:inline-block; margin-left: 15px;">
		
	</div><br>
    <div class="container">
		<table id="example" class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Masjid ID</th>
					<th>Masjid Name</th>
					<th>Location</th>
					
				</tr>
			</thead>
			<tbody>  
				
			</tbody>
		</table>
    </div> 
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		
	var table; 
	table = $('#example').DataTable({
		"processing": true,
		"ajax": "<?php echo base_url('GetListReport')?>", 
		language: {
			paginate: {
				first: '<i class="fa fa-step-backward"></i>',
				last: '<i class="fa fa-step-forward"></i>',
				next: '<i class="fa fa-forward"></i>', 
				previous: '<i class="fa fa-backward"></i>'  
			}
		}
	} );
	} );
	

 // for delete

function confirmDelete(deleteUrl) {
	
    var confirmDelete = confirm("Are you sure you want to delete?");
    if (confirmDelete) {
        window.location.href = deleteUrl;
    }
}
</script>

</html>