<script setup>
import { Link } from '@inertiajs/vue3';
import ProductVisual from '@/Components/ProductVisual.vue';
import { formatPrice } from '@/lib/format';

defineProps({
    ctaLabel: {
        type: String,
        default: 'View Product',
    },
    product: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <article
        class="group flex h-full flex-col rounded-[34px] border border-[#2c1c14]/10 bg-white/78 p-3 shadow-[0_20px_60px_rgba(53,33,23,0.08)] backdrop-blur-xl transition hover:-translate-y-1"
    >
        <ProductVisual :product="product" compact />

        <div class="flex flex-1 flex-col p-3 sm:p-4">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p
                        class="text-xs font-semibold uppercase tracking-[0.26em] text-[#8b593f]"
                    >
                        {{ product.category }}
                    </p>
                    <h3 class="mt-2 text-2xl leading-tight text-[#1e140f]">
                        {{ product.name }}
                    </h3>
                </div>
                <span
                    class="rounded-full border border-[#1e140f]/10 bg-[#f8efe6] px-3 py-2 text-sm font-bold text-[#1e140f]"
                >
                    {{ formatPrice(product.price) }}
                </span>
            </div>

            <p class="mt-4 text-sm leading-7 text-[#5f483b]">
                {{ product.short_description }}
            </p>

            <div class="mt-4 flex flex-wrap gap-2">
                <span
                    v-for="size in product.available_sizes.slice(0, 4)"
                    :key="size"
                    class="rounded-full border border-[#1e140f]/8 bg-[#fdf8f3] px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-[#6d5142]"
                >
                    {{ size }}
                </span>
            </div>

            <div class="mt-6 flex items-center justify-between gap-3">
                <div class="text-sm text-[#6b5346]">
                    {{ product.lead_time_days }} day lead time
                </div>
                <Link
                    :href="route('products.show', product.slug)"
                    class="inline-flex items-center gap-2 rounded-full bg-[#1e140f] px-4 py-2 text-sm font-semibold text-[#f7efe6] transition hover:bg-[#ad5a34]"
                >
                    {{ ctaLabel }}
                    <span aria-hidden="true">→</span>
                </Link>
            </div>
        </div>
    </article>
</template>
