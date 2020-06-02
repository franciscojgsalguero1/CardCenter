function w3_open() {
    document.getElementById("main").style.marginLeft = "15%";
    document.getElementById("mySidebar").style.width = "15%";
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("openNav").style.display = 'none';
    document.getElementById("p1").style.marginLeft = "15%";
    console.log('open');
}

function w3_close() {
    document.getElementById("main").style.marginLeft = "0%";
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("openNav").style.display = "inline-block";
    document.getElementById("p1").style.marginLeft = "0%";
    console.log('close');
}

function logoutMenu() {
    if (document.getElementById("pruebas").style.display == "block") {
        document.getElementById("pruebas").style.display = "none";
    } else {
        document.getElementById("pruebas").style.display = "block";
    }
}
function gameMenu() {
    if (document.getElementById("dropdown-content").style.display == "block") {
        document.getElementById("dropdown-content").style.display = "none";
    } else {
        document.getElementById("dropdown-content").style.display = "block";
    }
}