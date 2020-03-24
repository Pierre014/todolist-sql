<?php
    require 'sqlconnect.php';
    

    $readTodo = readTodo($pdo,"SELECT task FROM todo WHERE do = 'NO'");
    $readTodoSort = readTodo($pdo,"SELECT task FROM todo WHERE do = 'NO' ORDER BY task ASC ");
    $stmt2 = $pdo -> prepare("UPDATE todo SET do=:do WHERE task = :task");
    $dataSave = readTodo($pdo,"SELECT task from todo WHERE do = 'YES'");

    if(isset($_GET['save'])){
        $req = $_GET;
        foreach($req as $ex){
            if($ex!="save"){
                $stmt2 -> execute(array(
                    ":do"=>"YES",
                    ":task"=>$ex
                ));
                array_push($datasave,$ex);
            }
        }
        header('location:index.php');
    }
    if(isset($_POST)){
        $del = $_POST;
        foreach($del as $key => $value){
            $key = str_replace("_"," ",$key);
            dump($key);
            delete($pdo,"task = '$key'");
        }
    }

?>

<!DOCTYPE html>
<!--created by Pierre Lorand-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Todo-List</title>
</head>
<body>
    <h1>TODO LIST</h1>
    <section class="section">
        <h2>Task to do</h2>
        <form action="index.php" method="get">
            <?php
            if(isset($_GET['sort'])){
                vieuwListDo($readTodoSort);
            }else{
                vieuwListDo($readTodo);
            }
            ?>
        <input type="submit" name="save"  id="save" value="save">
        <input type="submit" name='sort' id= 'sort' value='sort'>
        </form>
    </section>

    <section class="section" id ="done">
            <h2>Task already do</h2>
            <form action="index.php" method="post">
            
                        <?php
                        
                            vieuwListDone($dataSave)
                       
                        ?>
            </form>
    </section>