<script setup>
import { Head, Link } from '@inertiajs/vue3';
import StoreLayout from '@/Layouts/StoreLayout.vue';
import { formatPrice } from '@/lib/format';

defineProps({
    order: {
        type: Object,
        required: true,
    },
});

const paymentLabels = {
    bank_transfer: 'Bank Transfer',
    cash_on_delivery: 'Cash on Delivery',
    whatsapp_confirmation: 'WhatsApp Confirmation',
};
</script>

<template>
    <Head title="Order Confirmed" />

    <StoreLayout>
        <section class="grid gap-6 xl:grid-cols-[1.04fr_0.96fr]">
            <div
                class="rounded-[38px] border border-[#1e140f]/10 bg-white/78 p-6 shadow-[0_24px_80px_rgba(53,33,23,0.08)] backdrop-blur-xl sm:p-8"
            >
                <p class="text-xs uppercase tracking-[0.32em] text-[#8a563c]">
                    Order Confirmed
                </p>
                <h1 class="mt-4 max-w-3xl text-5xl leading-tight text-[#1e140f]">
                    {{ order.customer_name }}, your order has been placed.
                </h1>
                <p class="mt-4 max-w-2xl text-base leading-8 text-[#5f483b]">
                    The ecommerce flow is now active: this order is stored in
                    the database and ready for production follow-up.
                </p>

                <div class="mt-8 grid gap-4 md:grid-cols-2">
                    <div class="rounded-[28px] border border-[#1e140f]/8 bg-[#fcf7f1] p-5">
                        <p class="text-xs uppercase tracking-[0.26em] text-[#8a563c]">
                            Order Number
                        </p>
                        <p class="mt-3 text-3xl text-[#1e140f]">
                            {{ order.order_number }}
                        </p>
                    </div>
                    <div class="rounded-[28px] border border-[#1e140f]/8 bg-[#fcf7f1] p-5">
                        <p class="text-xs uppercase tracking-[0.26em] text-[#8a563c]">
                            Payment Method
                        </p>
                        <p class="mt-3 text-3xl text-[#1e140f]">
                            {{ paymentLabels[order.payment_method] }}
                        </p>
                    </div>
                </div>

                <div class="mt-8 space-y-4">
                    <article
                        v-for="item in order.items"
                        :key="`${item.product_name}-${item.size}`"
                        class="rounded-[28px] border border-[#1e140f]/8 bg-[#fcf7f1] p-5"
                    >
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase tracking-[0.24em] text-[#8a563c]">
                                    {{ item.sport }}
                                </p>
                                <h2 class="mt-2 text-2xl text-[#1e140f]">
                                    {{ item.product_name }}
                                </h2>
                                <p class="mt-2 text-sm text-[#6b5346]">
                                    Size {{ item.size }} • Qty {{ item.quantity }}
                                </p>
                            </div>
                            <p class="text-lg font-semibold text-[#1e140f]">
                                {{ formatPrice(item.line_total) }}
                            </p>
                        </div>
                    </article>
                </div>
            </div>

            <div class="space-y-6">
                <div
                    class="rounded-[38px] border border-[#1e140f]/10 bg-white/78 p-6 shadow-[0_24px_80px_rgba(53,33,23,0.08)] backdrop-blur-xl sm:p-8"
                >
                    <p class="text-xs uppercase tracking-[0.32em] text-[#8a563c]">
                        Contact Details
                    </p>
                    <div class="mt-5 space-y-3 text-sm leading-7 text-[#5f483b]">
                        <p><span class="font-semibold text-[#1e140f]">Email:</span> {{ order.email }}</p>
                        <p><span class="font-semibold text-[#1e140f]">Phone:</span> {{ order.phone }}</p>
                        <p v-if="order.team_name"><span class="font-semibold text-[#1e140f]">Team:</span> {{ order.team_name }}</p>
                        <p>
                            <span class="font-semibold text-[#1e140f]">Address:</span>
                            {{ order.shipping_address }}, {{ order.city }}, {{ order.country }}
                        </p>
                    </div>

                    <div v-if="order.order_notes" class="mt-6 rounded-[28px] border border-[#1e140f]/8 bg-[#fcf7f1] p-5">
                        <p class="text-xs uppercase tracking-[0.26em] text-[#8a563c]">
                            Order Notes
                        </p>
                        <p class="mt-3 text-sm leading-7 text-[#5f483b]">
                            {{ order.order_notes }}
                        </p>
                    </div>
                </div>

                <div
                    class="rounded-[38px] bg-[#1a120e] p-6 text-[#f7efe6] shadow-[0_30px_120px_rgba(26,18,14,0.28)] sm:p-8"
                >
                    <p class="text-xs uppercase tracking-[0.32em] text-[#d9b392]">
                        Totals
                    </p>
                    <div class="mt-5 space-y-4">
                        <div class="flex items-center justify-between text-sm text-[#f7efe6]/74">
                            <span>Items</span>
                            <span>{{ order.item_count }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm text-[#f7efe6]/74">
                            <span>Status</span>
                            <span class="capitalize">{{ order.status }}</span>
                        </div>
                        <div class="h-px bg-white/10"></div>
                        <div class="flex items-center justify-between text-lg font-semibold">
                            <span>Total</span>
                            <span>{{ formatPrice(order.total) }}</span>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col gap-3">
                        <Link
                            :href="route('shop.index')"
                            class="inline-flex items-center justify-center gap-2 rounded-full bg-[#ad5a34] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#8d4829]"
                        >
                            Continue Shopping
                            <span aria-hidden="true">→</span>
                        </Link>
                        <Link
                            :href="route('home')"
                            class="inline-flex items-center justify-center gap-2 rounded-full border border-white/10 bg-white/5 px-6 py-3 text-sm font-semibold text-[#f7efe6] transition hover:bg-white/10"
                        >
                            Return Home
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </StoreLayout>
</template>
