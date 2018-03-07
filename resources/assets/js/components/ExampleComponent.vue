<template>
    <div class="jumbotron">
        <table>
            <tr>
                <th>Name:</th>
                <th>Ausgewählt:</th>
            </tr>
            <tr v-for="student in this.$parent.students">
                <td>{{student['vorName']}} {{student['nachName']}}</td>
                <td><input type="checkbox" id="student['id']"></td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Studentlist mounted.')
        }
    }
</script>
