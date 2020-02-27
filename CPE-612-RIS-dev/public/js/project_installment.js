'use strict'

function default_value1() {

    document.getElementById('fee').defaultValue = "0";
    document.getElementById('advance').defaultValue = "0";
    document.getElementById('insurance').defaultValue = "0";

    document.getElementById('university').defaultValue = "0";
    document.getElementById('faculty').defaultValue = "0";
    document.getElementById('department').defaultValue = "0";

    var fund = document.getElementById('fund').value;
    var fee = document.getElementById('fee').value;
    var advance = document.getElementById('advance').value;
    var insurance = document.getElementById('insurance').value;
    var university = document.getElementById('university').value;
    var faculty = document.getElementById('faculty').value;
    var department = document.getElementById('department').value;

    document.getElementById('researcher').value = "0";
    document.getElementById('ohc').value = "0";

    document.getElementById('ohc').value = parseFloat(university) + parseFloat(faculty) + parseFloat(department);
    document.getElementById('researcher').value = parseFloat(fund) - parseFloat(fee)-
    parseFloat(advance)- parseFloat(insurance)- parseFloat(university) - parseFloat(faculty)- parseFloat(department);
}

function default_value2() {

    var fund = document.getElementById('fund').value;
    var fee = document.getElementById('fee').value;
    var advance = document.getElementById('advance').value;
    var insurance = document.getElementById('insurance').value;
    var university = document.getElementById('university').value;
    var faculty = document.getElementById('faculty').value;
    var department = document.getElementById('department').value;

    document.getElementById('researcher').value = "0";
    document.getElementById('ohc').value = parseFloat(university) + parseFloat(faculty) + parseFloat(department);
    document.getElementById('researcher').value = parseFloat(fund) - parseFloat(fee)-
    parseFloat(advance)- parseFloat(insurance)- parseFloat(university) - parseFloat(faculty)- parseFloat(department);
}