export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: "client",
    htmlAttrs: {
      lang: "en",
    },
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      { hid: "description", name: "description", content: "" },
      { name: "format-detection", content: "telephone=no" },
    ],
    link: [{ rel: "icon", type: "image/x-icon", href: "/favicon.ico" }],
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    "@/assets/css/main.css",
    "@fortawesome/fontawesome-svg-core/styles.css",
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: ["~/plugins/fontawesome.js"],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/tailwindcss
  ],

  axios: {
    credentials: true,
    baseURL: "http://localhost:8000/api",
  },

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: ["@nuxtjs/dotenv", "@nuxtjs/auth-next", "@nuxtjs/axios"],
  auth: {
    strategies: {
      laravelSanctum: {
        provider: "laravel/sanctum",
        token: {
          property: "token",
          required: true,
          maxAge: 1800,
          type: "Bearer",
        },
        url: "http://localhost:8000/api",
        endpoints: {
          login: { url: "/auth/login", method: "post", propertyName: "token" },
          logout: { url: "/auth/logout", method: "post" },
          user: {
            url: "/auth/user",
            method: "get",
          },
        },
      },
    },
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    transpile: ["defu"],
    postcss: {
      postcssOptions: {
        plugins: {
          tailwindcss: {},
          autoprefixer: {},
        },
      },
    },
  },
};
