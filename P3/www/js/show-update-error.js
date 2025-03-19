import { deleteCookie } from "deleteCookie.js"
import { getCookie } from "getCookie.js"

const error = getCookie("error_update_event")

if(error){
    Swal.fire({
        title: 'Error',
        text: error,
        icon: 'error'
    })
    deleteCookie("error_update_event")
}