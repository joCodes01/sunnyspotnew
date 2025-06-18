const adminForm = document.getElementById("admin-form");

function warningOff() {
    //set the border to background colour
        //const adminForm = document.getElementById("admin-form");
        adminForm.style.border = "2px solid var(--background)";
    //hide the warning text
        const warning = document.getElementById("warning-text");
        warning.hidden = true;
    //remove styles from the submit button
        const submitAdminForm = document.getElementById("submit-adminform");
        submitAdminForm.style.backgroundColor = "";
}

function warningOn() {
    //set the border to red
        //const adminForm = document.getElementById("admin-form");
        adminForm.style.border = "2px solid red";
    //show the warning text
        const warning = document.getElementById("warning-text");
        warning.hidden = false;
    //add red colour to submit button
        const submitAdminForm = document.getElementById("submit-adminform");
        submitAdminForm.style.backgroundColor = "var(--warningRed)";
}

const cabinItems = document.querySelectorAll(".cabin-item");

cabinItems.forEach(item => {
    item.addEventListener("click", () => {
       //set the form to 'Edit existing cabin' / 'UPTATE' row in the database
        const editExistingCabin = "UPDATE";

         //get the data from  attributes stored in li html.
        const cabinID = item.dataset.id;
        const cabinType = item.dataset.type;
        const pricePerNight = item.dataset.priceNight;
        const pricePerWeek = item.dataset.priceWeek;
        const description = item.dataset.description;
        const cabinImage = item.dataset.cabinImage;

        //set the form values with the cabin data
        document.getElementById("CRUDcabin").value = editExistingCabin;
        document.getElementById("cabinid").value = cabinID;
        document.getElementById("cabintype").value = cabinType;
        document.getElementById("pricepernight").value = pricePerNight;
        document.getElementById("priceperweek").value = pricePerWeek;
        document.getElementById("description").value = description;
        let setCabinImage = document.getElementById("cabinimageupload");
        setCabinImage.src = `cabinimages/${cabinImage}`;

        warningOff();
    });
});

//get the CRUD setting form input
const addNewCabin = document.getElementById("CRUDcabin");

//if the input is set to CREATE then clear all values in the form
addNewCabin.addEventListener('change', function(){
    if( this.value === "CREATE" ) {
        
        document.getElementById("cabinid").value = "";
        document.getElementById("cabintype").value = "";
        document.getElementById("pricepernight").value = "";
        document.getElementById("priceperweek").value = "";
        document.getElementById("description").value = "";
        let setCabinImage = document.getElementById("cabinimageupload");
        setCabinImage.src = `cabinimages/testcabin.jpg`;

        warningOff();

    } else if( this.value === "DELETE" ) {
        //turn on the warning styles
        warningOn();
       
    }else if( this.value === "UPDATE" ) {
        //turn off the warning styles
        warningOff();
    }
})

//when image is chosen in the admin form, get the image with FileReader() and display it on the page.

//set the cabinimage input(file upload) to imageFile variable
const imageFile = document.getElementById("cabinimage");

//listen for when a user selects a file
imageFile.addEventListener("change", function(){

    //get the first file
    const image = imageFile.files[0];

    //if there is a file selected
    if (image) {

        //create a file reader
        const reader = new FileReader();

        //when the reader reads the file
        reader.onload = function (event) {

            //set imagePreview variable to 'cabinimage-container img'
            const imagePreview = document.getElementById("cabinimageupload");

            console.log("Preview element:", imagePreview);

            imagePreview.src = event.target.result;
            console.log("")
        };

        reader.readAsDataURL(image);
    };
});


