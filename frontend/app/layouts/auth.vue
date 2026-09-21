<template>
  <div class="min-h-screen bg-app-bg text-content-main flex lg:flex-row font-sans">

    <!-- LEFT PANEL: Brand & Hero Showcase -->
    <aside class="w-full lg:w-[45%] bg-sidebar text-sidebar-text p-8 lg:p-12 flex flex-col justify-between relative overflow-hidden min-h-[400px] lg:min-h-screen">

      <!-- Background Ambient Glow -->
      <div
        class="absolute -top-20 -right-20 w-96 h-96 rounded-full opacity-20 pointer-events-none bg-gradient-to-t from-transparent to-primary"

      ></div>

      <slot name="leftpanel" />
    </aside>

    <!-- RIGHT PANEL: Authentication Form -->
    <main class="w-full lg:w-[55%] bg-app-surface p-6 sm:p-12 lg:p-16 flex items-center justify-center min-h-[600px]">
      <div class="w-full max-w-md space-y-8">

        <slot name="rightpanel" />

      </div>
    </main>
  </div>
</template>

<script setup lang="ts">

</script>

<style scoped>

</style>