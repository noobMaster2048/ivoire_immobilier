<template>
    <div class="overflow-hidden h-full">
        <div >
            <nav>
                <h2 class="text-xs font-semibold text-white uppercase tracking-wide">Menu</h2>

                <div class="mt-4">
                    <inertia-link :href="route('acceuil')" class="flex items-center text-sm font-medium justify-between -mx-3 px-3 py-1">
                    <span class="inline-flex">
                        <vs-icon icon="home" class="h-6 w-6 fill-current text-gray-700"></vs-icon>
                        <span class="ml-4 text-gray-900">Acceuil</span>
                    </span>
                    </inertia-link>

                    <inertia-link :href="route('clients')" class="flex items-center text-sm justify-between font-medium -mx-3 mt-2 px-3 py-1">
                    <span class="inline-flex">
                        <vs-icon icon="account_circle" class="h-6 w-6 fill-current text-gray-700"></vs-icon>
                        <span class="ml-4 text-gray-900">Espace client</span>
                    </span>
                    </inertia-link>

                    <inertia-link :href="route('finances')"
                                  class="flex items-center text-sm font-medium justify-between -mx-3 mt-2 px-3 py-4">
                    <span class="inline-flex">
                        <vs-icon icon="payment" class="h-6 w-6 fill-current text-gray-700"></vs-icon>
                        <span class="ml-4 text-gray-900">Espace finances</span>
                    </span>
                    </inertia-link>

                    <inertia-link :href="route('recu')"
                                  class="flex items-center text-sm font-medium justify-between -mx-3 mt-2 px-3 py-4">
                    <span class="inline-flex">
                        <vs-icon icon="receipt" class="h-6 w-6 fill-current text-gray-700"></vs-icon>
                        <span class="ml-4 text-gray-900">Generer les réçus</span>
                    </span>
                    </inertia-link>

                    <inertia-link :href="route('base.statistique')"
                                  class="flex items-center text-sm font-medium justify-between -mx-3 mt-2 px-3 py-4">
                    <span class="inline-flex">
                        <vs-icon icon="signal_cellular_alt" class="h-6 w-6 fill-current text-gray-700"></vs-icon>
                        <span class="ml-4 text-gray-900">Statistiques de bases</span>
                    </span>
                    </inertia-link>
                    <inertia-link :href="route('autre.statistique')"
                                  class="flex items-center text-sm font-medium justify-between -mx-3 mt-2 px-3 py-4">
                    <span class="inline-flex">
                        <vs-icon icon="equalizer" class="h-6 w-6 fill-current text-gray-700"></vs-icon>
                        <span class="ml-4 text-gray-900">Autres statistiques</span>
                    </span>
                    </inertia-link>
                    <inertia-link :href="route('journal.logs')"
                                  class="flex items-center text-sm font-medium justify-between -mx-3 mt-2 px-3 py-4">
                    <span class="inline-flex">
                        <vs-icon icon="description" class="h-6 w-6 fill-current text-gray-700"></vs-icon>
                        <span class="ml-4 text-gray-900">Journal des actions</span>
                    </span>
                    </inertia-link>
                    <inertia-link :href="route('journal.paiements')"
                                  class="rounded-lg flex items-center text-sm font-medium justify-between -mx-3 mt-2 px-3 py-4">
                    <span class="inline-flex">
                        <vs-icon icon="list" class="h-6 w-6 fill-current text-gray-700"></vs-icon>
                        <span class="ml-4 text-gray-900">Journal des paiements</span>
                    </span>
                    </inertia-link>
                    <inertia-link :href="route('clients.inactif')"
                                  class="rounded-lg flex items-center text-sm font-medium justify-between -mx-3 mt-2 px-3 py-4">
                    <span class="inline-flex">
                        <vs-icon icon="list" class="h-6 w-6 fill-current text-gray-700"></vs-icon>
                        <span class="ml-4 text-gray-900">Corbeille clients</span>
                    </span>
                    </inertia-link>
                    <inertia-link :href="route('contrats')"
                                  class="rounded-lg flex items-center text-sm font-medium justify-between -mx-3 mt-2 px-3 py-4">
                    <span class="inline-flex">
                        <vs-icon icon="list" class="h-6 w-6 fill-current text-gray-700"></vs-icon>
                        <span class="ml-4 text-gray-900">Espace juridique</span>
                    </span>
                    </inertia-link>
                </div>

            </nav>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Sidebar"
    }
</script>

<style scoped>

</style>
