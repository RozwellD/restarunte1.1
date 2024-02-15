<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {Head,  useForm} from '@inertiajs/vue3';
import {ref} from "vue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: 'admin@test.dev',
    password: 'password',
    remember: false,
});

const show= ref(false)


const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in"/>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>


        <form @submit.prevent="submit">



            <v-text-field
                id="email"
                type="email"
                label="Correo electronico"
                v-model="form.email"
                required
                density="compact"
                :error-messages="form.errors.email"
                autocomplete="username"
            />


            <v-text-field
                id="password"
                :type="show ? 'text' : 'password'"
                class="mt-1 block w-full"
                label="Contraseña"
                @click:append-inner="show = !show"
                :append-inner-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                v-model="form.password"
                density="compact"
                :error-messages="form.errors.password"
                required
                autocomplete="current-password"
            />

            <div class="flex items-center justify-end">
                <v-btn block :loading="form.processing" color="primary" @click="submit" :disabled="form.processing">
                    Iniciar Sesión
                </v-btn>
            </div>
        </form>
    </GuestLayout>
</template>
