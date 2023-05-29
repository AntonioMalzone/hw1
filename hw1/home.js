function fetchMovies() {
    fetch("fetch_movie.php").then(fetchResponse).then(fetchMoviesJson);
}

function fetchResponse(response) {
    if (!response.ok) { return null };
    return response.json();
}

function fetchMoviesJson(json) {
    const container=document.querySelector('#results');
    let results = json;
    let num_results = json.length;
    for (let i = 0; i < num_results; i++) {
        const img = document.createElement('img');
        img.src = results[i].content.image;
        const locandina = document.createElement('div');
        locandina.dataset.movieid = results[i].content.id;
        locandina.dataset.title = results[i].content.title;
        locandina.dataset.image = results[i].content.image;
        locandina.classList.add('locandina');
        locandina.appendChild(img);
        const saveButton = document.createElement('button');
        saveButton.textContent = 'Rimuovi';
        saveButton.addEventListener('click', RimuoviFilm);
        locandina.appendChild(saveButton);
        container.appendChild(locandina);
    }
}

function RimuoviFilm(event){
    const locandina = event.currentTarget.parentNode;
    const formData = new FormData();
    formData.append('movieid', locandina.dataset.movieid);
    formData.append('title', locandina.dataset.title);
    formData.append('image', locandina.dataset.image);
    fetch("remove_movie.php", {method: 'post', body: formData}).then(dispatchResponse, dispatchError); 
    locandina.remove();
}

function dispatchResponse(response) {
    console.log(response);
    return response.json().then(databaseResponse); 
  }
  
  function dispatchError(error) { 
    console.log("Errore");
  }
  
  function databaseResponse(json) {
    if (!json.ok) {
        dispatchError();
        return null;
    }
  }

fetchMovies();