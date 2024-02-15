<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UserDatadialog from "@/Pages/Users/UserDatadialog.vue";
import { reactive } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import { pickBy } from "lodash";


const props = defineProps({
    users: Object,
    puestos: Object,
    sucursales: Object
})


const data = reactive({
    user: {
        type: 'add',
        dialog: false,
        form: useForm({
            name: '',
            id: '',
            email: '',
            phone: '',
            puesto: '',
            sucursal: '',
            salario_diario: 0
        })
    }
})


const headers = [
    {
        title: 'Nombre',
        value: 'name'
    },
    {
        title: 'Telefono',
        value: 'phone'
    },
    {
        title: 'Puesto',
        value: 'puesto.name'
    },
    {
        title: 'Sucursal',
        value: 'sucursal.name'
    },
    {
        title: 'Acciones',
        value: 'actions'
    },
];

function handleEditDialog(item) {
    data.user.type = 'edit'
    data.user.form.name = item.name
    data.user.form.email = item.email
    data.user.form.id = item.id
    data.user.form.phone = item.phone
    data.user.form.salario_diario = item.salario_diario
    data.user.form.puesto = item.puesto.id
    data.user.form.sucursal = item.sucursal.id
    data.user.dialog = !data.user.dialog;
}


function updateOptions(options) {
    router.visit(route(route().current(), pickBy(options)))
}
function handleAddDialog() {
    data.user.type = 'add'
    data.user.dialog = !data.user.dialog;
}


</script>

<template>
    <AuthenticatedLayout title="Usuarios">
        <template v-slot:headerActions>
            <v-btn density="compact" @click="handleAddDialog">
                <v-icon>mdi-plus</v-icon>
                Agregar
            </v-btn>
        </template>
        <v-data-table-server :headers="headers" density="compact" :items="users.data" v-model:page="users.meta.current_page"
            :items-per-page="users.meta.per_page" :items-length="users.meta.total">
            <template v-slot:item.actions="{ item }">
                <v-btn icon="mdi-pencil" flat density="compact" color="primary" variant="text"
                    @click="() => handleEditDialog(item)" />
            </template>

        </v-data-table-server>

        <UserDatadialog v-model:show="data.user.dialog" :form="data.user.form" :puestos="puestos" :type="data.user.type"
            :sucursales="sucursales" />

    </AuthenticatedLayout>
</template>

<style scoped>
</style>
