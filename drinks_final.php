<?php
/*Connects to the database*/
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

/*Query for drinks information, to retrieve DItem, DCalories and DStock from drinks table*/
$this_drinks_query = "SELECT DItem, DCalories, DCost, DStock FROM drinks WHERE DrinkID = '" . $id . "'";
$this_drinks_result = mysqli_query($con, $this_drinks_query);
$this_drinks_record = mysqli_fetch_assoc($this_drinks_result);

/*Query for selecting another drink, to retrieve DrinkID and DItem from drinks table*/
$all_drinks_query = "SELECT DrinkID, DItem FROM drinks";
$all_drinks_result = mysqli_query($con, $all_drinks_query);

/*Query for sorting drinks Cost Low-High */
if (isset($_POST['ASC']))
{
    $asc_query = "SELECT * FROM drinks ORDER BY DCost ASC";
    $result = mysqli_query($con, $asc_query);
}

/*Query for sorting drinks Cost High-Low*/
elseif (isset ($_POST['DESC']))
{
    $desc_query = "SELECT * FROM drinks ORDER BY DCost DESC";
    $result = mysqli_query($con, $desc_query);
}

/*Query for sorting drinks alphabetically from A-Z*/
elseif (isset($_POST['AtoZ']))
{
    $asc_query = "SELECT * FROM drinks ORDER BY DItem ASC";
    $result = mysqli_query($con, $asc_query);
}

/*Query for sorting drinks alphabetically from Z-A*/
elseif (isset ($_POST['ZtoA']))
{
    $desc_query = "SELECT * FROM drinks ORDER BY DItem DESC";
    $result = mysqli_query($con, $desc_query);
}

/*Query for sorting drinks by Calories Low-High */
elseif (isset($_POST['C-Low-High']))
{
    $asc_query = "SELECT * FROM drinks ORDER BY DCalories ASC";
    $result = mysqli_query($con, $asc_query);
}

/*Query for sorting drinks by Calories High-Low */
elseif (isset ($_POST['C-High-Low']))
{

    $desc_query = "SELECT * FROM drinks ORDER BY DCalories DESC";
    $result = mysqli_query($con, $desc_query);
}

/*Query for displaying drinks in inputted order when no sort is selected*/
else {
    $default_query = "SELECT * FROM drinks";
    $result = mysqli_query($con, $default_query);
}
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
        <h1> DRINKS </h1>
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
        <div id="logo">
            <img src="https://wgc.school.nz/wp-content/uploads/2018/09/WGC_Logo_Transparent_RGB.png"
                      alt="W3Schools.com" width="200" height="200">
        </div>

        <!--Sub heading for information-->
        <h2> Drinks Information </h2>

        <?php
        /*Echoing out drinks information A-Z*/
        echo "<p> Drink Name: " . $this_drinks_record['DItem'] . "<br>";
        echo "<p> Calories: " . $this_drinks_record['DCalories'] . "<br>";
        echo "<p> Cost: " . $this_drinks_record['DCost'] . "<br>";
        echo "<p> Stock: " . $this_drinks_record['DStock'] . "<br>";
        ?>

        <!--Sub heading to select another item-->
        <h2> See another drink </h2>

        <!--Drinks form-->
        <form name='drinks_form' id='drinks_form' method ='get' action ='drinks.php'>
            <select id='drink' name='drink'>
                <!--Options-->
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

        <!--Sub heading to search a drink-->
        <h2> Search a drink below </h2>

        <!--Search drinks form-->
        <form method="post">
            <input type="text" name='search' class="search_bar">
            <input type="submit" name="submit" value="Search">
        </form>

        <?php
        if(isset($_POST['search'])) {
            $search = $_POST['search'];

            /*Query for searching a drink*/
            $drink_search_query = "SELECT * FROM drinks WHERE DItem LIKE '%$search%'";
            $query = mysqli_query($con, $drink_search_query);
            $count = mysqli_num_rows($query);

            /*If there are no results echos, There was no search results*/
            if($count == 0) {
                echo "<p>"."There was no search results!";

            }else{
                /*Echos out all results related to the search inputted*/
                while ($row = mysqli_fetch_array($query)) {
                    echo "<p>".$row ['DItem'];
                    echo "<br>";
                }
            }
        }
        ?>

        <!--Drinks Menu heading-->
        <h5> Drinks Menu </h5>

            <!--Drinks Menu form-->
            <form action="drinks.php" method="post" class="sort_buttons">
                <!--Drinks Menu sub heading-->
                <h6>Sort By:</h6>
                <input type="submit" name="ASC" value="Cost: Low-High"><br><br>
                <input type="submit" name="DESC" value="Cost: High-Low"><br><br>
                <input type="submit" name="AtoZ" value="Alphabetical: A-Z"><br><br>
                <input type="submit" name="ZtoA" value="Alphabetical: Z-A"><br><br>
                <input type="submit" name="C-Low-High" value="Calories: Low-High"><br><br>
                <input type="submit" name="C-High-Low" value="Calories: High-Low"><br><br>
            </form>

                <!--Drinks Menu table and headers-->
                <table class="sort_tables">
                    <tr>
                        <th>Item</th>
                        <th>Calories</th>
                        <th>Cost</th>
                        <th>Stock</th>
                    </tr>

                    <?php
                    if (mysqli_num_rows($result) != 0) {
                        while ($test = mysqli_fetch_array($result)) {
                            $id = $test['DItem'];
                            echo "<tr>";
                            /*Echos out data into drinks menu table*/
                            echo "<td>" . $test['DItem'] . "</td>";
                            echo "<td>" . $test['DCalories'] . "</td>";
                            echo "<td>" . $test['DCost'] . "</td>";
                            echo "<td>" . $test['DStock'] . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
    </main>
</body>
</html>
