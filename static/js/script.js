const slidePage = document.querySelector(".slide-page");
const nextBtnFirst = document.querySelector(".firstNext");
const prevBtnSec = document.querySelector(".prev-1");
const nextBtnSec = document.querySelector(".next-1");
const prevBtnThird = document.querySelector(".prev-2");
const nextBtnThird = document.querySelector(".next-2");
const prevBtnFourth = document.querySelector(".prev-3");
const submitBtn = document.querySelector(".submit");
const progressText = document.querySelectorAll(".step p");
const progressCheck = document.querySelectorAll(".step .check");
const bullet = document.querySelectorAll(".step .bullet");
let current = 1;


// Prevent non-numeric input in the phone number field
const phoneInput = document.querySelector("input[name='phone']");
phoneInput.addEventListener("input", function (event) {
  this.value = this.value.replace(/\D/g, ""); // Remove non-numeric characters
});


// Function to validate fields on the current page
function validateFields(page) {
    const inputs = page.querySelectorAll("input, select");
    let isValid = true;
  
    inputs.forEach(input => {
        const errorMessage = input.nextElementSibling; // Get the next sibling (error message)
        
        if (errorMessage && errorMessage.classList.contains("error-message")) {
            errorMessage.remove();
        }

        // Check if the input is an email field and validate its format
      if (input.type === "email" && !validateEmail(input.value.trim())) {
        isValid = false;
        input.style.border = "1px solid red"; // Highlight invalid email

       
          const error = document.createElement("div");
          error.className = "error-message";
          error.innerText = "*Please enter a valid email address.";
          error.style.color = "red"; // Set text color to red
        error.style.fontSize = "12px"; // Set font size
        error.style.marginTop = "5px"; // Add some spacing
          input.parentNode.insertBefore(error, input.nextSibling); // Insert error message
        
      }
      
      // Check if the input is a phone number field and validate its format
    else if (input.name === "phone" && input.value.trim() !== "" && !validatePhone(input.value.trim())) {
        isValid = false;
        input.style.border = "1px solid red"; // Highlight invalid phone number

       
          const error = document.createElement("div");
          error.className = "error-message";
          error.innerText = "*Enter a valid 11-digit phone number";
          error.style.color = "red";
        error.style.fontSize = "12px";
        error.style.marginTop = "5px";
          input.parentNode.insertBefore(error, input.nextSibling); // Insert error message
        
      }

     
       // Check if the field is empty

      else if (!input.value.trim()) {
        isValid = false;
        input.style.border = "1px solid red"; // Highlight empty fields
        

          const error = document.createElement("div");
          error.className = "error-message";
          error.innerText = "*Please fill out this field.";
          error.style.color = "red";
          error.style.fontSize = "12px";
          error.style.marginTop = "5px";
          input.parentNode.insertBefore(error, input.nextSibling); // Insert error message
        
      }
      


      // If the field is valid
        
         else {
          input.style.border = "1px solid lightgrey"; // Reset border if valid
          
        }
      });

    return isValid;
}

// Function to validate email format using regex
function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email regex
    return regex.test(email);
  }

  // Function to validate phone number
function validatePhone(phone) {
    const regex = /^\d{11}$/; // Regex to check for exactly 11 digits
    return regex.test(phone);
  }

// Next button for the first page

nextBtnFirst.addEventListener("click", function(event){
  event.preventDefault();
  const currentPage = document.querySelector(".page.slide-page");
  if (validateFields(currentPage)) {

  slidePage.style.marginLeft = "-25%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
  }
});

// Next button for the second page

nextBtnSec.addEventListener("click", function(event){
  event.preventDefault();

  const currentPage = document.querySelectorAll(".page")[1];
  if (validateFields(currentPage)) {

  slidePage.style.marginLeft = "-50%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
  }
});

// Next button for the third page

nextBtnThird.addEventListener("click", function(event){
  event.preventDefault();
  const currentPage = document.querySelectorAll(".page")[2];
  if (validateFields(currentPage)) {
  slidePage.style.marginLeft = "-75%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
  }
});

// Submit button

submitBtn.addEventListener("click", function (event) {
  event.preventDefault();
  const currentPage = document.querySelectorAll(".page")[3];
  if (validateFields(currentPage)) {
    // Submit the form data to the server
    const form = document.querySelector("form");
    const formData = new FormData(form);

    fetch("signup.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        console.log(data); // Debugging: Log server response
        alert("Your Form Successfully Signed up");
        location.reload();
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }
});

// Previous buttons
prevBtnSec.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "0%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});



prevBtnThird.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-25%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});


prevBtnFourth.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-50%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});