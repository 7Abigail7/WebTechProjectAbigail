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
    }); console.log("Edit discussion:", discussionId);



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
document.getElementById("discussionForm").addEventListener("submit", function (event) {
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
