<template>
  <label :class="['inline-flex items-center gap-2 cursor-pointer select-none', disabled ? 'cursor-not-allowed opacity-50' : '']">
    <input
      type="checkbox"
      :checked="modelValue"
      :disabled="disabled"
      class="rounded border-border-subtle text-primary focus:ring-primary/20 accent-primary w-4 h-4 transition"
      @change="$emit('update:modelValue', ($event.target as HTMLInputElement).checked)"
    />
    <span v-if="label" class="text-sm text-content-main">{{ label }}</span>
  </label>
</template>

<script setup lang="ts">
defineProps<{ modelValue?: boolean; label?: string; disabled?: boolean }>()
defineEmits(['update:modelValue'])
</script>