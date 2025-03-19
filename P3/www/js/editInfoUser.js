document.getElementById('change-info').addEventListener('click', function() {
    // Obtener el parámetro de la URL actual
    const urlParams = new URLSearchParams(window.location.search);
    

    // Construir la nueva URL
    const newUrl = `${window.location.origin}/edit_profile.php`;

    // Cambiar la URL sin recargar la página
    window.history.pushState({ path: newUrl }, '', newUrl);

    // Opcional: Puedes agregar aquí una llamada AJAX para obtener datos adicionales
    // o ejecutar alguna lógica después de cambiar la URL.

    console.log(`URL cambiada a: ${newUrl}`);
});
