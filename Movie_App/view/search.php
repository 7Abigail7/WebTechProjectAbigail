<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Search</title>
    <link rel="stylesheet" href="../css/search.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            font-family: 'Roboto' sans-serif;
            margin: 0;
            padding: 0;
            background-color: brown;

        }

        .navbar {
            width: 100%;
            height: 70px;
            background-color: black;
        }

        .navbar-container {
            display: flex;
            align-items: center;
            background-color: black;
            padding: 0 80px;
            height: 100%;
            font-family: cursive;
            color: white;

        }

        .logo-container {
            flex: 10;

        }

        .logo {
            font-family: cursive;
            font-size: 30px;
            color: #00f00c;
            cursor: pointer;
        }

        .menu-container {
            flex: 6;

        }

        .menu-list {
            display: flex;
            list-style: none;
            color: white;
        }

        .menu-list-item {
            margin-right: 30px;

        }

        .menu-list-item.active {
            font-weight: bold;
        }

        .profile-container {
            flex: 2;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }



        .toggle {
            height: 20px;
            width: 40px;
            background-color: white;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            position: relative;
        }

        .toggle-ball {
            height: 20px;
            width: 20px;
            background-color: black;
            right: 1px;
            position: absolute;
            cursor: pointer;
            border-radius: 50%;
        }

        .toggle-icon {
            color: goldenrod;
        }


        .sidebar {
            width: 80px;
            height: 100%;
            position: fixed;
            top: 0;
            flex-direction: column;
            display: flex;
            background-color: black;
            padding-top: 60px;
            align-items: center;
            font-size: small;

        }

        .menu-icon {
            color: white;
            font-size: 20px;
            margin-top: 40px;
        }

        .menu-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* text-decoration: none; */
        }

        .menu-text {
            color: white;
            margin-top: 5px;
            /* text-decoration: none; */

        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: white;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: lightgray;
        }

        #results {
            color: white;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: 70%;
            padding: 10px;
            font-size: 16px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        #results {
            text-align: left;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-inline: 100px;
        }

        .movie {
            border: 1px solid #ccc;
            border-radius: 5px;
            /* padding: 20px; */
            /* margin-bottom: 20px; */
            margin: 20px;
            width: calc(33.33% - 20px);
            height: 80%;
            transition: transform 0.3s;
        }

        .poster {
            width: 87%;
            height: 70%;
            margin-bottom: 10px;
            /* margin-left: 60px; */
            /* object-fit: cover; */
            justify-content: center;
        }

        .movie:hover {
            transform: scale(1.1);
        }

        #results {
            text-align: left;
            /* text-wrap: 2px; */
            /* margin-left: 100px; */
        }

        /* Incorporating movie card styles */
        .movies {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            size: 30px;

        }

        .card:hover {
            transform: scale(1.1);
        }

        .card img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .title-overlay {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            background: rgba(0, 0, 0, 0.7);
            /* Semi-transparent background */
            padding: 20px;
            height: 100%;
        }

        .title {
            margin-bottom: 10px;
            font-size: 1.5rem;
        }

        .title-desc {
            font-size: 1rem;
        }

        /* Initially hide the moon icon */
        #moonIcon {
            display: none;
        }

        /* Dark mode styles */
        .dark-mode {
            background-color: #1a202c;
            /* Change background color for dark mode */
            color: white;
            /* Change text color for dark mode */
        }

        .dark-mode #toggleBall {
            transform: translateX(22px);
            /* Move toggle ball to the left for dark mode */
        }

        .dark-mode #sunIcon {
            display: none;
            /* Hide sun icon in dark mode */
        }
    </style>

</head>

<body>
    <div class="navbar">
        <div class="navbar-container">

            <div class="logo-container">
                <h1 class="logo">CineMacionado</h1>
            </div>


            <div class="menu-container">
                <ul class="menu-list">
                    <li class="menu-list-item active"><a href="../view/home.php" style="color: white;">Home</a></li>
                    <li class="menu-list-item"><a href="../view/home.php" style="color: white;">Movies</li>
                    <li class="menu-list-item"><a href="../view/trending_movies.php" style="color: white;">Trends</li>
                    <li class="menu-list-item"><a href="../view/series_view.php" style="color: white;">Series</li>
                </ul>
            </div>


            <!-- <div class="profile-container" style="margin-right: 10px;">
                <a href="../view/profile.html" class="profile-link" style="text-decoration: none; color: white;">
                    <div class="profile-text-container">
                        <span class="profile-text">Profile</span>
                        <i class="fa-solid fa-caret-down"></i>
                    </div>
                </a>
            </div> -->
            <div class="toggle" id="toggle">
                <i class="fa-solid fa-moon toggle-icon" id="moonIcon"></i>
                <i class="fa-solid fa-sun toggle-icon" id="sunIcon"></i>
                <div class="toggle-ball" id="toggleBall"></div>
            </div>

            <div class="logout" style="font-family: cursive; margin-left: 10px;">
                <i class="menu-list-item"><a href="../login/logout.php" style="color: white;">Logout</i>
            </div>

        </div>
    </div>

    <div class="sidebar" style="  font-size: 15px;">
        <div class="menu-item">
            <i class="menu-icon fa-solid fa-magnifying-glass"></i>
            <a href="../view/search.php" class="menu-text" style="  text-decoration: none;">Search</a>
        </div>

        <div class="menu-item">
            <i class="menu-icon fa-solid fa-house"></i>
            <a href="../view/home.php" class="menu-text" style="  text-decoration: none;">Home</a>
        </div>

        <!-- <div class="menu-item">
            <i class="menu-icon fa-solid fa-user"></i>
            <a href="../view/profile.html" class="menu-text" style="  text-decoration: none;">Profile</a>
        </div> -->


        <div class="menu-item">
            <i class="menu-icon fa-solid fa-comments"></i>
            <a href="../view/discussion.php" class="menu-text" style="  text-decoration: none;">Discussion</a>
        </div>

        <div class="menu-item">
            <i class="menu-icon fa-solid fa-bookmark"></i>
            <a href="../view/reflect.php" class="menu-text" style="  text-decoration: none;">Reflecta</a>
        </div>
    </div>




    <div class="container">
        <h1>Movie Search</h1>
        <h2>Enter a keyword to search for movies.</h2>
        <form id="search-form">
            <input type="text" id="search-input" placeholder="Enter movie title...">
            <button type="submit">Search</button>
        </form>
        <div id="results"></div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggle = document.getElementById("toggle");
            const moonIcon = document.getElementById("moonIcon");
            const sunIcon = document.getElementById("sunIcon");
            const toggleBall = document.getElementById("toggleBall");

            toggle.addEventListener("click", function(event) {
                // Prevent default behavior (e.g., navigation)
                event.preventDefault();

                // Toggle dark mode class on body
                document.body.classList.toggle("dark-mode");

                // Toggle visibility of moon and sun icons
                moonIcon.classList.toggle("hidden");
                sunIcon.classList.toggle("hidden");

                // Move the toggle ball to the left for dark mode, and to the right for light mode
                toggleBall.classList.toggle("dark-mode");
            });
        });
    </script>
    <script src="../js/search.js"></script>
</body>

</html>