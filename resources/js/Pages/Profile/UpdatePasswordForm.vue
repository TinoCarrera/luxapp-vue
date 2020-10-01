<template>
    <form-section @submitted="updatePassword">
        <template #title>
            Actualizar contraseña
        </template>

        <template #description>
            Asegura tu cuenta usando una contraseña difícil y larga.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="current_password" value="Contraseña actual" />
                <x-input id="current_password" type="password" class="mt-1 block w-full" v-model="form.current_password" ref="current_password" autocomplete="current-password" />
                <input-error :message="form.error('current_password')" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="password" value="Nueva contraseña" />
                <x-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" autocomplete="new-password" />
                <input-error :message="form.error('password')" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="password_confirmation" value="Confirmar contraseña" />
                <x-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" autocomplete="new-password" />
                <input-error :message="form.error('password_confirmation')" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <action-message :on="form.recentlySuccessful" class="mr-3">
                Guardado.
            </action-message>

            <x-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Guardar
            </x-button>
        </template>
    </form-section>
</template>

<script>
    import ActionMessage from './../../Shared/ActionMessage'
    import XButton from './../../Shared/Button'
    import FormSection from './../../Shared/FormSection'
    import XInput from './../../Shared/Input'
    import InputError from './../../Shared/InputError'
    import XLabel from './../../Shared/Label'

    export default {
        components: {
            ActionMessage,
            XButton,
            FormSection,
            XInput,
            InputError,
            XLabel,
        },

        data() {
            return {
                form: this.$inertia.form({
                    current_password: '',
                    password: '',
                    password_confirmation: '',
                }, {
                    bag: 'updatePassword',
                }),
            }
        },

        methods: {
            updatePassword() {
                this.form.put('/user/password', {
                    preserveScroll: true
                }).then(() => {
                    this.$refs.current_password.focus()
                })
            },
        },
    }
</script>
