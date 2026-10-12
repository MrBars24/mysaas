import '#app'

declare module '#app' {
  interface RuntimeNuxtHooks {
    'sidebar:selected': (sectionId: string) => void
  }
}

export {}