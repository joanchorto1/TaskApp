<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {Inertia} from "@inertiajs/inertia";
import {defineProps} from "vue";
import {reactive} from "vue";


const props = defineProps({
    proyectos: Array,
    usuario: Object,

});


const data = reactive ({
        FormData: {
            nombre: '',
            descripcion: '',
            user_id: props.usuario.id
        }
    }
);



const submitForm = () => {
    Inertia.post(route('proyectos.store',data.FormData));
}


</script>

<template>
    <AppLayout title="Dashboard">
        <div class="flex flex-col justify-center items-center w-full min-h-screen">
            <div class="flex space-x-5 w-5/6  justify-center ">
                <div class="w-2/5">
                    <div class="bg-amber-500 flex-col p-5  text-gray-50 border-b-2 border-gray-300   w-2/3 rounded-xl">
                        <h3 class="font-bold text-2xl">Crear Proyecto</h3>
                        <div class="flex flex-col space-y-5">
                            <div class="flex flex-col space-y-2">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" id="nombre" v-model="data.FormData.nombre" class="border-2 text-amber-600 border-amber-200 rounded-xl p-2">

                            </div>
                            <div class="flex flex-col space-y-2">
                                <label for="descripcion">Descripcion</label>
                                <textarea name="descripcion" id="descripcion" cols="30" rows="10" v-model="data.FormData.descripcion" class=" text-amber-600 border-2 border-gray-300 rounded-xl p-2"></textarea>
                            </div>

                            <div class="flex flex-col space-y-2">
                                <button @click="submitForm" class="bg-amber-800 text-gray-50 rounded-xl p-2">Crear</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div
                    class="flex-col my-10  p-5  text-amber-800 justify-start  w-3/5 rounded-xl">
                    <h3 class="font-bold  text-center p-3 text-2xl">Proyectos</h3>
                    <ul class="space-y-3">
                        <template v-for="proyecto in proyectos" >
                            <template v-if="proyecto.user_id === usuario.id">
                                <li>
                                    <div class="border-amber-800 rounded-xl bg-amber-200 text-gray-50 border-l-8  space-y-5 p-3">
                                        <div class="space-y-2">
                                            <h4 class="font-bold text-amber-900 text-xl">{{proyecto.nombre}}</h4>
                                            <h5 class="font-bold text-amber-900">Descripción:</h5>
                                            <p class="text-amber-700">{{proyecto.descripcion}}</p>

                                        </div>
                                        <div class="justify-end items-end text-end">
                                            <a class="rounded-md bg-amber-500 text-gray-50 px-7 py-1" :href="route('proyectos.show', proyecto )">Ir</a>

                                        </div>
                                    </div>
                                </li>
                            </template>
                        </template>
                    </ul>
                </div>

            </div>
            <div>

            </div>

        </div>

    </AppLayout>
</template>
