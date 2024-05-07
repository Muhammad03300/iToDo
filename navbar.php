  <nav class="navbar">
  <ul class="navbar-list">
    <div class="navbar-logo">
      <a href="index.php"><h1>iToDo</h1></a>
    </div>
    <li><a href="index.php" <?php if ($activePage === 'index.php') echo 'class="active"'; ?>><h3>To-Do</h3></a></li>
    <li><a href="add_task.php" <?php if ($activePage === 'add_task.php') echo 'class="active"'; ?>><h3>Add Task</h3></a></li>
    <li><a href="completed_task.php" <?php if ($activePage === 'completed_task.php') echo 'class="active"'; ?>><h3>Completed Tasks</h3></a></li>
  </ul>
</nav>


<style>
    /* Navbar styles */
/* Navbar styles */
.navbar {
  background-color: #2c3e50;
  padding: 15px 0;
}

/* Navbar list styles */
.navbar-list {
  list-style-type: none;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: flex-end;
}

.navbar-list li {
  margin-left: 20px;
  margin-right: 10px;
}

/* Navbar link styles */
.navbar-list li a {
  text-decoration: none;
  color: #ecf0f1;
  font-size: 18px;
  transition: color 0.3s ease-in-out;
}

.navbar-list li a:hover {
  color: #3498db;
}

/* Active link styles */
.navbar-list li a.active {
  color: #e74c3c;
  font-weight: bold;
}

/* Heading styles */
.navbar-list li a h2 {
  margin: 0;
  font-size: 24px;
}
.navbar-logo {
  max-height: 40px; /* Adjust the height as needed */
  float: left;
  margin-right: 810px;
  color: white;
}
.navbar-logo a{
  text-decoration: none;
  color: white;
}
  
</style>