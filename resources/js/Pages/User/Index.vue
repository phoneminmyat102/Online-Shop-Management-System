<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import UserLayout from "./Layouts/UserLayout.vue";
import Hero from "./Layouts/Hero.vue";
import { Link } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
import Products from "../User/Components/Products.vue";
onMounted(() => {
    initFlowbite();
});

defineProps({
    products: Array,
});
</script>
<template>
    <user-layout>
        <!-- hero section -->
        <Hero></Hero>
        <!-- end -->

        <!-- latest product  -->
        <div class="bg-white">
            <div
                class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8"
            >
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Latest Products
                </h2>

                <!-- products -->
                <div
                    class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8"
                >
                    <Products :products="products"></Products>
                    <!-- end  -->
                </div>
                <div class="flex justify-center mt-5">
                    <Link
                        :href="route('products.index')"
                        type="button"
                        class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                    >
                        More Options
                    </Link>
                </div>
            </div>
        </div>
        <!-- end -->
    </user-layout>
</template>
