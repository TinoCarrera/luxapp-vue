<template>
    <app-layout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crear categoría
            </h2>
        </template>

        <div class="flex flex-col">
            <div class="h-screen flex flex-col">
                <div class="flex flex-grow overflow-hidden">
                    <div class="flex-1 px-4 py-8 md:p-12 overflow-y-auto" scroll-region>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import Icon from './../Shared/Icon'

    export default {
        components: {
            AppLayout,
            Icon,
        },
    }
</script>