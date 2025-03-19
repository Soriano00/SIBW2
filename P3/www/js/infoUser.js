import {modal} from './modal.js'
import {deleteCookie} from './deleteCookie.js'
import {GetCookie} from './getCookie.js'

const error = GetCookie("error_update")

if(error){
    Swal.fire({
        title: 'Error',
        text: error,
        icon: 'error'
    })
    deleteCookie(error_update)
}

const forms = {
    CHANGE_INFO: 'INFO',
    CHANGE_PASSWORD: 'CHANGE_PASSWORDS'
}

let typeForm = ""

const changeInfoDiv = document.getElementById('change-info-div')
const changePassDiv = document.getElementById('change-pass-div')
const changeInfoButton = document.getElementById('change-info')
const emailInput = document.getElementById('email')[0]
const nameInput = document.getElementById('nombre')[0]
const form = document.getElementById('form')


changeInfoButton.onclick = () => {
    typeForm = forms.CHANGE_INFO
    modal.style.display = "flex"
    changeInfoDiv.style.display = "block"
    changePassDiv.style.display = "none"
}



form.onsubmit = (e) => {

    let error = ""

    if(typeForm === forms.CHANGE_INFO)
    {
        const re = /\S+@\S+\.\S+/;

        if(emailInput.value === '')
            error = "El email no es valido"
        else if(!re.test(emailInput.value))
            error = "El email no es valido"
        else if(nameInput.value === '')
            error = "El nombre no es valido"

    }


    if(error){
        e.preventDefault()

        Swal.fire({
            title:'Error',
            text: error,
            icon:'error',
        })
        }

}