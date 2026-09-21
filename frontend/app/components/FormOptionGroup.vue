<template>
  <div class="inline-flex p-1 bg-app-bg border border-border-subtle rounded-xl gap-1">
    <button
      v-for="opt in options"
      :key="opt.value"
      type="button"
      :disabled="disabled"
      :class="[
        'px-3 py-1.5 text-xs font-medium rounded-lg transition-all duration-150',
        modelValue === opt.value
          ? 'bg-app-surface text-content-main shadow-xs'
          : 'text-content-muted hover:text-content-main'
      ]"
      @click="$emit('update:modelValue', opt.value)"
    >
      {{ opt.label }}
    </button>
  </div>
</template>

<script setup lang="ts">
interface Option { label: string; value: string | number }
defineProps<{ modelValue: string | number; options: Option[]; disabled?: boolean }>()
defineEmits(['update:modelValue'])
</script>