<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Calendar from '@/Components/Calendar.vue';
import {defineProps} from "vue";




const props = defineProps({
    proyectos: Array,
    usuario: Object,
    tareas: Array,

});


//Conseguir los proyectos del usuario:
const proyectosUsuario = props.proyectos.filter(proyecto => proyecto.user_id === props.usuario.id);

//Conseguir las tareas del usuario:
const tareasUsuario = props.tareas.filter(tarea => proyectosUsuario.some(proyecto => proyecto.id === tarea.proyecto_id));

//Conseguir las tareas no completadas del usuario:
const tareasNoCompletadas = tareasUsuario.filter(tarea => !tarea.completada);

//Guardar las 3 tareas mas proximas a la fecha actual:
const tareasProximas = () => {

    const tareas= tareasNoCompletadas
    const tareasProximas= []
    const proximas =[]
    const hoy= new Date();
    for (let i = 0; i < tareas.length(); i++) {
        if (tareas[i].fecha> hoy){
            tareasProximas.push(tareas[i])
        }
        for (let j = 0; j < tareasProximas.length; j++) {
            
        }
    }
}
const tareasRecientes = tareasNoCompletadas.sort((a, b) => new Date(b.fecha) - new Date(a.fecha)).slice(0, 3);

//Guardar los tres proyectos con fecha de creaccion mas nueva:
const proyectosRecientes = proyectosUsuario.sort((a, b) => new Date(b.created_at) - new Date(a.created_at)).slice(0, 3);


</script>

<template>
    <AppLayout title="Dashboard">
        <div class="flex flex-col space-y-10 bg-gray-50 w-full items-center justify-center ">
            <h3 class="text-3xl text-amber-800 font-bold">Hola {{usuario.name}}</h3>
            <div class="flex w-3/4 items-center justify-center space-x-8">
                <div class=" p-10 rounded-md w-1/3">
                    <Calendar/>
                </div>
                <div class="flex   p-10 rounded-md flex-col space-y-6 w-2/3">
                    <div class="items-center  space-y-6 justify-center text-center">
                        <h4 class="text-2xl text-amber-800 font-bold">Proxima tareas</h4>
                    </div>
                    <div class="space-y-5">
                        <template v-for="tarea in tareasRecientes">
                            <div class="flex space-x-8 w-full bg-amber-200 border-l-8 border-amber-800 p-5 rounded-xl">
                                <p class="text-start">{{ tarea.nombre }}</p>
                                <p class="text-end">{{ tarea.fecha }}</p>
                            </div>
                        </template>
                    </div>

                </div>
            </div>
            <div class="flex-col w-3/4 items-center justify-center flex">
                <div class="flex   w-full justify-center items-center">
                    <div class="w-1/2 p-5 justify-start content-start items-start text-start">
                        <h4 class="justify-start content-start items-start text-amber-800 text-2xl font-bold  text-start">Proyectos</h4>

                    </div>
                    <div class="p-5 justify-end items-end text-end w-1/2">
                        <p class="justify-end items-end text-amber-500 text-end"><a :href="route('proyectos.index')">Ver todos..</a></p>

                    </div>
                </div>
                <div class="w-full space-y-6">

                    <template v-for="proyecto in proyectosRecientes">
                        <div class="flex space-x-8 w-full bg-amber-200 border-l-8 border-amber-800 p-5 rounded-xl">

                            <p class="text-start text-xl text-amber-800  w-1/2">{{ proyecto.nombre }}</p>
                            <div class="w-1/2 items-center justify-center text-end">
                                <button class=" bg-amber-500 text-white p-2 rounded-xl"><a
                                    :href="route('proyectos.show',proyecto)">Ver Proyecto</a></button>
                            </div>

                        </div>
                    </template>

                </div>
            </div>

        </div>

    </AppLayout>
</template>
