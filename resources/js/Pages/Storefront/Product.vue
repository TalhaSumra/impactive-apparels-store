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
        <div class="mb-5 flex items-center gap-2 text-sm text-[#6a7583]">
            <Link :href="route('home')" class="transition hover:text-[#d61f26]">
                Home
            </Link>
            <span>/</span>
            <Link :href="route('shop.index')" class="transition hover:text-[#d61f26]">
                Shop
            </Link>
            <span>/</span>
            <span class="font-semibold text-[#101317]">{{ product.name }}</span>
        </div>

        <section class="grid gap-6 xl:grid-cols-[0.92fr_1.08fr]">
            <div class="retail-card rounded-[24px] p-5">
                <ProductVisual :product="product" />
            </div>

            <div class="retail-card rounded-[24px] p-6 xl:p-8">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="rounded-full bg-[#d61f26] px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.22em] text-white">
                        {{ product.badge }}
                    </span>
                    <span class="rounded-full bg-[#f3f5f7] px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.22em] text-[#4c5968]">
                        {{ product.category }}
                    </span>
                    <span class="rounded-full bg-[#f3f5f7] px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.22em] text-[#4c5968]">
                        {{ product.sport }}
                    </span>
                </div>

                <h1 class="mt-5 text-[clamp(3.2rem,5vw,5.4rem)] leading-[0.9] text-[#101317]">
                    {{ product.name }}
                </h1>

                <div class="mt-4 flex flex-wrap items-center gap-3">
                    <span class="text-3xl font-semibold text-[#101317]">
                        {{ formatPrice(product.price) }}
                    </span>
                    <span class="text-sm font-medium uppercase tracking-[0.14em] text-[#4c5968]">
                        Made to order
                    </span>
                </div>

                <p class="mt-4 max-w-3xl text-base leading-7 text-[#4c5968]">
                    {{ product.description }}
                </p>

                <div class="mt-6 grid gap-4 sm:grid-cols-3">
                    <div class="rounded-[18px] bg-[#f7f9fb] p-4">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]">
                            Lead time
                        </p>
                        <p class="mt-2 text-2xl font-semibold text-[#101317]">
                            {{ product.lead_time_days }} days
                        </p>
                    </div>
                    <div class="rounded-[18px] bg-[#f7f9fb] p-4">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]">
                            Minimum
                        </p>
                        <p class="mt-2 text-2xl font-semibold text-[#101317]">
                            {{ product.min_order_quantity }} pcs
                        </p>
                    </div>
                    <div class="rounded-[18px] bg-[#f7f9fb] p-4">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]">
                            Available sizes
                        </p>
                        <p class="mt-2 text-2xl font-semibold text-[#101317]">
                            {{ product.available_sizes.length }}
                        </p>
                    </div>
                </div>

                <form
                    @submit.prevent="addToCart"
                    class="mt-8 rounded-[20px] border border-[#d9dee4] bg-[#f7f9fb] p-5"
                >
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]">
                            Size
                        </p>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <button
                                v-for="size in product.available_sizes"
                                :key="size"
                                type="button"
                                @click="form.size = size"
                                class="rounded-[12px] border px-4 py-2.5 text-sm font-semibold uppercase tracking-[0.12em] transition"
                                :class="form.size === size ? 'border-[#101317] bg-[#101317] text-white' : 'border-[#d9dee4] bg-white text-[#101317] hover:border-[#101317]'"
                            >
                                {{ size }}
                            </button>
                        </div>
                        <p v-if="form.errors.size" class="mt-2 text-sm text-[#b11218]">
                            {{ form.errors.size }}
                        </p>
                    </div>

                    <div class="mt-6 grid gap-4 lg:grid-cols-[0.72fr_1fr]">
                        <div>
                            <label
                                for="quantity"
                                class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]"
                            >
                                Quantity
                            </label>
                            <input
                                id="quantity"
                                v-model.number="form.quantity"
                                type="number"
                                :min="product.min_order_quantity"
                                class="mt-2 w-full rounded-[14px] border border-[#d9dee4] bg-white px-4 py-3 text-sm text-[#101317] outline-none transition focus:border-[#101317]"
                            />
                            <p v-if="form.errors.quantity" class="mt-2 text-sm text-[#b11218]">
                                {{ form.errors.quantity }}
                            </p>
                        </div>

                        <div class="rounded-[18px] border border-[#d9dee4] bg-white p-4">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]">
                                Estimated total
                            </p>
                            <p class="mt-2 text-3xl font-semibold text-[#101317]">
                                {{ formatPrice(lineTotal) }}
                            </p>
                            <p class="mt-3 text-sm leading-7 text-[#4c5968]">
                                Add names, logos, sponsor placements, and custom details during checkout.
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-[14px] bg-[#d61f26] px-6 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-white transition hover:bg-[#b11218]"
                            :disabled="form.processing"
                        >
                            {{ form.processing ? 'Adding...' : 'Add to cart' }}
                        </button>
                        <Link
                            :href="route('checkout.index')"
                            class="inline-flex items-center justify-center rounded-[14px] border border-[#101317] px-6 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-[#101317] transition hover:border-[#d61f26] hover:text-[#d61f26]"
                        >
                            Quick checkout
                        </Link>
                    </div>
                </form>

                <div class="mt-8 grid gap-3">
                    <article
                        v-for="highlight in product.highlights"
                        :key="highlight"
                        class="rounded-[18px] border border-[#d9dee4] bg-white px-4 py-4 text-sm leading-7 text-[#4c5968]"
                    >
                        {{ highlight }}
                    </article>
                </div>
            </div>
        </section>

        <section v-if="relatedProducts.length > 0" class="mt-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-[#6a7583]">
                        Related
                    </p>
                    <h2 class="mt-2 text-4xl text-[#101317]">
                        More in this category
                    </h2>
                </div>
                <Link
                    :href="route('shop.index')"
                    class="text-sm font-semibold uppercase tracking-[0.12em] text-[#d61f26]"
                >
                    Back to shop
                </Link>
            </div>

            <div class="mt-5 grid gap-5 lg:grid-cols-3">
                <ProductCard
                    v-for="relatedProduct in relatedProducts"
                    :key="relatedProduct.id"
                    :product="relatedProduct"
                />
            </div>
        </section>
    </StoreLayout>
</template>
