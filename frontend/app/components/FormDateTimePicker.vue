<template>
  <div class="flex flex-col gap-1.5 w-full">
    <label v-if="label" class="text-xs font-semibold text-content-main">{{ label }}</label>

    <!-- Range Mode -->
    <div v-if="type === 'range'" class="flex items-center gap-2">
      <input
        type="date"
        :value="rangeStart"
        :disabled="disabled"
        class="w-full bg-app-surface text-content-main border border-border-subtle rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
        @input="$emit('update:rangeStart', ($event.target as HTMLInputElement).value)"
      />
      <span class="text-xs text-content-muted">to</span>
      <input
        type="date"
        :value="rangeEnd"
        :disabled="disabled"
        class="w-full bg-app-surface text-content-main border border-border-subtle rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
        @input="$emit('update:rangeEnd', ($event.target as HTMLInputElement).value)"
      />
    </div>

    <!-- Single Date / Time / DateTime Mode -->
    <input
      v-else
      :type="type"
      :value="modelValue"
      :disabled="disabled"
      class="w-full bg-app-surface text-content-main border border-border-subtle rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 disabled:opacity-50"
      @input="$emit('update:modelValue', ($event.target as HTMLInputElement).value)"
    />
  </div>
</template>

<script setup lang="ts">
interface Props {
  type?: 'date' | 'time' | 'datetime-local' | 'range'
  modelValue?: string
  rangeStart?: string
  rangeEnd?: string
  label?: string
  disabled?: boolean
}

withDefaults(defineProps<Props>(), { type: 'date', disabled: false })
defineEmits(['update:modelValue', 'update:rangeStart', 'update:rangeEnd'])
</script>