function sendQuerry(cba, data, alertContainer) {
    

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.readyState == 4)
        {
            console.log("CODE: "+this.status+" RESPONS: "+this.responseText);
            if (this.status == 202)
            {
                if (cba == "create_openingHours_special")
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


function saveStandard()
{
    var array = Array();
    for (let i = 0; i < document.getElementById('listStandard').children.length; i++) {
        const element = document.getElementById('listStandard').children[i];
        if (element.id.includes('row'))
        {
            var id = element.id.substring(element.id.indexOf('w')+1);
            var startTime = document.getElementById(element.id+'startTime').value;
            var stopTime = document.getElementById(element.id+'stopTime').value;
            let subObject = {id: id, startTime: startTime, stopTime: stopTime};
            array.push(subObject);
        }
    }
    
    console.log(array);

    sendQuerry('set_openingHours_standard',JSON.stringify(array), document.getElementById('openingHoursStandardList'));
}

function saveSpecial()
{
    var array = Array();
    for (let i = 0; i < document.getElementById('listSpecial').children.length; i++) {
        const element = document.getElementById('listSpecial').children[i];
        if (element.id.includes('row'))
        {
            console.log(element);
            var id = element.id.substring(element.id.indexOf('w')+1);
            var name = encodeURIComponent(document.getElementById(element.id+'name').value);
            var startTime = document.getElementById(element.id+'startTime').value;
            var stopTime = document.getElementById(element.id+'stopTime').value;
            var date = document.getElementById(element.id+'date').value;
            var showdate = document.getElementById(element.id+'showdate').value;
            var noshowdate = document.getElementById(element.id+'noshowdate').value;
            let subObject = {id: id, name: name, startTime: startTime, stopTime: stopTime, specialDate: date, specialViewStart: showdate, specialViewStop: noshowdate};
            array.push(subObject);
        }
    }

    sendQuerry('set_openingHours_special',JSON.stringify(array), document.getElementById('openingHoursSpecialList'));
}

function createSpecial()
{
    var array = Array();
    var name = encodeURIComponent(document.getElementById('inputName').value);
    var startTime = document.getElementById('inputOpenTime').value;
    var stopTime = document.getElementById('inputCloseTime').value;
    var date = document.getElementById('inputDate').value;
    var showdate = document.getElementById('inputShowDate').value;
    var noshowdate = document.getElementById('inputNoShowDate').value;
    let subObject = {name: name, startTime: startTime, stopTime: stopTime, specialDate: date, specialViewStart: showdate, specialViewStop: noshowdate};
    array.push(subObject);

    sendQuerry('create_openingHours_special',JSON.stringify(array), document.getElementById('openingHoursSpecialList'));
}


function removeRow(id)
{
    var removalRow = document.getElementById('row'+id);
    removalRow.parentElement.removeChild(removalRow);
    sendQuerry('remove_openingHours_special', id, document.getElementById('openingHoursSpecialList'));
}