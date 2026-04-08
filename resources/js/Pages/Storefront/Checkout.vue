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
        <section class="grid gap-6 xl:grid-cols-[1.06fr_0.94fr]">
            <form
                @submit.prevent="submit"
                class="rounded-[38px] border border-[#1e140f]/10 bg-white/78 p-6 shadow-[0_24px_80px_rgba(53,33,23,0.08)] backdrop-blur-xl sm:p-8"
            >
                <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.32em] text-[#8a563c]">
                            Checkout
                        </p>
                        <h1 class="mt-3 text-5xl leading-tight text-[#1e140f]">
                            Submit the public order.
                        </h1>
                    </div>
                    <div class="text-sm text-[#6b5346]">
                        {{ cart.count }} items ready
                    </div>
                </div>

                <div class="mt-8 grid gap-4 md:grid-cols-2">
                    <div>
                        <label
                            for="customer_name"
                            class="text-xs uppercase tracking-[0.28em] text-[#8a563c]"
                        >
                            Customer Name
                        </label>
                        <input
                            id="customer_name"
                            v-model="form.customer_name"
                            type="text"
                            class="mt-3 w-full rounded-2xl border border-[#1e140f]/10 bg-white px-4 py-3 text-sm text-[#1e140f] outline-none transition focus:border-[#ad5a34]/40"
                        />
                        <p v-if="form.errors.customer_name" class="mt-2 text-sm text-[#b03e35]">
                            {{ form.errors.customer_name }}
                        </p>
                    </div>

                    <div>
                        <label
                            for="team_name"
                            class="text-xs uppercase tracking-[0.28em] text-[#8a563c]"
                        >
                            Team or Brand Name
                        </label>
                        <input
                            id="team_name"
                            v-model="form.team_name"
                            type="text"
                            class="mt-3 w-full rounded-2xl border border-[#1e140f]/10 bg-white px-4 py-3 text-sm text-[#1e140f] outline-none transition focus:border-[#ad5a34]/40"
                        />
                        <p v-if="form.errors.team_name" class="mt-2 text-sm text-[#b03e35]">
                            {{ form.errors.team_name }}
                        </p>
                    </div>

                    <div>
                        <label
                            for="email"
                            class="text-xs uppercase tracking-[0.28em] text-[#8a563c]"
                        >
                            Email
                        </label>
                        <input
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="mt-3 w-full rounded-2xl border border-[#1e140f]/10 bg-white px-4 py-3 text-sm text-[#1e140f] outline-none transition focus:border-[#ad5a34]/40"
                        />
                        <p v-if="form.errors.email" class="mt-2 text-sm text-[#b03e35]">
                            {{ form.errors.email }}
                        </p>
                    </div>

                    <div>
                        <label
                            for="phone"
                            class="text-xs uppercase tracking-[0.28em] text-[#8a563c]"
                        >
                            Phone
                        </label>
                        <input
                            id="phone"
                            v-model="form.phone"
                            type="text"
                            class="mt-3 w-full rounded-2xl border border-[#1e140f]/10 bg-white px-4 py-3 text-sm text-[#1e140f] outline-none transition focus:border-[#ad5a34]/40"
                        />
                        <p v-if="form.errors.phone" class="mt-2 text-sm text-[#b03e35]">
                            {{ form.errors.phone }}
                        </p>
                    </div>
                </div>

                <div class="mt-6">
                    <label
                        for="shipping_address"
                        class="text-xs uppercase tracking-[0.28em] text-[#8a563c]"
                    >
                        Shipping Address
                    </label>
                    <textarea
                        id="shipping_address"
                        v-model="form.shipping_address"
                        rows="4"
                        class="mt-3 w-full rounded-[24px] border border-[#1e140f]/10 bg-white px-4 py-3 text-sm text-[#1e140f] outline-none transition focus:border-[#ad5a34]/40"
                    ></textarea>
                    <p v-if="form.errors.shipping_address" class="mt-2 text-sm text-[#b03e35]">
                        {{ form.errors.shipping_address }}
                    </p>
                </div>

                <div class="mt-6 grid gap-4 md:grid-cols-2">
                    <div>
                        <label
                            for="city"
                            class="text-xs uppercase tracking-[0.28em] text-[#8a563c]"
                        >
                            City
                        </label>
                        <input
                            id="city"
                            v-model="form.city"
                            type="text"
                            class="mt-3 w-full rounded-2xl border border-[#1e140f]/10 bg-white px-4 py-3 text-sm text-[#1e140f] outline-none transition focus:border-[#ad5a34]/40"
                        />
                        <p v-if="form.errors.city" class="mt-2 text-sm text-[#b03e35]">
                            {{ form.errors.city }}
                        </p>
                    </div>

                    <div>
                        <label
                            for="country"
                            class="text-xs uppercase tracking-[0.28em] text-[#8a563c]"
                        >
                            Country
                        </label>
                        <input
                            id="country"
                            v-model="form.country"
                            type="text"
                            class="mt-3 w-full rounded-2xl border border-[#1e140f]/10 bg-white px-4 py-3 text-sm text-[#1e140f] outline-none transition focus:border-[#ad5a34]/40"
                        />
                        <p v-if="form.errors.country" class="mt-2 text-sm text-[#b03e35]">
                            {{ form.errors.country }}
                        </p>
                    </div>
                </div>

                <div class="mt-6">
                    <p class="text-xs uppercase tracking-[0.28em] text-[#8a563c]">
                        Payment Method
                    </p>
                    <div class="mt-3 grid gap-3 md:grid-cols-3">
                        <button
                            v-for="option in paymentOptions"
                            :key="option.value"
                            type="button"
                            @click="form.payment_method = option.value"
                            class="rounded-[24px] border px-4 py-4 text-left transition"
                            :class="form.payment_method === option.value ? 'border-[#ad5a34] bg-[#ad5a34] text-white' : 'border-[#1e140f]/10 bg-white text-[#1e140f] hover:border-[#ad5a34]/30 hover:text-[#ad5a34]'"
                        >
                            <span class="text-sm font-semibold">
                                {{ option.label }}
                            </span>
                        </button>
                    </div>
                    <p v-if="form.errors.payment_method" class="mt-2 text-sm text-[#b03e35]">
                        {{ form.errors.payment_method }}
                    </p>
                </div>

                <div class="mt-6">
                    <label
                        for="order_notes"
                        class="text-xs uppercase tracking-[0.28em] text-[#8a563c]"
                    >
                        Order Notes
                    </label>
                    <textarea
                        id="order_notes"
                        v-model="form.order_notes"
                        rows="5"
                        placeholder="Add player names, numbers, logo placement notes, sponsor requirements, or timing details."
                        class="mt-3 w-full rounded-[24px] border border-[#1e140f]/10 bg-white px-4 py-3 text-sm text-[#1e140f] outline-none transition focus:border-[#ad5a34]/40"
                    ></textarea>
                    <p v-if="form.errors.order_notes" class="mt-2 text-sm text-[#b03e35]">
                        {{ form.errors.order_notes }}
                    </p>
                </div>

                <button
                    type="submit"
                    class="mt-8 inline-flex items-center gap-2 rounded-full bg-[#1e140f] px-6 py-3 text-sm font-semibold text-[#f7efe6] transition hover:bg-[#ad5a34]"
                    :disabled="form.processing"
                >
                    {{ form.processing ? 'Submitting...' : 'Place Order' }}
                    <span aria-hidden="true">→</span>
                </button>
            </form>

            <aside class="space-y-6">
                <div
                    class="rounded-[38px] border border-[#1e140f]/10 bg-white/78 p-6 shadow-[0_24px_80px_rgba(53,33,23,0.08)] backdrop-blur-xl sm:p-8"
                >
                    <p class="text-xs uppercase tracking-[0.32em] text-[#8a563c]">
                        Order Summary
                    </p>
                    <div class="mt-5 space-y-4">
                        <article
                            v-for="item in cart.items"
                            :key="item.key"
                            class="rounded-[24px] border border-[#1e140f]/8 bg-[#fcf7f1] p-4"
                        >
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.24em] text-[#8a563c]">
                                        {{ item.product.sport }}
                                    </p>
                                    <p class="mt-2 text-lg text-[#1e140f]">
                                        {{ item.product.name }}
                                    </p>
                                    <p class="mt-2 text-sm text-[#6b5346]">
                                        Size {{ item.size }} • Qty {{ item.quantity }}
                                    </p>
                                </div>
                                <span class="text-sm font-semibold text-[#1e140f]">
                                    {{ formatPrice(item.line_total) }}
                                </span>
                            </div>
                        </article>
                    </div>

                    <div class="mt-6 space-y-3">
                        <div class="flex items-center justify-between text-sm text-[#6b5346]">
                            <span>Subtotal</span>
                            <span>{{ formatPrice(cart.subtotal) }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm text-[#6b5346]">
                            <span>Shipping</span>
                            <span>Confirmed after review</span>
                        </div>
                        <div class="h-px bg-[#1e140f]/10"></div>
                        <div class="flex items-center justify-between text-base font-semibold text-[#1e140f]">
                            <span>Estimated total</span>
                            <span>{{ formatPrice(cart.subtotal) }}</span>
                        </div>
                    </div>

                    <div class="mt-6 rounded-[28px] bg-[#1a120e] p-5 text-[#f7efe6]">
                        <p class="text-sm leading-7 text-[#f7efe6]/74">
                            Once placed, the order is stored in the database so
                            your team can manage production and customer follow-up.
                        </p>
                    </div>
                </div>

                <Link
                    :href="route('cart.index')"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-[#8a563c] transition hover:text-[#ad5a34]"
                >
                    ← Back to cart
                </Link>
            </aside>
        </section>
    </StoreLayout>
</template>
