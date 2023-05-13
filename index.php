<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Landing Page</title>
</head>
<body>
	<header>
        <?php require_once 'header.php'; ?> 
		<div class="jumbotron text-center">
			<h1>Welcome to our Online Learning Platform</h1>
		</div>
	</header>
	<main class="container-fluid">
		<section class="container">
			<h2>About Our Platform</h2>
			<p>Welcome to our student portal! Our platform is designed to provide students with easy access to course information and academic resources. We aim to simplify the process of registering for courses and tracking your academic progress. Our user-friendly interface allows you to easily view and register for available courses, view course descriptions, and manage your course schedule. Our team is dedicated to providing you with a seamless and enjoyable experience throughout your academic journey. Thank you for choosing our student portal as your go-to resource for all things related to your education.</p>
			<a href="portal.php" class="btn btn-primary btn-lg">Get Started</a>
		</section>
        <section class="container"></br></section>
		<section class="container">
            <div class="row">
                <div class="col-md-12">
                <h3>Available Classes</h3>
                <div class="list-group">
                    <?php
                    session_start();
                    include_once('config.php');

                    // Check if the user is logged in, otherwise redirect to login page
                    if (!isset($_SESSION['user_id'])) {
                        // Redirect the user to the login page
                        header("Location: login.php");
                        exit();
                    }                        
                    $currentDate = date('Y-m-d');
                    $sql = "SELECT * FROM courses WHERE course_capacity > 0 AND course_end_date >= '$currentDate' LIMIT 4";
                    $result = mysqli_query($conn, $sql);                    

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="card mb-3">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . $row['course_name'] . '</h5>';
                            echo '<p class="card-text">' . $row['course_description'] . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No courses available.</p>';
                    }                    

                    mysqli_close($conn);
                    ?>
                </div>
                </br>
                <a href="courses.php" class="btn btn-primary btn-lg">View All Courses</a>
                </div>
            </div>
		</section>
	</main>
    <?php require_once 'footer.php'; ?>
</body>
</html>