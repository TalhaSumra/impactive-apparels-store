<script setup>
import { Link } from '@inertiajs/vue3';
import ProductVisual from '@/Components/ProductVisual.vue';
import { formatPrice } from '@/lib/format';

defineProps({
    compact: {
        type: Boolean,
        default: false,
    },
    ctaLabel: {
        type: String,
        default: 'Choose options',
    },
    product: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <article
        class="group retail-card flex h-full flex-col overflow-hidden rounded-[20px] transition duration-300 hover:-translate-y-1 hover:shadow-[0_22px_56px_rgba(16,19,23,0.12)]"
    >
        <div class="relative">
            <ProductVisual :product="product" compact />
            <div class="absolute left-3 top-3">
                <span class="rounded-full bg-[#d61f26] px-2.5 py-1 text-[10px] font-semibold uppercase tracking-[0.18em] text-white">
                    {{ product.featured ? 'Featured' : 'Custom' }}
                </span>
            </div>
        </div>

        <div class="flex flex-1 flex-col p-4">
            <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-[#6a7583]">
                {{ product.category }}
            </p>
            <h3 :class="compact ? 'mt-2 text-[1.75rem] leading-[0.98] text-[#101317]' : 'mt-2 text-[2rem] leading-[0.95] text-[#101317]'">
                {{ product.name }}
            </h3>

            <div class="mt-3 flex items-center gap-2 text-sm">
                <span class="text-xl font-semibold text-[#101317]">
                    {{ formatPrice(product.price) }}
                </span>
                <span v-if="!compact" class="text-[#6a7583]">
                    Made to order
                </span>
            </div>

            <p v-if="!compact" class="mt-3 text-sm leading-6 text-[#4c5968]">
                {{ product.short_description }}
            </p>

            <div v-if="!compact" class="mt-4 flex flex-wrap gap-2">
                <span class="rounded-full bg-[#f3f5f7] px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.18em] text-[#4c5968]">
                    {{ product.sport }}
                </span>
                <span class="rounded-full bg-[#f3f5f7] px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.18em] text-[#4c5968]">
                    {{ product.min_order_quantity }} pcs min
                </span>
                <span class="rounded-full bg-[#f3f5f7] px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.18em] text-[#4c5968]">
                    {{ product.lead_time_days }} day lead
                </span>
            </div>

            <div :class="compact ? 'mt-4 flex items-center justify-end border-t border-[#e1e6eb] pt-4' : 'mt-5 flex items-center justify-between border-t border-[#e1e6eb] pt-4'">
                <span v-if="!compact" class="text-sm font-medium text-[#6a7583]">
                    {{ product.available_sizes.slice(0, 3).join(' / ') }}
                </span>
                <Link
                    :href="route('products.show', product.slug)"
                    class="inline-flex items-center justify-center rounded-[12px] bg-[#101317] px-4 py-2.5 text-sm font-semibold uppercase tracking-[0.12em] text-white transition hover:bg-[#d61f26]"
                >
                    {{ ctaLabel }}
                </Link>
            </div>
        </div>
    </article>
</template>
