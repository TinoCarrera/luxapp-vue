<template>
    <app-layout>
        <template #header>
            Dashboard
        </template>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <welcome />
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'
    import Welcome from './../Shared/Welcome'

    export default {
        components: {
            AppLayout,
            Welcome,
        },
    }
</script>
