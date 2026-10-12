<template>
  <div class="flex flex-col gap-1.5 w-full">
    <div class="flex justify-between items-center text-xs font-semibold text-content-main">
      <span v-if="label">{{ label }}</span>
      <span class="text-primary">{{ modelValue }}</span>
    </div>
    <input
      type="range"
      :min="min"
      :max="max"
      :step="step"
      :value="modelValue"
      :disabled="disabled"
      class="w-full h-2 bg-border-subtle rounded-lg appearance-none cursor-pointer accent-primary disabled:cursor-not-allowed"
      @input="$emit('update:modelValue', Number(($event.target as HTMLInputElement).value))"
    />
  </div>
</template>

<script setup lang="ts">
withDefaults(defineProps<{ modelValue: number; min?: number; max?: number; step?: number; label?: string; disabled?: boolean }>(), {
  min: 0,
  max: 100,
  step: 1
})
defineEmits(['update:modelValue'])
</script>