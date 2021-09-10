<?php
$con = mysqli_connect("localhost", "campbellma", "sillyland16", "campbellma_canteen");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}

if(isset($_GET['specials'])) {
    $id = $_GET['specials'];

} else {
    $id = 1;
}

$monday_query = "SELECT SpecialsID, FItem, DItem, SCost 
         FROM specials WHERE SpecialsID = 'Monday'";
$result_monday = mysqli_query($con, $monday_query);

$tuesday_query = "SELECT SpecialsID, FItem, DItem, SCost 
         FROM specials WHERE SpecialsID = 'Tuesday'";
$result_tuesday = mysqli_query($con, $tuesday_query);

$wednesday_query = "SELECT SpecialsID, FItem, DItem, SCost 
         FROM specials WHERE SpecialsID = 'Wednesday'";
$result_wednesday = mysqli_query($con, $wednesday_query);

$thursday_query = "SELECT SpecialsID, FItem, DItem, SCost 
         FROM specials WHERE SpecialsID = 'Thursday'";
$result_thursday = mysqli_query($con, $thursday_query);

$friday_query = "SELECT SpecialsID, FItem, DItem, SCost 
         FROM specials WHERE SpecialsID = 'Friday'";
$result_friday = mysqli_query($con, $friday_query);
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
        <!-WGC Logo->
        <div id="logo">
            <img <img src="https://wgc.school.nz/wp-content/uploads/2018/09/WGC_Logo_Transparent_RGB.png"
                      alt="W3Schools.com" width="200" height="200">
        </div>

        <h2> Specials Information </h2>

            <form class="specials" name="specialsform" action="specialsv1.php" method="post">
                <input type='submit' name='Monday' value="Monday"> <br>
                <input type='submit' name='Tuesday' value="Tuesday"> <br>
                <input type='submit' name='Wednesday' value="Wednesday"> <br>
                <input type='submit' name='Thursday' value="Thursday"> <br>
                <input type='submit' name='Friday' value="Friday"> <br>

            </form>


        <table>
            <tr>
                <th>Day</th>
                <th>Item</th>
                <th>Drink</th>
                <th>Cost</th>
            </tr>

        <?php
        if (isset($_POST['Monday'])) {
            if (mysqli_num_rows($result_monday) != 0) {
                while ($test = mysqli_fetch_array($result_monday)) {
                    $id = $test['SpecialsID'];
                    echo "<tr>";
                    echo "<td>" . $test['SpecialsID'] . "</td>";
                    echo "<td>" . $test['FItem'] . "</td>";
                    echo "<td>" . $test['DItem'] . "</td>";
                    echo "<td>" . $test['SCost'] . "</td>";
                    echo "</tr>";
                }
            }
        }


        ?>


            <?php
            if (isset($_POST['Tuesday'])) {
                if (mysqli_num_rows($result_tuesday) != 0) {
                    while ($test = mysqli_fetch_array($result_tuesday)) {
                        $id = $test['SpecialsID'];
                        echo "<tr>";
                        echo "<td>" . $test['SpecialsID'] . "</td>";
                        echo "<td>" . $test['FItem'] . "</td>";
                        echo "<td>" . $test['DItem'] . "</td>";
                        echo "<td>" . $test['SCost'] . "</td>";
                        echo "</tr>";
                    }
                }
            }


            ?>

            <?php
            if (isset($_POST['Wednesday'])) {
                if (mysqli_num_rows($result_wednesday) != 0) {
                    while ($test = mysqli_fetch_array($result_wednesday)) {
                        $id = $test['SpecialsID'];
                        echo "<tr>";
                        echo "<td>" . $test['SpecialsID'] . "</td>";
                        echo "<td>" . $test['FItem'] . "</td>";
                        echo "<td>" . $test['DItem'] . "</td>";
                        echo "<td>" . $test['SCost'] . "</td>";
                        echo "</tr>";
                    }
                }
            }


            ?>

            <?php
            if (isset($_POST['Thursday'])) {
                if (mysqli_num_rows($result_thursday) != 0) {
                    while ($test = mysqli_fetch_array($result_thursday)) {
                        $id = $test['SpecialsID'];
                        echo "<tr>";
                        echo "<td>" . $test['SpecialsID'] . "</td>";
                        echo "<td>" . $test['FItem'] . "</td>";
                        echo "<td>" . $test['DItem'] . "</td>";
                        echo "<td>" . $test['SCost'] . "</td>";
                        echo "</tr>";
                    }
                }
            }


            ?>

            <?php
            if (isset($_POST['Friday'])) {
                if (mysqli_num_rows($result_friday) != 0) {
                    while ($test = mysqli_fetch_array($result_friday)) {
                        $id = $test['SpecialsID'];
                        echo "<tr>";
                        echo "<td>" . $test['SpecialsID'] . "</td>";
                        echo "<td>" . $test['FItem'] . "</td>";
                        echo "<td>" . $test['DItem'] . "</td>";
                        echo "<td>" . $test['SCost'] . "</td>";
                        echo "</tr>";
                    }
                }
            }


            ?>


</header>
