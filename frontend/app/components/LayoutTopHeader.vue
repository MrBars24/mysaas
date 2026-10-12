<template>
  <!-- Sticky Top Header -->
  <header class="sticky top-0 z-20 flex h-16 w-full items-center justify-between border-b border-slate-100 bg-white/80 px-6 backdrop-blur">
    <!-- Search Bar -->
    <div class="relative w-full max-w-xs">
      <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
      </svg>
      <input
        type="text"
        placeholder="Search..."
        class="w-full rounded-md border border-slate-200 bg-transparent py-1.5 pl-9 pr-3 text-sm text-slate-900 placeholder-slate-400 focus:border-slate-400 focus:outline-none"
      />
    </div>

    <!-- Header Actions -->
    <div class="flex items-center gap-4">
      <!-- Notification Icon -->
      <button class="relative rounded-md p-1.5 text-slate-500 hover:bg-slate-50 hover:text-slate-900" aria-label="Notifications">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        <span class="absolute right-1.5 top-1.5 h-2 w-2 rounded-full bg-slate-900"></span>
      </button>

      <!-- User Profile Dropdown Placeholder -->
      <div class="relative">
        <button @click="isUserMenuOpen = !isUserMenuOpen" class="flex items-center gap-2 text-sm font-medium text-slate-700">
          <div class="h-8 w-8 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-xs">
            JD
          </div>
        </button>

        <div v-if="isUserMenuOpen" class="absolute right-0 mt-2 w-48 rounded-md border border-slate-100 bg-white py-1 shadow-lg">
          <a href="#" class="block px-4 py-2 text-xs text-slate-700 hover:bg-slate-50">Profile Settings</a>
          <a href="#" class="block px-4 py-2 text-xs text-slate-700 hover:bg-slate-50">Support</a>
          <div class="border-t border-slate-100"></div>
          <a href="#" class="block px-4 py-2 text-xs text-slate-700 hover:bg-slate-50">Sign Out</a>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup lang="ts">

defineProps<{
  isUserMenuOpen: boolean
}>()

</script>

<style scoped>

</style>