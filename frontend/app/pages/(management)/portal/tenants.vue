<template>
  <div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
      <div>
        <h1 class="text-xl font-bold text-slate-900 tracking-tight">Tenant Onboarding</h1>
        <p class="text-xs text-slate-500">Manage tenant registrations, approvals, and compliance checks.</p>
      </div>

      <!-- Action / Summary Stats -->
      <div class="flex items-center gap-2">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200">
          <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
          {{ pendingCount }} Pending Approval
        </span>
      </div>
    </div>

    <!-- Data Table Container -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4">
      <DataTable
        mode="server"
        :columns="columns"
        :data="serverData"
        :page-size="10"
        search-placeholder="Search tenants or email..."
        :total-items="serverTotal"
        :loading="isServerLoading"
        @server-change="handleServerFetch"
      >
        <!-- Filter Actions Slot -->
        <template #actions>
          <select
            v-model="statusFilter"
            class="rounded-md border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-700 focus:outline-none focus:border-slate-400"
          >
            <option value="all">All Statuses</option>
            <option value="pending">Pending</option>
            <option value="under_review">Needs Checking</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
          </select>
        </template>

        <!-- Custom Cell: Tenant Name -->
        <template #cell(name)="{ row }">
          <div>
            <div class="font-semibold text-slate-900">{{ row.name }}</div>
            <!-- <div class="text-[11px] text-slate-400 font-mono">ID: {{ row.id }}</div> -->
          </div>
        </template>

        <!-- Custom Cell: Owner & Contact -->
        <template #cell(ownerName)="{ row }">
          <div>
            <div class="text-slate-800">{{ row.contact_phone }}</div>
            <div class="text-[11px] text-slate-400">{{ row.contact_email }}</div>
          </div>
        </template>

        <!-- Custom Cell: Status Badge -->
        <template #cell(status)="{ value }">
          <span :class="getStatusBadgeClass(value)">
            <span :class="getStatusDotClass(value)"></span>
            {{ formatStatusLabel(value) }}
          </span>
        </template>

        <template #cell(business_type)="{ value }">
          {{ value.label }}
        </template>
2
        <!-- Custom Cell: Actions -->
        <template #cell(actions)="{ row }">
          <div class="flex items-center justify-end gap-1.5">
            <BaseButton size="sm">View Details</BaseButton>
            <ButtonDropdown
              label="Actions"
              variant="secondary"
              size="sm"
              placement="bottom-right"
              :items="getTenantActions(row)"
            />
          </div>
        </template>
      </DataTable>
    </div>

    <!-- Status Change Confirmation Modal -->
    <div v-if="selectedTenant && targetStatus" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm">
      <div class="w-full max-w-md bg-white rounded-xl shadow-xl border border-slate-100 p-6 space-y-4">
        <h3 class="text-base font-semibold text-slate-900">
          Confirm Action: {{ formatStatusLabel(targetStatus) }}
        </h3>

        <p class="text-xs text-slate-600 leading-relaxed">
          Are you sure you want to update <strong class="text-slate-900">{{ selectedTenant.name }}</strong> to
          <span class="font-semibold" :class="getTargetStatusColor(targetStatus)">{{ formatStatusLabel(targetStatus) }}</span>?
        </p>

        <!-- Notes Input -->
        <div class="space-y-1">
          <label class="text-[11px] font-medium text-slate-500">Remarks / Reason (Optional)</label>
          <textarea
            v-model="actionNotes"
            rows="3"
            placeholder="Add relevant notes or check instructions..."
            class="w-full rounded-md border border-slate-200 p-2 text-xs text-slate-800 focus:outline-none focus:border-slate-400"
          ></textarea>
        </div>

        <div class="flex justify-end gap-2 pt-2">
          <button
            @click="closeActionModal"
            class="px-3 py-1.5 text-xs font-medium text-slate-600 border border-slate-200 rounded-md hover:bg-slate-50"
          >
            Cancel
          </button>
          <button
            @click="applyStatusUpdate"
            :class="getConfirmButtonClass(targetStatus)"
          >
            Confirm {{ formatStatusLabel(targetStatus) }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import BaseButton from '~/components/BaseButton.vue'
import type { DropdownItem } from '~/components/ButtonDropdown.vue'
import ButtonDropdown from '~/components/ButtonDropdown.vue'
import type { Column } from '~/components/DataTable.vue'
import { useApi } from '~/composables/useApi'
import type { Tenant, TenantStatus } from '~/types/tenant'

// Table Header Setup[cite: 1]
const columns: Column[] = [
  { key: 'name', label: 'Tenant Name', sortable: true },
  { key: 'ownerName', label: 'Owner & Contact', sortable: true },
  { key: 'business_type', label: 'Business Type', sortable: true },
  { key: 'created_at', label: 'Registered Date', sortable: true },
  { key: 'status', label: 'Status', sortable: true, align: 'center' },
  { key: 'actions', label: 'Actions', align: 'right' },
]

// Mock Tenants List
const serverData = ref<Tenant[]>([
  { id: 'TNT-001', name: 'AutoCare Express', ownerName: 'John Doe', email: 'john@autocare.com', business_type: 'Enterprise', created_at: '2026-09-20', status: 'pending' },
  { id: 'TNT-002', name: 'Speedy Lube & Wash', ownerName: 'Sarah Jenkins', email: 'sarah@speedylube.com', business_type: 'Pro', created_at: '2026-09-22', status: 'under_review' },
  { id: 'TNT-003', name: 'Apex Motors Shop', ownerName: 'Mike Ross', email: 'mike@apexmotors.com', business_type: 'Starter', created_at: '2026-09-15', status: 'approved' },
  { id: 'TNT-004', name: 'Metro Detailing Garage', ownerName: 'Rachel Zane', email: 'rachel@metrodetail.com', business_type: 'Pro', created_at: '2026-09-18', status: 'rejected' },
])

// Filtering State
const statusFilter = ref<string>('all')
const isServerLoading = ref<boolean>(false);
const serverTotal = ref<Number>(20)
const currentPage = ref<Number>(1)
const sortKey = ref<string>('')
const sortOrder = ref<string>('asc')
const searchString = ref<string>('')

const api = useApi()

onMounted(() => {
  handleServerFetch({ page: currentPage.value, search: searchString.value, sortKey: sortKey.value, sortOrder: sortOrder.value });
})

const tenants = computed(() => {
  if (statusFilter.value === 'all') return serverData.value
  return serverData.value.filter(t => t.status === statusFilter.value)
})

const pendingCount = computed(() => {
  return serverData.value.filter(t => t.status === 'pending').length
})

// Modal / Action State
const selectedTenant = ref<Tenant | null>(null)
const targetStatus = ref<TenantStatus | null>(null)
const actionNotes = ref('')

const handleServerFetch = async (params: { page: Number; search: string; sortKey: string; sortOrder: string }) => {
  isServerLoading.value = true
  console.log('Fetching server data with params:', params)

  const response = await api<{ data: Array<Tenant> }>('/tenants', {
    method: 'GET',
  })

  // console.log(response);
  serverData.value = response.data;

  // Simulate API delay
  setTimeout(() => {
    isServerLoading.value = false
  }, 600)
}

const openActionModal = (tenant: Tenant, status: TenantStatus) => {
  selectedTenant.value = tenant
  targetStatus.value = status
  actionNotes.value = ''
}

const closeActionModal = () => {
  selectedTenant.value = null
  targetStatus.value = null
  actionNotes.value = ''
}

const applyStatusUpdate = () => {
  if (selectedTenant.value && targetStatus.value) {
    const idx = serverData.value.findIndex(t => t.id === selectedTenant.value?.id)
    if (idx !== -1) {
      serverData.value[idx]!.status = targetStatus.value
      if (actionNotes.value) {
        serverData.value[idx]!.notes = actionNotes.value
      }
    }
  }
  closeActionModal()
}

// Styling Helpers
const formatStatusLabel = (status: TenantStatus) => {
  switch (status) {
    case 'approved': return 'Approved'
    case 'rejected': return 'Rejected'
    case 'under_review': return 'Needs Check'
    case 'pending': return 'Pending'
  }
}

const getStatusBadgeClass = (status: TenantStatus) => {
  const base = 'inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium'
  switch (status) {
    case 'approved': return `${base} bg-emerald-50 text-emerald-700 border border-emerald-200`
    case 'rejected': return `${base} bg-rose-50 text-rose-700 border border-rose-200`
    case 'under_review': return `${base} bg-amber-50 text-amber-700 border border-amber-200`
    case 'pending': default: return `${base} bg-slate-100 text-slate-600 border border-slate-200`
  }
}

const getStatusDotClass = (status: TenantStatus) => {
  const base = 'h-1.5 w-1.5 rounded-full'
  switch (status) {
    case 'approved': return `${base} bg-emerald-500`
    case 'rejected': return `${base} bg-rose-500`
    case 'under_review': return `${base} bg-amber-500`
    case 'pending': default: return `${base} bg-slate-400`
  }
}

const getTargetStatusColor = (status: TenantStatus) => {
  switch (status) {
    case 'active': return 'text-emerald-600'
    case 'rejected': return 'text-rose-600'
    case 'under_review': return 'text-amber-600'
    default: return 'text-slate-600'
  }
}

const getConfirmButtonClass = (status: TenantStatus) => {
  const base = 'px-3 py-1.5 text-xs font-medium text-white rounded-md shadow-sm transition-colors'
  switch (status) {
    case 'approved': return `${base} bg-emerald-600 hover:bg-emerald-700`
    case 'rejected': return `${base} bg-rose-600 hover:bg-rose-700`
    case 'under_review': return `${base} bg-amber-600 hover:bg-amber-700`
    default: return `${base} bg-slate-800 hover:bg-slate-900`
  }
}

// Action Item Handlers
const handleViewDetails = (tenant: any) => {
  console.log('Viewing full details for tenant:', tenant)
  // Navigate or open modal: e.g., router.push(`/tenants/${tenant.id}`)
}

const handleEditTenant = (tenant: any) => {
  console.log('Editing tenant:', tenant)
}

const handleDeleteTenant = (tenant: any) => {
  console.log('Deleting tenant:', tenant)
}

// Generate dropdown menu options per tenant row
const getTenantActions = (tenant: any): DropdownItem[] => [
  {
    label: 'Approve',
    onClick: () => handleViewDetails(tenant)
  },
  {
    label: 'Send to manager',
    onClick: () => handleEditTenant(tenant)
  },
  {
    divider: true
  },
  {
    label: 'Reject',
    danger: true,
    onClick: () => handleDeleteTenant(tenant)
  }
]
</script>

<style scoped>

</style>