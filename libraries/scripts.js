function editSupervisor() {

    var x = document.getElementById("editSupervisor");
    var y = document.getElementById("supervisor");

    if(x.style.display === "none"){
        x.style.display = "block";
        y.style.display = "none";

    }
}
function createSupervisor(){
    var x = document.getElementById("createSupervisor");
    var y = document.getElementById("supervisor");

    if (x.style.display === "none"){
        y.style.display = "none";
        x.style.display = "block";
    }
}

function editSupervisorMonday() {
    var x = document.getElementById("supervisorMonday");
    var monday = $('button#supervisorMonday').val();

    if (monday === "0") {
        x.className = "btn col s2 grey";
        $('button#supervisorMonday').val(1);
        var monday = $('button#supervisorMonday').val();
        $.post('processSupervisor.php', {monday: monday});
    }


    else if (monday === "1") {
        x.className = "btn col s2 green";
        $('button#supervisorMonday').val(0);
        var monday = $('button#supervisorMonday').val();
        $.post('processSupervisor.php', {monday: monday});

    }
}
function editSupervisorTuesday() {
    var x = document.getElementById("supervisorTuesday");
    var tuesday = $('button#supervisorTuesday').val();

    if (tuesday === "0") {
        x.className = "btn col s2 grey";
        $('button#supervisorTuesday').val(1);
        var tuesday = $('button#supervisorTuesday').val();
        $.post('processSupervisor.php', {tuesday: tuesday});

    }


    else if (tuesday === "1") {
        x.className = "btn col s2 green";
        $('button#supervisorTuesday').val(0);
        var tuesday = $('button#supervisorTuesday').val();
        $.post('processSupervisor.php', {tuesday: tuesday});

    }
}

function editSupervisorWednesday() {
    var x = document.getElementById("supervisorWednesday");
    var wednesday = $('button#supervisorWednesday').val();

    if (wednesday === "0") {
        x.className = "btn col s2 grey";
        $('button#supervisorWednesday').val(1);
        var wednesday = $('button#supervisorWednesday').val();
        $.post('processSupervisor.php', {wednesday: wednesday});
    }

    else if (wednesday === "1") {
        x.className = "btn col s2 green";
        $('button#supervisorWednesday').val(0);
        var wednesday = $('button#supervisorWednesday').val();
        $.post('processSupervisor.php', {wednesday: wednesday});
    }
}

function editSupervisorThursday() {
    var x = document.getElementById("supervisorThursday");
    var thursday = $('button#supervisorThursday').val();

    if (thursday === "0") {
        x.className = "btn col s2 grey";
        $('button#supervisorThursday').val(1);
        var thursday = $('button#supervisorThursday').val();
        $.post('processSupervisor.php', {thursday: thursday});
    }


    else if (thursday === "1") {
        x.className = "btn col s2 green";
        $('button#supervisorThursday').val(0);
        var thursday = $('button#supervisorThursday').val();
        $.post('processSupervisor.php', {thursday: thursday});


    }
}

function editSupervisorFriday() {
    var x = document.getElementById("supervisorFriday");
    var friday = $('button#supervisorFriday').val();

    if (friday === "0") {
        x.className = "btn col s2 grey";
        $('button#supervisorFriday').val(1);
        var friday = $('button#supervisorFriday').val();
        $.post('processSupervisor.php', {friday: friday});


    }


    else if (friday === "1") {
        x.className = "btn col s2 green";
        $('button#supervisorFriday').val(0);
        var friday = $('button#supervisorFriday').val();
        $.post('processSupervisor.php', {friday: friday});


    }
}


function openCalendar() {
    var x = document.getElementById("calendar");
    var y = document.getElementById("supervisor");
    var a = document.getElementById("editSupervisor");
    var z = document.getElementById("name-data");
    var b = document.getElementById("createSupervisor");
    var name = $('button#monday').val();

    if ($.trim(name) != '') {
        $.post('process.php', {name: name}, function (data) {
            $('div#name-data').html(data);

        });
    }
    if (x.style.display === "none") {
        x.style.display = "block";
        z.style.display = "block";
        y.style.display = "none";
        a.style.display = "none";
        b.style.display = "none";
    } else {
        x.style.display = "none";
        z.style.display = "none";
    }
}

function openSupervisor() {

    var x = document.getElementById("supervisor");
    var y = document.getElementById("calendar");
    var z = document.getElementById("name-data");
    var a = document.getElementById("editSupervisor");
    var b = document.getElementById("createSupervisor");
    if (x.style.display === "none") {
        x.style.display = "block";
        z.style.display = "none";
        y.style.display = "none";
        a.style.display = "none";
        b.style.display = "none";
    } else {
        x.style.display = "none";
        z.style.display = "none";
    }
}

function schedule() {
    var info = document.getElementById("info");
    var schedule = document.getElementById("schedule")

    if (info.style.display === "block"){
        info.style.display = "none";

    }
    else {
        info.style.display = "block";
    }
    if(schedule.style.display === "none"){
        schedule.style.display = "block";
    }
    else{
        schedule.style.display = "none";
    }
}


$('button#monday').on('click', function () {
    var name = $('button#monday').val();

    if ($.trim(name) != '') {
        $.post('process.php', {name: name}, function (data) {
            $('div#name-data').html(data);

        });
    }
});


$('button#tuesday').on('click', function () {
    var name = $('button#tuesday').val();
    if ($.trim(name) != '') {
        $.post('process.php', {name: name}, function (data) {
            $('div#name-data').html(data);

        });
    }
});

$('button#wednesday').on('click', function () {
    var name = $('button#wednesday').val();
    if ($.trim(name) != '') {
        $.post('process.php', {name: name}, function (data) {
            $('div#name-data').html(data);

        });
    }
});

$('button#thursday').on('click', function () {
    var name = $('button#thursday').val();
    if ($.trim(name) != '') {
        $.post('process.php', {name: name}, function (data) {
            $('div#name-data').html(data);

        });
    }
});

$('button#friday').on('click', function () {
    var name = $('button#friday').val();
    if ($.trim(name) != '') {
        $.post('process.php', {name: name}, function (data) {
            $('div#name-data').html(data);

        });
    }
});

$('button#mondayUser').on('click', function () {
    var data = document.getElementById("mondayUser");
    var currentClass = data.className;

    if (currentClass == "btn waves-effect waves-light") {
        data.className = "btn waves-effect waves-light grey";
    }
    else(data.className = "btn waves-effect waves-light")


});

$('button#tuesdayUser').on('click', function () {
    var data = document.getElementById("tuesdayUser");
    var currentClass = data.className;

    if (currentClass == "btn waves-effect waves-light") {
        data.className = "btn waves-effect waves-light grey";
    }
    else(data.className = "btn waves-effect waves-light")


});

$('button#wednesdayUser').on('click', function () {
    var data = document.getElementById("wednesdayUser");
    var currentClass = data.className;

    if (currentClass == "btn waves-effect waves-light") {
        data.className = "btn waves-effect waves-light grey";
    }
    else(data.className = "btn waves-effect waves-light")


});

$('button#thursdayUser').on('click', function () {
    var data = document.getElementById("thursdayUser");
    var currentClass = data.className;

    if (currentClass == "btn waves-effect waves-light") {
        data.className = "btn waves-effect waves-light grey";
    }
    else(data.className = "btn waves-effect waves-light")


});

$('button#fridayUser').on('click', function () {
    var data = document.getElementById("fridayUser");
    var currentClass = data.className;

    if (currentClass == "btn waves-effect waves-light") {
        data.className = "btn waves-effect waves-light grey";
    }
    else(data.className = "btn waves-effect waves-light")


});



$(".button-collapse").sideNav();

