<script setup >

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
})

function closeDialog() {
    props.form.reset();
    show.value = false
}



function save() {
    const path = {
        add: route('dashboard.sucursales.platillos.create', {
            sucursal_id: props.form.branch_id
        }),
        edit: route('dashboard.sucursales.platillos.update', {
            sucursal_id: props.form.branch_id,
            platillo_id: props.form.id
        }),
    }

    props.form.post(path[props.type], {
        onSuccess: () => {
            closeDialog()
        }
    })

}


</script>

<template>
    <v-dialog
        v-model="show"
        width="600"
        persistent
    >
        <v-card>

            <v-toolbar
                color="primary"
                dark
            >
                <v-toolbar-title>
                    {{ props.type === 'add' ? 'Agregar ' : 'Editar ' }} Platillo
                </v-toolbar-title>
            </v-toolbar>

            <v-card-text>
                <v-text-field
                    id="name"
                    type="text"
                    label="Nombre"
                    v-model="props.form.name"
                    required
                    density="compact"
                    :error-messages="props.form.errors.name"
                />
                <v-textarea
                    id="description"
                    label="Descripción"
                    v-model="props.form.description"
                    required
                    density="compact"
                    :error-messages="props.form.errors.description"
                />
                <v-text-field
                    id="elaboration_duration"
                    label="Tiempo de elaboración (minutos)"
                    required
                    density="compact"
                    v-model="props.form.elaboration_duration"
                    :error-messages="props.form.errors.elaboration_duration"

                />
                <v-text-field
                    id="production_cost"
                    label="Costo de producción"
                    required
                    density="compact"
                    v-model="props.form.production_cost"
                    :error-messages="props.form.errors.production_cost"

                />

                <v-text-field
                    id="sale_price"
                    label="Precio de venta"
                    required
                    density="compact"
                    v-model="props.form.sale_price"
                    :error-messages="props.form.errors.sale_price"
                />

                <v-switch
                    :label="props.form.active ? 'Activo' : 'Inactivo'"
                    color="primary"
                    v-model="props.form.active"
                    :error-messages="props.form.errors.active"
                ></v-switch>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="primary"
                    :disabled="props.form.processing"
                    @click="closeDialog"
                >
                    Cancelar
                </v-btn>
                <v-btn
                    color="primary"
                    variant="elevated"
                    @click="save"
                    :disabled="props.form.processing"
                    :loading="props.form.processing"
                >
                    Guardar
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

</template>
