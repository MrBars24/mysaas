import { defineStore } from 'pinia'
import { useApi } from '~/composables/useApi'

export interface User {
  id: Number,
  public_id: string
  email: string
  first_name: string
  last_name: string
  platform_role: string
  status: string
  mfa_enabled: boolean
  last_login_at: string | null
}

export interface Staff {
  id: Number,
  public_id: string
  role: string
  title: string
  tenand_id: string
  joined_at: string | null
}

export const useAuthStore = defineStore('auth', () => {
  const token = useCookie<string | null>('auth_token', {
    maxAge: 60 * 60 * 24 * 7,
    sameSite: 'lax',
    secure: process.env.NODE_ENV === 'production',
  })

  const user = useCookie<User | null>('user', {
    maxAge: 60 * 60 * 24 * 7,
    sameSite: 'lax',
    secure: process.env.NODE_ENV === 'production',
  })

  const staff = useCookie<Staff | null>('staff', {
    maxAge: 60 * 60 * 24 * 7,
    sameSite: 'lax',
    secure: process.env.NODE_ENV === 'production',
  })

  const isAuthenticated = computed(() => !!token.value)
  const isSuperAdmin = computed(() => user.value?.platform_role === 'super_admin')

  function setAuth(userData: User, staffData: Staff, tokenValue: string) {
    user.value = userData
    staff.value = staffData
    token.value = tokenValue
  }

  function clearAuth() {
    user.value = null
    staff.value = null
    token.value = null
    navigateTo('/login')
  }

  async function login(credentials: { email: string; password: string }) {
    const api = useApi() // Custom $fetch wrapper
    const response = await api<{ data: { user: User; staff: Staff; token: string } }>('/auth/login', {
      method: 'POST',
      body: credentials,
    })

    setAuth(response.data.user, response.data.staff, response.data.token)
  }

  async function loginClient(payload: { phone: string; device_name?: string }) {
    const api = useApi()

    // Posts to POST /api/v1/auth/client/login
    const response = await api<{
      data: {
        user: User,
        staff: Staff,
        token: string
        token_type: string
      }
    }>('/auth/client/login', {
      method: 'POST',
      body: payload,
    })

    setAuth(response.data.user, response.data.staff, response.data.token)
  }

  return {
    token,
    user,
    staff,
    isAuthenticated,
    isSuperAdmin,
    setAuth,
    clearAuth,
    login,
    loginClient,
  }
})