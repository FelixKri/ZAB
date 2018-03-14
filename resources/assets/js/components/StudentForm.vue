<template>
    <div class="jumbotron">
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
                let rechnungspos_name;
                let values = [];
                let user_ids = [];
                let rechnungspositionen = [];

                let rechnungsgrund = $("#grund").val(); //Ermittlung des Abrechnungsgrundes

                /* For Loop zum Sammeln der Daten der verschiedenen Rechnungspositionen */
                for (let id = 1; id <= numItems; id++) {
                    rechnungspos_name = $("#rechnungsposname_" + id).val();
                    console.log("rechnungspos name: " + rechnungspos_name);
                    $("#rechnungspos_" + id +" .rechnungspos_betrag").each(function () {
                        values.push($(this).val());
                        user_ids.push($(this).attr("name").split('_')[0]);

                    });

                    rechnungspositionen.push([rechnungspos_name, values, user_ids]);
                    values = [];
                    user_ids = [];
                }


                /* Ajax Request and Backend API */
                $.ajax({

                    type: "POST",
                    url: "/bill/store",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'rechnungsgrund': rechnungsgrund,
                        'rechnungspositionen': JSON.stringify(rechnungspositionen),

                    },

                    success: function success(response) {
                        console.log("AJAX response gesendet");
                    }
                });
            }
        },
        mounted() {
            this.csrf = window.Laravel.csrfToken;
        }
    }
</script>
