const showBtn = document.getElementById("showPass");
const showBtnC = document.getElementById("showPassC");

showBtn.addEventListener("click", function() {
    console.log("oi")
    const pass = document.getElementById("pass");
    const icon = showBtn.querySelector("svg use");

    // Alternar o tipo de campo de senha
    const fieldType = pass.getAttribute('type');
    if (fieldType === "password") {
        pass.setAttribute("type", "text");
        icon.setAttribute("xlink:href", "#eye"); // Mudar o ícone para "eye-open"
    } else {
        pass.setAttribute("type", "password");
        icon.setAttribute("xlink:href", "#eye-closed"); // Mudar o ícone para "eye-closed"
    }
});

showBtnC.addEventListener("click", function() {
    console.log("oi1")
    const pass = document.getElementById("passC");
    const icon = showBtnC.querySelector("svg use");

    // Alternar o tipo de campo de senha
    const fieldType = pass.getAttribute('type');
    if (fieldType === "password") {
        pass.setAttribute("type", "text");
        icon.setAttribute("xlink:href", "#eye"); // Mudar o ícone para "eye-open"
    } else {
        pass.setAttribute("type", "password");
        icon.setAttribute("xlink:href", "#eye-closed"); // Mudar o ícone para "eye-closed"
    }
})

