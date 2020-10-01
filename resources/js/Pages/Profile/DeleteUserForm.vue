<template>
    <action-section>
        <template #title>
            Eliminar cuenta
        </template>

        <template #description>
            Eliminar tu cuenta permanentemente.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                Una vez eliminada la cuenta, todos los datos serán eliminados permanentemente. Antes de eliminarla, por favor guarda cualquier dato o información que quieras mantener.
            </div>

            <div class="mt-5">
                <danger-button @click.native="confirmUserDeletion">
                    Eliminar cuenta
                </danger-button>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <dialog-modal :show="confirmingUserDeletion" @close="confirmingUserDeletion = false">
                <template #title>
                    Eliminar cuenta
                </template>

                <template #content>
                    ¿Estás seguro que quieres eliminar tu cuenta? Una vez eliminada la cuenta, todos los datos serán eliminados permanentemente. Por favor introduce tu contraseña para confirmar que quieres eliminar tu cuenta permanentemente.

                    <div class="mt-4">
                        <x-input type="password" class="mt-1 block w-3/4" placeholder="Contraseña"
                                    ref="password"
                                    v-model="form.password"
                                    @keyup.enter.native="deleteUser" />

                        <input-error :message="form.error('password')" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <secondary-button @click.native="confirmingUserDeletion = false">
                        Regresar
                    </secondary-button>

                    <danger-button class="ml-2" @click.native="deleteUser" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Eliminar cuenta
                    </danger-button>
                </template>
            </dialog-modal>
        </template>
    </action-section>
</template>

<script>
    import ActionSection from './../../Shared/ActionSection'
    import DialogModal from './../../Shared/DialogModal'
    import DangerButton from './../../Shared/DangerButton'
    import XInput from './../../Shared/Input'
    import InputError from './../../Shared/InputError'
    import SecondaryButton from './../../Shared/SecondaryButton'

    export default {
        components: {
            ActionSection,
            DangerButton,
            DialogModal,
            XInput,
            InputError,
            SecondaryButton,
        },

        data() {
            return {
                confirmingUserDeletion: false,
                deleting: false,

                form: this.$inertia.form({
                    '_method': 'DELETE',
                    password: '',
                }, {
                    bag: 'deleteUser'
                })
            }
        },

        methods: {
            confirmUserDeletion() {
                this.form.password = '';

                this.confirmingUserDeletion = true;

                setTimeout(() => {
                    this.$refs.password.focus()
                }, 250)
            },

            deleteUser() {
                this.form.post('/user', {
                    preserveScroll: true
                }).then(response => {
                    if (! this.form.hasErrors()) {
                        this.confirmingUserDeletion = false;
                    }
                })
            },
        },
    }
</script>
