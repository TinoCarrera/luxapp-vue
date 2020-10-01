<template>
    <app-layout>
        <template #header>
            Perfil
        </template>
        
        <div>
            <update-profile-information-form :name="$page.user.name" :email="$page.user.email" />

            <section-border />

            <update-password-form class="mt-10 sm:mt-0" />

            <section-border />

            <logout-other-browser-sessions-form :sessions="sessions" class="mt-10 sm:mt-0" />

            <section-border />

            <delete-user-form class="mt-10 sm:mt-0" />
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import DeleteUserForm from './DeleteUserForm'
    import SectionBorder from './../../Shared/SectionBorder'
    import LogoutOtherBrowserSessionsForm from './LogoutOtherBrowserSessionsForm'
    import UpdatePasswordForm from './UpdatePasswordForm'
    import UpdateProfileInformationForm from './UpdateProfileInformationForm'

    export default {
        props: ['sessions'],

        components: {
            AppLayout,
            DeleteUserForm,
            SectionBorder,
            LogoutOtherBrowserSessionsForm,
            UpdatePasswordForm,
            UpdateProfileInformationForm,
        },
    }
</script>
