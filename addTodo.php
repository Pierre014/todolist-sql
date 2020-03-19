<?php
    require 'sqlconnect.php';

    $stmt = $pdo -> prepare("INSERT INTO todo(task, do) VALUES(:task, 'NO')");

    if(isset($_POST['add'])){
        $task = $_POST['todo'];
        
        $sql= $stmt -> execute(array(
            ":task" => $task
        ));
        header('location:index.php');
    }
    
?>

<form action="index.php" method="post">

    <textarea name="todo" id="todo" row="5" col="10" placeholder="type your task here"></textarea><br>
    <input type="submit" name="add" id="add" value="add">

</form>

</body>
</html>
