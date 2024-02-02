<template>
    <admin-layout :auth="auth">
        
    </admin-layout>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
const auth = usePage().props.user;
import AdminLayout from './Components/AdminLayout.vue';
onMounted(() => {
    initFlowbite();
})
</script>
