<script setup>
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    tareas: Array,
    proyectos: Array,
    usuario: Object,
});

const completarTarea = (tarea) => {
    Inertia.post(route('tareas.actualizar',tarea.id));
}
import AppLayout from "@/Layouts/AppLayout.vue";
</script>

<template>
<AppLayout>
    <div class="flex flex-col justify-center items-center  w-full min-h-screen">
        <h2 class="pt-10  text-3xl text-amber-600 font-bold">Tareas</h2>
        <div class="flex flex-col space-y-5 w-full items-center justify-center ">
            <div class="flex   w-4/5 items-center justify-center p-10 rounded-xl space-x-3">
                <div class="flex flex-col justify-center w-full items-center p-10    rounded-md">
                    <ul class="space-y-3 w-full">

                            <template v-for="proyecto in proyectos">
                                <template v-if="proyecto.user_id === usuario.id">
                            <div class="bg-amber-100 p-10 space-y-6 rounded-xl">


                                <h3 class="text-amber-950 strong text-xl font-bold">{{proyecto.nombre}}</h3>
                                <template v-for="tarea in tareas" >
                                    <template v-if="tarea.proyecto_id === proyecto.id">
                            <li v-if="!tarea.completada">

                                <div class="border-amber-800 w-full border-l-8 rounded-md bg-amber-300 space-y-5 p-3">
                                    <div class="space-y-2 p-5  rounded-md">
                                        <details>
                                            <summary class="text-amber-800">{{tarea.nombre}}</summary>
                                            <div class="flex flex-col space-y-6">
                                                <p class="text-amber-600">{{tarea.descripcion}}</p>
                                                <div class="space-x-8">
                                                    <button @click="completarTarea(tarea)" class="rounded-md px-5 py-2 bg-amber-500 text-gray-50" >Echa</button>
                                                </div>
                                            </div>
                                        </details>
                                    </div>
                                </div>
                            </li>

                            </template>
                                </template>
                            </div>
                            </template>
                        </template>
                        </ul>
                </div>
            </div>
        </div>
    </div>
</AppLayout>
</template>

<style scoped>

</style>
