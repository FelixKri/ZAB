<template>
    <!-- ID2 ist die Id der Rechnungsposition, startet immer mit 1 -->
    <div>
        <div :id="'rechnungspos_'+id2">
            <input type="text" :id="'rechnungsposname_' + id2" placeholder="Name der Position"
                   class="form-control form-control-sm rechnungsposname" style="width: 55%;">
            <table>
                <tr>
                    <th>Name:</th>
                    <th>Betrag:</th>
                </tr>
                <tr v-for="student in this.$parent.$parent.students" :id="student['id']+'_' + id2">
                    <td style="width: 60%;" :id="student['id']+'_' + id2">
                        {{student['vorName']}} {{student['nachName']}}
                    </td>
                    <td>
                        <input type="number" :name="student['id']+'_' + id2"
                               class="form-control form-control-sm rechnungspos_betrag" style="width: 90%;"
                               :id="student['id']+'_' + id2">
                    </td>
                    <td>
                        <input type="button" value="X" class="btn btn-danger btn-sm" :id="student['id']+'_' + id2"
                               @click="removeStudent(student['id']+'_' + id2)">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="addStField" id="addStField" class="form-control form-control-sm typeahead" placeholder="Schüler hinzufügen">
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        data() {
            return {
                id2: this.$root.id,
                root: this.$root
            }
        },
        methods: {
            removeStudent: function ($id) {
                $("#" + $id).remove();
            },
        },
        mounted() {
            this.root.id = this.id + 1;
        },
        name: "student-list"
    }
</script>

<style scoped>

</style>