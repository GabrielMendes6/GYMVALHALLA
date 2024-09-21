// Header
window.onscroll = function() {myFunction()};
const header = document.getElementById("header");

window.addEventListener("scroll", function() {
    if(window.scrollY > 0) {
        header.style.position = "fixed";
        header.style.top = "0";
        header.style.boxShadow = "0px 2px 20px 0px #101010";
    } else {
        header.style.position = "sticky";
    }
})

//cart

const bag = document.getElementById("cart");
const divClose = document.getElementById("btnclose");
const divOpac = document.getElementById("divCarOpac");

bag.addEventListener("click", function() {
    divOpac.classList.remove("hidden");
})

divClose.addEventListener("click", function() {
    divOpac.classList.add("hidden");
})

const openMenu = document.getElementById("js-menu-mob");
const closeMob = document.getElementById("closeMob");
const MenuMob = document.getElementById("contMenuMob");

openMenu.addEventListener("click", ()=> {
    MenuMob.classList.remove("hidden");
});

closeMob.addEventListener("click", () => {
    MenuMob.classList.add("hidden");
});


