<?php
/*Connects to the database*/
$con = mysqli_connect("localhost", "campbellma", "sillyland16", "campbellma_canteen");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}

/*Query for food form, to retrieve FoodID and FItem from food table*/
$all_foods_query = "SELECT FoodID, FItem FROM food";
$all_foods_result = mysqli_query($con, $all_foods_query);

/*Query for drinks form, to retrieve DrinkID and DItem from drinks table*/
$all_drinks_query = "SELECT DrinkID, DItem FROM drinks";
$all_drinks_result = mysqli_query($con, $all_drinks_query)
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <!--Browser title-->
    <title> WGC Canteen </title>
    <meta charset="utf-8">
    <!--Linking to css-->
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>

<body>
    <header>
        <!--Main heading-->
        <h1> WGC CANTEEN </h1>
        <nav>
            <ul>
                <!--Navigation bar-->
                <li> <a href='index.php'> HOME </a></li>
                <li> <a href='foods.php'> FOOD </a></li>
                <li> <a href='drinks.php'> DRINKS </a></li>
                <li> <a href='specials.php'> SPECIALS </a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!--WGC Logo-->
        <div id='logo'>
            <img src="https://wgc.school.nz/wp-content/uploads/2018/09/WGC_Logo_Transparent_RGB.png"
                 alt="Wellington Girls college logo" width="200" height="200">
        </div>

        <!--WGC Image-->
        <div id='wgc'>
            <img src="https://resources.stuff.co.nz/content/dam/images/1/u/1/h/p/y/image.related.StuffLandscapeSixteenByNine.1420x800.1u1gtn.png/1551321307643.jpg"
                 alt="Image of WGC building" width="600" height="350">
        </div>

        <!--Sub food heading-->
        <h3> Show me the food information </h3>

        <!--Food form-->
        <form name='foods_form' id='foods_form' method ='get' action ='foods.php'>
            <select class='home_info' name='food'>
                <!--Options-->
                <?php
                while($all_foods_record = mysqli_fetch_assoc($all_foods_result)){
                    echo "<option value = '". $all_foods_record['FoodID'] . "'>";
                    echo $all_foods_record['FItem'];
                    echo "</option>";
                }
                ?>
            </select>
            <!--Food button-->
            <input type='submit' name='food_button' value='SHOW ME'>
        </form>

        <!--Sub drinks heading-->
        <h3> Show me the drink information </h3>

        <!--Drinks form-->
        <form name='drinks_form' id='drinks_form' method ='get' action ='drinks.php'>
            <select class='home_info' name='drink'>
                <!--Options-->
                <?php
                while($all_drinks_record = mysqli_fetch_assoc($all_drinks_result)){
                    echo "<option value = '". $all_drinks_record['DrinkID'] . "'>";
                    echo $all_drinks_record['DItem'];
                    echo "</option>";
                }
                ?>
            </select>
            <!--Drinks button-->
            <input type='submit' name='drinks_button' value='SHOW ME'>
        </form>

        <!--Sub specials heading and link to page-->
        <h4> To see the weekly specials, <a href="specials.php" class ="click">click here</a></h4>
    </main>
</body>
    </html>
