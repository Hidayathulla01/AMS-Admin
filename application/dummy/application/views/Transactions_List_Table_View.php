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
	color: #ffff;
}
table{
	font-size: 16px;
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
			<span class="dashboard" style="color: #223A68;"><b>Transactions List </b></span>
		</div>
		</nav>
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
					<th>Beneficiary ID</th>
					<th>Masjid ID</th>
					<th>Voucher Number</th>
					<th>Value</th>
					<th>Created Date</th>	
					<th>Payment Status</th>	
				</tr>
			</thead>
			<tbody>  
			</tbody>
		</table>
    </div> 
</div>

<script type="text/javascript">
	$(document).ready(function() {
		
	var table; 
	table = $('#example').DataTable({
		"processing": true,
		"ajax": "<?php echo base_url('Transactions_List_Controller/GetTransactionsList')?>",
		language: {
			paginate: {
				first: '<i class="fa fa-step-backward"></i>', // or '→'
				last: '<i class="fa fa-step-forward"></i>', // or '→'
				next: '<i class="fa fa-forward"></i>', // or '→'
				previous: '<i class="fa fa-backward"></i>' // or '←' 
			}
		}
	} );
	} );
	
</script>
</html>