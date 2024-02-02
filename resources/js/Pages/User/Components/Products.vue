<script setup>
import { Link, router } from '@inertiajs/vue3';

defineProps({
    products: Array,
});

const addCart = (product) => {
    console.log(product);
    router.post(route("cart.store", product), {   
        onSuccess: (page) => {
            if (page.props.flash.success) {
                Swal.fire({
                    toast: true,
                    icon: "success",
                    position: "top-end",
                    showConfirmButton: false,
                    title: page.props.flash.success,
                });
            }
        },
    });
};
</script>

<template>
   
        <div
            v-if="products.length > 0"
            v-for="product in products"
            :key="product.id"
            class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
        >
            <a href="#">
                <img
                    class="p-8 rounded-t-lg w-11/12 h-4/6"
                    v-if="product.product_images.length > 0"
                    :src="`/${product.product_images[0].image}`"
                    alt="product image"
                />

                <img
                    class="p-8 rounded-t-lg"
                    v-else
                    src="data:image/jpeg;base64,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"
                    alt="product image"
                />
            </a>
            <div class="px-3 pb-3">
                <a href="#">
                    <h5
                        class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white"
                    >
                        {{ product.title }}
                    </h5>
                </a>
                <span class="text-lg font-bold text-gray-600 dark:text-white">
                    {{ product.brand.name }}</span
                >

                <div class="flex items-center justify-between mt-2">
                    <span
                        class="text-xl font-bold text-gray-900 dark:text-white"
                        >$ {{ product.price }}</span
                    >

                    <a
                        href="#"
                        @click="addCart(product)"
                        class="text-white bg-purple-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-sm px-3 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        ><svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"
                            />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div
            v-else
           
            
        >
            <span class="font-bold text-red-700 flex justify-center text-2xl">Products Not Found!</span>
        </div>
        <!-- More products... -->
    
</template>
