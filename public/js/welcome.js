const xhttp = new XMLHttpRequest();
xhttp.onload = function() {
    document.getElementById("ads").innerHTML = this.responseText;
}
xhttp.open("GET", "paginate?page=1", true);
xhttp.send();