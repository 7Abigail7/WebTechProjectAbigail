<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome| CineMacionado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('movie_img/index.jpg');
            /* background-size: cover; */
        }

        .welcome-container {
            /* background-image: url('movie_img/index.jpg'); */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .welcome-message {
            color: #fff;
            font-size: 30px;
            margin-bottom: 5px;
            margin-top: -200px;
        }

        .get-started-button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            border-radius: 5px;
        }

        .site-description {
            color: white;
        }

        .site-name {
            text-align: left;
            /* margin-bottom: 300px; */
            margin-left: 20px;
            color: greenyellow;
            font-family: cursive;

        }
    </style>
</head>

<body>
    <div>
        <h1 class="site-name">CineMacionado</h1>
    </div>
    <div class="welcome-container">
        <h2 class="welcome-message">Welcome to Our Movie Site</h2>
        <h3 class="site-description">Discover, Watch, and Enjoy the Latest Movies</h3>



        <a href="login/login_view.php" class="get-started-button">Get Started</a>
    </div>
</body>

</html>