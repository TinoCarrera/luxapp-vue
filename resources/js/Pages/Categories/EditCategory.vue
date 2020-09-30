<template>
    <app-layout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categorías
            </h2>
        </template>

        <jet-form-section @submitted="submit">

            <template #title>
                Editar categoría
            </template>

            <template #description>
                Edita la categoría que seleccionaste.
            </template>

            <template #form>
                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="name" value="Nombre" />
                    <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
                    <jet-input-error :message="form.error('name')" class="mt-2" />
                </div>

                <!-- Description -->
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="description" value="Descripción" />
                    <jet-input id="description" type="text" class="mt-1 block w-full" v-model="form.description" />
                    <jet-input-error :message="form.error('description')" class="mt-2" />
                </div>
            </template>

            <template #actions>

                <danger-button @click.native="confirmDestroy" class="mr-auto">Eliminar categoría</danger-button>

                <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                    Editada.
                </jet-action-message>

                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Editar
                </jet-button>

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

            </template>

        </jet-form-section>

    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import DangerButton from './../../Jetstream/DangerButton'
    import SecondaryButton from './../../Jetstream/SecondaryButton'
    import Confirmation from './../../Shared/Confirmation'

    import JetFormSection from './../../Jetstream/FormSection'
    import JetLabel from './../../Jetstream/Label'
    import JetInput from './../../Jetstream/Input'
    import JetInputError from './../../Jetstream/InputError'
    import JetActionMessage from './../../Jetstream/ActionMessage'
    import JetButton from './../../Jetstream/Button'

    export default {
        components: {
            AppLayout,
            DangerButton,
            SecondaryButton,
            Confirmation,

            JetFormSection,
            JetLabel,
            JetInput,
            JetInputError,
            JetActionMessage,
            JetButton,
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
                    })
            },
        },
    }
</script>
