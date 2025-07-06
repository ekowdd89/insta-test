import {defineStore} from 'pinia'
export const useAuthStore = defineStore('auth',{
    state: () => ({
        token:  import.meta.client ? localStorage.getItem('token') : null,
        user : {},
        isLoggedId:false
    }),
    actions: {
        login(token: string) {
            this.token = token
            this.isLoggedId = true
            localStorage.setItem('token', token)
        },
        logout() {
            this.token = ''
            localStorage.removeItem('token')
            this.isLoggedId = false
        } 
    }
})