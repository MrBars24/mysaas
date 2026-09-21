import { useAuthStore } from "~/stores/auth"

export const useApi = () => {
  const config = useRuntimeConfig()
  const authStore = useAuthStore()

  return $fetch.create({
    baseURL: config.public.apiBase as string,

    onRequest({ options }) {
      const headers = new Headers(options.headers)

      headers.set('Accept', 'application/json')

      if (authStore.token) {
        headers.set('Authorization', `Bearer ${authStore.token}`)
      }

      options.headers = headers
    },
    onResponseError({ response }) {
      if (response.status === 401) {
        authStore.clearAuth()
      }
    },
  })
}