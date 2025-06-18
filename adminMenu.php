<?php
session_start();
//change hidden elements to type="hidden"


//check daniels tip on making a button as a form to create a warning for delete.


   
//Add - if ima

//focus on making the code easier to read


//if the session login is not set to TRUE then re-direct to the login page    
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== TRUE)  {
   
    header('Location: login.php');
    exit();
} 

//set error message variable
    $error_message = "";
//set the response message variable
    $_SESSION['response_message'] = "";

//if the form has been submitted
 if($_SERVER["REQUEST_METHOD"] == "POST") {

    //set cabin type variable content
    $sanitize_cabintype = $_POST['cabintype'];
    $cabin_type = htmlspecialchars($sanitize_cabintype);

    //set price per night variable content
    $sanitize_pricepernight = $_POST['pricepernight'];
    $price_per_night = htmlspecialchars($sanitize_pricepernight);

    //set price per week variable content
    $sanitize_priceperweek = $_POST['priceperweek'];
    $price_per_week = htmlspecialchars($sanitize_priceperweek);

    //set description variable content
    $sanitize_description = $_POST['description'];
    $description = trim(htmlspecialchars($sanitize_description));

    //set the cabin id variable
    $sanitize_cabinid = $_POST['cabinid'];
    $cabinid = (int)trim(htmlspecialchars($sanitize_cabinid));


  

    //upload image
    $targetDir = "cabinimages/";
    $targetFile = $targetDir . basename($_FILES["cabinimage"]["name"]);
    $uploadOk = TRUE;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    //Image upload checks

    if(isset($_FILES['cabinimage']) && $_FILES["cabinimage"]["error"] === UPLOAD_ERR_OK) {

   

        //check if the file is an image
        $checkimage = getimagesize($_FILES["cabinimage"]["tmp_name"]);
        if ($checkimage === false) {
            echo "Sorry this file is not an image.";
            $uploadOk = FALSE;
        }

        //check file size does not exceed 5MB
        if ($_FILES["cabinimage"]["size"] > 5000000) {
            echo "File is too large. 5MB allowed";
            $uploadOk = FALSE;
        }

        //check file type is JPG, JPEG, PNG, or GIF
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = FALSE;
        }

        if ($uploadOk) {
            move_uploaded_file($_FILES["cabinimage"]["tmp_name"], $targetFile);

            //connect to the database
            include "dbconnect.php";

            //set the image file name
            $cabinphoto = $_FILES["cabinimage"]["name"];
        }
     
    } 
    else {
        //if no file is uploaded then default to testcabin.jpg
        $cabinphoto = "/testcabin.jpg";
    }
    
    

    

    //if form is set to 'Add new cabin' ('CREATE'), submit the following SQL query to create a new record
    if($_POST['CRUDcabin'] == 'CREATE'){

        if($price_per_week > ($price_per_night * 5)) {
            //check the values against the SQL constraint that price per week must not be greater than 5 x price per night.
            $error_message = "Price per week must not be highter than 5 x price per night."; 
        
        // if the data passes the check then send the SQL query to the database.
        }else {
        include "dbconnect.php";
        $stmt = $conn->prepare("INSERT INTO Cabin (cabinType, cabinDescription, pricePerNight, pricePerWeek, photo) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdds", $cabin_type, $description, $price_per_night, $price_per_week, $cabinphoto);
        $stmt->execute();
        $_SESSION['response_message'] = "New cabin created.";
        
        $stmt->close();
        }
    }

    //if form is set to 'Edit existing cabin' ('UPDATE'), submit the following SQL query to update the record
    if($_POST['CRUDcabin'] == 'UPDATE') {
        include "dbconnect.php";
        $stmt = $conn->prepare("UPDATE Cabin SET cabinType = ?, cabinDescription = ?, pricePerNight = ?, pricePerWeek = ?, photo = ? WHERE cabinID = ?");
        $stmt->bind_param("ssddsi", $cabin_type, $description, $price_per_night, $price_per_week, $cabinphoto, $cabinid);
        $stmt->execute();
        $_SESSION['response_message'] = "Cabin updated.";

        $stmt->close();
    }

    //if form is set to 'Delete cabin' ('DELETE'), submit the following SQL query to delete the record
    if($_POST['CRUDcabin'] == 'DELETE') {

    //add SQL statement to delete record here
       include "dbconnect.php";
       $stmt = $conn->prepare("DELETE FROM Cabin WHERE cabinID = ?");
       $stmt->bind_param("i", $cabinid);
       $stmt->execute();
       $_SESSION['response_message'] = "Cabin record deleted.";

       $stmt->close();
        }
 }


 ?>

<!-- HTML -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="style.css">
    <script src="validation.js" defer></script>
    <title>Administrative menu</title>
</head>
<body>

    <?php include "navbar.php" ?>

    <div class="admin-grid-container">
      
        <!-- CABIN DISPLAY MODULE -->
        <section class="pagecontent adminmenu-pagecontent">
            <h2 id="editcabin-title">Select cabin to edit</h2>

            <?php include "cabinDisplayModule.php" ?>

        </section>
      

        <!-- ADMIN FORM  -->
        <section class="admin-content" >
            <h2 class="admin-title">Choose action</h2>
            <form method="POST" id="admin-form" name="admin-form" enctype="multipart/form-data">

        

            <!-- identify if new or existing cabin -->

            <select  id="CRUDcabin" name="CRUDcabin">
                <option value="CREATE" selected>Add new cabin</option>
                <option value="UPDATE">Edit existing cabin</option>
                <option value="DELETE">Delete cabin</option>
            </select>
            <div>
                <label hidden for="cabinid">Cabin id: </label>
                <input hidden type="text" name="cabinid" id="cabinid">
            </div>
            <div>
                <label for="cabintype">Cabin type: </label>
                <input type="text" name="cabintype" id="cabintype" >
            </div>
            <div>
                <label for="pricepernight">Price per night: </label>
                <input type="text" name="pricepernight" id="pricepernight" >
            </div>
            <div>
                <label for="priceperweek">Price per week: </label>
                <input type="text" name="priceperweek" id="priceperweek" >
            </div>
            <div>
                <label for="description">Description: </label>
                <textarea name="description" id="description" rows="6" cols="20"></textarea>
            </div>

            <!-- Image upload -->
            <div id="admin-image-grid">
                <div>
                    <label for="cabinimage" class="bold-label">Cabin image</label>
                    <input type="file" id="cabinimage" name="cabinimage" accept=".png, .jpg, .jpeg, .gif">
                </div>
                
                    
                <div class='cabinimage-container' >
                    <img id='cabinimageupload' src='cabinimages/testcabin.jpg'>
                </div>
            </div>

           
            
            <div id="php-error-message"><?php echo $error_message; ?></div>
             
            <div id="response-message">
                <?php echo "<p>" . $_SESSION['response_message'] . "</p>";?>
            </div>
           
            <div>
            <input type="submit" id="submit-adminform">
            <p  hidden id="warning-text">Permanently delete this cabin from the database.</p>
            </div>
            
        </form>

        <!-- ERROR MODAL -->

        <dialog id="error-modal">
             <p id="error-message"></p>
             <div>
                <button id="close-modal">Close</button>
            </div>
        </dialog>

       

       


        </section>
    <div>

    <?php include "footer.php" ?>
    
</body>
</html>