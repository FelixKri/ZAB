
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

let data = {students: null, data: null};
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('studentlist', require('./components/ExampleComponent.vue'));

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
            data.students = response['schueler'];
            init()
            data = {students: null, data: null};
        }
    });
});

function init() {
    const vm = new Vue({
        el: '#vue',
        data: data,
        mounted(){
            console.log('mounted');
        }
    });
}