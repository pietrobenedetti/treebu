<template>
    <div>
        <div class="h-screen">
            <div class="flex flex-col">
                <div class="flex justify-around items-center my-3">
                    <div class="flex flex-col p-3">
                    <router-link to="/" class="font-bold">Indietro</router-link>
                    </div>
                    <div class="flex flex-col">
                    <button class="font-bold" @click="clickModify()">Modifica</button>
                    </div>
                </div>
                <div class="flex justify-around">
                    <div class="flex flex-col justify-around">
                    <div class="flex flex-col">
                        <label for="municipality" class="font-bold">Comune:</label>
                        <span v-if="!isModified">
                        {{field.municipality}}
                        </span>
                        <input v-else type="text" v-model="field.municipality" :class="{'bg-indigo-300': !isModified, 'text-left pl-2 rounded-full bg-gray-100': isModified}">
                    </div>
                    <div class="flex flex-col">
                        <label for="dimension" class="font-bold">Dimensione:</label>
                        <span v-if="!isModified">
                        {{field.dimension}}
                        </span>
                        <input v-else type="text" v-model="field.dimension" :class="{'bg-indigo-300': !isModified, 'text-left pl-2 rounded-full bg-gray-100': isModified}">
                    </div>
                    <div class="flex flex-col">
                        <div>
                        <label for="cadastral_sheet" class="font-bold">Foglio catastale:</label>
                        </div>
                        <div class="flex">
                        <span v-if="!isModified">
                        {{ field.cadastral_sheet }}
                        </span>
                        <input v-else type="text" v-model="field.cadastral_sheet" :class="{'bg-indigo-300': !isModified, 'text-left pl-2 rounded-full bg-gray-100': isModified}">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div>
                        <label for="cadastral_map" class="font-bold">Mappale catastale:</label>
                        </div>
                        <div class="flex">
                        <span v-if="!isModified">
                        {{ field.cadastral_map }}
                        </span>
                        <input v-else type="text" v-model="field.cadastral_map" :class="{'bg-indigo-300': !isModified, 'text-left pl-2 rounded-full bg-gray-100': isModified}">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div>
                        <label for="cadastral_parcel" class="font-bold">Parcella catastale:</label>
                        </div>
                        <div class="flex">
                        <span v-if="!isModified">
                        {{ field.cadastral_parcel }}
                        </span>
                        <input v-else type="text" v-model="field.cadastral_parcel" :class="{'bg-indigo-300': !isModified, 'text-left pl-2 rounded-full bg-gray-100': isModified}">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label for="title" class="font-bold">Tipologia di terreno:</label>
                        <span v-if="!isModified">
                        {{field.ground_type}}
                        </span>
                        <select v-else type="select" v-model="modField.code" :class="{'bg-indigo-300': !isModified, 'text-left pl-2 rounded-full bg-gray-100': isModified}">
                            <option v-for="option in modField.options" :key="option.code" :value="option.label">{{ modField.code }}</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="title" class="font-bold">Tipologia di irrigazione:</label>
                        <span v-if="!isModified">
                        {{field.irrigation_type}}
                        </span>
                        <select v-else type="select" v-model="modField.code" :class="{'bg-indigo-300': !isModified, 'text-left pl-2 rounded-full bg-gray-100': isModified}">
                            <option v-for="option in modField.options" :key="option.code" :value="option.label">{{ modField.code }}</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="title" class="font-bold">Tipologia di offerta:</label>
                        <span v-if="!isModified">
                        {{field.offer_type}}
                        </span>
                        <select v-else type="select" v-model="modField.code" :class="{'bg-indigo-300': !isModified, 'text-left pl-2 rounded-full bg-gray-100': isModified}">
                            <option v-for="option in modField.options" :key="option.code" :value="option.label">{{ modField.code }}</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <div>
                        <label for="offer_fee" class="font-bold">Canone offerta:</label>
                        </div>
                        <div class="flex">
                        <span v-if="!isModified">
                        {{ field.offer_fee }}
                        </span>
                        <input v-else type="text" v-model="field.offer_fee" :class="{'bg-indigo-300': !isModified, 'text-left pl-2 rounded-full bg-gray-100': isModified}">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div>
                        <label for="availability" class="font-bold">Disponibilità:</label>
                        </div>
                        <div class="flex">
                        <span v-if="!isModified">
                        {{ field.availability }}*
                        </span>
                        <input v-else type="checkbox" v-model="field.availability" :class="{'bg-indigo-300': !isModified, 'text-left pl-2 rounded-full bg-gray-100': isModified}">
                        </div>
                        <span class="text-xs">*1 = disponibile / 0 = indisponibile</span>
                    </div>
                    </div>
                    <div class="">
                        <img :src="field.img" alt="" class="w-96 h-auto bg-indigo-300 p-3 rounded-md">
                    </div>
                </div>
                <div v-if="!isModified"></div>
                <div v-else class="flex mx-auto mt-2">
                    <button @click="fieldModified()" class="mr-2">Salva modifiche</button>
                    <button @click="isModified = false" class="ml-2">Annulla</button>
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
            field: {},
            isModified: false,
            isLoading: true,
            modField: [
                {
                    label: "Tipologia di terreno",
                    code: "ground_type",
                    type: "select",
                    options: [
                        {
                        label: "Argilloso",
                        code: "Argilloso",
                        },
                        {
                        label: "Sabbioso",
                        code: "Sabbioso",
                        },
                        {
                        label: "Ghiaioso",
                        code: "Ghiaioso",
                        },
                        {
                        label: "Tufo",
                        code: "Tufo",
                        },
                    ],
                },
                {
                    label: "Tipologia di irrigazione",
                    code: "irrigation_type",
                    type: "select",
                    options: [
                        {
                        label: "A scorrimento",
                        code: "A scorrimento",
                        },
                        {
                        label: "Pozzo",
                        code: "Pozzo",
                        },
                        {
                        label: "Canale",
                        code: "Canale",
                        },
                        {
                        label: "Senz'acqua",
                        code: "Senz'acqua",
                        },
                    ],
                },
                {
                    label: "Tipo di offerta",
                    code: "offer_type",
                    type: "select",
                    options: [
                        {
                        label: "Vendita",
                        code: "Vendita",
                        },
                        {
                        label: "Affitto",
                        code: "Affitto",
                        },
                        {
                        label: "Affido gratuito",
                        code: "Affido gratuito",
                        },
                    ],
                },
            ]
        }
    },
    async mounted() {
    let fieldId = this.$route.params.id;

    console.log(fieldId);
    let response_field = await axios.get("http://localhost:8000/api/view/" + fieldId);
    
    this.field = response_field.data;
  },
  methods: {
    clickModify() {
      this.isModified = true;
    },
    fieldModified() {
      let fieldId = this.$route.params.id;

      let response = axios.put("http://127.0.0.1:8000/api/edit/" + fieldId, this.field);
      console.log(response.data);

      this.isModified = false;
      },
  }
}
</script>
