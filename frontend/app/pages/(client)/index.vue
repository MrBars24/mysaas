<template>
  <NuxtLayout name="client">
    <!-- Hero Banner Promo Section -->
      <section class="relative overflow-hidden rounded-2xl bg-[#3E495E] text-white p-8 lg:p-12 shadow-sm">
        <div class="relative z-10 max-w-xl space-y-4">
          <span class="inline-block px-3 py-1 rounded-md text-[11px] font-bold tracking-wide uppercase bg-primary text-white">
            PROMO · FIRST200
          </span>
          <h1 class="text-3xl lg:text-4xl font-extrabold tracking-tight leading-tight">
            ₱200 off your first booking with us
          </h1>
          <p class="text-sm text-slate-300 leading-relaxed">
            Trusted service centers, transparent pricing, and easy online booking across Metro Manila.
          </p>
          <div class="pt-2">
            <button class="bg-primary hover:bg-primary-hover text-white text-sm font-semibold px-6 py-3 rounded-xl transition-all shadow-md active:scale-95">
              Find a Service Center
            </button>
          </div>
        </div>

        <!-- Hero Geometric Decorative Background Bubbles -->
        <div class="absolute -right-12 -bottom-20 w-80 h-80 rounded-full bg-white/5 pointer-events-none"></div>
        <div class="absolute -right-2 top-4 w-48 h-48 rounded-full bg-white/5 pointer-events-none"></div>
      </section>

      <!-- Browse By Category Section -->
      <section class="space-y-4">
        <div class="flex items-center justify-between">
          <h2 class="text-lg font-bold text-content-main">Browse by Category</h2>
          <NuxtLink to="/categories" class="text-xs font-semibold text-primary hover:underline">See all</NuxtLink>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
          <button
            v-for="category in categories"
            :key="category.name"
            class="bg-app-surface hover:shadow-md border border-border-subtle rounded-2xl p-5 flex flex-col items-center justify-center gap-3 transition-all group"
          >
            <div :class="[category.bgColor, 'w-12 h-12 rounded-xl flex items-center justify-center text-xl transition-transform group-hover:scale-105']">
              <span>{{ category.icon }}</span>
            </div>
            <span class="text-xs font-bold text-content-main">{{ category.name }}</span>
          </button>
        </div>
      </section>

      <!-- Nearby Service Centers Section -->
      <section class="space-y-4">
        <div class="flex items-center justify-between">
          <h2 class="text-lg font-bold text-content-main">Nearby Service Centers</h2>
          <NuxtLink to="/centers" class="text-xs font-semibold text-primary hover:underline">See all</NuxtLink>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div
            v-for="center in serviceCenters"
            :key="center.name"
            class="bg-app-surface border border-border-subtle rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all group cursor-pointer"
          >
            <!-- Card Image Placeholder Banner -->
            <div :class="[center.bannerBg, 'h-40 w-full relative']">
              <button class="absolute top-3 right-3 p-2 rounded-full bg-white/80 backdrop-blur-sm text-slate-500 hover:text-red-500 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 016.364 6.364L12 21.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/></svg>
              </button>
            </div>

            <!-- Card Content -->
            <div class="p-4 space-y-3">
              <div>
                <h3 class="font-bold text-content-main text-sm group-hover:text-primary transition-colors">
                  {{ center.name }}
                </h3>
                <p class="text-xs text-content-muted mt-0.5">
                  {{ center.location }} · {{ center.distance }}
                </p>
              </div>

              <div class="flex items-center justify-between pt-2 border-t border-border-subtle text-xs">
                <div class="flex items-center gap-1 font-semibold text-content-main">
                  <span class="text-amber-400">★</span>
                  <span>{{ center.rating }}</span>
                  <span class="text-content-muted font-normal">({{ center.reviews }})</span>
                </div>
                <div class="text-content-muted">
                  From <span class="font-bold text-content-main">₱{{ center.price }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  </NuxtLayout>
</template>

<script setup lang="ts">
definePageMeta({
  layout: false,
})

// Page dynamic mock state
const categories = [
  { name: 'Oil Change', icon: '🛢️', bgColor: 'bg-emerald-50 text-emerald-600' },
  { name: 'Brakes', icon: '⚙️', bgColor: 'bg-amber-50 text-amber-600' },
  { name: 'Tires', icon: '🎯', bgColor: 'bg-indigo-50 text-indigo-600' },
  { name: 'Battery', icon: '⚡', bgColor: 'bg-red-50 text-red-600' },
  { name: 'AC Repair', icon: '❄️', bgColor: 'bg-emerald-50 text-emerald-600' },
  { name: 'Detailing', icon: '🚗', bgColor: 'bg-slate-100 text-slate-600' }
]

const serviceCenters = [
  {
    name: 'AutoFix Express',
    location: 'Makati Branch',
    distance: '1.2 km',
    rating: 4.8,
    reviews: 210,
    price: 450,
    bannerBg: 'bg-gradient-to-tr from-emerald-600 to-teal-800'
  },
  {
    name: 'QuickLube Center',
    location: 'BGC Branch',
    distance: '2.8 km',
    rating: 4.6,
    reviews: 96,
    price: 380,
    bannerBg: 'bg-slate-600'
  },
  {
    name: 'Turbo Care Auto Center',
    location: 'Pasig Branch',
    distance: '6.1 km',
    rating: 4.9,
    reviews: 340,
    price: 500,
    bannerBg: 'bg-gradient-to-tr from-emerald-500 to-teal-600'
  }
]
</script>

<style scoped>

</style>