<script setup>
import { Head } from '@inertiajs/vue3';

defineProps({
    instagramUrl: {
        type: String,
        required: true,
    },
});

const strengths = [
    {
        id: '01',
        title: 'Impact Fit',
        copy: 'Clean proportions, confident cuts, and styling that stays composed from day to night.',
    },
    {
        id: '02',
        title: 'Premium Feel',
        copy: 'Comfort-first construction with a polished finish that elevates everyday wear.',
    },
    {
        id: '03',
        title: 'Live Drops',
        copy: 'Instagram-led launches keep the brand connected, current, and ready for the next release.',
    },
];

const editCards = [
    {
        title: 'Minimal Core',
        copy: 'Streamlined staples with elevated spacing, sharp contrast, and a premium visual tone.',
    },
    {
        title: 'Movement Layers',
        copy: 'Panels, rhythm, and stacked surfaces create energy without overwhelming the experience.',
    },
    {
        title: 'Weekend Contrast',
        copy: 'Warm neutrals and darker anchors keep the brand modern, grounded, and memorable.',
    },
];

const lookbookNotes = [
    {
        title: 'Visual Language',
        copy: 'Warm neutrals, bold contrast, and editorial spacing create a fashion-led mood.',
    },
    {
        title: 'Signature Energy',
        copy: 'Minimal clutter, strong typography, and layered panels keep the brand sharp and modern.',
    },
    {
        title: 'Wearability',
        copy: 'The journey balances statement presence with enough clarity to keep discovery effortless.',
    },
];

const launchFlow = [
    {
        step: '01',
        title: 'Discover the vibe',
        copy: 'The hero frames Impactive Apparels as a confident, contemporary label from the first scroll.',
    },
    {
        step: '02',
        title: 'Read the brand',
        copy: 'Structured sections turn the homepage into a clean lookbook instead of a crowded catalog.',
    },
    {
        step: '03',
        title: 'Move to the drop',
        copy: 'Primary calls to action send visitors straight to Instagram for launches and enquiries.',
    },
];

const supportPills = [
    'Editorial hero',
    'Responsive layout',
    'Launch-ready CTA',
    'Premium brand tone',
];

const year = new Date().getFullYear();
</script>

<template>
    <Head title="Impactive Apparels" />
    <div class="site-shell relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0">
            <div
                class="glow-orb absolute left-[-6rem] top-10 h-56 w-56 rounded-full bg-[radial-gradient(circle,_rgba(173,90,52,0.45)_0%,_rgba(173,90,52,0)_72%)]"
            ></div>
            <div
                class="glow-orb delay absolute right-[-5rem] top-28 h-64 w-64 rounded-full bg-[radial-gradient(circle,_rgba(67,41,29,0.32)_0%,_rgba(67,41,29,0)_74%)]"
            ></div>
            <div class="grid-fade absolute inset-0 opacity-50"></div>
        </div>

        <div
            class="relative mx-auto flex min-h-screen w-full max-w-[1380px] flex-col px-4 pb-8 pt-4 sm:px-6 lg:px-10"
        >
            <header
                class="sticky top-4 z-20 mb-6 rounded-full border border-[#3b2418]/10 bg-white/75 px-4 py-3 backdrop-blur-xl sm:px-6"
            >
                <div class="flex items-center justify-between gap-4">
                    <a href="#top" class="flex items-center gap-3">
                        <span
                            class="flex size-11 items-center justify-center rounded-full bg-[#1e140f] text-sm font-semibold tracking-[0.28em] text-[#f8f1e8]"
                        >
                            IA
                        </span>
                        <div>
                            <p
                                class="heading-font text-sm uppercase tracking-[0.35em] text-[#7b4a34]"
                            >
                                Impactive
                            </p>
                            <p class="text-sm font-semibold text-[#1e140f]">
                                Apparels
                            </p>
                        </div>
                    </a>

                    <nav
                        class="hidden items-center gap-6 text-sm font-medium text-[#4a362b] md:flex"
                    >
                        <a href="#edit" class="transition hover:text-[#ad5a34]">
                            Edit
                        </a>
                        <a href="#story" class="transition hover:text-[#ad5a34]">
                            Story
                        </a>
                        <a
                            href="#connect"
                            class="transition hover:text-[#ad5a34]"
                        >
                            Connect
                        </a>
                    </nav>

                    <a
                        :href="instagramUrl"
                        target="_blank"
                        rel="noreferrer"
                        class="inline-flex items-center gap-2 rounded-full border border-[#1e140f]/10 bg-[#1e140f] px-4 py-2 text-sm font-semibold text-[#f8f1e8] transition hover:-translate-y-0.5 hover:bg-[#ad5a34]"
                    >
                        View Instagram
                        <span aria-hidden="true">↗</span>
                    </a>
                </div>
            </header>

            <main id="top" class="flex-1 space-y-6 lg:space-y-8">
                <section class="grid gap-6 xl:grid-cols-[1.08fr_0.92fr]">
                    <div
                        class="hero-card relative overflow-hidden rounded-[36px] border border-white/60 bg-white/70 p-6 backdrop-blur-xl sm:p-8 lg:p-10"
                    >
                        <div
                            class="absolute right-0 top-0 h-40 w-40 rounded-full bg-[#e8c3a2]/40 blur-3xl"
                        ></div>
                        <div
                            class="inline-flex items-center gap-2 rounded-full border border-[#1e140f]/10 bg-white/80 px-4 py-2 text-xs font-semibold uppercase tracking-[0.32em] text-[#7b4a34]"
                        >
                            Modern Apparel Website
                        </div>
                        <h1
                            class="mt-6 max-w-4xl text-[clamp(3.25rem,8vw,6.75rem)] leading-[0.92] text-[#1e140f]"
                        >
                            Wear the energy. Lead the room.
                        </h1>
                        <p
                            class="mt-6 max-w-2xl text-base leading-8 text-[#5c473b] sm:text-lg"
                        >
                            Impactive Apparels brings together confident
                            silhouettes, premium everyday comfort, and a clean
                            editorial presence for people who dress with intent.
                        </p>
                        <div
                            class="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap"
                        >
                            <a
                                :href="instagramUrl"
                                target="_blank"
                                rel="noreferrer"
                                class="inline-flex items-center justify-center gap-2 rounded-full bg-[#ad5a34] px-6 py-3 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-[#8f4728]"
                            >
                                View Latest Drop
                                <span aria-hidden="true">↗</span>
                            </a>
                            <a
                                href="#story"
                                class="inline-flex items-center justify-center gap-2 rounded-full border border-[#1e140f]/12 bg-white/70 px-6 py-3 text-sm font-semibold text-[#1e140f] transition hover:-translate-y-0.5 hover:border-[#ad5a34]/30 hover:text-[#ad5a34]"
                            >
                                Explore the Brand
                            </a>
                        </div>
                        <div class="mt-10 grid gap-4 sm:grid-cols-3">
                            <div
                                class="rounded-[28px] border border-[#1e140f]/10 bg-[#f7f0e8] p-4"
                            >
                                <p
                                    class="text-xs uppercase tracking-[0.28em] text-[#7b4a34]"
                                >
                                    Presence
                                </p>
                                <p class="mt-3 text-sm leading-7 text-[#4f3b30]">
                                    Designed to feel like a lookbook, not a
                                    template.
                                </p>
                            </div>
                            <div
                                class="rounded-[28px] border border-[#1e140f]/10 bg-white/80 p-4"
                            >
                                <p
                                    class="text-xs uppercase tracking-[0.28em] text-[#7b4a34]"
                                >
                                    Rhythm
                                </p>
                                <p class="mt-3 text-sm leading-7 text-[#4f3b30]">
                                    Layered sections guide the scroll with
                                    clarity and impact.
                                </p>
                            </div>
                            <div
                                class="rounded-[28px] border border-[#1e140f]/10 bg-[#f3e7d8] p-4"
                            >
                                <p
                                    class="text-xs uppercase tracking-[0.28em] text-[#7b4a34]"
                                >
                                    Motion
                                </p>
                                <p class="mt-3 text-sm leading-7 text-[#4f3b30]">
                                    Built to hold attention across mobile and
                                    desktop touchpoints.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-6">
                        <div
                            class="dark-panel relative overflow-hidden rounded-[36px] bg-[#18110d] p-6 text-[#f7efe6] sm:p-8"
                        >
                            <div
                                class="absolute right-[-2rem] top-[-2rem] h-40 w-40 rounded-full bg-[#ad5a34]/20 blur-3xl"
                            ></div>
                            <p
                                class="text-xs uppercase tracking-[0.32em] text-[#d7b18f]"
                            >
                                Season Direction
                            </p>
                            <h2
                                class="mt-4 max-w-md text-3xl leading-tight sm:text-4xl"
                            >
                                Confident silhouettes. Clean contrast. Maximum
                                presence.
                            </h2>
                            <p
                                class="mt-4 max-w-lg text-sm leading-7 text-[#f7efe6]/72 sm:text-base"
                            >
                                The visual system is warm, sharp, and premium.
                                It keeps the brand current without overloading
                                the experience with noise.
                            </p>
                            <div class="mt-8 grid gap-3 sm:grid-cols-3">
                                <div
                                    class="rounded-[28px] border border-white/10 bg-white/5 p-4"
                                >
                                    <p
                                        class="text-xs uppercase tracking-[0.24em] text-[#d7b18f]"
                                    >
                                        Neutral depth
                                    </p>
                                    <p class="mt-2 text-sm leading-6 text-white/70">
                                        Sand, cream, ember, and ink keep the
                                        look elevated.
                                    </p>
                                </div>
                                <div
                                    class="rounded-[28px] border border-white/10 bg-white/5 p-4"
                                >
                                    <p
                                        class="text-xs uppercase tracking-[0.24em] text-[#d7b18f]"
                                    >
                                        Bold type
                                    </p>
                                    <p class="mt-2 text-sm leading-6 text-white/70">
                                        Oversized headlines anchor the identity
                                        instantly.
                                    </p>
                                </div>
                                <div
                                    class="rounded-[28px] border border-white/10 bg-white/5 p-4"
                                >
                                    <p
                                        class="text-xs uppercase tracking-[0.24em] text-[#d7b18f]"
                                    >
                                        Clear CTA
                                    </p>
                                    <p class="mt-2 text-sm leading-6 text-white/70">
                                        Visitors move directly to the live
                                        Instagram storefront.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="grid gap-6 sm:grid-cols-2">
                            <div
                                class="float-card rounded-[32px] border border-[#2e1d13]/10 bg-white/80 p-6 backdrop-blur-xl"
                            >
                                <p
                                    class="text-xs uppercase tracking-[0.32em] text-[#7b4a34]"
                                >
                                    Instagram-led
                                </p>
                                <p class="mt-4 text-2xl text-[#1e140f]">
                                    @impactiveapparels stays at the center of
                                    every active drop.
                                </p>
                            </div>
                            <div
                                class="float-card delay rounded-[32px] border border-[#2e1d13]/10 bg-[#f3e7d8] p-6"
                            >
                                <p
                                    class="text-xs uppercase tracking-[0.32em] text-[#7b4a34]"
                                >
                                    Responsive by default
                                </p>
                                <p class="mt-4 text-2xl text-[#1e140f]">
                                    The layout holds its edge on compact mobile
                                    screens and wide desktop canvases.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="grid gap-4 md:grid-cols-3">
                    <article
                        v-for="item in strengths"
                        :key="item.id"
                        class="rounded-[32px] border border-[#2e1d13]/10 bg-white/75 p-6 backdrop-blur-xl transition hover:-translate-y-1"
                    >
                        <p
                            class="text-xs font-semibold uppercase tracking-[0.34em] text-[#7b4a34]"
                        >
                            {{ item.id }}
                        </p>
                        <h3 class="mt-4 text-2xl text-[#1e140f]">
                            {{ item.title }}
                        </h3>
                        <p class="mt-4 text-sm leading-7 text-[#5c473b]">
                            {{ item.copy }}
                        </p>
                    </article>
                </section>

                <section id="edit" class="grid gap-6 xl:grid-cols-[0.94fr_1.06fr]">
                    <div
                        class="relative overflow-hidden rounded-[36px] border border-[#251913]/10 bg-[#f2e2d2] p-6 sm:p-8"
                    >
                        <div
                            class="absolute left-0 top-0 h-40 w-40 rounded-full bg-white/35 blur-3xl"
                        ></div>
                        <p
                            class="relative text-xs uppercase tracking-[0.34em] text-[#7b4a34]"
                        >
                            The Impactive Edit
                        </p>
                        <h2
                            class="relative mt-4 max-w-lg text-4xl leading-tight text-[#1e140f]"
                        >
                            A fashion-led homepage with enough polish to feel
                            premium and enough clarity to keep people moving.
                        </h2>
                        <p
                            class="relative mt-5 max-w-xl text-base leading-8 text-[#5a463a]"
                        >
                            This direction gives the brand a stronger web
                            identity right away while leaving room to grow into
                            product pages, deeper lookbooks, and future drop
                            experiences.
                        </p>
                        <div
                            class="relative mt-8 flex flex-wrap gap-3 text-sm font-semibold text-[#1e140f]"
                        >
                            <span
                                v-for="pill in supportPills"
                                :key="pill"
                                class="rounded-full border border-[#1e140f]/10 bg-white/75 px-4 py-2"
                            >
                                {{ pill }}
                            </span>
                        </div>
                        <div class="relative mt-8 space-y-4">
                            <article
                                v-for="card in editCards"
                                :key="card.title"
                                class="rounded-[28px] border border-[#1e140f]/10 bg-white/70 p-5"
                            >
                                <h3 class="text-2xl text-[#1e140f]">
                                    {{ card.title }}
                                </h3>
                                <p class="mt-3 text-sm leading-7 text-[#5a463a]">
                                    {{ card.copy }}
                                </p>
                            </article>
                        </div>
                    </div>

                    <div class="grid gap-6">
                        <div
                            class="rounded-[36px] border border-[#2e1d13]/10 bg-white/80 p-6 backdrop-blur-xl sm:p-8"
                        >
                            <p
                                class="text-xs uppercase tracking-[0.34em] text-[#7b4a34]"
                            >
                                Brand Language
                            </p>
                            <div class="mt-6 space-y-5">
                                <article
                                    v-for="note in lookbookNotes"
                                    :key="note.title"
                                    class="rounded-[28px] border border-[#1e140f]/8 bg-[#fcf7f1] p-5"
                                >
                                    <h3 class="text-2xl text-[#1e140f]">
                                        {{ note.title }}
                                    </h3>
                                    <p class="mt-3 text-sm leading-7 text-[#5c473b]">
                                        {{ note.copy }}
                                    </p>
                                </article>
                            </div>
                        </div>

                        <div class="grid gap-6 sm:grid-cols-3">
                            <div
                                class="rounded-[30px] border border-[#2e1d13]/10 bg-[#1e140f] p-5 text-[#f7efe6]"
                            >
                                <p
                                    class="text-xs uppercase tracking-[0.28em] text-[#d7b18f]"
                                >
                                    01
                                </p>
                                <p class="mt-4 text-sm leading-7 text-[#f7efe6]/72">
                                    Focused homepage experience built to make
                                    the first scroll memorable.
                                </p>
                            </div>
                            <div
                                class="rounded-[30px] border border-[#2e1d13]/10 bg-white/80 p-5"
                            >
                                <p
                                    class="text-xs uppercase tracking-[0.28em] text-[#7b4a34]"
                                >
                                    100%
                                </p>
                                <p class="mt-4 text-sm leading-7 text-[#5c473b]">
                                    Responsive sections tuned for mobile-first
                                    fashion audiences.
                                </p>
                            </div>
                            <div
                                class="rounded-[30px] border border-[#2e1d13]/10 bg-[#f3e7d8] p-5"
                            >
                                <p
                                    class="text-xs uppercase tracking-[0.28em] text-[#7b4a34]"
                                >
                                    IG
                                </p>
                                <p class="mt-4 text-sm leading-7 text-[#5c473b]">
                                    Direct path to the active social storefront
                                    and DM-led conversations.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <section
                    id="story"
                    class="rounded-[40px] border border-[#2e1d13]/10 bg-white/75 p-6 backdrop-blur-xl sm:p-8 lg:p-10"
                >
                    <div
                        class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between"
                    >
                        <div>
                            <p
                                class="text-xs uppercase tracking-[0.34em] text-[#7b4a34]"
                            >
                                Scroll Story
                            </p>
                            <h2
                                class="mt-4 max-w-3xl text-4xl leading-tight text-[#1e140f] sm:text-5xl"
                            >
                                The website moves like a campaign: bold entry,
                                clear rhythm, direct action.
                            </h2>
                            <p
                                class="mt-5 max-w-2xl text-base leading-8 text-[#5c473b]"
                            >
                                Each section is designed to keep attention high
                                and friction low while the brand builds out its
                                fuller commerce experience.
                            </p>
                        </div>
                        <a
                            :href="instagramUrl"
                            target="_blank"
                            rel="noreferrer"
                            class="inline-flex items-center justify-center gap-2 rounded-full border border-[#1e140f]/10 bg-[#1e140f] px-6 py-3 text-sm font-semibold text-[#f7efe6] transition hover:-translate-y-0.5 hover:bg-[#ad5a34]"
                        >
                            Latest Drop
                            <span aria-hidden="true">↗</span>
                        </a>
                    </div>

                    <div class="mt-8 grid gap-4 lg:grid-cols-3">
                        <article
                            v-for="item in launchFlow"
                            :key="item.step"
                            class="rounded-[30px] border border-[#2e1d13]/10 bg-[#fcf7f1] p-6 transition hover:-translate-y-1"
                        >
                            <p
                                class="text-xs font-semibold uppercase tracking-[0.32em] text-[#7b4a34]"
                            >
                                {{ item.step }}
                            </p>
                            <h3 class="mt-4 text-2xl text-[#1e140f]">
                                {{ item.title }}
                            </h3>
                            <p class="mt-4 text-sm leading-7 text-[#5c473b]">
                                {{ item.copy }}
                            </p>
                        </article>
                    </div>
                </section>

                <section
                    id="connect"
                    class="grid gap-6 lg:grid-cols-[0.9fr_1.1fr]"
                >
                    <div
                        class="dark-panel relative overflow-hidden rounded-[36px] bg-[#1f140f] p-6 text-[#f7efe6] sm:p-8"
                    >
                        <div
                            class="absolute left-[-2rem] top-[-2rem] h-44 w-44 rounded-full bg-[#ad5a34]/20 blur-3xl"
                        ></div>
                        <p
                            class="relative text-xs uppercase tracking-[0.34em] text-[#d7b18f]"
                        >
                            Connect With the Brand
                        </p>
                        <h2
                            class="relative mt-4 max-w-md text-4xl leading-tight"
                        >
                            Keep the conversation active where the next drop
                            goes live.
                        </h2>
                        <p
                            class="relative mt-5 max-w-lg text-base leading-8 text-[#f7efe6]/72"
                        >
                            The site now gives Impactive Apparels a premium
                            home base while Instagram continues to lead launches,
                            updates, and real-time engagement.
                        </p>
                        <div class="relative mt-8 flex flex-col gap-3 sm:flex-row">
                            <a
                                :href="instagramUrl"
                                target="_blank"
                                rel="noreferrer"
                                class="inline-flex items-center justify-center gap-2 rounded-full bg-[#ad5a34] px-6 py-3 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-[#8f4728]"
                            >
                                Open Instagram
                                <span aria-hidden="true">↗</span>
                            </a>
                            <a
                                href="#top"
                                class="inline-flex items-center justify-center gap-2 rounded-full border border-white/10 bg-white/5 px-6 py-3 text-sm font-semibold text-[#f7efe6] transition hover:-translate-y-0.5 hover:bg-white/10"
                            >
                                Back to Top
                            </a>
                        </div>
                    </div>

                    <div class="grid gap-6">
                        <div
                            class="rounded-[36px] border border-[#2e1d13]/10 bg-white/80 p-6 backdrop-blur-xl sm:p-8"
                        >
                            <p
                                class="text-xs uppercase tracking-[0.34em] text-[#7b4a34]"
                            >
                                Ready for the Next Chapter
                            </p>
                            <h3
                                class="mt-4 max-w-2xl text-4xl leading-tight text-[#1e140f]"
                            >
                                This foundation can expand into deeper shopping
                                flows without losing the premium visual tone.
                            </h3>
                            <p
                                class="mt-5 max-w-2xl text-base leading-8 text-[#5c473b]"
                            >
                                Collection pages, lookbook stories, size-guide
                                journeys, and checkout-ready modules can all be
                                layered onto the same system as the brand grows.
                            </p>
                            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                                <div
                                    class="rounded-[28px] border border-[#1e140f]/8 bg-[#fcf7f1] p-5"
                                >
                                    <p
                                        class="text-xs uppercase tracking-[0.32em] text-[#7b4a34]"
                                    >
                                        Future-ready
                                    </p>
                                    <p class="mt-3 text-sm leading-7 text-[#5c473b]">
                                        Built on Laravel, Inertia, and Vue for
                                        a clean path into richer functionality.
                                    </p>
                                </div>
                                <div
                                    class="rounded-[28px] border border-[#1e140f]/8 bg-[#f3e7d8] p-5"
                                >
                                    <p
                                        class="text-xs uppercase tracking-[0.32em] text-[#7b4a34]"
                                    >
                                        Brand-safe
                                    </p>
                                    <p class="mt-3 text-sm leading-7 text-[#5c473b]">
                                        The visual direction stays premium while
                                        new sections and product content are
                                        introduced.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <footer
                class="mt-6 flex flex-col gap-4 rounded-[32px] border border-[#2e1d13]/10 bg-white/60 px-5 py-4 text-sm text-[#5d4739] backdrop-blur-xl xl:flex-row xl:items-center xl:justify-between"
            >
                <p>
                    © {{ year }} Impactive Apparels. Designed for confident
                    everyday impact.
                </p>
                <div class="flex flex-wrap items-center gap-4">
                    <a href="#edit" class="transition hover:text-[#ad5a34]">
                        Edit
                    </a>
                    <a href="#story" class="transition hover:text-[#ad5a34]">
                        Story
                    </a>
                    <a
                        :href="instagramUrl"
                        target="_blank"
                        rel="noreferrer"
                        class="font-semibold text-[#1e140f] transition hover:text-[#ad5a34]"
                    >
                        @impactiveapparels
                    </a>
                </div>
            </footer>
        </div>
    </div>
</template>

<style scoped>
.site-shell {
    background:
        radial-gradient(circle at top left, rgba(173, 90, 52, 0.12), transparent 30%),
        radial-gradient(circle at 85% 14%, rgba(67, 41, 29, 0.1), transparent 24%),
        linear-gradient(180deg, rgba(250, 245, 239, 1) 0%, rgba(245, 236, 223, 1) 52%, rgba(251, 246, 241, 1) 100%);
}

.grid-fade {
    background-image:
        linear-gradient(rgba(62, 34, 20, 0.07) 1px, transparent 1px),
        linear-gradient(90deg, rgba(62, 34, 20, 0.07) 1px, transparent 1px);
    background-size: 72px 72px;
    -webkit-mask-image: radial-gradient(circle at center, black 24%, transparent 82%);
    mask-image: radial-gradient(circle at center, black 24%, transparent 82%);
}

.hero-card {
    box-shadow: 0 28px 100px rgba(62, 34, 20, 0.14);
}

.dark-panel {
    box-shadow: 0 30px 120px rgba(28, 15, 10, 0.24);
}

.glow-orb {
    filter: blur(14px);
    animation: drift 12s ease-in-out infinite;
}

.glow-orb.delay {
    animation-delay: -6s;
}

.float-card {
    animation: floaty 9s ease-in-out infinite;
}

.float-card.delay {
    animation-delay: -4.5s;
}

@keyframes drift {
    0%,
    100% {
        transform: translate3d(0, 0, 0) scale(1);
    }

    50% {
        transform: translate3d(0, -20px, 0) scale(1.06);
    }
}

@keyframes floaty {
    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-10px);
    }
}

@media (prefers-reduced-motion: reduce) {
    .glow-orb,
    .float-card {
        animation: none;
    }
}
</style>
