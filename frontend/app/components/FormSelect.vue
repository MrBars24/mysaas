<template>
  <div class="flex flex-col gap-1.5 w-full">
    <label v-if="label" class="text-xs font-semibold text-content-main">
      {{ label }}
    </label>
    <div class="relative">
      <select
        :value="modelValue"
        :disabled="disabled"
        :class="[
          'w-full bg-app-surface text-content-main border rounded-lg appearance-none transition-all focus:outline-none focus:ring-2 disabled:cursor-not-allowed disabled:opacity-50 pr-8',
          sizeClasses[size],
          error ? 'border-red-500 focus:ring-red-500/20' : 'border-border-subtle focus:border-primary focus:ring-primary/20'
        ]"
        @change="$emit('update:modelValue', ($event.target as HTMLSelectElement).value)"
      >
        <option v-if="placeholder" value="" disabled selected>{{ placeholder }}</option>
        <option v-for="opt in options" :key="opt.value" :value="opt.value">
          {{ opt.label }}
        </option>
      </select>
      <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-content-muted">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
      </div>
    </div>
    <p v-if="error" class="text-xs text-red-500">{{ error }}</p>
  </div>
</template>

<script setup lang="ts">
interface Option { label: string; value: string | number }
interface Props {
  modelValue?: string | number
  label?: string
  placeholder?: string
  options: Option[]
  size?: 'sm' | 'md' | 'lg'
  error?: string
  disabled?: boolean
}

withDefaults(defineProps<Props>(), { size: 'md', disabled: false })
defineEmits(['update:modelValue'])

const sizeClasses = {
  sm: 'px-2.5 py-1 text-xs',
  md: 'px-3.5 py-2 text-sm',
  lg: 'px-4 py-2.5 text-base'
}
</script>