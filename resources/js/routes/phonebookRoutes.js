import Contacts from "@/components/Phonebook/Contacts.vue";
import ContactInfo from "@/components/Phonebook/ContactInfo.vue";
import ContactsList from "@/components/Phonebook/ContactsList.vue";
import CreateContactForm from "@/components/Phonebook/Forms/CreateContactForm.vue";
import EditContactForm from "@/components/Phonebook/Forms/EditContactForm.vue";


const phonebookRoutes = [
    {
        path: "/",
        name: "phonebook",
        component: Contacts,
        meta: { auth: true },
        children: [
            {
                path: "",
                name: "contactsList",
                component: ContactsList
            },
            {
                path: "contact/create",
                name: "createContact",
                component: CreateContactForm,
            },
            {
                path: "contact/:id/edit",
                name: "editContact",
                component: EditContactForm,
                props: true
            },
            {
                path: "contact/:id/card",
                name: "viewContact",
                component: ContactInfo,
                props: true
            }
        ]
    }
]

export default phonebookRoutes
