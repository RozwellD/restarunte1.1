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
        add: route('dashboard.sucursales.create'),
        edit: route('dashboard.sucursales.update', {
            sucursal_id: props.form.id
        }),
    }

    props.form.post(path[props.type],  {
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
                    {{ props.type === 'add' ? 'Agregar ' : 'Editar ' }} Sucursal
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
                <v-text-field
                    id="email"
                    type="email"
                    label="Correo electronico"
                    v-model="props.form.email"
                    required
                    density="compact"
                    :error-messages="props.form.errors.email"
                />
                <v-text-field
                    id="phone"
                    type="phone"
                    label="Telefono"
                    required
                    density="compact"
                    v-model="props.form.phone"
                    :error-messages="props.form.errors.phone"

                />

                <v-switch
                    :label="props.form.active ? 'Activa' : 'Inactiva'"
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
