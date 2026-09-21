<template>
  <div class="flex flex-col gap-1.5 w-full">
    <label v-if="label" class="text-xs font-semibold text-content-main">{{ label }}</label>
    <label
      :class="[
        'flex flex-col items-center justify-center w-full border-2 border-dashed rounded-xl cursor-pointer transition-colors bg-app-surface/50 hover:bg-app-surface',
        error ? 'border-red-500/50' : 'border-border-subtle hover:border-primary',
        disabled ? 'cursor-not-allowed opacity-50' : ''
      ]"
      class="p-4 text-center"
    >
      <svg class="w-8 h-8 text-content-muted mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
      <span class="text-xs font-medium text-content-main">Click to upload or drag & drop</span>
      <span class="text-[10px] text-content-muted mt-1">{{ accept || 'SVG, PNG, JPG or GIF' }}</span>
      <input type="file" class="hidden" :accept="accept" :disabled="disabled" @change="onFileChange" />
    </label>
    <p v-if="fileName" class="text-xs text-primary font-medium">Selected: {{ fileName }}</p>
    <p v-if="error" class="text-xs text-red-500">{{ error }}</p>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'

interface Props { label?: string; accept?: string; error?: string; disabled?: boolean }
defineProps<Props>()
const emit = defineEmits(['change'])

const fileName = ref('')
const onFileChange = (e: Event) => {
  const file = (e.target as HTMLInputElement).files?.[0]
  if (file) {
    fileName.value = file.name
    emit('change', file)
  }
}
</script>