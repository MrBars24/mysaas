<template>
  <div class="flex flex-col gap-1.5 w-full">
    <label v-if="label" :for="id" class="text-xs font-semibold text-content-main">
      {{ label }} <span v-if="required" class="text-accent">*</span>
    </label>
    <div class="relative flex items-center">
      <input
        :id="id"
        :type="type"
        :value="modelValue"
        :placeholder="placeholder"
        :disabled="disabled"
        :class="[
          'w-full bg-app-surface text-content-main border rounded-lg transition-all duration-150 focus:outline-none focus:ring-2 disabled:cursor-not-allowed disabled:opacity-50 placeholder:text-content-muted/60',
          sizeClasses[size],
          error
            ? 'border-red-500 focus:ring-red-500/20'
            : 'border-border-subtle focus:border-primary focus:ring-primary/20'
        ]"
        @input="$emit('update:modelValue', ($event.target as HTMLInputElement).value)"
      />
    </div>
    <p v-if="error" class="text-xs text-red-500">{{ error }}</p>
    <p v-else-if="hint" class="text-xs text-content-muted">{{ hint }}</p>
  </div>
</template>

<script setup lang="ts">
interface Props {
  modelValue?: string | number
  label?: string
  placeholder?: string
  type?: string
  id?: string
  size?: 'sm' | 'md' | 'lg'
  error?: string
  hint?: string
  disabled?: boolean
  required?: boolean
}

withDefaults(defineProps<Props>(), {
  type: 'text',
  size: 'md',
  disabled: false,
  required: false
})

defineEmits(['update:modelValue'])

const sizeClasses = {
  sm: 'px-2.5 py-1 text-xs',
  md: 'px-3.5 py-2 text-sm',
  lg: 'px-4 py-2.5 text-base'
}
</script>