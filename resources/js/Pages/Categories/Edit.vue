<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categoría / {{ category.name }}
            </h2>
        </template>
        <div class="flex flex-col">
            <div class="h-screen flex flex-col">
        <div class="flex flex-grow overflow-hidden">
            <div class="flex-1 px-4 py-8 md:p-12 overflow-y-auto" scroll-region>
                <div class="bg-white rounded shadow overflow-hidden w-full">
                    <form @submit.prevent="submit">
                        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <text-input v-model="form.name" class="pr-6 pb-8 w-full lg:w-1/2" label="Nombre" />
                        <text-input v-model="form.description" class="pr-6 pb-8 w-full lg:w-1/2" label="Descripción" />
                        </div>
                        <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center">
                        <button class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Eliminar categoría</button>
                        <button class="btn-indigo ml-auto" type="submit">Actualizar categoría</button>
                        </div>
                    </form>
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
    import TextInput from './../Shared/TextInput'

    export default {
        components: {
            AppLayout,
            Icon,
            TextInput,
        },
        props: {
            category: Object,
        },
        remember: 'form',
        data() {
            return {
                sending: false,
                form: {
                    name: this.category.name,
                    description: this.category.description,
                },
            }
        },
        methods: {
            submit() {
            this.sending = true
            this.$inertia.put(this.route('categories/update', this.category.id), this.form)
                .then(() => this.sending = false)
            },
            destroy() {
            if (confirm('Are you sure you want to delete this category?')) {
                this.$inertia.delete(this.route('categories.destroy', this.category.id))
            }
            },
        },
    }
</script>
