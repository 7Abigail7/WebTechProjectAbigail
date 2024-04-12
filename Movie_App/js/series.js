
    //         // Infinite scrolling functionality
    // var page = <?php echo $page; ?>;
    // var isLoading = false;

    // window.addEventListener('scroll', function() {
    //             if (window.innerHeight + window.scrollY >= document.body.offsetHeight && !isLoading) {
    //     isLoading = true;
    // page++;
    // loadMoreMovies(page);
    //             }
    //         });

    // function loadMoreMovies(page) {
    //             var xhr = new XMLHttpRequest();
    // xhr.open('GET', 'https://api.themoviedb.org/3/movie/top_rated?api_key=<?php echo $api_key; ?>&page=' + page, true);
    // xhr.onload = function() {
    //                 if (xhr.status >= 200 && xhr.status < 400) {
    //                     var data = JSON.parse(xhr.responseText);
    // var movies = data.results;
    // var moviesContainer = document.getElementById('movies');

    // movies.forEach(function(movie) {
    //                         var movieCard = document.createElement('div');
    // movieCard.classList.add('card');
    // movieCard.innerHTML = `
    // <img src="https://image.tmdb.org/t/p/w500${movie.poster_path}" alt="${movie.title}">
    //     <h2>${movie.title}</h2>
    //     <p><strong>Release Date:</strong> ${movie.release_date}</p>
    //     <p>${movie.overview}</p>
    //     `;
    //     moviesContainer.appendChild(movieCard);
    //                     });

    //     isLoading = false;
    //                 } else {
    //         console.error('Failed to fetch data from API.');
    //                 }
    //             };
    //     xhr.send();
    //         }
