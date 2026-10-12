<template>
  <label :class="['inline-flex items-center gap-2 cursor-pointer select-none', disabled ? 'cursor-not-allowed opacity-50' : '']">
    <input
      type="radio"
      :name="name"
      :value="value"
      :checked="modelValue === value"
      :disabled="disabled"
      class="border-border-subtle text-primary focus:ring-primary/20 accent-primary w-4 h-4 transition"
      @change="$emit('update:modelValue', value)"
    />
    <span v-if="label" class="text-sm text-content-main">{{ label }}</span>
  </label>
</template>

<script setup lang="ts">
defineProps<{ modelValue?: any; value: any; name?: string; label?: string; disabled?: boolean }>()
defineEmits(['update:modelValue'])
</script>