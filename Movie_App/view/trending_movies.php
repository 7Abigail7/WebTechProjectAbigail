<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/trending.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <title>Trending Movies</title>
    <style>
        body {
            font-family: 'Roboto' sans-serif;
            margin: 0;
            padding: 0;
            background-color: brown;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            margin: 5px;
            width: 280px;
            display: inline-block;
        }

        .card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .card h2 {
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .card p {
            margin-bottom: 10px;
        }

        .main-content {
            padding: 30px;
            text-align: center;
            margin-left: 10px;
            color: white;

        }

        .main-content h1 {
            font-size: 24px;
            margin-bottom: 20px;
            font-size: 40px;
            color: black;
            text-decoration: none;
            width: 35%;
            padding-block: 30px;
            background-color: lightcyan;
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


    <div class="main-content">
        <h1>Trending Movies</h1>
        <div class="container">
            <?php
            $api_key = 'e8b7d8a631a833c10df5c0a3fbdced29';

            // Make API request to get trending movies
            $url = "https://api.themoviedb.org/3/trending/movie/week?api_key=$api_key";
            $response = file_get_contents($url);

            if ($response) {
                $data = json_decode($response, true);

                // Check if there are any results
                if ($data && isset($data['results'])) {
                    $movies = $data['results'];
                    foreach ($movies as $movie) {
            ?>
                        <div class="card">
                            <img src="https://image.tmdb.org/t/p/w500<?php echo $movie['poster_path']; ?>" alt="<?php echo $movie['title']; ?>">
                            <h2>
                                <?php echo $movie['title']; ?>
                            </h2>
                            <p><strong>Release Date:</strong>
                                <?php echo $movie['release_date']; ?>
                            </p>
                            <p>
                                <?php echo $movie['overview']; ?>
                            </p>
                        </div>
            <?php
                    }
                } else {
                    echo "No trending movies found.";
                }
            } else {
                echo "Failed to fetch data from API.";
            }
            ?>
        </div>
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

</body>

</html>