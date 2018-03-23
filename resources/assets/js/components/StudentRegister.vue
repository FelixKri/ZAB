<template>
    <table class="text-dark" style="width: 100%;">
        <tr>
            <th>
                VorName
            </th>
            <th>
                NachName
            </th>
            <th>
                Klasse
            </th>
            <th>
                E-Mail
            </th>
            <th>
                Passwort
            </th>
        </tr> <!-- COL Namen -->
        <studentregisterinputs v-for="item in this.root.counter"></studentregisterinputs>
        <input type="button" id="addst" class="btn btn-primary" value="Schüler hinzufügen" @click="add()">
    </table>
</template>

<script>
    export default {
        name: "student-register",

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
        }
    }
</script>

<style scoped>

</style>