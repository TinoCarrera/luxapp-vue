<template>
    <app-layout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crear categoría
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <text-input v-model="form.name" :error="errors.name" class="pr-6 pb-8 w-full lg:w-1/2" label="Nombre" placeholder="Nombre de la categoría" />
                            <text-input v-model="form.description" :error="errors.description" class="pr-6 pb-8 w-full lg:w-1/2" label="Descripción" placeholder="Introduce una breve descripción" />
                        </div>
                        <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center">
                            <loading-button :loading="sending" class="ml-auto">Crear categoría</loading-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import TextInput from './../Shared/TextInput'
    import LoadingButton from './../Shared/LoadingButton'

    export default {
        components: {
            AppLayout,
            TextInput,
            LoadingButton,
        },
        props: {
            errors: Object,
        },
        remember: 'form',
        data() {
            return {
                sending: false,
                form: {
                    name: null,
                    description: null,
                },
            }
        },
        methods: {
            submit() {
                this.sending = true
                this.$inertia.post('/categories/store', this.form)
                    .then(() => this.sending = false)
            },
        },
    }
</script>
