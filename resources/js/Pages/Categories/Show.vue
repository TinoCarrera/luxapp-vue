<template>
    <app-layout>
        <template #header>
            Categorías
        </template>

        <div>
            <select-category :categories="categories" />

            <section-border />

            <create-category />
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import SelectCategory from './SelectCategory'
    import SectionBorder from './../../Shared/SectionBorder'
    import CreateCategory from './CreateCategory'

    export default {
        components: {
            AppLayout,
            SelectCategory,
            SectionBorder,
            CreateCategory,
        },
        
        props: {
            categories: Array,
        },
    }
</script>