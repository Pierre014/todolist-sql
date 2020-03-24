<?php

    require 'sqlconnect.php';

    function dump($tab){
        echo '<pre>';
        var_dump($tab);
        echo '</pre>';
    }

    function readTodo($pdo,$mysqlExpression){
        $stmt = $pdo->prepare($mysqlExpression);
        $stmt -> execute();
        return $stmt -> fetchALL(PDO::FETCH_ASSOC);
    }

    function delete($pdo,$condi){
        $stmt = $pdo -> prepare("DELETE FROM todo WHERE $condi");
        $stmt -> execute();
        header('location:index.php');
        
    }

    function vieuwListDo($tableau){
        echo '<ul id= list>';
            foreach($tableau as $todo){
                echo "<li><input type=checkbox"." name='".$todo['task']."' ".
                    "id='".$todo['task']."' "."value='".$todo['task']."'".">";
                    echo "<label id ='label".$todo['task']."' "."
                    for='".$todo['task']."' ".">".$todo['task']."</label></li>";
            }
        echo "</ul>";
    }

    function vieuwListDone($tableau){
        foreach($tableau as $done){
            echo "<input type=submit name='".$done['task']."'"." value=X>";
            echo "<input type=checkbox"." name='".$done['task']."' ".
            " id='"."do_".$done['task']."' "."checked "."disabled "."value='".$done['task']."'".">";
            echo "<label for= do_".$done['task'].">".$done['task']."</label><br>";
        }
    }