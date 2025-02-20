<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Signin Template</title>

    
<!-- Custom styles for this template -->
    
	 <?php echo link_tag(base_url('assets/dist/css/style.css')); ?>    
    <!-- Bootstrap core CSS -->
 <?php echo link_tag(base_url('assets/dist/css/bootstrap.min.css')); ?>    
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>   
  </head>
<body class="text-center" style="padding-top:20%;">    
	<main class="form-signin">
	  <form method="post" action="<?php echo base_url("AdminLogin/login");?>">		
		<h1 class="h3 mb-3 fw-normal">Please sign in</h1>	
		<?php 
		if ($this->session->flashdata('Invalid')): ?>
			<div class="alert alert-danger" id="flash-message" role="alert">
				<?php echo $this->session->flashdata('Invalid'); ?>
			</div>
		<?php endif; 
			if ($this->session->flashdata('error')): ?>
			<div class="alert alert-danger" role="alert">
				<?php echo $this->session->flashdata('error'); ?>
			</div>
		<?php endif; ?>
		<div class="form-floating">		  
		   <input type="email" class="form-control" id="floatingPassword" name="email" value="<?= set_value('email', isset($email) ? $email : '') ?>" placeholder="Password"> 
		   <label for="floatingPassword">Email</label>
		</div><br>
		<div class="form-floating">		  
		   <input type="password" class="form-control" id="floatingPassword" name="password" value="<?= set_value('password', isset($password) ? $password : '') ?>" placeholder="Password"> 
		   <label for="floatingPassword">Password</label>
			<i class="fa fa-eye" id="togglePassword"></i>		  
		</div>
		<button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
	  </form>
	</main>  

<script>
    function isValidEmail(email) {
        // Basic email validation regex
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
setTimeout(function() {
    document.querySelector('.alert').remove();
}, 2000);

</script>	
</body>

</html>
