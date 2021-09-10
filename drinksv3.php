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
$all_drinks_result = mysqli_query($con, $all_drinks_query);

if (isset($_POST['ASC']))
{
    $asc_query = "SELECT * FROM drinks ORDER BY DCost ASC";
    $result = mysqli_query($con, $asc_query);
}

elseif (isset ($_POST['DESC']))
{

    $desc_query = "SELECT * FROM drinks ORDER BY DCost DESC";
    $result = mysqli_query($con, $desc_query);
}

else {
    $default_query = "SELECT * FROM drinks";
    $result = mysqli_query($con, $default_query);
}
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
        <!-WGC Logo->
        <div id="logo">
            <img <img src="https://wgc.school.nz/wp-content/uploads/2018/09/WGC_Logo_Transparent_RGB.png"
                      alt="W3Schools.com" width="200" height="200">
        </div>

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

            <input type='submit' name='drinks_button' value='SHOW ME'>
        </form>

        <h2> Search a drink below </h2>

        <form action="" method="post">
            <input type="text" name='search' class="search_bar">
            <input type="submit" name="submit" value="Search">
        </form>

        <?php

        if(isset($_POST['search'])) {
            $search = $_POST['search'];

            $query1 = "SELECT * FROM drinks WHERE DItem LIKE '%$search%'";
            $query = mysqli_query($con, $query1);
            $count = mysqli_num_rows($query);

            if($count == 0) {
                echo "<p>"."There was no search results!";

            }else{

                while ($row = mysqli_fetch_array($query)) {

                    echo "<p>".$row ['DItem'];
                    echo "<br>";

                }
            }
        }
        ?>


        <h2> Drinks Menu </h2>
        <h5>Sort By:</h5>

        <form action="drinksv1.php" method="post" class="sort">
            <input type="submit" name="ASC" value="Cost: Low-High"><br><br>
            <input type="submit" name="DESC" value="Cost: High-Low"><br><br>
            <table>
                <tr>
                    <th>Item</th>
                    <th>Cost</th>
                    <th>Stock</th>
                </tr>

                <?php
                if (mysqli_num_rows($result) != 0) {
                    while ($test = mysqli_fetch_array($result)) {
                        $id = $test['DItem'];
                        echo "<tr>";
                        echo "<td>" . $test['DItem'] . "</td>";
                        echo "<td>" . $test['DCost'] . "</td>";
                        echo "<td>" . $test['DStock'] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
                <?php
                if (mysqli_num_rows($result) != 0) {
                    while ($test = mysqli_fetch_array($result)) {
                        $id = $test['DItem'];
                        echo "<tr>";
                        echo "<td>" . $test['DItem'] . "</td>";
                        echo "<td>" . $test['DCost'] . "</td>";
                        echo "<td>" . $test['DStock'] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>





</header>
