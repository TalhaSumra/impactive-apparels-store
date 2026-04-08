<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ProductCard from '@/Components/ProductCard.vue';
import StoreLayout from '@/Layouts/StoreLayout.vue';
import { formatPrice } from '@/lib/format';

defineProps({
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

const sportHighlights = [
    {
        accent: '#ce4037',
        note: 'Custom match uniforms, fanwear, and team bundles.',
        sport: 'Basketball',
    },
    {
        accent: '#4bc0d4',
        note: 'Full game-day packages with layered accessories.',
        sport: 'Football',
    },
    {
        accent: '#f4f3ef',
        note: 'Professional kits for clubs, leagues, and academy rosters.',
        sport: 'Baseball',
    },
    {
        accent: '#ce4037',
        note: 'Custom kits with names, numbers, and sponsor zones.',
        sport: 'Soccer',
    },
    {
        accent: '#d7ce2e',
        note: 'Training and performance sets for camps and teams.',
        sport: 'Training',
    },
    {
        accent: '#243e87',
        note: 'Streetwear and supporter gear with all-over graphics.',
        sport: 'Streetwear',
    },
];

const proofPills = [
    'Fully custom designs',
    'Public checkout flow',
    'Bulk team ordering',
    'Stored order management',
    'Sportswear manufacturing',
    'Brand-led presentation',
];

const servicePromises = [
    {
        title: 'Custom uniforms for every program',
        copy: 'Basketball, football, soccer, baseball, hoodies, and broader performance teamwear can all live in one public storefront.',
    },
    {
        title: 'Pricing and product structure customers understand',
        copy: 'The homepage pushes category-led discovery and clear entry pricing so shoppers know where to start immediately.',
    },
    {
        title: 'Order online, then move into production',
        copy: 'Visitors can add products to cart and submit a structured order request instead of sending everything through social DMs.',
    },
];

const faqItems = [
    {
        question: 'Can teams order directly from the website now?',
        answer: 'Yes. The storefront now supports catalog browsing, cart management, checkout, and order submission stored in the Laravel database.',
    },
    {
        question: 'How do customers request player names, logos, and sponsor placement?',
        answer: 'Each order can include notes during checkout so production details stay attached to the order record.',
    },
    {
        question: 'Can this expand into a bigger ecommerce system later?',
        answer: 'Yes. This foundation is ready for payment gateways, admin order management, customer accounts, and more product depth.',
    },
    {
        question: 'Why does the site feel closer to Wooter now?',
        answer: 'The structure now leans into a multi-category sportswear storefront with stronger navigation, merchandising, and repeated sales CTAs.',
    },
];

const processSteps = [
    {
        id: '01',
        title: 'Browse by sport or collection',
        copy: 'Customers land on category-heavy navigation similar to major teamwear stores, then jump directly into the right product set.',
    },
    {
        id: '02',
        title: 'Build the order online',
        copy: 'Product pages let buyers choose sizes and quantities before saving everything into a real cart.',
    },
    {
        id: '03',
        title: 'Submit production notes',
        copy: 'Checkout captures team name, shipping details, payment method, and custom instructions so the order is complete enough to process.',
    },
];

function collectionStyle(collection) {
    return {
        background: `linear-gradient(135deg, ${collection.secondary_accent} 0%, ${collection.accent} 100%)`,
    };
}
</script>

<template>
    <Head title="Impactive Apparels Store" />

    <StoreLayout>
        <section class="grid gap-6 xl:grid-cols-[1.06fr_0.94fr]">
            <div
                class="relative overflow-hidden rounded-[42px] border border-white/60 bg-white/75 p-6 shadow-[0_28px_100px_rgba(53,33,23,0.1)] backdrop-blur-xl sm:p-8 lg:p-10"
            >
                <div
                    class="absolute right-0 top-0 h-56 w-56 rounded-full bg-[#e7b995]/45 blur-3xl"
                ></div>
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-[#1e140f]/10 bg-[#fff8f1] px-4 py-2 text-xs font-semibold uppercase tracking-[0.32em] text-[#8a563c]"
                >
                    Custom Team Uniforms & Apparel
                </div>
                <h1
                    class="mt-6 max-w-4xl text-[clamp(3.2rem,8vw,6.8rem)] leading-[0.9] text-[#1e140f]"
                >
                    The storefront your sportswear brand actually needs.
                </h1>
                <p
                    class="mt-6 max-w-3xl text-base leading-8 text-[#5f483b] sm:text-lg"
                >
                    Inspired by the structure of leading teamwear platforms,
                    this homepage now pushes category discovery, public ordering,
                    and quote-style conversion instead of acting like a simple
                    Instagram landing page.
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                    <Link
                        :href="route('shop.index')"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-[#ad5a34] px-6 py-3 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-[#8d4829]"
                    >
                        Start Custom Order
                        <span aria-hidden="true">→</span>
                    </Link>
                    <Link
                        :href="route('home') + '#pricing'"
                        class="inline-flex items-center justify-center gap-2 rounded-full border border-[#1e140f]/10 bg-white/80 px-6 py-3 text-sm font-semibold text-[#1e140f] transition hover:-translate-y-0.5 hover:border-[#ad5a34]/30 hover:text-[#ad5a34]"
                    >
                        View Pricing Collections
                    </Link>
                    <Link
                        :href="route('checkout.index')"
                        class="inline-flex items-center justify-center gap-2 rounded-full border border-[#1e140f]/10 bg-[#f6eee5] px-6 py-3 text-sm font-semibold text-[#1e140f] transition hover:-translate-y-0.5 hover:border-[#ad5a34]/30 hover:text-[#ad5a34]"
                    >
                        Go to Checkout
                    </Link>
                </div>

                <div class="mt-10 flex flex-wrap gap-2">
                    <span
                        v-for="pill in proofPills"
                        :key="pill"
                        class="rounded-full border border-[#1e140f]/10 bg-[#fcf7f1] px-4 py-2 text-xs font-semibold uppercase tracking-[0.22em] text-[#6a5346]"
                    >
                        {{ pill }}
                    </span>
                </div>
            </div>

            <div class="grid gap-6">
                <div
                    class="rounded-[42px] bg-[#1a120e] p-6 text-[#f7efe6] shadow-[0_30px_120px_rgba(26,18,14,0.28)] sm:p-8"
                >
                    <p
                        class="text-xs uppercase tracking-[0.34em] text-[#d9b392]"
                    >
                        Built Around Your Brand
                    </p>
                    <h2
                        class="mt-4 max-w-lg text-4xl leading-tight sm:text-5xl"
                    >
                        Category-heavy, sales-first, and ready for team orders.
                    </h2>
                    <p
                        class="mt-5 max-w-xl text-base leading-8 text-[#f7efe6]/74"
                    >
                        Wooter’s structure works because it makes visitors pick
                        a sport, a collection, or a quote path immediately. Your
                        store now follows that same logic while staying focused
                        on Impactive Apparels.
                    </p>
                    <div class="mt-8 grid gap-4 sm:grid-cols-2">
                        <div
                            class="rounded-[28px] border border-white/10 bg-white/5 p-5"
                        >
                            <p
                                class="text-xs uppercase tracking-[0.28em] text-[#d9b392]"
                            >
                                Ecommerce flow
                            </p>
                            <p class="mt-3 text-sm leading-7 text-white/74">
                                Visitors can browse, add to cart, and submit an
                                order through the site itself.
                            </p>
                        </div>
                        <div
                            class="rounded-[28px] border border-white/10 bg-white/5 p-5"
                        >
                            <p
                                class="text-xs uppercase tracking-[0.28em] text-[#d9b392]"
                            >
                                Quote mentality
                            </p>
                            <p class="mt-3 text-sm leading-7 text-white/74">
                                The experience still supports customization,
                                bulk requests, and production notes at checkout.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <div
                        class="rounded-[34px] border border-[#1e140f]/10 bg-white/80 p-6"
                    >
                        <p
                            class="text-xs uppercase tracking-[0.3em] text-[#8a563c]"
                        >
                            Starting from
                        </p>
                        <p class="mt-4 text-4xl text-[#1e140f]">
                            {{ formatPrice(8990) }}
                        </p>
                        <p class="mt-3 text-sm leading-7 text-[#5f483b]">
                            Public-facing entry pricing for hoodies, sets, and
                            custom teamwear collections.
                        </p>
                    </div>
                    <div
                        class="rounded-[34px] border border-[#1e140f]/10 bg-[#f4e5d6] p-6"
                    >
                        <p
                            class="text-xs uppercase tracking-[0.3em] text-[#8a563c]"
                        >
                            Best for
                        </p>
                        <p class="mt-4 text-4xl text-[#1e140f]">
                            Clubs, schools, programs
                        </p>
                        <p class="mt-3 text-sm leading-7 text-[#5f483b]">
                            Teams can move from discovery to order submission
                            without leaving the website.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-8 rounded-[36px] border border-[#1e140f]/10 bg-white/78 px-6 py-5 shadow-[0_24px_80px_rgba(53,33,23,0.08)] backdrop-blur-xl">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <p class="text-xs font-semibold uppercase tracking-[0.34em] text-[#8a563c]">
                    Used by schools, clubs, academies, fanwear programs, custom events, and sports brands
                </p>
                <div class="flex flex-wrap gap-2 text-xs font-semibold uppercase tracking-[0.22em] text-[#6a5346]">
                    <span class="rounded-full border border-[#1e140f]/10 px-3 py-2">Basketball</span>
                    <span class="rounded-full border border-[#1e140f]/10 px-3 py-2">Football</span>
                    <span class="rounded-full border border-[#1e140f]/10 px-3 py-2">Baseball</span>
                    <span class="rounded-full border border-[#1e140f]/10 px-3 py-2">Streetwear</span>
                    <span class="rounded-full border border-[#1e140f]/10 px-3 py-2">Training</span>
                </div>
            </div>
        </section>

        <section id="sports" class="mt-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.32em] text-[#8a563c]">
                        Shop By Sport
                    </p>
                    <h2 class="mt-3 text-4xl text-[#1e140f]">
                        Jump directly into the sport or product type.
                    </h2>
                </div>
                <Link
                    :href="route('shop.index')"
                    class="text-sm font-semibold text-[#8a563c] transition hover:text-[#ad5a34]"
                >
                    Browse all products →
                </Link>
            </div>

            <div class="mt-6 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                <Link
                    v-for="item in sportHighlights"
                    :key="item.sport"
                    :href="route('shop.index', { sport: item.sport })"
                    class="relative overflow-hidden rounded-[34px] border border-[#1e140f]/10 bg-white/78 p-6 shadow-[0_24px_80px_rgba(53,33,23,0.08)] backdrop-blur-xl transition hover:-translate-y-1"
                >
                    <div
                        class="absolute right-0 top-0 h-24 w-24 rounded-full blur-2xl"
                        :style="{ background: `${item.accent}55` }"
                    ></div>
                    <p class="text-xs uppercase tracking-[0.28em] text-[#8a563c]">
                        Sport focus
                    </p>
                    <h3 class="mt-4 text-3xl text-[#1e140f]">
                        {{ item.sport }}
                    </h3>
                    <p class="mt-4 max-w-[18rem] text-sm leading-7 text-[#5f483b]">
                        {{ item.note }}
                    </p>
                    <div class="mt-8 flex items-center justify-between text-sm font-semibold text-[#1e140f]">
                        <span>Explore collection</span>
                        <span>→</span>
                    </div>
                </Link>
            </div>
        </section>

        <section id="pricing" class="mt-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.32em] text-[#8a563c]">
                        Pricing & Collections
                    </p>
                    <h2 class="mt-3 text-4xl text-[#1e140f]">
                        Category-led cards modeled after high-volume teamwear storefronts.
                    </h2>
                </div>
                <div class="text-sm text-[#6a5346]">
                    Clear starting prices help convert first-time buyers faster.
                </div>
            </div>

            <div class="mt-6 grid gap-5 lg:grid-cols-2 xl:grid-cols-4">
                <Link
                    v-for="collection in collections"
                    :key="collection.category"
                    :href="route('shop.index', { category: collection.category })"
                    class="relative overflow-hidden rounded-[34px] p-6 text-white shadow-[0_24px_80px_rgba(39,24,18,0.2)] transition hover:-translate-y-1"
                    :style="collectionStyle(collection)"
                >
                    <div
                        class="absolute right-0 top-0 h-28 w-28 rounded-full bg-white/10 blur-2xl"
                    ></div>
                    <p class="text-xs uppercase tracking-[0.3em] text-white/78">
                        {{ collection.count }} products
                    </p>
                    <h3 class="mt-4 max-w-[14rem] text-3xl leading-tight">
                        {{ collection.category }}
                    </h3>
                    <p class="mt-4 text-sm leading-7 text-white/80">
                        {{ collection.sports.join(' • ') }}
                    </p>
                    <div class="mt-8 flex items-center justify-between">
                        <span class="text-sm font-semibold">
                            from {{ formatPrice(collection.starting_price) }}
                        </span>
                        <span class="text-sm font-semibold">View pricing →</span>
                    </div>
                </Link>
            </div>
        </section>

        <section class="mt-8 grid gap-5 lg:grid-cols-3">
            <article
                v-for="item in servicePromises"
                :key="item.title"
                class="rounded-[34px] border border-[#1e140f]/10 bg-white/78 p-6 shadow-[0_24px_80px_rgba(53,33,23,0.08)] backdrop-blur-xl"
            >
                <p class="text-xs uppercase tracking-[0.3em] text-[#8a563c]">
                    Why Impactive
                </p>
                <h3 class="mt-4 text-3xl leading-tight text-[#1e140f]">
                    {{ item.title }}
                </h3>
                <p class="mt-4 text-sm leading-7 text-[#5f483b]">
                    {{ item.copy }}
                </p>
            </article>
        </section>

        <section class="mt-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.32em] text-[#8a563c]">
                        Featured Products
                    </p>
                    <h2 class="mt-3 text-4xl text-[#1e140f]">
                        Strong merchandising blocks for top-selling styles.
                    </h2>
                </div>
                <Link
                    :href="route('shop.index')"
                    class="text-sm font-semibold text-[#8a563c] transition hover:text-[#ad5a34]"
                >
                    Browse full catalog →
                </Link>
            </div>

            <div class="mt-6 grid gap-5 lg:grid-cols-2 xl:grid-cols-4">
                <ProductCard
                    v-for="product in featuredProducts"
                    :key="product.id"
                    :product="product"
                />
            </div>
        </section>

        <section id="process" class="mt-8 grid gap-6 xl:grid-cols-[0.95fr_1.05fr]">
            <div
                class="rounded-[38px] border border-[#1e140f]/10 bg-white/78 p-6 shadow-[0_24px_80px_rgba(53,33,23,0.08)] backdrop-blur-xl sm:p-8"
            >
                <p class="text-xs uppercase tracking-[0.32em] text-[#8a563c]">
                    How It Works
                </p>
                <h2 class="mt-4 max-w-xl text-4xl leading-tight text-[#1e140f]">
                    The website now behaves more like a real sales platform than
                    a one-page promo site.
                </h2>
                <div class="mt-8 space-y-4">
                    <article
                        v-for="step in processSteps"
                        :key="step.id"
                        class="rounded-[28px] border border-[#1e140f]/8 bg-[#fdf8f3] p-5"
                    >
                        <p class="text-xs uppercase tracking-[0.3em] text-[#8a563c]">
                            {{ step.id }}
                        </p>
                        <h3 class="mt-3 text-2xl text-[#1e140f]">
                            {{ step.title }}
                        </h3>
                        <p class="mt-3 text-sm leading-7 text-[#5f483b]">
                            {{ step.copy }}
                        </p>
                    </article>
                </div>
            </div>

            <div class="space-y-6">
                <div
                    class="rounded-[38px] bg-[#1a120e] p-6 text-[#f7efe6] shadow-[0_30px_120px_rgba(26,18,14,0.28)] sm:p-8"
                >
                    <p class="text-xs uppercase tracking-[0.32em] text-[#d9b392]">
                        Custom Quote CTA
                    </p>
                    <h2 class="mt-4 text-4xl leading-tight sm:text-5xl">
                        Start your custom order today and let the site collect
                        the important details for you.
                    </h2>
                    <p class="mt-5 max-w-xl text-base leading-8 text-[#f7efe6]/74">
                        Just like the reference site, repeated conversion points
                        matter. This block keeps your quote/order path visible
                        throughout the homepage.
                    </p>
                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        <Link
                            :href="route('shop.index')"
                            class="inline-flex items-center justify-center gap-2 rounded-full bg-[#ad5a34] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#8d4829]"
                        >
                            Get Started
                            <span aria-hidden="true">→</span>
                        </Link>
                        <Link
                            :href="route('checkout.index')"
                            class="inline-flex items-center justify-center gap-2 rounded-full border border-white/10 bg-white/5 px-6 py-3 text-sm font-semibold text-[#f7efe6] transition hover:bg-white/10"
                        >
                            Go to Checkout
                        </Link>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.32em] text-[#8a563c]">
                                Latest Catalog
                            </p>
                            <h2 class="mt-3 text-4xl text-[#1e140f]">
                                Current products ready for ordering.
                            </h2>
                        </div>
                    </div>

                    <div class="mt-6 grid gap-5 lg:grid-cols-2">
                        <ProductCard
                            v-for="product in latestProducts"
                            :key="product.id"
                            :product="product"
                            cta-label="Order Now"
                        />
                    </div>
                </div>
            </div>
        </section>

        <section id="faq" class="mt-8 rounded-[38px] border border-[#1e140f]/10 bg-white/78 p-6 shadow-[0_24px_80px_rgba(53,33,23,0.08)] backdrop-blur-xl sm:p-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.32em] text-[#8a563c]">
                        FAQ
                    </p>
                    <h2 class="mt-3 text-4xl text-[#1e140f]">
                        The support-style section large teamwear sites usually need.
                    </h2>
                </div>
                <Link
                    :href="route('shop.index')"
                    class="text-sm font-semibold text-[#8a563c] transition hover:text-[#ad5a34]"
                >
                    Start shopping →
                </Link>
            </div>

            <div class="mt-6 grid gap-4 lg:grid-cols-2">
                <article
                    v-for="item in faqItems"
                    :key="item.question"
                    class="rounded-[28px] border border-[#1e140f]/8 bg-[#fcf7f1] p-5"
                >
                    <h3 class="text-2xl leading-tight text-[#1e140f]">
                        {{ item.question }}
                    </h3>
                    <p class="mt-4 text-sm leading-7 text-[#5f483b]">
                        {{ item.answer }}
                    </p>
                </article>
            </div>
        </section>
    </StoreLayout>
</template>
