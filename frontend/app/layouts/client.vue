<template>
  <div class="min-h-screen bg-app-bg text-content-main flex flex-col font-sans">
    <!-- Top Header Navigation -->
    <header class="sticky top-0 z-50 bg-app-surface border-b border-border-subtle shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-4">

        <!-- Left: Brand Logo & Links -->
        <div class="flex items-center gap-8">
          <NuxtLink to="/" class="flex items-center gap-2.5">
            <div class="w-9 h-9 rounded-xl bg-primary text-white font-bold text-sm flex items-center justify-center shadow-sm">
              RC
            </div>
            <span class="font-bold text-lg text-content-main tracking-tight">RamCap</span>
          </NuxtLink>

          <nav class="hidden md:flex items-center gap-6">
            <NuxtLink
              to="/"
              class="text-sm font-semibold text-primary border-b-2 border-primary pb-5 pt-5"
            >
              Home
            </NuxtLink>
            <NuxtLink
              to="/services"
              class="text-sm font-medium text-content-muted hover:text-content-main transition-colors pb-5 pt-5"
            >
              Services
            </NuxtLink>
            <NuxtLink
              to="/my-bookings"
              class="text-sm font-medium text-content-muted hover:text-content-main transition-colors pb-5 pt-5"
            >
              My Bookings
            </NuxtLink>
          </nav>
        </div>

        <!-- Right: Global Search & User Actions -->
        <div class="flex items-center gap-3">
          <!-- Search Bar -->
          <div class="relative w-64 lg:w-80 hidden sm:block">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-content-muted">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <input
              type="text"
              placeholder="Search service centers, services..."
              class="w-full pl-9 pr-4 py-2 text-xs bg-slate-100/80 border-0 rounded-lg text-content-main placeholder:text-content-muted focus:ring-2 focus:ring-primary focus:bg-app-surface transition-all outline-none"
            />
          </div>

          <!-- Notification Indicator -->
          <button class="relative p-2 rounded-xl text-content-muted hover:bg-slate-100 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-red-500"></span>
          </button>

          <!-- Profile Badge Dropdown -->
          <button class="flex items-center gap-1.5 pl-2">
            <div class="w-8 h-8 rounded-xl bg-primary text-white text-xs font-semibold flex items-center justify-center">
              AR
            </div>
            <svg class="w-4 h-4 text-content-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
          </button>
        </div>

      </div>
    </header>

    <!-- Page Body -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-8">
      <slot />
    </main>
  </div>
</template>

<script setup lang="ts">
import { ref, h } from 'vue'
import LayoutSidebar from '../components/LayoutSidebar.vue'
import LayoutTopHeader from '../components/LayoutTopHeader.vue'
import LayoutMainContent from '../components/LayoutMainContent.vue'

const nuxtApp = useNuxtApp()

const isUserMenuOpen = ref(false)
const isComponentsOpen = ref(true)
const activeComponentSection = ref('all')

// Inline SVG Icon components for clean component references
const IconDashboard = () => h('svg', { class: 'h-4 w-4', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z' })
])
const IconAnalytics = () => h('svg', { class: 'h-4 w-4', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z' })
])
const IconUsers = () => h('svg', { class: 'h-4 w-4', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z' })
])
const IconSettings = () => h('svg', { class: 'h-4 w-4', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z' }),
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M15 12a3 3 0 11-6 0 3 3 0 016 0z' })
])

const navItems = [
  { name: 'Dashboard', to: '#', icon: IconDashboard },
  { name: 'Analytics', to: '#', icon: IconAnalytics },
  { name: 'Users', to: '#', icon: IconUsers },
  { name: 'Settings', to: '#', icon: IconSettings },
]

const onComponentSelected = (component: string): void => {
  activeComponentSection.value = component;
}
</script>

<style scoped>

</style>