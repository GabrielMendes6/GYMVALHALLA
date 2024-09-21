const showBtn = document.getElementById("showPass");

showBtn.addEventListener("click", function() {
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
