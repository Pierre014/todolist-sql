<?php
    require 'sqlconnect.php';

    $stmt = $pdo -> prepare("INSERT INTO todo(task, do) VALUES(:task, 'NO')");
    if(isset($_POST['add'])){
        $task = $_POST['todo'];
        $sanitized_task = filter_var($task, FILTER_SANITIZE_STRING);
        $sanitized_task = trim($sanitized_task);
        if($sanitized_task){
        $sql= $stmt -> execute(array(
            ":task" => $sanitized_task
        ));
        }
    }
    
?>

<form action="index.php" method="post">

    <textarea name="todo" id="todo"  placeholder="type your task here"></textarea><br>
    <input class="button" type="submit" name="add" id="add" value="add">

</form>


<input class="button" type="search" name="search" id="search" placeholder="search words">

</div>
<script src="script.js"></script>
</body>
</html>
