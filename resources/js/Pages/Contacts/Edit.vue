<template>
    <AppLayout title="Dashboard">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-2">
            <h1 class="text-xl font-semibold text-gray-700 mb-3">
                <span class="text-indigo-500">Contacts / </span>Edit
            </h1>

            <div class="bg-white px-6 py-8 rouded-lg shadow">

               <MyValidationErrors></MyValidationErrors>


                <div class="grid grid-cols-4 gap-6">
                    <div>
                        <label for="">
                            First Name
                            <TextInput v-model="form.first_name">

                            </TextInput>
                        </label>
                    </div>
                    <div>
                        <label for="">
                            Last Name
                            <TextInput v-model="form.last_name">

                            </TextInput>
                        </label>
                    </div>
                    <div>
                        <label for="organizationSelect">
                            Organization
                            <select id="organizationSelect" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="form.organization_id">
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

                    <div class="col-start-1">
                        <label for="">
                            Email
                            <TextInput v-model="form.email">

                            </TextInput>
                        </label>
                    </div>
                    <div>
                        <label for="">
                            Phone
                            <TextInput v-model="form.phone">

                            </TextInput>
                        </label>
                    </div>
                    <div>
                        <label for="">
                            Address
                            <TextInput v-model="form.address">

                            </TextInput>
                        </label>
                    </div>
                    <div>
                        <label for="">
                            City
                            <TextInput v-model="form.city">

                            </TextInput>
                        </label>
                    </div>
                    <div>
                        <label for="">
                            State
                            <TextInput v-model="form.state">

                            </TextInput>
                        </label>
                    </div>
                    <div>
                        <label for="countrySelect">
                            Country
                            <select id="countrySelect" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="form.country_id">
                                <option value="" selected disabled>
                                    Seleccione una opción
                                </option>
                                <option v-for="country in countries" :value="country.id" :key="country.id">
                                    {{ country.name }}
                                </option>
                            </select>
                        </label>
                    </div>
                    <div>
                        <label for="">
                            Postal code
                            <TextInput v-model="form.postal_code">

                            </TextInput>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end pt-6 pr-4">
                    <PrimaryButton @click="update">
                        Actualizar
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

    data(){
        return{
            form: this.contact
        }
    },

    props: {
        organizations: Array,
        countries: Array,
        contact: {
            type: Array,
            required: true
        },
        
    },

    methods: {
        update() {
            this.$inertia.form(this.form).put(this.route('contacts.update', this.contact));
        }
    }

}
</script>

<style></style>