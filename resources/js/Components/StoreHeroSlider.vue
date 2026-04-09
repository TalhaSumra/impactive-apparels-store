<script setup>
import { Link } from '@inertiajs/vue3';
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';
import { formatPrice } from '@/lib/format';

const props = defineProps({
    slides: {
        type: Array,
        required: true,
    },
});

const activeIndex = ref(0);

let intervalId = null;

const activeSlide = computed(() => props.slides[activeIndex.value] ?? null);

function stopRotation() {
    if (intervalId) {
        window.clearInterval(intervalId);
        intervalId = null;
    }
}

function goTo(index) {
    if (!props.slides.length) {
        return;
    }

    activeIndex.value = (index + props.slides.length) % props.slides.length;
}

function next() {
    goTo(activeIndex.value + 1);
}

function startRotation() {
    stopRotation();

    if (props.slides.length < 2) {
        return;
    }

    intervalId = window.setInterval(() => {
        next();
    }, 5000);
}

onMounted(() => {
    startRotation();
});

onBeforeUnmount(() => {
    stopRotation();
});
</script>

<template>
    <section
        v-if="activeSlide"
        class="retail-card relative overflow-hidden rounded-[24px]"
        @mouseenter="stopRotation"
        @mouseleave="startRotation"
    >
        <div class="grid gap-0 xl:grid-cols-[0.92fr_1.08fr]">
            <div class="flex flex-col justify-between border-b border-[#d9dee4] bg-white p-6 xl:border-b-0 xl:border-r xl:p-8">
                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center rounded-full bg-[#d61f26] px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.24em] text-white">
                            {{ activeSlide.badge }}
                        </span>
                        <span class="inline-flex items-center rounded-full border border-[#d9dee4] px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.24em] text-[#4c5968]">
                            {{ activeSlide.sport }}
                        </span>
                    </div>

                    <h2 class="mt-6 text-[clamp(3rem,5vw,5rem)] leading-[0.9] text-[#101317]">
                        {{ activeSlide.name }}
                    </h2>
                    <p class="mt-4 max-w-lg text-base leading-7 text-[#4c5968]">
                        {{ activeSlide.short_description }}
                    </p>
                </div>

                <div class="mt-8">
                    <div class="grid gap-3 sm:grid-cols-3">
                        <div class="rounded-[18px] bg-[#f7f9fb] px-4 py-4">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.24em] text-[#6a7583]">
                                Price
                            </p>
                            <p class="mt-2 text-2xl font-semibold text-[#101317]">
                                {{ formatPrice(activeSlide.price) }}
                            </p>
                        </div>
                        <div class="rounded-[18px] bg-[#f7f9fb] px-4 py-4">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.24em] text-[#6a7583]">
                                Minimum
                            </p>
                            <p class="mt-2 text-2xl font-semibold text-[#101317]">
                                {{ activeSlide.min_order_quantity }}
                            </p>
                        </div>
                        <div class="rounded-[18px] bg-[#f7f9fb] px-4 py-4">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.24em] text-[#6a7583]">
                                Lead time
                            </p>
                            <p class="mt-2 text-2xl font-semibold text-[#101317]">
                                {{ activeSlide.lead_time_days }}d
                            </p>
                        </div>
                    </div>

                    <div class="mt-5 flex flex-wrap gap-3">
                        <Link
                            :href="route('products.show', activeSlide.slug)"
                            class="inline-flex items-center justify-center rounded-[14px] bg-[#d61f26] px-5 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-white transition hover:bg-[#b11218]"
                        >
                            Shop {{ activeSlide.sport }}
                        </Link>
                        <Link
                            :href="route('checkout.index')"
                            class="inline-flex items-center justify-center rounded-[14px] border border-[#101317] px-5 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-[#101317] transition hover:border-[#d61f26] hover:text-[#d61f26]"
                        >
                            Quick order
                        </Link>
                    </div>

                    <div class="mt-5 flex items-center gap-2">
                        <button
                            v-for="(slide, index) in slides"
                            :key="slide.id"
                            type="button"
                            class="h-2.5 rounded-full transition"
                            :class="index === activeIndex ? 'w-10 bg-[#d61f26]' : 'w-2.5 bg-[#bcc5cf] hover:bg-[#6a7583]'"
                            @click="goTo(index)"
                        >
                            <span class="sr-only">Go to slide {{ index + 1 }}</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="relative min-h-[430px] bg-[#eef1f5] animate-slide-up">
                <img
                    v-if="activeSlide.image"
                    :src="activeSlide.image"
                    :alt="activeSlide.name"
                    class="absolute inset-0 h-full w-full object-cover"
                />
                <div
                    v-else
                    class="absolute inset-0 bg-[linear-gradient(145deg,#101317_0%,#2b3138_46%,#d61f26_100%)]"
                ></div>
                <div
                    v-if="!activeSlide.image"
                    class="relative flex h-full flex-col justify-between px-6 py-6 text-white xl:px-8 xl:py-8"
                >
                    <div class="inline-flex w-fit rounded-full border border-white/20 bg-white/10 px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.22em] text-white/86">
                        Collection spotlight
                    </div>
                    <div class="max-w-[28rem]">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.24em] text-white/66">
                            {{ activeSlide.category }}
                        </p>
                        <p class="mt-4 text-[clamp(3.4rem,5vw,5.2rem)] leading-[0.9] text-white">
                            {{ activeSlide.name }}
                        </p>
                        <p class="mt-4 max-w-lg text-base leading-7 text-white/78">
                            Clean product photography is ready to drop in here as soon as the final image files are added.
                        </p>
                    </div>
                </div>
                <div class="absolute inset-x-0 bottom-0 border-t border-white/30 bg-[linear-gradient(180deg,rgba(255,255,255,0),rgba(255,255,255,0.88))] p-5">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.24em] text-[#6a7583]">
                                Collection spotlight
                            </p>
                            <p class="mt-1 text-2xl text-[#101317]">
                                {{ activeSlide.category }}
                            </p>
                        </div>
                        <div class="rounded-[14px] bg-white px-4 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-[#101317] shadow-[0_12px_30px_rgba(16,19,23,0.08)]">
                            {{ activeIndex + 1 }} / {{ slides.length }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
