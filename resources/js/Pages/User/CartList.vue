<script setup>
import UserLayout from "./Layouts/UserLayout.vue";
import { onMounted, reactive } from "vue";
import Hero from "./Layouts/Hero.vue";
import { router } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps({
    userAddress: Object,
});

const carts = computed(() => usePage().props.cart.data.items);
const products = computed(() => usePage().props.cart.data.products);
const total = computed(() => usePage().props.cart.data.total);
const itemId = (id) => carts.value.findIndex((item) => item.product_id === id);

const update = (product, quantity) =>
    router.patch(route("cart.update", product), {
        quantity,
    });

const remove = (product) => router.delete(route("cart.delete", product));

// address form
const form = reactive({
    address1: null,
    state: null,
    city: null,
    zipcode: null,
    country_code: null,
    type: null,
});

const formFilled = computed(() => {
    return (
        form.address1 !== null &&
        form.state !== null &&
        form.city !== null &&
        form.zipcode !== null &&
        form.country_code !== null &&
        form.type !== null
    );
});

// submit function
function submit() {
    router.visit(route("checkout.store"), {
        method: "post",
        data: {
            carts: usePage().props.cart.data.items,
            products: usePage().props.cart.data.products,
            total: usePage().props.cart.data.total,
            address: form,
        },
    });
}
</script>

<template>
    <user-layout>
        <section class="text-gray-600 body-font relative">
            <div
                class="container px-5 py-24 mx-auto flex sm:flex-nowrap flex-wrap"
            >
                <div class="lg:w-2/3 md:w-1/2 rounded-lg sm:mr-10 p-10">
                    <!-- list of cart  -->

                    <div
                        class="relative overflow-x-auto shadow-md sm:rounded-lg"
                    >
                        <table
                            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                            >
                                <tr>
                                    <th scope="col" class="px-16 py-3">
                                        <span class="sr-only">Image</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product
                                    </th>
                                    <th scope="col" class="px-6 py-3">Qty</th>
                                    <th scope="col" class="px-6 py-3">Price</th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="product in products"
                                    :key="product.id"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                >
                                    <td class="p-4">
                                        <img
                                            v-if="
                                                product.product_images.length >
                                                0
                                            "
                                            :src="`/${product.product_images[0].image}`"
                                            class="w-16 md:w-32 max-w-full max-h-full"
                                            alt="Apple Watch"
                                        />

                                        <img
                                            v-else
                                            src="data:image/png;base64,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"
                                            class="w-16 md:w-32 max-w-full max-h-full"
                                            alt="Apple Watch"
                                        />
                                    </td>
                                    <td
                                        class="px-6 py-4 font-semibold text-gray-900 dark:text-white"
                                    >
                                        {{ product.title }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <button
                                                :disabled="
                                                    carts[itemId(product.id)]
                                                        .quantity <= 1
                                                "
                                                @click.prevent="
                                                    update(
                                                        product,
                                                        carts[
                                                            itemId(product.id)
                                                        ].quantity - 1
                                                    )
                                                "
                                                :class="[
                                                    carts[itemId(product.id)]
                                                        .quantity > 1
                                                        ? 'cursor-pointer text-purple-600'
                                                        : 'cursor-not-allowed text-gray-300 dark:text-gray-500',
                                                    'inline-flex items-center justify-center p-1 me-3 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700',
                                                ]"
                                                class="inline-flex items-center justify-center p-1 me-3 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                                type="button"
                                            >
                                                <span class="sr-only"
                                                    >Quantity button</span
                                                >
                                                <svg
                                                    class="w-3 h-3"
                                                    aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 18 2"
                                                >
                                                    <path
                                                        stroke="currentColor"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M1 1h16"
                                                    />
                                                </svg>
                                            </button>
                                            <div>
                                                <input
                                                    v-model="
                                                        carts[
                                                            itemId(product.id)
                                                        ].quantity
                                                    "
                                                    type="number"
                                                    id="first_product"
                                                    class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="1"
                                                    required
                                                />
                                            </div>
                                            <button
                                                @click.prevent="
                                                    update(
                                                        product,
                                                        carts[
                                                            itemId(product.id)
                                                        ].quantity + 1
                                                    )
                                                "
                                                class="inline-flex items-center justify-center h-6 w-6 p-1 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                                type="button"
                                            >
                                                <span class="sr-only"
                                                    >Quantity button</span
                                                >
                                                <svg
                                                    class="w-3 h-3"
                                                    aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 18 18"
                                                >
                                                    <path
                                                        stroke="currentColor"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 1v16M1 9h16"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td
                                        class="px-6 py-4 font-semibold text-gray-900 dark:text-white"
                                    >
                                        $ {{ product.price }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a
                                            @click="remove(product)"
                                            href="#"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                            >Remove</a
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- end  -->
                </div>
                <div
                    class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0"
                >
                    <h2
                        class="text-gray-900 text-lg mb-1 font-medium title-font"
                    >
                        Summary
                    </h2>
                    <p class="leading-relaxed mb-5 text-gray-600">
                        Total: $ {{ total }}
                    </p>

                    <div v-if="userAddress">
                        <h2
                            class="text-gray-900 text-lg mb-1 font-medium title-font"
                        >
                            Shipping Address
                        </h2>
                        <p class="leading-relaxed mb-5 text-gray-600">
                            {{ userAddress.address1 }} , {{ userAddress.city }},
                            {{ userAddress.zipcode }}
                        </p>
                        <p class="leading-relaxed mb-5 text-gray-600">
                            or you can add new below
                        </p>
                    </div>

                    <div v-else>
                        <p class="leading-relaxed mb-5 text-gray-600">
                            Add shipping address to continue
                        </p>
                    </div>

                    <form action="" @submit.prevent="submit">
                        <div class="relative mb-4">
                            <label
                                for="address1"
                                class="leading-7 text-sm text-gray-600"
                                >Address 1</label
                            >
                            <input
                                v-model="form.address1"
                                type="text"
                                id="address1"
                                name="address1"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                        </div>
                        <div class="relative mb-4">
                            <label
                                for="city"
                                class="leading-7 text-sm text-gray-600"
                                >City</label
                            >
                            <input
                                v-model="form.city"
                                type="text"
                                id="city"
                                name="city"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                        </div>
                        <div class="relative mb-4">
                            <label
                                for="state"
                                class="leading-7 text-sm text-gray-600"
                                >State</label
                            >
                            <input
                                v-model="form.state"
                                type="text"
                                id="state"
                                name="state"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                        </div>
                        <div class="relative mb-4">
                            <label
                                for="zip_code"
                                class="leading-7 text-sm text-gray-600"
                                >Zipcode</label
                            >
                            <input
                                v-model="form.zipcode"
                                type="text"
                                id="zip_code"
                                name="zipcode"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                        </div>
                        <div class="relative mb-4">
                            <label
                                for="country_code"
                                class="leading-7 text-sm text-gray-600"
                                >Country Code</label
                            >
                            <input
                                v-model="form.country_code"
                                type="text"
                                id="country_code"
                                name="country_code"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                        </div>
                        <div class="relative mb-4">
                            <label
                                for="address_type"
                                class="leading-7 text-sm text-gray-600"
                                >Address Type</label
                            >
                            <input
                                v-model="form.type"
                                type="text"
                                id="address_type"
                                name="type"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                        </div>
                        <button
                            v-if="formFilled || userAddress"
                            type="submit"
                            class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg"
                        >
                            Checkout
                        </button>

                        <button
                            v-else
                            type="submit"
                            class="text-white bg-gray-500 border-0 py-2 px-6 focus:outline-none hover:bg-gray-600 rounded text-lg"
                        >
                            Add Address to continue
                        </button>
                    </form>

                    <p class="text-xs text-gray-500 mt-3">Continue Shopping</p>
                </div>
            </div>
        </section>
    </user-layout>
</template>
