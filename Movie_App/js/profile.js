document.addEventListener("DOMContentLoaded", function () {
    // Fetch user data and populate profile
    fetchUserData();

    // Add event listener for changing password form submission
    document.getElementById("change-password-form").addEventListener("submit", function (event) {
        event.preventDefault();
        const currentPassword = document.getElementById("current-password").value;
        const newPassword = document.getElementById("new-password").value;
        const confirmPassword = document.getElementById("confirm-password").value;

        // Check if new passwords match
        if (newPassword !== confirmPassword) {
            alert("New passwords do not match!");
            return;
        }

        // Make AJAX request to update password
        fetch("update-password.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ currentPassword, newPassword })
        })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
            })
            .catch(error => {
                console.error("Error updating password:", error);
                alert("An error occurred while updating password. Please try again later.");
            });
    });

    // Add event listener for changing email form submission
    document.getElementById("change-email-form").addEventListener("submit", function (event) {
        event.preventDefault();
        const newEmail = document.getElementById("new-email").value;

        // Make AJAX request to update email
        fetch("update-email.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ newEmail })
        })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                // Update email displayed on the page
                document.getElementById("email").textContent = newEmail; 
            })
            .catch(error => {
                console.error("Error updating email:", error);
                alert("An error occurred while updating email. Please try again later.");
            });
    });

    // Function to fetch user data and populate profile
    function fetchUserData() {
        fetch("get-user-data.php")
            .then(response => response.json())
            .then(data => {
                document.getElementById("username").textContent = data.username;
                document.getElementById("email").textContent = data.email;
            })
            .catch(error => {
                console.error("Error fetching user data:", error);
                alert("An error occurred while fetching user data. Please try again later.");
            });
    }

});
    
    $(document).ready(function() {
        $('#toggle-current-password').click(function() {
            var type = $('#current-password').attr('type') === 'password' ? 'text' : 'password';
            $('#current-password').attr('type', type);
            $('#toggle-icon-current').toggleClass('fa-eye fa-eye-slash');
        });

        $('#toggle-new-password').click(function() {
            var type = $('#new-password').attr('type') === 'password' ? 'text' : 'password';
            $('#new-password').attr('type', type);
            $('#toggle-icon-new').toggleClass('fa-eye fa-eye-slash');
        });

        $('#toggle-confirm-password').click(function() {
            var type = $('#confirm-password').attr('type') === 'password' ? 'text' : 'password';
            $('#confirm-password').attr('type', type);
            $('#toggle-icon-confirm').toggleClass('fa-eye fa-eye-slash');
        });
    });
