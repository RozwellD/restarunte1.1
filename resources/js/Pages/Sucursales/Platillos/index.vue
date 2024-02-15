<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {reactive, onMounted} from "vue";
import {useForm, router} from "@inertiajs/vue3";
import {pickBy} from "lodash";
import {route,current} from 'momentum-trail'
import PlatillosDatadialog from "@/Pages/Sucursales/Platillos/PlatillosDatadialog.vue";


const props = defineProps({
    platillos: Object,
})


const data = reactive({
    platillo: {
        type: 'add',
        dialog: false,
        form: useForm({
            id: '',
            name: '',
            description: '',
            elaboration_duration: '',
            production_cost: '',
            sale_price: '',
            branch_id: '',
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
        title: 'Precio',
        value: 'sale_price'
    },
    {
        title: 'Sucursal',
        value: 'branch.name'
    },
    {
        title: 'Acciones',
        value: 'actions'
    },
];



onMounted(() => {
     data.platillo.form.branch_id = route().params.sucursal_id

})





function handleEditDialog(item) {

    data.platillo.type = 'edit'
    data.platillo.form.id = item.id
    data.platillo.form.name = item.name
    data.platillo.form.description = item.description
    data.platillo.form.elaboration_duration = item.elaboration_duration
    data.platillo.form.production_cost = item.production_cost
    data.platillo.form.sale_price = item.sale_price
    data.platillo.form.active = item.active
    data.platillo.dialog = !data.platillo.dialog;

}


function updateOptions(options) {
    router.visit(route(route().current(), pickBy(options)))
}


function handleAddDialog() {
    data.platillo.type = 'add'
    data.platillo.dialog = !data.platillo.dialog;
}


</script>

<template>
    <AuthenticatedLayout title="Platillos">
        <template v-slot:headerActions>
            <v-btn density="compact" @click="handleAddDialog">
                <v-icon>mdi-plus</v-icon>
                Agregar
            </v-btn>
        </template>
        <v-data-table-server
            :headers="headers"
            density="compact"
            :items="platillos.data"
            v-model:page="platillos.meta.current_page"
            :items-per-page="platillos.meta.per_page"
            :items-length="platillos.meta.total"
        >
            <template v-slot:item.actions="{ item }">
                <v-btn icon="mdi-pencil" flat density="compact" color="primary" variant="text"
                       @click="() => handleEditDialog(item)"/>
            </template>

        </v-data-table-server>

        <PlatillosDatadialog v-model:show="data.platillo.dialog"
                              :form="data.platillo.form"
                              :type="data.platillo.type"
        />

    </AuthenticatedLayout>
</template>

<style scoped>

</style>
