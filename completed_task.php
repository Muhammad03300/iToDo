 <?php 
    include 'config.php';
    
    // Handle marking task as completed
    if(isset($_GET['complete']) && is_numeric($_GET['complete'])) {
        $taskId = $_GET['complete'];
        
        // Update the task status in the database
        $updateSql = "UPDATE tasks SET completed = 1 WHERE id = $taskId";
        mysqli_query($conn, $updateSql);
    }

    // Handle marking task as uncompleted (undo)
    if(isset($_GET['undo']) && is_numeric($_GET['undo'])) {
        $taskId = $_GET['undo'];
        
        // Update the task status in the database
        $updateSql = "UPDATE tasks SET completed = 0 WHERE id = $taskId";
        mysqli_query($conn, $updateSql);
    }

    // Handle deleting a task
    if(isset($_GET['delete']) && is_numeric($_GET['delete'])) {
        $taskId = $_GET['delete'];

        // Display JavaScript alert for confirmation
        echo "<script>
                var confirmDelete = confirm('Do you want to delete this task?');
                if (confirmDelete) {
                    window.location.href = 'completed_task.php?confirm_delete=' + $taskId;
                }
              </script>";
    }

    // Handle deleting a task after user confirmation
    if(isset($_GET['confirm_delete']) && is_numeric($_GET['confirm_delete'])) {
        $taskId = $_GET['confirm_delete'];
        
        // Delete the task from the database
        $deleteSql = "DELETE FROM tasks WHERE id = $taskId";
        mysqli_query($conn, $deleteSql);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do</title>
    <link rel="stylesheet" href="style.css">
</head>
<body background="task3.jpg">
<center>
    
<?php
$activePage = basename($_SERVER['PHP_SELF']);
?>

<!-- Include the navigation menu -->
<?php include('navbar.php'); ?>


<table border="1">
    <tr>
    <th>S.No</th>
    <th>Description</th>
    <th>Created At</th>
    <th>Action</th>
    
</tr>

<?php
    $sql = "SELECT * FROM `tasks` WHERE completed = 1"; // Display tasks where completed is 1
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>
        <th scope='row'>". $row['id']. "</th>
        <td>";
        
        // If description has more than two lines, display a "Preview" button
        $descriptionLines = explode("\n", $row['description']);
        if (count($descriptionLines) > 2) {
            echo nl2br(implode("\n", array_slice($descriptionLines, 0, 2)));
            echo "<br><button onclick=\"showFullDescription('desc$row[id]')\" class='button3'>Preview</button>";
            echo "<div id=\"desc$row[id]\" style=\"display: none;\">". nl2br($row['description']) ."</div>";
        } else {
            echo nl2br($row['description']);
        }

        echo "</td>
        <td>". $row['created_at']. "</td>
        <td>
            <a href='completed_task.php?delete=".$row['id']."' class='bton'>Delete</a>
            <a href='completed_task.php?undo=".$row['id']."' onclick='return confirmUndo()' class='bton'>Undo</a>
        </td>
        </tr>";
    }
    
?>

</table>
<style>

.bton {
    display: inline-block;
    padding: 6px 12px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 4px;
    text-align: center;
    text-decoration: none;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.bton:hover {
    background-color: #45a049;
}
</style>



<script>
function showFullDescription(id) {
    var description = document.getElementById(id);
    if (description.style.display === "none") {
        description.style.display = "block";
    } else {
        description.style.display = "none";
    }
}

function confirmUndo() {
    return confirm('Do you want to undo this task?');
}
</script>

</center>
</body>
</html>
