<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import StoreLayout from '@/Layouts/StoreLayout.vue';
import { formatPrice } from '@/lib/format';

defineProps({
    cart: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    city: '',
    country: 'Pakistan',
    customer_name: '',
    email: '',
    order_notes: '',
    payment_method: 'whatsapp_confirmation',
    phone: '',
    shipping_address: '',
    team_name: '',
});

const paymentOptions = [
    {
        label: 'WhatsApp Confirmation',
        value: 'whatsapp_confirmation',
    },
    {
        label: 'Bank Transfer',
        value: 'bank_transfer',
    },
    {
        label: 'Cash on Delivery',
        value: 'cash_on_delivery',
    },
];

function submit() {
    form.post(route('checkout.store'), {
        preserveScroll: true,
    });
}
</script>

<template>
    <Head title="Checkout" />

    <StoreLayout>
        <section class="grid gap-6 xl:grid-cols-[1.02fr_0.98fr]">
            <form
                @submit.prevent="submit"
                class="retail-card rounded-[24px] p-6 xl:p-8"
            >
                <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-[#d61f26]">
                            Checkout
                        </p>
                        <h1 class="mt-3 text-[clamp(3rem,5vw,5rem)] leading-[0.9] text-[#101317]">
                            Complete your order
                        </h1>
                    </div>
                    <div class="text-sm text-[#4c5968]">
                        {{ cart.count }} items ready
                    </div>
                </div>

                <div class="mt-8 grid gap-4 md:grid-cols-2">
                    <div>
                        <label
                            for="customer_name"
                            class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]"
                        >
                            Customer name
                        </label>
                        <input
                            id="customer_name"
                            v-model="form.customer_name"
                            type="text"
                            class="mt-2 w-full rounded-[14px] border border-[#d9dee4] bg-white px-4 py-3 text-sm text-[#101317] outline-none transition focus:border-[#101317]"
                        />
                        <p v-if="form.errors.customer_name" class="mt-2 text-sm text-[#b11218]">
                            {{ form.errors.customer_name }}
                        </p>
                    </div>

                    <div>
                        <label
                            for="team_name"
                            class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]"
                        >
                            Team or brand
                        </label>
                        <input
                            id="team_name"
                            v-model="form.team_name"
                            type="text"
                            class="mt-2 w-full rounded-[14px] border border-[#d9dee4] bg-white px-4 py-3 text-sm text-[#101317] outline-none transition focus:border-[#101317]"
                        />
                        <p v-if="form.errors.team_name" class="mt-2 text-sm text-[#b11218]">
                            {{ form.errors.team_name }}
                        </p>
                    </div>

                    <div>
                        <label
                            for="email"
                            class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]"
                        >
                            Email
                        </label>
                        <input
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="mt-2 w-full rounded-[14px] border border-[#d9dee4] bg-white px-4 py-3 text-sm text-[#101317] outline-none transition focus:border-[#101317]"
                        />
                        <p v-if="form.errors.email" class="mt-2 text-sm text-[#b11218]">
                            {{ form.errors.email }}
                        </p>
                    </div>

                    <div>
                        <label
                            for="phone"
                            class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]"
                        >
                            Phone
                        </label>
                        <input
                            id="phone"
                            v-model="form.phone"
                            type="text"
                            class="mt-2 w-full rounded-[14px] border border-[#d9dee4] bg-white px-4 py-3 text-sm text-[#101317] outline-none transition focus:border-[#101317]"
                        />
                        <p v-if="form.errors.phone" class="mt-2 text-sm text-[#b11218]">
                            {{ form.errors.phone }}
                        </p>
                    </div>
                </div>

                <div class="mt-6">
                    <label
                        for="shipping_address"
                        class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]"
                    >
                        Shipping address
                    </label>
                    <textarea
                        id="shipping_address"
                        v-model="form.shipping_address"
                        rows="4"
                        class="mt-2 w-full rounded-[16px] border border-[#d9dee4] bg-white px-4 py-3 text-sm text-[#101317] outline-none transition focus:border-[#101317]"
                    ></textarea>
                    <p v-if="form.errors.shipping_address" class="mt-2 text-sm text-[#b11218]">
                        {{ form.errors.shipping_address }}
                    </p>
                </div>

                <div class="mt-6 grid gap-4 md:grid-cols-2">
                    <div>
                        <label
                            for="city"
                            class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]"
                        >
                            City
                        </label>
                        <input
                            id="city"
                            v-model="form.city"
                            type="text"
                            class="mt-2 w-full rounded-[14px] border border-[#d9dee4] bg-white px-4 py-3 text-sm text-[#101317] outline-none transition focus:border-[#101317]"
                        />
                        <p v-if="form.errors.city" class="mt-2 text-sm text-[#b11218]">
                            {{ form.errors.city }}
                        </p>
                    </div>

                    <div>
                        <label
                            for="country"
                            class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]"
                        >
                            Country
                        </label>
                        <input
                            id="country"
                            v-model="form.country"
                            type="text"
                            class="mt-2 w-full rounded-[14px] border border-[#d9dee4] bg-white px-4 py-3 text-sm text-[#101317] outline-none transition focus:border-[#101317]"
                        />
                        <p v-if="form.errors.country" class="mt-2 text-sm text-[#b11218]">
                            {{ form.errors.country }}
                        </p>
                    </div>
                </div>

                <div class="mt-6">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]">
                        Payment method
                    </p>
                    <div class="mt-3 grid gap-3 md:grid-cols-3">
                        <button
                            v-for="option in paymentOptions"
                            :key="option.value"
                            type="button"
                            @click="form.payment_method = option.value"
                            class="rounded-[16px] border px-4 py-4 text-left transition"
                            :class="form.payment_method === option.value ? 'border-[#101317] bg-[#101317] text-white' : 'border-[#d9dee4] bg-white text-[#101317] hover:border-[#101317]'"
                        >
                            <span class="text-sm font-semibold uppercase tracking-[0.12em]">
                                {{ option.label }}
                            </span>
                        </button>
                    </div>
                    <p v-if="form.errors.payment_method" class="mt-2 text-sm text-[#b11218]">
                        {{ form.errors.payment_method }}
                    </p>
                </div>

                <div class="mt-6">
                    <label
                        for="order_notes"
                        class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]"
                    >
                        Order notes
                    </label>
                    <textarea
                        id="order_notes"
                        v-model="form.order_notes"
                        rows="5"
                        placeholder="Add player names, numbers, logo placement notes, sponsor requirements, or timing details."
                        class="mt-2 w-full rounded-[16px] border border-[#d9dee4] bg-white px-4 py-3 text-sm text-[#101317] outline-none transition focus:border-[#101317]"
                    ></textarea>
                    <p v-if="form.errors.order_notes" class="mt-2 text-sm text-[#b11218]">
                        {{ form.errors.order_notes }}
                    </p>
                </div>

                <button
                    type="submit"
                    class="mt-8 inline-flex items-center justify-center rounded-[14px] bg-[#d61f26] px-6 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-white transition hover:bg-[#b11218]"
                    :disabled="form.processing"
                >
                    {{ form.processing ? 'Submitting...' : 'Place order' }}
                </button>
            </form>

            <aside class="space-y-6">
                <div class="retail-card rounded-[24px] overflow-hidden">
                    <div
                        class="border-b border-[#d9dee4]"
                        :class="cart.items[0]?.product?.image ? '' : 'bg-[linear-gradient(145deg,#101317_0%,#2b3138_44%,#d61f26_100%)] px-5 py-12 text-white'"
                    >
                        <img
                            v-if="cart.items[0]?.product?.image"
                            :src="cart.items[0].product.image"
                            alt="Checkout banner"
                            class="h-full w-full object-cover"
                        />
                        <div v-else>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.24em] text-white/66">
                                Final review
                            </p>
                            <p class="mt-3 max-w-sm text-[2.4rem] leading-[0.92] text-white">
                                Product photography will show here once the final assets are in place.
                            </p>
                        </div>
                    </div>
                    <div class="p-5">
                        <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-[#6a7583]">
                            Order summary
                        </p>
                        <div class="mt-5 space-y-4">
                            <article
                                v-for="item in cart.items"
                                :key="item.key"
                                class="rounded-[18px] border border-[#d9dee4] bg-[#f7f9fb] p-4"
                            >
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-[#6a7583]">
                                            {{ item.product.sport }}
                                        </p>
                                        <p class="mt-2 text-2xl leading-[0.95] text-[#101317]">
                                            {{ item.product.name }}
                                        </p>
                                        <p class="mt-2 text-sm text-[#4c5968]">
                                            Size {{ item.size }} • Qty {{ item.quantity }}
                                        </p>
                                    </div>
                                    <span class="text-sm font-semibold text-[#101317]">
                                        {{ formatPrice(item.line_total) }}
                                    </span>
                                </div>
                            </article>
                        </div>

                        <div class="mt-6 space-y-3">
                            <div class="flex items-center justify-between text-sm text-[#4c5968]">
                                <span>Subtotal</span>
                                <span>{{ formatPrice(cart.subtotal) }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm text-[#4c5968]">
                                <span>Shipping</span>
                                <span>Confirmed after review</span>
                            </div>
                            <div class="h-px bg-[#e1e6eb]"></div>
                            <div class="flex items-center justify-between text-base font-semibold text-[#101317]">
                                <span>Estimated total</span>
                                <span>{{ formatPrice(cart.subtotal) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <Link
                    :href="route('cart.index')"
                    class="inline-flex items-center justify-center rounded-[14px] border border-[#101317] px-5 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-[#101317] transition hover:border-[#d61f26] hover:text-[#d61f26]"
                >
                    Back to cart
                </Link>
            </aside>
        </section>
    </StoreLayout>
</template>
