<script setup>
import { computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ProductCard from '@/Components/ProductCard.vue';
import ProductVisual from '@/Components/ProductVisual.vue';
import StoreLayout from '@/Layouts/StoreLayout.vue';
import { formatPrice } from '@/lib/format';

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
    relatedProducts: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    product_id: props.product.id,
    quantity: props.product.min_order_quantity,
    size: props.product.available_sizes[0] ?? '',
});

const lineTotal = computed(() => form.quantity * props.product.price);

function addToCart() {
    form.post(route('cart.store'), {
        preserveScroll: true,
    });
}
</script>

<template>
    <Head :title="product.name" />

    <StoreLayout>
        <div class="mb-5 flex items-center gap-2 text-sm text-[#6c5446]">
            <Link :href="route('home')" class="transition hover:text-[#ad5a34]">
                Home
            </Link>
            <span>/</span>
            <Link :href="route('shop.index')" class="transition hover:text-[#ad5a34]">
                Shop
            </Link>
            <span>/</span>
            <span class="font-semibold text-[#1e140f]">{{ product.name }}</span>
        </div>

        <section class="grid gap-6 xl:grid-cols-[0.88fr_1.12fr]">
            <div
                class="rounded-[38px] border border-[#1e140f]/10 bg-white/78 p-4 shadow-[0_24px_80px_rgba(53,33,23,0.08)] backdrop-blur-xl sm:p-5"
            >
                <ProductVisual :product="product" />
            </div>

            <div
                class="rounded-[38px] border border-[#1e140f]/10 bg-white/78 p-6 shadow-[0_24px_80px_rgba(53,33,23,0.08)] backdrop-blur-xl sm:p-8"
            >
                <div class="flex flex-wrap items-center gap-3">
                    <span
                        class="rounded-full border border-[#1e140f]/10 bg-[#f6eee5] px-3 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-[#8a563c]"
                    >
                        {{ product.category }}
                    </span>
                    <span
                        class="rounded-full border border-[#1e140f]/10 bg-white px-3 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-[#6a5346]"
                    >
                        {{ product.sport }}
                    </span>
                </div>

                <h1 class="mt-5 max-w-3xl text-5xl leading-tight text-[#1e140f]">
                    {{ product.name }}
                </h1>
                <p class="mt-4 max-w-3xl text-base leading-8 text-[#5f483b]">
                    {{ product.description }}
                </p>

                <div class="mt-6 grid gap-4 sm:grid-cols-3">
                    <div class="rounded-[26px] border border-[#1e140f]/8 bg-[#fcf7f1] p-4">
                        <p class="text-xs uppercase tracking-[0.26em] text-[#8a563c]">
                            Starting Price
                        </p>
                        <p class="mt-3 text-3xl text-[#1e140f]">
                            {{ formatPrice(product.price) }}
                        </p>
                    </div>
                    <div class="rounded-[26px] border border-[#1e140f]/8 bg-[#fcf7f1] p-4">
                        <p class="text-xs uppercase tracking-[0.26em] text-[#8a563c]">
                            Lead Time
                        </p>
                        <p class="mt-3 text-3xl text-[#1e140f]">
                            {{ product.lead_time_days }} days
                        </p>
                    </div>
                    <div class="rounded-[26px] border border-[#1e140f]/8 bg-[#fcf7f1] p-4">
                        <p class="text-xs uppercase tracking-[0.26em] text-[#8a563c]">
                            Minimum Order
                        </p>
                        <p class="mt-3 text-3xl text-[#1e140f]">
                            {{ product.min_order_quantity }}
                        </p>
                    </div>
                </div>

                <form
                    @submit.prevent="addToCart"
                    class="mt-8 rounded-[30px] border border-[#1e140f]/8 bg-[#fdf8f3] p-5"
                >
                    <div>
                        <p class="text-xs uppercase tracking-[0.28em] text-[#8a563c]">
                            Select Size
                        </p>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <button
                                v-for="size in product.available_sizes"
                                :key="size"
                                type="button"
                                @click="form.size = size"
                                class="rounded-full border px-4 py-2 text-sm font-semibold transition"
                                :class="form.size === size ? 'border-[#ad5a34] bg-[#ad5a34] text-white' : 'border-[#1e140f]/10 bg-white text-[#1e140f] hover:border-[#ad5a34]/30 hover:text-[#ad5a34]'"
                            >
                                {{ size }}
                            </button>
                        </div>
                        <p v-if="form.errors.size" class="mt-2 text-sm text-[#b03e35]">
                            {{ form.errors.size }}
                        </p>
                    </div>

                    <div class="mt-6 grid gap-4 lg:grid-cols-[0.8fr_1fr]">
                        <div>
                            <label
                                for="quantity"
                                class="text-xs uppercase tracking-[0.28em] text-[#8a563c]"
                            >
                                Quantity
                            </label>
                            <input
                                id="quantity"
                                v-model.number="form.quantity"
                                type="number"
                                :min="product.min_order_quantity"
                                class="mt-3 w-full rounded-2xl border border-[#1e140f]/10 bg-white px-4 py-3 text-sm text-[#1e140f] outline-none transition focus:border-[#ad5a34]/40"
                            />
                            <p v-if="form.errors.quantity" class="mt-2 text-sm text-[#b03e35]">
                                {{ form.errors.quantity }}
                            </p>
                        </div>

                        <div class="rounded-[24px] border border-[#1e140f]/8 bg-white p-4">
                            <p class="text-xs uppercase tracking-[0.26em] text-[#8a563c]">
                                Order Summary
                            </p>
                            <div class="mt-3 flex items-center justify-between text-sm text-[#6b5346]">
                                <span>Estimated line total</span>
                                <span class="text-lg font-bold text-[#1e140f]">
                                    {{ formatPrice(lineTotal) }}
                                </span>
                            </div>
                            <p class="mt-3 text-sm leading-7 text-[#6b5346]">
                                Use checkout notes for player names, sponsor
                                positions, team logos, and any extra production
                                requirements.
                            </p>
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="mt-6 inline-flex items-center gap-2 rounded-full bg-[#1e140f] px-6 py-3 text-sm font-semibold text-[#f7efe6] transition hover:bg-[#ad5a34]"
                        :disabled="form.processing"
                    >
                        {{ form.processing ? 'Adding...' : 'Add to Cart' }}
                        <span aria-hidden="true">→</span>
                    </button>
                </form>

                <div class="mt-8 grid gap-3">
                    <article
                        v-for="highlight in product.highlights"
                        :key="highlight"
                        class="rounded-[24px] border border-[#1e140f]/8 bg-[#fcf7f1] px-4 py-4 text-sm leading-7 text-[#5f483b]"
                    >
                        {{ highlight }}
                    </article>
                </div>
            </div>
        </section>

        <section v-if="relatedProducts.length > 0" class="mt-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.32em] text-[#8a563c]">
                        Related Products
                    </p>
                    <h2 class="mt-3 text-4xl text-[#1e140f]">
                        More kits in the same category.
                    </h2>
                </div>
                <Link
                    :href="route('shop.index')"
                    class="text-sm font-semibold text-[#8a563c] transition hover:text-[#ad5a34]"
                >
                    Back to full catalog →
                </Link>
            </div>

            <div class="mt-6 grid gap-5 lg:grid-cols-3">
                <ProductCard
                    v-for="relatedProduct in relatedProducts"
                    :key="relatedProduct.id"
                    :product="relatedProduct"
                />
            </div>
        </section>
    </StoreLayout>
</template>
