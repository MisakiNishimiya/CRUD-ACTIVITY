<?php

require_once 'db.php';


function createTodo($task) {
    global $conn;
    $task = mysqli_real_escape_string($conn, htmlspecialchars($task)); 

    $sql = "INSERT INTO todos (task) VALUES ('$task')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}


function getAllTodos() {
    global $conn;
    $sql = "SELECT * FROM todos ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}


function updateTodo($id, $completed) {
    global $conn;
    $id = (int)$id; 
    $completed = (bool)$completed; 
    $sql = "UPDATE todos SET completed = '$completed' WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error updating record: " . $conn->error;
        return false;
    }
}


function deleteTodo($id) {
    global $conn;
    $id = (int)$id; 
    $sql = "DELETE FROM todos WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error deleting record: " . $conn->error;
        return false;
    }
}


function closeDB() {
  global $conn;
  $conn->close();
}
?>
