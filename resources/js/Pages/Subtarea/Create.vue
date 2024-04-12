<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import {reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    tarea: Object,
});
const data = reactive({

    FormData: {
        nombre: "",
        descripcion: "",
        tarea_id: props.tarea.id,
        completada: false,
    },
});

const submitForm = () => {
    Inertia.post(route('subtareas.store',data.FormData));
}
</script>

<template>
<AppLayout>
    <div class="flex flex-col items-center  justify-center w-full  ">



    <div class="items-center justify-center m-10 w-4/5">
        <div class="flex-col p-5 items-center bg-amber-500 border-b-2 border-gray-300 text-gray-50 justify-center  rounded-xl">
            <h3 class="font-bold text-2xl">Crear SubTarea</h3>
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
                    <button @click="submitForm" class="bg-amber-500 text-gray-50 rounded-xl p-2">Crear</button>
                </div>
            </div>
        </div>
    </div>
    </div>

</AppLayout>
</template>

<style scoped>

</style>
