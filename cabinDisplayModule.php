<?php include "dbconnect.php" ?>

<?php 


//Get all data from Cabin table
$result = $conn->query("SELECT * FROM Cabin");

//save associative data in $rows variable
$rows = $result->fetch_all(MYSQLI_ASSOC);

echo "<ul class='cabin-list'>";
?>

<!-- loop through each row of data and write HTML to page inserting information from database in appropriate places. -->
<?php foreach($rows as $row): ?>

    <li class='cabin-item'
            data-id="<?= htmlspecialchars($row['cabinID']); ?>" 
            data-type="<?= htmlspecialchars($row['cabinType']); ?>"
            data-description="<?= htmlspecialchars($row['cabinDescription']); ?>" 
            data-price-night="<?= htmlspecialchars($row['pricePerNight']); ?>"
            data-price-week="<?= htmlspecialchars($row['pricePerWeek']); ?>"
            data-cabin-image="<?= htmlspecialchars($row['photo']); ?>"
            >
        <div class='allcabins-grid' >

            <div id='cabinTitle'>
                <h2 class='cabintype' ><?= $row['cabinType']; ?></h2>
                <!-- hidden cabin ID -->
                <p hidden >Cabin id: <?= $row['cabinID']; ?></p>
            </div>

            <div id='cabin-description'>
                <h3>Cabin description: </h3><?= $row['cabinDescription'] ?>
            </div>

            <div class='cabinimage-container' >
                <img class='cabinimage' src='cabinimages/<?= $row['photo'];?>' alt='image of rental cabin'>
            </div>

            <div class='cabin-container' >

            <div>
                <p class='price' >$<?= $row['pricePerNight'] ?> night </p>     
                <p class='price'>$<?= $row['pricePerWeek'] ?> week</p>
            </div>
            </div >

        </div>
    </li>
<?php endforeach; ?>



<?php 
$conn->close();

echo "</ul>";

?>







