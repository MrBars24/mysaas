import { computed } from 'vue'
import { mainNavigation, type NavItem, type NavSection } from '~/config/navigation'
import { useAuthStore } from '~/stores/auth' // Assume auth store contains user permissions

export function useNavigation() {
  const auth = useAuthStore()

  const filteredNavigation = computed(() => {
    const userRole = auth.staff?.role || "" // e.g., 'tenant_owner', 'service_provider', etc.

    return mainNavigation
      .map((section: NavSection) => {
        // Filter items within each section
        const validItems = section.items
          .map((item: NavItem) => {
            // Check top-level item role access
            const hasItemAccess = !item.roles || item.roles.includes(userRole) || auth.user?.platform_role === "super_admin"
            if (!hasItemAccess) return null

            // If item has children dropdown, filter children as well
            if (item.children) {
              const validChildren = item.children.filter(child => {
                return !child.roles || child.roles.includes(userRole)
              })

              // Hide parent dropdown if no children are accessible
              if (validChildren.length === 0) return null

              return { ...item, children: validChildren }
            }

            return item
          })
          .filter(Boolean) as NavItem[]

        return {
          ...section,
          items: validItems
        }
      })
      // Hide sections that have 0 visible items for the user
      .filter((section) => section.items.length > 0)
  })

  return { filteredNavigation }
}