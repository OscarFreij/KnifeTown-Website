function ToggleEnabledTextModal()
{
    if (document.querySelector("#createMenuModal > div > div > div.modal-body > div > div:nth-child(3) > input").checked)
    {
        document.querySelector("#createMenuModal > div > div > div.modal-body > div > div:nth-child(3) > label").innerText = "Visa i meny";
    }
    else
    {
        document.querySelector("#createMenuModal > div > div > div.modal-body > div > div:nth-child(3) > label").innerText = "Visa INTE i meny";
    }
    
}



function sendQuerry(cba, data, alertContainer) {
    

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.readyState == 4)
        {
            console.log("CODE: "+this.status+" RESPONS: "+this.responseText);
            if (this.status == 202)
            {
                if (cba == "create_menu" || cba == "create_category" || cba == "create_menuItem" ||cba == "set_menuItems")
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
    }
    xhttp.open("POST", "editorCallback.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("cba="+cba+"&data="+data);
}

function createMenu()
{
    var array = Array();
    var name = encodeURIComponent(document.getElementById('inputNameMenu').value);
    var loadOrder = document.getElementById('inputOrderMenu').value;
    var enabled = 1;

    if (document.getElementById('inputEnabledMenu').checked)
    {
        enabled = 1;
    }
    else
    {
        enabled = 0;
    }

    let subObject = {name: name, loadOrder: loadOrder, enabled: enabled};
    array.push(subObject);

    sendQuerry('create_menu',JSON.stringify(array), document.getElementById('menuList'));
}

function saveMenus()
{
    var array = Array();
    for (let i = 0; i < document.getElementById('listMenu').children.length; i++) {
        const element = document.getElementById('listMenu').children[i];
        if (element.id.includes('menu'))
        {
            console.log(element);
            var id = element.id.substring(element.id.indexOf('u')+1);
            var name = encodeURIComponent(document.getElementById(element.id+'name').value);
            var loadOrder = document.getElementById(element.id+'loadOrder').value;
            var enabled = 1;

            if (document.getElementById(element.id+'enabled').checked)
            {
                enabled = 1;
            }
            else
            {
                enabled = 0;
            }

            let subObject = {id: id, name: name, loadOrder: loadOrder, enabled: enabled};
            array.push(subObject);
        }
    }

    sendQuerry('set_menus',JSON.stringify(array), document.getElementById('menuList'));
}

function removeMenu(id)
{
    var removalRow = document.getElementById('menu'+id);
    removalRow.parentElement.removeChild(removalRow);
    sendQuerry('remove_menu', id, document.getElementById('menuList'));
}

function createCategory()
{
    var array = Array();
    var name = encodeURIComponent(document.getElementById('inputNameCategory').value);

    let subObject = {name: name};
    array.push(subObject);

    sendQuerry('create_category',JSON.stringify(array), document.getElementById('categoryList'));
}

function saveCategories()
{
    var array = Array();
    for (let i = 0; i < document.getElementById('listCategory').children.length; i++) {
        const element = document.getElementById('listCategory').children[i];
        if (element.id.includes('category'))
        {
            console.log(element);
            var id = element.id.substring(element.id.indexOf('y')+1);
            var name = encodeURIComponent(document.getElementById(element.id+'name').value);

            let subObject = {id: id, name: name};
            array.push(subObject);
        }
    }

    sendQuerry('set_categories',JSON.stringify(array), document.getElementById('categoryList'));
}

function removeCategory(id)
{
    var removalRow = document.getElementById('category'+id);
    removalRow.parentElement.removeChild(removalRow);
    sendQuerry('remove_category', id, document.getElementById('categoryList'));
}


async function readFileAsDataURL(file) {
    let result_base64 = await new Promise((resolve) => {
        let fileReader = new FileReader();
        fileReader.onload = (e) => resolve(fileReader.result);
        fileReader.readAsDataURL(file);
    });

    //console.log(result_base64); // aGV5IHRoZXJl...

    return result_base64;
}


async function createItem()
{
    var array = Array();
    var name = encodeURIComponent(document.getElementById('inputNameItem').value);
    var imageData = "";
    if (typeof document.getElementById('inputImageItem').files[0] != "undefined")
    {
        imageData = btoa(encodeURIComponent(await readFileAsDataURL(document.getElementById('inputImageItem').files[0])));
    }
    var description = encodeURIComponent(document.getElementById('inputDescriptionItem').value);
    var price = document.getElementById('inputPriceItem').value;

    let subObject = {name: name, imageData: imageData, description: description, price: price};
    array.push(subObject);

    console.log(array);
    sendQuerry('create_menuItem',JSON.stringify(array), document.getElementById('itemList'));
}

async function saveItems()
{
    var array = Array();
    for (let i = 0; i < document.getElementById('listItem').children.length; i++) {
        const element = document.getElementById('listItem').children[i];
        if (element.id.includes('item'))
        {
            console.log(element);
            var id = element.id.substring(element.id.indexOf('m')+1);
            var name = encodeURIComponent(document.getElementById(element.id+'name').value);
            var imageData = "";
            if (typeof document.getElementById(element.id+'image').files[0] != "undefined")
            {
                imageData = btoa(encodeURIComponent(await readFileAsDataURL(document.getElementById(element.id+'image').files[0])));
            }
            var description = encodeURIComponent(document.getElementById(element.id+'description').value);
            var price = document.getElementById(element.id+'price').value;

            let subObject = {id: id, name: name, imageData: imageData, description: description, price: price};
            array.push(subObject);
        }
    }

    console.log(JSON.stringify(array));
    sendQuerry('set_menuItems',JSON.stringify(array), document.getElementById('itemList'));
}

function removeItem(id)
{
    var removalRow = document.getElementById('item'+id);
    removalRow.parentElement.removeChild(removalRow);
    sendQuerry('remove_menuItem', id, document.getElementById('itemList'));
}