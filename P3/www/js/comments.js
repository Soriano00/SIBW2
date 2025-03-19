document.addEventListener("DOMContentLoaded", function () {
    const userComment = document.querySelector(".usercomment");
    const publishBtn = document.querySelector("#publish");

    userComment.addEventListener("input", () => {
        if (!userComment.value) {
            publishBtn.setAttribute("disabled", "disabled");
            publishBtn.classList.remove("abled");
        } else {
            publishBtn.removeAttribute("disabled");
            publishBtn.classList.add("abled");
        }
    });
});