<template>
  <div class="flex h-screen w-screen bg-white overflow-hidden text-slate-900 font-sans antialiased">
    <!-- Left Sidebar -->
    <LayoutSidebar
      :is-components-open="isComponentsOpen"
      :component-sub-items="componentSubItems"
      :active-component-section="activeComponentSection"
      @component-selected="onComponentSelected"
    />

    <!-- Main Wrapper -->
    <div class="flex flex-1 flex-col overflow-hidden">
      <LayoutTopHeader :is-user-menu-open="isUserMenuOpen" />

      <main class="flex-1 overflow-y-auto p-6 md:p-8">
        <div class="mx-auto max-w-7xl space-y-8">
          <slot />
        </div>
      </main>
      <!-- <LayoutMainContent :is-modal-open="false" :active-component-section="activeComponentSection" :is-toggle-active="true"/> -->
    </div>
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

const componentSubItems = [
  { id: 'all', name: 'All Components' },
  { id: 'buttons', name: 'Buttons' },
  { id: 'forms', name: 'Form Elements' },
  { id: 'navigation', name: 'Navigation' },
  { id: 'feedback', name: 'Feedback' },
  { id: 'cards', name: 'Cards & Containers' },
  { id: 'datatable', name: 'Data Table' },
]

const onComponentSelected = (component: string): void => {
  activeComponentSection.value = component;
}
</script>

<style scoped>

</style>