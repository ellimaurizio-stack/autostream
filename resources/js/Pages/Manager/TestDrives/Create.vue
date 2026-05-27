<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    customers: Array,
    vehicleModels: Array,
    slots: Array,
});

const form = useForm({
    customer_id: '',
    vehicle_model_id: '',
    availability_slot_id: '',
    date: '',
    scheduled_time: '',
});

const submit = () => {
    form.post(route('manager.test-drives.store'));
};
</script>

<template>
    <Head title="Book Test Drive" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center space-x-4">
                <Link :href="route('manager.test-drives.index')" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </Link>
                <h2 class="text-2xl font-bold leading-tight text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-400 dark:to-teal-400">
                    Book Test Drive
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
                            <InputLabel for="vehicle_model_id" value="Select Vehicle" />
                            <select id="vehicle_model_id" v-model="form.vehicle_model_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-emerald-600 dark:focus:ring-emerald-600">
                                <option disabled value="">Choose a vehicle...</option>
                                <option v-for="v in vehicleModels" :key="v.id" :value="v.id">{{ v.brand }} {{ v.name }}</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.vehicle_model_id" />
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <InputLabel for="date" value="Date" />
                                <TextInput id="date" type="date" class="mt-1 block w-full" v-model="form.date" required />
                                <InputError class="mt-2" :message="form.errors.date" />
                            </div>
                            <div>
                                <InputLabel for="scheduled_time" value="Time" />
                                <TextInput id="scheduled_time" type="time" class="mt-1 block w-full" v-model="form.scheduled_time" required />
                                <InputError class="mt-2" :message="form.errors.scheduled_time" />
                            </div>
                        </div>

                        <div>
                            <InputLabel for="availability_slot_id" value="Link to Slot (Optional)" />
                            <select id="availability_slot_id" v-model="form.availability_slot_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-emerald-600 dark:focus:ring-emerald-600">
                                <option value="">No slot linking</option>
                                <option v-for="s in slots" :key="s.id" :value="s.id">{{ s.date }} ({{ s.start_time }} - {{ s.end_time }})</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.availability_slot_id" />
                            <p class="text-xs text-gray-500 mt-1">Linking a slot will mark it as Booked.</p>
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <PrimaryButton class="ms-4 !bg-emerald-600 hover:!bg-emerald-700" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Confirm Booking
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
