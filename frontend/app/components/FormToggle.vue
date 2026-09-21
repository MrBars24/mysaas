<template>
  <label :class="['inline-flex items-center gap-3 cursor-pointer select-none', disabled ? 'cursor-not-allowed opacity-50' : '']">
    <button
      type="button"
      role="switch"
      :aria-checked="modelValue"
      :disabled="disabled"
      :class="[
        'relative inline-flex h-6 w-11 shrink-0 rounded-full transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary/20',
        modelValue ? 'bg-primary' : 'bg-border-subtle'
      ]"
      @click="$emit('update:modelValue', !modelValue)"
    >
      <span
        :class="[
          'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow-md ring-0 transition duration-200 ease-in-out mt-0.5 ml-0.5',
          modelValue ? 'translate-x-5' : 'translate-x-0'
        ]"
      />
    </button>
    <span v-if="label" class="text-sm text-content-main">{{ label }}</span>
  </label>
</template>

<script setup lang="ts">
defineProps<{ modelValue?: boolean; label?: string; disabled?: boolean }>()
defineEmits(['update:modelValue'])
</script>