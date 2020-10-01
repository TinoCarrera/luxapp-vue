<template>
    <form-section @submitted="updateProfileInformation">
        <template #title>
            Información de perfil
        </template>

        <template #description>
            Actualiza tu información de perfil y correo electrónico.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div class="col-span-6 sm:col-span-4" v-if="$page.jetstream.managesProfilePhotos">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            ref="photo"
                            @change="updatePhotoPreview">

                <x-label for="photo" value="Foto" />

                <!-- Current Profile Photo -->
                <div class="mt-2" v-show="! photoPreview">
                    <img :src="$page.user.profile_photo_url" alt="Current Profile Photo" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" v-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <secondary-button class="mt-2 mr-2" type="button" @click.native.prevent="selectNewPhoto">
                    Seleccionar nueva foto
                </secondary-button>

                <secondary-button type="button" class="mt-2" @click.native.prevent="deletePhoto" v-if="$page.user.profile_photo_path">
                    Quitar foto
                </secondary-button>

                <input-error :message="form.error('photo')" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="Nombre" />
                <x-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
                <input-error :message="form.error('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="email" value="Correo electrónico" />
                <x-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" />
                <input-error :message="form.error('email')" class="mt-2" />
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
    import XButton from './../../Shared/Button'
    import FormSection from './../../Shared/FormSection'
    import XInput from './../../Shared/Input'
    import InputError from './../../Shared/InputError'
    import XLabel from './../../Shared/Label'
    import ActionMessage from './../../Shared/ActionMessage'
    import SecondaryButton from './../../Shared/SecondaryButton'

    export default {
        components: {
            ActionMessage,
            XButton,
            FormSection,
            XInput,
            InputError,
            XLabel,
            SecondaryButton,
        },

        props: ['name', 'email'],

        data() {
            return {
                form: this.$inertia.form({
                    '_method': 'PUT',
                    name: this.name,
                    email: this.email,
                    photo: null,
                }, {
                    bag: 'updateProfileInformation',
                    resetOnSuccess: false,
                }),

                photoPreview: null,
            }
        },

        methods: {
            updateProfileInformation() {
                if (this.$refs.photo) {
                    this.form.photo = this.$refs.photo.files[0]
                }

                this.form.post('/user/profile-information', {
                    preserveScroll: true
                });
            },

            selectNewPhoto() {
                this.$refs.photo.click();
            },

            updatePhotoPreview() {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };

                reader.readAsDataURL(this.$refs.photo.files[0]);
            },

            deletePhoto() {
                this.$inertia.delete('/user/profile-photo', {
                    preserveScroll: true,
                }).then(() => {
                    this.photoPreview = null
                });
            },
        },
    }
</script>
