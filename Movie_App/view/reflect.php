<?php
require_once '../settings/connection.php';
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movie_title = $_POST['movie_title'];
    $reflection = $_POST['reflection'];
    $improvement_areas = $_POST['improvement_areas'];
    $areas_to_desist = $_POST['areas_to_desist'];
    $userID = $_SESSION['UserID'];

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO movie_reflections (movie_title, reflection, improvement_areas, areas_to_desist,UserID) VALUES (?, ?, ?, ?,?)");
    $stmt->bind_param("ssssi", $movie_title, $reflection, $improvement_areas, $areas_to_desist, $userID);
    $stmt->execute();

    // Redirect back to form with success message
    header("Location: ../view/reflect.php?success=true");
    exit();
}

// Retrieve reflections from database
$sql = "SELECT * FROM movie_reflections ORDER BY created_at DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Reflection</title>
    <link rel="stylesheet" href="../css/reflect.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
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

        .f,
        .s {
            color: whitesmoke;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
        }

        /* body{
            color: black;
        } */
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
        <h1 class="f">Movie Reflection</h1>
        <h2 class="s">Reflect & Rise: Your Journey to Personal Empowerment</h2>
        <form action="../view/reflect.php" method="POST">
            <label for="movie_title">Movie Title:</label><br>
            <input type="text" id="movie_title" name="movie_title" required><br><br>

            <label for="reflection">Reflection:</label><br>
            <textarea id="reflection" name="reflection" rows="4" required></textarea><br><br>

            <label for="improvement_areas">Areas to Improve:</label><br>
            <textarea id="improvement_areas" name="improvement_areas" rows="2"></textarea><br><br>

            <label for="areas_to_desist">Areas to Desist:</label><br>
            <textarea id="areas_to_desist" name="areas_to_desist" rows="2"></textarea><br><br>

            <input type="submit" value="Submit">
        </form>
    </div>

    <div class="reflect">
        <h2 class="ref">Reflections</h2>
        <?php if ($result->num_rows > 0) : ?>
            <ul>
                <?php while ($row = $result->fetch_assoc()) :
                    if (isset($_SESSION['UserID']) && $row['UserID'] == $_SESSION['UserID']) {
                ?>
                        <li class="reflect-item">
                            <h3 class="title"><?php echo $row['movie_title']; ?></h3>
                            <p><strong>Reflection:</strong> <?php echo $row['reflection']; ?></p>
                            <p><strong>Areas to Improve:</strong> <?php echo $row['improvement_areas']; ?></p>
                            <p><strong>Areas to Desist:</strong> <?php echo $row['areas_to_desist']; ?></p>
                            <p><em>Submitted on <?php echo $row['created_at']; ?></em></p>

                            <div class="button-container">
                                <form>
                                    <!-- <form action="" method="POST"> -->
                                    <input type="hidden" name="reflection_id" value="<?php echo $row['id']; ?>">
                                    <input type="submit" name="submit" value="Edit" class="button-blue" style="background-color: blue; " onmouseover="this.style.backgroundColor='lightblue'" onmouseout="this.style.backgroundColor='blue'">
                                </form>

                                <form action="../actions/delete_reflection.php" method="POST">
                                    <input type="hidden" name="reflection_id" value="<?php echo $row['id']; ?>">
                                    <input type="submit" value="Delete" class="button-red" style="background-color: red; " onmouseover="this.style.backgroundColor='lightcoral'" onmouseout="this.style.backgroundColor='red'">
                                </form>

                                <form action="../actions/download_reflection.php" method="POST">
                                    <input type="hidden" name="reflection_id" value="<?php echo $row['id']; ?>">
                                    <input type="submit" name="submit" value="Download" class="button-green" style="background-color: green; " onmouseover="this.style.backgroundColor='lightgreen'" onmouseout="this.style.backgroundColor='green'">
                                </form>
                            </div>


                        </li>
                <?php }
                endwhile; ?>
            </ul>
        <?php else : ?>
            <p>No reflections found.</p>
        <?php endif; ?>
    </div>


    <!-- Edit button -->
    <button onclick="openEditModal(<?php echo $row['id']; ?>, <?php echo $loggedInUserId; ?>, '<?php echo $row['movie_title']; ?>', '<?php echo $row['reflection']; ?>', '<?php echo $row['improvement_areas']; ?>', '<?php echo $row['areas_to_desist']; ?>')">Edit</button>

    <!-- Edit Modal -->
    <div id="editModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Reflection</h2>
            <form id="editForm" onsubmit="submitEditedReflection(); return false;">
                <!-- Hidden input field to store reflection ID -->
                <input type="hidden" id="editReflectionId" name="reflection_id">
                <!-- Form fields for editing -->
                <label for="editMovieTitle">Movie Title:</label><br>
                <input type="text" id="editMovieTitle" name="movie_title" required><br><br>

                <label for="editReflection">Reflection:</label><br>
                <textarea id="editReflection" name="reflection" rows="4" required></textarea><br><br>

                <label for="editImprovementAreas">Areas to Improve:</label><br>
                <textarea id="editImprovementAreas" name="improvement_areas" rows="2"></textarea><br><br>

                <label for="editAreasToDesist">Areas to Desist:</label><br>
                <textarea id="editAreasToDesist" name="areas_to_desist" rows="2"></textarea><br><br>

                <!-- Submit button to trigger the update process -->
                <input type="submit" value="Update">
            </form>
        </div>
    </div>

    <script>
        // Function to create buttons for editing and deleting discussions
        function createDiscussionButtons(discussionId, discussionContainer) {
            const buttonsContainer = document.createElement("div");
            buttonsContainer.classList.add("discussion-buttons");

            // Check if the logged-in user is the author of the discussion
            // Edit button
            const editButton = document.createElement("button");
            editButton.classList.add("btn", "btn-secondary", "mr-2");
            editButton.textContent = "Edit";
            editButton.addEventListener("click", () => {
                // Get the discussion content for editing
                const discussionTitle = discussionContainer.querySelector(".card-title").textContent;
                const discussionContent = discussionContainer.querySelector(".card-text").textContent;

                // Prompt the user to enter new title and content
                const newTitle = prompt("Enter new title:", discussionTitle);
                const newContent = prompt("Enter new content:", discussionContent);

                // Make an AJAX request to update the discussion
                fetch(`../actions/discussion_user_action.php?discussionId=${discussionId}`, {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            title: newTitle,
                            content: newContent
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log("Edit response:", data);
                        // Update the discussion title and content in the DOM
                        discussionContainer.querySelector(".card-title").textContent = newTitle;
                        discussionContainer.querySelector(".card-text").textContent = newContent;
                        console.log(data.message); // Log success message or handle it as needed
                    })
                    .catch(error => console.error("Error:", error));
            });
            console.log("Edit discussion:", discussionId);



            // Check if the logged-in user is the author of the discussion
            // Delete button
            const deleteButton = document.createElement("button");
            deleteButton.classList.add("btn", "btn-danger");
            deleteButton.textContent = "Delete";
            deleteButton.addEventListener("click", () => {
                // Confirm before deletion
                if (confirm("Are you sure you want to delete this discussion?")) {
                    // Make an AJAX request to delete the discussion
                    fetch(`../actions/discussion_user_action.php?discussionId=${discussionId}`, {
                            method: "DELETE"
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log("Delete response:", data);
                            // Remove the discussion container from the DOM immediately
                            if (discussionContainer) {
                                discussionContainer.remove();
                            }
                            console.log(data.message); // Log success message or handle it as needed
                        })
                        .catch(error => console.error("Error:", error))
                        .finally(() => {
                            // Fetch and display discussions again after deletion
                            fetchAndDisplayDiscussions();
                        });
                }
            });


            buttonsContainer.appendChild(editButton);
            buttonsContainer.appendChild(deleteButton);

            return buttonsContainer;
        }

        // Function to fetch discussions and display them on the page
        function fetchAndDisplayDiscussions() {
            fetch("../actions/discussion_user_action.php")
                .then(response => response.json())
                .then(data => {
                    const discussionList = document.getElementById("discussionList");
                    discussionList.innerHTML = "";

                    data.forEach(discussion => {
                        const discussionContainer = document.createElement("div");
                        discussionContainer.classList.add("card", "mb-3");
                        discussionContainer.id = `discussion-${discussion.DiscussionID}`;

                        const discussionBody = document.createElement("div");
                        discussionBody.classList.add("card-body");
                        discussionBody.innerHTML = `
                    <h5 class="card-title">${discussion.Title}</h5>
                    <p class="card-text">${discussion.Content}</p>
                    <p class="card-text"><small class="text-muted">${discussion.CreatedAt}</small></p>
                `;

                        const discussionButtons = createDiscussionButtons(discussion.DiscussionID, discussionContainer);

                        discussionContainer.appendChild(discussionBody);
                        discussionContainer.appendChild(discussionButtons);

                        discussionList.appendChild(discussionContainer);
                    });
                })
                .catch(error => console.error("Error fetching discussions:", error));
        }

        // Event listener for the form submission
        document.getElementById("discussionForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the default form submission

            var formData = new FormData(this);
            fetch("../actions/discussion_user_action.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById("discussionTitle").value = "";
                    document.getElementById("discussionBody").value = "";
                    // Fetch and display discussions again after adding a new discussion
                    fetchAndDisplayDiscussions();
                })
                .catch(error => console.error("Error:", error));
        });

        // Fetch and display discussions when the page loads
        fetchAndDisplayDiscussions();
    </script>
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

    <script>
        function openEditModal(reflectionId, userId, movieTitle, reflection, improvementAreas, areasToDesist) {
            // Check if the user ID matches the ID of the reflection owner
            if (loggedInUserId === userId) {
                // User is authorized to edit the reflection
                // Pre-fill the edit modal fields with the reflection details
                document.getElementById("editReflectionId").value = reflectionId;
                document.getElementById("editMovieTitle").value = movieTitle;
                document.getElementById("editReflection").value = reflection;
                document.getElementById("editImprovementAreas").value = improvementAreas;
                document.getElementById("editAreasToDesist").value = areasToDesist;

                // Show the edit modal
                document.getElementById("editModal").style.display = "block";
            } else {
                // User is not authorized to edit this reflection
                // Display an error message or prevent the edit operation
                alert("You are not authorized to edit this reflection.");
            }
        }

        function submitEditedReflection() {
            // Extract the updated data from the modal form
            var reflectionId = document.getElementById("editReflectionId").value;
            var updatedMovieTitle = document.getElementById("editMovieTitle").value;
            var updatedReflection = document.getElementById("editReflection").value;
            var updatedImprovementAreas = document.getElementById("editImprovementAreas").value;
            var updatedAreasToDesist = document.getElementById("editAreasToDesist").value;


            document.getElementById("editModal").style.display = "none";
        }
    </script>

    <script src="/js/reflect.js"></script>



</body>

</html>