<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    brand: '',
    name: '',
    fuel_type: '',
});

const submit = () => {
    form.post(route('admin.vehicle-models.store'));
};
</script>

<template>
    <Head title="Add Vehicle Model" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center space-x-4">
                <Link :href="route('admin.vehicle-models.index')" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </Link>
                <h2 class="text-2xl font-bold leading-tight text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400">
                    Add Vehicle Model
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
                <div class="bg-white/80 backdrop-blur-xl shadow-xl ring-1 ring-black/5 sm:rounded-2xl p-8 dark:bg-gray-900/80 dark:ring-white/10">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <InputLabel for="brand" value="Brand" />
                            <TextInput id="brand" type="text" class="mt-1 block w-full" v-model="form.brand" required autofocus />
                            <InputError class="mt-2" :message="form.errors.brand" />
                        </div>

                        <div>
                            <InputLabel for="name" value="Model Name" />
                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div>
                            <InputLabel for="fuel_type" value="Fuel Type" />
                            <TextInput id="fuel_type" type="text" class="mt-1 block w-full" v-model="form.fuel_type" required />
                            <InputError class="mt-2" :message="form.errors.fuel_type" />
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Create Model
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
