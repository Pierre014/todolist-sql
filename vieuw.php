<?php
    require 'sqlconnect.php';
    

    $readTodo = readTodo($pdo,"SELECT task FROM todo WHERE do = 'NO'");
    
    $stmt2 = $pdo -> prepare("UPDATE todo SET do=:do WHERE task = :task");
    $datasave = readTodo($pdo,"SELECT task from todo WHERE do = 'YES'");

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Todo-List</title>
</head>
<body class="bg-blue-700">
    <h1>TODO LIST</h1>
    <section>
        <h2>Task to do</h2>
        <form action="index.php" method="get">
            <?php
                echo '<ul id= list>';
                        foreach($readTodo as $todo){
                            echo "<li><input type=checkbox"." name='".$todo['task']."' ".
                            "id='".$todo['task']."' "."value='".$todo['task']."'".">";
                            echo "<label for=".$todo['task'].">".$todo['task']."</label></li>";
                        }
                echo "</ul>";
            ?>
        <input type="submit" name="save"  id="save" value="save">
    </section>
        </form>
    <section id ="done">
            <h2>Task already do</h2>
            <form action="index.php" method="post">
            
                        <?php
                        echo "<ul>";
                            foreach($datasave as $done){
                                echo "<input type=submit name='".$done['task']."'"."value=X>";
                                echo "<input type=checkbox"." name='".$done['task']."'".
                                "id='"."do_".$done['task']."'"."checked "."disabled "."value='".$done['task']."'".">";
                                echo "<label for=".$done['task'].">".$done['task']."</label><br>";
                            }
                        echo "</ul>";
                        ?>
            </form>
    </section>