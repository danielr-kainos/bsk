var table = document.getElementById("tableName") ? document.getElementById("tableName").value : null;
var userLabel = document.getElementById("userLabel") ? document.getElementById("userLabel").value : null;
var tableLabel = document.getElementById("tableLabel") ? document.getElementById("tableLabel").value : null;

$(".button-collapse").sideNav();

// todo: only open update and delete modals if record was chosen
// todo: prepopulate forms with data
$(document).ready(function(){
    $('.modal').modal();
});
