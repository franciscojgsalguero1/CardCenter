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

function showEdit(id) {
    if (document.getElementById("editDiv"+id).style.display == "block") {
        document.getElementById("editDiv"+id).style.display = "none";
    } else {
        document.getElementById("editDiv"+id).style.display = "block";
    }
}

function openTab(evt, tab) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tab).style.display = "block";
    evt.currentTarget.className += " active";
}

function showBuy(id) {
    if (document.getElementById("buy"+id).style.display == "block") {
        document.getElementById("buy"+id).style.display = "none";
    } else {
        document.getElementById("buy"+id).style.display = "block";
    }
}

$("#card_counter").change(function() {
    let id = $(this).children(":selected").attr("id"),
        starting_link = $("#button_delete").attr('href'),
        split_link = starting_link.split('/'),
        item = document.getElementById("button_delete");

    split_link.pop();

    let final_link = split_link.join('/') + '/' + id;
    item.setAttribute('href', final_link);
});