const deleteUser = (idUser) => {
    window.location.replace(`../php/delete_user.php?user=${idUser}`);
}

const updateUser = (idUser, index) => {
    const role = document.getElementsByClassName('rol-select')[index - 1].value;
    window.location.replace(`../php/change_user_role.php?user=${idUser}&role=${role}`);
}
