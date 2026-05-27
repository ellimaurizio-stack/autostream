<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Manager Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-bold leading-tight text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-400 dark:to-teal-400">
                Dealership Manager
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
                <!-- Premium Glassmorphism Card -->
                <div class="relative overflow-hidden bg-white/80 backdrop-blur-xl shadow-xl ring-1 ring-black/5 sm:rounded-2xl dark:bg-gray-900/80 dark:ring-white/10">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 via-transparent to-transparent pointer-events-none"></div>
                    <div class="p-8 relative z-10">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Today's Overview</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Check in customers and manage your test drive schedule.
                        </p>
                        
                        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Action Card 1 -->
                            <div class="group block p-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg hover:border-emerald-500 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                                <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/50 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Agenda</h4>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">View and manage test drive appointments.</p>
                            </div>
                            
                            <!-- Action Card 2 -->
                            <div class="group block p-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg hover:border-teal-500 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                                <div class="w-12 h-12 bg-teal-50 dark:bg-teal-900/50 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Scan QR Code</h4>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Check-in a customer for their test drive.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
