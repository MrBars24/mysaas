// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: false, // Pure Single Page Application mode
  modules: [
    '@nuxtjs/tailwindcss',
    '@pinia/nuxt'
  ],
  css: ['~/assets/css/main.css'],
  future: { compatibilityVersion: 4 }, // Nuxt 4 structure
  runtimeConfig: {
    public: {
      apiBase: process.env.NUXT_PUBLIC_API_BASE || 'http://localhost:8000/api/v1',
    }
  },
  // tailwind config
  tailwindcss: {
    config: {
      theme: {
        extend: {
          colors: {
            primary: {
              DEFAULT: 'rgb(var(--color-primary) / <alpha-value>)',
              hover: 'rgb(var(--color-primary-hover) / <alpha-value>)',
              light: 'rgb(var(--color-primary-light) / <alpha-value>)',
            },
            secondary: {
              DEFAULT: 'rgb(var(--color-secondary) / <alpha-value>)',
              hover: 'rgb(var(--color-secondary-hover) / <alpha-value>)',
              light: 'rgb(var(--color-secondary-light) / <alpha-value>)',
            },
            accent: {
              DEFAULT: 'rgb(var(--color-accent) / <alpha-value>)',
              hover: 'rgb(var(--color-accent-hover) / <alpha-value>)',
              light: 'rgb(var(--color-accent-light) / <alpha-value>)',
            },
            sidebar: {
              DEFAULT: 'rgb(var(--color-sidebar-bg) / <alpha-value>)',
              text: 'rgb(var(--color-sidebar-text) / <alpha-value>)',
              muted: 'rgb(var(--color-sidebar-muted) / <alpha-value>)',
            },
            app: {
              bg: 'rgb(var(--color-app-bg) / <alpha-value>)',
              surface: 'rgb(var(--color-surface) / <alpha-value>)',
            },
            content: {
              main: 'rgb(var(--color-text-main) / <alpha-value>)',
              muted: 'rgb(var(--color-text-muted) / <alpha-value>)',
            },
            border: {
              subtle: 'rgb(var(--color-border) / <alpha-value>)',
            },
          },
        },
      },
    },
  },
})
