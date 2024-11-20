//Searching on index3.php

document.addEventListener('DOMContentLoaded', function () {
    const searchForm = document.getElementById('search-form');
    const searchResultsContainer = document.getElementById('search-results-container');
    //console.log('searchForm:', searchForm);
    //console.log('searchResultsContainer:', searchResultsContainer);

    if (searchForm && searchResultsContainer) {
        searchForm.addEventListener('submit', async (event) => {
        event.preventDefault(); // Prevent default form submission
        const searchQuery = document.getElementById('searchQuery').value;

        // Make an AJAX request to the current page (index3.php) with the searchQuery
        try {
                const response = await fetch(`index3.php?searchQuery=${searchQuery}`);
                const html = await response.text();
                // Update only the search results container
                searchResultsContainer.innerHTML = html;
                //console.log('responses:', response);
                //console.log('html:', html);

            } catch (error) {
                console.error('Error:', error);
            }
        });
    } else {
        console.error('Search form or results container not found.');
    }
});

function processForm(e) {
    var respuest = confirm("Desea GRABAR el Registro ...?");
    if (respuest == false) {
        e.preventDefault();
    } else {
        alert('ALTA Exitosa !!!');
    }
}

function wantdelete(e) {
    var respuest2 = confirm("Desea realmente BORRAR el Registro ...?");
    if (respuest2 == false) {
        e.preventDefault();
    } else {
        alert('BORRADO Con fir ma do !!!');
    }
}

function logout() {
    window.location.href = 'loginAdmin.php';
}