import { defineStore } from 'pinia';
import axios from "axios";

export const usePhonebookStore = defineStore('phonebook', {
    state: () => ({
        loading: false,
        phoneNumbers: null,
        favoriteNumbers: null,
        typeNumbers: null,

        contact: {}
    }),
    actions: {
        async csrf() {
            await axios.get('/sanctum/csrf-cookie');
        },
        async fetchPhonebookNumber() {
            this.loading = true;

            await axios.get('/api/contacts')
                .then(response => {
                    this.phoneNumbers = response.data.phoneNumbers;
                    this.favoriteNumbers = response.data.favoriteNumbers;

                    this.loading = false;
                })
                .catch(err => {
                    alert(JSON.stringify(err.response.data));
                })
        },
        async fetchContact(id) {
            this.loading = true;

            await axios.get('/api/contacts/' + id)
                .then(response => {
                    this.contact = response.data;
                    this.loading = false;
                })
                .catch(err => {
                    alert(JSON.stringify(err.response.data));
                })
        },
        async fetchPhoneTypes() {
            await axios.get('/api/phonebook/type-numbers')
                .then(response => {
                    this.typeNumbers = response.data;
                })
        },
        async createContact(values) {
            await axios.post('/api/contacts', values, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(() => {
                    this.router.push('/');
                })
        },
        async editContact(values) {
            let formData= new FormData();
            Object.keys(values).forEach((key) => {
                formData.append(`${key}`, values[key])
            })

            formData.append("_method", "PATCH");

            await axios.post('/api/contacts/'+ values.id, formData)
                .then(() => {
                    this.router.push('/')
                })
                .catch(err => {
                    alert(JSON.stringify(err.response));
                })
        },
        async deleteContact(id) {
            await axios.delete('/api/contacts/'+id)
                .then(() => {
                    let idx = this.phoneNumbers.findIndex(contact => contact.id === id);

                    if(idx !== -1) {
                        this.phoneNumbers.splice(idx, 1);
                    }
                })
                .catch(err => {
                    alert(JSON.stringify(err.response))
                })
        },
        async markAsFavorite(id) {
            await axios.patch('/api/contacts/'+id+'/mark-favorite')
                .then(() => {
                    let idx = this.phoneNumbers.findIndex(contact => contact.id === id);

                    if(idx !== -1) {
                        this.favoriteNumbers.push(this.phoneNumbers[idx]);
                        this.phoneNumbers.splice(idx, 1);
                    }
                })
                .catch(err => alert(JSON.stringify(err)))
        },
        async unmarkAsFavorite(id) {
            await axios.patch('/api/contacts/'+id+'/unmark-favorite')
                .then(() => {
                    let idx = this.favoriteNumbers.findIndex(contact => contact.id === id);

                    if(idx !== -1) {
                        this.phoneNumbers.push(this.favoriteNumbers[idx]);
                        this.favoriteNumbers.splice(idx, 1);
                    }
                })
                .catch(err => alert(JSON.stringify(err)))
        }
    }
})
