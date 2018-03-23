<template>
    <tr>
        <td>
            <input type="text" class="form-control form-control-sm" placeholder="VorName des Schülers" name="vorName">
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" placeholder="NachName des Schülers" name="nachName">
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" placeholder="Klasse des Schülers" name="klasse">
        </td>
        <td>
            <input type="email" class="form-control form-control-sm" placeholder="E-Mail des Schülers" name="eMail">
        </td>
        <td>
            <input type="password" class="form-control form-control-sm" placeholder="Passwort des Schülers"
                   name="password">
        </td>
    </tr>
</template>

<script>
    export default {
        name: "student-registerinputs"
    }
</script>

<style scoped>

</style>