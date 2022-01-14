<template>
    <div>
        <div class="h-full">
            <div class="grid grid-cols-4 gap-3 p-5">
                <div v-for="field in fields" :key="field.id" class="flex flex-col bg-indigo-300 p-3 rounded-xl cursor-pointer" @click="goToView(field)">
                    <div class="w-52 h-80 rounded-md flex mx-auto">
                        <img :src="field.img" alt="book_img" class="w-auto h-full">
                    </div>
                    <div class="col-span-7 flex flex-col p-4 justify-around">
                        <div class="flex border-b border-gray-200">
                            <h2 class="text-l font-light"><span class="font-bold">Comune: </span>{{ field.municipality }}</h2>
                        </div>
                        <div class="flex border-b border-gray-200">
                            <h2 class="text-l font-light"><span class="font-bold">Dimensioni: </span>{{ field.dimension }}</h2>
                        </div>
                        <div class="flex border-b border-gray-200">
                            <h2 class="text-l font-light"><span class="font-bold">Tipologia di terreno: </span>{{ field.ground_type }}</h2>
                        </div>
                        <div class="flex border-b border-gray-200">
                            <h2 class="text-l font-light"><span class="font-bold">Tipologia di irrigazione: </span>{{ field.irrigation_type }}</h2>
                        </div>
                        <div class="flex border-b border-gray-200">
                            <h2 class="text-l font-light"><span class="font-bold">Tipo di offerta: </span>{{ field.offer_type }}</h2>
                        </div>
                        <div class="flex border-b border-gray-200">
                            <h2 class="text-l font-light"><span class="font-bold">Canone di offerta: </span>{{ field.offer_fee }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            fields: []
        }
    },
    async mounted() {
        try {
            let response = await axios.get("http://localhost:8000/api/list");
            this.fields = response.data;
        } catch (err) {
            console.log(err);
        }
    },
    methods: {
        goToView(field) {
            this.$router.push("/view/"+ field.id)
        },
    }
}
</script>
