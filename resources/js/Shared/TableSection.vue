<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <section-title>
            <template #title><slot name="title"></slot></template>
            <template #description><slot name="description"></slot></template>
        </section-title>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                <table class="w-full whitespace-no-wrap">
                    <slot name="table"></slot>
                </table>
            </div>
            <slot name="pagination"></slot>
        </div>
    </div>
</template>

<script>
    import SectionTitle from './SectionTitle'

    export default {
        components: {
            SectionTitle,
        },
    }
</script>
