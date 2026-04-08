<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { formatPrice } from '@/lib/format';

const page = usePage();

const cartCount = computed(() => page.props.cart?.count ?? 0);
const cartSubtotal = computed(() => page.props.cart?.subtotal ?? 0);
const flashSuccess = computed(() => page.props.flash?.success ?? '');

const teamUniformSports = [
    'Basketball',
    'Football',
    'Baseball',
    'Soccer',
    'Volleyball',
    'Cricket',
    'Track',
    'Cheerleading',
];

const customCollections = [
    {
        category: 'Basketball Uniforms',
        label: 'Basketball Sets',
    },
    {
        category: 'Football Uniforms',
        label: 'Football Packages',
    },
    {
        category: 'Soccer Uniforms',
        label: 'Soccer Kits',
    },
    {
        category: 'Baseball Uniforms',
        label: 'Baseball Uniforms',
    },
    {
        category: 'Training Sets',
        label: 'Training Sets',
    },
    {
        category: 'Hoodies & Streetwear',
        label: 'Hoodies & Fanwear',
    },
];

const quickLinks = [
    {
        hash: '#pricing',
        label: 'Pricing',
    },
    {
        hash: '#process',
        label: 'How It Works',
    },
    {
        hash: '#faq',
        label: 'FAQ',
    },
];
</script>

<template>
    <div class="min-h-screen bg-[#f8f3ee] text-[#1e140f]">
        <div class="bg-[#1b120d] text-[#f7efe6]">
            <div class="mx-auto flex max-w-[1380px] flex-col gap-3 px-4 py-3 text-sm sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
                <div class="flex flex-wrap items-center gap-x-5 gap-y-2">
                    <span>Custom sportswear manufacturing for clubs, schools, and academies.</span>
                    <span class="text-white/55">2-3 week production on most standard orders.</span>
                </div>
                <div class="flex flex-wrap items-center gap-3 font-semibold">
                    <Link
                        :href="route('shop.index')"
                        class="rounded-full border border-white/10 px-4 py-2 transition hover:border-white/20 hover:bg-white/5"
                    >
                        View Pricing
                    </Link>
                    <Link
                        :href="route('shop.index')"
                        class="rounded-full bg-[#ad5a34] px-4 py-2 text-white transition hover:bg-[#8d4829]"
                    >
                        Start Custom Order
                    </Link>
                </div>
            </div>
        </div>

        <div class="mx-auto max-w-[1380px] px-4 py-4 sm:px-6 lg:px-8">
            <header
                class="sticky top-4 z-30 rounded-[34px] border border-[#2c1c14]/10 bg-white/85 px-5 py-4 shadow-[0_24px_80px_rgba(53,33,23,0.08)] backdrop-blur-xl"
            >
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                        <div class="flex items-center gap-4">
                            <Link :href="route('home')" class="flex items-center gap-3">
                                <span
                                    class="flex size-12 items-center justify-center rounded-full bg-[#1e140f] text-sm font-semibold tracking-[0.28em] text-[#f7efe6]"
                                >
                                    IA
                                </span>
                                <div>
                                    <p
                                        class="heading-font text-sm uppercase tracking-[0.34em] text-[#7b4a34]"
                                    >
                                        Impactive
                                    </p>
                                    <p class="text-base font-semibold text-[#1e140f]">
                                        Apparels
                                    </p>
                                </div>
                            </Link>
                            <div class="hidden text-sm text-[#5e483b] lg:block">
                                Public storefront for custom team uniforms,
                                custom apparel, and direct order checkout.
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center gap-3 text-sm font-semibold text-[#4d392d]">
                            <Link
                                :href="route('home')"
                                class="rounded-full px-4 py-2 transition hover:bg-[#f5ece3] hover:text-[#ad5a34]"
                                :class="route().current('home') ? 'bg-[#f5ece3] text-[#ad5a34]' : ''"
                            >
                                Home
                            </Link>
                            <Link
                                :href="route('shop.index')"
                                class="rounded-full px-4 py-2 transition hover:bg-[#f5ece3] hover:text-[#ad5a34]"
                                :class="route().current('shop.index') || route().current('products.show') ? 'bg-[#f5ece3] text-[#ad5a34]' : ''"
                            >
                                Shop
                            </Link>
                            <Link
                                :href="route('checkout.index')"
                                class="rounded-full px-4 py-2 transition hover:bg-[#f5ece3] hover:text-[#ad5a34]"
                                :class="route().current('checkout.index') || route().current('checkout.success') ? 'bg-[#f5ece3] text-[#ad5a34]' : ''"
                            >
                                Quote / Checkout
                            </Link>
                            <Link
                                :href="route('cart.index')"
                                class="inline-flex items-center gap-3 rounded-full bg-[#1e140f] px-4 py-2 text-[#f7efe6] transition hover:-translate-y-0.5 hover:bg-[#ad5a34]"
                            >
                                <span>Cart</span>
                                <span
                                    class="rounded-full bg-white/15 px-2 py-1 text-xs font-bold tracking-[0.18em]"
                                >
                                    {{ cartCount }}
                                </span>
                                <span class="hidden text-xs text-white/72 sm:inline">
                                    {{ formatPrice(cartSubtotal) }}
                                </span>
                            </Link>
                        </div>
                    </div>

                    <div class="hidden items-center gap-4 xl:flex">
                        <div class="group relative">
                            <button
                                type="button"
                                class="rounded-full px-4 py-2 text-sm font-semibold text-[#4d392d] transition hover:bg-[#f5ece3] hover:text-[#ad5a34]"
                            >
                                Team Uniforms
                            </button>
                            <div
                                class="invisible absolute left-0 top-[calc(100%+12px)] z-30 w-[560px] rounded-[30px] border border-[#2c1c14]/10 bg-white p-5 opacity-0 shadow-[0_24px_80px_rgba(53,33,23,0.14)] transition group-hover:visible group-hover:opacity-100"
                            >
                                <p class="text-xs uppercase tracking-[0.28em] text-[#8a563c]">
                                    Shop by sport
                                </p>
                                <div class="mt-4 grid gap-3 sm:grid-cols-2">
                                    <Link
                                        v-for="sport in teamUniformSports"
                                        :key="sport"
                                        :href="route('shop.index', { sport })"
                                        class="rounded-[22px] border border-[#1e140f]/8 bg-[#fcf7f1] px-4 py-4 text-sm font-semibold text-[#1e140f] transition hover:border-[#ad5a34]/30 hover:text-[#ad5a34]"
                                    >
                                        {{ sport }}
                                    </Link>
                                </div>
                            </div>
                        </div>

                        <div class="group relative">
                            <button
                                type="button"
                                class="rounded-full px-4 py-2 text-sm font-semibold text-[#4d392d] transition hover:bg-[#f5ece3] hover:text-[#ad5a34]"
                            >
                                Custom Apparel
                            </button>
                            <div
                                class="invisible absolute left-0 top-[calc(100%+12px)] z-30 w-[520px] rounded-[30px] border border-[#2c1c14]/10 bg-white p-5 opacity-0 shadow-[0_24px_80px_rgba(53,33,23,0.14)] transition group-hover:visible group-hover:opacity-100"
                            >
                                <p class="text-xs uppercase tracking-[0.28em] text-[#8a563c]">
                                    Collections
                                </p>
                                <div class="mt-4 grid gap-3 sm:grid-cols-2">
                                    <Link
                                        v-for="item in customCollections"
                                        :key="item.category"
                                        :href="route('shop.index', { category: item.category })"
                                        class="rounded-[22px] border border-[#1e140f]/8 bg-[#fcf7f1] px-4 py-4 text-sm font-semibold text-[#1e140f] transition hover:border-[#ad5a34]/30 hover:text-[#ad5a34]"
                                    >
                                        {{ item.label }}
                                    </Link>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <Link
                                v-for="item in quickLinks"
                                :key="item.label"
                                :href="route('home') + item.hash"
                                class="rounded-full px-4 py-2 text-sm font-semibold text-[#4d392d] transition hover:bg-[#f5ece3] hover:text-[#ad5a34]"
                            >
                                {{ item.label }}
                            </Link>
                        </div>

                        <div class="ml-auto text-sm font-semibold text-[#8a563c]">
                            Need help with a full team order? Start in the shop and submit the request online.
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-2 xl:hidden">
                        <Link
                            v-for="sport in teamUniformSports.slice(0, 6)"
                            :key="sport"
                            :href="route('shop.index', { sport })"
                            class="rounded-full border border-[#1e140f]/10 bg-[#fcf7f1] px-3 py-2 text-xs font-semibold uppercase tracking-[0.2em] text-[#6a5346] transition hover:border-[#ad5a34]/30 hover:text-[#ad5a34]"
                        >
                            {{ sport }}
                        </Link>
                    </div>
                </div>
            </header>

            <div
                v-if="flashSuccess"
                class="mt-4 rounded-[28px] border border-[#9e623c]/20 bg-[#fff6ed] px-5 py-4 text-sm font-medium text-[#7a4d34]"
            >
                {{ flashSuccess }}
            </div>

            <main class="pb-12 pt-6">
                <slot />
            </main>

            <footer
                class="rounded-[32px] border border-[#2c1c14]/10 bg-white/70 px-5 py-6 text-sm text-[#5e483b] backdrop-blur-xl"
            >
                <div class="grid gap-6 lg:grid-cols-[1.1fr_0.7fr_0.7fr_0.9fr]">
                    <div>
                        <p class="font-semibold text-[#1e140f]">
                            Impactive Apparels
                        </p>
                        <p class="mt-3 max-w-md leading-7">
                            Inspired by large custom teamwear storefronts, but
                            built specifically for your sportswear brand and
                            direct public ordering workflow.
                        </p>
                    </div>

                    <div>
                        <p class="text-xs uppercase tracking-[0.28em] text-[#8a563c]">
                            Shop
                        </p>
                        <div class="mt-3 grid gap-2">
                            <Link
                                :href="route('shop.index')"
                                class="transition hover:text-[#ad5a34]"
                            >
                                All Products
                            </Link>
                            <Link
                                :href="route('shop.index', { sport: 'Basketball' })"
                                class="transition hover:text-[#ad5a34]"
                            >
                                Basketball
                            </Link>
                            <Link
                                :href="route('shop.index', { sport: 'Football' })"
                                class="transition hover:text-[#ad5a34]"
                            >
                                Football
                            </Link>
                            <Link
                                :href="route('shop.index', { category: 'Hoodies & Streetwear' })"
                                class="transition hover:text-[#ad5a34]"
                            >
                                Hoodies
                            </Link>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs uppercase tracking-[0.28em] text-[#8a563c]">
                            Ordering
                        </p>
                        <div class="mt-3 grid gap-2">
                            <Link
                                :href="route('cart.index')"
                                class="transition hover:text-[#ad5a34]"
                            >
                                Cart
                            </Link>
                            <Link
                                :href="route('checkout.index')"
                                class="transition hover:text-[#ad5a34]"
                            >
                                Checkout
                            </Link>
                            <Link
                                :href="route('home') + '#process'"
                                class="transition hover:text-[#ad5a34]"
                            >
                                How It Works
                            </Link>
                            <Link
                                :href="route('home') + '#faq'"
                                class="transition hover:text-[#ad5a34]"
                            >
                                FAQ
                            </Link>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs uppercase tracking-[0.28em] text-[#8a563c]">
                            Fast Access
                        </p>
                        <div class="mt-3 flex flex-col gap-3">
                            <Link
                                :href="route('shop.index')"
                                class="rounded-full border border-[#1e140f]/10 px-4 py-2 text-center font-semibold transition hover:border-[#ad5a34]/30 hover:text-[#ad5a34]"
                            >
                                Browse Catalog
                            </Link>
                            <Link
                                :href="route('shop.index')"
                                class="rounded-full bg-[#1e140f] px-4 py-2 text-center font-semibold text-[#f7efe6] transition hover:bg-[#ad5a34]"
                            >
                                Start Custom Order
                            </Link>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>
