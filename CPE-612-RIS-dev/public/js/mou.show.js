'use strict'

$(document).ready(function() {
    let moaTable = $('#moaTable')
    let activityTable = $('#activityTable')
    
    moaTable.DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Thai.json"
        }
    })

    activityTable.DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Thai.json"
        }
    })
});