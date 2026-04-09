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
            <div class="retail-card rounded-[24px] p-6 xl:p-8">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-[#d61f26]">
                            Cart
                        </p>
                        <h1 class="mt-3 text-[clamp(3rem,5vw,5rem)] leading-[0.9] text-[#101317]">
                            Review your order
                        </h1>
                    </div>
                    <div class="text-sm text-[#4c5968]">
                        {{ cart.count }} items
                    </div>
                </div>

                <div class="mt-6 space-y-4">
                    <article
                        v-for="item in cart.items"
                        :key="item.key"
                        class="grid gap-4 rounded-[20px] border border-[#d9dee4] bg-[#f7f9fb] p-4 lg:grid-cols-[240px_1fr]"
                    >
                        <ProductVisual :product="item.product" compact />

                        <div class="flex flex-col justify-between gap-5">
                            <div>
                                <div class="flex flex-wrap items-start justify-between gap-3">
                                    <div>
                                        <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]">
                                            {{ item.product.category }}
                                        </p>
                                        <Link
                                            :href="route('products.show', item.product.slug)"
                                            class="mt-2 block text-[2.4rem] leading-[0.92] text-[#101317] transition hover:text-[#d61f26]"
                                        >
                                            {{ item.product.name }}
                                        </Link>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]">
                                            Total
                                        </p>
                                        <p class="mt-2 text-2xl font-semibold text-[#101317]">
                                            {{ formatPrice(item.line_total) }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 flex flex-wrap gap-2 text-sm font-semibold text-[#4c5968]">
                                    <span class="rounded-full bg-white px-3 py-1.5">
                                        Size {{ item.size }}
                                    </span>
                                    <span class="rounded-full bg-white px-3 py-1.5">
                                        {{ formatPrice(item.unit_price) }} each
                                    </span>
                                </div>
                            </div>

                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                <div class="inline-flex items-center rounded-[14px] border border-[#d9dee4] bg-white p-1">
                                    <button
                                        type="button"
                                        @click="updateQuantity(item.key, item.quantity - 1)"
                                        class="rounded-[10px] px-4 py-2 text-sm font-semibold text-[#101317] transition hover:bg-[#f3f5f7]"
                                    >
                                        −
                                    </button>
                                    <span class="min-w-12 text-center text-sm font-semibold text-[#101317]">
                                        {{ item.quantity }}
                                    </span>
                                    <button
                                        type="button"
                                        @click="updateQuantity(item.key, item.quantity + 1)"
                                        class="rounded-[10px] px-4 py-2 text-sm font-semibold text-[#101317] transition hover:bg-[#f3f5f7]"
                                    >
                                        +
                                    </button>
                                </div>

                                <button
                                    type="button"
                                    @click="removeItem(item.key)"
                                    class="rounded-[12px] border border-[#101317] px-4 py-2.5 text-sm font-semibold uppercase tracking-[0.12em] text-[#101317] transition hover:border-[#d61f26] hover:text-[#d61f26]"
                                >
                                    Remove
                                </button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <div class="space-y-6">
                <div class="retail-card rounded-[24px] p-6">
                    <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-[#6a7583]">
                        Summary
                    </p>
                    <div class="mt-5 space-y-4">
                        <div class="flex items-center justify-between text-sm text-[#4c5968]">
                            <span>Items</span>
                            <span>{{ cart.count }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm text-[#4c5968]">
                            <span>Shipping</span>
                            <span>Confirmed after review</span>
                        </div>
                        <div class="h-px bg-[#e1e6eb]"></div>
                        <div class="flex items-center justify-between text-lg font-semibold text-[#101317]">
                            <span>Subtotal</span>
                            <span>{{ formatPrice(cart.subtotal) }}</span>
                        </div>
                    </div>

                    <Link
                        :href="route('checkout.index')"
                        class="mt-6 inline-flex w-full items-center justify-center rounded-[14px] bg-[#d61f26] px-6 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-white transition hover:bg-[#b11218]"
                    >
                        Continue to checkout
                    </Link>

                    <p class="mt-4 text-sm leading-7 text-[#4c5968]">
                        Add final team names, logos, and custom notes during checkout.
                    </p>
                </div>

                <div class="retail-card overflow-hidden rounded-[24px]">
                    <div
                        class="border-b border-[#d9dee4]"
                        :class="cart.items[0]?.product?.image ? '' : 'bg-[linear-gradient(145deg,#101317_0%,#2b3138_44%,#d61f26_100%)] px-5 py-12 text-white'"
                    >
                        <img
                            v-if="cart.items[0]?.product?.image"
                            :src="cart.items[0].product.image"
                            alt="Cart banner"
                            class="h-full w-full object-cover"
                        />
                        <div v-else>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.24em] text-white/66">
                                Cart preview
                            </p>
                            <p class="mt-3 max-w-sm text-[2.4rem] leading-[0.92] text-white">
                                Add real apparel artwork here once the product files are uploaded.
                            </p>
                        </div>
                    </div>
                    <div class="p-5">
                        <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-[#d61f26]">
                            Need more items?
                        </p>
                        <h2 class="mt-2 text-3xl text-[#101317]">
                            Keep building the order
                        </h2>
                        <Link
                            :href="route('shop.index')"
                            class="mt-5 inline-flex items-center justify-center rounded-[14px] border border-[#101317] px-5 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-[#101317] transition hover:border-[#d61f26] hover:text-[#d61f26]"
                        >
                            Continue shopping
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <section
            v-else
            class="retail-card rounded-[24px] p-10 text-center"
        >
            <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-[#d61f26]">
                Your cart is empty
            </p>
            <h1 class="mt-4 text-[clamp(3rem,5vw,4.8rem)] leading-[0.92] text-[#101317]">
                Start with the collection page
            </h1>
            <p class="mx-auto mt-4 max-w-2xl text-base leading-7 text-[#4c5968]">
                Browse a collection, choose a style, and build the order from there.
            </p>
            <div class="mt-6">
                <Link
                    :href="route('shop.index')"
                    class="inline-flex items-center justify-center rounded-[14px] bg-[#101317] px-6 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-white transition hover:bg-[#d61f26]"
                >
                    Browse products
                </Link>
            </div>
        </section>

        <section v-if="recommendedProducts.length > 0" class="mt-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-[#6a7583]">
                        Recommended
                    </p>
                    <h2 class="mt-2 text-4xl text-[#101317]">
                        Add more styles before checkout
                    </h2>
                </div>
                <Link
                    :href="route('shop.index')"
                    class="text-sm font-semibold uppercase tracking-[0.12em] text-[#d61f26]"
                >
                    View all
                </Link>
            </div>

            <div class="mt-5 grid gap-5 lg:grid-cols-3">
                <ProductCard
                    v-for="product in recommendedProducts"
                    :key="product.id"
                    :product="product"
                />
            </div>
        </section>
    </StoreLayout>
</template>
