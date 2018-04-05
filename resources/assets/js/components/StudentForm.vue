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
                console.log("Rechnungsgrund: " + rechnungsgrund);
                /* For Loop zum Sammeln der Daten der verschiedenen Rechnungspositionen */
                for (let id = 1; id <= numItems; id++) {
                    console.log("Current ID: " + id);
                    rechnungspos_name = $("#rechnungsposname_" + id).val();
                    console.log("rechnungspos name: " + rechnungspos_name);
                    $("#rechnungspos_" + id +" .rechnungspos_betrag").each(function () {
                        console.log("IM IN");
                        values.push($(this).val());
                        user_ids.push($(this).attr("name").split('_')[0]);
                    });
                    if(values.length === 0 || user_ids.length ===    0){
                        console.log("Something is missing");
                    }
                    console.log("User ids: " + user_ids);
                    console.log("Values: " + values);
                    rechnungspositionen.push([rechnungspos_name, values, user_ids]);
                    values = [];
                    user_ids = [];
                }
                console.log(rechnungspositionen);
                /* Ajax Request and Backend API */
                $.ajax({
                    type: "POST",
                    url: "/bill/store",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'rechnungsgrund': rechnungsgrund,
                        'rechnungspositionen': rechnungspositionen,
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