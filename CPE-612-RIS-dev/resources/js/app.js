
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app'
// });

// https://stackoverflow.com/questions/14866775/detect-document-height-change
function onElementHeightChange(elm, callback){
    var lastHeight = elm.clientHeight, newHeight;
    (function run(){
        newHeight = elm.clientHeight;
        if( lastHeight != newHeight )
            callback();
        lastHeight = newHeight;

        if( elm.onElementHeightChangeTimer )
            clearTimeout(elm.onElementHeightChangeTimer);

        elm.onElementHeightChangeTimer = setTimeout(run, 40);
    })();
}

function startPostingSelfScrollHeight(eventID) {
    function postNewHeight() {
        let bodyHeight = document.body.scrollHeight
        let payload = {
            eventID: eventID,
            height: bodyHeight
        }

        window.top.postMessage(payload, `${location.origin}`);
    }

    onElementHeightChange(document.body, postNewHeight);

    postNewHeight();
}

function startListeningChildScrollHeight(eventID, toUpdateElementID) {
    window.addEventListener('message', function(messageEvent) {
        if (messageEvent.origin !== location.origin)
            return;

        let payload = messageEvent.data;

        if (payload.eventID && payload.eventID == eventID) {
            let scrollHeight = payload.height;
            
            document.getElementById(toUpdateElementID).style.transition = 'height 40ms'; 
            document.getElementById(toUpdateElementID).style.height = scrollHeight + 'px'; 
        }
    } , false);
}

window.startPostingSelfScrollHeight = startPostingSelfScrollHeight
window.startListeningChildScrollHeight = startListeningChildScrollHeight

$(document).ready(function (){
    $("input[type=file]").change(function (event) {
        let fileName = $(this).val().replace(/\\/g, '/').replace(/.*\//, '');
        $(this).next('.custom-file-label').text(fileName);
    });

    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });

    $(".delete-button").click(function(e) {
        var form = this.parentElement;

        if (confirm('ต้องการลบใช่หรือไม่')) {
            form.submit()
        }

        e.stopPropagation()
        return true;
    });

    $(".delete-attachment").click(function(e) {
        var form = this.parentElement;

        if (confirm('ต้องการลบใช่หรือไม่')) {
            form.submit()
        }

        e.stopPropagation()
        return true;
    });
});
