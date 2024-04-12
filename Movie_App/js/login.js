// Function to toggle password visibility

function showErrorMessage() {
  alert("Incorrect password. Please try again."); // Display an alert message
  // You can also use a modal dialog or another method to display the message
}

function togglePasswordVisibility() {
  var passwordInput = document.getElementById("password");
  var icon = document.querySelector(".toggle-password i");

  if (passwordInput.type === "password") {
      passwordInput.type = "text";
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash");
  } else {
      passwordInput.type = "password";
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye");
  }
}

// Function to validate login form
function validateLoginForm() {
  var username = document.getElementById("username").value.trim();
  var email = document.getElementById("email").value.trim();
  var password = document.getElementById("password").value.trim();

  var isValid = true;

  // Username validation
  if (username === "") {
      alert("Username is required");
      isValid = false;
  }

  // Email validation
  if (email === "") {
      alert("Email is required");
      isValid = false;
  }

  // Password validation
  if (password === "") {
      alert("Password is required");
      isValid = false;
  }

  return isValid;
}

// Event listener for form submission
window.onload = function() {
  var loginForm = document.getElementById("loginId");
  loginForm.addEventListener("submit", function(event) {
      if (!validateLoginForm()) {
          event.preventDefault();
      }
  });
};
