<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { onMounted, reactive } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import { pickBy } from "lodash";
import SalesDatadialog from "@/Pages/Sales/SalesDatadialog.vue";
import { route } from "momentum-trail";


const props = defineProps({
    sales: Object,
    sucursales: Array,
})


const data = reactive({
    sale: {
        type: 'add',
        dialog: false,
        form: useForm({
            id: '',
            table: '',
            attendant_id: '',
            platillos_id: [],
            tip: 0,
            date: dayjs(),
            branch_id: ''
        })
    }
})


const headers = [
    {
        title: 'Mesa',
        value: 'table'
    },
    {
        title: 'Mesero',
        value: 'attendant.name'
    },
    {
        title: 'Platillos',
        value: 'platillos_count'
    },
    {
        title: 'Acciones',
        value: 'actions'
    },
];





// function handleEditDialog(item) {
//
//     data.sucursal.type = 'edit'
//     data.sucursal.form.name =  item.name
//     data.sucursal.form.email =  item.email
//     data.sucursal.form.id =  item.id
//     data.sucursal.form.phone =  item.phone
//     data.sucursal.form.active =  item.active
//     data.sucursal.dialog = !data.sucursal.dialog;
//
// }


function updateOptions(options) {
    router.visit(route(route().current(), pickBy(options)))
}


function handleAddDialog() {
    data.sale.type = 'add'
    data.sale.dialog = !data.sale.dialog;
}


</script>

<template>
    <AuthenticatedLayout title="Ventas">
        <template v-slot:headerActions>
            <v-btn density="compact" @click="handleAddDialog">
                <v-icon>mdi-plus</v-icon>
                Agregar
            </v-btn>
        </template>
        <v-data-table-server :headers="headers" density="compact" :items="sales.data" v-model:page="sales.meta.current_page"
            :items-per-page="sales.meta.per_page" :items-length="sales.meta.total">
        </v-data-table-server>

        <SalesDatadialog v-model:show="data.sale.dialog" :form="data.sale.form" :type="data.sale.type"
            :sucursales="sucursales" />

    </AuthenticatedLayout>
</template>

<style scoped>
</style>
