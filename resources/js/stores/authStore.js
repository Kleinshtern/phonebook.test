import { defineStore } from 'pinia';
import axios from "axios";

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        isAuthenticated: false
    }),
    actions: {
        async csrf() {
            await axios.get('/sanctum/csrf-cookie');
        },
        async fetchUser() {
            await axios.get('/api/user').then(response => {
                this.user = response.data;
                this.isAuthenticated = true;
            }).catch(err => {
                this.user = null;
                this.isAuthenticated = false;
            })
        },
        async login(credentials) {
            await axios.post('/login', credentials).then(response => {
                this.router.push('/');
            }).catch(err => {
                alert(JSON.stringify(err.response.data));
            })
        },
        async register(credentials) {
            await axios.post("/register", credentials).then(response => {
                this.router.push('/');
            }).catch(err => {
                alert(JSON.stringify(err.response.data));
            })
        },
        async logout() {
            await axios.post("/logout").then(response => {
                    window.location.reload()
                })
                .catch(err => {
                    alert(JSON.stringify(err.response.data))
                })
        }
    },
});
