<script setup>
    import { Field, Form, ErrorMessage } from 'vee-validate';
    import * as yup from 'yup';

    import {useAuthStore} from "@/stores/authStore.js";

    const authStore = useAuthStore();

    const schema = yup.object({
        email: yup.string().email().required("E-mail is required"),
        password: yup.string().min(6).required("Password is required"),
    });

    const submitForm = (values) => {
        authStore.login(values);
    }
</script>

<template>
    <div class="w-screen h-screen bg-blue-100 flex items-center justify-center">
        <div class="w-2/3 lg:w-1/3 shadow-md m-auto bg-white rounded-md p-5">
            <h1 class="text-3xl font-bold text-gray-900 text-center">Login</h1>
            <Form
                class="flex flex-col gap-2"
                :validation-schema="schema"
                @submit="submitForm"
            >
                <div class="flex flex-col items-start">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">E-mail</label>
                    <Field
                        name="email"
                        type="email"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    ></Field>
                    <ErrorMessage name="email" class="text-red-500"></ErrorMessage>
                </div>
                <div class="flex flex-col items-start">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <Field
                        name="password"
                        type="password"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    ></Field>
                    <ErrorMessage name="password" class="text-red-500"></ErrorMessage>
                </div>

                <div class="flex gap-2">
                    <router-link to="/register" class="block text-black bg-white font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">
                        Зарегистрироваться
                    </router-link>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">
                        Вход
                    </button>
                </div>
            </Form>
        </div>
    </div>
</template>
