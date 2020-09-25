<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categorías de LuxApp
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div class="mt-8 text-2xl">
                                Categorías
                        </div>
                        <div class="mt-6 text-gray-500">
                            <table class="table table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Nombre</td>
                                        <td>Descripción</td>
                                    </tr>
                                </thead>
                                <tr v-for="category in categories">
                                    <td>{{ category.id }}</td>
                                    <td>{{ category.name }}</td>
                                    <td>{{ category.description }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },
        props: {
            categories: Object,
        },
    }
</script>