<template>
  <!-- Main Scrollable Content Area -->
  <main class="flex-1 overflow-y-auto p-6 md:p-8">
    <div class="mx-auto max-w-7xl space-y-8">


    </div>
  </main>
</template>

<script setup lang="ts">
import BaseButton from './BaseButton.vue';

defineProps<{
  activeComponentSection: string
  isToggleActive: boolean
  isModalOpen: boolean
}>()

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
</script>

<style scoped>

</style>