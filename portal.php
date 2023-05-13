<!DOCTYPE html>
<html>
<head>
	<title>Registration Portal</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="get_course_description.php"></script>
</head>
<body>
    <header>
        <?php require_once 'header.php'; ?> 
        <div class="jumbotron text-center">
            <h1>Registration Portal</h1>
        </div>
    </header>
    <main class="container">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link" href="#courses_by_semester" aria-controls="courses_by_semester" data-toggle="tab">List of Courses by Semester</a></li>
            <li class="nav-item"><a class="nav-link active" href="#registered" aria-controls="registered" role="tab" data-toggle="tab">Enrolled Courses</a></li>
            <li class="nav-item"><a class="nav-link" href="#add" aria-controls="add" role="tab" data-toggle="tab">Add Courses</a></li>
            <li class="nav-item"><a class="nav-link" href="#delete" aria-controls="delete" role="tab" data-toggle="tab">Delete Courses</a></li>
        </ul>
        <section class="container">
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- List of Courses by Semester tab -->
            <div role="tabpanel" class="tab-pane" id="courses_by_semester">
                <h3>List of Courses by Semester</h3>
                <?php
                include_once('config.php');
                // Retrieve list of semesters from the database
                $sql = "SELECT * FROM semesters";
                $result = mysqli_query($conn, $sql);
                ?>
                <label for="semester"><b>Select Semester:</b></label>
                <select class="form-control" name="semester" id="semester" onchange="filterCoursesBySemester(this.value)">
                    <option value=""></option>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['semester_code']; ?></option>
                    <?php } ?>
                </select>
                </br>
                <div id="courses_list"></div>
                </br>
                <a href="courses.php" class="btn btn-primary">View All Courses</a>

                <script>
                    function filterCoursesBySemester(semesterId) {
                        $.ajax({
                            url: 'get_courses_by_semester.php',
                            method: 'POST',
                            data: { semesterId: semesterId },
                            success: function(response) {
                                $('#courses_list').html(response);
                            },
                            error: function() {
                                // Display an error toast message
                                $('#courses_list').html('<div class="toast" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header bg-danger text-white"><strong class="mr-auto">Error</strong></div><div class="toast-body">Error retrieving courses.</div></div>');
                                $('.toast').toast('show');
                            }
                        });
                    }
                </script>
            </div>
            <!-- Registered classes tab -->
            <div role="tabpanel" class="tab-pane active" id="registered">
                <h3>Enrolled Courses</h3>
                <?php
                    session_start();
                    include_once('config.php');
                    // Retrieve list of registered classes from the database
                    $student_id = $_SESSION['user_id'];
                    $sql = "SELECT c.course_code, c.course_name FROM registrations r JOIN courses c ON r.class_id = c.id WHERE r.student_id = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, 'i', $student_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    // Display list of registered classes
                    if (mysqli_num_rows($result) > 0) {
                        echo "<ul class='list-group'>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<li class='list-group-item'>" . $row['course_code'] . " - " . $row['course_name'] . "</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<p>No registered classes.</p>";
                    }
                ?>
            </div>
            <!-- Add tab -->
            <div role="tabpanel" class="tab-pane" id="add">
            <h3>Add Courses</h3>
            <form action="add.php" method="post">
                <div class="form-group">
                <?php
                    include_once('config.php');
                    // Retrieve list of available courses from the database
                    $sql = "SELECT id, course_code, course_name, course_description FROM courses";
                    $result = mysqli_query($conn, $sql);
                ?>
                <label for="student_id"><b>Student ID:</b></label>
                <input type="text" class="form-control" name="student_id" id="student_id" value="<?php echo $_SESSION['user_id']; ?>" readonly required>

                <label for="class_id"><b>Course Name:</b></label>
                <select class="form-control" name="class_id" id="class_id" required>
                    <option value="">Select a course</option>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['course_code'] . " - " . $row['course_name']; ?></option>
                    <?php } ?>
                </select>

                <label for="description"><b>Course Description:</b></label>
                <textarea class="form-control"id="description" readonly></textarea>
                <script>
                    $('#class_id').change(function() {
                        var course_id = $(this).val();
                        $.get('get_course_description.php?id=' + course_id, function(data) {
                            $('#description').html(data);
                        });
                    });
                </script>
                <br>
                <input type="submit" class="btn btn-primary" value="Add">
                </div>
            </form>
            </div>
            <!-- Delete tab -->
            <div role="tabpanel" class="tab-pane" id="delete">
                <h3>Delete Courses</h3>
                <form action="delete.php" method="post">
                    <div class="form-group">
                    <label for="student_id"><b>Student ID:</b></label>
                    <input type="text" class="form-control" name="student_id" id="student_id" value="<?php echo $_SESSION['user_id']; ?>" readonly required>

                    <label for="class_id"><b>Course:</b></label>
                    <?php
                        // Retrieve list of registered courses for the student from the database
                        $student_id = $_SESSION['user_id'];
                        $sql = "SELECT r.class_id, c.course_code, c.course_name FROM registrations r INNER JOIN courses c ON r.class_id = c.id WHERE r.student_id = ?";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, 'i', $student_id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                    ?>
                    <select class="form-control" name="class_id" id="class_id" required>
                        <option value="">Select a course</option>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?php echo $row['class_id']; ?>"><?php echo $row['course_code'] . " - " . $row['course_name']; ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <input type="submit" class="btn btn-primary" value="Delete">

                    </div>
                </form>
            </div>
        </div>
    </section>
    </main>
    <?php require_once 'footer.php'; ?>
</body>
</html>