<?php
/*Connects to the database*/
$con = mysqli_connect("localhost", "campbellma", "sillyland16", "campbellma_canteen");

if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else {
    echo "connected to database";

}
if(isset($_GET['food'])){
    $id = $_GET['food'];
}else{
    $id = 1;
}

/*Query for food item information, to retrieve FItem, FDescription, FCalories and FStock from food table*/
$this_foods_query = "SELECT FItem, FDescription, FCalories, FCost, FStock FROM food WHERE FoodID = '" . $id . "'";
$this_foods_result = mysqli_query($con, $this_foods_query);
$this_foods_record = mysqli_fetch_assoc($this_foods_result);

/*Query for selecting another food item, to retrieve FoodID and FItem from food table*/
$all_foods_query = "SELECT FoodID, FItem FROM food";
$all_foods_result = mysqli_query($con, $all_foods_query);

/*Query for sorting food items Cost Low-High */
if (isset($_POST['ASC']))
{
    $asc_query = "SELECT * FROM food ORDER BY FCost ASC";
    $result = mysqli_query($con, $asc_query);
}

/*Query for sorting food items Cost High-Low*/
elseif (isset ($_POST['DESC']))
{
    $desc_query = "SELECT * FROM food ORDER BY FCost DESC";
    $result = mysqli_query($con, $desc_query);
}

/*Query for sorting food items alphabetically from A-Z*/
elseif (isset($_POST['AtoZ']))
{
    $asc_query = "SELECT * FROM food ORDER BY FItem ASC";
    $result = mysqli_query($con, $asc_query);
}

/*Query for sorting food items alphabetically from Z-A*/
elseif (isset ($_POST['ZtoA']))
{
    $desc_query = "SELECT * FROM food ORDER BY FItem DESC";
    $result = mysqli_query($con, $desc_query);
}

/*Query for sorting food items by Calories Low-High */
elseif (isset($_POST['C-Low-High']))
{
    $asc_query = "SELECT * FROM food ORDER BY FCalories ASC";
    $result = mysqli_query($con, $asc_query);
}

/*Query for sorting food items by Calories High-Low */
elseif (isset ($_POST['C-High-Low']))
{

    $desc_query = "SELECT * FROM food ORDER BY FCalories DESC";
    $result = mysqli_query($con, $desc_query);
}

/*Query for displaying food items in inputted order when no sort is selected*/
else {
    $default_query = "SELECT * FROM food";
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
    <h1> FOOD </h1>
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
        <h2> Food Information </h2>

        <?php
            /*Echoing out food information A-Z*/
            echo "<p> Item Name: " . $this_foods_record['FItem'] . "<br>";
            echo "<p> Description: " . $this_foods_record['FDescription'] . "<br>";
            echo "<p> Calories: " . $this_foods_record['FCalories'] . "<br>";
            echo "<p> Cost: " . $this_foods_record['FCost'] . "<br>";
            echo "<p> Stock: " . $this_foods_record['FStock'] . "<br>";
        ?>

        <!--Sub heading to select another item-->
        <h2> See another item </h2>

        <!--Food form-->
        <form name='foods_form' id='foods_form' method ='get' action ='foods.php'>
            <select id='food' name='food'>
                <!--Options-->
                <?php
                while($all_foods_record = mysqli_fetch_assoc($all_foods_result)){
                    echo "<option value = '". $all_foods_record['FoodID'] . "'>";
                    echo $all_foods_record['FItem'];
                    echo "</option>";
                }
                ?>
            </select>
            <input type='submit' name='food_button' value='SHOW ME'>
        </form>

        <!--Sub heading to search a food item-->
        <h2> Search an item below </h2>

        <!--Search food form-->
        <form method="post">
            <input type="text" name='search' class="search_bar">
            <input type="submit" name="submit" value="Search">
        </form>

        <?php
        if(isset($_POST['search'])) {
            $search = $_POST['search'];

            /*Query for searching a food item*/
            $food_search_query = "SELECT * FROM food WHERE FItem LIKE '%$search%'";
            $query = mysqli_query($con, $food_search_query);
            $count = mysqli_num_rows($query);


            /*If there are no results echos, There was no search results*/
            if($count == 0) {
                echo "<p>"."There was no search results!";

            }else{
                /*Echos out all results related to the search inputted*/
                while ($row = mysqli_fetch_array($query)) {
                    echo "<p>".$row ['FItem'];
                    echo "<br>";
                }
            }
        }
        ?>

        <!--Food Menu heading-->
        <h5> Food Menu </h5>

            <!--Drinks Menu form-->
            <form action="foods.php" method="post" class="sort_buttons">
                <!--Drinks Menu sub heading-->
                <h6>Sort By:</h6>
                <input type="submit" name="ASC" value="Cost: Low-High"><br><br>
                <input type="submit" name="DESC" value="Cost: High-Low"><br><br>
                <input type="submit" name="AtoZ" value="Alphabetical: A-Z"><br><br>
                <input type="submit" name="ZtoA" value="Alphabetical: Z-A"><br><br>
                <input type="submit" name="C-Low-High" value="Calories: Low-High"><br><br>
                <input type="submit" name="C-High-Low" value="Calories: High-Low"><br><br>
            </form>

            <!--Food Menu table and headers-->
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
                        $id = $test['FItem'];
                        echo "<tr>";
                        /*Echos out data into food menu table*/
                        echo "<td>" . $test['FItem'] . "</td>";
                        echo "<td>" . $test['FCalories'] . "</td>";
                        echo "<td>" . $test['FCost'] . "</td>";
                        echo "<td>" . $test['FStock'] . "</td>";
                        echo "</tr>";
                    }
                }
               ?>
            </table>
    </main>
</html>
