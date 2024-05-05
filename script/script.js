const container = document.querySelector('.container_message')

setInterval( () => {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            container.innerHTML = this.responseText
        }
    }
    xhttp.open("GET", "messages.php", true);
    xhttp.send()
}, 500)