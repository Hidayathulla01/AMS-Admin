<html>
<head>
		<title>Dashboard</title>
       <!-- <link rel="stylesheet" href="style.css">-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
		<link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />
</head>
<style>
	*{
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		font-family: "poppins",sans-serif;
	}
	body{
		min-height: 100vh;
		width: 100%;
	}
	html {
	  scroll-behavior: smooth;
	}
	/* sidebar start*/
	.sidebar{
		z-index: 10;
		position: fixed;
		/*margin-right:0; */
		height: 100%;
		width: 15%;
		background: #0A2558;
		transition: all 0.5s ease;
	}
	.sidebar.active{
		width: 60px;
	}
	.sidebar .logo-details{
		height: 80px;
		display: flex;
		align-items: center;
	}
	.sidebar .logo-details i{
		font-size: 28px;
		font-weight: 500;
		color: #fff;		
		min-width: 60px;
		text-align: center;
	}
	.sidebar .logo-details .logo_name{
		color: #fff;
		font-size: 24px;
		font-weight: 500;
	}
	/*
	.sidebar .nav-link{
		margin-top:-45px;
	}*/
	.sidebar .nav-link li{
		position: relative;
		height: 50px;
		list-style: none;
	}
	.sidebar .nav-link li a{
		height: 100%;
		width: 100%;
		display: flex;
		align-items: center;
		text-decoration: none;
		transition: all 0.4s ease;
	}
	.sidebar .nav-link li a.active{		   
		background: #53668A;							
	}
	.sidebar .nav-link li a:hover{
		background: #53668A;
	}
	.sidebar .nav-link li  i{				 
		min-width: 60px;
		text-align: center;
		color: #fff;
		font-size: 18px;			  
	}
	.sidebar .nav-link li a .links_name{
		color: #fff;
		font-size: 15px;
		font-weight: 400;
		white-space: nowrap;			  
	}
	.sidebar .nav-link .log_out{
		position: absolute;		
		bottom: 0;			
		width: 100%;
	}
	.home-section{
		background: #f5f5f5;
		position: relative;
		min-height: 100hv;
		width: calc(100% - 240px);
		left: 240px;
		transition: all 0.5s ease;
	}
	
	/* sidebar end*/
	/* navbar start*/
	.home-section nav{
		display: flex;
		justify-content: space-between;
		height: 80px;
		background: #fff;
		align-items: center;
		position: fixed;
		width: calc(100% - 240px);		
		padding: 0 20px;
		box-shadow: 0 1px 1px rgba(0,0,0,0.1);
		transition: all 0.5s ease;
	}
	.sidebar.active ~ .home-section nav{
		width: calc(100% - 60px);
		left: 60px;
	}
	.home-section nav .sidebar-button{
		display: flex;
		align-items: center;
		font-size: 24px;
		font-weight: 500;		
	}
	nav .sidebar-button i{
		font-size: 35px;
		margin-right: 10px;
	}
	.home-section nav .search-box{
		height: 50px;
		max-width: 550px;
		margin: 0 20px;
		position: relative;
		width: 100%;
	}
	nav .search-box input{
		height: 100%;
		width: 100%;
		border-radius: 6px;
		padding: 0 15px;
		font-size: 18px;
		color: #fff;
		background: #F5F6FA;
		border: 2px solid #EFEEF1;
		outline: none;
	}  
	nav .search-box .bx-search{
		position: absolute;
		right: 5px;
		top: 50%;
		transform: translateY(-50%);		
		height: 40px;
		width: 40px;
		background: #2697FF;
		border-radius: 6px;
		color: #fff;
		font-size: 22px;
		text-align: center;
		line-height: 40px;
		transition: all 0.4 ease;
	}
	.home-section nav .profile{
		display: flex;
		align-items: center;
		height: 50px;
		min-width: 190px;
		background: #F5F6FA;
		border: 2px solid #EFEEF1;
		border-radius: 6px;
		padding: 0 15px 0 2px;
	}
	nav .profile .admin_name{
		font-size: 15px;
		font-weight: 500;
		color: #333;
		margin: 0 10px;
		white-space: nowrap;
	}
	nav .profile i{
		color: #333;
		font-size: 25px; 
	}	
	/* navbar end*/
	
	/ Responsive Media Query  /
	@media (max-width: 1240px){
		.sidebar{
			width: 60px;
		}
		.sidebar.active{
			width: 220px;
		}
		.home-section{
			width: calc(100% - 60px);
			left: 60px;
		}
		.sidebar.active ~ .home-section{
			width: calc(100% - 220px);
			left: 220px;
		}
		.home-section nav{
			width: calc(100% - 60px);
			left: 60px;
		}
		.sidebar.active ~ .home-section nav{
			width: calc(100% - 220px); 
			overflow: hidden;
			left: 220px;
		}
	}
	
	.sidenav a, .report  {
  padding: 6px 8px 4px 16px;
  font-size: 15px;
  display: block;
  width:107%;
  text-align: left;
  margin-left: -20px;
  cursor: pointer;
}

.sidenav a, .report:hover{
		background: #53668A;
}

.dropdown-container {
  display: none;
  background-color: #fffff;
  padding-left: 15px;
  font-size:15px;
  margin-left: -15px;
}
</style>
<body>
<?php 
	$userData = $this->session->userdata('user_data');
	$username = $userData['user_id'];
		
	$sql = "SELECT * FROM tb_user_access WHERE user_id =  '".$username."'";
	$qry = $this->db->query($sql);
	$result = $qry->result_array();
		//print_r($result);
		//die();
	foreach($result as $row){
		$GetId = $row['beneficiary_management'];
		$GetId1 = $row['masjid_management'];
		$GetId2 = $row['vouchers_management'];
		$GetId3 = $row['vendors_management'];
		$GetId4 = $row['users_management'];
	}
	?>
	
	<div class="sidebar">
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
		<a href="<?php echo base_url("TransactionsList");?>">
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
</body>
<script>
var dropdown = document.getElementsByClassName("report");
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
</html>