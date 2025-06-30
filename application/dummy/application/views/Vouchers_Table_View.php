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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
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
.profile{
		display: flex;
		align-items: center;
		height: 50px;
		min-width: 190px;
		background: white;
		//border: 2px solid #EFEEF1;
		border-radius: 6px;
		padding: 0 15px 0 2px;
	}
	.profile{
		font-size: 20px;
		align-text: center;
		//font-family: "poppins",sans-serif;
		font-weight: 500;
		color: #333;
		margin: 0 10px;
		white-space: nowrap;
	}
	
</style>
</head>
<body>
<?php
	include '_sideBar.php';
	
	$userData = $this->session->userdata('user_data');
	$username = $userData['user_id'];
	$masjid_id = $userData['masjid_id'];
	
	$sql = "SELECT * FROM tb_user_access WHERE user_id = '".$username."'";
	$qry = $this->db->query($sql);
	$result = $qry->result_array();
		//print_r($result);
		//die();
	foreach($result as $row){
		$GetId = $row['vouchers_management'];
	}
	
	//Query for show Total funds allocated for masjid 
	$sql2 =	"SELECT sum(fund_allocation) AS TotalFund FROM tb_funds WHERE masjid_id ='".$masjid_id."' and for_the_year = year(curdate())";
	
	$query = $this->db->query($sql2);
	$result2 = $query->row();
	$TotalFund = $result2->TotalFund;
	
	//Query for show Total Value of vouchers spent by masjid 
	/*$sql3 = "SELECT sum(value) AS TotalValue FROM tb_vouchers WHERE masjid_id ='".$masjid_id."' and status='1'";
	
	$query1 = $this->db->query($sql3);
	$result3 = $query1->row();
	
	$TotalValue = $result3->TotalValue;
	
	//for preventing NaN showing if value is 0
	if($TotalValue==''){
	$TotalValue='0';
	}
	$AvailableFund = $TotalFund - $TotalValue;*/
	
	$sql3 = "SELECT value FROM tb_vouchers WHERE masjid_id ='".$masjid_id."' and status='1'";
		$query1 = $this->db->query($sql3);
		$result3 = $query1->result_array();
		//die ($result3);
		foreach($result3 as $row){
			$TotalValue += $row['value'];
	}
	if($TotalValue=='NaN'){
	$TotalValue='0';		
	}
	$AvailableFund = $TotalFund - $TotalValue;
	
?> 
<section class="home-section">
	<nav>
		<div class="sidebar-button col-sm-6">
			<i class= "bx bx-menu sidebarBtn" style="color: #223A68; "></i>
			<span class="dashboard" style="color: #223A68;" ><b>E-Voucher Management</b></span>
		</div>
			<div class="col-sm-2" style=" margin-left:155px;">
				<button class="btn btn-sm btn-primary" style="color:white; <?php if (strpos($GetId, 'Add') === false) { ?>display:none<?php } ?>" id="addUserBtn">Manual Voucher</button>
			</div>
			
			<div class="col-sm-2">
				<button class="btn btn-sm btn-primary" style="color:white; <?php if (strpos($GetId, 'Add') === false) { ?>display:none<?php } ?>" id="BulkUploadBtn">Issued Vouchers</button>
			</div>
		
	</nav>
</section><br><br>	 
	
<div class="form">
			<div class="row" style="<?php if ($username== 'admin') { ?>display:none;<?php } ?>margin-left:55px;">
				<div class="profile" style="width:400px;">			
					Funds Available - <input class="profile"  style="width:100px; border:none;" id="AvailableFund" value="<?php echo $AvailableFund; ?>"readonly>
				</div>
				<div class="profile" style="width:400px;">	
					Funds Spent - <input class="profile"  style="width:100px;  border:none;" id="TotalFund" value="<?php echo $TotalValue; ?>"readonly>
				</div>
			</div>
    <div class="container">
		<table id="example" class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Beneficiary ID</th>
					<th>Voucher Number</th>
					<th>No of Voucher</th>
					<th>Value of Voucher</th>
					<th>Expiry Date</th>
					<?php
						if (strpos($GetId,'Edit') !== false){
							echo "<th>Action</th>";	
						}elseif (strpos($GetId,'Delete' ) !== false){
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


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>

<div class="modal fade" id="BulkVoucher" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
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
		"ajax": "<?php echo base_url('GetListData')?>", 
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
	
function confirmDelete(deleteUrl) {
    var confirmDelete = confirm("Are you sure you want to delete?");
    if (confirmDelete) {
        window.location.href = deleteUrl;
    }
}


 $("#TotalFund").hover(function () {
	$(this).prop("disabled", true);
	  });
 $("#AvailableFund").hover(function () {
	$(this).prop("disabled", true);
	  });
	  
	  // Function to format rupees amount with commas
    function formatRupeesAmount(amount) {
	   var numericAmount = parseFloat(amount);
		return 'S$' + numericAmount.toLocaleString('en-SG');
    
    }
	var AvailableFund = $("#AvailableFund").val();
	var TotalFund = $("#TotalFund").val();
    document.getElementById('AvailableFund').value = formatRupeesAmount(AvailableFund);
    document.getElementById('TotalFund').value = formatRupeesAmount(TotalFund);
	 

</script>
<script>
 // for insert
    $(document).ready(function () {


    $("#addUserBtn").click(function () {
		var AvailableFund = $("#AvailableFund").val();
		
        $("#myModal").load("<?php echo base_url("Voucher_Controller/createVoucher");?>", function () {
			//alert(AvailableFund);
			$("#AvailFund1").val(AvailableFund);
            $("#myModal").modal("show");
            $('#beneficiary_id').select2({
                dropdownParent: $('#myModal')
					//alert('ok');
            });
        });
    });
});
</script>

<script>

function getAvailableFund() {
    return $("#AvailableFund").val();
}

	  $(document).ready(function () {
    $("#BulkUploadBtn").click(function () {
		var AvailableFund = $("#AvailableFund").val();
        $("#BulkVoucher").load("<?php echo base_url("Voucher_Controller/BulkUpload");?>", function () {
			$("#AvailFund").val(AvailableFund);
            $("#BulkVoucher").modal("show");
            $('#beneficiary_id').select2({
                dropdownParent: $('#BulkVoucher')
            });
        });
    });
}); 
</script>
<script>
////////for update////////
		function edit_list(id) {
    $("#edit").load("<?php echo base_url("Voucher_Controller/updatedata")?>/" + id, function () {
        var AvailableFund = getAvailableFund();
        $("#AvailFund2").val(AvailableFund);
        $("#edit").modal("show");
        $('#beneficiary_id').select2({
            dropdownParent: $('#edit')
        });
    });
}
</script>
</body>
</html>