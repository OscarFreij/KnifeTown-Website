var selectedCategoryRelationRecordId;

function sendQuerry(cba, data, alertContainer) {
    

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.readyState == 4)
        {
            console.log("CODE: "+this.status+" RESPONS: "+this.responseText);
            if (this.status == 202)
            {
                if (cba == "add_categoryRelationRecord" || cba == "add_categoryItemRelationRecord")
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


function saveCategory(category)
{
    var array = Array();
    var categoryid = category.id;
    

    var categoryLoadOrder = document.getElementById(categoryid+"loadOrder").value;
    let categorySubObject = {id: categoryid.substring(categoryid.indexOf('y')+1), loadOrder: categoryLoadOrder};
    array.push(categorySubObject);
    for (let i = 1; i < category.getElementsByTagName('ul')[0].children.length; i++) {
        const element = category.getElementsByTagName('ul')[0].children[i];
        
        console.log(element);

        var itemId = element.id.substring(element.id.indexOf('m')+1);
        var itenLoadOrder = document.getElementById(element.id+'loadOrder').value;
        var itenEnabled = 1;

        if (document.getElementById(element.id+'enabled').checked)
        {
            itenEnabled = 1;
        }
        else
        {
            itenEnabled = 0;
        }
        
        let subObject = {id: itemId, loadOrder: itenLoadOrder, enabled: itenEnabled};
        array.push(subObject);
    }
    console.log(array);
    sendQuerry('set_categoryRelationRecord',JSON.stringify(array), category);
}

function removeCategory(category)
{
    id = category.id.substring(category.id.indexOf('y')+1);
    var removalRow = category;
    removalRow.parentElement.removeChild(removalRow);
    sendQuerry('remove_categoryRelationRecord', id, document.getElementById('errorBox'));
}

function addCategory()
{
    var categoryId = document.getElementById('inputNameCategory').value.substring(document.getElementById('inputNameCategory').value.indexOf('-')+2);
    let params = new URLSearchParams(document.location.search);

    var menuId = params.get("menuId");
    var array = Array();

    array.push({menuId: menuId, categoryId: categoryId});

    console.log(array);
    sendQuerry('add_categoryRelationRecord', JSON.stringify(array), document.getElementById('errorBox'));
}

function removeItem(item)
{
    id = item.id.substring(item.id.indexOf('m')+1);
    var parrentParrent = item.parentElement.parentElement;
    var removalRow = item;
    removalRow.parentElement.removeChild(removalRow);
    sendQuerry('remove_categoryRelationRecord', id, parrentParrent);
}

function addItem()
{
    var menuCategoryItemRelations = selectedCategoryRelationRecordId;
    var itemId = document.getElementById('inputNameObject').value.substring(document.getElementById('inputNameObject').value.indexOf('-')+2);
    var array = Array();

    array.push({menuCategoryItemRelations: menuCategoryItemRelations, itemId: itemId});

    console.log(array);
    sendQuerry('add_categoryItemRelationRecord', JSON.stringify(array), document.getElementById('errorBox'));
}

function addItemPre(id)
{
    selectedCategoryRelationRecordId = id;
    clearItemModal();
}

function clearItemModal()
{
    document.getElementById('inputNameObject').value = "";
}

function clearCategoryModal()
{
    document.getElementById('inputNameCategory').value = "";
}