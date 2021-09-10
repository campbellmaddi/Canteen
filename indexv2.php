<?php
$con = mysqli_connect("localhost", "campbellma", "sillyland16", "campbellma_canteen");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}

/* Food Query */
$all_foods_query = "SELECT FoodID, FItem FROM food";
$all_foods_result = mysqli_query($con, $all_foods_query);

/* Drinks Query */
$all_drinks_query = "SELECT DrinkID, DItem FROM drinks";
$all_drinks_result = mysqli_query($con, $all_drinks_query)
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
    <h1> WGC CANTEEN </h1>
    <nav>
        <ul>
            <li> <a href='index1.php'> HOME </a></li>
            <li> <a href='foodsv1.php'> FOOD </a></li>
            <li> <a href='drinksv1.php'> DRINKS </a></li>
            <li> <a href='specialsv1.php'> SPECIALS </a></li>
        </ul>
    </nav>

    <main>
        <!-WGC Logo->
        <div id="logo">
            <img <img src="https://wgc.school.nz/wp-content/uploads/2018/09/WGC_Logo_Transparent_RGB.png"
                      alt="Wellington Girls college logo" width="200" height="200">
        </div>

        <div id="wgc"></div>
            <img <img src="https://resources.stuff.co.nz/content/dam/images/1/u/1/h/p/y/image.related.StuffLandscapeSixteenByNine.1420x800.1u1gtn.png/1551321307643.jpg"
                  class="Image of WGC building" alt="W3Schools.com" width="600" height="350">
        </div>

        <h2> Show me the food information </h2>
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

        <h2> Show me the drink information </h2>
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

        <h2> Too see the weekly specials </h2>
        <a href="specialsv1.php">CLICK HERE</a>


    </main>






</header>
