<template>
    <AppLayout title="Contacts">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">

                <div class="pt-2 pl-4 pb-2 flex items-center justify-between">
                    <input v-model="filterText" type="text"
                        class="w-2/5 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-300 rounded-md shadow-sm text-sm"
                        placeholder="Ingrese para filtrar">
                    <Link :href="route('contacts.create')" class="pr-4">
                    <PrimaryButton>
                        Nuevo
                    </PrimaryButton>
                    </Link>

                </div>
                <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Name</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Organization</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">City</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Phone</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                        <tr v-for="contact in filteredContacts" :key="contact.id" class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ contact.first_name + ' ' + contact.last_name }}</td>
                            <td class="px-6 py-4">{{ contact.organization.name }}</td>
                            <td class="px-6 py-4">{{ contact.city }}</td>
                            <td class="px-6 py-4">{{ contact.phone }}</td>
                            <td class="px-6 py-4">
                                <Link :href="route('contacts.edit', contact)" class="pr-2">
                                    <i class="fa-regular fa-pen-to-square fa-xl" style="color: #e4de1b;"></i>
                                </Link>
                                <button @click="deleteContact(contact.id)">
                                    <i class="fa-regular fa-trash-can fa-xl" style="color: #d31d38;"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <pagination :pagination="contacts"></pagination>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Shared/Pagination.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        AppLayout,
        Pagination,
        Link,
        PrimaryButton
    },

    props: {
        contacts: Object,
    },

    data() {
        return {
            filterText: '',
        }
    },

    computed: {
        filteredContacts() {
            return this.contacts.data.filter(contact => {
                const fullName = `${contact.first_name} ${contact.last_name}`.toLowerCase();
                return fullName.includes(this.filterText.toLowerCase());
            });
        },
    },

    methods: {
    deleteContact(contactId) {
      if (confirm('¿Estás seguro de que deseas eliminar este contacto?')) {
        this.$inertia.delete(`/contacts/${contactId}`)
          .then(() => {
            this.$emit('contactDeleted');
          })
          .catch((error) => {
            console.error('Error al eliminar el contacto:', error);
          });
      }
    },
  },
};
</script>

<style></style>
