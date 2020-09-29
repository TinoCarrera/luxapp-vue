<template>
    <jet-form-section @submitted="createCategory">

        <template #title>
            Crear categoría
        </template>

        <template #description>
            Crea una nueva categoría para la página.
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
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Creada.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Crear
            </jet-button>
        </template>

    </jet-form-section>
</template>

<script>
    import JetFormSection from './../../Jetstream/FormSection'
    import JetLabel from './../../Jetstream/Label'
    import JetInput from './../../Jetstream/Input'
    import JetInputError from './../../Jetstream/InputError'
    import JetActionMessage from './../../Jetstream/ActionMessage'
    import JetButton from './../../Jetstream/Button'

    export default {
        components: {
            JetFormSection,
            JetLabel,
            JetInput,
            JetInputError,
            JetActionMessage,
            JetButton,
        },

        data() {
            return {
                form: this.$inertia.form({
                    '_method': 'POST',
                    name: null,
                    description: null,
                }, {
                    bag: 'createCategory',
                }),
            }
        },

        methods: {
            createCategory() {
                this.form.post('/categories/store', {
                    preserveScroll: true
                });
            },
        },
    }
</script>
