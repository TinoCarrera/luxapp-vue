<template>
    <form-section @submitted="createCategory">

        <template #title>
            Crear categoría
        </template>

        <template #description>
            Crea una nueva categoría para la página.
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
            <action-message :on="form.recentlySuccessful" class="mr-3">
                Creada.
            </action-message>

            <x-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Crear
            </x-button>
        </template>

    </form-section>
</template>

<script>
    import FormSection from './../../Shared/FormSection'
    import XLabel from './../../Shared/Label'
    import XInput from './../../Shared/Input'
    import InputError from './../../Shared/InputError'
    import ActionMessage from './../../Shared/ActionMessage'
    import XButton from './../../Shared/Button'

    export default {
        components: {
            FormSection,
            XLabel,
            XInput,
            InputError,
            ActionMessage,
            XButton,
        },

        data() {
            return {
                form: this.$inertia.form({
                    '_method': 'POST',
                    name: null,
                    description: null,
                }, {
                    bag: 'default',
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
