<script setup>

</script>

<template>
    <v-app>
        <div class="min-h-screen flex flex-col sm:justify-center items-start sm:pt-0 bg-gray-100 p-0 md:pl-4 md:py-4">
            <v-card
                flat
                class="w-full sm:max-w-md flex items-center h-full"
            >
                <v-card-title>
                    <p class="font-bold text-2xl">
                        Bienvenido
                    </p>
                    <span class="text-sm">
                        Por favor ingresa tus datos para comenzar
                    </span>
                </v-card-title>
                <v-card-item>
                    <slot/>
                </v-card-item>
            </v-card>
        </div>
    </v-app>
</template>
