<script setup>
import { computed, ref, watch } from 'vue';

const props = defineProps({
    compact: {
        type: Boolean,
        default: false,
    },
    product: {
        type: Object,
        required: true,
    },
});

const imageErrored = ref(false);

watch(() => props.product.image, () => {
    imageErrored.value = false;
});

const hasImage = computed(() => Boolean(props.product.image) && !imageErrored.value);

const stageStyle = computed(() => ({
    background: `linear-gradient(155deg, ${props.product.secondary_accent} 0%, ${props.product.accent} 100%)`,
}));
</script>

<template>
    <div
        class="relative overflow-hidden rounded-[20px] border border-[#d9dee4]"
        :class="compact ? 'aspect-[4/4.4]' : 'aspect-[4/4.8]'"
        :style="stageStyle"
    >
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.28),transparent_28%),linear-gradient(180deg,rgba(255,255,255,0),rgba(0,0,0,0.12))]"></div>
        <div class="absolute left-4 top-4 rounded-full bg-white px-3 py-1.5 text-[10px] font-semibold uppercase tracking-[0.24em] text-[#101317]">
            {{ product.badge }}
        </div>
        <div class="absolute right-4 top-4 rounded-full bg-[#101317] px-3 py-1.5 text-[10px] font-semibold uppercase tracking-[0.24em] text-white">
            {{ product.sport }}
        </div>

        <div v-if="hasImage" class="relative h-full">
            <img
                :src="product.image"
                :alt="product.name"
                class="h-full w-full object-cover"
                @error="imageErrored = true"
            />
            <div class="absolute inset-x-0 bottom-0 bg-[linear-gradient(180deg,rgba(16,19,23,0),rgba(16,19,23,0.72))] px-4 pb-5 pt-10 text-white">
                <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-white/70">
                    {{ product.category }}
                </p>
                <p class="mt-2 text-3xl leading-[0.92]">
                    {{ product.name }}
                </p>
            </div>
        </div>

        <div v-else class="relative flex h-full flex-col justify-end px-5 py-5">
            <div class="mb-auto pt-14">
                <div class="inline-flex rounded-full border border-white/35 bg-white/12 px-3 py-1.5 text-[10px] font-semibold uppercase tracking-[0.24em] text-white">
                    Custom made
                </div>
            </div>

            <div class="rounded-[22px] border border-white/20 bg-white/14 p-5 backdrop-blur-[2px]">
                <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-white/72">
                    {{ product.category }}
                </p>
                <h3 class="mt-3 text-[2rem] leading-[0.92] text-white">
                    {{ product.name }}
                </h3>
                <div class="mt-4 flex flex-wrap gap-2 text-[11px] font-semibold uppercase tracking-[0.18em] text-white/78">
                    <span class="rounded-full border border-white/20 px-3 py-1.5">
                        {{ product.sport }}
                    </span>
                    <span class="rounded-full border border-white/20 px-3 py-1.5">
                        {{ product.preview_code }}
                    </span>
                </div>
            </div>
        </div>

        <div class="absolute inset-x-0 bottom-0 border-t border-white/18 bg-[linear-gradient(180deg,rgba(255,255,255,0),rgba(255,255,255,0.9))] px-4 py-3">
            <div class="flex items-center justify-between text-[10px] font-semibold uppercase tracking-[0.22em] text-[#101317]">
                <span>{{ product.category }}</span>
                <span>Made to order</span>
            </div>
        </div>
    </div>
</template>
