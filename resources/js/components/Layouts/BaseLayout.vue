<script setup>
    import {useAuthStore} from "@/stores/authStore.js";

    const authStore = useAuthStore();

</script>

<template>
    <header class="flex justify-between items-center px-5 py-3 border-b">
        <h3 class="text-3xl font-bold">Телефонная книга</h3>

        <div class="flex gap-2 items-center">
            <p>{{ authStore.user.email }}</p>

            <v-tooltip text="Выход" location="bottom">
                <template v-slot:activator="{ props }">
                    <v-btn
                        v-bind="props"
                        variant="text"
                        color="primary"
                        icon="mdi mdi-door-open"
                        size="small"
                        @click="authStore.logout()"
                    ></v-btn>
                </template>
            </v-tooltip>
        </div>
    </header>
    <main class="px-5 pt-3">
        <slot></slot>
    </main>
</template>
