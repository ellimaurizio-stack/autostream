<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    testDrives: Array
});
</script>

<template>
    <Head title="Test Drives" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold leading-tight text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-400 dark:to-teal-400">
                    Test Drives
                </h2>
                <Link :href="route('manager.test-drives.create')" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-medium transition-colors shadow-sm shadow-emerald-200 dark:shadow-emerald-900/20">
                    Book Test Drive
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white/80 backdrop-blur-xl shadow-xl ring-1 ring-black/5 sm:rounded-2xl dark:bg-gray-900/80 dark:ring-white/10 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50/50 dark:bg-gray-800/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">Date/Time</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">Customer</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">Vehicle</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">Code</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white/50 divide-y divide-gray-200 dark:bg-gray-900/50 dark:divide-gray-700">
                            <tr v-for="td in testDrives" :key="td.id" class="hover:bg-gray-50 dark:hover:bg-gray-800/80 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ td.date }} <br><span class="text-gray-500 text-xs">{{ td.scheduled_time }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ td.customer.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ td.vehicle_model.brand }} {{ td.vehicle_model.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-500 dark:text-gray-400">{{ td.reservation_code }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span v-if="td.status === 'BOOKED'" class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium dark:bg-blue-900/30 dark:text-blue-400">Booked</span>
                                    <span v-else-if="td.status === 'COMPLETED'" class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium dark:bg-green-900/30 dark:text-green-400">Completed</span>
                                    <span v-else class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium dark:bg-gray-900/30 dark:text-gray-400">{{ td.status }}</span>
                                </td>
                            </tr>
                            <tr v-if="testDrives.length === 0">
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                    No test drives booked yet.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
