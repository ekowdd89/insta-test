// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  css: ['~/assets/css/main.css'],
  ui: {
    colorMode: false
  },
  compatibilityDate: '2025-05-15',
  devtools: { enabled: true },
  // plugins: ['~/plugins/urql.ts'],
  modules: [
    '@nuxt/content',
    '@nuxt/eslint',
    '@nuxt/fonts',
    '@nuxt/icon',
    '@nuxt/image',
    '@nuxt/scripts',
    '@nuxt/test-utils',
    '@nuxt/ui',
    '@pinia/nuxt'
    // [
    //   '@bicou/nuxt-urql',
    //   // {
    //   //   endpoint: 'http://localhost:8000/v1/{resource}',
    //   //   headers: () => {
    //   //     const token = import.meta.client ? localStorage.getItem('token') : null
    //   //     return {
    //   //       ...(token ? { Authorization: `Bearer ${token}` } : {}),
    //   //     }
    //   //   }
    //   // }
    // ],
  ],
})