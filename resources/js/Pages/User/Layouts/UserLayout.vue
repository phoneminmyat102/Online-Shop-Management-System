<template>
    <!-- header -->
        <Header></Header>
    <!-- end -->

    <slot/>

    <!-- footer -->
        <Footer></Footer>
    <!-- end -->
</template>

<script setup>

import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import Header from './Header.vue';
import Footer from './Footer.vue';
onMounted(() => {
    initFlowbite();
});
</script>
