import { deleteCookie } from "deleteCookie.js"
import { getCookie } from "getCookie.js"

// Show an error if the user has already been registered
const error = getCookie('error_register')

if ( error ) {
    Swal.fire({
        title: 'Error',
        text: error,
        icon: 'error'
    })

    deleteCookie('error_register')
}

document.querySelector("change-info").addEventListener("click", function(){
    document.querySelector(".popup").classList.add("active");
});

document.querySelector(".popup .close-btn").addEventListener("click", function(){
    document.querySelector(".popup").classList.remove("active");
});

// Check the form
const button      = document.getElementById('edit-button')
const emailInput  = document.getElementsByName('email')[0]
const nameInput   = document.getElementsByName('name')[0]

button.onclick = ( e ) => {

    let error = ""
    const re = /\S+@\S+\.\S+/;

    if ( emailInput.value === '' )
        error = "El email es requerido"
    else if ( !re.test(emailInput.value) )
        error = "El email no es correcto"
    else if ( nameInput.value === '' )
        error = "El nombre es requerido"
    
    if ( error ) {
        e.preventDefault()

        Swal.fire({
            title: 'Error',
            text: error,
            icon: 'error'
        })
    } 
}