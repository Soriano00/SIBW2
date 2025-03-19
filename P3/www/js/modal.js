export const modal = document.getElementById('modal-form-content');
export const closeButton = document.getElementById('close-modal');


window.onclick = (actividad) => {
    if(actividad.target == modal)
        modal.style.display = "none"
}

closeButton.onclick = () => {
    modal.style.display = "none"
}