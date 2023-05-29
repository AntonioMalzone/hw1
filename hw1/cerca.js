function salvaFilm(event) {
  const locandina = event.currentTarget.parentNode;
  const formData = new FormData();
  formData.append('movieid', locandina.dataset.movieid);
  formData.append('title', locandina.dataset.title);
  formData.append('image', locandina.dataset.image);
  fetch("save_movie.php", { method: 'post', body: formData }).then(dispatchResponse, dispatchError);
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
function search(event) {
  const element = document.querySelector('form');
  const loading = document.createElement('div');
  loading.innerHTML = 'Caricamento...';
  element.appendChild(loading);
  event.preventDefault();
  const form_data = { method: "post", body: new FormData(event.currentTarget) }
  fetch("cerca_film.php", form_data).then(onResponse).then(onJSON);
}
function onResponse(response) {
  if (response.ok) {
    return response.json()
  }
}
function onJSON(json) {
  console.log(json);
  const grid = document.querySelector('#grid');
  console.log(json);
  grid.innerHTML = '';
  const results = json.results;
  let num_results = results.length;
  for (let i = 0; i < num_results; i++) {
    const img = document.createElement('img');
    if (results[i].image !== '') {
      img.src = results[i].image;
      const locandina = document.createElement('div');
      locandina.dataset.movieid = results[i].id;
      locandina.dataset.title = results[i].title;
      locandina.dataset.image = results[i].image;
      locandina.classList.add('locandina');
      locandina.appendChild(img);
      const saveButton = document.createElement('button');
      saveButton.textContent = 'Salva Film';
      saveButton.addEventListener('click', salvaFilm);
      locandina.appendChild(saveButton);
      grid.appendChild(locandina);
    }
  }
  grid.scrollIntoView({
    behavior: 'smooth'
  });
  const element = document.querySelector('form');
  element.removeChild(element.lastElementChild);
}
//MAIN
document.querySelector('#search').addEventListener('submit', search);