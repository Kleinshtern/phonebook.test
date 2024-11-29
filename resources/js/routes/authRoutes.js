import Login from "@/components/Authenticate/Login.vue";
import Register from "@/components/Authenticate/Register.vue";

const authRoutes = [
    {
        path: "/login",
        name: "Login",
        component: Login
    },
    {
        path: "/register",
        name: "Register",
        component: Register
    }
]

export default authRoutes
