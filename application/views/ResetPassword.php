<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<link href="<?= base_url('assets/dist/css/bootstrap5.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/dist/css/dashboard.css') ?>" rel="stylesheet">
<!-- Include Toastr -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <style>
        /* Ensure carousel images fit properly */
        .carousel-item img {
            height: 100vh;
            object-fit: cover;
        }

        /* Adjust login section for centering */
        .login-section {
            height: 100vh;
        }
		
		    
		@keyframes vibrate {
			0%, 100% { transform: translateX(0); }
			25%, 75% { transform: translateX(-5px); }
			100% { transform: translateX(5px); }
		}
		.toast { animation: vibrate 3s ease-in-out; }
    </style>
</head>
<body>
<?php //print_r($MasjidsData);die(); ?>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="row w-100">
            <!-- Carousel Section -->
            <div class="col-lg-7 col-12 p-0">
                <div id="masjidCarousel" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner">
						<?php if (!empty($MasjidsData)) : ?>
							<?php foreach ($MasjidsData as $index => $masjid) : ?>
								<div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
									<img src="<?= base_url(ltrim($masjid['profile_picture'], './')) ?>" class="d-block w-100" alt="">
									<div class="carousel-caption d-none d-md-block">
										<h5><?= htmlspecialchars($masjid['masjid_name']) ?></h5>
									</div>
								</div>
							<?php endforeach; ?>
						<?php else : ?>
							<p>No Masjid images found.</p>
						<?php endif; ?>
					</div>
					<a class="carousel-control-prev" href="#masjidCarousel" role="button" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</a>
					<a class="carousel-control-next" href="#masjidCarousel" role="button" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</a>
				</div>
            </div>

            <!-- Login Form Section -->
            <div class="col-lg-5 col-12 d-flex flex-column justify-content-center align-items-center bg-light ">
                <div class="container py-5">
                    <div class="form-container">
                        <h2 class="text-center">WELCOME BACK</h2>
                        <h4 class="text-center mb-4" style="color:#065392;">Forget Your Password?</h4>
                        <form method="post" action="<?php echo base_url("update_password");?>">
						 <input type="hidden" name="token" value="<?php echo $token; ?>">
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control"  name="confirm_password" id="confirm_password" placeholder="Password" required>
                            </div>
                            <div class="d-grid mb-3">
								<button class="btn btn-custom" type="submit">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enable Bootstrap validation
        (() => {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
<script>
    $(document).ready(function() {
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "timeOut": 3000,
            "extendedTimeOut": 1000,
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        <?php if ($this->session->flashdata('error')): ?>
            toastr.error("<?= $this->session->flashdata('error'); ?>");
        <?php endif; ?>
    });
</script>
</body>
</html>
