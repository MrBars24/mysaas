<template>
  <NuxtLayout name="client">
    <div>
      <!-- Section Header -->
      <div>
        <h1 class="text-xl font-semibold tracking-tight text-slate-900">Overview</h1>
        <p class="text-sm text-slate-500">Key performance metrics and recent transaction activity.</p>
      </div>

      <!-- Summary Cards -->
      <section class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div
          v-for="kpi in kpis"
          :key="kpi.label"
          class="rounded-lg border border-slate-100 bg-white p-5 shadow-xs"
        >
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
      </section>

      <!-- Main Analytics Chart Area -->
      <section class="rounded-lg border border-slate-100 bg-white p-6">
        <div class="flex items-center justify-between pb-6">
          <div>
            <h2 class="text-sm font-semibold text-slate-900">Revenue Velocity</h2>
            <p class="text-xs text-slate-500">Monthly recurring revenue projection over time</p>
          </div>
          <div class="flex gap-2">
            <button class="rounded-md border border-slate-200 px-3 py-1 text-xs font-medium text-slate-600 hover:bg-slate-50">30 Days</button>
            <button class="rounded-md bg-slate-900 px-3 py-1 text-xs font-medium text-white">12 Months</button>
          </div>
        </div>
        <!-- Chart Container Placeholder -->
        <div class="flex h-64 w-full items-center justify-center rounded-md border border-dashed border-slate-200 bg-slate-50/50">
          <span class="text-xs text-slate-400">Time-series Line/Bar Chart Area</span>
        </div>
      </section>

      <!-- Recent Activity / Data Table -->
      <section class="rounded-lg border border-slate-100 bg-white">
        <div class="border-b border-slate-100 px-6 py-4">
          <h2 class="text-sm font-semibold text-slate-900">Recent Transactions</h2>
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

        <!-- Subtle Pagination Controls -->
        <div class="flex items-center justify-between border-t border-slate-100 px-6 py-3">
          <span class="text-xs text-slate-500">Showing 1 to 4 of 32 results</span>
          <div class="flex gap-2">
            <button class="rounded-md border border-slate-200 px-3 py-1 text-xs text-slate-600 hover:bg-slate-50">Previous</button>
            <button class="rounded-md border border-slate-200 px-3 py-1 text-xs text-slate-600 hover:bg-slate-50">Next</button>
          </div>
        </div>
      </section>
    </div>
  </NuxtLayout>
</template>

<script setup lang="ts">
definePageMeta({
  layout: false,
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
</script>

<style scoped>

</style>