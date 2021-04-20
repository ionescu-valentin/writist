// #############################
// PUBLIC VARS AND CONSTS HERE 
// #############################

const browseArea = document.getElementById("browsing-area");
const BrowseTabs = document.getElementById("browsing-tabs");
const BottomNav = document.getElementById("bottom-nav-wrapper");
const collection = document.getElementsByClassName("collection-item");

var prevScrollpos = window.pageYOffset;


// ##################
// FUNCTIONS HERE 
// ###################

// function to scroll to the top
const toTheTop = () => {
    $("html").animate({ scrollTop: 0 });
}

// changes according to scroll level
const colorChange = () => {
    // when scrolled 1000 or lower
    if (document.body.scrollTop > 1000 || document.documentElement.scrollTop > 1000) {
        BrowseTabs.classList.add("amber", "darken-4");
        BrowseTabs.classList.remove("blue", "darken-2");
        BottomNav.classList.add("amber");
        BottomNav.classList.remove("blue");
    }
    // when scrolled higher than 1000
    else {
        BrowseTabs.classList.add("blue", "darken-2");
        BrowseTabs.classList.remove("amber", "darken-4");
        BottomNav.classList.remove("amber");
        BottomNav.classList.add("blue");
    }
}

// function to hide navbar on scroll down
const hideNav = () => {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        BrowseTabs.style.top = "0";
    } else {
        BrowseTabs.style.top = "-200px";
    }
    prevScrollpos = currentScrollPos;
}

// switch to clicked element in a collection
const setActive = (item, index) => {
    for (let i = 0; i < item.length; i++) {
        item[i].classList.remove("active");
    }
    item[index].classList.add("active");
}


// ##################
// EVENTS HERE 
// ###################

window.addEventListener("resize", reArrange);

BrowseTabs.addEventListener("click", toTheTop);

for (let i = 0; i < collection.length; i++) {
    collection[i].onclick = function () { setActive(collection, i) };
}

// on scroll events for browse page
browseArea.onscroll = function () {
    colorChange();
    hideNav()
};