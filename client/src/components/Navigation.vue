<template>
    <div>
        <div class="flex w-full justify-around items-center bg-green-700 p-3">
            <div class="flex items-baseline">
                <h1 class="text-5xl font-light text-white">Banca della Terra</h1>
                <h1 class="text-l font-light text-white"><span>_ </span>by TREEBU</h1>
            </div>
            <div class="flex flex-col font-light text-white">
                <button @click="goToHome()" class="bg-purple-800 px-3 py-2 rounded-md transform hover:scale-105 transition duration-500">Home</button>
            </div>
            <div class="flex flex-col font-light text-white">
                <button @click="goToCreate()" class="bg-purple-800 px-3 py-2 rounded-md transform hover:scale-105 transition duration-500">Nuovo Terreno</button>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            pathForHome: "/",
            pathForNewField: "/create",
        }
    },
    methods: {
        goToHome() {
            this.$router.push({
                name: "field_list"
            })
        },
        goToCreate() {
            this.$router.push({
                name: "field_create"
            })
        },
    }
}
</script>
