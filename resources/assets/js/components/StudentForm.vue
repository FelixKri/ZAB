<template>
    <div class="jumbotron text-dark">
        <form action="/bill/save" method="post">
            <input type="hidden" name="_token" :value="csrf">
            <div class="form-group">
                <label for="grund">Begründung:</label>
                <input type="text" id="grund" class="form-control" placeholder="Grund der Abrechnung" name="grund"
                       style="width:50%;">
            </div>
            <div class="form-group">
                <h4>Rechnungspositionen:</h4>
                <input type="button" id="addRechnungspos" name="addRechnungspos" class="btn btn-primary btn-small"
                       value="Rechnungsposition Hinzufügen" v-on:click="add">
            </div>
            <div class="form-group" v-for="item in this.root.counter">
                <studentlist :id="root.id"></studentlist>
                <hr>
            </div>
            <input type="button" id="send" class="btn btn-primary" value="Abrechnen" @click="sendajax()">
        </form>
        <div id="snackbar">Abrechnung gespeichert!</div>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        data() {
            return {
                csrf: "",
                root: this.$parent
            }
        },
        methods: {
            add: function () {
                this.root.counter.push("x");
            },
            sendajax: function () {
                let numItems = $('.rechnungsposname').length; //Ermittlung Anzahl von Rechnungspositionen
                console.log("Anzahl der Rechnungspostionen: " + numItems);
                let rechnungspos_name;
                let values = [];
                let user_ids = [];
                let rechnungspositionen = [];
                let rechnungsgrund = $("#grund").val(); //Ermittlung des Abrechnungsgrundes

                /* For Loop zum Sammeln der Daten der verschiedenen Rechnungspositionen */
                for (let id = 1; id <= numItems; id++) {

                    rechnungspos_name = $("#rechnungsposname_" + id).val();

                    $("#rechnungspos_" + id + " .rechnungspos_betrag").each(function () {
                        values.push($(this).val());
                        user_ids.push($(this).attr("name").split('_')[0]);
                    });

                    if (values.length === 0 || user_ids.length === 0) {
                        console.log("Something is missing");
                    }

                    rechnungspositionen.push([rechnungspos_name, values, user_ids]);
                    values = [];
                    user_ids = [];
                }

                $.ajax({
                    type: "POST",
                    url: "/bill/store",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'rechnungsgrund': rechnungsgrund,
                        'rechnungspositionen': rechnungspositionen,
                    },

                    success: function success(response) {

                    }
                });

                let x = document.getElementById("snackbar");

                // Add the "show" class to DIV
                x.className = "show";

                // After 3 seconds, remove the show class from DIV
                setTimeout(function () {
                    x.className = x.className.replace("show", "");
                }, 3000);
            }
        },
        mounted() {
            this.csrf = window.Laravel.csrfToken;
        }
    }
</script>

<style scoped>
    /* The snackbar - position it at the bottom and in the middle of the screen */
    #snackbar {
        visibility: hidden; /* Hidden by default. Visible on click */
        min-width: 250px; /* Set a default minimum width */
        margin-left: -125px; /* Divide value of min-width by 2 */
        background-color: #333; /* Black background color */
        color: #fff; /* White text color */
        text-align: center; /* Centered text */
        border-radius: 2px; /* Rounded borders */
        padding: 16px; /* Padding */
        position: fixed; /* Sit on top of the screen */
        z-index: 1; /* Add a z-index if needed */
        left: 50%; /* Center the snackbar */
        bottom: 60px; /* 30px from the bottom */
    }

    /* Show the snackbar when clicking on a button (class added with JavaScript) */
    #snackbar.show {
        visibility: visible; /* Show the snackbar */

        /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
        However, delay the fade out process for 2.5 seconds */
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    /* Animations to fade the snackbar in and out */
    @-webkit-keyframes fadein {
        from {
            bottom: 0;
            opacity: 0;
        }
        to {
            bottom: 60px;
            opacity: 1;
        }
    }

    @keyframes fadein {
        from {
            bottom: 0;
            opacity: 0;
        }
        to {
            bottom: 60px;
            opacity: 1;
        }
    }

    @-webkit-keyframes fadeout {
        from {
            bottom: 60px;
            opacity: 1;
        }
        to {
            bottom: 0;
            opacity: 0;
        }
    }

    @keyframes fadeout {
        from {
            bottom: 60px;
            opacity: 1;
        }
        to {
            bottom: 0;
            opacity: 0;
        }
    }
</style>