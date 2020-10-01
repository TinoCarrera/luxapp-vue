<template>
    <table-section>

        <template #title>
            Editar categorías
        </template>

        <template #description>
            Selecciona la categoría que quieres editar.
        </template>

        <template #table>
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
                    <inertia-link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="'/categories/' + category.id + '/edit'">
                    {{ category.description }}
                    </inertia-link>
                </td>
                <td class="border-t w-px">
                    <inertia-link class="px-6 py-4 flex items-center" :href="'/categories/' + category.id + '/edit'">
                        <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                    </inertia-link>
                </td>
            </tr>
            <tr v-if="categories.length === 0">
                <td class="border-t px-6 py-4" colspan="3">Ninguna categoría encontrada.</td>
            </tr>
        </template>

        <template #pagination>
            <pagination :links="categories.links" />
        </template>
        
    </table-section>
</template>

<script>
    import TableSection from './../../Shared/TableSection'
    import Icon from './../../Shared/Icon'
    import Pagination from './../../Shared/Pagination'

    export default {
        components: {
            TableSection,
            Icon,
            Pagination,
        },

        props: ['categories'],
    }
</script>
