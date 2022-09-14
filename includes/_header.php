<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css?<?=time()?>" rel="stylesheet">
    <link href="fontawesome-free-6.1.2-web/css/all.css" rel="stylesheet">
    <title><?=$title?></title>
</head>

<body>
    <div class="container">
        <header class="header">
            <h1 class="main-title"><?=$title?></h1>
            <nav class="main-nav">
                <ul id="main-nav-list" class="main-nav-list">
                <?php 
                echo getItmFromArray($items); ?>
                </ul>
                <button id="nav-burger" class="nav-burger"><i class="fa fa-bars" aria-hidden="true"></i></button>
                <button id="nav-arrow" class="nav-arrow"> <i class="fa fa-angle-right" aria-hidden="true"></i></button>
            </nav>
        </header>