<?php
$con = mysqli_connect("localhost", "campbellma", "sillyland16", "campbellma_canteen");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <title> WGC CANTEEN </title>
    <meta charset="utf-8">
    <link rel='stylesheet' type='text/css' href='stylev1.css'>
</head>

<body>
<header>
    <h1> SPECIALS </h1>
    <nav>
        <ul>
            <li> <a href='indexv1.php'> HOME </a></li>
            <li> <a href='foodsv1.php'> FOOD </a></li>
            <li> <a href='drinksv1.php'> DRINKS </a></li>
            <li> <a href='specialsv1.php'> SPECIALS </a></li>
        </ul>
    </nav>

    <main>
        <h2> Specials Information </h2>

        <table style="width:100%">
            <tr>
                <th>Day</th>
                <th>Item</th>
                <th>Drink</th>
                <th>Cost</th>
            </tr>
            <tr>
                <td>Monday</td>
                <td>Cheeseburger</td>
                <td>Smoothie</td>
                <td>$7.50</td>
            </tr>
            <tr>
                <td>Tuesday</td>
                <td>Corndog</td>
                <td>Chocolate Milk</td>
                <td>$5.00</td>
            </tr>
            <tr>
                <td>Wednesday</td>
                <td>Satay Chicken Burger</td>
                <td>Hot Chocolate</td>
                <td>$5.00</td>
            </tr>
            <tr>
                <td>Thursday</td>
                <td>Nachos</td>
                <td>Pineapple Juice</td>
                <td>$4.50</td>
            </tr>
            <tr>
                <td>Friday</td>
                <td>Wedges</td>
                <td>Iced Tea</td>
                <td>$6.00</td>
            </tr>
        </table>




</header>
