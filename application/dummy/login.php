<!-- login.php -->

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>User Login</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<!--  include css file :  -->
 <?php echo link_tag(base_url('assets/css/login_css.css')); ?>

</head>
<style>
.error_message {
    color: red;
    font-size: 20px;
}
.password-container {
    position: relative;
}

#togglePassword {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
}
</style>
<body>
<div class="signup-form">
		<h2>Login</h2>
		<p class="hint-text">Sign in to start your session</p>
            <!-- Login form -->
		<form method="post" action="<?php echo base_url("AdminLogin/login");?>">
			<div class="form-group">
				<label for="username"><b>User Id</b></label>
				<input type="text" class="form-control" id="username" name="username" value="<?= set_value('username', isset($username) ? $username : '') ?>" placeholder="User Id">
				<b><?php echo form_error('username', '<div class="error_message">', '</div>'); ?></b>
			</div>
			
			<div class="form-group">
				<label for="password"><b>Password</b></label>
				<div class="password-container">
					<input type="password" class="form-control" id="password" name="password" value="<?= set_value('password', isset($password) ? $password : '') ?>" placeholder="Password">
					<i class="fa fa-eye" id="togglePassword"></i>	
				</div>
				<b><?php echo form_error('password', '<div class="error_message">', '</div>'); ?></b>
			</div>
			<div class="form-group" id="masjid_div">
				<label for="masjid_id"><b>Masjid Name</b></label><br>
				<select class="form-control" name="masjid_id" id="masjid_id" >
					<option value="">Select Masjid</option>
					<?php 
						$Masjid_info = $this->db->select('masjid_name,masjid_id')
											->from('tb_masjids')
											->where('status','1')
											->order_by('masjid_name','ASC')
											->get();
						$Masjid_Rslt = $Masjid_info->result_array();
						foreach($Masjid_Rslt as $row){												
							$masjid_name = trim($row['masjid_name']);
							$masjid_id = trim($row['masjid_id']);
							$selected = set_select('masjid_id', $masjid_id);
							echo'<option value="'.$masjid_id.'">'.$masjid_name.'</option>';
						}/**/
					?>
				</select>
				<b><?php echo form_error('masjid_id', '<div class="error_message">', '</div>'); ?></b>
			</div><br>
			<center><button type="submit" name="submit" class="btn btn-primary custom-button"> Login</button></center><br>
			<center>
				<b>
					<?php
						if ($this->session->flashdata('error')) {
							echo '<div class="error_message">' . $this->session->flashdata('error') . '</div>';
						}
					?>
				</b>
			</center>

		</form>
</div>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
	$("#username").change(function(){
	  if($(this).val() == "admin"){
		  $("#masjid_div").hide();	  
	  }else{
	      $("#masjid_div").show();
	  }
 });
 
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $("#togglePassword").click(function() {
        const passwordInput = $("#password");
        const icon = $(this);

        // Toggle password visibility
        if (passwordInput.attr("type") === "password") {
            passwordInput.attr("type", "text");
            icon.removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            passwordInput.attr("type", "password");
            icon.removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
});
</script>
</html>
