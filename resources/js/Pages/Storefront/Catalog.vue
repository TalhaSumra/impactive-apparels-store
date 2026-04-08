<script setup>
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import ProductCard from '@/Components/ProductCard.vue';
import StoreLayout from '@/Layouts/StoreLayout.vue';

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
    filters: {
        type: Object,
        required: true,
    },
    products: {
        type: Array,
        required: true,
    },
    sports: {
        type: Array,
        required: true,
    },
});

const filtersForm = useForm({
    category: props.filters.category ?? '',
    search: props.filters.search ?? '',
    sport: props.filters.sport ?? '',
});

function submit() {
    router.get(route('shop.index'), filtersForm.data(), {
        preserveScroll: true,
        preserveState: true,
        replace: true,
    });
}

function clearFilters() {
    filtersForm.category = '';
    filtersForm.search = '';
    filtersForm.sport = '';
    submit();
}
</script>

<template>
    <Head title="Shop Custom Sportswear" />

    <StoreLayout>
        <section class="grid gap-6 xl:grid-cols-[1.08fr_0.92fr]">
            <div
                class="rounded-[38px] border border-[#1e140f]/10 bg-white/78 p-6 shadow-[0_24px_80px_rgba(53,33,23,0.08)] backdrop-blur-xl sm:p-8"
            >
                <p class="text-xs uppercase tracking-[0.32em] text-[#8a563c]">
                    Full Catalog
                </p>
                <h1 class="mt-4 max-w-3xl text-5xl leading-tight text-[#1e140f]">
                    Shop the product grid the way major teamwear sites do it.
                </h1>
                <p class="mt-4 max-w-2xl text-base leading-8 text-[#5f483b]">
                    Search by sport, filter by collection, and move straight
                    into product pages built for public ordering.
                </p>

                <form
                    @submit.prevent="submit"
                    class="mt-8 grid gap-4 rounded-[30px] border border-[#1e140f]/8 bg-[#fcf7f1] p-4 lg:grid-cols-[1.3fr_0.8fr_0.8fr_auto_auto]"
                >
                    <input
                        v-model="filtersForm.search"
                        type="text"
                        placeholder="Search products, sports, or keywords"
                        class="rounded-2xl border border-[#1e140f]/10 bg-white px-4 py-3 text-sm text-[#1e140f] outline-none transition focus:border-[#ad5a34]/40"
                    />

                    <select
                        v-model="filtersForm.category"
                        class="rounded-2xl border border-[#1e140f]/10 bg-white px-4 py-3 text-sm text-[#1e140f] outline-none transition focus:border-[#ad5a34]/40"
                    >
                        <option value="">All categories</option>
                        <option
                            v-for="category in categories"
                            :key="category"
                            :value="category"
                        >
                            {{ category }}
                        </option>
                    </select>

                    <select
                        v-model="filtersForm.sport"
                        class="rounded-2xl border border-[#1e140f]/10 bg-white px-4 py-3 text-sm text-[#1e140f] outline-none transition focus:border-[#ad5a34]/40"
                    >
                        <option value="">All sports</option>
                        <option v-for="sport in sports" :key="sport" :value="sport">
                            {{ sport }}
                        </option>
                    </select>

                    <button
                        type="submit"
                        class="rounded-2xl bg-[#1e140f] px-5 py-3 text-sm font-semibold text-[#f7efe6] transition hover:bg-[#ad5a34]"
                    >
                        Apply Filters
                    </button>

                    <button
                        type="button"
                        @click="clearFilters"
                        class="rounded-2xl border border-[#1e140f]/10 bg-white px-5 py-3 text-sm font-semibold text-[#1e140f] transition hover:border-[#ad5a34]/30 hover:text-[#ad5a34]"
                    >
                        Reset
                    </button>
                </form>
            </div>

            <div class="grid gap-6">
                <div
                    class="rounded-[38px] bg-[#1a120e] p-6 text-[#f7efe6] shadow-[0_30px_120px_rgba(26,18,14,0.28)] sm:p-8"
                >
                    <p class="text-xs uppercase tracking-[0.32em] text-[#d9b392]">
                        Need a quote-style order?
                    </p>
                    <h2 class="mt-4 text-4xl leading-tight sm:text-5xl">
                        Start with a product, then use checkout to submit the
                        full team request online.
                    </h2>
                    <p class="mt-5 text-base leading-8 text-[#f7efe6]/74">
                        This keeps the Wooter-like sales structure while still
                        giving you a real ecommerce path instead of a brochure-only site.
                    </p>
                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        <Link
                            :href="route('checkout.index')"
                            class="inline-flex items-center justify-center gap-2 rounded-full bg-[#ad5a34] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#8d4829]"
                        >
                            Go to Checkout
                            <span aria-hidden="true">→</span>
                        </Link>
                        <Link
                            :href="route('cart.index')"
                            class="inline-flex items-center justify-center gap-2 rounded-full border border-white/10 bg-white/5 px-6 py-3 text-sm font-semibold text-[#f7efe6] transition hover:bg-white/10"
                        >
                            Review Cart
                        </Link>
                    </div>
                </div>

                <div
                    class="rounded-[34px] border border-[#1e140f]/10 bg-white/78 p-6 shadow-[0_24px_80px_rgba(53,33,23,0.08)] backdrop-blur-xl"
                >
                    <p class="text-xs uppercase tracking-[0.3em] text-[#8a563c]">
                        Quick Sports
                    </p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <Link
                            v-for="sport in sports"
                            :key="sport"
                            :href="route('shop.index', { sport })"
                            class="rounded-full border border-[#1e140f]/10 bg-[#fcf7f1] px-3 py-2 text-xs font-semibold uppercase tracking-[0.2em] text-[#6a5346] transition hover:border-[#ad5a34]/30 hover:text-[#ad5a34]"
                        >
                            {{ sport }}
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-6 rounded-[34px] border border-[#1e140f]/10 bg-white/78 px-5 py-4 shadow-[0_24px_80px_rgba(53,33,23,0.08)] backdrop-blur-xl">
            <div class="flex flex-wrap items-center gap-2">
                <Link
                    v-for="category in categories"
                    :key="category"
                    :href="route('shop.index', { category })"
                    class="rounded-full border border-[#1e140f]/10 bg-[#fcf7f1] px-4 py-2 text-sm font-semibold text-[#6a5346] transition hover:border-[#ad5a34]/30 hover:text-[#ad5a34]"
                >
                    {{ category }}
                </Link>
            </div>
        </section>

        <section class="mt-8">
            <div v-if="products.length > 0" class="grid gap-5 lg:grid-cols-2 xl:grid-cols-3">
                <ProductCard
                    v-for="product in products"
                    :key="product.id"
                    :product="product"
                />
            </div>

            <div
                v-else
                class="rounded-[36px] border border-[#1e140f]/10 bg-white/78 p-10 text-center shadow-[0_24px_80px_rgba(53,33,23,0.08)] backdrop-blur-xl"
            >
                <p class="text-xs uppercase tracking-[0.32em] text-[#8a563c]">
                    No results
                </p>
                <h2 class="mt-4 text-4xl text-[#1e140f]">
                    No products matched these filters.
                </h2>
                <p class="mt-4 text-base leading-8 text-[#5f483b]">
                    Try a broader search, change the sport, or reset the active
                    collection filter.
                </p>
                <div class="mt-6">
                    <Link
                        :href="route('shop.index')"
                        class="inline-flex items-center gap-2 rounded-full bg-[#1e140f] px-6 py-3 text-sm font-semibold text-[#f7efe6] transition hover:bg-[#ad5a34]"
                    >
                        View Full Catalog
                        <span aria-hidden="true">→</span>
                    </Link>
                </div>
            </div>
        </section>
    </StoreLayout>
</template>
