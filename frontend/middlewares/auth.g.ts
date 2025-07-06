import { useAuthStore } from "~/stores/auth"

export default defineNuxtRouteMiddleware((to)=> {
    const auth = useAuthStore()
    if(!auth.token && to.path !== '/auth/login') {
        auth.isLoggedId = false
        return navigateTo('/auth/login')
    }
})