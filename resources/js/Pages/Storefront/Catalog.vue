<script setup>
import { computed } from 'vue';
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
    sort: props.filters.sort ?? 'featured',
    sport: props.filters.sport ?? '',
});

const pageTitle = computed(() => {
    if (filtersForm.category) {
        return filtersForm.category;
    }

    if (filtersForm.sport) {
        return `${filtersForm.sport} Apparel`;
    }

    return 'Shop All Apparel';
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
    filtersForm.sort = 'featured';
    filtersForm.sport = '';
    submit();
}
</script>

<template>
    <Head title="Shop Custom Sportswear" />

    <StoreLayout>
        <section class="retail-card rounded-[24px] overflow-hidden">
            <div class="grid gap-0 lg:grid-cols-[0.9fr_1.1fr]">
                <div class="border-b border-[#d9dee4] bg-white p-6 lg:border-b-0 lg:border-r lg:p-8">
                    <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-[#d61f26]">
                        Collection
                    </p>
                    <h1 class="mt-3 text-[clamp(3.2rem,5vw,5.4rem)] leading-[0.9] text-[#101317]">
                        {{ pageTitle }}
                    </h1>
                    <p class="mt-3 text-base leading-7 text-[#4c5968]">
                        {{ products.length }} styles ready to browse and order.
                    </p>

                    <div class="mt-6 flex flex-wrap gap-2">
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
                            :href="route('shop.index', { category: 'Hoodies & Streetwear' })"
                            class="rounded-full bg-[#f3f5f7] px-4 py-2 text-[11px] font-semibold uppercase tracking-[0.18em] text-[#4c5968] transition hover:bg-[#101317] hover:text-white"
                        >
                            Apparel
                        </Link>
                    </div>
                </div>

                <div
                    class="min-h-[260px]"
                    :class="products[0]?.image ? '' : 'flex items-end bg-[linear-gradient(145deg,#101317_0%,#2b3138_44%,#d61f26_100%)] p-6 text-white lg:p-8'"
                >
                    <img
                        v-if="products[0]?.image"
                        :src="products[0].image"
                        alt="Shop collection"
                        class="h-full w-full object-cover"
                    />
                    <div v-else>
                        <p class="text-[11px] font-semibold uppercase tracking-[0.24em] text-white/66">
                            Product gallery
                        </p>
                        <p class="mt-3 max-w-md text-[2.8rem] leading-[0.92] text-white">
                            Real collection photography can be dropped here next.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-6 grid gap-6 xl:grid-cols-[290px_1fr]">
            <aside class="retail-card rounded-[24px] p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-[#6a7583]">
                            Filter
                        </p>
                        <h2 class="mt-2 text-3xl text-[#101317]">
                            Refine products
                        </h2>
                    </div>
                    <button
                        type="button"
                        @click="clearFilters"
                        class="text-sm font-semibold uppercase tracking-[0.12em] text-[#d61f26]"
                    >
                        Reset
                    </button>
                </div>

                <form @submit.prevent="submit" class="mt-6 space-y-5">
                    <div>
                        <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]">
                            Search
                        </label>
                        <input
                            v-model="filtersForm.search"
                            type="text"
                            placeholder="Search styles"
                            class="mt-2 w-full rounded-[14px] border border-[#d9dee4] bg-white px-4 py-3 text-sm text-[#101317] outline-none transition focus:border-[#101317]"
                        />
                    </div>

                    <div>
                        <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]">
                            Category
                        </label>
                        <select
                            v-model="filtersForm.category"
                            class="mt-2 w-full rounded-[14px] border border-[#d9dee4] bg-white px-4 py-3 text-sm text-[#101317] outline-none transition focus:border-[#101317]"
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
                    </div>

                    <div>
                        <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]">
                            Sport
                        </label>
                        <select
                            v-model="filtersForm.sport"
                            class="mt-2 w-full rounded-[14px] border border-[#d9dee4] bg-white px-4 py-3 text-sm text-[#101317] outline-none transition focus:border-[#101317]"
                        >
                            <option value="">All sports</option>
                            <option
                                v-for="sport in sports"
                                :key="sport"
                                :value="sport"
                            >
                                {{ sport }}
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]">
                            Sort
                        </label>
                        <select
                            v-model="filtersForm.sort"
                            class="mt-2 w-full rounded-[14px] border border-[#d9dee4] bg-white px-4 py-3 text-sm text-[#101317] outline-none transition focus:border-[#101317]"
                        >
                            <option value="featured">Featured</option>
                            <option value="price_asc">Price: low to high</option>
                            <option value="price_desc">Price: high to low</option>
                            <option value="name_asc">Name: A-Z</option>
                        </select>
                    </div>

                    <button
                        type="submit"
                        class="inline-flex w-full items-center justify-center rounded-[14px] bg-[#101317] px-5 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-white transition hover:bg-[#d61f26]"
                    >
                        Apply filters
                    </button>
                </form>
            </aside>

            <div>
                <div class="retail-card flex flex-col gap-3 rounded-[24px] px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="text-sm text-[#4c5968]">
                        Showing <span class="font-semibold text-[#101317]">{{ products.length }}</span> products
                    </div>
                    <div class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]">
                        Retail-inspired collection view
                    </div>
                </div>

                <section class="mt-5">
                    <div v-if="products.length > 0" class="grid gap-5 lg:grid-cols-2 xl:grid-cols-3">
                        <ProductCard
                            v-for="product in products"
                            :key="product.id"
                            :product="product"
                        />
                    </div>

                    <div
                        v-else
                        class="retail-card rounded-[24px] p-10 text-center"
                    >
                        <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-[#d61f26]">
                            No results
                        </p>
                        <h2 class="mt-3 text-4xl text-[#101317]">
                            Nothing matched these filters.
                        </h2>
                        <div class="mt-6">
                            <Link
                                :href="route('shop.index')"
                                class="inline-flex items-center justify-center rounded-[14px] bg-[#101317] px-6 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-white transition hover:bg-[#d61f26]"
                            >
                                View all products
                            </Link>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </StoreLayout>
</template>
