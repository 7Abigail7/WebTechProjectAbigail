<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/login.css">

 

</head>
<body>
    <div class="container" >
            <div class="form-container">
            <h2>Log In</h2>
            <form action="../actions/login_user_action.php" method="post" name="loginForm" id="loginId">
                <div class="input-container">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="input-container">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-container">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                <button type="submit">Log In</button>
            </form>


            <div class="register-container">
                <a href="../login/register_view.html" class="registerLink">Don't have an account? Register here</a>
            </div>
        </div>
    </div>

    <script src="../js/login.js"></script>
</body>
</html>
