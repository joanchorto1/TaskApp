<template>
    <AppLayout>
        <div class="flex flex-col w-full min-h-screen items-center justify-center">
            <div class="p-10 h-full w-4/6">
                <Calendar class="h-1/2 w-full text-4xl "/>

            </div>
        </div>
    </AppLayout>

</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Calendar from "@/Components/Calendar.vue";

const props = defineProps({
    proyecto: Object,
    usuario: Object,
    tareas: Array,
    subtareas: Array,
});

</script>
