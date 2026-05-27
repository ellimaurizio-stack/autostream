<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
    testDrives: Array
});

const form = useForm({
    test_drive_id: '',
    driving_rating: 5,
    comfort_rating: 5,
    positive_feedback: '',
    negative_feedback: '',
    privacy_consent: false,
});

const submit = () => {
    form.post(route('manager.surveys.store'));
};
</script>

<template>
    <Head title="Submit Survey" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold leading-tight text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-400 dark:to-teal-400">
                    Post-Test Drive Survey
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
                <div class="bg-white/80 backdrop-blur-xl shadow-xl ring-1 ring-black/5 sm:rounded-2xl p-8 dark:bg-gray-900/80 dark:ring-white/10">
                    
                    <div v-if="testDrives.length === 0" class="text-center text-gray-500 dark:text-gray-400">
                        No pending test drives available to survey.
                    </div>

                    <form v-else @submit.prevent="submit" class="space-y-6">
                        
                        <div>
                            <InputLabel for="test_drive_id" value="Select Completed Test Drive" />
                            <select id="test_drive_id" v-model="form.test_drive_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-emerald-600 dark:focus:ring-emerald-600">
                                <option disabled value="">Choose test drive...</option>
                                <option v-for="td in testDrives" :key="td.id" :value="td.id">
                                    {{ td.date }} - {{ td.customer.name }} ({{ td.vehicle_model.brand }} {{ td.vehicle_model.name }})
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.test_drive_id" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <InputLabel for="driving_rating" value="Driving Rating (1-5)" />
                                <input id="driving_rating" type="number" min="1" max="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-emerald-600 dark:focus:ring-emerald-600" v-model="form.driving_rating" required />
                                <InputError class="mt-2" :message="form.errors.driving_rating" />
                            </div>
                            <div>
                                <InputLabel for="comfort_rating" value="Comfort Rating (1-5)" />
                                <input id="comfort_rating" type="number" min="1" max="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-emerald-600 dark:focus:ring-emerald-600" v-model="form.comfort_rating" required />
                                <InputError class="mt-2" :message="form.errors.comfort_rating" />
                            </div>
                        </div>

                        <div>
                            <InputLabel for="positive_feedback" value="Positive Feedback" />
                            <textarea id="positive_feedback" v-model="form.positive_feedback" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-emerald-600 dark:focus:ring-emerald-600"></textarea>
                        </div>
                        
                        <div>
                            <InputLabel for="negative_feedback" value="Areas for Improvement" />
                            <textarea id="negative_feedback" v-model="form.negative_feedback" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-emerald-600 dark:focus:ring-emerald-600"></textarea>
                        </div>

                        <div class="block mt-4">
                            <label class="flex items-center">
                                <input type="checkbox" v-model="form.privacy_consent" name="privacy_consent" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500 dark:border-gray-700 dark:bg-gray-900 dark:focus:ring-emerald-600 dark:focus:ring-offset-gray-800" />
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Customer agrees to use feedback for marketing</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <PrimaryButton class="ms-4 !bg-emerald-600 hover:!bg-emerald-700" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Submit Survey
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
