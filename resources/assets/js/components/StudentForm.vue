<template>
    <div class="jumbotron">
        <form action="/bill/save">
            <div class="form-group">
                <label for="grund">Begründung:</label>
                <input type="text" id="grund" class="form-control" placeholder="Grund der Abrechnung" name="grund" style="width:50%;">
            </div>
            <div class="form-group">
                <h4>Rechnungspositionen:</h4>
                <input type="button" id="addRechnungspos" name="addRechnungspos" class="btn btn-primary btn-small" value="Rechnungsposition Hinzufügen" v-on:click="add">
            </div>
            <div class="form-group" v-for="item in this.root.counter">
                <studentlist :id="root.id"></studentlist>
                <hr>
            </div>
        </form>

    </div>
</template>

<script>
    export default {
        props: ['id'],
        data(){
            return{
                root: this.$parent
            }
        },
        methods:{
            add: function () {
                this.root.counter.push("x");
            }
        },
        mounted() {
            console.log('Studentlist mounted.')
        }
    }
</script>
