<template>
  <div class="p-8 space-y-8 bg-app-bg min-h-screen text-content-main">
    <div>
      <h1 class="text-2xl font-bold">Form Elements UI Kit</h1>
      <p class="text-sm text-content-muted">Theme-aware form fields with design states and sizes.</p>
    </div>

    <!-- Text Inputs & States -->
    <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
      <h2 class="text-sm font-semibold uppercase tracking-wider text-content-muted">Text Input States & Sizes</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <FormInput v-model="formData.text" label="Small Size" size="sm" placeholder="Enter text..." />
        <FormInput v-model="formData.text" label="Medium (Default)" size="md" placeholder="Enter text..." hint="Standard text field" />
        <FormInput v-model="formData.text" label="Large Size" size="lg" placeholder="Enter text..." />
        <FormInput v-model="formData.text" label="Error State" error="This field is required" />
        <FormInput v-model="formData.text" label="Disabled State" disabled placeholder="Cannot edit" />
      </div>
    </section>

    <!-- Select & File Picker -->
    <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
      <h2 class="text-sm font-semibold uppercase tracking-wider text-content-muted">Select & File Upload</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <FormSelect v-model="formData.select" label="Branch Location" :options="branchOptions" placeholder="Select a branch" />
        <FormFilePicker label="Attach Receipt / Image" />
      </div>
    </section>

    <!-- Toggles, Radios & Checkboxes -->
    <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
      <h2 class="text-sm font-semibold uppercase tracking-wider text-content-muted">Selection Controls</h2>
      <div class="flex flex-wrap items-center gap-6">
        <FormCheckbox v-model="formData.checkbox" label="Remember Login" />
        <FormToggle v-model="formData.toggle" label="Enable Notifications" />

        <div class="flex gap-3 items-center border-l border-border-subtle pl-6">
          <FormRadio v-model="formData.radio" value="option1" name="demo" label="Option A" />
          <FormRadio v-model="formData.radio" value="option2" name="demo" label="Option B" />
        </div>
      </div>
    </section>

    <!-- Option Group & Slider -->
    <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
      <h2 class="text-sm font-semibold uppercase tracking-wider text-content-muted">Option Group & Slider</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="text-xs font-semibold mb-2 block">Segmented Filter</label>
          <FormOptionGroup v-model="formData.optionGroup" :options="filterOptions" />
        </div>
        <FormSlider v-model="formData.slider" label="Service Range (KM)" :min="0" :max="50" />
      </div>
    </section>

    <!-- Date & Time Pickers -->
    <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
      <h2 class="text-sm font-semibold uppercase tracking-wider text-content-muted">Date & Time Pickers</h2>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <FormDateTimePicker type="date" v-model="formData.date" label="Date Picker" />
        <FormDateTimePicker type="time" v-model="formData.time" label="Time Picker" />
        <FormDateTimePicker type="datetime-local" v-model="formData.datetime" label="Date & Time" />
        <FormDateTimePicker type="range" v-model:rangeStart="formData.startDate" v-model:rangeEnd="formData.endDate" label="Date Range" />
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
import { reactive } from 'vue'

const formData = reactive({
  text: '',
  select: '',
  checkbox: true,
  toggle: false,
  radio: 'option1',
  optionGroup: 'all',
  slider: 15,
  date: '',
  time: '',
  datetime: '',
  startDate: '',
  endDate: ''
})

const branchOptions = [
  { label: 'Makati Branch', value: 'makati' },
  { label: 'BGC Branch', value: 'bgc' },
  { label: 'Quezon City Branch', value: 'qc' }
]

const filterOptions = [
  { label: 'All Bookings', value: 'all' },
  { label: 'Confirmed', value: 'confirmed' },
  { label: 'Pending', value: 'pending' }
]
</script>