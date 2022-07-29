function removeUser(user)
{
    username = user.children[0].innerText;
    var removalRow = user;
    removalRow.parentElement.removeChild(removalRow);
    let array = Array();
    array.push({username: username});
    sendQuerry('delete_user', JSON.stringify(array), document.getElementById('userList'));
}

function addUser()
{
    let username = document.getElementById('inputUsername').value;
    let password = document.getElementById('inputPassword').value;
    let array = Array();
    array.push({username: username, password: password});

    console.log(array);
    sendQuerry('create_user', JSON.stringify(array), document.getElementById('userList'));
}

function updateUsers()
{
    
    let array = Array();
    
    let userList = document.getElementById('userList').children[0];

    let username = "";
    let password = "";
    let superAdmin = "";
    let enabled = "";

    for (let i = 1; i < userList.children.length; i++) {
        const user = userList.children[i];
        username = user.children[0].innerText;
        password = user.children[1].value;

        if (user.children[2].children[0].children[0].checked)
        {
            superAdmin = 1;
        }
        else
        {
            superAdmin = 0;
        }

        if (user.children[3].children[0].children[0].checked)
        {
            enabled = 1;
        }
        else
        {
            enabled = 0;
        }
        array.push({username: username, password: password, superAdmin: superAdmin, enabled: enabled});
    }
    sendQuerry('update_users', JSON.stringify(array), document.getElementById('userList'));
}


function sendQuerry(cba, data, alertContainer) {
    

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.readyState == 4)
        {
            console.log("CODE: "+this.status+" RESPONS: "+this.responseText);
            if (this.status == 202 || this.status == 201)
            {
                alertContainerRaiser(cba, alertContainer, true);
            }
            else
            {
                alertContainerRaiser(cba, alertContainer, false);
            }
        }
    }
    xhttp.open("POST", "editorCallback.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("cba="+cba+"&data="+data);
}


function alertContainerRaiser(cba, alertContainer, success)
{
    if (success)
    {
        if (cba == "create_user")
        {
            window.location.reload();
        }
        let alert = document.createElement('div');
        alert.innerHTML = 
            '<div class="alert alert-success alert-dismissible fade show" role="alert">'+
            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" role="img" fill="currentColor" viewBox="0 0 16 16" class="me-1">'+
            '<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>'+
            '</svg>'+
            '<strong>Success!</strong> New data saved.'+
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
            '</div>';
        alertContainer.appendChild(alert);
    }
    else
    {
        let alert = document.createElement('div');
        alert.innerHTML = 
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" role="img" fill="currentColor" viewBox="0 0 16 16" class="me-1">'+
            '<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>'+
            '</svg>'+
            '<strong>Error!</strong> Unable to save new data, contact webmaster.'+
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
            '</div>';
        alertContainer.appendChild(alert);
    }
}