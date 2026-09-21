<template>
  <!-- Left Sidebar -->
  <aside class="relative z-30 shrink-0 h-full">
    <!-- Top Section -->
    <div :class="[
      'bg-sidebar text-sidebar-text space-y-6 relative z-30 h-full inset-y-0 left-0 z-30 p-4 flex flex-col border-r border-slate-100 transition-all duration-200 lg:static',
      isSidebarCollapsed ? 'w-16' : 'w-64'
    ]">
      <!-- App Brand Header -->
      <div class="flex items-center justify-between gap-3 px-2 pt-2">
        <div class="flex items-center gap-3 overflow-hidden">
          <div class="h-10 w-10 rounded-xl bg-primary flex items-center justify-center font-bold text-white text-base shadow-sm">
            RC
          </div>
          <span class="text-lg font-bold tracking-tight text-white">RamCap</span>
        </div>
        <button
          @click="isSidebarCollapsed = !isSidebarCollapsed"
          class="hidden rounded-md p-1.5 text-slate-400 hover:bg-slate-50 hover:text-slate-600 lg:block"
          aria-label="Toggle Sidebar"
        >
          <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
          </svg>
        </button>
      </div>

      <!-- Tenant / Branch Switcher Card -->
      <div class="bg-white/5 border border-white/10 rounded-xl p-3 flex items-center justify-between cursor-pointer hover:bg-white/10 transition-colors">
        <div class="flex items-center gap-3">
          <div class="h-8 w-8 rounded-lg bg-emerald-500/80 flex items-center justify-center">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
          </div>
          <div class="flex flex-col">
            <span class="text-xs font-bold text-white leading-snug">AutoFix Express</span>
            <span class="text-[11px] text-sidebar-muted">All Branches</span>
          </div>
        </div>
        <svg class="w-4 h-4 text-sidebar-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
      </div>

      <div class="flex-1 overflow-y-auto pr-1 space-y-5 custom-scrollbar">
        <!-- Navigation Sections -->
        <nav class="space-y-5">
          <div v-for="section in menuSections" :key="section.title" class="space-y-1">
            <!-- Category Title -->
            <div class="text-sidebar-muted text-xs font-bold uppercase tracking-wider mb-2">{{ section.title }}</div>

            <!-- Navigation Items -->
            <div
              v-for="item in section.items"
              :key="item.name"
            >

              <div v-if="item.children && item.children.length">
                <button
                  @click="toggleDropdown(item.name)"
                  :class="[
                    'flex w-full items-center justify-between rounded-md px-3 py-2 text-sm font-medium transition-colors',
                    activeNav === item.name || isChildActive(item)
                      ? 'bg-primary/10 text-primary'
                      : 'text-sidebar-text hover:bg-white/5 hover:text-white'
                  ]"
                >
                  <div class="flex items-center gap-3">
                    <component :is="item.icon" class="h-4 w-4 shrink-0" />
                    <span v-if="!isSidebarCollapsed">{{ item.name }}</span>
                  </div>
                  <svg
                    v-if="!isSidebarCollapsed"
                    :class="['h-3.5 w-3.5 text-slate-400 transition-transform duration-200', openDropdowns.includes(item.name) ? 'rotate-90' : '']"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
                </button>

                <!-- Dropdown Children -->
                <div
                  v-show="openDropdowns.includes(item.name) && !isSidebarCollapsed"
                  class="mt-1 space-y-1 pl-9 pr-2"
                >
                  <NuxtLink
                    v-for="child in item.children"
                    :key="child.name"
                    :to="child.to"
                    :class="[
                      'block rounded-md px-3 py-1.5 text-xs font-medium transition-colors cursor-pointer',
                      activeNav === child.name
                        ? 'bg-primary/20 text-white font-semibold'
                        : 'text-sidebar-muted hover:text-white hover:bg-white/5'
                    ]"
                    @click="toggleDropdownChild(child)"
                  >
                    {{ child.name }}
                  </NuxtLink>
                </div>
              </div>

              <NuxtLink
                v-else
                :to="item.to"
                :class="[
                  'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-150',
                  activeNav === item.id
                    ? 'bg-primary/20 text-white font-semibold'
                    : 'text-sidebar-muted hover:text-white hover:bg-white/5'
                ]"
                @click="activeNav = item.id"
              >
                <!-- Dynamic SVG Icon -->
                <component :is="item.icon" class="w-4 h-4 shrink-0" />
                <span>{{ item.name }}</span>
              </NuxtLink>
            </div>
          </div>
        </nav>
      </div>

      <!-- 3. Footer Profile (Fixed Bottom) -->
      <div class="shrink-0 pt-4 border-t border-white/5 space-y-3">

        <!-- Interactive User Profile Card -->
        <button
          type="button"
          :class="[
            'w-full flex items-center justify-between px-3 py-2.5 rounded-xl border transition-all text-left',
            isProfileOpen
              ? 'bg-white/10 border-white/20 text-white'
              : 'bg-white/5 border-white/5 hover:bg-white/10 hover:border-white/10 text-sidebar-muted hover:text-white'
          ]"
          @click="isProfileOpen = !isProfileOpen"
        >
          <div class="flex items-center gap-3 min-w-0">
            <div class="h-8 w-8 rounded-lg bg-slate-600 flex items-center justify-center text-caption font-bold !text-white shrink-0">
              MR
            </div>
            <div class="flex flex-col min-w-0">
              <span class="text-subtitle-2 !text-white truncate">Miguel Reyes</span>
              <span class="text-caption !text-sidebar-muted">Owner</span>
            </div>
          </div>
          <svg
            :class="['w-4 h-4 shrink-0 transition-transform duration-200', isProfileOpen ? 'rotate-180 text-white' : 'text-sidebar-muted']"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>

        <!-- Profile Context Popup Menu -->
        <transition
          enter-active-class="transition duration-150 ease-out"
          enter-from-class="transform scale-95 opacity-0 translate-y-2"
          enter-to-class="transform scale-100 opacity-100 translate-y-0"
          leave-active-class="transition duration-100 ease-in"
          leave-from-class="transform scale-100 opacity-100 translate-y-0"
          leave-to-class="transform scale-95 opacity-0 translate-y-2"
        >
          <div
            v-show="isProfileOpen"
            class="absolute bottom-16 left-0 right-0 z-50 bg-sidebar border border-white/10 rounded-xl shadow-2xl p-1.5 space-y-1 backdrop-blur-md"
          >
            <!-- Account Info Header -->
            <div class="px-3 py-2 border-b border-white/10">
              <p class="text-caption font-semibold !text-white">Miguel Reyes</p>
              <p class="text-caption text-sidebar-muted truncate">miguel@pogs.com</p>
            </div>

            <!-- Menu Action Links -->
            <NuxtLink
              to="/profile"
              class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-body-2 !text-sidebar-muted hover:text-white hover:bg-white/10 transition-colors"
              @click="isProfileOpen = false"
            >
              <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              <span>View Profile</span>
            </NuxtLink>

            <NuxtLink
              to="/preferences"
              class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-body-2 !text-sidebar-muted hover:text-white hover:bg-white/10 transition-colors"
              @click="isProfileOpen = false"
            >
              <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
              </svg>
              <span>Preferences</span>
            </NuxtLink>

            <div class="border-t border-white/10 my-1"></div>

            <!-- Sign Out Action -->
            <button
              type="button"
              class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-body-2 !text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-colors"
              @click="handleSignOut"
            >
              <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
              </svg>
              <span>Sign Out</span>
            </button>
          </div>
        </transition>
      </div>
    </div>

    <!-- Bottom Profile Indicator -->
    <!-- <div class="border-t border-slate-100 p-3">
      <div class="flex items-center gap-3 rounded-md p-2">
        <div class="h-8 w-8 shrink-0 rounded-full bg-slate-200 flex items-center justify-center font-medium text-xs text-slate-700">
          JD
        </div>
        <div v-if="!isSidebarCollapsed" class="flex flex-col min-w-0 flex-1">
          <span class="truncate text-xs font-medium text-slate-900">Jane Doe</span>
          <span class="truncate text-xs text-slate-500">jane@apex.io</span>
        </div>
      </div>
    </div> -->
  </aside>
</template>

<script setup lang="ts">
import { useAuthStore } from '~/stores/auth'

const route = useRoute()
const nuxtApp = useNuxtApp()
const authStore = useAuthStore();

const isSidebarCollapsed = ref(false)
const openDropdowns = ref<string[]>([])
const activeNav = ref(route.name)
const isProfileOpen = ref(false);

watch(
  () => route.name,
  (newName, oldName) => {
    console.log(newName);
    if (typeof newName === 'string') {
      openDropdowns.value.push(newName)
    }
  },
  {
    immediate: true
  }
)

// Icon Definitions matching the wireframe
const IconDashboard = () => h('svg', { class: 'w-4 h-4', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6' })
])
const IconBookings = () => h('svg', { class: 'w-4 h-4', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01' })
])
const IconCalendar = () => h('svg', { class: 'w-4 h-4', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z' })
])
const IconFrontDesk = () => h('svg', { class: 'w-4 h-4', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1' })
])
const IconServices = () => h('svg', { class: 'w-4 h-4', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z' })
])
const IconBranches = () => h('svg', { class: 'w-4 h-4', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z' }),
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M15 11a3 3 0 11-6 0 3 3 0 016 0z' })
])
const IconStaff = () => h('svg', { class: 'w-4 h-4', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z' })
])
const IconClock = () => h('svg', { class: 'w-4 h-4', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' })
])
const IconCustomers = () => h('svg', { class: 'w-4 h-4', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z' })
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
const IconComponents = () => h('svg', { class: 'h-4 w-4', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
  h('rect', { x: '3', y: '3', width: '18', height: '18', rx: '2', ry: '2' }),
  h('path', { d: 'M3 9h18' }),
  h('path', { d: 'M9 21V9' })
])

const emit = defineEmits<{
  componentSelected: [value: string]
}>()

defineProps<{
  isComponentsOpen: boolean
  componentSubItems: Record<string, any>[]
  activeComponentSection: string
}>()

// Categorized Navigation Menu Data
const menuSections = [
  {
    title: 'Overview',
    items: [
      { id: "dashboard", name: 'Dashboard', to: '/', icon: IconDashboard },
      { id: "staff", name: 'Staff', to: '/staff', icon: IconStaff },
      { id: "customers", name: 'Customers', to: '/customers', icon: IconCustomers },
      { id: "schedule", name: 'Schedule & Time Off', to: '/schedule', icon: IconClock },
    ]
  },
  {
    title: 'Operations',
    items: [
      { id: "bookings", name: 'Bookings', to: '/bookings', icon: IconBookings },
      { id: "calendar", name: 'Calendar', to: '/calendar', icon: IconCalendar },
    ]
  },
  {
    title: 'Catalog',
    items: [
      { id: "services", name: 'Services', to: '/services', icon: IconServices },
      { id: "branches", name: 'Branches', to: '/branches', icon: IconBranches },
      {
        id: "components", name: 'Components',
        icon: IconComponents,
        children: [
          { id: "components", name: 'All Components', to: '/components' },
          { id: "buttons", name: 'Buttons', section: 'buttons' },
          { id: "typography", name: 'Typography', section: 'typography' },
          { id: "forms", name: 'Form Elements', section: 'forms' },
          { id: "navigation", name: 'Navigation', section: 'navigation' },
          { id: "feedback", name: 'Feedback', section: 'feedback' },
          { id: "cards", name: 'Cards & Containers', section: 'cards' },
          { id: "datatable", name: 'Data Table', section: 'datatable' },
        ]
      }
    ]
  },
]

const toggleDropdownChild = (child: any) => {
  if (child?.section) {
    nuxtApp.callHook('sidebar:selected', child.section);
  } else {
    activeNav.value = child.name

    if (child.name === "All Components") {
      nuxtApp.callHook('sidebar:selected', "all");
    }
  }
}

const toggleDropdown = (name: string) => {
  if (isSidebarCollapsed.value) {
    isSidebarCollapsed.value = false
  }
  const index = openDropdowns.value.indexOf(name)
  if (index > -1) {
    openDropdowns.value.splice(index, 1)
  } else {
    openDropdowns.value.push(name)
  }
}

// Handle Sign Out Action
const handleSignOut = () => {
  isProfileOpen.value = false
  // Implement sign out logic or route navigation here

  authStore.clearAuth();
  navigateTo('/login')
}

const isChildActive = (item: any) => {
  return item.children?.some((child: any) => child.name === activeNav.value)
}

</script>

<style scoped>
/* Custom subtle scrollbar styling */
.custom-scrollbar::-webkit-scrollbar {
  width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.1);
  border-radius: 4px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 255, 255, 0.2);
}
</style>