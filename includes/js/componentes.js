function loadHTML(elementId, url) {
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById(elementId).innerHTML = data;
        })
        .catch(error => console.error('Error loading component:', error));
}

window.addEventListener('DOMContentLoaded', (event) => {
    loadHTML('navbar', '../templates/cabecera.php');
    loadHTML('sidebar', '../templates/barraLateral.php');
});
