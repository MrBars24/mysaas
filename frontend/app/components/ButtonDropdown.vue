<template>
  <div ref="dropdownRef" class="relative inline-flex">
    <!-- Standard Single Button Trigger -->
    <button
      v-if="!split"
      type="button"
      :disabled="disabled || loading"
      :class="[
        baseButtonClasses,
        variantClasses[variant],
        sizeClasses[size]
      ]"
      @click="toggleOpen"
    >
      <!-- Loading Spinner -->
      <svg v-if="loading" class="animate-spin h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
      </svg>

      <!-- Label / Left Icon Slot -->
      <slot name="label">
        <span>{{ label }}</span>
      </slot>

      <!-- Caret Icon -->
      <svg
        :class="['h-4 w-4 shrink-0 transition-transform duration-200', isOpen ? 'rotate-180' : '']"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </button>

    <!-- Split Button Trigger Group -->
    <div v-else class="inline-flex rounded-lg shadow-xs">
      <!-- Primary Main Action Button -->
      <button
        type="button"
        :disabled="disabled || loading"
        :class="[
          baseButtonClasses,
          variantClasses[variant],
          sizeClasses[size],
          'rounded-r-none border-r border-black/10'
        ]"
        @click="$emit('main-click')"
      >
        <slot name="label">
          <span>{{ label }}</span>
        </slot>
      </button>

      <!-- Chevron Dropdown Toggle -->
      <button
        type="button"
        :disabled="disabled || loading"
        :class="[
          baseButtonClasses,
          variantClasses[variant],
          splitCaretSizeClasses[size],
          'rounded-l-none'
        ]"
        @click="toggleOpen"
      >
        <svg
          :class="['h-4 w-4 shrink-0 transition-transform duration-200', isOpen ? 'rotate-180' : '']"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
    </div>

    <!-- Dropdown Menu Panel -->
    <Transition
      enter-active-class="transition duration-100 ease-out"
      enter-from-class="transform scale-95 opacity-0"
      enter-to-class="transform scale-100 opacity-100"
      leave-active-class="transition duration-75 ease-in"
      leave-from-class="transform scale-100 opacity-100"
      leave-to-class="transform scale-95 opacity-0"
    >
      <div
        v-if="isOpen"
        :class="[
          'absolute z-50 mt-1 min-w-[12rem] rounded-lg border border-slate-100 bg-white p-1.5 shadow-lg ring-1 ring-black/5 focus:outline-none',
          placementClasses[placement]
        ]"
      >
        <!-- Slot for Custom Header or Direct Content Override -->
        <slot name="items" :close="close">
          <template v-for="(item, index) in items" :key="index">
            <!-- Divider Line -->
            <div v-if="item.divider" class="my-1 border-t border-slate-100" />

            <!-- Interactive Item -->
            <button
              v-else
              type="button"
              :disabled="item.disabled"
              :class="[
                'group flex w-full items-center justify-between rounded-md px-3 py-2 text-xs font-medium transition-colors',
                item.danger
                ? 'text-rose-600 hover:bg-rose-50'
                  : 'text-slate-700 hover:bg-slate-100 hover:text-slate-900',
                item.disabled ? 'cursor-not-allowed opacity-50' : 'cursor-pointer'
              ]"
              @click="handleItemClick(item)"
            >
              <div class="flex items-center gap-2">
                <!-- Optional Item Icon Slot / Render -->
                <component :is="item.icon" v-if="item.icon" class="h-4 w-4 shrink-0 opacity-70 group-hover:opacity-100" />
                <span>{{ item.label }}</span>
              </div>

              <!-- Optional Badge/Shortcut -->
              <span v-if="item.badge" class="text-[10px] text-slate-400 font-mono">{{ item.badge }}</span>
            </button>
          </template>
        </slot>
      </div>
    </Transition>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount } from 'vue'

export interface DropdownItem {
  label?: string
  icon?: any
  badge?: string
  disabled?: boolean
  danger?: boolean
  divider?: boolean
  onClick?: () => void
}

interface Props {
  label?: string
  variant?: 'primary' | 'secondary' | 'accent' | 'ghost'
  size?: 'sm' | 'md' | 'lg'
  placement?: 'bottom-left' | 'bottom-right' | 'top-left' | 'top-right'
  split?: boolean
  disabled?: boolean
  loading?: boolean
  items?: DropdownItem[]
}

const props = withDefaults(defineProps<Props>(), {
  label: 'Options',
  variant: 'primary',
  size: 'md',
  placement: 'bottom-left',
  split: false,
  disabled: false,
  loading: false,
  items: () => []
})

const emit = defineEmits<{
  (e: 'select', item: DropdownItem): void
  (e: 'main-click'): void
}>()

const isOpen = ref(false)
const dropdownRef = ref<HTMLElement | null>(null)

const toggleOpen = () => {
  if (!props.disabled && !props.loading) {
    isOpen.value = !isOpen.value
  }
}

const close = () => {
  isOpen.value = false
}

const handleItemClick = (item: DropdownItem) => {
  if (item.disabled) return
  if (item.onClick) item.onClick()
  emit('select', item)
  close()
}

// Close dropdown on click outside
const handleClickOutside = (event: MouseEvent) => {
  if (dropdownRef.value && !dropdownRef.value.contains(event.target as Node)) {
    close()
  }
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onBeforeUnmount(() => {
  document.removeEventListener('click', handleClickOutside)
})

// CSS Style Maps
const baseButtonClasses = 'inline-flex items-center justify-center font-medium transition-all duration-150 ease-in-out focus:outline-none disabled:cursor-not-allowed disabled:opacity-60 rounded-lg'

const sizeClasses = {
  sm: 'px-3 py-1.5 text-xs gap-1.5',
  md: 'px-4 py-2 text-sm gap-2',
  lg: 'px-5 py-2.5 text-base gap-2.5'
}

const splitCaretSizeClasses = {
  sm: 'px-2 py-1.5 text-xs',
  md: 'px-2.5 py-2 text-sm',
  lg: 'px-3 py-2.5 text-base'
}

const variantClasses = {
  primary: 'bg-slate-900 text-white hover:bg-slate-800 active:scale-[0.98]',
  secondary: 'border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 hover:text-slate-900 active:scale-[0.98]',
  accent: 'bg-amber-500 text-white hover:bg-amber-600 active:scale-[0.98]',
  ghost: 'bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900 active:scale-[0.98]'
}

const placementClasses = {
  'bottom-left': 'left-0 top-full',
  'bottom-right': 'right-0 top-full',
  'top-left': 'left-0 bottom-full mb-1',
  'top-right': 'right-0 bottom-full mb-1'
}
</script>

<style scoped>

</style>