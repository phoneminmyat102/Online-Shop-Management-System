<template>
    <admin-layout>
        
    </admin-layout>
</template>

<script setup>
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import AdminLayout from './Components/AdminLayout.vue';
onMounted(() => {
    initFlowbite();
})
</script>
