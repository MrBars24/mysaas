import { useAuthStore } from "~/stores/auth"

export default defineNuxtRouteMiddleware((to, from) => {
  // 1. Fetch the token from cookies (works on both Server and Client)
  const { isAuthenticated, staff, user } = useAuthStore()

  // 2. Define your public and protected page rules
  const isLoginPage = to.path === '/login'
  const isDashboardPage = to.path.startsWith('/dashboard') || to.path === '/'

  // Case A: User has NO token, but tries to access a protected page
  if (!isAuthenticated && isDashboardPage) {
    return navigateTo('/login')
  }

  // Case B: User HAS a token, but tries to access the login page
  if (isAuthenticated && isLoginPage) {
    if (staff?.role !== "client" || user?.platform_role === "super_admin") {
      return navigateTo('/portal')
    } else {
      return navigateTo('/')
    }
  }
})