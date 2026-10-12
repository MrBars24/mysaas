export interface NavSubItem {
  id: string
  name: string
  to?: string
  section?: string
  permissions?: string[] // Fine-grained permissions (e.g., 'bookings.read', 'staff.manage')
  roles?: string[]       // Broad portal roles (e.g., 'owner', 'client', 'superadmin')
  badge?: string
}

export interface NavItem {
  id: string
  name: string
  to?: string
  icon?: () => VNode
  children?: NavSubItem[]
  permissions?: string[] // Fine-grained permissions (e.g., 'bookings.read', 'staff.manage')
  roles?: string[]       // Broad portal roles (e.g., 'owner', 'client', 'superadmin')
  badge?: string
}

export interface NavSection {
  title: string,
  items: NavItem[]
}

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

export const mainNavigation: NavSection[] = [
  {
    title: 'Overview',
    items: [
      { id: "dashboard", name: 'Dashboard', to: '/', icon: IconDashboard, roles: ['superadmin', 'tenant_owner', 'tenant_admin', 'service_provider', 'front_desk'] },
      { id: "tenanats", name: 'Tenants', to: '/portal/tenants', icon: IconUsers, roles: ['superadmin'] },
      { id: "jobs", name: 'My Jobs', to: '/portal/jobs', icon: IconDashboard, roles: ['service_provider'] },
      { id: "staffs", name: 'Staffs', to: '/portal/staffs', icon: IconStaff, roles: ['superadmin', 'tenant_owner'] },
      { id: "customers", name: 'Customers', to: '/portal/customers', icon: IconCustomers },
      { id: "schedules", name: 'Schedule & Time Off', to: '/portal/schedules', icon: IconClock, roles: ['superadmin', 'tenant_owner', 'tenant_admin', 'tenant_admin', 'front_desk'] },
      { id: "frontdesk", name: 'Front Desk', to: '/portal/frontdesk', icon: IconClock, roles: ['superadmin', 'tenant_owner', 'tenant_admin', 'front_desk'] },
    ]
  },
  {
    title: 'Operations',
    items: [
      { id: "bookings", name: 'Bookings', to: '/portal/bookings', icon: IconBookings, roles: ['superadmin', 'tenant_owner', 'tenant_admin', 'front_desk'] },
      { id: "calendar", name: 'Calendar', to: '/portal/calendar', icon: IconCalendar, roles: ['superadmin', 'tenant_owner', 'tenant_admin'] },
      { id: "vehicle-history", name: 'Vehicle History', to: '/vehicle-history', icon: IconCalendar, roles: ['superadmin', 'service_provider'] },
    ]
  },
  {
    title: 'Catalog',
    items: [
      { id: "services", name: 'Services', to: '/portal/services', icon: IconServices, roles: ['superadmin', 'tenant_owner', 'tenant_admin'] },
      { id: "branches", name: 'Branches', to: '/portal/branches', icon: IconBranches, roles: ['superadmin', 'tenant_owner', 'tenant_admin'] },
      {
        id: "components", name: 'Components',
        icon: IconComponents,
        children: [
          { id: "components", name: 'All Components', to: '/portal/components' },
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