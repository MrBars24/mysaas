export interface NavItem {
  label: string
  to: string
  icon?: string
  permissions?: string[] // Fine-grained permissions (e.g., 'bookings.read', 'staff.manage')
  roles?: string[]       // Broad portal roles (e.g., 'owner', 'client', 'superadmin')
  badge?: string
}

export const mainNavigation: NavItem[] = [
  // Shared / General
  { label: 'Dashboard', to: '/dashboard', roles: ['superadmin', 'tenant_owner', 'tenant_admin', 'service_provider', 'front_desk'] },
  { label: 'My Jobs', to: '/jobs', roles: ['service_provider'] },

  // Business Owner / Staff Specific
  { label: 'Bookings', to: '/bookings', roles: ['superadmin', 'tenant_owner', 'tenant_admin', 'front_desk'] },
  { label: 'Calendar', to: '/calendar', roles: ['superadmin', 'tenant_owner', 'tenant_admin'] },
  { label: 'Front Desk', to: '/frontdesk', roles: ['superadmin', 'tenant_owner', 'tenant_admin', 'front_desk'] },

  { label: 'Services', to: '/services', roles: ['superadmin', 'tenant_owner', 'tenant_admin'] },
  { label: 'Branches', to: '/branches', roles: ['superadmin', 'tenant_owner', 'tenant_admin'] },

  // Client / Customer Specific
  { label: 'Staffs', to: '/staffs', roles: ['superadmin', 'tenant_owner'] },
  { label: 'Schedules', to: '/schedules', roles: ['superadmin', 'tenant_owner', 'tenant_admin', 'tenant_admin', 'front_desk'] },
  { label: 'Vehicle History', to: '/vehicle-history', roles: ['superadmin', 'service_provider'] },
]