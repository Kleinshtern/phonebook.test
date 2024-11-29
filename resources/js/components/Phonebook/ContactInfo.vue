<script setup>
    import {usePhonebookStore} from "@/stores/phonebookStore.js";
    import {onMounted} from "vue";
    import router from "@/router.js";

    const props = defineProps({
        id: String
    })

    const store = usePhonebookStore();

    onMounted(() => {
        store.fetchContact(props.id)
    })
</script>

<template>
    <v-btn
        prepend-icon="mdi mdi-chevron-left"
        text="К списку"
        color="primary"
        @click="router.back()"
    ></v-btn>

    <div class="flex mt-2 gap-2">
        <template v-if="store.loading">
            Loading...
        </template>
        <template v-else>
            <v-card v-if="store.contact.avatar">
                <v-card-item>
                    <v-avatar
                        :image="'/storage/avatars/'+store.contact.avatar"
                        size="150"
                    ></v-avatar>
                </v-card-item>
            </v-card>
            <v-card>
                <v-card-item>
                    <h6 class="text-h6 font-weight-bold">Имя: {{ store.contact.full_name }}</h6>
                    <p v-if="store.contact.company">
                        <span class="font-weight-bold">Компания: </span> {{ store.contact.company }}
                    </p>
                    <p>
                        <span class="font-weight-bold">{{ store.contact.phone_type_translate }}:</span> {{ store.contact.phone }}
                    </p>
                    <p v-if="store.contact.email">
                        <span class="font-weight-bold">Электронная почта:</span> {{ store.contact.email }}
                    </p>
                </v-card-item>
            </v-card>
        </template>
    </div>
</template>

