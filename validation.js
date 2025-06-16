//FROM VALIDATION
let errorModal = document.querySelector("#error-modal");
let errorMessage = document.querySelector("#error-message");
let closeModalButton = document.querySelector("#close-modal");

 function showError(message){
    errorMessage.textContent = message;
    errorModal.showModal();
 }

  closeModalButton.addEventListener("click", () => {
    errorModal.close();
 });

let adminform = document.querySelector("#admin-form");
adminform.addEventListener("submit", validateform);

function validateform(event) {
    event.preventDefault();



    //CABIN TYPE VALIDATION

    let cabintype = adminform.cabintype.value;
    let action = document.getElementById("CRUDcabin");

    if( action.value === "UPDATE" || action.value === "CREATE" ){

    //if value is empty alert!

    if (cabintype == "" ) {
        showError("Enter cabin type");
        return;
    }


    // DESCRIPTION VALIDATION

    let description = document.querySelector("#description");
    // check not longer than 250 chars 
    if (description.value.length > 250) {
        showError("250 characters allowed");
        return;
    }
    // check for special characters 
    if (!description.value.match(/^[a-zA-Z0-9., ]*$/)) {
        showError("no special characters allowed");
        return;
    }

    // replace special characters with html alternatives
    function escapeSpecialChars(text) {
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
        }
    
    let descriptionText = description.value;
    let escapedDescription = escapeSpecialChars(descriptionText);

    description.value = escapedDescription;



    // PRICE PER NIGHT VALIDATION

    let nightprice = document.querySelector("#pricepernight");
    let pernight = parseFloat(nightprice.value);

   // check for empty value 
    if (nightprice.value == ""){
        showError("Enter the price per night");
        return;
    }

    // PRICE PER WEEK VALIDATION

    let weekprice = document.querySelector("#priceperweek");
    perweek = parseFloat(weekprice.value);

    //check for empty value
    if (weekprice.value == ""){
        showError("Enter the price per week");
        return;
    }

      // check week price is not more than 5 times night price
    if (perweek > (5 * pernight) ) {
        showError("Week price can not be more than the cost of five nights.");
        return;
    }

    if (perweek < 0 || pernight < 0){
        showError("Enter a valid price.");
        return;
    }

   //wnen validation checks are passed, submit the admin form
    adminform.submit();

    }else {
        //if set to DELETE then dont do the validation checks and submit the form.
        adminform.submit();
    }

}