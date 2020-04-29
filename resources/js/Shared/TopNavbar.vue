<template>
    <header class="flex flex-shrink-0">
        <div class="flex flex-shrink-0 bg-orange-600 px-4 py-3 items-center">
            <div class="flex flex-wrap items-center ">
                <vs-avatar src="/assets/images/logo_ivoire.jpg" size="large"></vs-avatar>
                <span class="text-white text-xl font-medium block">Ivoire construction</span>
                <div class="w-1/2 -mt-2 ml-12">
                    <span class="text-yellow-400 block">L'immoblier c'est notre métier</span>
                </div>
            </div>

        </div>
        <div class="flex flex-1 bg-orange-500 items-center justify-between px-6">
            <nav class="flex">
                <inertia-link :href="route('clients')"
                              class="ml-2 inline-bloc px-3 py-2 leading-none text-sm text-white bg-orange-600 rounded-lg font-medium hover:bg-orange-400">
                    Clients
                </inertia-link>
                <inertia-link :href="route('finances')"
                              class="ml-2 inline-bloc px-3 py-2 leading-none text-sm text-white bg-orange-600 rounded-lg font-medium hover:bg-orange-400">
                    Finances
                </inertia-link>
                <inertia-link :href="route('users')"
                              class="ml-2 inline-bloc px-3 py-2 leading-none text-sm text-white bg-orange-600 rounded-lg font-medium hover:bg-orange-400">
                    Utilisateurs
                </inertia-link>
                <inertia-link :href="route('maisons')"
                              class="ml-2 inline-bloc px-3 py-2 leading-none text-sm text-white bg-orange-600 rounded-lg font-medium hover:bg-orange-400">
                    Maisons
                </inertia-link>
            </nav>
            <div>
                <user-profil></user-profil>
            </div>
        </div>
    </header>
</template>

<script>
    import UserProfil from "@/Shared/UserProfil";
    export default {
        name: "TopNavbar",
        components: {
            UserProfil
        }
    }
</script>

<style scoped>

</style>
