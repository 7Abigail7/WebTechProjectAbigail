<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/series.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
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
            color: white;
        }

        .card p {
            margin-bottom: 10px;
            color: white;
        }

        /* CSS styles for movie containers */
        .movie {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .poster {
            width: 100%;
            height: auto;
            margin-bottom: 10px;
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

        /* 
        .navbar {
            border: 1px solid #ccc;
        } */
    </style>
    <title>Series</title>
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
        <!-- 
        <div class="menu-item">
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
        <!-- <h1>TV Series</h1> -->
        <div id="movies" class="movies">
            <?php
            $api_key = 'e8b7d8a631a833c10df5c0a3fbdced29';
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $items_per_page = 20; // Number of movies per page
            $total_movies = 100; // Total number of movies to display

            // Make API request to search for anime
            $query = "anime"; // Your search query for anime
            $url = "https://api.themoviedb.org/3/search/multi?api_key=$api_key&query=$query&page=$page";

            $response = file_get_contents($url);

            if ($response) {
                $data = json_decode($response, true);

                // Check if there are any results
                if ($data && isset($data['results'])) {
                    $movies = $data['results'];
                    $count = 0; // Initialize movie count

                    foreach ($movies as $movie) {
                        // Check if the media type is TV and only display TV series
                        if ($movie['media_type'] == 'tv') {
                            // Display movie card only if movie count is less than total movies to display
                            if ($count < $total_movies) {
            ?>
                                <div class="card">
                                    <img src="https://image.tmdb.org/t/p/w500<?php echo $movie['poster_path']; ?>" alt="<?php echo $movie['name']; ?>">
                                    <h2><?php echo $movie['name']; ?></h2>
                                    <p><strong>First Air Date:</strong> <?php echo $movie['first_air_date']; ?></p>
                                    <p><?php echo $movie['overview']; ?></p>
                                </div>
            <?php
                                $count++; // Increment movie count
                            } else {
                                break; // Break the loop if total movies limit reached
                            }
                        }
                    }
                } else {
                    echo "No anime found.";
                }
            } else {
                echo "Failed to fetch data from API.";
            }
            ?>

        </div>
    </div>
    </div>
    </div>
    <script>
        // Function to check if the user has scrolled to the bottom of the page
        function isScrollAtBottom() {
            return (window.innerHeight + window.scrollY) >= document.body.offsetHeight;
        }

        // Function to fetch more TV series data
        function fetchMoreSeries(page) {
            fetch(`../actions/load_more_series.php?page=${page}`)
                .then(response => response.json())
                .then(data => {
                    const moviesContainer = document.getElementById("movies");

                    data.forEach(movie => {
                        const card = document.createElement("div");
                        card.classList.add("card");
                        card.innerHTML = `
                        <img src="https://image.tmdb.org/t/p/w500${movie.poster_path}" alt="${movie.name}">
                        <h2>${movie.name}</h2>
                        <p><strong>First Air Date:</strong> ${movie.first_air_date}</p>
                        <p>${movie.overview}</p>
                    `;
                        moviesContainer.appendChild(card);
                    });
                })
                .catch(error => console.error("Error fetching more series:", error));
        }

        // Event listener for scrolling
        window.addEventListener("scroll", function() {
            if (isScrollAtBottom()) {
                const currentPage = parseInt(document.getElementById("currentPage").value);
                const nextPage = currentPage + 1;
                fetchMoreSeries(nextPage);
                document.getElementById("currentPage").value = nextPage;
            }
        });

        // Fetch initial series data when the page loads
        document.addEventListener("DOMContentLoaded", function() {
            fetchMoreSeries(1); // Start with page 1
        });


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


    <!-- <script>
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
            xhr.open('GET', 'https://api.themoviedb.org/3/search/multi?api_key=<?php echo $api_key; ?>&page=' + page, true);
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
    </script> -->

    <script src="../js/series.js"></script>
</body>

</html>