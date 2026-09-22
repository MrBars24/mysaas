<template>
  <div>
    <div>
      <h1 class="text-xl font-semibold tracking-tight text-slate-900">UI Kit Components</h1>
      <p class="text-sm text-slate-500">Minimalist, reusable component library built with Tailwind CSS.</p>
    </div>

    <!-- 1. BUTTONS -->
    <section v-if="activeComponentSection === 'all' || activeComponentSection === 'buttons'" class="space-y-4">
      <h2 class="text-sm font-semibold tracking-tight text-slate-900 border-b border-slate-100 pb-2">Buttons</h2>

      <!-- Primary Style -->
      <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
        <h2 class="text-sm font-semibold uppercase tracking-wider text-content-muted">Primary Style</h2>
        <div class="flex flex-wrap items-center gap-4">
          <BaseButton variant="primary">Default</BaseButton>
          <BaseButton variant="primary" loading>Loading</BaseButton>
          <BaseButton variant="primary" disabled>Disabled</BaseButton>
          <BaseButton variant="primary" size="sm">Small</BaseButton>
          <BaseButton variant="primary" size="lg">Large</BaseButton>
        </div>
      </section>

      <!-- Secondary Style -->
      <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
        <h2 class="text-sm font-semibold uppercase tracking-wider text-content-muted">Secondary Style</h2>
        <div class="flex flex-wrap items-center gap-4">
          <BaseButton variant="secondary">Default</BaseButton>
          <BaseButton variant="secondary" loading>Loading</BaseButton>
          <BaseButton variant="secondary" disabled>Disabled</BaseButton>
        </div>
      </section>

      <!-- Accent Style -->
      <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
        <h2 class="text-sm font-semibold uppercase tracking-wider text-content-muted">Accent Style</h2>
        <div class="flex flex-wrap items-center gap-4">
          <BaseButton variant="accent">Default</BaseButton>
          <BaseButton variant="accent" loading>Loading</BaseButton>
          <BaseButton variant="accent" disabled>Disabled</BaseButton>
        </div>
      </section>

      <!-- Ghost Style -->
      <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
        <h2 class="text-sm font-semibold uppercase tracking-wider text-content-muted">Ghost Style</h2>
        <div class="flex flex-wrap items-center gap-4">
          <BaseButton variant="ghost">Ghost Button</BaseButton>
          <BaseButton variant="ghost" loading>Loading</BaseButton>
          <BaseButton variant="ghost" disabled>Disabled</BaseButton>
        </div>
      </section>

      <!-- Round / Pill Buttons -->
      <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
        <h2 class="text-sm font-semibold uppercase tracking-wider text-content-muted">Round / Pill Buttons</h2>
        <div class="flex flex-wrap items-center gap-4">
          <BaseButton shape="pill" variant="primary">Primary Pill</BaseButton>
          <BaseButton shape="pill" variant="secondary">Secondary Pill</BaseButton>
          <BaseButton shape="pill" variant="accent">Accent Pill</BaseButton>
          <BaseButton shape="pill" variant="ghost">Ghost Pill</BaseButton>
        </div>
      </section>

      <!-- Buttons with Leading & Trailing Icons -->
      <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
        <h2 class="text-sm font-semibold uppercase tracking-wider text-content-muted">Buttons with Icons</h2>
        <div class="flex flex-wrap items-center gap-4">
          <!-- Leading Icon -->
          <BaseButton variant="primary">
            <template #iconLeft>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            </template>
            New Booking
          </BaseButton>

          <!-- Trailing Icon -->
          <BaseButton variant="secondary" shape="pill">
            Export Report
            <template #iconRight>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            </template>
          </BaseButton>
        </div>
      </section>

      <!-- Circular Icon-Only Buttons -->
      <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
        <h2 class="text-sm font-semibold uppercase tracking-wider text-content-muted">Circular Icon Buttons</h2>
        <div class="flex flex-wrap items-center gap-4">
          <!-- Small Circle -->
          <BaseButton shape="circle" size="sm" variant="ghost">
            <template #icon>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            </template>
          </BaseButton>

          <!-- Medium Circle -->
          <BaseButton shape="circle" size="md" variant="primary">
            <template #icon>
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            </template>
          </BaseButton>

          <!-- Large Circle -->
          <BaseButton shape="circle" size="lg" variant="accent">
            <template #icon>
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            </template>
          </BaseButton>
        </div>
      </section>
    </section>

    <!-- TYPOGRAPHY -->
    <section v-if="activeComponentSection === 'all' || activeComponentSection === 'typography'" class="space-y-4">
      <h2 class="text-sm font-semibold tracking-tight text-slate-900 border-b border-slate-100 pb-2">Typography</h2>

      <div>
        <h2 class="text-h2">Typography System</h2>
        <span class="text-subtitle-2">
          Standardized, theme-aware typographic scales and weights across the app.
        </span>
      </div>

      <!-- Headings Scale -->
      <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
        <span class="text-overline">Headings (1 - 6)</span>
        <div class="space-y-3">
          <div><h1 class="text-h1">Heading 1 (48px)</h1></div>
          <div><h2 class="text-h2">Heading 2 (36px)</h2></div>
          <div><h3 class="text-h3">Heading 3 (30px)</h3></div>
          <div><h4 class="text-h4">Heading 4 (24px)</h4></div>
          <div><h5 class="text-h5">Heading 5 (20px)</h5></div>
          <div><h6 class="text-h6">Heading 6 (18px)</h6></div>
        </div>
      </section>

      <!-- Subtitles & Body -->
      <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
        <span class="text-overline">Subtitles & Body</span>
        <div class="space-y-4 max-w-3xl">
          <div>
            <span class="text-subtitle-1">Subtitle 1 — Medium weight text for section sub-headers.</span>
          </div>
          <div>
            <span class="text-subtitle-2">Subtitle 2 — Muted medium text for secondary labels.</span>
          </div>
          <div>
            <span class="text-body-1">
              Body 1 — Standard paragraph text used across card descriptions, main table columns, and general reading content. It features comfortable line-height for optimal readability.
            </span>
          </div>
          <div>
            <span class="text-body-2">
              Body 2 — Smaller body text for dense data tables, sidebar items, and secondary descriptions.
            </span>
          </div>
        </div>
      </section>

      <!-- Captions, Overlines & Added Utilities -->
      <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
        <span class="text-overline">Captions, Overline & Special Variants</span>
        <div class="space-y-4">
          <div>
            <span class="text-overline">Category Overline (10px uppercase)</span>
          </div>
          <div>
            <span class="text-caption">Caption — Used for timestamps, subtle metadata, and input help text.</span>
          </div>
          <div>
            <span class="text-lead text-primary">Lead Text — High-impact hero introduction phrase.</span>
            <!-- <BaseTypography variant="lead" color="primary">Lead Text — High-impact hero introduction phrase.</BaseTypography> -->
          </div>
          <div class="flex items-center gap-3">
            <span class="text-badge text-accent">Badge Text</span>
            <span class="text-code">const theme = 'tailwind'</span>
          </div>
        </div>
      </section>

      <!-- Font Weights Showcase -->
      <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
        <span class="text-overline">Font Weights (Thin to Bolder)</span>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-lg">
          <span class="text-body-1 font-thin">Thin Weight (100)</span>
          <span class="text-body-1 font-light">Light Weight (300)</span>
          <span class="text-body-1 font-regular">Regular Weight (400)</span>
          <span class="text-body-1 font-medium">Medium Weight (500)</span>
          <span class="text-body-1 font-semibold">Semibold Weight (600)</span>
          <span class="text-body-1 font-bold">Bold Weight (700)</span>
          <span class="text-body-1 font-bolder">Bolder / Black Weight (900)</span>
        </div>
      </section>
    </section>

    <!-- 2. FORM ELEMENTS -->
    <section v-if="activeComponentSection === 'all' || activeComponentSection === 'forms'" class="space-y-4">
      <h2 class="text-sm font-semibold tracking-tight text-slate-900 border-b border-slate-100 pb-2">Form Elements</h2>
      <div class="rounded-lg border border-slate-100 bg-white p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Text Input & Error State -->
        <div class="space-y-4">
          <div>
            <label class="block text-xs font-medium text-slate-700 mb-1">Standard Input</label>
            <input type="text" placeholder="Enter your text..." class="w-full rounded-md border border-slate-200 px-3 py-1.5 text-xs text-slate-900 placeholder-slate-400 focus:border-slate-400 focus:outline-none" />
          </div>
          <div>
            <label class="block text-xs font-medium text-slate-700 mb-1">Input with Error</label>
            <input type="text" value="invalid-email@" class="w-full rounded-md border border-rose-300 bg-rose-50/20 px-3 py-1.5 text-xs text-slate-900 focus:border-rose-500 focus:outline-none" />
            <span class="mt-1 block text-[11px] text-rose-500">Please enter a valid email address.</span>
          </div>
        </div>

        <!-- Select Dropdown -->
        <div class="space-y-4">
          <div>
            <label class="block text-xs font-medium text-slate-700 mb-1">Select Dropdown</label>
            <select class="w-full rounded-md border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-700 focus:border-slate-400 focus:outline-none">
              <option>Option 1</option>
              <option>Option 2</option>
              <option>Option 3</option>
            </select>
          </div>

          <!-- Checkboxes & Radio Buttons -->
          <div class="flex items-center gap-6 pt-2">
            <label class="flex items-center gap-2 text-xs text-slate-700 cursor-pointer">
              <input type="checkbox" checked class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900" />
              Checkbox
            </label>
            <label class="flex items-center gap-2 text-xs text-slate-700 cursor-pointer">
              <input type="radio" name="radio-group" checked class="h-4 w-4 border-slate-300 text-slate-900 focus:ring-slate-900" />
              Option A
            </label>
            <label class="flex items-center gap-2 text-xs text-slate-700 cursor-pointer">
              <input type="radio" name="radio-group" class="h-4 w-4 border-slate-300 text-slate-900 focus:ring-slate-900" />
              Option B
            </label>
          </div>

          <!-- Toggle Switch -->
          <div class="flex items-center gap-3 pt-1">
            <button
              @click="isToggleActive = !isToggleActive"
              :class="['relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none', isToggleActive ? 'bg-slate-900' : 'bg-slate-200']"
            >
              <span :class="['pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out', isToggleActive ? 'translate-x-4' : 'translate-x-0']" />
            </button>
            <span class="text-xs text-slate-700">Toggle switch label</span>
          </div>
        </div>

      </div>
    </section>

    <!-- 3. NAVIGATION -->
    <section v-if="activeComponentSection === 'all' || activeComponentSection === 'navigation'" class="space-y-4">
      <h2 class="text-sm font-semibold tracking-tight text-slate-900 border-b border-slate-100 pb-2">Navigation</h2>
      <div class="rounded-lg border border-slate-100 bg-white p-6 space-y-6">

        <!-- Breadcrumbs -->
        <div>
          <span class="text-xs font-medium text-slate-400 block mb-2">Breadcrumbs</span>
          <nav class="flex text-xs text-slate-500 gap-2 items-center">
            <a href="#" class="hover:text-slate-900">Home</a>
            <span>/</span>
            <a href="#" class="hover:text-slate-900">Settings</a>
            <span>/</span>
            <span class="font-medium text-slate-900">Security</span>
          </nav>
        </div>

        <!-- Tabs -->
        <div>
          <span class="text-xs font-medium text-slate-400 block mb-2">Tabs</span>
          <div class="border-b border-slate-100 flex gap-4 text-xs font-medium">
            <button class="border-b-2 border-slate-900 pb-2 text-slate-900">Account</button>
            <button class="border-b-2 border-transparent pb-2 text-slate-500 hover:text-slate-900">Notifications</button>
            <button class="border-b-2 border-transparent pb-2 text-slate-500 hover:text-slate-900">Integrations</button>
          </div>
        </div>

        <!-- Pagination Controls -->
        <div>
          <span class="text-xs font-medium text-slate-400 block mb-2">Pagination</span>
          <div class="flex items-center justify-between border-t border-slate-100 pt-3">
            <span class="text-xs text-slate-500">Page 1 of 10</span>
            <div class="flex gap-1">
              <button class="rounded border border-slate-200 px-2.5 py-1 text-xs text-slate-600 hover:bg-slate-50">Prev</button>
              <button class="rounded bg-slate-900 px-2.5 py-1 text-xs text-white">1</button>
              <button class="rounded border border-slate-200 px-2.5 py-1 text-xs text-slate-600 hover:bg-slate-50">2</button>
              <button class="rounded border border-slate-200 px-2.5 py-1 text-xs text-slate-600 hover:bg-slate-50">3</button>
              <button class="rounded border border-slate-200 px-2.5 py-1 text-xs text-slate-600 hover:bg-slate-50">Next</button>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- 4. FEEDBACK -->
    <section v-if="activeComponentSection === 'all' || activeComponentSection === 'feedback'" class="space-y-4">
      <h2 class="text-sm font-semibold tracking-tight text-slate-900 border-b border-slate-100 pb-2">Feedback</h2>
      <div class="rounded-lg border border-slate-100 bg-white p-6 space-y-4">

        <!-- Alert & Banner -->
        <div class="rounded-md border border-amber-200 bg-amber-50/50 p-3 text-xs text-amber-800 flex items-center justify-between">
          <span><strong>Warning:</strong> Your password expires in 3 days.</span>
          <button class="text-amber-900 font-medium underline">Update</button>
        </div>

        <div class="rounded-md border border-slate-200 bg-slate-50 p-3 text-xs text-slate-700 flex items-center justify-between">
          <span>System maintenance scheduled for tonight at 12:00 AM UTC.</span>
          <button class="text-xs text-slate-400 hover:text-slate-600">Dismiss</button>
        </div>

        <!-- Tooltip & Spinners -->
        <div class="flex items-center gap-6 pt-2">
          <div class="relative group inline-block">
            <button class="rounded border border-slate-200 px-3 py-1.5 text-xs text-slate-700">Hover for Tooltip</button>
            <div class="absolute bottom-full mb-2 hidden group-hover:block rounded bg-slate-900 px-2 py-1 text-[10px] text-white whitespace-nowrap shadow">
              Tooltip info text
            </div>
          </div>

          <div class="flex items-center gap-3 text-xs text-slate-500">
            <svg class="h-4 w-4 animate-spin text-slate-900" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Loading spinner</span>
          </div>

          <!-- Modal Trigger Button -->
          <button @click="isModalOpen = true" class="rounded bg-slate-900 px-3 py-1.5 text-xs text-white">Open Modal</button>
        </div>

      </div>
    </section>

    <!-- 5. CARDS & CONTAINERS -->
    <section v-if="activeComponentSection === 'all' || activeComponentSection === 'cards'" class="space-y-4">
      <h2 class="text-sm font-semibold tracking-tight text-slate-900 border-b border-slate-100 pb-2">Cards & Containers</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <!-- Content Card -->
        <div class="rounded-lg border border-slate-100 bg-white p-5 space-y-3">
          <div class="flex items-center justify-between">
            <h3 class="text-xs font-semibold text-slate-900">Standard Card</h3>
            <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded">Badge</span>
          </div>
          <p class="text-xs text-slate-500 leading-relaxed">
            Basic card container layout for grouping related content and displaying high-level actionable metrics.
          </p>
          <div class="pt-2 border-t border-slate-100 flex justify-end">
            <button class="text-xs font-medium text-slate-900 hover:underline">Action Link &rarr;</button>
          </div>
        </div>

        <!-- Metric Card -->
        <div v-for="kpi in kpis.slice(0, 1)" :key="kpi.label" class="rounded-lg border border-slate-100 bg-white p-5 shadow-xs">
          <div class="flex items-center justify-between">
            <span class="text-xs font-medium text-slate-500">{{ kpi.label }}</span>
            <span :class="['inline-flex items-center rounded-md px-2 py-0.5 text-xs font-medium', kpi.positive ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600']">
              {{ kpi.trend }}
            </span>
          </div>
          <div class="mt-3 text-2xl font-bold tracking-tight text-slate-900">
            {{ kpi.value }}
          </div>
        </div>

      </div>
    </section>

    <!-- 6. DATA TABLE -->
    <section v-if="activeComponentSection === 'all' || activeComponentSection === 'datatable'" class="space-y-4">
      <h2 class="text-sm font-semibold tracking-tight text-slate-900 border-b border-slate-100 pb-2">Data Table</h2>
      <section class="rounded-lg border border-slate-100 bg-white">
        <div class="border-b border-slate-100 px-6 py-4">
          <h2 class="text-sm font-semibold text-slate-900">Admin Recent Transactions</h2>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-left text-sm text-slate-600">
            <thead class="border-b border-slate-100 bg-slate-50/50 text-xs font-medium text-slate-500">
              <tr>
                <th scope="col" class="px-6 py-3">Customer</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Amount</th>
                <th scope="col" class="px-6 py-3">Date</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              <tr v-for="tx in transactions" :key="tx.id" class="hover:bg-slate-50/50">
                <td class="whitespace-nowrap px-6 py-4 font-medium text-slate-900">
                  {{ tx.customer }}
                </td>
                <td class="whitespace-nowrap px-6 py-4">
                  <span class="inline-flex items-center gap-1.5 text-xs text-slate-600">
                    <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                    {{ tx.status }}
                  </span>
                </td>
                <td class="whitespace-nowrap px-6 py-4 text-slate-900">
                  {{ tx.amount }}
                </td>
                <td class="whitespace-nowrap px-6 py-4 text-xs text-slate-400">
                  {{ tx.date }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="flex items-center justify-between border-t border-slate-100 px-6 py-3">
          <span class="text-xs text-slate-500">Showing 1 to 4 of 32 results</span>
          <div class="flex gap-2">
            <button class="rounded-md border border-slate-200 px-3 py-1 text-xs text-slate-600 hover:bg-slate-50">Previous</button>
            <button class="rounded-md border border-slate-200 px-3 py-1 text-xs text-slate-600 hover:bg-slate-50">Next</button>
          </div>
        </div>
      </section>
      <section class="space-y-3">
        <h3 class="text-sm font-semibold text-slate-900">Client-Side Data Table (Local Sorting & Search)</h3>

        <DataTable
          mode="client"
          :columns="tableColumns"
          :data="clientData"
          :page-size="3"
          search-placeholder="Filter transactions..."
        >
          <!-- Custom Cell Template for Status -->
          <template #cell(status)="{ value }">
            <span :class="[
              'inline-flex items-center gap-1.5 text-xs font-medium px-2 py-0.5 rounded-full',
              value === 'Completed' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700'
            ]">
              <span :class="['h-1.5 w-1.5 rounded-full', value === 'Completed' ? 'bg-emerald-500' : 'bg-amber-500']"></span>
              {{ value }}
            </span>
          </template>

          <!-- Custom Cell Template for Amount -->
          <template #cell(amount)="{ value }">
            <span class="font-mono text-slate-900 font-medium">{{ value }}</span>
          </template>
        </DataTable>
      </section>

      <!-- Server-Side Rendered Data Table -->
      <section class="space-y-3 pt-6 border-t border-slate-100">
        <h3 class="text-sm font-semibold text-slate-900">Server-Side Data Table (Emits Events for API Call)</h3>

        <DataTable
          mode="server"
          :columns="tableColumns"
          :data="serverData"
          :total-items="serverTotal"
          :loading="isServerLoading"
          :page-size="5"
          @server-change="handleServerFetch"
        >
          <template #cell(status)="{ value }">
            <span class="text-xs text-slate-600">{{ value }}</span>
          </template>
        </DataTable>
      </section>
    </section>
  </div>
</template>

<script setup lang="ts">
import DataTable, { type Column } from '~/components/DataTable.vue'

const nuxtApp = useNuxtApp()

const activeComponentSection = ref<string>('all');

// Listen to the custom hook
nuxtApp.hook('sidebar:selected', (sectionId) => {
  activeComponentSection.value = sectionId;
})

const kpis = [
  { label: 'Total Revenue', value: '$128,420', trend: '+12.5%', positive: true },
  { label: 'Active Users', value: '2,845', trend: '+4.1%', positive: true },
  { label: 'Conversion Rate', value: '3.2%', trend: '-0.4%', positive: false },
  { label: 'Avg Order Value', value: '$84.00', trend: '+1.8%', positive: true },
]

const transactions = [
  { id: 1, customer: 'Acme Corp', status: 'Completed', amount: '$1,200.00', date: 'Oct 24, 2026' },
  { id: 2, customer: 'Starlight Inc', status: 'Pending', amount: '$850.00', date: 'Oct 24, 2026' },
  { id: 3, customer: 'Vercel LLC', status: 'Completed', amount: '$2,400.00', date: 'Oct 23, 2026' },
  { id: 4, customer: 'Linear Systems', status: 'Completed', amount: '$450.00', date: 'Oct 22, 2026' },
]


// Table Header Schema
const tableColumns: Column[] = [
  { key: 'customer', label: 'Customer', sortable: true },
  { key: 'status', label: 'Status', sortable: true },
  { key: 'amount', label: 'Amount', sortable: true, align: 'right' },
  { key: 'date', label: 'Date', sortable: true, align: 'right' },
]

// Mock Client Data
const clientData = ref([
  { id: 1, customer: 'Acme Corp', status: 'Completed', amount: '$1,200.00', date: '2026-10-24' },
  { id: 2, customer: 'Starlight Inc', status: 'Pending', amount: '$850.00', date: '2026-10-24' },
  { id: 3, customer: 'Vercel LLC', status: 'Completed', amount: '$2,400.00', date: '2026-10-23' },
  { id: 4, customer: 'Linear Systems', status: 'Completed', amount: '$450.00', date: '2026-10-22' },
])

// Server Mode States
const isServerLoading = ref(false)
const serverTotal = ref(20)
const serverData = ref([
  { id: 101, customer: 'Server User A', status: 'Completed', amount: '$3,100.00', date: '2026-10-25' },
  { id: 102, customer: 'Server User B', status: 'Pending', amount: '$120.00', date: '2026-10-25' },
])

// Server Change Handler
const handleServerFetch = async (params: { page: number; search: string; sortKey: string; sortOrder: string }) => {
  isServerLoading.value = true
  console.log('Fetching server data with params:', params)

  // Simulate API delay
  setTimeout(() => {
    isServerLoading.value = false
  }, 600)
}
</script>

<style scoped>

</style>