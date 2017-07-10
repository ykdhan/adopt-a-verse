function tab(evt, tabName) {
    toggle_menu();
    // Declare all variables
    var i, tabcontent, tablinks;
    document.getElementsByClassName("side-bar").className = "side-bar";

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tabs");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" tabs-now", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " tabs-now";

    
    sides = document.getElementsByClassName("sides");
    for (i = 0; i < sides.length; i++) {
        sides[i].className = "sides border--round";
    }
    
    if (tabName == "tab-donate") {
        document.getElementById("side-language").className += " hide";
        document.getElementById("side-photo").className += " hide";
    } else if (tabName == "tab-about") {
        document.getElementById("side-total").className += " hide";
        document.getElementById("side-cart").className += " hide";
    } else {
        // do nothing
    }
}