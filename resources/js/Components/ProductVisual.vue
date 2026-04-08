<script setup>
import { computed } from 'vue';

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

const cardStyle = computed(() => ({
    background: `radial-gradient(circle at top left, ${props.product.accent}80 0%, transparent 34%), linear-gradient(135deg, ${props.product.secondary_accent} 0%, ${props.product.accent} 100%)`,
}));

const primaryStyle = computed(() => ({
    background: `linear-gradient(180deg, ${props.product.accent} 0%, ${props.product.secondary_accent} 100%)`,
    boxShadow: `0 18px 40px ${props.product.accent}33`,
}));

const secondaryStyle = computed(() => ({
    background: `linear-gradient(180deg, ${props.product.secondary_accent} 0%, ${props.product.accent} 100%)`,
    boxShadow: `0 14px 30px ${props.product.secondary_accent}22`,
}));
</script>

<template>
    <div
        class="relative overflow-hidden rounded-[30px] border border-white/10"
        :class="compact ? 'aspect-[4/4.8]' : 'aspect-[4/5]'"
        :style="cardStyle"
    >
        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_bottom,rgba(255,255,255,0.2),transparent_44%)]"
        ></div>
        <div class="absolute left-4 top-4 rounded-full bg-white/15 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.28em] text-white/85">
            {{ product.badge }}
        </div>
        <div class="absolute right-4 top-4 rounded-full border border-white/10 bg-black/10 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.24em] text-white/72">
            {{ product.sport }}
        </div>

        <div class="relative flex h-full items-end justify-center gap-4 px-4 pb-6 pt-16">
            <div class="kit-preview" :class="compact ? 'scale-[0.92]' : ''">
                <div class="kit-top">
                    <div class="kit-sleeve left" :style="secondaryStyle"></div>
                    <div class="kit-sleeve right" :style="secondaryStyle"></div>
                    <div class="kit-shirt" :style="primaryStyle">
                        <span class="kit-number">{{ product.preview_code }}</span>
                    </div>
                </div>
                <div class="kit-shorts" :style="secondaryStyle"></div>
            </div>

            <div class="kit-preview secondary hidden md:block scale-[0.82] translate-y-6 opacity-90">
                <div class="kit-top">
                    <div class="kit-sleeve left" :style="primaryStyle"></div>
                    <div class="kit-sleeve right" :style="primaryStyle"></div>
                    <div class="kit-shirt" :style="secondaryStyle">
                        <span class="kit-number">{{ product.preview_code }}</span>
                    </div>
                </div>
                <div class="kit-shorts" :style="primaryStyle"></div>
            </div>
        </div>

        <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-[11px] font-semibold uppercase tracking-[0.28em] text-white/82">
            <span>{{ product.category }}</span>
            <span>Made to order</span>
        </div>
    </div>
</template>

<style scoped>
.kit-preview {
    position: relative;
    width: 132px;
}

.kit-top {
    position: relative;
    display: flex;
    justify-content: center;
}

.kit-shirt {
    position: relative;
    display: flex;
    height: 112px;
    width: 92px;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(255, 255, 255, 0.26);
    border-radius: 24px 24px 30px 30px;
    backdrop-filter: blur(6px);
}

.kit-shirt::before {
    content: '';
    position: absolute;
    top: 14px;
    left: 50%;
    height: 10px;
    width: 38px;
    transform: translateX(-50%);
    border-bottom: 3px solid rgba(255, 255, 255, 0.42);
    border-radius: 0 0 18px 18px;
}

.kit-shirt::after {
    content: '';
    position: absolute;
    inset: 10px;
    border: 1px solid rgba(255, 255, 255, 0.14);
    border-radius: 18px;
}

.kit-sleeve {
    position: absolute;
    top: 10px;
    height: 46px;
    width: 34px;
    border: 1px solid rgba(255, 255, 255, 0.22);
    border-radius: 16px;
}

.kit-sleeve.left {
    left: -20px;
    transform: rotate(-18deg);
}

.kit-sleeve.right {
    right: -20px;
    transform: rotate(18deg);
}

.kit-shorts {
    margin: -10px auto 0;
    height: 56px;
    width: 76px;
    border: 1px solid rgba(255, 255, 255, 0.22);
    border-radius: 16px 16px 22px 22px;
    clip-path: polygon(0 0, 100% 0, 92% 100%, 56% 100%, 50% 70%, 44% 100%, 8% 100%);
}

.kit-number {
    font-family: 'Syne', sans-serif;
    font-size: 2.2rem;
    font-weight: 800;
    letter-spacing: -0.08em;
    color: #ffffff;
    text-shadow: 0 12px 24px rgba(0, 0, 0, 0.28);
}
</style>
