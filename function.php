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