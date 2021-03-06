function sendQuerry(itemName) {
    var c = document.getElementById('content').value;

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.readyState == 4)
        {
            console.log("CODE: "+this.status+" RESPONS: "+this.responseText);
            if (this.status == 202)
            {
                let alert = document.createElement('div');
                alert.innerHTML = 
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" role="img" fill="currentColor" viewBox="0 0 16 16" class="me-1">'+
                    '<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>'+
                    '</svg>'+
                    '<strong>Success!</strong> New content is set.'+
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                    '</div>';
                document.getElementsByClassName('container')[0].appendChild(alert);
            }
            else
            {
                let alert = document.createElement('div');
                alert.innerHTML = 
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" role="img" fill="currentColor" viewBox="0 0 16 16" class="me-1">'+
                    '<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>'+
                    '</svg>'+
                    '<strong>Error!</strong> Unable to set new content, contact webmaster.'+
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                    '</div>';
                document.getElementsByClassName('container')[0].appendChild(alert);
            }
        }
    }
    xhttp.open("POST", "editorCallback.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("cba=set_content&pageContent="+c+"&itemName="+itemName);
}