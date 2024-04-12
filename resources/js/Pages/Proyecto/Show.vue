<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import {reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    proyecto: Object,
    tareas: Array,
    subtareas: Array,
});

const data = reactive({
    FormData: {
        nombre: "",
        descripcion: "",
        proyecto_id: props.proyecto.id,
        fecha: new Date(),
        completada: false,
    },


});

//Submit form
const submitForm = () => {
    Inertia.post(route('tareas.store',data.FormData));
}
const completarTarea = (tarea) => {
    Inertia.post(route('tareas.actualizar',tarea.id));
}
const crearSubTarea = (tarea) => {
    Inertia.get(route('subtareas.create',tarea));
}
const completarSubTarea = (subtarea) => {
    Inertia.post(route('subtareas.actualizar',subtarea.id));
}
</script>

<template>
<AppLayout>
    <div class="flex flex-col justify-center items-center space-y-10 w-full min-h-screen">
        <h2 class="pt-10 border-amber-800  justify-start text-3xl text-amber-600 font-bold">{{proyecto.nombre}}</h2>
        <div class="flex flex-col space-y-5 w-full items-center justify-center ">
            <div class="flex flex-col items-center justify-center  w-4/5 p-10 rounded-xl space-x-3">
                <div class="flex flex-col justify-center items-center w-2/3  p-10    border-amber-800 border-b-2 ">
                    <div class="w-full ">


                    <h3 class=" font-bold    text-amber-900 text-center mb-3 text-2xl">To do</h3>
                    <ul class="space-y-3">
                        <template v-for="tarea in tareas" >

                                <li v-if="!tarea.completada">
                                    <div class="border-amber-800 w-full border-l-8 rounded-md bg-amber-200 space-y-5 p-3">
                                        <div class="space-y-2 p-5  w-full rounded-md">
                                            <details class="w-full">
                                                <summary class="text-amber-800">{{tarea.nombre}}</summary>
                                                <div class="flex flex-col space-y-6">
                                                    <p class="text-amber-600">{{tarea.descripcion}}</p>
                                                    <details>
                                                        <summary class="text-amber-800">Subtareas</summary>
                                                        <ul>
                                                            <template v-for="subtarea in subtareas">
                                                                <template v-if="subtarea.tarea_id === tarea.id">
                                                                <li v-if="!subtarea.completada">
                                                                    <div class="border-amber-800 border-l-8 rounded-md bg-amber-200 space-y-5 p-3">
                                                                        <div class="space-y-2 p-5  rounded-md">
                                                                            <p class="text-amber-600">{{subtarea.nombre}}</p>
                                                                            <p class="text-amber-600">{{subtarea.descripcion}}</p>
                                                                            <button @click="completarSubTarea(subtarea)" class="rounded-md px-5 py-2 bg-amber-800 text-gray-50" >Echa</button>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                    </template>
                                                            </template>
                                                        </ul>
                                                    </details>
                                                    <div class="justify-end text-end items-end space-x-8">
                                                        <button class="text-amber-600" @click="crearSubTarea(tarea)">Agregar Subtarea</button>

                                                        <button @click="completarTarea(tarea)" class="rounded-md px-5 py-2 bg-amber-500 text-gray-50" >Echa</button>                                                  </div>
                                                </div>
                                            </details>
                                        </div>

                                    </div>
                                </li>
                        </template>
                    </ul>
                    </div>
                </div>
                <div class="flex flex-col justify-center items-center   p-10 w-2/3   rounded-md">

                    <h3 class="font-bold text-amber-900 text-center p-3 text-2xl">Finalizadas</h3>
                    <div class=" flex w-full ">

                    <ul class="space-y-3 w-full">
                        <template v-for="tarea in tareas" >

                                <li v-if="tarea.completada">
                                    <div class="flex border-amber-800 border-l-8 rounded-md bg-amber-200 space-x-5 p-3">
                                        <div class="w-1/2 justify-start items-start text-start flex space-x-5">
                                            <h2 class="text-start text-amber-800">{{tarea.nombre}}</h2>

                                            </div>
                                        <div class="w-1/2 justify-end items-end  text-end flex space-x-5">
                                            <button @click="completarTarea(tarea)" class="rounded-md px-5 py-2 bg-amber-600 text-gray-50" >Retornar</button>

                                        </div>

                                    </div>
                                </li>
                        </template>
                    </ul>
                    </div>
                </div>

            </div>

            <div class="w-4/5">
                <div class="flex-col p-5 items-center bg-amber-500 border-b-2 border-gray-300 text-gray-50 justify-center  rounded-xl">
                    <h3 class="font-bold text-2xl">Crear Tarea</h3>
                    <div class="flex flex-col space-y-5">
                        <div class="flex flex-col space-y-2">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" v-model="data.FormData.nombre" class="text-amber-600 border-2 border-gray-300 rounded-xl p-2">
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="descripcion">Descripcion</label>
                            <textarea name="descripcion" id="descripcion" cols="30" rows="10" v-model="data.FormData.descripcion" class="text-amber-600 border-2 border-gray-300 rounded-xl p-2"></textarea>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="fecha">Fecha</label>
                            <input type="date" name="fecha" id="fecha" v-model="data.FormData.fecha" class="text-amber-600 border-2 border-gray-300 rounded-xl p-2">
                        </div>


                        <div class="flex flex-col items-center justify-center space-y-2">
                            <button @click="submitForm" class="bg-amber-800 text-gray-50 rounded-xl py-2 px-4">Crear</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div>

        </div>

    </div>
</AppLayout>
</template>

<style scoped>

</style>
