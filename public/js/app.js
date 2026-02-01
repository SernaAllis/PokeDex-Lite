function toggleFavorite(name) {
  fetch(`?page=favorites&toggle=${name}`)
    .then(() => location.reload());
}
