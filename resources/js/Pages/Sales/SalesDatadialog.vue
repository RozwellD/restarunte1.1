<script setup>


const show = defineModel('show')


const props = defineProps({
    type: {
        type: String,
        default: 'add'
    },
    form: {
        type: Object,
        required: true
    },
    sucursales: {
        type: Array,
        required: true
    },

})

const data = reactive({
    platillos: [],
    meseros: [],
})


function getMeseros() {
    axios.get(route("dashboard.users.get-users-by-type", {
        type: 'waiter'
    })).then(res => {
        data.meseros = res.data
    });
}

function getPlatillos() {
    axios.get(route("dashboard.sucursales.platillos.index", {
        sucursal_id: props.form.branch_id
    })).then(res => {
        data.platillos = res.data.data.platillos
    });
}


watch(() => props.form.branch_id, (next) => {
    getMeseros()
    getPlatillos()
})

function closeDialog() {
    props.form.reset();
    show.value = false
}

function save() {
    const path = {
        add: route('dashboard.sales.create', {
            onSuccess: () => {
                closeDialog()
            }
        }),
        edit: route('dashboard.sales.update', {
            sucursal_id: props.form.branch_id,
            sale_id: props.form.id
        }, {
            onSuccess: () => {
                closeDialog()
            }
        }),
    }

    props.form.post(path[props.type])

}


</script>

<template>
    <v-dialog v-model="show" width="600" persistent>
        <v-card>

            <v-toolbar color="primary" dark>
                <v-toolbar-title>
                    {{ props.type === 'add' ? 'Registrar ' : 'Ver ' }} Venta
                </v-toolbar-title>
            </v-toolbar>

            <v-card-text>
                <v-label>Sucursal</v-label>
                <v-select label="" :items="sucursales" variant="outlined" density="compact" v-model="props.form.branch_id"
                    :error-messages="props.form.errors.branch_id" item-title="label" item-value="value"></v-select>

                <v-label>Mesero</v-label>
                <v-select label="" :items="data.meseros" variant="outlined" density="compact"
                    v-model="props.form.attendant_id" :error-messages="props.form.errors.attendant_id" item-title="label"
                    item-value="value"></v-select>

                <v-label>Mesa</v-label>
                <v-text-field id="table" type="number" variant="outlined" label="" v-model="props.form.table" required
                    density="compact" :error-messages="props.form.errors.table" />
                <v-label>Propina</v-label>
                <v-text-field id="tip" variant="outlined" type="number" v-model="props.form.tip" required density="compact"
                    :error-messages="props.form.errors.tip" />

                <div class="mb-4">
                    <v-label>Fecha y Hora</v-label>
                    <VueDatePicker v-model="props.form.date" :enable-time-picker="true" locale="es-MX" teleport-center
                        format="y-MM-d HH:mm">
                    </VueDatePicker>
                </div>



                <v-label>Platillos</v-label>
                <v-select label="" :items="data.platillos" variant="outlined" multiple density="compact" chips
                    v-model="props.form.platillos_id" :error-messages="props.form.errors.platillos_id" item-title="name"
                    item-value="id"></v-select>

            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" :disabled="props.form.processing" @click="closeDialog">
                    Cancelar
                </v-btn>
                <v-btn color="primary" variant="elevated" @click="save"
                    :disabled="props.form.platillos_id.length < 1 || props.form.processing"
                    :loading="props.form.processing">
                    Guardar
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
