<!DOCTYPE html>
<html>
<head>
    <title>My To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <div class="header">
      <h1>My To-Do List</h1>
    </div>

    <form method="post" action="">
        <input type="text" name="task" placeholder="Enter task" required>
        <button type="submit" name="create">Add Task</button>
    </form>

    <div class="todo-list">
    <?php
    require_once 'functions.php';

    if (isset($_POST['create']) && !empty($_POST['task'])) {
        $task = $_POST['task'];
        createTodo($task);
        header("Location: index.php"); 
        exit();
    }

    if (isset($_GET['complete'])) {
        $id = $_GET['complete'];
        updateTodo($id, true);
        header("Location: index.php");
        exit();
    }

    if (isset($_GET['incomplete'])) {
        $id = $_GET['incomplete'];
        updateTodo($id, false);
        header("Location: index.php");
        exit();
    }


    // Handle Delete
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        deleteTodo($id);
        header("Location: index.php");
        exit();
    }

    // Read and Display To-Dos
    $todos = getAllTodos();

    if ($todos) {
        while ($row = $todos->fetch_assoc()) {
            $completedClass = $row['completed'] ? 'completed' : '';
            echo "<div class='todo-item'>";
            echo "<span class='task " . $completedClass . "'>" . htmlspecialchars($row['task']) . "</span>";  // Output the task

            echo "<div class='todo-actions'>";
            if ($row['completed']) {
                echo "<a href='?incomplete=" . $row['id'] . "'>Mark Incomplete</a> ";
            } else {
                echo "<a href='?complete=" . $row['id'] . "'>Mark Complete</a> ";
            }

            echo "<a href='?delete=" . $row['id'] . "'>Delete</a>";
            echo "</div>"; 

            echo "</div>"; 
        }
    } else {
        echo "<p>No tasks found.</p>";
    }

    closeDB();
    ?>
    </div> 

</div> 

</body>
</html>

foreach ($data as $index => $item) {
    echo "$index: $item\n";
}
?>
