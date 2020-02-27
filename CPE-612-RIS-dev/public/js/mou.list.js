'use strict'

function onSelect() {
    $('#filter').submit()
}

$(document).ready(function() {
    let $typeSelector = $('#type') 
    let $departmentSelector = $('#department') 
    let $status = $('#status')
    let $fromDate = $('#fromDate')
    let $toDate = $('#toDate')
    
    $typeSelector.change(onSelect)
    $departmentSelector.change(onSelect)
    $status.change(onSelect)

    $toDate.change(function() {
        if ($fromDate.val()) {

            let fromDate = new Date($fromDate.val());
            let toDate = new Date($toDate.val());

            if (fromDate < toDate) {
                $('#filter').submit()
            } else {
                alert('ช่วงเวลาไม่ถูกต้อง')
                $fromDate.val('')
                $toDate.val('')
            }
        }
    })

    let listTable = $('#list')
    listTable.DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Thai.json"
        }
    })
});
