// Function to fetch movies based on search query
function searchMovies(query) {
    const apiKey = 'e8b7d8a631a833c10df5c0a3fbdced29';
    const apiUrl = `https://api.themoviedb.org/3/search/movie?api_key=${apiKey}&query=${query}`;

    // $url = "https://api.themoviedb.org/3/trending/movie/week?api_key=$api_key";

    fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                // throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.results.length === 0) {
                displayErrorMessage('No results found');
            } else {
                displayResults(data.results);
            }
        })
        .catch(error => {
            console.error('Error fetching movies:', error);
            // displayErrorMessage('An error occurred while fetching movies. Please try again later.');
        });
}

// Function to display search results
function displayResults(results) {
    const resultsContainer = document.getElementById('results');
    resultsContainer.innerHTML = '';

    results.forEach(movie => {
        const movieElement = document.createElement('div');
        movieElement.classList.add('movie');
        movieElement.innerHTML = `
            <h2>${movie.title} (${movie.release_date ? movie.release_date.substring(0, 4) : 'N/A'})</h2>
            <p>${movie.overview}</p>
        `;
        resultsContainer.appendChild(movieElement);
    });
}

// Function to display error message
function displayErrorMessage(message) {
    const errorElement = document.createElement('div');
    errorElement.classList.add('error');
    errorElement.textContent = message;
    const resultsContainer = document.getElementById('results');
    resultsContainer.innerHTML = '';
    resultsContainer.appendChild(errorElement);
}

// Function to handle search form submission
function handleSearch(event) {
    event.preventDefault();
    const query = document.getElementById('search-input').value;
    if (query.trim() !== '') {
        searchMovies(query);
    } else {
        // displayErrorMessage('Please enter a valid search query');
    }
}

// Event listener for search form submission
document.getElementById('search-form').addEventListener('submit', handleSearch);



// Function to display search results
function displayResults(results) {
    const resultsContainer = document.getElementById('results');
    resultsContainer.innerHTML = '';

    results.forEach(movie => {
        // Create a container for each movie
        const movieContainer = document.createElement('div');
        movieContainer.classList.add('movie');

        // Create an image element for the movie poster
        const posterUrl = movie.poster_path ? `https://image.tmdb.org/t/p/w500${movie.poster_path}` : 'placeholder.jpg'; // Use a placeholder image if poster not available
        const posterImg = document.createElement('img');
        posterImg.src = posterUrl;
        posterImg.alt = movie.title;
        posterImg.classList.add('poster');
        movieContainer.appendChild(posterImg);

        // Create a container for movie details
        const detailsContainer = document.createElement('div');
        detailsContainer.classList.add('details');

        // Create a title element for the movie
        const titleElement = document.createElement('h2');
        titleElement.textContent = movie.title;
        detailsContainer.appendChild(titleElement);

        // Create a release date element for the movie
        const releaseDateElement = document.createElement('p');
        releaseDateElement.textContent = `Release Date: ${movie.release_date}`;
        detailsContainer.appendChild(releaseDateElement);

        // Create a paragraph element for the movie overview
        const overviewElement = document.createElement('p');
        overviewElement.textContent = movie.overview;
        detailsContainer.appendChild(overviewElement);

        // Append details container to the movie container
        movieContainer.appendChild(detailsContainer);

        // Append the movie container to the results container
        resultsContainer.appendChild(movieContainer);
    });
}
