'use strict'

function onSelect() {
    $('#filter').submit()
}

$(document).ready(function() {
    let $departmentSelector = $('#department') 
    let $status = $('#status')
 
    $departmentSelector.change(onSelect)
    $status.change(onSelect)
    
    let listTable = $('#list')
    listTable.DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Thai.json"
        }
    })
});