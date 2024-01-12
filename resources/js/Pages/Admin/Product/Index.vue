<template>
    <admin-layout>
        <product-list :products = "products"></product-list>
    </admin-layout>
</template>
<script setup>
import AdminLayout from '../Components/AdminLayout.vue';
import ProductList from './ProductList.vue';

defineProps ({
    products : Array
});
</script>