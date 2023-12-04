<template>
    <AppLayout title="Contacts">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-2">
            <h1 class="text-xl font-semibold text-gray-700 mb-3">
                <span class="text-indigo-500">Contacts / </span>Create
            </h1>

            <div class="bg-white px-6 py-8 rouded-lg shadow">

                <MyValidationErrors></MyValidationErrors>


                <div class="grid grid-cols-4 gap-6">

                    <div>
                        <label for="organizationSelect">
                            Organization
                            <select id="organizationSelect"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                v-model="contact.organization_id">
                                <option value="" selected disabled>
                                    Seleccione una opción
                                </option>
                                <option v-for="organization in organizations" :value="organization.id"
                                    :key="organization.id">
                                    {{ organization.name }}
                                </option>
                            </select>
                        </label>
                    </div>
                     
                    <div class="col-start-3">
                        <label for="countrySelect">
                            Country
                            <select id="countrySelect"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                v-model="contact.country_id">
                                <option value="" selected disabled>
                                    Seleccione una opción
                                </option>
                                <option v-for="country in countries" :value="country.id" :key="country.id">
                                    {{ country.name }}
                                </option>
                            </select>
                        </label>
                    </div>

                    <div class="col-start-1">
                        <TextInput v-model="contact.first_name" placeholder="First Name">

                        </TextInput>
                    </div>
                    <div>
                        <TextInput v-model="contact.last_name" placeholder="Last Name">

                        </TextInput>
                    </div>
                    <div >
                        <TextInput v-model="contact.email" placeholder="Email">

                        </TextInput>
                    </div>
                    <div>
                        <TextInput v-model="contact.phone" placeholder="Phone">

                        </TextInput>
                    </div>
                    <div>
                        <TextInput v-model="contact.address" placeholder="Address">

                        </TextInput>
                    </div>
                    <div>
                        <TextInput v-model="contact.city" placeholder="City">

                        </TextInput>
                    </div>
                    <div>
                        <TextInput v-model="contact.state" placeholder="State">

                        </TextInput>
                    </div>

                    <div>
                        <TextInput v-model="contact.postal_code" placeholder="Postal code">

                        </TextInput>
                    </div>
                    
                </div>

                <div class="flex justify-end pt-6 pr-4">
                    <PrimaryButton @click="store">
                        Crear
                    </PrimaryButton>
                </div>
            </div>
        </div>


    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import MyValidationErrors from '@/Components/ValidationErrors.vue';

export default {
    components: {
        AppLayout,
        TextInput,
        PrimaryButton,
        MyValidationErrors
    },

    data() {
        return {
            contact: {
                first_name: '',
                last_name: '',
                organization_id: '',
                email: '',
                phone: '',
                address: '',
                city: '',
                state: '',
                country_id: '',
                postal_code: '',
            }
        }
    },

    props: {
        organizations: Array,
        countries: Array
    },

    methods: {
        store() {
            this.$inertia.post(this.route('contacts.store'), this.contact);
        }
    }


}
</script>

<style></style>