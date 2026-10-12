<template>
  <section v-if="activeComponentSection === 'all' || activeComponentSection === 'buttons'" class="space-y-4 mt-3">
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

    <section class="rounded-xl border border-slate-100 bg-white p-6 space-y-4">
      <h2 class="text-sm font-semibold uppercase tracking-wider text-content-muted">Standard Variants</h2>
      <div class="flex flex-wrap items-center gap-4">

        <!-- Primary Dropdown -->
        <ButtonDropdown
          label="Primary Actions"
          variant="primary"
          :items="actionItems"
        />

        <!-- Secondary Dropdown -->
        <ButtonDropdown
          label="Secondary Actions"
          variant="secondary"
          :items="actionItems"
        />

        <!-- Ghost Style -->
        <ButtonDropdown
          label="More Options"
          variant="ghost"
          :items="actionItems"
        />
      </div>
    </section>

    <!-- Section 2: Split Button Mode -->
    <section class="rounded-xl border border-slate-100 bg-white p-6 space-y-4">
      <h2 class="text-sm font-semibold uppercase tracking-wider text-content-muted">Split Buttons</h2>
      <div class="flex flex-wrap items-center gap-4">

        <!-- Split Primary Button -->
        <ButtonDropdown
          split
          label="Create Invoice"
          variant="primary"
          :items="actionItems"
          @main-click="handleMainAction('Create Invoice')"
        />

        <!-- Split Secondary Button -->
        <ButtonDropdown
          split
          label="Export Report"
          variant="secondary"
          :items="actionItems"
          @main-click="handleMainAction('Export Report')"
        />
      </div>
    </section>

    <!-- Section 3: Placements -->
    <section class="rounded-xl border border-slate-100 bg-white p-6 space-y-4">
      <h2 class="text-sm font-semibold uppercase tracking-wider text-content-muted">Menu Placements</h2>
      <div class="flex flex-wrap items-center gap-6 pt-12">

        <ButtonDropdown
          label="Top Right"
          variant="secondary"
          placement="top-right"
          :items="actionItems"
        />

        <ButtonDropdown
          label="Bottom Right"
          variant="secondary"
          placement="bottom-right"
          :items="actionItems"
        />
      </div>
    </section>
  </section>
</template>

<script setup lang="ts">
import ButtonDropdown, { type DropdownItem } from '~/components/ButtonDropdown.vue'

interface Props {
  activeComponentSection?: string
}

const props = withDefaults(defineProps<Props>(), {
  activeComponentSection: 'all',
})

const actionItems: DropdownItem[] = [
  { label: 'Edit Profile', badge: '⌘E' },
  { label: 'Duplicate Item', badge: '⌘D' },
  { label: 'Disabled Option', disabled: true },
  { divider: true },
  { label: 'Delete Item', danger: true, badge: '⌘⌫' }
]

const handleMainAction = (actionName: string) => {
  alert(`Clicked main action: ${actionName}`)
}

</script>

<style scoped>

</style>