import {deleteCookie} from './deleteCookie.js'
import {getCookie} from './getCookie.js'


//Show error
let cookie = "";

let error = getCookie("error_delete_user")

if(error)
    cookie = "error_delete_user"
else{
    error = getCookie("error_change_role")
    if(error)
        cookie = "error_change_role"
}


if(error){
    Swal.fire({
        title:'Error',
        text: error,
        icon:'error',
    })

    deleteCookie(cookie)
}