<html>
<head>

		<title>Dashboard</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" >
		<link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" >
		<?php echo link_tag(base_url('assets/css/style.css')); ?>
		<?php echo link_tag(base_url('assets/css/Datacard.css')); ?>
		<?php echo link_tag(base_url('assets/css/navbar.css')); ?>
</head>
<style>

	/ home-section start /
	
	.home-section .home-content{
		position: relative;
		padding: 160px;
	}	
	.home-section .overview-boxes {
		display: flex;
		flex-direction: row;
		align-items: center;
		width: 110%;
		justify-content: space-between;
		padding: 0 30px;
		margin-bottom: 50px;
	}
	
	.overview-boxes .box{
		padding: 18px 8px;
		display: flex;
		margin-left: 5px;
		background: #fff;
		align-items: center;
		justify-content: center;
		border-radius: 30px;
		box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5);
		width: calc(100% / 4 - 6px);
		
	}
	
	.overview-boxes .box_topic{
		font-size: 18px;
		margin-right:-20px;
		font-weight: 500;
		width:15%;
	}
	.home-content .box .number{
		font-weight: 500;
		font-size: 20px;
		display: inline-block;
	}
	.home-content .box .indicator .text{
		font-size: 16px;

	}
	.overview-boxes .box i{
		
		font-weight: 500;
		height: 40px;
		width: 40px;
		background: #cce5ff;
		color: #66b0ff;
		line-height: 60px;
		text-align: center;
		border-radius: 12px;
	}
	/*
	.overview-boxes .box i.user{
		
		background: #c0f2d8;
		color: #2bd47d;

	}
	.overview-boxes .box i.lock{
		background: #ffe8b3;
		color: #ffc233;
	}
	.overview-boxes .box i.open{
		background: #f7d4d7;
		color: #e05260;
	}
	.overview-boxes .box i.note{
		background: #cce5ff;
		color: #66b0ff;
	}*/
	
	.sidenav a, .dropdown-btn {
  padding: 6px 8px 4px 16px;
  font-size: 15px;
  display: block;
  width:107%;
  text-align: left;
  margin-left: -20px;
  cursor: pointer;
}

.sidenav a, .dropdown-btn:hover{
		background: #53668A;
}

.dropdown-container {
  display: none;
  background-color: #fffff;
  padding-left: 15px;
  font-size:15px;
  margin-left: -15px;
}
	/* home section end*/
	
</style>

<body>
<?php 
	$userData = $this->session->userdata('user_data');
	$username = $userData['user_id'];
		
	$sql = "SELECT * FROM tb_user_access WHERE user_id =  '".$username."'";
		
	$qry = $this->db->query($sql);
	$result = $qry->result_array();
	
	foreach($result as $row){
		$GetId = $row['beneficiary_management'];
		$GetId1 = $row['masjid_management'];
		$GetId2 = $row['vouchers_management'];
		$GetId3 = $row['vendors_management'];
		$GetId4 = $row['users_management'];
	}
	
	// Query for display Username
	$sql1 = "SELECT * FROM tb_users WHERE user_id =  '".$username."'";
	$qry1 = $this->db->query($sql1);
	$result1 = $qry1->result_array();
		
	foreach($result1 as $row){
		$ShowUsername[] = $row['fullname'];
	}
	//print_r($ShowUsername);
//die();
	?>

	<div class="sidebar" style="width: 200px;">
		<div class="logo-details">
			<i class='bx bxl-c-plus-plus'></i>
			<span class="logo_name">Hot Meal</span>
		</div>
		
	  <ul class="nav-link">
		<li>
			<a href="<?php echo base_url("DashboardIndex");?>"> 
			<i class="bx bx-grid-alt"></i>
			<span class="links_name">Dashboard</span>
			</a>
		</li>		
			  <?php if (strpos($GetId1, 'View') !== false) { ?>
	   <li>
			<a href="<?php echo base_url("MasjidIndex");?>">
			<i class="fas fa-mosque"></i>
			<span class="links_name">Masjids</span>
			</a>
	  </li>
	  <?php } ?>
	  <?php if (strpos($username, 'admin')!== false){ ?>
	   <li>
			<a href="<?php echo base_url("FundsIndex");?>"> 
			<i class="fas fa-money-check-alt"></i>
			<span class="links_name">Funds Allocation</span>
			</a>
	  </li>
	  <?php } ?>
	   <?php if (strpos($GetId4, 'View') !== false) { ?>
	   <li>
			<a href="<?php echo base_url("UsersIndex");?>" >
			<i class="fas fa-user-alt"></i>
			<span class="links_name">Users</span>
			</a>
	  </li>
	   <?php } ?>
	  
	  <?php if (strpos($GetId, 'View') !== false) { ?>
	   <li>
			<a href="<?php echo base_url("BeneficiaryIndex");?>">
			<i class="fas fa-comment-dollar"></i>
			<span class="links_name">Beneficiaries</span>
			</a>
	  </li>	
	  <?php } ?>	   
	  	
		<?php if (strpos($GetId2, 'View') !== false) { ?>
	  <li>
			<a href="<?php echo base_url("VoucherIndex");?>">
			<i class="fas fa-mail-bulk"></i>
			<span class="links_name">E-Vouchers</span>
			</a>
	  </li>	
		 <?php } ?>
		 
		 <?php if (strpos($GetId3, 'View')  !== false) { ?>
	   <li>
			<a href="<?php echo base_url("VendorIndex");?>" >
			<i class="fa fa-shopping-bag"></i>
			<span class="links_name">Vendors</span>
			</a>
	  </li>  
	  <?php } ?>
	  <li>
			<a href="<?php echo base_url("SettlementList");?>" >
			<i class="fas fa-dollar-sign"></i>
			<span class="links_name">Settlement</span>
			</a>
	  </li> 
	   
	  <li class="dropdown-btn report " style="color:white; margin-top:10px;">
	  	  <i class="fa fa-address-card" style="margin-left:5px;"></i>
		  <span class="links_name" style="margin-left:-5px;">Reports </span>
      </li>
	<div class="dropdown-container">
		 <li>
			<a href="<?php echo base_url("MasjidReport");?>" >
			<span class="links_name" style="margin-left:55px;">Masjid List </span>
			</a>
		 </li>
		<li>
			<a href="<?php echo base_url("BeneficiaryReport");?>" >
			<span class="links_name" style="margin-left:55px;">Beneficiary List </span>
			</a>
		 </li>	
		 <li>
			<a href="<?php echo base_url("TransactionsList");?>" >
			<span class="links_name" style="margin-left:55px;">Transactions List </span>
			</a>
		 </li>
	</div>  
		
	  <li>
			<a href="<?php echo base_url("logout");?>" >
			<i class="bx bx-log-out"></i>
			<span class="links_name">Log Out</span>
			</a>
	  </li> 
	
	  </ul>
</div>
<!--<section class="home-section">
	<nav>
		<div class="sidebar-button">
			<i class="bx bx-menu sidebarBtn"></i>
			<span class="dashboard">Dashboard</span>
		</div>
		<div class="search-box">
			<input type="text" placeholder="Search Something...">
			<i class="bx bx-search"></i>
		</div>
		<div class="profile">
			<span class="admin_name"><b>Username: </b><?php echo implode(" ",$ShowUsername); ?></span>
		</div>
	</nav>
	<div class="navbar" id="myNavbar"> 
		<a href="#home"> 
			<i class="fas fa-home icon"></i>Home 
		</a> 
		<a href="#courses"> 
			<i class="fas fa-graduation-cap icon"></i>Courses 
		</a> 
		<a href="javascript:void(0);" class="icon"
			onclick="myFunc()"> 
			<i class="fas fa-bars"></i> 
		</a> 
	</div>
	
</section> -->

<div class="card-div">
	<section class="page-contain">
			
  <a href="#" class="data-card">
    <h3>50</h3>
    <h4>Total Vouchers</h4>
    <span class="link-text">
      View All
      <svg width="25" height="16" viewBox="0 0 25 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M17.8631 0.929124L24.2271 7.29308C24.6176 7.68361 24.6176 8.31677 24.2271 8.7073L17.8631 15.0713C17.4726 15.4618 16.8394 15.4618 16.4489 15.0713C16.0584 14.6807 16.0584 14.0476 16.4489 13.657L21.1058 9.00019H0.47998V7.00019H21.1058L16.4489 2.34334C16.0584 1.95281 16.0584 1.31965 16.4489 0.929124C16.8394 0.538599 17.4726 0.538599 17.8631 0.929124Z" fill="#0A2558"/>
</svg>
    </span>
  </a>
  <a href="#" class="data-card">
    <h3>30</h3>
    <h4>Issued Vouchers</h4>
    <span class="link-text">
      View All
      <svg width="25" height="16" viewBox="0 0 25 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M17.8631 0.929124L24.2271 7.29308C24.6176 7.68361 24.6176 8.31677 24.2271 8.7073L17.8631 15.0713C17.4726 15.4618 16.8394 15.4618 16.4489 15.0713C16.0584 14.6807 16.0584 14.0476 16.4489 13.657L21.1058 9.00019H0.47998V7.00019H21.1058L16.4489 2.34334C16.0584 1.95281 16.0584 1.31965 16.4489 0.929124C16.8394 0.538599 17.4726 0.538599 17.8631 0.929124Z" fill="#0A2558"/>
</svg>
    </span>
  </a>
  <a href="#" class="data-card">
    <h3>10</h3>
    <h4>Available Vouchers</h4>
    <span class="link-text">
      View All
      <svg width="25" height="16" viewBox="0 0 25 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M17.8631 0.929124L24.2271 7.29308C24.6176 7.68361 24.6176 8.31677 24.2271 8.7073L17.8631 15.0713C17.4726 15.4618 16.8394 15.4618 16.4489 15.0713C16.0584 14.6807 16.0584 14.0476 16.4489 13.657L21.1058 9.00019H0.47998V7.00019H21.1058L16.4489 2.34334C16.0584 1.95281 16.0584 1.31965 16.4489 0.929124C16.8394 0.538599 17.4726 0.538599 17.8631 0.929124Z" fill="#0A2558"/>
</svg>
    </span>
  </a>
  <a href="#" class="data-card">
    <h3>10</h3>
    <h4>Redeemed Vouchers</h4>
    <span class="link-text">
      View All
      <svg width="25" height="16" viewBox="0 0 25 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M17.8631 0.929124L24.2271 7.29308C24.6176 7.68361 24.6176 8.31677 24.2271 8.7073L17.8631 15.0713C17.4726 15.4618 16.8394 15.4618 16.4489 15.0713C16.0584 14.6807 16.0584 14.0476 16.4489 13.657L21.1058 9.00019H0.47998V7.00019H21.1058L16.4489 2.34334C16.0584 1.95281 16.0584 1.31965 16.4489 0.929124C16.8394 0.538599 17.4726 0.538599 17.8631 0.929124Z" fill="#0A2558"/>
</svg>
    </span>
  </a>
</section>
	</div>   
	 
</body>
<script>
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>
<script> 
		function myFunc() { 
			var x = document.getElementById("myNavbar"); 
			if (x.className === "navbar") { 
				x.className += " responsive"; 
			} else { 
				x.className = "navbar"; 
			} 
		} 
	</script> 
</html>