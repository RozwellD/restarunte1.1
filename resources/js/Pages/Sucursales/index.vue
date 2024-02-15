<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {reactive} from "vue";
import {route} from 'momentum-trail'
import {useForm, router} from "@inertiajs/vue3";
import {pickBy} from "lodash";
import SucursalesDatadialog from "@/Pages/Sucursales/SucursalesDatadialog.vue";


const props = defineProps({
    sucursales: Object,
})


const data = reactive({
    sucursal: {
        type: 'add',
        dialog: false,
        form: useForm({
            name: '',
            id: '',
            email: '',
            phone: '',
            active: false,
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
        title: 'Correo electronico',
        value: 'email'
    },
    {
        title: 'Acciones',
        value: 'actions'
    },
];

function handleEditDialog(item) {

    data.sucursal.type = 'edit'
    data.sucursal.form.name = item.name
    data.sucursal.form.email = item.email
    data.sucursal.form.id = item.id
    data.sucursal.form.phone = item.phone
    data.sucursal.form.active = item.active
    data.sucursal.dialog = !data.sucursal.dialog;

}


function updateOptions(options) {
    router.visit(route(route().current(), pickBy(options)))
}


function handleAddDialog() {
    data.sucursal.type = 'add'
    data.sucursal.dialog = !data.sucursal.dialog;
}


</script>

<template>
    <AuthenticatedLayout title="Sucursales">
        <template v-slot:headerActions>
            <v-btn density="compact" @click="handleAddDialog">
                <v-icon>mdi-plus</v-icon>
                Agregar
            </v-btn>
        </template>
        <v-data-table-server
            :headers="headers"
            density="compact"
            :items="sucursales.data"
            v-model:page="sucursales.meta.current_page"
            :items-per-page="sucursales.meta.per_page"
            :items-length="sucursales.meta.total"
        >
            <template v-slot:item.actions="{ item }">
                <v-btn icon="mdi-pencil" flat density="compact" color="primary" variant="text"
                       @click="() => handleEditDialog(item)"/>

                <v-btn icon="mdi-food" flat density="compact" color="primary" variant="text"
                       @click="() => router.visit(route('dashboard.sucursales.platillos.index', [item.id]))"/>
            </template>


        </v-data-table-server>

        <SucursalesDatadialog v-model:show="data.sucursal.dialog"
                              :form="data.sucursal.form"
                              :type="data.sucursal.type"
        />

    </AuthenticatedLayout>
</template>

<style scoped>

</style>
