<template>
    <app-layout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categorías
            </h2>
        </template>

        <div class="flex flex-col">
            <div class="h-screen flex flex-col">
                <div class="flex flex-grow overflow-hidden">
                    <div class="flex-1 px-4 py-8 md:p-12 overflow-y-auto" scroll-region>
                        
                        <div class="bg-white rounded shadow overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                                <tr class="text-left font-bold">
                                    <th class="px-6 pt-6 pb-4">Nombre</th>
                                    <th class="px-6 pt-6 pb-4" colspan="2">Descripción</th>
                                </tr>
                                <tr v-for="category in categories" :key="category.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                    <td class="border-t">
                                        <inertia-link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="'/categories/' + category.id + '/edit'">
                                        {{ category.name }}
                                        </inertia-link>
                                    </td>
                                    <td class="border-t">
                                        <inertia-link class="px-6 py-4 flex items-center" :href="'/categories/' + category.id + '/edit'" tabindex="-1">
                                        {{ category.description }}
                                        </inertia-link>
                                    </td>
                                    <td class="border-t w-px">
                                        <inertia-link class="px-4 flex items-center" :href="'/categories/' + category.id + '/edit'" tabindex="-1">
                                        <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                                        </inertia-link>
                                    </td>
                                </tr>
                                <tr v-if="categories.length === 0">
                                    <td class="border-t px-6 py-4" colspan="3">Ninguna categoría encontrada.</td>
                                </tr>
                            </table>
                        </div>
                        <div class="mt-6 flex justify-between items-center">
                            <inertia-link class="btn-indigo" :href="'categories/create'">
                                <span>Crear</span>
                                <span class="hidden md:inline">Categoría</span>
                            </inertia-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import Icon from './../Shared/Icon'

    export default {
        components: {
            AppLayout,
            Icon,
        },
         props: {
            categories: Object,
        },
    }
</script>