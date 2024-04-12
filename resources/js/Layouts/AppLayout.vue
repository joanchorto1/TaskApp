<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import IconJCT from "@/Components/Icons/IconJCT.vue";

defineProps({
    title: String,
    canLogout: Boolean,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};

</script>

<template>
<div class=" ">
    <div class="flex p-5 items-center bg-amber-800 border-b-4   border-amber-800 text-amber-400 justify-center">
        <div class="flex justify-center items-center w-1/2">
            <h1 class="font-bold font-mono text-3xl">TASK APP</h1>
        </div>
        <div class="flex justify-center items-center w-1/2">
            <IconJCT class="w-16 fill-amber-400  "/>
        </div>
    </div>
    <div class="flex h-full">
        <div class="flex flex-col bg-amber-100 border-r-4 text-amber-950  border-amber-800 space-y-3 min-h-screen    pt-3 justify-start   pl-5   w-1/12">
            <div class="text-amber-700  flex flex-col">
                <h2 class="font-bold text-amber-900">Menu</h2>

                <ul class=" items-center space-y-3 pt-3 ">
                    <li>
                        <a href="/dashboard">
                            Panel
                        </a>
                    </li>
                    <li>
                        <a :href="route('proyectos.index')">
                            Proyectos
                        </a>
                    </li>
                    <li>
                        <a :href="route('tareas.index')">
                            Tareas
                        </a>
                    </li>
                    <li>
                        <a :href="route('calendar.index')">Calendario</a>
                    </li>
                </ul>
            </div>
            <div class="text-amber-700  flex flex-col   ">
                <h2 class="font-bold text-amber-900">Ajustes</h2>
                <ul class=" items-center space-y-3 pt-3">
                    <li>
                        <p>
                            <a :href="route('profile.show')" >
                                Profile
                            </a>
                        </p>
                    </li>
                    <li>
                        <form method="POST" @submit.prevent="logout">
                            <button type="submit">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <slot class="bg-gray-100 w-11/12"/>
    </div>
</div>
</template>
