'use strict'

function onSelect() {
    $('#filter').submit()
}

$(document).ready(function() {
    let $typeSelector = $('#type') 
 
    $typeSelector.change(onSelect)
});