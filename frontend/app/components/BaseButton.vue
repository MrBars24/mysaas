<template>
  <button
    :type="type"
    :disabled="disabled || loading"
    :class="[
      // Base Styles
      'inline-flex items-center justify-center font-medium transition-all duration-150 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-60',

      // Shape Variants (Rounded, Pill, Circular Icon Button)
      shapeClasses,

      // Size Variants
      isIconOnly ? iconOnlySizeClasses[size] : sizeClasses[size],

      // Color Theme Variants
      variantClasses[variant]
    ]"
  >
    <!-- Loading Spinner -->
    <svg
      v-if="loading"
      class="animate-spin h-4 w-4 currentColor shrink-0"
      :class="{ 'mr-2': !isIconOnly && $slots.default }"
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
    >
      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg>

    <!-- Leading Icon Slot -->
    <span v-if="!loading && $slots.iconLeft && !isIconOnly" class="inline-flex shrink-0">
      <slot name="iconLeft" />
    </span>

    <!-- Icon Only Slot OR Default Label Slot -->
    <template v-if="isIconOnly">
      <span v-if="!loading" class="inline-flex shrink-0">
        <slot name="icon" />
      </span>
    </template>
    <template v-else>
      <slot />
    </template>

    <!-- Trailing Icon Slot -->
    <span v-if="!loading && $slots.iconRight && !isIconOnly" class="inline-flex shrink-0">
      <slot name="iconRight" />
    </span>
  </button>
</template>

<script setup lang="ts">
import { computed, useSlots } from 'vue'

interface Props {
  type?: 'button' | 'submit' | 'reset'
  variant?: 'primary' | 'secondary' | 'accent' | 'ghost'
  size?: 'sm' | 'md' | 'lg'
  shape?: 'rounded' | 'pill' | 'circle'
  disabled?: boolean
  loading?: boolean
}

const props = withDefaults(defineProps<Props>(), {
  type: 'button',
  variant: 'primary',
  size: 'md',
  shape: 'rounded',
  disabled: false,
  loading: false
})

const slots = useSlots()

// Check if button is purely an icon container (circle shape or 'icon' slot provided)
const isIconOnly = computed(() => props.shape === 'circle' || !!slots.icon)

// Shape styling
const shapeClasses = computed(() => {
  switch (props.shape) {
    case 'pill':
      return 'rounded-full'
    case 'circle':
      return 'rounded-full aspect-square p-0'
    case 'rounded':
    default:
      return 'rounded-lg'
  }
})

// Standard Button Sizes (Padding & Text)
const sizeClasses = {
  sm: 'px-3 py-1.5 text-xs gap-1.5',
  md: 'px-4 py-2 text-sm gap-2',
  lg: 'px-5 py-2.5 text-base gap-2.5'
}

// Icon-Only / Circle Button Sizes (Fixed Dimensions)
const iconOnlySizeClasses = {
  sm: 'h-8 w-8 text-xs',
  md: 'h-10 w-10 text-sm',
  lg: 'h-12 w-12 text-base'
}

const variantClasses = {
  primary: 'bg-primary text-white hover:bg-primary-hover active:scale-[0.98] focus-visible:ring-primary/50',
  secondary: 'bg-secondary text-white hover:bg-secondary-hover active:scale-[0.98] focus-visible:ring-secondary/50',
  accent: 'bg-accent text-white hover:bg-accent-hover active:scale-[0.98] focus-visible:ring-accent/50',
  ghost: 'bg-transparent text-content-main hover:bg-primary/10 hover:text-primary active:bg-primary/20 focus-visible:ring-primary/30'
}
</script>