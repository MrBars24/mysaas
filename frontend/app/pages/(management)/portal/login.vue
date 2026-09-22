<template>
  <NuxtLayout name="auth">
    <template #leftpanel>
      <!-- Top Brand Header -->
      <div class="relative z-10 flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center font-bold text-white text-sm shadow-sm">
          RC
        </div>
        <span class="text-xl font-bold tracking-tight text-white">RamCap</span>
      </div>

      <!-- Middle Value Proposition -->
      <div class="relative z-10 my-auto py-12 max-w-lg">
        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold tracking-wide bg-primary/10 text-primary uppercase mb-6 border border-primary/20">
          BUSINESS DASHBOARD
        </span>

        <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight tracking-tight text-white mb-4">
          Run your service center from one dashboard.
        </h1>

        <p class="text-sidebar-muted text-sm sm:text-base leading-relaxed">
          Bookings, staff schedules, payments, and customer reviews — everything your team needs to keep AutoFix Express running smoothly.
        </p>
      </div>

      <!-- Bottom Footer Info -->
      <div class="relative z-10 text-xs text-sidebar-muted/60">
        © 2026 RamCap · Business Portal
      </div>
    </template>
    <template #rightpanel>
      <!-- Header -->
      <div class="space-y-2">
        <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-content-main">
          Welcome back
        </h2>
        <p class="text-sm text-content-muted">
          Sign in to manage AutoFix Express.
        </p>
      </div>

      <!-- Form -->
      <form @submit.prevent="handleLogin" class="space-y-5">

        <!-- Business Email Input -->
        <div class="space-y-1.5">
          <label for="email" class="block text-xs font-bold uppercase tracking-wider text-content-muted">
            BUSINESS EMAIL
          </label>
          <div class="relative flex items-center">
            <span class="absolute left-3.5 text-content-muted">
              <!-- Mail Icon -->
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            </span>
            <input
              id="email"
              v-model="form.email"
              type="email"
              required
              placeholder="owner@autofixexpress.ph"
              class="w-full pl-11 pr-4 py-3 bg-app-bg border border-border-subtle rounded-xl text-sm text-content-main placeholder:text-content-muted/50 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-150"
            />
          </div>
        </div>

        <!-- Password Input -->
        <div class="space-y-1.5">
          <label for="password" class="block text-xs font-bold uppercase tracking-wider text-content-muted">
            PASSWORD
          </label>
          <div class="relative flex items-center">
            <span class="absolute left-3.5 text-content-muted">
              <!-- Lock Icon -->
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </span>
            <input
              id="password"
              v-model="form.password"
              :type="showPassword ? 'text' : 'password'"
              required
              placeholder="••••••••"
              class="w-full pl-11 pr-11 py-3 bg-app-bg border border-border-subtle rounded-xl text-sm text-content-main placeholder:text-content-muted/50 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-150"
            />
            <button
              type="button"
              @click="showPassword = !showPassword"
              class="absolute right-3.5 text-content-muted hover:text-content-main transition-colors focus:outline-none"
            >
              <!-- Eye / Eye Off Icon -->
              <svg v-if="!showPassword" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
              <svg v-else xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
            </button>
          </div>
        </div>

        <!-- Controls: Checkbox & Forgot Password -->
        <div class="flex items-center justify-between text-xs pt-1">
          <label class="flex items-center gap-2 cursor-pointer select-none text-content-muted">
            <input
              type="checkbox"
              v-model="form.rememberMe"
              class="w-4 h-4 rounded border-border-subtle text-primary focus:ring-primary/20 accent-primary cursor-pointer"
            />
            <span>Keep me signed in</span>
          </label>

          <a href="#" class="font-semibold text-primary hover:text-primary-hover transition-colors">
            Forgot password?
          </a>
        </div>

        <!-- Submit Action Button -->
        <button
          type="submit"
          class="w-full py-3.5 px-4 bg-primary hover:bg-primary-hover text-white font-semibold rounded-xl transition-all duration-150 shadow-sm focus:outline-none focus:ring-2 focus:ring-primary/40 active:scale-[0.99]"
        >
          Sign In
        </button>
      </form>

      <!-- Dynamic Registration Link -->
      <div class="text-center text-xs text-content-muted pt-2">
        New service center?
        <a href="#" class="font-semibold text-primary hover:text-primary-hover transition-colors">
          Apply to join RamCap
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
  email: '',
  password: '',
  // device_name: 'nuxt4_client',
  // rememberMe: false
})

const handleLogin = async () => {
  // Login handler logic
  try {
    // Call the login action directly on your Pinia store
    await authStore.login(form)

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