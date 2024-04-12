<template>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class=" px-4 text-center bg-amber-500 text-gray-50 py-5 border-b border-gray-200 sm:px-6">
            <h3 class="  leading-6 text-gray-50 font-bold">{{ month }} {{ year }}</h3>
        </div>
        <div class="grid grid-cols-7 gap-1 p-5">
            <template v-for="(day, index) in daysInMonth" :key="index">
                <div v-if="day !== currentDay" class=" text-center  font-medium text-gray-900">{{ day }}</div>
                <div v-else class=" text-center font-medium bg-amber-800  rounded-full text-gray-50">{{ day }}</div>
                <!-- Aquí puedes agregar cualquier contenido para representar los eventos del día -->
            </template>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const currentDate = new Date();
const year = ref(currentDate.getFullYear());
const month = ref(currentDate.toLocaleString('default', { month: 'long' }));
//Conseguir el numero del dia de hoy:
const currentDay = currentDate.getDate();
const daysInMonth = Array.from({ length: new Date(year.value, currentDate.getMonth() + 1, 0).getDate() }, (_, i) => i + 1);
</script>

<style scoped>
/* Estilos opcionales */
</style>
