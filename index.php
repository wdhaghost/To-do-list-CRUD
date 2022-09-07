<?php
require_once "includes/_functions.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>To Do List</title>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1 class="main-title">To do</h1>
        </header>
        <main class="">
            <ul class="task-list">
            
                    <?php
                    $result=getTask($dbCo);
                    echo taskToHtml($result)?>
                
            </ul>
            <?php
                // echo "<pre>";
                // var_dump($result);
                // echo "</pre>";
            ?>
        </main>
        





    </div>
    
</body>
</html>