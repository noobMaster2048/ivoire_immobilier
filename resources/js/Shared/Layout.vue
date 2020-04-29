<template>
    <div class="h-screen flex flex-col">
        <top-navbar></top-navbar>
        <div class="flex flex-1">
            <div class="w-64 p-6 bg-gray-100">
               <Sidebar></Sidebar>
            </div>
            <main class="w-full">
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<script>
    import TopNavbar from '@/Shared/TopNavbar';
    import Sidebar from '@/Shared/Sidebar';
    export default {
        components: {
            TopNavbar,
            Sidebar
        }
    }
</script>

<style scoped>

</style>
