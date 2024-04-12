const form = document.getElementById('form');
const registerButton = document.getElementById('submitButton');

// Error messages and fields
const emailInput = document.getElementById('email');
const emailError = document.getElementById('email-error');

const passwordInput = document.getElementById('password');
const retypePasswordInput = document.getElementById('retype-password');
const passwordError = document.getElementById('password-error');
const retypeError = document.getElementById('retype-error');

// Add event listener to form submission
form.addEventListener('submit', (event) => {
  event.preventDefault(); // Prevent default form submission

  // Clear previous errors
  emailError.textContent = '';
  passwordError.textContent = '';
  retypeError.textContent = '';

  // Validate Email
  if (!validateEmail(emailInput.value)) {
    emailError.textContent = 'Please enter a valid email address.';
    return; // Stop execution if email is invalid
  }

  // Validate Password
  if (!validatePassword(passwordInput.value)) {
    passwordError.textContent = 'Password must be at least 8 characters and contain a mix of letters, numbers, and symbols.';
    return; // Stop execution if password is invalid
  }

  // Check password match
  if (passwordInput.value !== retypePasswordInput.value) {
    retypeError.textContent = 'Passwords do not match.';
    return; // Stop execution if passwords don't match
  }

  // Form submission logic (replace with your backend call or simulation)
  console.log('Form submitted successfully!');
  // You can redirect to a dashboard page or display a success message here

});

// Email validation function
// function validateEmail(email) {

//   return email.includes('@') && email.includes('.');
// }

// // Password validation function
// function validatePassword(password) {
  
//   return password.length >= 8 &&
//          /[a-z]/.test(password) &&
//          /[A-Z]/.test(password) &&
//          /\d/.test(password) &&
//          /[^a-zA-Z0-9]/.test(password);
// }
// Email validation function using regex
function validateEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

// Password validation function using regex
function validatePassword(password) {
  const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
  return passwordRegex.test(password);
}


// Disable register button until form is valid
form.addEventListener('input', () => {
  // Check if all fields are valid
  const isValid = validateEmail(emailInput.value) &&
                validatePassword(passwordInput.value) &&
                passwordInput.value === retypePasswordInput.value;
  registerButton.disabled = !isValid;
});



function togglePasswordVisibility() {
  var passwordField = document.getElementById("password");
  var eyeIcon = document.querySelector(".toggle-password i");

  if (passwordField.type === "password") {
    passwordField.type = "text";
    eyeIcon.classList.remove("fa-eye-slash");
    eyeIcon.classList.add("fa-eye");
  } else {
    passwordField.type = "password";
    eyeIcon.classList.remove("fa-eye");
    eyeIcon.classList.add("fa-eye-slash");
  }
}

function toggleConfirmPasswordVisibility() {
  var confirmPasswordField = document.getElementById("confirmPassword");
  var eyeIcon = document.querySelector(".toggle-confirm-password i"); 

  if (confirmPasswordField.type === "password") {
    confirmPasswordField.type = "text";
    eyeIcon.classList.remove("fa-eye-slash");
    eyeIcon.classList.add("fa-eye");
  } else {
    confirmPasswordField.type = "password";
    eyeIcon.classList.remove("fa-eye");
    eyeIcon.classList.add("fa-eye-slash");
  }
}
