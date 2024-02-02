<template>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">

        <!-- nav start -->
            <navbar :auth="auth"></navbar>
        <!-- nav end -->
   
        <!-- Sidebar -->
            <sidebar></sidebar>
        <!-- sidebar end -->

            <main class="p-4 md:ml-64 h-auto pt-20">
                <slot/>
            </main>
    

  
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import { usePage } from "@inertiajs/vue3";
import Navbar from './Navbar.vue';
import Sidebar from './Sidebar.vue';
defineProps({
    auth:Object
})
onMounted(() => {
    initFlowbite();
});
</script>
