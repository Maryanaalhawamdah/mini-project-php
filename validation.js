
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  form.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission for now

    // Get input values
    const fullName = document.getElementById("fullName").value;
    const email = document.getElementById("email").value;
    const mobile = document.getElementById("mobile").value;
    const dob = new Date(document.getElementById("dob").value);
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    // Clear previous error messages
    clearErrors();

    let hasErrors = false;

    // Email validation using regular expression
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!emailRegex.test(email)) {
      showError("email", "Invalid email format.");
      hasErrors = true;
    }

    // Mobile validation (14 digits)
    const mobileRegex = /^\d{14}$/;
    if (!mobileRegex.test(mobile)) {
      showError("mobile", "Mobile number must be 14 digits.");
      hasErrors = true;
    }

    // Full Name validation (Minimum length 15 characters)
    const nameRegex = /^.{15,}$/;
    if (!nameRegex.test(fullName)) {
      showError(
        "fullName",
        "Full name must have a minimum length of 15 characters."
      );
      hasErrors = true;
    }

    // Password validation (At least 8 characters, uppercase, lowercase, numbers, special characters)
    const passwordRegex =
      /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!passwordRegex.test(password)) {
      showError(
        "password",
        "Password should be at least 8 characters and include at least one uppercase letter, one lowercase letter, one number, and one special character."
      );
      hasErrors = true;
    }

    // Password Confirmation validation
    if (password !== confirmPassword) {
      showError("confirmPassword", "Password confirmation does not match.");
      hasErrors = true;
    }

    // Date of Birth validation (Above 16 years old)
    const today = new Date();
    const sixteenYearsAgo = new Date();
    sixteenYearsAgo.setFullYear(today.getFullYear() - 16);
    if (dob > sixteenYearsAgo) {
      showError("dob", "You must be at least 16 years old to register.");
      hasErrors = true;
    }

    if (!hasErrors) {
     
    

      // If all validations pass, send a POST request to register
        const formData = {
          fullName,
          email,
          mobile,
          dob,
          password,
        };

        console.log("Form submitted");

        fetch("register.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(formData),
        })
          .then(r=>window.location.href = "welcome.php" // Redirect after successful registration
          )
       
          .catch((error) => {
            console.error("Error:", error);
          });
      
    }
  });

  function showError(inputId, errorMessage) {
    const inputElement = document.getElementById(inputId);
    const errorElement = document.createElement("p");
    errorElement.className = "error-message";
    errorElement.textContent = errorMessage;
    inputElement.parentNode.appendChild(errorElement);
    inputElement.classList.add("input-error");
  }

  function clearErrors() {
    const errorMessages = document.querySelectorAll(".error-message");
    errorMessages.forEach((errorMessage) => {
      errorMessage.parentNode.removeChild(errorMessage);
    });

    const inputFields = document.querySelectorAll(".form-group input");
    inputFields.forEach((inputField) => {
      inputField.classList.remove("input-error");
    });
  }
  
});