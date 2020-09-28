<template>
    <app-layout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar categoría: {{ category.name }}
            </h2>
        </template>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <form @submit.prevent="submit">
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <text-input v-model="form.name" :error="errors.name" class="pr-6 pb-8 w-full lg:w-1/2" label="Nombre" />
                    <text-input v-model="form.description" :error="errors.description" class="pr-6 pb-8 w-full lg:w-1/2" label="Descripción" />
                </div>
                <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center">
                    <danger-button @click.native="confirmDestroy">Eliminar categoría</danger-button>
                    <loading-button :loading="sending" class="ml-auto">Actualizar categoría</loading-button>
                </div>
                <confirmation :show="confirmingDestroy" @close="confirmingDestroy = false">
                    <template #title>
                        Eliminar categoría
                    </template>
                    <template #content>
                        ¿Estás seguro que quieres eliminar esta categoría?
                    </template>
                    <template #footer>
                        <secondary-button @click.native="confirmingDestroy = false">
                            Regresar
                        </secondary-button>
                        <danger-button class="ml-2" @click.native="destroy" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Continuar
                        </danger-button>
                    </template>
                </confirmation>
            </form>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import TextInput from './../Shared/TextInput'
    import DangerButton from './../../Jetstream/DangerButton'
    import LoadingButton from './../Shared/LoadingButton'
    import SecondaryButton from './../../Jetstream/SecondaryButton'
    import Confirmation from './../Shared/Confirmation'

    export default {
        components: {
            AppLayout,
            TextInput,
            DangerButton,
            LoadingButton,
            SecondaryButton,
            Confirmation,
        },
        props: {
            category: Object,
            errors: Object,
        },
        remember: 'form',
        data() {
            return {
                confirmingDestroy: false,
                sending: false,
                form: this.$inertia.form({
                    name: this.category.name,
                    description: this.category.description,
                })
            }
        },
        methods: {
            submit() {
                this.sending = true
                this.form.put('/categories/' + this.category.id)
                    .then(() => this.sending = false)
            },
            confirmDestroy() {
                this.confirmingDestroy = true
            },
            destroy() {
                this.form.delete('/categories/' + this.category.id)
                    .then(() => {
                        preserveScroll: true
                    })
            },
        },
    }
</script>
