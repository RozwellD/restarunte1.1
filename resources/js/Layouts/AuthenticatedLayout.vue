<script setup>
import {reactive, watch} from 'vue';
import {Head, router, usePage} from '@inertiajs/vue3';
import {route} from "momentum-trail";
import {Toaster, } from '@/components/ui/sonner'
import { toast } from "vue-sonner";



const props = defineProps({

    title: {
        type: String
    }

})

const page = usePage()

const data = reactive({
    rail: true
})


const navigation = [
    {
        title: 'Usuarios',
        icon: 'mdi-account',
        route: route('dashboard.users.index',),

    },
    {
        title: 'Sucursales',
        icon: 'mdi-domain',
        route: route('dashboard.sucursales.index',),
    },
    {
        title: 'Ventas',
        icon: 'mdi-point-of-sale',
        route: route('dashboard.sales.index',),
    }
];


function logout() {
    router.post(route('logout'))
}


function showToast(flash) {
    console.log(flash)
}


watch(
    () => page.props.flash,
    (next) => {
        if (next) {
            let type = Object.keys(next).find((key) => next[key] !== null);
            if (type) {
                toast[type](next[type]);
            }
        }
    },
);


// watch(() => page.props.flash, (next) => {
//     if (next) {
//         next.success || next.error
//             ? showToast(next)
//             : null;
//     }
// });

</script>

<template>
    <v-app>
        <Head :title="title"/>
        <v-layout class="min-h-screen bg-gray-100">

            <v-navigation-drawer
                color="primary"
                theme="dark"
                permanent
                :rail="data.rail"
            >
                <v-list color="transparent">
                    <v-tooltip
                        location="end"
                        v-for="(item) in navigation"
                        :text="item.title"
                        theme="ligth"
                        key="index"
                    >
                        <template v-slot:activator="{ props }">
                            <v-list-item
                                :prepend-icon="item.icon"
                                v-bind="props"
                                :title="item.title "
                                @click="router.visit(item.route)"
                            />
                        </template>
                    </v-tooltip>
                </v-list>

                <template v-slot:append>
                    <v-tooltip
                        location="end"
                        text="Salir"
                        theme="ligth"
                    >
                        <template v-slot:activator="{ props }">
                            <div class="pa-2">
                                <v-btn block @click="logout" v-bind="props">
                                    <v-icon v-if="data.rail" v-bind="props">>
                                        mdi-logout
                                    </v-icon>
                                    <span v-else>
                                Salir
                            </span>
                                </v-btn>
                            </div>
                        </template>
                    </v-tooltip>
                </template>
            </v-navigation-drawer>
            <!-- Page Content -->
            <v-main>
                <v-toolbar
                    extended
                    flat
                    prominent
                    extension-height="100"
                    color="primary"
                >
                    <v-app-bar-nav-icon @click="data.rail = !data.rail"></v-app-bar-nav-icon>

                    <v-toolbar-title>{{
                            title
                        }}
                    </v-toolbar-title>

                    <v-spacer></v-spacer>
                    <slot name="headerActions"></slot>
                </v-toolbar>

                <v-card
                    class="mx-auto"
                    max-width="90%"
                    style="margin-top: -64px"
                >
                    <slot/>
                </v-card>

            </v-main>
        </v-layout>
    </v-app>
    <Toaster/>

</template>
