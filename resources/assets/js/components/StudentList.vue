<template>
    <table>
        <tr>
            <th>Name:</th>
            <th>Betrag:</th>
        </tr>
        <tr v-for="student in this.$parent.$parent.students">
            <td style="width: 60%;">{{student['vorName']}} {{student['nachName']}}</td>
            <td><input type="number" :id="student['id']" :name="student['id']" class="form-control form-control-sm"></td>
        </tr>
    </table>
</template>

<script>
    export default {
        name: "student-list"
    }
</script>

<style scoped>

</style>