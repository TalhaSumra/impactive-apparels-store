<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import ProductCard from '@/Components/ProductCard.vue';
import ProductVisual from '@/Components/ProductVisual.vue';
import StoreLayout from '@/Layouts/StoreLayout.vue';
import { formatPrice } from '@/lib/format';

defineProps({
    cart: {
        type: Object,
        required: true,
    },
    recommendedProducts: {
        type: Array,
        required: true,
    },
});

function removeItem(itemKey) {
    router.delete(route('cart.destroy', itemKey), {
        preserveScroll: true,
    });
}

function updateQuantity(itemKey, quantity) {
    if (quantity < 1) {
        return;
    }

    router.patch(route('cart.update', itemKey), {
        quantity,
    }, {
        preserveScroll: true,
    });
}
</script>

<template>
    <Head title="Your Cart" />

    <StoreLayout>
        <section v-if="cart.count > 0" class="grid gap-6 xl:grid-cols-[1.12fr_0.88fr]">
            <div
                class="rounded-[38px] border border-[#1e140f]/10 bg-white/78 p-6 shadow-[0_24px_80px_rgba(53,33,23,0.08)] backdrop-blur-xl sm:p-8"
            >
                <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.32em] text-[#8a563c]">
                            Cart
                        </p>
                        <h1 class="mt-3 text-5xl leading-tight text-[#1e140f]">
                            Review your order before checkout.
                        </h1>
                    </div>
                    <div class="text-sm text-[#6b5346]">
                        {{ cart.count }} total items
                    </div>
                </div>

                <div class="mt-8 space-y-4">
                    <article
                        v-for="item in cart.items"
                        :key="item.key"
                        class="grid gap-4 rounded-[30px] border border-[#1e140f]/8 bg-[#fcf7f1] p-4 lg:grid-cols-[220px_1fr]"
                    >
                        <ProductVisual :product="item.product" compact />

                        <div class="flex flex-col justify-between gap-5">
                            <div>
                                <div class="flex flex-wrap items-start justify-between gap-3">
                                    <div>
                                        <p
                                            class="text-xs uppercase tracking-[0.28em] text-[#8a563c]"
                                        >
                                            {{ item.product.category }}
                                        </p>
                                        <Link
                                            :href="route('products.show', item.product.slug)"
                                            class="mt-2 block text-3xl leading-tight text-[#1e140f] transition hover:text-[#ad5a34]"
                                        >
                                            {{ item.product.name }}
                                        </Link>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs uppercase tracking-[0.26em] text-[#8a563c]">
                                            Line Total
                                        </p>
                                        <p class="mt-2 text-2xl text-[#1e140f]">
                                            {{ formatPrice(item.line_total) }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 flex flex-wrap gap-2 text-sm font-semibold text-[#5f483b]">
                                    <span class="rounded-full border border-[#1e140f]/10 bg-white px-3 py-2">
                                        Size: {{ item.size }}
                                    </span>
                                    <span class="rounded-full border border-[#1e140f]/10 bg-white px-3 py-2">
                                        {{ formatPrice(item.unit_price) }} each
                                    </span>
                                </div>
                            </div>

                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                <div class="inline-flex items-center rounded-full border border-[#1e140f]/10 bg-white p-1">
                                    <button
                                        type="button"
                                        @click="updateQuantity(item.key, item.quantity - 1)"
                                        class="rounded-full px-4 py-2 text-sm font-semibold text-[#1e140f] transition hover:bg-[#f5ece3]"
                                    >
                                        −
                                    </button>
                                    <span class="min-w-12 text-center text-sm font-semibold text-[#1e140f]">
                                        {{ item.quantity }}
                                    </span>
                                    <button
                                        type="button"
                                        @click="updateQuantity(item.key, item.quantity + 1)"
                                        class="rounded-full px-4 py-2 text-sm font-semibold text-[#1e140f] transition hover:bg-[#f5ece3]"
                                    >
                                        +
                                    </button>
                                </div>

                                <button
                                    type="button"
                                    @click="removeItem(item.key)"
                                    class="rounded-full border border-[#1e140f]/10 bg-white px-4 py-2 text-sm font-semibold text-[#1e140f] transition hover:border-[#b03e35]/30 hover:text-[#b03e35]"
                                >
                                    Remove
                                </button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <div class="space-y-6">
                <div
                    class="rounded-[38px] border border-[#1e140f]/10 bg-white/78 p-6 shadow-[0_24px_80px_rgba(53,33,23,0.08)] backdrop-blur-xl sm:p-8"
                >
                    <p class="text-xs uppercase tracking-[0.32em] text-[#8a563c]">
                        Order Summary
                    </p>
                    <div class="mt-5 space-y-4">
                        <div class="flex items-center justify-between text-sm text-[#6b5346]">
                            <span>Items</span>
                            <span>{{ cart.count }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm text-[#6b5346]">
                            <span>Production shipping</span>
                            <span>Confirmed at checkout</span>
                        </div>
                        <div class="h-px bg-[#1e140f]/10"></div>
                        <div class="flex items-center justify-between text-base font-semibold text-[#1e140f]">
                            <span>Subtotal</span>
                            <span>{{ formatPrice(cart.subtotal) }}</span>
                        </div>
                    </div>

                    <Link
                        :href="route('checkout.index')"
                        class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-full bg-[#1e140f] px-6 py-3 text-sm font-semibold text-[#f7efe6] transition hover:bg-[#ad5a34]"
                    >
                        Continue to Checkout
                        <span aria-hidden="true">→</span>
                    </Link>

                    <p class="mt-4 text-sm leading-7 text-[#6b5346]">
                        Customers can place the order online now. Final branding
                        notes, sponsor placements, and production requirements
                        can be added during checkout.
                    </p>
                </div>

                <div
                    class="rounded-[38px] border border-[#1e140f]/10 bg-[#1a120e] p-6 text-[#f7efe6] shadow-[0_30px_120px_rgba(26,18,14,0.28)] sm:p-8"
                >
                    <p class="text-xs uppercase tracking-[0.32em] text-[#d9b392]">
                        Need more items?
                    </p>
                    <h2 class="mt-4 text-4xl leading-tight">
                        Keep building the order with more kits, hoodies, or team
                        bundles.
                    </h2>
                    <Link
                        :href="route('shop.index')"
                        class="mt-6 inline-flex items-center gap-2 rounded-full bg-[#ad5a34] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#8d4829]"
                    >
                        Continue Shopping
                        <span aria-hidden="true">→</span>
                    </Link>
                </div>
            </div>
        </section>

        <section
            v-else
            class="rounded-[38px] border border-[#1e140f]/10 bg-white/78 p-10 text-center shadow-[0_24px_80px_rgba(53,33,23,0.08)] backdrop-blur-xl"
        >
            <p class="text-xs uppercase tracking-[0.32em] text-[#8a563c]">
                Your cart is empty
            </p>
            <h1 class="mt-4 text-5xl leading-tight text-[#1e140f]">
                Start with the catalog and build your order.
            </h1>
            <p class="mx-auto mt-4 max-w-2xl text-base leading-8 text-[#5f483b]">
                This project now supports a real public ordering flow, so once
                products are added here the customer can continue straight into
                checkout.
            </p>
            <div class="mt-6">
                <Link
                    :href="route('shop.index')"
                    class="inline-flex items-center gap-2 rounded-full bg-[#1e140f] px-6 py-3 text-sm font-semibold text-[#f7efe6] transition hover:bg-[#ad5a34]"
                >
                    Browse Products
                    <span aria-hidden="true">→</span>
                </Link>
            </div>
        </section>

        <section v-if="recommendedProducts.length > 0" class="mt-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.32em] text-[#8a563c]">
                        Recommended Products
                    </p>
                    <h2 class="mt-3 text-4xl text-[#1e140f]">
                        Add a few more pieces before checkout.
                    </h2>
                </div>
                <Link
                    :href="route('shop.index')"
                    class="text-sm font-semibold text-[#8a563c] transition hover:text-[#ad5a34]"
                >
                    View full catalog →
                </Link>
            </div>

            <div class="mt-6 grid gap-5 lg:grid-cols-3">
                <ProductCard
                    v-for="product in recommendedProducts"
                    :key="product.id"
                    :product="product"
                />
            </div>
        </section>
    </StoreLayout>
</template>
