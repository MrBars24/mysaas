<template>
  <section v-if="activeComponentSection === 'all' || activeComponentSection === 'typography'" class="space-y-4 mt-3">
    <h2 class="text-sm font-semibold tracking-tight text-slate-900 border-b border-slate-100 pb-2">Typography</h2>

    <div>
      <h2 class="text-h2">Typography System</h2>
      <span class="text-subtitle-2">
        Standardized, theme-aware typographic scales and weights across the app.
      </span>
    </div>

    <!-- Headings Scale -->
    <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
      <span class="text-overline">Headings (1 - 6)</span>
      <div class="space-y-3">
        <div><h1 class="text-h1">Heading 1 (48px)</h1></div>
        <div><h2 class="text-h2">Heading 2 (36px)</h2></div>
        <div><h3 class="text-h3">Heading 3 (30px)</h3></div>
        <div><h4 class="text-h4">Heading 4 (24px)</h4></div>
        <div><h5 class="text-h5">Heading 5 (20px)</h5></div>
        <div><h6 class="text-h6">Heading 6 (18px)</h6></div>
      </div>
    </section>

    <!-- Subtitles & Body -->
    <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
      <span class="text-overline">Subtitles & Body</span>
      <div class="space-y-4 max-w-3xl">
        <div>
          <span class="text-subtitle-1">Subtitle 1 — Medium weight text for section sub-headers.</span>
        </div>
        <div>
          <span class="text-subtitle-2">Subtitle 2 — Muted medium text for secondary labels.</span>
        </div>
        <div>
          <span class="text-body-1">
            Body 1 — Standard paragraph text used across card descriptions, main table columns, and general reading content. It features comfortable line-height for optimal readability.
          </span>
        </div>
        <div>
          <span class="text-body-2">
            Body 2 — Smaller body text for dense data tables, sidebar items, and secondary descriptions.
          </span>
        </div>
      </div>
    </section>

    <!-- Captions, Overlines & Added Utilities -->
    <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
      <span class="text-overline">Captions, Overline & Special Variants</span>
      <div class="space-y-4">
        <div>
          <span class="text-overline">Category Overline (10px uppercase)</span>
        </div>
        <div>
          <span class="text-caption">Caption — Used for timestamps, subtle metadata, and input help text.</span>
        </div>
        <div>
          <span class="text-lead text-primary">Lead Text — High-impact hero introduction phrase.</span>
          <!-- <BaseTypography variant="lead" color="primary">Lead Text — High-impact hero introduction phrase.</BaseTypography> -->
        </div>
        <div class="flex items-center gap-3">
          <span class="text-badge text-accent">Badge Text</span>
          <span class="text-code">const theme = 'tailwind'</span>
        </div>
      </div>
    </section>

    <!-- Font Weights Showcase -->
    <section class="p-6 bg-app-surface rounded-xl border border-border-subtle space-y-4">
      <span class="text-overline">Font Weights (Thin to Bolder)</span>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-lg">
        <span class="text-body-1 font-thin">Thin Weight (100)</span>
        <span class="text-body-1 font-light">Light Weight (300)</span>
        <span class="text-body-1 font-regular">Regular Weight (400)</span>
        <span class="text-body-1 font-medium">Medium Weight (500)</span>
        <span class="text-body-1 font-semibold">Semibold Weight (600)</span>
        <span class="text-body-1 font-bold">Bold Weight (700)</span>
        <span class="text-body-1 font-bolder">Bolder / Black Weight (900)</span>
      </div>
    </section>
  </section>
</template>

<script setup lang="ts">
interface Props {
  activeComponentSection?: string
}

const props = withDefaults(defineProps<Props>(), {
  activeComponentSection: 'all',
})
</script>

<style scoped>

</style>