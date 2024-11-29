<script setup>
    import { useForm } from 'vee-validate';
    import * as yup from 'yup';
    import {onMounted} from "vue";

    import {usePhonebookStore} from "@/stores/phonebookStore.js";
    import router from "@/router.js";
    const store = usePhonebookStore();

    onMounted(() => {
        store.fetchPhoneTypes()
    })

    const phoneRegExp = /^((\\+[1-9]{1,4}[ \\-]*)|(\\([0-9]{2,3}\\)[ \\-]*)|([0-9]{2,4})[ \\-]*)*?[0-9]{3,4}?[ \\-]*[0-9]{3,4}?$/

    const schema = yup.object({
        first_name: yup.string().required("Введите имя"),
        last_name: yup.string(),
        company: yup.string(),
        phone_type: yup.string().required("Выберите тип номера"),
        phone: yup.string().matches(phoneRegExp, "Неправильный формат номера").required("Введите номер телефона"),
        email: yup.string(),
    });

    const { defineField, handleSubmit } = useForm({
        validationSchema: schema
    });

    const vuetifyConfig = (state) => ({
        props: {
            'error-messages': state.errors,
        },
    });

    const [firstname, firstnameProps] = defineField('first_name', vuetifyConfig);
    const [lastname, lastnameProps] = defineField('last_name', vuetifyConfig);
    const [company, companyProps] = defineField('company', vuetifyConfig);
    const [phoneType, phoneTypeProps] = defineField('phone_type', vuetifyConfig)
    const [phoneNumber, phoneNumberProps] = defineField('phone', vuetifyConfig)
    const [email, emailProps] = defineField('email', vuetifyConfig)

    const [avatar] = defineField('avatar', vuetifyConfig)

    const handleLoadAvatar = (event) => {
        avatar.value = event.target.files[0]
    }

    const submitForm = handleSubmit((values) => {
        store.createContact(values)
    })
</script>

<template>
    <div class="flex flex-col gap-2 items-start">
        <v-btn
            prepend-icon="mdi mdi-chevron-left"
            text="Вернуться назад"
            variant="text"
            @click="router.back()"
        ></v-btn>

        <v-form class="flex flex-col gap-2 w-full lg:w-2/3 mx-auto" @submit.prevent="submitForm">
            <h6 class="text-h6 font-weight-bold">Добавление контакта</h6>

            <v-text-field v-model="firstname" v-bind="firstnameProps" label="Имя"></v-text-field>
            <v-text-field v-model="lastname" v-bind="lastnameProps" label="Фамилия"></v-text-field>
            <v-text-field v-model="company" v-bind="companyProps" label="Компания"></v-text-field>

            <div class="flex gap-2">
                <v-select
                    class="w-full"
                    v-if="store.typeNumbers"
                    label="Тип номера"
                    :items="store.typeNumbers"
                    item-title="title"
                    item-value="value"
                    v-model="phoneType"
                    v-bind="phoneTypeProps"
                >
                </v-select>

                <v-text-field class="w-full" v-model="phoneNumber" v-bind="phoneNumberProps" label="Номер телефона"></v-text-field>
            </div>

            <v-text-field type="email" v-model="email" v-bind="emailProps" label="Электронная почта"></v-text-field>
            <v-file-input @change="handleLoadAvatar"
                          accept="image/png, image/jpeg, image/bmp"
                          label="Аватар"></v-file-input>

            <v-btn type="submit" color="primary" text="Создать" class="text-white"></v-btn>
        </v-form>
    </div>
</template>
