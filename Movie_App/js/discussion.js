function createDiscussionButtons(discussionId, discussionContainer) {
    const buttonsContainer = document.createElement("div");
    buttonsContainer.classList.add("discussion-buttons");

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