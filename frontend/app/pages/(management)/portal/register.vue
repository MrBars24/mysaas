<template>
  <div class="min-h-screen bg-app-bg text-content-main flex flex-col lg:flex-row font-sans">

    <!-- LEFT PANEL: Visual Branding Showcase -->
    <aside class="w-full lg:w-[40%] bg-sidebar text-sidebar-text p-8 lg:p-12 flex flex-col justify-between relative overflow-hidden min-h-[350px] lg:min-h-screen">
      <!-- Background Ambient Glow -->
      <div
        class="absolute -top-20 -right-20 w-96 h-96 rounded-full opacity-20 pointer-events-none blur-3xl"
        style="background: radial-gradient(circle, rgba(var(--color-primary), 1) 0%, transparent 70%);"
      ></div>

      <!-- Top Brand Header -->
      <div class="relative z-10 flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-primary/20 border border-primary/30 flex items-center justify-center font-bold text-primary text-sm shadow-sm">
          RC
        </div>
        <span class="text-xl font-bold tracking-tight text-white">RamCap</span>
      </div>

      <!-- Middle Content -->
      <div class="relative z-10 my-auto py-8 max-w-lg space-y-6">
        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold tracking-wide bg-primary/10 text-primary uppercase border border-primary/20">
          PARTNER NETWORK
        </span>

        <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight tracking-tight text-white">
          Empower your service center with digital workflows.
        </h1>

        <p class="text-sidebar-muted text-sm sm:text-base leading-relaxed">
          Join hundreds of auto service centers managing bookings, staff schedules, and payments seamlessly in one platform.
        </p>

        <ul class="space-y-3 pt-2 text-xs sm:text-sm text-sidebar-muted">
          <li class="flex items-center gap-2.5">
            <svg class="w-5 h-5 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>Custom workspace domain & portal</span>
          </li>
          <li class="flex items-center gap-2.5">
            <svg class="w-5 h-5 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>Interactive location mapping & geocoding</span>
          </li>
          <li class="flex items-center gap-2.5">
            <svg class="w-5 h-5 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>Verified business credentials & security</span>
          </li>
        </ul>
      </div>

      <!-- Footer -->
      <div class="relative z-10 text-xs text-sidebar-muted/60">
        © 2026 RamCap · Partner Onboarding
      </div>
    </aside>

    <!-- RIGHT PANEL: Onboarding Wizard Form -->
    <main class="w-full lg:w-[60%] bg-app-surface p-6 sm:p-10 lg:p-14 flex items-center justify-center min-h-[650px]">
      <div class="w-full max-w-xl space-y-8">

        <!-- Step Progress Header -->
        <div v-if="!isSubmitted" class="space-y-4">
          <div class="flex items-center justify-between text-xs font-bold uppercase tracking-wider text-content-muted">
            <span>Step {{ currentStep }} of 3</span>
            <span>{{ stepTitles[currentStep - 1] }}</span>
          </div>

          <div class="grid grid-cols-3 gap-2">
            <div
              v-for="step in 3"
              :key="step"
              class="h-1.5 rounded-full transition-all duration-300"
              :class="currentStep >= step ? 'bg-primary' : 'bg-border-subtle'"
            ></div>
          </div>
        </div>

        <!-- Submission Success View -->
        <div v-if="isSubmitted" class="p-8 bg-app-bg border border-border-subtle rounded-2xl space-y-4 text-center">
          <div class="w-14 h-14 rounded-full bg-primary/20 text-primary flex items-center justify-center mx-auto">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          </div>
          <h2 class="text-2xl font-bold text-content-main">Application Under Review</h2>
          <p class="text-sm text-content-muted leading-relaxed max-w-md mx-auto">
            Thank you! Your workspace <strong class="text-content-main">{{ form.tenant.slug }}.ramcap.com</strong> has been registered. Our team will verify your uploaded business documents shortly.
          </p>
          <div class="pt-4">
            <NuxtLink to="/portal/login" class="inline-flex items-center gap-2 px-6 py-3 bg-primary hover:bg-primary-hover text-white text-sm font-semibold rounded-xl transition-all">
            Return to Login Page
            </NuxtLink>
          </div>
        </div>

        <!-- Form Steps -->
        <form v-else @submit.prevent="handleNextStep" class="space-y-6">

          <!-- STEP 1: Owner Details (Single Full Name & Password Toggle) -->
          <div v-if="currentStep === 1" class="space-y-5">
            <div class="space-y-1">
              <h2 class="text-2xl font-bold text-content-main">Owner Credentials</h2>
              <p class="text-sm text-content-muted">Setup the primary administrator account for your service center.</p>
            </div>

            <div class="space-y-4">
              <!-- Single Full Name Field -->
              <div class="space-y-1.5">
                <label for="fullName" class="block text-xs font-bold uppercase tracking-wider text-content-muted">Full Name</label>
                <input
                  id="fullName"
                  v-model="form.owner.fullName"
                  type="text"
                  required
                  placeholder="e.g. Juan dela Cruz"
                  class="w-full px-4 py-3 bg-app-bg border border-border-subtle rounded-xl text-sm text-content-main focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                />
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Contact Email -->
                <div class="space-y-1.5">
                  <label for="email" class="block text-xs font-bold uppercase tracking-wider text-content-muted">Business Email</label>
                  <input
                    id="email"
                    v-model="form.tenant.contact_email"
                    type="email"
                    required
                    placeholder="owner@autofix.ph"
                    class="w-full px-4 py-3 bg-app-bg border border-border-subtle rounded-xl text-sm text-content-main focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                  />
                </div>

                <!-- Contact Phone -->
                <div class="space-y-1.5">
                  <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-content-muted">Mobile Number</label>
                  <div class="relative flex items-center">
                    <span class="absolute left-3.5 font-semibold text-sm text-content-main select-none">+63</span>
                    <input
                      id="phone"
                      v-model="form.tenant.contact_phone"
                      type="tel"
                      required
                      placeholder="912 345 6789"
                      class="w-full pl-14 pr-4 py-3 bg-app-bg border border-border-subtle rounded-xl text-sm text-content-main focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                    />
                  </div>
                </div>
              </div>

              <!-- Single Password Input with Eye Visibility Toggle -->
              <div class="space-y-1.5">
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-content-muted">Password</label>
                <div class="relative flex items-center">
                  <input
                    id="password"
                    v-model="form.owner.password"
                    :type="showPassword ? 'text' : 'password'"
                    required
                    placeholder="••••••••"
                    class="w-full pl-4 pr-11 py-3 bg-app-bg border border-border-subtle rounded-xl text-sm text-content-main focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                  />
                  <button
                    type="button"
                    @click="showPassword = !showPassword"
                    class="absolute right-3.5 text-content-muted hover:text-content-main transition-colors focus:outline-none"
                  >
                    <!-- Eye Icons -->
                    <svg v-if="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a8.98 8.98 0 013.982-.82c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18"/></svg>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- STEP 2: Business, Maps Location & Optional Social Links -->
          <div v-if="currentStep === 2" class="space-y-5">
            <div class="space-y-1">
              <h2 class="text-2xl font-bold text-content-main">Business & Location Setup</h2>
              <p class="text-sm text-content-muted">Set up your workspace domain, workshop location, and web presence.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-1 gap-4">
              <!-- Business Name -->
              <!-- Business Type (tenants.business_type) -->
              <div class="space-y-1.5">
                <label for="businessType" class="block text-xs font-bold uppercase tracking-wider text-content-muted">Business Type</label>
                <select
                  id="businessType"
                  v-model="form.tenant.business_type"
                  class="w-full px-4 py-3 bg-app-bg border border-border-subtle rounded-xl text-sm text-content-main focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                >
                  <!-- <option value="auto_repair">Auto Repair Shop</option>
                  <option value="detailing">Detailing & Car Wash</option>
                  <option value="tire_center">Tire & Battery Center</option>
                  <option value="multi_service">Multi-Service Center</option> -->
                  <option
                    v-for="type in optionsData?.data.business_types"
                    :key="type.value"
                    :value="type.value"
                  >
                    {{ type.label }}
                  </option>
                </select>
              </div>

                <!-- <select id="business_type" v-model="form.tenant.business_type" :disabled="pending" required>
                  <option value="" disabled>Select a business type</option>
                  <option
                    v-for="type in optionsData?.data.business_types"
                    :key="type.value"
                    :value="type.value"
                  >
                    {{ type.label }}
                  </option>
                </select> -->
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <!-- Business Name -->
              <div class="space-y-1.5">
                <label for="businessName" class="block text-xs font-bold uppercase tracking-wider text-content-muted">Service Center Name</label>
                <input
                  id="businessName"
                  v-model="form.tenant.name"
                  type="text"
                  required
                  placeholder="AutoFix Express"
                  @input="generateSlug"
                  class="w-full px-4 py-3 bg-app-bg border border-border-subtle rounded-xl text-sm text-content-main focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                />
              </div>

              <!-- Subdomain Slug -->
              <div class="space-y-1.5">
                <label for="slug" class="block text-xs font-bold uppercase tracking-wider text-content-muted">Workspace Domain</label>
                <div class="flex items-center">
                  <input
                    id="slug"
                    v-model="form.tenant.slug"
                    type="text"
                    required
                    placeholder="autofix"
                    class="w-full px-3 py-3 bg-app-bg border border-border-subtle rounded-l-xl text-sm text-content-main focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                  />
                  <span class="px-3 py-3 bg-slate-100 border border-l-0 border-border-subtle rounded-r-xl text-xs font-semibold text-content-muted select-none">
                    .ramcap.com
                  </span>
                </div>
              </div>

              <!-- Address Search Input -->
              <div class="space-y-1.5 sm:col-span-2">
                <label for="addressInput" class="block text-xs font-bold uppercase tracking-wider text-content-muted">
                  Workshop Location Search
                </label>
                <div class="relative">
                  <input
                    id="addressInput"
                    ref="addressInputRef"
                    v-model="form.location.full_address"
                    type="text"
                    placeholder="Type an address..."
                    class="w-full pl-10 pr-4 py-3 bg-app-bg border border-border-subtle rounded-xl text-sm text-content-main focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                  />
                  <svg class="w-5 h-5 absolute left-3 top-3.5 text-content-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                </div>
              </div>

              <!-- Map Preview & Coordinate Picker -->
              <div class="space-y-1.5 sm:col-span-2">
                <div class="flex items-center justify-between">
                  <label class="block text-xs font-bold uppercase tracking-wider text-content-muted">
                    Interactive Pin & Location Coordinates
                  </label>
                  <span v-if="form.location.latitude" class="text-xs font-mono text-primary font-semibold">
                    {{ form.location.latitude.toFixed(6) }}, {{ form.location.longitude?.toFixed(6) }}
                  </span>
                </div>

                <!-- Real Map Canvas -->
                <div
                  ref="mapContainerRef"
                  class="w-full h-64 rounded-xl border border-border-subtle bg-slate-100 overflow-hidden"
                ></div>

                <!-- Mock Map Fallback (When API Key is not yet available) -->
                <div
                  v-if="!isMapLoaded"
                  class="w-full h-64 rounded-xl border border-dashed border-primary/40 bg-primary/5 p-4 flex flex-col items-center justify-center text-center space-y-3 relative cursor-crosshair overflow-hidden"
                  @click="handleMockMapClick"
                >
                  <div class="w-10 h-10 rounded-full bg-primary/20 text-primary flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                  </div>
                  <div class="space-y-1">
                    <p class="text-xs font-bold text-content-main">Google Maps API Key Pending (Mock Mode Active)</p>
                    <p class="text-[11px] text-content-muted">Click anywhere inside this box to simulate dropping a pin location.</p>
                  </div>
                  <span class="text-[10px] px-2.5 py-1 rounded-md bg-app-surface text-primary border border-primary/20 font-mono">
                    Simulated Pin: {{ form.location.latitude?.toFixed(6) }}, {{ form.location.longitude?.toFixed(6) }}
                  </span>
                </div>
              </div>

              <!-- City & Province Breakdown -->
              <div class="space-y-1.5">
                <label for="city" class="block text-xs font-bold uppercase tracking-wider text-content-muted">City</label>
                <input
                  id="city"
                  v-model="form.location.city"
                  type="text"
                  required
                  placeholder="Makati City"
                  class="w-full px-4 py-3 bg-app-bg border border-border-subtle rounded-xl text-sm text-content-main focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                />
              </div>

              <div class="space-y-1.5">
                <label for="state" class="block text-xs font-bold uppercase tracking-wider text-content-muted">State / Province</label>
                <input
                  id="state"
                  v-model="form.location.state_province"
                  type="text"
                  required
                  placeholder="Metro Manila"
                  class="w-full px-4 py-3 bg-app-bg border border-border-subtle rounded-xl text-sm text-content-main focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                />
              </div>

              <!-- OPTIONAL: Digital Presence Section -->
              <div class="sm:col-span-2 pt-2 border-t border-border-subtle/60 space-y-3">
                <div class="flex items-center justify-between">
                  <span class="text-xs font-bold uppercase tracking-wider text-content-muted">Digital Presence</span>
                  <span class="text-[10px] text-content-muted/80 uppercase font-semibold">Optional</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                  <!-- Website URL -->
                  <div class="space-y-1">
                    <label for="website" class="block text-[11px] font-medium text-content-muted">Business Website URL</label>
                    <input
                      id="website"
                      v-model="form.tenant.website_url"
                      type="url"
                      placeholder="https://autofix.ph"
                      class="w-full px-3 py-2.5 bg-app-bg border border-border-subtle rounded-xl text-xs text-content-main focus:outline-none focus:border-primary"
                    />
                  </div>

                  <!-- Facebook Page URL -->
                  <div class="space-y-1">
                    <label for="facebook" class="block text-[11px] font-medium text-content-muted">Facebook Page URL</label>
                    <input
                      id="facebook"
                      v-model="form.tenant.facebook_url"
                      type="url"
                      placeholder="https://facebook.com/autofixexpress"
                      class="w-full px-3 py-2.5 bg-app-bg border border-border-subtle rounded-xl text-xs text-content-main focus:outline-none focus:border-primary"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- STEP 3: Verification Documents Upload -->
          <div v-if="currentStep === 3" class="space-y-5">
            <div class="space-y-1">
              <h2 class="text-2xl font-bold text-content-main">Verification Documents</h2>
              <p class="text-sm text-content-muted">Upload official documents to complete compliance verification.</p>
            </div>

            <div class="space-y-4">
              <!-- Business Registration -->
              <div class="p-4 border border-border-subtle bg-app-bg rounded-xl space-y-3">
                <div class="flex items-center justify-between">
                  <div>
                    <h4 class="text-sm font-semibold text-content-main">SEC or DTI Registration</h4>
                    <p class="text-xs text-content-muted">Business registration certificate</p>
                  </div>
                  <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded bg-slate-500/10 text-content-muted">Optional</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                  <input
                    v-model="form.documents.sec_dti.number"
                    type="text"
                    placeholder="Document Number"
                    class="px-3 py-2 bg-app-surface border border-border-subtle rounded-lg text-xs text-content-main focus:outline-none focus:border-primary"
                  />
                  <input
                    type="file"
                    accept=".pdf,.png,.jpg,.jpeg"
                    @change="handleFileUpload($event, 'sec_dti')"
                    class="text-xs text-content-muted file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20"
                  />
                </div>
              </div>

              <!-- BIR Form 2303 -->
              <div class="p-4 border border-border-subtle bg-app-bg rounded-xl space-y-3">
                <div class="flex items-center justify-between">
                  <div>
                    <h4 class="text-sm font-semibold text-content-main">BIR Form 2303</h4>
                    <p class="text-xs text-content-muted">Certificate of Registration</p>
                  </div>
                  <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded bg-slate-500/10 text-content-muted">Optional</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                  <input
                    v-model="form.documents.bir.number"
                    type="text"
                    placeholder="TIN Number"
                    class="px-3 py-2 bg-app-surface border border-border-subtle rounded-lg text-xs text-content-main focus:outline-none focus:border-primary"
                  />
                  <input
                    type="file"
                    accept=".pdf,.png,.jpg,.jpeg"
                    @change="handleFileUpload($event, 'bir')"
                    class="text-xs text-content-muted file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20"
                  />
                </div>
              </div>

              <!-- Mayor's Permit -->
              <div class="p-4 border border-border-subtle bg-app-bg rounded-xl space-y-3">
                <div class="flex items-center justify-between">
                  <div>
                    <h4 class="text-sm font-semibold text-content-main">Mayor's / Business Permit</h4>
                    <p class="text-xs text-content-muted">Local government permit</p>
                  </div>
                  <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded bg-slate-500/10 text-content-muted">Optional</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                  <input
                    v-model="form.documents.mayors_permit.number"
                    type="text"
                    placeholder="Permit Number"
                    class="px-3 py-2 bg-app-surface border border-border-subtle rounded-lg text-xs text-content-main focus:outline-none focus:border-primary"
                  />
                  <input
                    type="file"
                    accept=".pdf,.png,.jpg,.jpeg"
                    @change="handleFileUpload($event, 'mayors_permit')"
                    class="text-xs text-content-muted file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20"
                  />
                </div>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex items-center gap-3 pt-4">
            <button
              v-if="currentStep > 1"
              type="button"
              @click="currentStep--"
              class="w-1/3 py-3.5 px-4 border border-border-subtle rounded-xl text-sm font-semibold text-content-main hover:bg-app-bg transition-all"
            >
              Back
            </button>

            <button
              type="submit"
              class="flex-1 py-3.5 px-4 bg-primary hover:bg-primary-hover text-white font-semibold rounded-xl transition-all duration-150 shadow-sm active:scale-[0.99]"
            >
              {{ currentStep < 3 ? 'Continue' : 'Submit Application for Review' }}
            </button>
          </div>
        </form>

        <!-- Footer Link -->
        <div v-if="!isSubmitted" class="text-center text-xs text-content-muted">
          Already registered?
          <NuxtLink to="/portal/login" class="font-semibold text-primary hover:text-primary-hover transition-colors">
            Sign in
          </NuxtLink>
        </div>

      </div>
    </main>
  </div>
</template>

<script setup lang="ts">
definePageMeta({
  layout: false, // Disable automatic layout wrapping to handle it manually
  // middleware: 'guest',
})

import { reactive, ref, onMounted } from 'vue'
import { setOptions, importLibrary } from '@googlemaps/js-api-loader'
import { useApi } from '~/composables/useApi'

interface OptionItem {
  value: string
  label: string
}

const config = useRuntimeConfig()
const apiKey = config.public.googleMapsApiKey as string
const currentStep = ref(1)
const showPassword = ref(false)
const isSubmitted = ref(false)
const addressInputRef = ref<HTMLInputElement | null>(null)
const mapContainerRef = ref<HTMLDivElement | null>(null)
const isLoading = ref(true)
const isMapLoaded = ref(false)
const api = useApi() // Custom $fetch wrapper

const stepTitles = [
  'Owner Credentials',
  'Business & Location',
  'Verification Documents'
]

const { data: optionsData, pending } = await useAsyncData('tenant-options', () =>
  api<{ data: { business_types: OptionItem[] } }>('/tenants/options')
)

const defaultCoords = { lat: 14.599512, lng: 120.984222 }
let map: google.maps.Map | null = null
let marker: google.maps.Marker | null = null

const form = reactive({
  owner: {
    fullName: '',
    password: ''
  },
  tenant: {
    name: '',
    slug: '',
    business_type: 'auto_repair',
    contact_email: '',
    contact_phone: '912 345 6789',
    website_url: '',
    facebook_url: '',
    timezone: 'Asia/Manila',
    currency: 'PHP',
    locale: 'en'
  },
  location: {
    name: 'Main Workshop',
    full_address: '',
    address_line1: '',
    city: '',
    state_province: '',
    country_code: 'PH',
    postal_code: '',
    latitude: null as number | null,
    longitude: null as number | null,
    is_primary: true
  },
  documents: {
    sec_dti: { number: '', file: null as File | null },
    bir: { number: '', file: null as File | null },
    mayors_permit: { number: '', file: null as File | null }
  }
})

// Auto-generate URL slug from tenant name
const generateSlug = () => {
  form.tenant.slug = form.tenant.name
    .toLowerCase()
    .replace(/[^a-z0-9]/g, '')
}

// Simulated Map Click Handler (Works without API key)
const handleMockMapClick = (e: MouseEvent) => {
  const target = e.currentTarget as HTMLElement
  const rect = target.getBoundingClientRect()

  // Generate slightly varied mock coordinates based on click position
  const offsetX = (e.clientX - rect.left) / rect.width
  const offsetY = (e.clientY - rect.top) / rect.height

  form.location.latitude = defaultCoords.lat + (offsetY - 0.5) * 0.05
  form.location.longitude = defaultCoords.lng + (offsetX - 0.5) * 0.05
}

// Attach Google Places Autocomplete once step 2 renders
const initGooglePlaces = async () => {
  // If no valid key is present, stay in Mock Mode
  if (!apiKey || apiKey.includes('MOCK_KEY')) {
    console.warn('Google Maps API key not found. Running in mock map mode.')
    isMapLoaded.value = false
    return
  }

  try {
    setOptions({ apiKey, version: 'weekly' })

    const { Map } = await importLibrary('maps') as google.maps.MapsLibrary
    const { Marker } = await importLibrary('marker') as google.maps.MarkerLibrary
    const { Autocomplete } = await importLibrary('places') as google.maps.PlacesLibrary

    if (!mapContainerRef.value || !addressInputRef.value) return

    const map = new Map(mapContainerRef.value, {
      center: defaultCoords,
      zoom: 14,
      mapTypeControl: false,
      streetViewControl: false
    })

    const marker = new Marker({
      position: defaultCoords,
      map,
      draggable: true,
      title: 'Drag me to adjust location'
    })

    marker.addListener('dragend', (event: google.maps.MapMouseEvent) => {
      if (event.latLng) {
        form.location.latitude = event.latLng.lat()
        form.location.longitude = event.latLng.lng()
      }
    })

    const autocomplete = new Autocomplete(addressInputRef.value, {
      types: ['establishment', 'geocode'],
      componentRestrictions: { country: 'ph' }
    })

    autocomplete.addListener('place_changed', () => {
      const place = autocomplete.getPlace()
      if (!place.geometry?.location) return

      const location = place.geometry.location
      map.setCenter(location)
      map.setZoom(17)
      marker.setPosition(location)

      form.location.latitude = location.lat()
      form.location.longitude = location.lng()
      form.location.full_address = place.formatted_address || ''
    })

    isMapLoaded.value = true
  } catch (err) {
    console.error('Failed to load Google Maps SDK:', err)
    isMapLoaded.value = false
  }
}

watch(currentStep, async (newStep) => {
  if (newStep === 2) {
    await nextTick()
    await initGooglePlaces()
  }
})

// Document File Handler
const handleFileUpload = (event: Event, type: 'sec_dti' | 'bir' | 'mayors_permit') => {
  const target = event.target as HTMLInputElement
  if (target.files && target.files[0]) {
    form.documents[type].file = target.files[0]
  }
}

const handleNextStep = async () => {
  if (currentStep.value < 3) {
    currentStep.value++
    if (currentStep.value === 2) {
      setTimeout(initGooglePlaces, 100)
    }
  } else {
    try {
      const formData = new FormData()

      // Owner
      formData.append('owner[fullName]', form.owner.fullName)
      formData.append('owner[password]', form.owner.password)

      // Tenant
      formData.append('tenant[name]', form.tenant.name)
      formData.append('tenant[slug]', form.tenant.slug)
      formData.append('tenant[business_type]', form.tenant.business_type)
      formData.append('tenant[contact_email]', form.tenant.contact_email)
      formData.append('tenant[contact_phone]', form.tenant.contact_phone)
      if (form.tenant.website_url) formData.append('tenant[website_url]', form.tenant.website_url)
      if (form.tenant.facebook_url) formData.append('tenant[facebook_url]', form.tenant.facebook_url)

      // Location
      formData.append('location[name]', form.location.name)
      formData.append('location[full_address]', form.location.full_address)
      formData.append('location[city]', form.location.city)
      formData.append('location[state_province]', form.location.state_province)
      formData.append('location[country_code]', form.location.country_code)
      if (form.location.latitude !== null) {
        formData.append('location[latitude]', form.location.latitude.toString())
      }
      if (form.location.longitude !== null) {
        formData.append('location[longitude]', form.location.longitude.toString())
      }

      // Documents
      if (form.documents.sec_dti.number) {
        formData.append('documents[sec_dti][number]', form.documents.sec_dti.number)
      }
      if (form.documents.sec_dti.file instanceof File) {
        formData.append('documents[sec_dti][file]', form.documents.sec_dti.file)
        formData.append('documents[sec_dti][type]', "dti")
      }

      if (form.documents.bir.number) {
        formData.append('documents[bir][number]', form.documents.bir.number)
      }
      if (form.documents.bir.file instanceof File) {
        formData.append('documents[bir][file]', form.documents.bir.file)
        formData.append('documents[bir][type]', "bir")
      }

      if (form.documents.mayors_permit.number) {
        formData.append('documents[mayors_permit][number]', form.documents.mayors_permit.number)
      }
      if (form.documents.mayors_permit.file instanceof File) {
        formData.append('documents[mayors_permit][file]', form.documents.mayors_permit.file)
        formData.append('documents[mayors_permit][type]', "mayors_permit")
      }

      const response = await api<{ data: Object }>('/tenants/register', {
        method: 'POST',
        body: formData,
      })

      isSubmitted.value = true
    } catch (error) {
      // Catch and log exact Laravel 422 validation error messages
      if (error.response?._data?.errors) {
        console.error('Validation errors:', error.response._data.errors)
      } else {
        console.error('Failed to submit application:', error)
      }
    }
  }
}
</script>

<style scoped>

</style>