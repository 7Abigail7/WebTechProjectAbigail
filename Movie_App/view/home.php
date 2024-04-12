<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>CineMacionado-MovieApp | Home</title>

    <style>
        .movie-container {
            max-width: auto;
            margin: 0 auto;
            /* padding: 20px; */
        }

        .movies {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-left: 100px;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.1);
            /* Zoom in on hover */
        }

        .card img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card h2 {
            margin: 10px;
            font-size: 1.2rem;
        }

        .card p {
            margin: 0 10px 10px;
            font-size: 0.9rem;
        }

        .title-overlay {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            /* height: 60%; */
            color: white;

        }

        .title {
            text-align: center;
            margin-bottom: 0px;
            font-size: 40px;

        }

        .title-desc {
            text-align: center;
            margin: 60px;
            padding-left: 80px;
            font-size: 16px;
        }

        /* Initially hide the moon icon */
        #moonIcon {
            display: none;
        }

        /* Dark mode styles */
        .dark-mode {
            background-color: #1a202c;
            /* Change background color for dark mode */
            color: black;
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

            <!-- 
            <div class="profile-container" style="margin-right: 10px;">
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
        <div class="content-container">
            <div class="featured-movies" style="background: linear-gradient(to bottom, rgba(0,0,0,0), #151515), url('movie_img/site-bk.png');
            background-position: right center;
            background-size: auto 100%;
            background-color: darkred;
            background-repeat: no-repeat;">
                <div class="title-overlay">
                    <h1 class="title">Discover the Latest Movies and TV Shows</h1>
                    <p class="title-desc">Explore our curated collection of the latest movies and TV shows.
                        From blockbuster hits to hidden gems, we bring you a diverse selection of entertainment to suit every taste.
                        Discover thrilling action, heartwarming dramas, side-splitting comedies, and much more.
                        With regular updates and recommendations, there's always something new to watch.
                        Start your journey into the world of cinema and television today!
                    </p>
                </div>
            </div>
        </div>

        <div class="movie-container">
            <div id="movies" class="movies">
                <?php
                $api_key = 'e8b7d8a631a833c10df5c0a3fbdced29';
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $items_per_page = 20; // Number of movies per page
                $total_movies = 100; // Total number of movies to display

                // Make API request to get trending movies
                $url = "https://api.themoviedb.org/3/movie/top_rated?api_key=$api_key&page=$page";

                $response = file_get_contents($url);

                if ($response) {
                    $data = json_decode($response, true);

                    // Check if there are any results
                    if ($data && isset($data['results'])) {
                        $movies = $data['results'];
                        $count = 0; // Initialize movie count

                        foreach ($movies as $movie) {
                            // Display movie card only if movie count is less than total movies to display
                            if ($count < $total_movies) {
                ?>
                                <div class="card">
                                    <img src="https://image.tmdb.org/t/p/w500<?php echo $movie['poster_path']; ?>" alt="<?php echo $movie['title']; ?>">
                                    <h2><?php echo $movie['title']; ?></h2>
                                    <p><strong>Release Date:</strong> <?php echo $movie['release_date']; ?></p>
                                    <p><?php echo $movie['overview']; ?></p>
                                </div>
                <?php
                                $count++; // Increment movie count
                            } else {
                                break; // Break the loop if total movies limit reached
                            }
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
            // Infinite scrolling functionality
            var page = <?php echo $page; ?>;
            var isLoading = false;

            window.addEventListener('scroll', function() {
                if (window.innerHeight + window.scrollY >= document.body.offsetHeight && !isLoading) {
                    isLoading = true;
                    page++;
                    loadMoreMovies(page);
                }
            });

            function loadMoreMovies(page) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'https://api.themoviedb.org/3/movie/top_rated?api_key=<?php echo $api_key; ?>&page=' + page, true);
                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 400) {
                        var data = JSON.parse(xhr.responseText);
                        var movies = data.results;
                        var moviesContainer = document.getElementById('movies');

                        movies.forEach(function(movie) {
                            var movieCard = document.createElement('div');
                            movieCard.classList.add('card');
                            movieCard.innerHTML = `
                        <img src="https://image.tmdb.org/t/p/w500${movie.poster_path}" alt="${movie.title}">
                        <h2>${movie.title}</h2>
                        <p><strong>Release Date:</strong> ${movie.release_date}</p>
                        <p>${movie.overview}</p>
                    `;
                            moviesContainer.appendChild(movieCard);
                        });

                        isLoading = false;
                    } else {
                        console.error('Failed to fetch data from API.');
                    }
                };
                xhr.send();
            }

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