<script setup>
    import {usePhonebookStore} from "@/stores/phonebookStore.js";

    import {onMounted} from "vue";
    import router from "@/router.js";

    const store = usePhonebookStore();

    onMounted(() => {
        store.fetchPhonebookNumber();
    })
</script>

<template>
    <template v-if="store.loading">
        Loading...
    </template>
    <template v-else>
        <div class="mb-2">
            <h3 class="text-2xl font-bold mb-2">Избранные контакты</h3>
            <v-table>
                <thead>
                    <tr>
                        <th class="font-weight-bold">№</th>
                        <th class="font-weight-bold">Имя</th>
                        <th>
                            <v-icon class="mdi mdi-cog"></v-icon>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <template v-if="store.favoriteNumbers?.length > 0">
                        <tr v-for="(contact, key) in store.favoriteNumbers" :key="contact.id">
                            <td>{{ key + 1}}</td>
                            <td class="font-weight-bold">{{ contact.name }}</td>
                            <td>
                                <v-tooltip text="Удалить из избранного">
                                    <template v-slot:activator="{ props }">
                                        <v-btn
                                            v-bind="props"
                                            variant="text"
                                            color="primary"
                                            icon="mdi mdi-star"
                                            size="small"
                                            @click="store.unmarkAsFavorite(contact.id)"
                                        ></v-btn>
                                    </template>
                                </v-tooltip>
                                <v-tooltip text="Просмотр">
                                    <template v-slot:activator="{ props }">
                                        <v-btn
                                            @click="router.push('/contact/' + contact.id + '/card')"
                                            v-bind="props"
                                            variant="text"
                                            icon="mdi mdi-door-open"
                                            size="small"
                                            color="primary"
                                        ></v-btn>
                                    </template>
                                </v-tooltip>
                                <v-tooltip text="Редактировать">
                                    <template v-slot:activator="{ props }">
                                        <v-btn
                                            v-bind="props"
                                            variant="text"
                                            icon="mdi mdi-pencil"
                                            size="small"
                                            color="primary"
                                            @click="router.push('/contact/' + contact.id + '/edit')"
                                        ></v-btn>
                                    </template>
                                </v-tooltip>
                                <v-tooltip text="Удалить">
                                    <template v-slot:activator="{ props }">
                                        <v-btn
                                            v-bind="props"
                                            variant="text"
                                            color="red"
                                            icon="mdi mdi-close"
                                            size="small"
                                            @click="store.deleteContact(contact.id)"
                                        ></v-btn>
                                    </template>
                                </v-tooltip>
                            </td>
                        </tr>
                    </template>
                    <template v-else>
                        <tr class="bg-white border-b">
                            <td colspan="3" class="text-center">
                                У вас нет избранных номеров
                            </td>
                        </tr>
                    </template>
                </tbody>
            </v-table>
        </div>

        <div class="mb-2">
            <div class="flex justify-between mb-2">
                <h3 class="text-2xl font-bold">Все контакты</h3>

                <div class="flex gap-2">
                    <v-btn
                        prepend-icon="mdi mdi-plus"
                        text="Создать"
                        color="primary"
                        @click="router.push('/contact/create')"
                    ></v-btn>
                </div>
            </div>
            <v-table>
                <thead>
                    <tr>
                        <th class="font-weight-bold">№</th>
                        <th class="font-weight-bold">Имя</th>
                        <th>
                            <v-icon class="mdi mdi-cog"></v-icon>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <template v-if="store.phoneNumbers?.length > 0">
                        <tr v-for="(contact, key) in store.phoneNumbers" :key="contact.id">
                            <td>{{ key + 1}}</td>
                            <td class="font-weight-bold">{{ contact.name }}</td>
                            <td>
                                <v-tooltip text="Пометить как избранное">
                                    <template v-slot:activator="{ props }">
                                        <v-btn
                                            v-bind="props"
                                            variant="text"
                                            color="primary"
                                            icon="mdi mdi-star-outline"
                                            size="small"
                                            @click="store.markAsFavorite(contact.id)"
                                        ></v-btn>
                                    </template>
                                </v-tooltip>
                                <v-tooltip text="Просмотр">
                                    <template v-slot:activator="{ props }">
                                        <v-btn
                                            @click="router.push('/contact/' + contact.id + '/card')"
                                            v-bind="props"
                                            variant="text"
                                            icon="mdi mdi-door-open"
                                            size="small"
                                            color="primary"
                                        ></v-btn>
                                    </template>
                                </v-tooltip>
                                <v-tooltip text="Редактировать">
                                    <template v-slot:activator="{ props }">
                                        <v-btn
                                            v-bind="props"
                                            variant="text"
                                            icon="mdi mdi-pencil"
                                            size="small"
                                            color="primary"
                                            @click="router.push('/contact/' + contact.id + '/edit')"
                                        ></v-btn>
                                    </template>
                                </v-tooltip>
                                <v-tooltip text="Удалить">
                                    <template v-slot:activator="{ props }">
                                        <v-btn
                                            v-bind="props"
                                            variant="text"
                                            color="red"
                                            icon="mdi mdi-close"
                                            size="small"
                                            @click="store.deleteContact(contact.id)"
                                        ></v-btn>
                                    </template>
                                </v-tooltip>
                            </td>
                        </tr>
                    </template>
                    <template v-else>
                        <tr>
                            <td colspan="3" class="text-center">
                                У вас нет номеров
                            </td>
                        </tr>
                    </template>
                </tbody>
            </v-table>
        </div>
    </template>
</template>
