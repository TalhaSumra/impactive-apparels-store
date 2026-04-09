<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { formatPrice } from '@/lib/format';

const page = usePage();

const cartCount = computed(() => page.props.cart?.count ?? 0);
const cartSubtotal = computed(() => page.props.cart?.subtotal ?? 0);
const flashSuccess = computed(() => page.props.flash?.success ?? '');

const navigationLinks = [
    {
        href: route('home'),
        label: 'Home',
        current: () => route().current('home'),
    },
    {
        href: route('shop.index'),
        label: 'Shop',
        current: () => route().current('shop.index') || route().current('products.show'),
    },
    {
        href: route('shop.index', { sport: 'Basketball' }),
        label: 'Basketball',
        current: () => false,
    },
    {
        href: route('shop.index', { sport: 'Football' }),
        label: 'Football',
        current: () => false,
    },
    {
        href: route('shop.index', { category: 'Hoodies & Streetwear' }),
        label: 'Apparel',
        current: () => false,
    },
];

const utilityLinks = [
    {
        href: route('home') + '#process',
        label: 'How to order',
    },
    {
        href: route('home') + '#faq',
        label: 'FAQ',
    },
    {
        href: route('checkout.index'),
        label: 'Quick order',
    },
];
</script>

<template>
    <div class="min-h-screen bg-[#f4f5f7] text-[#101317] retail-grid">
        <div class="bg-[#101317] text-white">
            <div class="mx-auto flex max-w-[1400px] flex-col gap-3 px-4 py-3 text-[13px] sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
                <div class="flex flex-wrap items-center gap-4">
                    <span class="font-semibold uppercase tracking-[0.14em] text-white/86">Custom sports apparel</span>
                    <span class="text-white/56">Built for teams, schools, academies, and merch drops.</span>
                </div>
                <div class="flex flex-wrap items-center gap-4">
                    <Link
                        v-for="item in utilityLinks"
                        :key="item.label"
                        :href="item.href"
                        class="text-white/76 transition hover:text-white"
                    >
                        {{ item.label }}
                    </Link>
                </div>
            </div>
        </div>

        <div class="border-b border-[#d9dee4] bg-[#d61f26] text-white">
            <div class="mx-auto flex max-w-[1400px] flex-col gap-2 px-4 py-3 text-[13px] font-semibold uppercase tracking-[0.16em] sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
                <span>Clean ordering flow for custom uniforms and apparel.</span>
                <span class="text-white/88">Add products to cart, then send your team notes at checkout.</span>
            </div>
        </div>

        <header class="border-b border-[#d9dee4] bg-white">
            <div class="mx-auto max-w-[1400px] px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-5 py-5">
                    <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                        <div class="flex items-center gap-4">
                            <Link :href="route('home')" class="flex items-center gap-3">
                                <span
                                    class="flex size-12 items-center justify-center bg-[#101317] text-sm font-semibold uppercase tracking-[0.26em] text-white"
                                >
                                    IA
                                </span>
                                <div>
                                    <p class="heading-font text-[0.95rem] uppercase tracking-[0.3em] text-[#d61f26]">
                                        Impactive
                                    </p>
                                    <p class="text-lg font-semibold uppercase tracking-[0.08em] text-[#101317]">
                                        Apparels
                                    </p>
                                </div>
                            </Link>

                            <div class="hidden border-l border-[#d9dee4] pl-4 text-sm text-[#4c5968] lg:block">
                                Custom uniforms, fanwear, and order-ready apparel.
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center gap-3">
                            <Link
                                :href="route('checkout.index')"
                                class="inline-flex items-center justify-center rounded-[12px] border border-[#101317] px-4 py-2.5 text-sm font-semibold uppercase tracking-[0.12em] text-[#101317] transition hover:border-[#d61f26] hover:text-[#d61f26]"
                            >
                                Order
                            </Link>
                            <Link
                                :href="route('cart.index')"
                                class="inline-flex items-center gap-3 rounded-[12px] bg-[#101317] px-4 py-2.5 text-sm font-semibold uppercase tracking-[0.12em] text-white transition hover:bg-[#d61f26]"
                            >
                                <span>Cart</span>
                                <span>{{ cartCount }}</span>
                                <span class="hidden text-white/70 sm:inline">{{ formatPrice(cartSubtotal) }}</span>
                            </Link>
                        </div>
                    </div>

                    <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                        <nav class="flex flex-wrap items-center gap-4 text-sm font-semibold uppercase tracking-[0.12em] text-[#101317]">
                            <Link
                                v-for="item in navigationLinks"
                                :key="item.label"
                                :href="item.href"
                                class="transition hover:text-[#d61f26]"
                                :class="item.current() ? 'text-[#d61f26]' : ''"
                            >
                                {{ item.label }}
                            </Link>
                        </nav>

                        <div class="flex flex-wrap items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.18em] text-[#6a7583]">
                            <span class="rounded-full bg-[#f3f5f7] px-3 py-1.5">Basketball</span>
                            <span class="rounded-full bg-[#f3f5f7] px-3 py-1.5">Football</span>
                            <span class="rounded-full bg-[#f3f5f7] px-3 py-1.5">Soccer</span>
                            <span class="rounded-full bg-[#f3f5f7] px-3 py-1.5">Hoodies</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="mx-auto max-w-[1400px] px-4 py-6 sm:px-6 lg:px-8">
            <div
                v-if="flashSuccess"
                class="mb-6 rounded-[16px] border border-[#f2c1c3] bg-[#fff5f5] px-5 py-4 text-sm font-medium text-[#b11218]"
            >
                {{ flashSuccess }}
            </div>

            <main class="pb-12">
                <slot />
            </main>

            <footer class="retail-card rounded-[20px] p-6">
                <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr_0.8fr_0.9fr]">
                    <div>
                        <p class="heading-font text-2xl uppercase text-[#101317]">
                            Impactive Apparels
                        </p>
                        <p class="mt-3 max-w-md text-sm leading-7 text-[#4c5968]">
                            Retail-style storefront for custom sportswear, team uniforms, and direct online ordering.
                        </p>
                    </div>

                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]">
                            Shop
                        </p>
                        <div class="mt-3 grid gap-2 text-sm text-[#101317]">
                            <Link :href="route('shop.index')" class="transition hover:text-[#d61f26]">All products</Link>
                            <Link :href="route('shop.index', { sport: 'Basketball' })" class="transition hover:text-[#d61f26]">Basketball</Link>
                            <Link :href="route('shop.index', { sport: 'Football' })" class="transition hover:text-[#d61f26]">Football</Link>
                        </div>
                    </div>

                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]">
                            Order
                        </p>
                        <div class="mt-3 grid gap-2 text-sm text-[#101317]">
                            <Link :href="route('cart.index')" class="transition hover:text-[#d61f26]">Cart</Link>
                            <Link :href="route('checkout.index')" class="transition hover:text-[#d61f26]">Checkout</Link>
                            <Link :href="route('home') + '#faq'" class="transition hover:text-[#d61f26]">FAQ</Link>
                        </div>
                    </div>

                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]">
                            Fast action
                        </p>
                        <div class="mt-3 flex flex-col gap-3">
                            <Link
                                :href="route('shop.index')"
                                class="inline-flex items-center justify-center rounded-[12px] bg-[#101317] px-4 py-2.5 text-sm font-semibold uppercase tracking-[0.12em] text-white transition hover:bg-[#d61f26]"
                            >
                                Shop now
                            </Link>
                            <Link
                                :href="route('checkout.index')"
                                class="inline-flex items-center justify-center rounded-[12px] border border-[#101317] px-4 py-2.5 text-sm font-semibold uppercase tracking-[0.12em] text-[#101317] transition hover:border-[#d61f26] hover:text-[#d61f26]"
                            >
                                Quick order
                            </Link>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>
