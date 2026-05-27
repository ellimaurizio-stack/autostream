<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
    customers: Array,
    documents: Array,
});

const form = useForm({
    customer_id: '',
    legal_document_id: '',
});

const submit = () => {
    form.post(route('manager.consent-logs.store'));
};
</script>

<template>
    <Head title="Log Consent" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold leading-tight text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-400 dark:to-teal-400">
                    Record Customer Consent
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
                <div class="bg-white/80 backdrop-blur-xl shadow-xl ring-1 ring-black/5 sm:rounded-2xl p-8 dark:bg-gray-900/80 dark:ring-white/10">
                    <form @submit.prevent="submit" class="space-y-6">
                        
                        <div>
                            <InputLabel for="customer_id" value="Select Customer" />
                            <select id="customer_id" v-model="form.customer_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-emerald-600 dark:focus:ring-emerald-600">
                                <option disabled value="">Choose a customer...</option>
                                <option v-for="c in customers" :key="c.id" :value="c.id">{{ c.name }} ({{ c.email }})</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.customer_id" />
                        </div>

                        <div>
                            <InputLabel for="legal_document_id" value="Select Document Accepted" />
                            <select id="legal_document_id" v-model="form.legal_document_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-emerald-600 dark:focus:ring-emerald-600">
                                <option disabled value="">Choose document...</option>
                                <option v-for="d in documents" :key="d.id" :value="d.id">{{ d.type }} - v{{ d.version }}</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.legal_document_id" />
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <PrimaryButton class="ms-4 !bg-emerald-600 hover:!bg-emerald-700" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Record Consent
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
