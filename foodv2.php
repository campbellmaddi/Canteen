<?php
$con = mysqli_connect("localhost", "campbellma", "sillyland16", "campbellma_canteen");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}

if(isset($_GET['food'])){
    $id = $_GET['food'];
}else{
    $id = 1;
}

$this_foods_query = "SELECT FItem, FCost, FStock FROM food WHERE FoodID = '" . $id . "'";
$this_foods_result = mysqli_query($con, $this_foods_query);
$this_foods_record = mysqli_fetch_assoc($this_foods_result);

$all_foods_query = "SELECT FoodID, FItem FROM food";
$all_foods_result = mysqli_query($con, $all_foods_query);
?>



<!DOCTYPE html>

<html lang="en">

<head>
    <title> WGC Canteen </title>
    <meta charset="utf-8">
    <link rel='stylesheet' type='text/css' href='stylev1.css'>
</head>

<body>
<header>
    <h1> FOOD </h1>
    <nav>
        <ul>
            <li> <a href='indexv1.php'> HOME </a></li>
            <li> <a href='foodsv1.php'> FOOD </a></li>
            <li> <a href='drinksv1.php'> DRINKS </a></li>
            <li> <a href='specialsv1.php'> SPECIALS </a></li>
        </ul>
    </nav>

    <main>
        <!-WGC Logo->
        <div id="logo">
            <img <img src="https://wgc.school.nz/wp-content/uploads/2018/09/WGC_Logo_Transparent_RGB.png"
                      alt="W3Schools.com" width="200" height="200">
        </div>

        <h2> Food Information </h2>

        <?php

            echo "<p> Item Name: " . $this_foods_record['FItem'] . "<br>";
            echo "<p> Cost: " . $this_foods_record['FCost'] . "<br>";
            echo "<p> Stock: " . $this_foods_record['FStock'] . "<br>";
        ?>

        <h2> See another item </h2>
        <!--Food form-->
        <form name='foods_form' id='foods_form' method ='get' action ='foodsv1.php'>
            <select id='food' name='food'>
                <!--options-->
                <?php
                while($all_foods_record = mysqli_fetch_assoc($all_foods_result)){
                    echo "<option value = '". $all_foods_record['FoodID'] . "'>";
                    echo $all_foods_record['FItem'];
                    echo "</option>";
                }

                ?>

            </select>

            <input type='submit' name='food_button' value='GO'>
        </form>

        <h2> Search an item </h2>

        <form action="" method="post">
            <input type="text" name='search'>
            <input type="submit" name="submit" value="Search">
        </form>

        <?php

        if(isset($_POST['search'])) {
            $search = $_POST['search'];

            $query1 = "SELECT * FROM food WHERE FItem LIKE '%$search%'";
            $query = mysqli_query($con, $query1);
            $count = mysqli_num_rows($query);

            if($count == 0) {
                echo "<p>"."There was no search results!";

            }else{

                while ($row = mysqli_fetch_array($query)) {

                    echo "<p>".$row ['FItem'];
                    echo "<br>";

                }
            }
        }
        ?>



</header>
