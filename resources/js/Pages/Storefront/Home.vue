<script setup>
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import ProductCard from '@/Components/ProductCard.vue';
import StoreHeroSlider from '@/Components/StoreHeroSlider.vue';
import StoreLayout from '@/Layouts/StoreLayout.vue';
import { formatPrice } from '@/lib/format';

const props = defineProps({
    collections: {
        type: Array,
        required: true,
    },
    featuredProducts: {
        type: Array,
        required: true,
    },
    latestProducts: {
        type: Array,
        required: true,
    },
});

const orderHighlights = [
    'Retail-style product browsing',
    'Cart and checkout already live',
    'Custom team notes on every order',
];

const faqItems = [
    {
        question: 'Can customers place team orders online?',
        answer: 'Yes. They can browse products, add kits to cart, and submit the order through checkout.',
    },
    {
        question: 'Can I collect names, logos, and sponsor notes?',
        answer: 'Yes. Checkout includes order notes so custom production details stay attached to the order.',
    },
    {
        question: 'Can the store grow later?',
        answer: 'Yes. This structure already supports more products, payment upgrades, and deeper catalog pages.',
    },
];

const heroSlides = computed(() => props.featuredProducts.slice(0, 3));

const merchandisingBanners = computed(() => {
    const latestSpotlight = props.latestProducts.find((product) => product.image) ?? props.latestProducts[0] ?? null;
    const customSpotlight = props.featuredProducts.find((product) => product.slug === 'patriot-custom-hoodie') ?? props.featuredProducts.find((product) => product.image) ?? props.featuredProducts[0] ?? null;

    return [
        {
            image: latestSpotlight?.image ?? null,
            label: 'Trending now',
            title: latestSpotlight?.name ?? 'New custom drops',
            href: latestSpotlight ? route('products.show', latestSpotlight.slug) : route('shop.index'),
        },
        {
            image: customSpotlight?.image ?? null,
            label: 'Quick order',
            title: 'Submit sizes and notes fast',
            href: route('checkout.index'),
        },
    ];
});

const featuredCollections = computed(() => props.collections.slice(0, 5));
const featuredGridProducts = computed(() => props.featuredProducts.slice(0, 6));
const latestGridProducts = computed(() => props.latestProducts.slice(0, 4));
</script>

<template>
    <Head title="Impactive Apparels Store" />

    <StoreLayout>
        <section class="grid gap-6 xl:grid-cols-[0.76fr_1.24fr]">
            <div class="retail-card rounded-[24px] p-6 xl:p-8">
                <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-[#d61f26]">
                    Shop team apparel
                </p>
                <h1 class="mt-5 max-w-lg text-[clamp(3.4rem,6vw,6rem)] leading-[0.88] text-[#101317]">
                    Custom uniforms and fanwear.
                </h1>
                <p class="mt-4 max-w-xl text-base leading-7 text-[#4c5968]">
                    A cleaner retail-style storefront built to move buyers from collection pages into cart and checkout faster.
                </p>

                <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                    <Link
                        :href="route('shop.index')"
                        class="inline-flex items-center justify-center rounded-[14px] bg-[#d61f26] px-6 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-white transition hover:bg-[#b11218]"
                    >
                        Shop collection
                    </Link>
                    <Link
                        :href="route('checkout.index')"
                        class="inline-flex items-center justify-center rounded-[14px] border border-[#101317] px-6 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-[#101317] transition hover:border-[#d61f26] hover:text-[#d61f26]"
                    >
                        Quick order
                    </Link>
                </div>

                <div class="mt-8 grid gap-4 sm:grid-cols-3">
                    <div
                        v-for="item in orderHighlights"
                        :key="item"
                        class="rounded-[18px] bg-[#f7f9fb] px-4 py-4 text-sm font-medium leading-6 text-[#4c5968]"
                    >
                        {{ item }}
                    </div>
                </div>

                <div class="mt-8 border-t border-[#e1e6eb] pt-6">
                    <div class="flex flex-wrap items-center gap-2">
                        <Link
                            :href="route('shop.index', { sport: 'Basketball' })"
                            class="rounded-full bg-[#f3f5f7] px-4 py-2 text-[11px] font-semibold uppercase tracking-[0.18em] text-[#4c5968] transition hover:bg-[#101317] hover:text-white"
                        >
                            Basketball
                        </Link>
                        <Link
                            :href="route('shop.index', { sport: 'Football' })"
                            class="rounded-full bg-[#f3f5f7] px-4 py-2 text-[11px] font-semibold uppercase tracking-[0.18em] text-[#4c5968] transition hover:bg-[#101317] hover:text-white"
                        >
                            Football
                        </Link>
                        <Link
                            :href="route('shop.index', { sport: 'Soccer' })"
                            class="rounded-full bg-[#f3f5f7] px-4 py-2 text-[11px] font-semibold uppercase tracking-[0.18em] text-[#4c5968] transition hover:bg-[#101317] hover:text-white"
                        >
                            Soccer
                        </Link>
                        <Link
                            :href="route('shop.index', { category: 'Hoodies & Streetwear' })"
                            class="rounded-full bg-[#f3f5f7] px-4 py-2 text-[11px] font-semibold uppercase tracking-[0.18em] text-[#4c5968] transition hover:bg-[#101317] hover:text-white"
                        >
                            Apparel
                        </Link>
                    </div>
                </div>
            </div>

            <StoreHeroSlider :slides="heroSlides" />
        </section>

        <section class="mt-6 grid gap-6 lg:grid-cols-[1.16fr_0.84fr]">
            <div class="retail-card rounded-[24px] p-5">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-[#6a7583]">
                            Featured collections
                        </p>
                        <h2 class="mt-2 text-4xl text-[#101317]">
                            Browse by category
                        </h2>
                    </div>
                    <Link
                        :href="route('shop.index')"
                        class="text-sm font-semibold uppercase tracking-[0.12em] text-[#d61f26]"
                    >
                        View all
                    </Link>
                </div>

                <div class="mt-5 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                    <Link
                        v-for="collection in featuredCollections"
                        :key="collection.category"
                        :href="route('shop.index', { category: collection.category })"
                        class="group overflow-hidden rounded-[18px] border border-[#d9dee4] bg-[#f7f9fb] transition hover:border-[#101317]"
                    >
                        <div
                            class="h-2 w-full"
                            :style="{ background: `linear-gradient(90deg, ${collection.accent} 0%, ${collection.secondary_accent} 100%)` }"
                        ></div>
                        <div class="p-4">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-[#6a7583]">
                                {{ collection.count }} products
                            </p>
                            <h3 class="mt-2 text-[2rem] leading-[0.95] text-[#101317]">
                                {{ collection.category }}
                            </h3>
                            <div class="mt-4 flex items-center justify-between text-sm font-semibold">
                                <span>From {{ formatPrice(collection.starting_price) }}</span>
                                <span class="text-[#d61f26]">Shop</span>
                            </div>
                        </div>
                    </Link>
                </div>
            </div>

            <div class="grid gap-6">
                <Link
                    v-for="banner in merchandisingBanners"
                    :key="banner.title"
                    :href="banner.href"
                    class="retail-card group overflow-hidden rounded-[24px] transition hover:-translate-y-1"
                >
                    <div
                        class="aspect-[5/3] overflow-hidden border-b border-[#d9dee4]"
                        :class="banner.image ? '' : 'bg-[linear-gradient(145deg,#101317_0%,#2b3138_42%,#d61f26_100%)]'"
                    >
                        <img
                            v-if="banner.image"
                            :src="banner.image"
                            :alt="banner.title"
                            class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.02]"
                        />
                        <div v-else class="flex h-full flex-col justify-end p-5 text-white">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.24em] text-white/66">
                                {{ banner.label }}
                            </p>
                            <h3 class="mt-3 text-[2.6rem] leading-[0.92]">
                                {{ banner.title }}
                            </h3>
                        </div>
                    </div>
                    <div class="p-5">
                        <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-[#d61f26]">
                            {{ banner.label }}
                        </p>
                        <h3 class="mt-2 text-3xl text-[#101317]">
                            {{ banner.title }}
                        </h3>
                    </div>
                </Link>
            </div>
        </section>

        <section class="mt-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-[#6a7583]">
                        Best sellers
                    </p>
                    <h2 class="mt-2 text-4xl text-[#101317]">
                        Top custom styles
                    </h2>
                </div>
                <Link
                    :href="route('shop.index')"
                    class="text-sm font-semibold uppercase tracking-[0.12em] text-[#d61f26]"
                >
                    Shop all
                </Link>
            </div>

            <div class="mt-5 grid gap-5 lg:grid-cols-2 xl:grid-cols-3">
                <ProductCard
                    v-for="product in featuredGridProducts"
                    :key="product.id"
                    :product="product"
                />
            </div>
        </section>

        <section id="process" class="mt-8 grid gap-6 lg:grid-cols-[0.86fr_1.14fr]">
            <div class="retail-card rounded-[24px] overflow-hidden">
                <div class="border-b border-[#d9dee4] bg-[#101317] px-6 py-5 text-white">
                    <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-white/70">
                        How to order
                    </p>
                    <h2 class="mt-2 text-4xl">
                        Built for quicker checkout
                    </h2>
                </div>
                <div class="grid gap-0 divide-y divide-[#e1e6eb]">
                    <div class="px-6 py-4">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-[#d61f26]">01</p>
                        <h3 class="mt-2 text-2xl text-[#101317]">Open a product</h3>
                    </div>
                    <div class="px-6 py-4">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-[#d61f26]">02</p>
                        <h3 class="mt-2 text-2xl text-[#101317]">Add to cart</h3>
                    </div>
                    <div class="px-6 py-4">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-[#d61f26]">03</p>
                        <h3 class="mt-2 text-2xl text-[#101317]">Send your notes</h3>
                    </div>
                </div>
            </div>

            <div class="retail-card rounded-[24px] overflow-hidden">
                <div class="grid gap-0 lg:grid-cols-[0.92fr_1.08fr]">
                    <div class="border-b border-[#d9dee4] bg-[#d61f26] p-6 text-white lg:border-b-0 lg:border-r">
                        <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-white/74">
                            Quick order
                        </p>
                        <h2 class="mt-2 text-4xl leading-[0.94]">
                            Cart to checkout with less friction.
                        </h2>
                        <div class="mt-5 flex flex-col gap-3 sm:flex-row">
                            <Link
                                :href="route('shop.index')"
                                class="inline-flex items-center justify-center rounded-[14px] bg-white px-5 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-[#101317] transition hover:bg-[#f3f5f7]"
                            >
                                Shop now
                            </Link>
                            <Link
                                :href="route('checkout.index')"
                                class="inline-flex items-center justify-center rounded-[14px] border border-white px-5 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-white transition hover:bg-white hover:text-[#101317]"
                            >
                                Checkout
                            </Link>
                        </div>
                    </div>

                    <div class="grid gap-4 p-4 md:grid-cols-2">
                        <ProductCard
                            v-for="product in latestGridProducts"
                            :key="product.id"
                            compact
                            :product="product"
                        />
                    </div>
                </div>
            </div>
        </section>

        <section id="faq" class="mt-8 retail-card rounded-[24px] p-6">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-[#6a7583]">
                        FAQ
                    </p>
                    <h2 class="mt-2 text-4xl text-[#101317]">
                        Ordering answers
                    </h2>
                </div>
                <Link
                    :href="route('checkout.index')"
                    class="text-sm font-semibold uppercase tracking-[0.12em] text-[#d61f26]"
                >
                    Start order
                </Link>
            </div>

            <div class="mt-5 grid gap-4 lg:grid-cols-3">
                <details
                    v-for="item in faqItems"
                    :key="item.question"
                    class="rounded-[18px] border border-[#d9dee4] bg-[#f7f9fb] p-5"
                >
                    <summary class="cursor-pointer list-none text-lg font-semibold text-[#101317]">
                        {{ item.question }}
                    </summary>
                    <p class="mt-3 text-sm leading-7 text-[#4c5968]">
                        {{ item.answer }}
                    </p>
                </details>
            </div>
        </section>
    </StoreLayout>
</template>
