
console.log("hello world");

const cabinItems = document.querySelectorAll(".cabin-item");

cabinItems.forEach(item => {
    item.addEventListener("click", () => {
        //get the data from ata attributes stored in li html.
        const cabinID = item.dataset.id;
        const cabinType = item.dataset.type;
        const pricePerNight = item.dataset.priceNight;
        const pricePerWeek = item.dataset.priceWeek;
        const description = item.dataset.description;
        const photo = item.dataset.photo;


        document.getElementById("cabinid").value = cabinID;
        document.getElementById("cabintype").value = cabinType;
        document.getElementById("pricepernight").value = pricePerNight;
        document.getElementById("priceperweek").value = pricePerWeek;
        document.getElementById("description").value = description;
        document.getElementById("photo").value = photo;

    });

});

console.log("script running");


//set the cabinimage input(file upload) to imageFile variable
const imageFile = document.getElementById("cabinimage");
console.log("imageFile:", imageFile);


//listen for when a user selects a file
imageFile.addEventListener("change", function(){
    console.log("function is running");

    //get the first file
    const image = imageFile.files[0];
    console.log("Selected image:", image);

    //if thre is a file selected
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



//unhide image in HTML and show selected image.

    



