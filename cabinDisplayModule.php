 <!-- Connect to database -->
 <?php include "dbconnect.php" ?>

<?php 


//TO DO- Prepare statements to get cabin data



//Get all data from Cabin table
$result = $conn->query("SELECT * FROM Cabin");


//save associative data in $rows variable
$rows = $result->fetch_all(MYSQLI_ASSOC);

echo "<ul class='cabin-list'>";

//loop through each row of data and write HTML to page inserting information from database in appropriate places.
foreach($rows as $row) {

echo    "<li class='cabin-item'
            data-id='". htmlspecialchars($row['cabinID']) . "'
            data-type='" . htmlspecialchars($row['cabinType']) . "'
            data-description='" . htmlspecialchars($row['cabinDescription']) . "'
            data-price-night='" . htmlspecialchars($row['pricePerNight']) . "'
            data-price-week='" . htmlspecialchars($row['pricePerWeek']) . "'
            data-cabin-image='" . htmlspecialchars($row['photo']) . "'
            >";
echo        "<div class='allcabins-grid' >";

echo            "<div class='cabinimage-container' >";
echo                "<img class='cabinimage' src='cabinimages/" . $row['photo'] . "'>";
echo            "</div>";

echo            "<div class='cabin-container' >";
// hidden cabin ID
echo            "<p >Cabin id: " . $row['cabinID'] . "</p>";
echo            "<h2 class='cabintype' >" . $row['cabinType'] . "</h2>" . "<br>" . "Cabin description: " . $row['cabinDescription'] . "<br><br>";
echo            "<p class='price' >$" . $row['pricePerNight'] . " per night </p>     <p>$" . $row['pricePerWeek'] . " per week</p>";
echo            "</div >";

echo        "</div>";
echo    "</li>";

}


$conn->close();

echo "</ul>";


?>

<!-- id='" . $row['cabinID'] . "' -->