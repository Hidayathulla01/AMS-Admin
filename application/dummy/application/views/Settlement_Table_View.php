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
	font-size: 15px;
}
.modal {
   position: absolute;
   padding-right:60px;
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
			<span class="dashboard" style="color: #223A68;"><b>Settlement List </b></span>
			</div>
		<div class="col-sm-3">
			<button type="button" class=" btn-sm btn btn-success" name="SettledSelected" id="SettledSelected" style="color:#ffff;" style="display:block;float:right;">Bulk Payment</button>
		</div>
		<div class="col-sm-4">
			<button type="button" name="ApproveSelected" id="ApproveSelected" class="btn-sm btn btn-success" style="display:block;float:left;">Bulk Approval</button>
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
					<th>Transaction ID</th>
					<th>Masjid ID</th>					
					<th>Beneficiary ID</th>					
					<th>Vendor ID</th>	
					<th>Voucher Number </th>	
					<th>Voucher value</th>	
					<th>Request Status</th>	
					<th>Transaction Details</th>
				</tr>
			</thead>
			<tbody>  
			</tbody>
		</table>
    </div> 
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		
	var table; 
	table = $('#example').DataTable({
		"columnDefs": [
        {"className": "dt-center", "targets": "_all"}
      ],
		"processing": true,
		"ajax": "<?php echo base_url('GetVouchersList')?>",

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
	
	//Update Payment Status to Approved:
	function Approval(ApprovalUrl) {
    var Approval = confirm("Are you sure to Approve for Payment?");
    if (Approval) {
        window.location.href = ApprovalUrl;
    }
}

//Update Payment Status to Settled:
function Settlement(SettleUrl) {
    var Settlement = confirm("Are you Sure to Agree for Payment?");
    if (Settlement) {
        window.location.href = SettleUrl;
    }
}


		/***FUNCTION FOR BULK APPROVAL && FUNCTION FOR BULK SETTLEMENT**/
$(document).ready(function(){
			/***FUNCTION FOR BULK APPROVAL **/
	$('#ApproveSelected').click(function(){
		var confirmed = confirm("Are you sure to Agree to Approve Selected vouchers?");
			if (confirmed) {
	var checkbox = $('.Approval:checked');
	  //alert(checkbox);
	if(checkbox.length > 0){

	var checkbox_value = [];

	$(checkbox).each(function(){
	checkbox_value.push($(this).val());
	});
	$.ajax({
	url:"<?php echo base_url(); ?>Settlement_Controller/BulkApproval",
	method:"POST",
	data:{checkbox_value:checkbox_value},
	success:function() {}
	})

	}
	else
	{
	alert('Select atleast one records');
	}
	 window.location.href="<?php echo base_url(); ?>Settlement_Controller/SettlementList";
		}

	});

			/***FUNCTION FOR BULK SETTLEMENT **/

$('#SettledSelected').click(function(){
	 var confirmed = confirm("Are you sure to Agree to Pay to Selected vouchers?");
        if (confirmed) {
			var checkbox = $('.Approval:checked');
  //alert(checkbox);
  if(checkbox.length > 0)
  {
   var checkbox_value = [];
   
   $(checkbox).each(function(){
    checkbox_value.push($(this).val());
   });
   $.ajax({
    url:"<?php echo base_url(); ?>Settlement_Controller/BulkSettlement",
    method:"POST",
    data:{checkbox_value:checkbox_value},
    success:function(){}
   })
   
  }
  else
  {
   alert('Select atleast one records');
  }
     window.location.href="<?php echo base_url(); ?>Settlement_Controller/SettlementList";
        }
	});
});

// for insert
	function VouchersDetails(payment_request_id){
		//alert(payment_request_id);
		  $("#myModal").load("<?php echo base_url("Settlement_Controller/VouchersDetails")?>/"+ payment_request_id, function () {
                $("#myModal").modal("show");
            });
        }
</script>
</html>