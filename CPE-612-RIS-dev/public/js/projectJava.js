'use strict'

function calculate() {
    var a = document.getElementById('all_OHC').value;
    var b = document.getElementById('all_money_project').value;
    document.getElementById('percent_OHC').value = (parseInt(a) / parseInt(b)) * 100;
}

function separate_OHC() {
    var c = document.getElementById('all_OHC').value;

    var b = document.getElementById('OHC_types').value;

    if (b == "วิจัย สังกัดภาควิชา") {
        document.getElementById('cmu').value = parseInt(c) * 0.3;
        document.getElementById('faculty').value = parseInt(c) * 0.3;
        document.getElementById('departments').value = parseInt(c) * 0.4;
    } else if (b == "วิจัย สังกัดคณะ") {
        document.getElementById('cmu').value = parseInt(c) * 0.5;
        document.getElementById('faculty').value = parseInt(c) * 0.5;
        document.getElementById('departments').value = parseInt(c) * 0;
    }
}

$(document).ready(function () {
    var i = 1;

    $('#add').click(function () {
        i++;
        $('#dynamic_field').append('<tr id="row' + i +
            '"><td><br><input type="text" name="name[]"  placeholder="Enter your Name" class="form-control name_list" /></td><td><br><button type="button" name="remove" id="' +
            i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
    });

    $('#add').click(function () {
        i++;
        $('#dynamic_field1').append('<tr id="row' + i +
            '"><td><br><input type="text" name="name[]"  placeholder="Enter your Name" class="form-control name_list" /></td><td><br><button type="button" name="remove" id="' +
            i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
    });

    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });

});