<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    date: '',
    start_time: '',
    end_time: '',
});

const submit = () => {
    form.post(route('manager.slots.store'));
};
</script>

<template>
    <Head title="Add Time Slot" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center space-x-4">
                <Link :href="route('manager.slots.index')" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </Link>
                <h2 class="text-2xl font-bold leading-tight text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-400 dark:to-teal-400">
                    Add Time Slot
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
                <div class="bg-white/80 backdrop-blur-xl shadow-xl ring-1 ring-black/5 sm:rounded-2xl p-8 dark:bg-gray-900/80 dark:ring-white/10">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <InputLabel for="date" value="Date" />
                            <TextInput id="date" type="date" class="mt-1 block w-full" v-model="form.date" required autofocus />
                            <InputError class="mt-2" :message="form.errors.date" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <InputLabel for="start_time" value="Start Time" />
                                <TextInput id="start_time" type="time" class="mt-1 block w-full" v-model="form.start_time" required />
                                <InputError class="mt-2" :message="form.errors.start_time" />
                            </div>
                            <div>
                                <InputLabel for="end_time" value="End Time" />
                                <TextInput id="end_time" type="time" class="mt-1 block w-full" v-model="form.end_time" required />
                                <InputError class="mt-2" :message="form.errors.end_time" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <PrimaryButton class="ms-4 !bg-emerald-600 hover:!bg-emerald-700" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Save Slot
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
