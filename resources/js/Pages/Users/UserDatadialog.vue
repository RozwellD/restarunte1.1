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
    puestos: {
        type: Object,
        required: true
    },
    sucursales: {
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
        add: route('dashboard.users.create'),
        edit: route('dashboard.users.update', {
            user_id: props.form.id
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
    <v-dialog v-model="show" width="600" persistent>
        <v-card>

            <v-toolbar color="primary" dark>
                <v-toolbar-title>
                    {{ props.type === 'add' ? 'Agregar ' : 'Editar ' }} Usuario
                </v-toolbar-title>
            </v-toolbar>

            <v-card-text>
                <v-text-field id="name" type="text" label="Nombre" v-model="props.form.name" required density="compact"
                    :error-messages="props.form.errors.name" />
                <v-text-field id="email" type="email" label="Correo electronico" v-model="props.form.email" required
                    density="compact" :error-messages="props.form.errors.email" />
                <v-text-field id="phone" type="phone" label="Telefono" v-model="props.form.phone" required density="compact"
                    :error-messages="props.form.errors.phone" />
                <v-text-field id="salario_diario" type="number" label="Salario diario" v-model="props.form.salario_diario"
                    required density="compact" :error-messages="props.form.errors.salario_diario" />

                <v-select label="Puesto" :items="puestos" density="compact" item-title="label" v-model="props.form.puesto"
                    :error-messages="props.form.errors.puesto" item-value="value"></v-select>

                <v-select label="Sucursal" :items="sucursales" density="compact" v-model="props.form.sucursal"
                    :error-messages="props.form.errors.sucursal" item-title="label" item-value="value"></v-select>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" :disabled="props.form.processing" @click="closeDialog">
                    Cancelar
                </v-btn>
                <v-btn color="primary" variant="elevated" @click="save" :disabled="props.form.processing"
                    :loading="props.form.processing">
                    Guardar
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
