<?php
	error_reporting(E_ALL ^ E_NOTICE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/style.css">	
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>  
    <script>
        $(document).ready(function() {
        // Get the target tab ID from the URL anchor
        var targetTab = window.location.hash.substring(1);

        // Check if the target tab exists
        if ($('#' + targetTab).length > 0) {
            // Remove the 'active' class from all tab links
            $('.nav-link').removeClass('active');

            // Add the 'active' class to the target tab link
            $('a[href="#' + targetTab + '"]').addClass('active');

            // Show the target tab content
            $('.tab-pane').removeClass('show active');
            $('#' + targetTab).addClass('show active');
        }
        });
    </script>
</head>
<body>
	<?php
		session_start();
		if (isset($_SESSION['user_id'])) {
			$userName = $_SESSION['username'];
			
			echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="#">Online Learning Platform</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbar-collapse">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="index.php?logout-submit=logout">Logout</a></li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<span class="navbar-text pr-3">Hello, ' . $userName . '</span>
					</li>
				</ul>
			</div>
		</nav>';
		} else {
			echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
				<a class="navbar-brand" href="#">Online Learning Platform</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbar-collapse">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
						<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
						<li class="nav-item"><a class="nav-link" href="new_user.php">New User?</a></li>
					</ul>
				</div>
			</nav>';
		}
	?>
</body>
</html>