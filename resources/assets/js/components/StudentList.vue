<template>
    <div>
    <input type="text" :name="'rechnungsPosName_' + id2" :id="'rechnungsPosName_' + id2" placeholder="Name der Position" class="form-control form-control-sm" style="width: 55%;">
    <table>
        <tr>
            <th>Name:</th>
            <th>Betrag:</th>
        </tr>
        <tr v-for="student in this.$parent.$parent.students">
            <td style="width: 60%;">{{student['vorName']}} {{student['nachName']}}</td>
            <td><input type="number" :id="student['id']+'_' + id2" :name="student['id']+'_' + id2" class="form-control form-control-sm"></td>
        </tr>
    </table>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        data(){
            return{
                id2: this.$root.id,
                root: this.$root
            }
        },
        mounted(){
            this.root.id = this.id+1;
        },
        name: "student-list"
    }
</script>

<style scoped>

</style>