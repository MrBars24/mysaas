<template>
  <NuxtLayout name="auth">
    <template #leftpanel>
      <!-- Top Brand Header -->
      <div class="relative z-10 flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-primary/20 border border-primary/30 flex items-center justify-center font-bold text-primary text-sm shadow-sm">
          RC
        </div>
       <span class="text-xl font-bold tracking-tight text-white">RamCap</span>
      </div>

      <!-- Middle Content: Vehicle Graphic Card & Value Proposition -->
      <div class="relative z-10 my-auto py-8 max-w-lg space-y-8">

        <!-- Graphic / Illustration Box -->
        <div class="w-48 h-48 sm:w-56 sm:h-56 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-md flex items-center justify-center shadow-2xl">
          <!-- Stylized Car Outline Icon -->
          <svg class="w-24 h-24 sm:w-28 sm:h-28 text-primary stroke-current" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Roof / Upper Body -->
            <path d="M25 42 L35 24 H65 L75 42 Z" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round"/>
            <!-- Rear Window Line -->
            <line x1="33" y1="33" x2="67" y2="33" stroke-width="4.5" stroke-linecap="round"/>
            <!-- Main Body Frame -->
            <rect x="18" y="42" width="64" height="26" rx="8" stroke-width="4.5"/>
            <!-- Left Wheel -->
            <circle cx="32" cy="72" r="7" stroke-width="4.5"/>
            <!-- Right Wheel -->
            <circle cx="68" cy="72" r="7" stroke-width="4.5"/>
          </svg>
        </div>

        <!-- Copywriting -->
        <div class="space-y-3">
          <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight tracking-tight text-white">
            Your car, cared for — <br class="hidden sm:inline" />wherever you are.
          </h1>

          <p class="text-sidebar-muted text-sm sm:text-base leading-relaxed">
            Book trusted service centers near you, track every visit, and pay — all from your browser.
          </p>
        </div>

      </div>

      <!-- Bottom Footer Info -->
      <div class="relative z-10 text-xs text-sidebar-muted/60">
        © 2026 RamCap
      </div>
    </template>
    <template #rightpanel>
      <!-- Header -->
      <div class="space-y-2 text-center sm:text-left">
        <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-content-main">
          Welcome back
        </h2>
        <p class="text-sm text-content-muted">
          Sign in to book and manage your car services.
        </p>
      </div>

      <!-- Form -->
      <form @submit.prevent="handleSendCode" class="space-y-5">

        <!-- Mobile Number Input -->
        <div class="space-y-1.5">
          <label for="mobile" class="block text-xs font-bold uppercase tracking-wider text-content-muted">
            MOBILE NUMBER
          </label>
          <div class="relative flex items-center">
            <!-- Country Prefix Tag -->
            <span class="absolute left-3.5 font-semibold text-sm text-content-main select-none">
              +63
            </span>
            <input
              id="mobile"
              v-model="form.phone"
              type="tel"
              required
              placeholder="912 345 6789"
              class="w-full pl-14 pr-4 py-3 bg-app-bg border border-border-subtle rounded-xl text-sm font-medium text-content-main placeholder:text-content-muted/50 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-150"
            />
          </div>
        </div>

        <!-- Send Code Action Button -->
        <button
          type="submit"
          class="w-full py-3.5 px-4 bg-primary hover:bg-primary-hover text-white font-semibold rounded-xl transition-all duration-150 shadow-sm focus:outline-none focus:ring-2 focus:ring-primary/40 active:scale-[0.99]"
        >
          Send Code
        </button>
      </form>

      <!-- Divider -->
      <div class="relative flex items-center justify-center">
        <div class="absolute inset-0 flex items-center">
          <div class="w-full border-t border-border-subtle"></div>
        </div>
        <span class="relative px-3 bg-app-surface text-xs text-content-muted">
          or continue with
        </span>
      </div>

      <!-- Social Auth Options -->
      <div class="grid grid-cols-2 gap-3">
        <!-- Google Auth Button -->
        <button
          type="button"
          @click="handleSocialLogin('Google')"
          class="flex items-center justify-center gap-2 py-2.5 px-4 border border-border-subtle rounded-xl text-sm font-semibold text-content-main bg-app-surface hover:bg-app-bg transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-primary/20"
        >
          <!-- Google Multicolor Icon -->
          <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
            <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.26v3.15C3.25 21.32 7.33 24 12 24z"/>
            <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.26C.46 8.18 0 10.02 0 12s.46 3.82 1.26 5.42l4.02-3.15z"/>
            <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.25 2.68 1.26 6.58l4.02 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
          </svg>
          Google
        </button>

        <!-- Apple Auth Button -->
        <button
          type="button"
          @click="handleSocialLogin('Apple')"
          class="flex items-center justify-center gap-2 py-2.5 px-4 border border-border-subtle rounded-xl text-sm font-semibold text-content-main bg-app-surface hover:bg-app-bg transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-primary/20"
        >
          <!-- Apple Icon -->
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M15.97 6.34c.67-.82 1.13-1.97.99-3.14-1 .04-2.22.67-2.92 1.48-.63.73-1.18 1.9-1.03 3.03 1.12.09 2.28-.55 2.96-1.37z"/>
          </svg>
          Apple
        </button>
      </div>

      <!-- Register Link -->
      <div class="text-center text-xs text-content-muted pt-2">
        New to RamCap?
        <a href="#" class="font-semibold text-primary hover:text-primary-hover transition-colors">
          Create an account
        </a>
      </div>
    </template>
  </NuxtLayout>
</template>

<script setup lang="ts">
definePageMeta({
  layout: false, // Disable automatic layout wrapping to handle it manually
  // middleware: 'guest',
})

import { reactive, ref } from 'vue'
import { useApi } from '~/composables/useApi'
import { useAuthStore } from '~/stores/auth';

const api = useApi();
const authStore = useAuthStore();

const showPassword = ref(false)

const form = reactive({
  phone: '',
  device_name: 'nuxt4_client_app',
  // rememberMe: false
})

const handleSendCode = async () => {
  // Login handler logic
  try {
    // Call the login action directly on your Pinia store
    form.phone = "+63" + form.phone;
    await authStore.loginClient(form)

    // Redirect upon successful login
    await navigateTo('/')
  } catch (err: any) {
    // Intercept Laravel validation error messages or fallback gracefully[cite: 1]
    // errorMessage.value = err.data?.message || err.data?.errors?.email?.[0] || 'Invalid login credentials'
  } finally {
    // loading.value = false
  }
}
</script>

<style scoped>

</style>