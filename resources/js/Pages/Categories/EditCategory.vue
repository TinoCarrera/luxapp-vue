<template>
    <app-layout>
        <template #header>
            Categorías
        </template>

        <form-section @submitted="updateCategory">

            <template #title>
                Editar categoría
            </template>

            <template #description>
                Actualiza o elimina la categoría seleccionada.
            </template>

            <template #form>
                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="name" value="Nombre" />
                    <x-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
                    <input-error :message="form.error('name')" class="mt-2" />
                </div>

                <!-- Description -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="description" value="Descripción" />
                    <x-input id="description" type="text" class="mt-1 block w-full" v-model="form.description" />
                    <input-error :message="form.error('description')" class="mt-2" />
                </div>
            </template>

            <template #actions>

                <danger-button @click.native="confirmDelete" class="mr-auto">Eliminar</danger-button>

                <action-message :on="form.recentlySuccessful" class="mr-3">
                    Editada.
                </action-message>

                <x-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Actualizar
                </x-button>

                <confirmation :show="confirmingDelete" @close="confirmingDelete = false">
                    <template #title>
                        Eliminar categoría
                    </template>
                    <template #content>
                        ¿Estás seguro que quieres eliminar esta categoría?
                    </template>
                    <template #footer>
                        <secondary-button @click.native="confirmingDelete = false">
                            Regresar
                        </secondary-button>
                        <danger-button class="ml-2" @click.native="deleteCategory" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Continuar
                        </danger-button>
                    </template>
                </confirmation>

            </template>

        </form-section>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import DangerButton from './../../Shared/DangerButton'
    import SecondaryButton from './../../Shared/SecondaryButton'
    import Confirmation from './../../Shared/Confirmation'
    import FormSection from './../../Shared/FormSection'
    import XLabel from './../../Shared/Label'
    import XInput from './../../Shared/Input'
    import InputError from './../../Shared/InputError'
    import ActionMessage from './../../Shared/ActionMessage'
    import XButton from './../../Shared/Button'

    export default {
        components: {
            AppLayout,
            DangerButton,
            SecondaryButton,
            Confirmation,
            FormSection,
            XLabel,
            XInput,
            InputError,
            ActionMessage,
            XButton,
        },

        props: {
            category: Object,
        },

        data() {
            return {
                confirmingDelete: false,
                form: this.$inertia.form({
                    name: this.category.name,
                    description: this.category.description,
                })
            }
        },

        methods: {
            updateCategory() {
                this.form.put('/categories/' + this.category.id)
                    .then(() => {

                    })
            },

            confirmDelete() {
                this.confirmingDelete = true
            },
            
            deleteCategory() {
                this.form.delete('/categories/' + this.category.id)
                    .then(() => {

                    })
            },
        },
    }
</script>
