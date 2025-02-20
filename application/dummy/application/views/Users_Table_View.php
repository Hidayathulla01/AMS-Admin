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

  
</style>
<body>


<?php
	include '_sideBar.php';
	$userData = $this->session->userdata('user_data');
	$username = $userData['user_id'];
		
	$sql = "SELECT * FROM tb_user_access WHERE user_id = '".$username."'";
		
	$qry = $this->db->query($sql);
	$result = $qry->result_array();
		//print_r($result);
		//die();
	foreach($result as $row){
		$GetId = $row['users_management'];
	}
?> 
 <section class="home-section">
	<nav>
		<div class="sidebar-button">
			<i class= "bx bx-menu sidebarBtn" style="color: #223A68; "></i>
			<span class="dashboard" style="color: #223A68; " ><b>Users Management</b></span>
		</div>
		<div class="search-box">
			<button class="btn-sm btn btn-primary" style="color:white; <?php if (strpos($GetId, 'Add')=== false) { ?>display:none<?php } ?>" id="addUserBtn">Add Users</button>
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
					<th>User-Id</th>
					<th>Full Name</th>
					<th>Masjid ID</th>
					<?php
						if (strpos($GetId,'Edit')){
							echo "<th>Action</th>";	
						}elseif (strpos($GetId,'Delete' )){
							echo "<th>Action</th>";	
						}
					?>
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


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
		"ajax": "<?php echo base_url('UsersList')?>", 
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
	
</script>
<script>
 // for insert
    $(document).ready(function () {
        $("#addUserBtn").click(function () {
            $("#myModal").load("<?php echo base_url("Users_Controller/add");?>", function () {
                $("#myModal").modal("show");
            });
        });
    });
	 
	 
	 // for delete

function confirmDelete(deleteUrl) {
	
    var confirmDelete = confirm("Are you sure you want to delete?");
    if (confirmDelete) {
        window.location.href = deleteUrl;
    }
}


</script>

<script>
////////for update////////
		function edit_list(id){
		 
		  $("#edit").load("<?php echo base_url("Users_Controller/updatedata")?>/"+ id, function () {
                $("#edit").modal("show");
            });
        }
		
	
</script>

</html>