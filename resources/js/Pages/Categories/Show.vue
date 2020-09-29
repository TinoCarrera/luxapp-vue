<template>
    <app-layout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categorías
            </h2>
        </template>

        <div class="md:grid md:grid-cols-3 md:gap-6">
            
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-gray-900">
                        Editar categorías
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Selecciona la categoría que quieres editar.
                    </p>
                </div>
            </div>
        

            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                    <table class="w-full whitespace-no-wrap">
                        <tr class="text-left font-bold">
                            <th class="px-6 pt-6 pb-4">Nombre</th>
                            <th class="px-6 pt-6 pb-4" colspan="2">Descripción</th>
                        </tr>
                        <tr v-for="category in categories.data" :key="category.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
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
                <pagination :links="categories.links" />
            </div>
        </div>

        <div>
            <jet-section-border />

            <create-category />
        </div>
    
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import Icon from './../../Shared/Icon'
    import PrimaryButton from './../../Jetstream/Button'
    import Pagination from './../../Shared/Pagination'
    import CreateCategory from './CreateCategory'
    import JetSectionBorder from './../../Jetstream/SectionBorder'

    export default {
        components: {
            AppLayout,
            Icon,
            PrimaryButton,
            Pagination,
            CreateCategory,
            JetSectionBorder,
        },
        props: {
            categories: Array,
        },
    }
</script>