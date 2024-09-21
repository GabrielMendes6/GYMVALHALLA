const img = document.getElementById("img-banner");
window.addEventListener("resize", function() {
    if(this.window.innerWidth <= 768) {
        img.src = "../img/Background-Darksimple-Bodybuilder-Mobile-Gymalhalla.png";
    } else {
        img.src = "../img/Background-Darksimple-Bodybuilder-Gymalhalla.png"
    }

});

/////////////////////////////
const prod1 = document.getElementById("js-prod1"); 
const prod2 = document.getElementById("js-prod2"); 
const prod3 = document.getElementById("js-prod3"); 
const prod4 = document.getElementById("js-prod4"); 
const prod5 = document.getElementById("js-prod5"); 
const prod6 = document.getElementById("js-prod6"); 

prod1.addEventListener("mouseenter", ()=> {
    prod1.src = "../img/Tshirts/TrueClub-Back.webp";
});

prod1.addEventListener("mouseleave", ()=> {
    prod1.src = "../img/Tshirts/TrueClub-Front.webp";
});

prod2.addEventListener("mouseenter", ()=> {
    prod2.src = "../img/Tshirts/CompanyOffWhite-Back.webp";
});

prod2.addEventListener("mouseleave", ()=> {
    prod2.src = "../img/Tshirts/CompanyOffWhite-Front.webp";
});

prod3.addEventListener("mouseenter", ()=> {
    prod3.src = "../img/Tshirts/LegendsGrey-Back.webp";
});

prod3.addEventListener("mouseleave", ()=> {
    prod3.src = "../img/Tshirts/LegendsGrey-Front.webp";
});

prod4.addEventListener("mouseenter", ()=> {
    prod4.src = "../img/Tshirts/CompanyPurple-Back.webp";
});

prod4.addEventListener("mouseleave", ()=> {
    prod4.src = "../img/Tshirts/CompanyPurple-Front.webp";
});

prod5.addEventListener("mouseenter", ()=> {
    prod5.src = "../img/Tshirts/shortsDropStar-Back.webp";
});

prod5.addEventListener("mouseleave", ()=> {
    prod5.src = "../img/Tshirts/shortsDropStar-Side1.webp";
});

prod6.addEventListener("mouseenter", ()=> {
    prod6.src = "../img/Tshirts/CoatOfArmsPink-Back.webp";
});

prod6.addEventListener("mouseleave", ()=> {
    prod6.src = "../img/Tshirts/CoatOfArmsPink-Front.webp";
});