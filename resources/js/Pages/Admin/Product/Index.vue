<template>
    <admin-layout :auth="auth">
        <product-list :products = "products"></product-list>
    </admin-layout>
</template>
<script setup>
import AdminLayout from '../Components/AdminLayout.vue';
import ProductList from './ProductList.vue';
import { usePage } from "@inertiajs/vue3";

const auth = usePage().props.user;
defineProps ({
    products : Array
    
});
</script>