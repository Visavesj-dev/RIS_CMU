'use strict'

$(document).ready(function() {
    let activityTable = $('#activityTable')
    activityTable.DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Thai.json"
        }
    })
});