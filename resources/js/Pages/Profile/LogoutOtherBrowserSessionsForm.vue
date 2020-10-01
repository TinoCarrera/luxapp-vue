<template>
    <action-section>
        <template #title>
            Sesiones
        </template>

        <template #description>
            Administrar y salir tus sesiones activas en otros navegadores y dispositivos.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                Si lo necesitas, puedes salir de todas las sesiones de tus dispositivos. Si sientes que tu cuenta no está segura, también puedes actualizar tu contraseña.
            </div>

            <!-- Other Browser Sessions -->
            <div class="mt-5 space-y-6" v-if="sessions.length > 0">
                <div class="flex items-center" v-for="session in sessions">
                    <div>
                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-500" v-if="session.agent.is_desktop">
                            <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-gray-500" v-else>
                            <path d="M0 0h24v24H0z" stroke="none"></path><rect x="7" y="4" width="10" height="16" rx="1"></rect><path d="M11 5h2M12 17v.01"></path>
                        </svg>
                    </div>

                    <div class="ml-3">
                        <div class="text-sm text-gray-600">
                            {{ session.agent.platform }} - {{ session.agent.browser }}
                        </div>

                        <div>
                            <div class="text-xs text-gray-500">
                                {{ session.ip_address }},

                                <span class="text-green-500 font-semibold" v-if="session.is_current_device">Este dispositivo</span>
                                <span v-else>Última actividad {{ session.last_active }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center mt-5">
                <x-button @click.native="confirmLogout">
                    Salir de todas las sesiones
                </x-button>

                <action-message :on="form.recentlySuccessful" class="ml-3">
                    Listo.
                </action-message>
            </div>

            <!-- Logout Other Devices Confirmation Modal -->
            <dialog-modal :show="confirmingLogout" @close="confirmingLogout = false">
                <template #title>
                    Salir de todas las sesiones
                </template>

                <template #content>
                    Por favor introduce tu contraseña para confirmar que quieres salir de todas las sesiones de tus dispositivos.

                    <div class="mt-4">
                        <x-input type="password" class="mt-1 block w-3/4" placeholder="Contraseña"
                                    ref="password"
                                    v-model="form.password"
                                    @keyup.enter.native="logoutOtherBrowserSessions" />

                        <input-error :message="form.error('password')" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <secondary-button @click.native="confirmingLogout = false">
                        Regresar
                    </secondary-button>

                    <x-button class="ml-2" @click.native="logoutOtherBrowserSessions" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Salir de todas las sesiones
                    </x-button>
                </template>
            </dialog-modal>
        </template>
    </action-section>
</template>

<script>
    import ActionMessage from './../../Shared/ActionMessage'
    import ActionSection from './../../Shared/ActionSection'
    import XButton from './../../Shared/Button'
    import DialogModal from './../../Shared/DialogModal'
    import XInput from './../../Shared/Input'
    import InputError from './../../Shared/InputError'
    import SecondaryButton from './../../Shared/SecondaryButton'

    export default {
        props: ['sessions'],

        components: {
            ActionMessage,
            ActionSection,
            XButton,
            DialogModal,
            XInput,
            InputError,
            SecondaryButton,
        },

        data() {
            return {
                confirmingLogout: false,

                form: this.$inertia.form({
                    '_method': 'DELETE',
                    password: '',
                }, {
                    bag: 'logoutOtherBrowserSessions'
                })
            }
        },

        methods: {
            confirmLogout() {
                this.form.password = ''

                this.confirmingLogout = true

                setTimeout(() => {
                    this.$refs.password.focus()
                }, 250)
            },

            logoutOtherBrowserSessions() {
                this.form.post('/user/other-browser-sessions', {
                    preserveScroll: true
                }).then(response => {
                    if (! this.form.hasErrors()) {
                        this.confirmingLogout = false
                    }
                })
            },
        },
    }
</script>
