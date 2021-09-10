<?php
$con = mysqli_connect("localhost", "campbellma", "sillyland16", "campbellma_canteen");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}

if(isset($_GET['drink'])){
    $id = $_GET['drink'];
}else{
    $id = 1;
}
$this_drinks_query = "SELECT DItem, DCost, DStock FROM drinks WHERE DrinkID = '" . $id . "'";
$this_drinks_result = mysqli_query($con, $this_drinks_query);
$this_drinks_record = mysqli_fetch_assoc($this_drinks_result);

$all_drinks_query = "SELECT DrinkID, DItem FROM drinks";
$all_drinks_result = mysqli_query($con, $all_drinks_query)?>

<!DOCTYPE html>

<html lang="en">

<head>
    <title> WGC Canteen </title>
    <meta charset="utf-8">
    <link rel='stylesheet' type='text/css' href='stylev1.css'>
</head>

<body>
<header>
    <h1> DRINKS </h1>
    <nav>
        <ul>
            <li> <a href='indexv1.php'> HOME </a></li>
            <li> <a href='foodsv1.php'> FOOD </a></li>
            <li> <a href='drinksv1.php'> DRINKS </a></li>
            <li> <a href='specialsv1.php'> SPECIALS </a></li>
        </ul>
    </nav>

    <main>
        <h2> Drinks Information </h2>
        <?php

        echo "<p> Drink Name: " . $this_drinks_record['DItem'] . "<br>";
        echo "<p> Cost: " . $this_drinks_record['DCost'] . "<br>";
        echo "<p> Stock: " . $this_drinks_record['DStock'] . "<br>";
        ?>

        <h2> See another drink </h2>
        <!--Drinks form-->
        <form name='drinks_form' id='drinks_form' method ='get' action ='drinksv1.php'>
            <select id='drink' name='drink'>
                <!--options-->
                <?php
                while($all_drinks_record = mysqli_fetch_assoc($all_drinks_result)){
                    echo "<option value = '". $all_drinks_record['DrinkID'] . "'>";
                    echo $all_drinks_record['DItem'];
                    echo "</option>";
                }

                ?>

            </select>

            <input type='submit' name='drinks_button' value='GO'>
        </form>





</header>
