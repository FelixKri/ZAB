
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
let data = {schueler: null, data: null};
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

$(".classes").on('click', function () {
    var checkbox_value = "";
    $(":checkbox").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            checkbox_value += $(this).val() + "|";
        }
    });
    $.ajax({

        type: "POST",
        url: "/bill/new",
        data: {
            '_token': $('input[name=_token]').val(),
            'classes': checkbox_value,
        },

        success: function (response) {
            data.schueler = response['schueler'];
            init()
        }
    });
});

function init() {
    const vm = new Vue({
        el: '#vue',
        daata: data,
        mounted(){
            console.log('mounted');
        }
    });
}