<header>
    <?php require_once 'header.php'; ?>
    <div class="jumbotron text-center">
        <h1>Available Courses</h1>
        <a href="portal.php#add" class="btn btn-primary">Add Courses</a>
    </div>
    <style>
        .h3, h3 {
            color: #0077f7;
        }
    </style>
</header>
<div class="container-fluid">
    <?php
        include_once('config.php');

        // Retrieve list of courses and their associated semesters from the database
        $sql = "SELECT c.*, s.semester_code 
        FROM courses c 
        LEFT JOIN semesters s ON c.semester_id = s.id
        ORDER BY 
          CASE s.semester_code
            WHEN 'Summer 2023' THEN 1
            WHEN 'Fall 2023' THEN 2
            WHEN 'Spring 2024' THEN 3
            ELSE 4
          END, s.semester_code ASC";
        $result = mysqli_query($conn, $sql);

        // Display list of courses grouped by semester
        if (mysqli_num_rows($result) > 0) {
            $currentSemester = '';
            echo "<div class='row'>";
            while ($row = mysqli_fetch_assoc($result)) {
                $semester = $row['semester_code'];

                // Display the semester heading if it's different from the previous course
                if ($semester !== $currentSemester) {
                    if ($currentSemester !== '') {
                        echo "</div>"; // Close the previous semester's card group
                    }
                    echo "<div class='col-md-12'>";
                    echo "<h3>" . $semester . "</h3>";
                    echo "</div>";
                    echo "<div class='row'>";
                    $currentSemester = $semester;
                }

                echo "<div class='col-md-4'>";
                echo "<div class='card mb-3'>";
                echo "<div class='card-body'>";
                echo "<h4 class='card-title'>" . $row['course_name'] . "</h4>";
                echo "<p class='card-text'><strong>Course Code:</strong> " . $row['course_code'] . "</p>";
                echo "<p class='card-text'><strong>Instructor:</strong> " . $row['course_instructor'] . "</p>";
                echo "<p class='card-text'><strong>Start Date:</strong> " . $row['course_start_date'] . "</p>";
                echo "<p class='card-text'><strong>End Date:</strong> " . $row['course_end_date'] . "</p>";
                echo "<p class='card-text'><strong>Capacity:</strong> " . $row['course_capacity'] . "</p>";
                echo "<p class='card-text'><strong>Description:</strong> " . $row['course_description'] . "</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>"; // Close the last semester's card group
        } else {
            echo "<p>No courses available.</p>";
        }

        mysqli_close($conn);
    ?>
</div>
<?php require_once 'footer.php'; ?>