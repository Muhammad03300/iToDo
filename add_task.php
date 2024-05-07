<?php
    include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Add Task</title>
</head>
<body background="task2.jpg">
<center>
<?php
$activePage = basename($_SERVER['PHP_SELF']);
?>

<!-- Include the navigation menu -->
<?php include('navbar.php'); ?>


    <form action="add_task.php" method="post"><br>
        <label>Priority Number</label><br>
        <input type="number" name="id"><br>
        <label for="taskdesc">Task Description</label><br>
        <textarea id="taskdesc" name="taskdesc" id="taskdesc" wrap="hard" rows="7" cols="40"></textarea><br>
        <button>Add Task</button>
    </form>

    <?php 
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $description = $_POST['taskdesc'];
            $completed = false;
            $id = $_POST['id'];

            // Check if the priority number (ID) already exists
            $check_sql = "SELECT * FROM `tasks` WHERE `id` = '$id'";
            $check_result = mysqli_query($conn, $check_sql);

            if(mysqli_num_rows($check_result) > 0){
                echo "<script>
                        alert('Priority number already exists. Please choose a different priority.');
                        </script>";
            }
            else{
                $sql = "INSERT INTO `tasks` (`id`, `description`, `completed`, `created_at`) VALUES ('$id','$description', '$completed', current_timestamp());";
                $result = mysqli_query($conn, $sql);

                if($result){
                    echo "<script>
                            alert('Task added successfully');
                            window.location.href = 'index.php';
                          </script>";
                }
                else{
                    echo "Can't insert";
                    $_SESSION['add_fail'] = "Failed to add task"; 
                }
            }
        }
    ?>
</center>
</body>
</html>
