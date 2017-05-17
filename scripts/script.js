var table, userLabel, tableLabel;

$(document).ready(function () {
    $(".button-collapse").sideNav();
    $('.modal').modal();

    tableName = document.getElementById("tableName") ? document.getElementById("tableName").textContent : null;
    userLabel = document.getElementById("userLabel") ? Number(document.getElementById("userLabel").textContent) : null;
    tableLabel = document.getElementById("tableLabel") ? Number(document.getElementById("tableLabel").textContent) : null;
});

function openInsertModal() {
    if (userLabel <= tableLabel) {
        $('#insertModal').modal('open');
    }
}

function openUpdateModal() {
    var checked = $("input[type='radio']:checked");

    if (checked.length) {
        if (userLabel === tableLabel) {
            $("#updateId").val(checked.val());
            var databaseItem = checked.data('object');
            for (var propertyName in databaseItem) {
                if (databaseItem.hasOwnProperty(propertyName)) {
                    $('[name="' + propertyName + '"]', '#updateForm').val(databaseItem[propertyName]);
                }
            }
            $('#updateModal').modal('open');
        }
    }
    else {
        // todo: show dialog saying 'you need to select value first'
    }
}

function openDeleteModal() {
    var checked = $("input[type='radio']:checked");

    if (checked.length) {
        if (userLabel === tableLabel) {
            $("#deleteId").val(checked.val());
            $('#deleteModal').modal('open');
        }
    } else {
        // todo: show dialog saying 'you need to select value first'
    }
}

function sendInsertForm() {
    var post = {
        tableName: tableName,
        data: $('#insertForm').serializeArray()
    };

    $.post("?controller=tables&action=insert", post, function (res) {
        if (res.includes('Fatal error')) {
            // todo: show popup with error message
            console.log(res);
        } else {
            location.reload();
        }
    });
}

function sendUpdateForm() {
    var post = {
        tableName: tableName,
        data: $('#updateForm').serializeArray()
    };

    $.post("?controller=tables&action=update", post, function (res) {
        if (res.includes('Fatal error')) {
            // todo: show popup with error message
            console.log(res);
        } else {
            location.reload();
        }
    });
}

function sendDeleteForm() {
    var post = {
        tableName: tableName,
        recordId: $('#deleteId').val()
    };

    $.post("?controller=tables&action=delete", post, function (res) {
        if (res.includes('Fatal error')) {
            // todo: show popup with error message
            console.log(res);
        } else {
            location.reload();
        }
    });
}
