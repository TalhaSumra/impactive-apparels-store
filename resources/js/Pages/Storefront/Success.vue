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
            <div class="retail-card rounded-[24px] p-6 xl:p-8">
                <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-[#d61f26]">
                    Order confirmed
                </p>
                <h1 class="mt-4 max-w-3xl text-[clamp(3rem,5vw,5rem)] leading-[0.9] text-[#101317]">
                    {{ order.customer_name }}, your order is in.
                </h1>
                <p class="mt-4 max-w-2xl text-base leading-7 text-[#4c5968]">
                    Your order has been stored and is ready for follow-up on production details.
                </p>

                <div class="mt-8 grid gap-4 md:grid-cols-2">
                    <div class="rounded-[18px] bg-[#f7f9fb] p-5">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]">
                            Order number
                        </p>
                        <p class="mt-2 text-3xl font-semibold text-[#101317]">
                            {{ order.order_number }}
                        </p>
                    </div>
                    <div class="rounded-[18px] bg-[#f7f9fb] p-5">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]">
                            Payment
                        </p>
                        <p class="mt-2 text-3xl font-semibold text-[#101317]">
                            {{ paymentLabels[order.payment_method] }}
                        </p>
                    </div>
                </div>

                <div class="mt-8 space-y-4">
                    <article
                        v-for="item in order.items"
                        :key="`${item.product_name}-${item.size}`"
                        class="rounded-[18px] border border-[#d9dee4] bg-[#f7f9fb] p-5"
                    >
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-[#6a7583]">
                                    {{ item.sport }}
                                </p>
                                <h2 class="mt-2 text-[2rem] leading-[0.95] text-[#101317]">
                                    {{ item.product_name }}
                                </h2>
                                <p class="mt-2 text-sm text-[#4c5968]">
                                    Size {{ item.size }} • Qty {{ item.quantity }}
                                </p>
                            </div>
                            <p class="text-lg font-semibold text-[#101317]">
                                {{ formatPrice(item.line_total) }}
                            </p>
                        </div>
                    </article>
                </div>
            </div>

            <div class="space-y-6">
                <div class="retail-card rounded-[24px] p-6">
                    <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-[#6a7583]">
                        Contact details
                    </p>
                    <div class="mt-5 space-y-3 text-sm leading-7 text-[#4c5968]">
                        <p><span class="font-semibold text-[#101317]">Email:</span> {{ order.email }}</p>
                        <p><span class="font-semibold text-[#101317]">Phone:</span> {{ order.phone }}</p>
                        <p v-if="order.team_name"><span class="font-semibold text-[#101317]">Team:</span> {{ order.team_name }}</p>
                        <p>
                            <span class="font-semibold text-[#101317]">Address:</span>
                            {{ order.shipping_address }}, {{ order.city }}, {{ order.country }}
                        </p>
                    </div>

                    <div v-if="order.order_notes" class="mt-6 rounded-[18px] border border-[#d9dee4] bg-[#f7f9fb] p-5">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#6a7583]">
                            Order notes
                        </p>
                        <p class="mt-3 text-sm leading-7 text-[#4c5968]">
                            {{ order.order_notes }}
                        </p>
                    </div>
                </div>

                <div class="retail-card rounded-[24px] overflow-hidden">
                    <div class="border-b border-[#d9dee4] bg-[linear-gradient(145deg,#101317_0%,#2b3138_44%,#d61f26_100%)] px-5 py-12 text-white">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.24em] text-white/66">
                            Production follow-up
                        </p>
                        <p class="mt-3 max-w-sm text-[2.4rem] leading-[0.92] text-white">
                            The storefront is ready for real apparel photography instead of placeholder graphics.
                        </p>
                    </div>
                    <div class="p-5">
                        <p class="text-[12px] font-semibold uppercase tracking-[0.24em] text-[#6a7583]">
                            Totals
                        </p>
                        <div class="mt-5 space-y-4">
                            <div class="flex items-center justify-between text-sm text-[#4c5968]">
                                <span>Items</span>
                                <span>{{ order.item_count }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm text-[#4c5968]">
                                <span>Status</span>
                                <span class="capitalize">{{ order.status }}</span>
                            </div>
                            <div class="h-px bg-[#e1e6eb]"></div>
                            <div class="flex items-center justify-between text-lg font-semibold text-[#101317]">
                                <span>Total</span>
                                <span>{{ formatPrice(order.total) }}</span>
                            </div>
                        </div>

                        <div class="mt-6 flex flex-col gap-3">
                            <Link
                                :href="route('shop.index')"
                                class="inline-flex items-center justify-center rounded-[14px] bg-[#d61f26] px-6 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-white transition hover:bg-[#b11218]"
                            >
                                Continue shopping
                            </Link>
                            <Link
                                :href="route('home')"
                                class="inline-flex items-center justify-center rounded-[14px] border border-[#101317] px-6 py-3 text-sm font-semibold uppercase tracking-[0.12em] text-[#101317] transition hover:border-[#d61f26] hover:text-[#d61f26]"
                            >
                                Return home
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </StoreLayout>
</template>
