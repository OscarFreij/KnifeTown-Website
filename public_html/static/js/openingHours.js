function setCurrentOpeningHours() {
    var a = new Date();
    var days = new Array(7);
    days[0] = "12:00-19:00";
    days[1] = null;
    days[2] = "11:00-19:00";
    days[3] = "11:00-19:00";
    days[4] = "11:00-19:00";
    days[5] = "12:00-20:00";
    days[6] = "12:00-20:00";
    var r = days[a.getDay()];

    if (r != null)
    {
        $('#currentOpeningHours')[0].innerText = "Openigh Hours Today "+r;
    }
    else
    {
        $('#currentOpeningHours')[0].innerText = "CLOSED"
    }
}

setCurrentOpeningHours();