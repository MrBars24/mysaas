<template>
  <div class="w-full space-y-4">
    <!-- Header / Controls Bar -->
    <div v-if="searchable || $slots.actions" class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
      <!-- Search Input -->
      <div v-if="searchable" class="relative max-w-xs w-full">
        <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <input
          v-model="searchQuery"
          type="text"
          :placeholder="searchPlaceholder"
          class="w-full rounded-md border border-slate-200 bg-white py-1.5 pl-9 pr-3 text-xs text-slate-900 placeholder-slate-400 focus:border-slate-400 focus:outline-none"
        />
      </div>

      <!-- Action Slot for custom buttons/filters -->
      <div class="flex items-center gap-2">
        <slot name="actions" />
      </div>
    </div>

    <!-- Table Container -->
    <div class="overflow-x-auto rounded-lg border border-slate-100 bg-white">
      <table class="w-full text-left text-xs text-slate-600">
        <!-- Table Header -->
        <thead class="border-b border-slate-100 bg-slate-50/50 font-medium text-slate-500">
          <tr>
            <th
              v-for="col in columns"
              :key="col.key"
              :style="{ width: col.width }"
              :class="[
                'px-4 py-3 font-semibold select-none',
                col.sortable ? 'cursor-pointer hover:text-slate-900' : '',
                col.align === 'right' ? 'text-right' : col.align === 'center' ? 'text-center' : 'text-left'
              ]"
              @click="col.sortable && handleSort(col.key)"
            >
              <div class="inline-flex items-center gap-1.5" :class="{ 'justify-end': col.align === 'right', 'justify-center': col.align === 'center' }">
                <span>{{ col.label }}</span>
                <span v-if="col.sortable" class="text-slate-400">
                  <svg v-if="sortKey !== col.key" class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                  </svg>
                  <svg v-else-if="sortOrder === 'asc'" class="h-3 w-3 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                  </svg>
                  <svg v-else class="h-3 w-3 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
                </span>
              </div>
            </th>
          </tr>
        </thead>

        <!-- Table Body -->
        <tbody class="divide-y divide-slate-100">
          <!-- Loading State -->
          <tr v-if="loading">
            <td :colspan="columns.length" class="px-4 py-8 text-center text-slate-400">
              <div class="inline-flex items-center gap-2">
                <svg class="h-4 w-4 animate-spin text-slate-900" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Loading table data...
              </div>
            </td>
          </tr>

          <!-- Empty State -->
          <tr v-else-if="displayedData.length === 0">
            <td :colspan="columns.length" class="px-4 py-8 text-center text-slate-400">
              {{ emptyText }}
            </td>
          </tr>

          <!-- Data Rows -->
          <tr
            v-else
            v-for="(row, index) in displayedData"
            :key="row.id || index"
            class="hover:bg-slate-50/50 transition-colors"
          >
            <td
              v-for="col in columns"
              :key="col.key"
              :class="[
                'px-4 py-3',
                col.align === 'right' ? 'text-right' : col.align === 'center' ? 'text-center' : 'text-left'
              ]"
            >
              <!-- Slot for custom cell formatting -->
              <slot :name="`cell(${col.key})`" :row="row" :value="row[col.key]" :index="index">
                {{ row[col.key] }}
              </slot>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination Controls -->
    <div v-if="paginated" class="flex items-center justify-between pt-1">
      <span class="text-xs text-slate-500">
        Showing {{ paginationStart }} to {{ paginationEnd }} of {{ totalCount }} results
      </span>
      <div class="flex items-center gap-1">
        <button
          :disabled="currentPage <= 1 || loading"
          @click="changePage(currentPage - 1)"
          class="rounded border border-slate-200 px-2.5 py-1 text-xs text-slate-600 hover:bg-slate-50 disabled:opacity-40 disabled:cursor-not-allowed"
        >
          Previous
        </button>
        <span class="px-2 text-xs text-slate-600 font-medium">{{ currentPage }} / {{ totalPages }}</span>
        <button
          :disabled="currentPage >= totalPages || loading"
          @click="changePage(currentPage + 1)"
          class="rounded border border-slate-200 px-2.5 py-1 text-xs text-slate-600 hover:bg-slate-50 disabled:opacity-40 disabled:cursor-not-allowed"
        >
          Next
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, watch } from 'vue'

export interface Column {
  key: string
  label: string
  sortable?: boolean
  align?: 'left' | 'center' | 'right'
  width?: string
}

const props = withDefaults(defineProps<{
  columns: Column[]
  data?: Record<string, any>[]
  mode?: 'client' | 'server'
  totalItems?: number // Required when mode === 'server'
  loading?: boolean
  searchable?: boolean
  searchPlaceholder?: string
  paginated?: boolean
  pageSize?: number
  emptyText?: string
}>(), {
  data: () => [],
  mode: 'client',
  totalItems: 0,
  loading: false,
  searchable: true,
  searchPlaceholder: 'Search...',
  paginated: true,
  pageSize: 5,
  emptyText: 'No data available.'
})

const emit = defineEmits<{
  (e: 'server-change', params: { page: number; search: string; sortKey: string; sortOrder: 'asc' | 'desc' }): void
}>()

// Internal States
const searchQuery = ref('')
const sortKey = ref('')
const sortOrder = ref<'asc' | 'desc'>('asc')
const currentPage = ref(1)

// Sorting Toggle
const handleSort = (key: string) => {
  if (sortKey.value === key) {
    sortOrder.value = sortOrder.value === 'asc' ? 'desc' : 'asc'
  } else {
    sortKey.value = key
    sortOrder.value = 'asc'
  }

  if (props.mode === 'server') {
    emitServerChange()
  }
}

// Client-side Filtering & Sorting Logic
const processedData = computed(() => {
  if (props.mode === 'server') return props.data

  let result = [...props.data]

  // Search Filter
  if (searchQuery.value.trim()) {
    const q = searchQuery.value.toLowerCase()
    result = result.filter(row =>
      Object.values(row).some(val => String(val).toLowerCase().includes(q))
    )
  }

  // Sorting
  if (sortKey.value) {
    result.sort((a, b) => {
      const valA = a[sortKey.value]
      const valB = b[sortKey.value]
      if (valA < valB) return sortOrder.value === 'asc' ? -1 : 1
      if (valA > valB) return sortOrder.value === 'asc' ? 1 : -1
      return 0
    })
  }

  return result
})

// Pagination Calculations
const totalCount = computed(() => {
  return props.mode === 'server' ? props.totalItems : processedData.value.length
})

const totalPages = computed(() => Math.max(1, Math.ceil(totalCount.value / props.pageSize)))

const paginationStart = computed(() => {
  if (totalCount.value === 0) return 0
  return (currentPage.value - 1) * props.pageSize + 1
})

const paginationEnd = computed(() => {
  return Math.min(currentPage.value * props.pageSize, totalCount.value)
})

const displayedData = computed(() => {
  if (props.mode === 'server' || !props.paginated) {
    return processedData.value
  }
  const start = (currentPage.value - 1) * props.pageSize
  return processedData.value.slice(start, start + props.pageSize)
})

// Server Mode Emitter
const emitServerChange = () => {
  emit('server-change', {
    page: currentPage.value,
    search: searchQuery.value,
    sortKey: sortKey.value,
    sortOrder: sortOrder.value
  })
}

const changePage = (page: number) => {
  currentPage.value = page
  if (props.mode === 'server') {
    emitServerChange()
  }
}

// Watch search to reset page or trigger server fetch
watch(searchQuery, () => {
  currentPage.value = 1
  if (props.mode === 'server') {
    emitServerChange()
  }
})
</script>