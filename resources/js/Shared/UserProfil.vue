<template>
    <div class="flex items-center">
        <div class="text-right leading-tight hidden sm:block">
            <p class="font-semibold text-white">Connecté en tant que </p>
        </div>
        <div class="flex items-center justify-between">
            <vs-dropdown vs-custom-content vs-trigger-click class="cursor-pointer">
                <div class="mx-4">
                    <vs-avatar :text="$page.auth.user.login" size="large"></vs-avatar>
                </div>
                <vs-dropdown-menu>
                    <ul>
                        <li class="flex py-2 px-4 cursor-pointer hover:text-white hover:bg-gray-800">
                            <vs-icon icon="account_box"></vs-icon>
                            <span class="ml-2">Profil</span>
                        </li>
                        <vs-divider class="m-1"></vs-divider>
                        <li @click="logout"
                            class="flex py-2 px-4 cursor-pointer hover:text-white hover:bg-gray-800">
                            <vs-icon icon="exit_to_app"></vs-icon>
                            <span >Déconnexion</span>
                        </li>
                    </ul>
                </vs-dropdown-menu>
            </vs-dropdown>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserProfil",
        methods: {
            logout() {
                return this.$inertia.post(this.route('deconnexion'))
            }
        }
    }
</script>

<style scoped>

</style>
