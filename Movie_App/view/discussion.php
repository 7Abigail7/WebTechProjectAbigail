<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Discussion Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="../css/discuss.css">

  <style>
    .discussion-card {
      position: relative;
    }

    .discussion-buttons {
      position: absolute;
      bottom: 10px;
      right: 10px;
    }

    /* Initially hide the moon icon */
    #moonIcon {
      display: none;
    }

    /* Dark mode styles */
    .dark-mode {
      background-color: #1a202c;
      /* Change background color for dark mode */
      color: blue;
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

  <div class="container mt-4">
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title" style="font-weight: bold; color: rgb(36, 125, 177);">Create New Discussion</h5>
        <form action="" method="post" id="discussionForm">
          <div class="form-group">
            <label for="discussionTitle" style="font-weight: bold; color: rgb(36, 125, 177);">Title:</label>
            <input type="text" class="form-control" id="discussionTitle" name="discussionTitle" placeholder="Enter title">
          </div>
          <div class="form-group">
            <label for="discussionBody" style="font-weight: bold; color: rgb(36, 125, 177);">Discussion Content:</label>
            <textarea class="form-control" id="discussionBody" name="discussionBody" rows="3" placeholder="Enter message "></textarea>
          </div>
          <button type="submit" class="btn btn-primary" id="submitDiscussionButton">Start Discussion</button>
        </form>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title" style="font-weight: bold; color: rgb(36, 125, 177);"> Discussions</h5>
        <h6 style="font-weight: bold;">Anonymovie: Talk About Films Without Revealing Yourself</h6>
        <div id="discussionList"></div>
      </div>
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
  <script src="../js/discussion.js"></script>
</body>

</html>