<template>
    <div>
        <div class="w-full h-full">
            <div class="flex flex-col p-5 items-center">
                <div class="flex p-5">
                    <p class="font-bold text-xl border-b border-gray-800">Aggiungi un nuovo terreno</p>
                </div>
                <div>
                    <div v-for="(field, index) in formFields" :key="index">
                        <label for="">
                            {{ field.label }}
                        </label>
                        <div class="flex flex-grow w-auto">
                            <div v-if="field.type == 'text'">
                                <input type="text" :placeholder="field.placeholder" v-model="newField[field.code]" class="rounded-md p-2 w-96 border-2"/>
                            </div>
                            <div v-if="field.type == 'string'">
                                <input type="text" :placeholder="field.placeholder" v-model="newField[field.code]" class="rounded-md p-2 w-96 border-2"/>
                            </div>
                            <div v-if="field.type == 'number'">
                                <input type="textfield" :placeholder="field.placeholder" v-model="newField[field.code]" class="rounded-md p-2 w-96 border-2"/>
                            </div>
                            <div v-if="field.type == 'select'">
                                <select :name="field.code" class="p-2 rounded-md w-96 border-2" type="select" v-model="newField[field.code]" :id="field.code">
                                    <option v-for="option in field.options" :key="option.value" :value="option.value">{{ option.label }}</option>
                                </select>
                            </div>
                            <div v-if="field.type == 'boolean'">
                                <input type="checkbox" v-model="newField[field.code]">
                            </div>
                        </div>
                        <div v-if="field.required" class="mb-2">
                            <span v-if="!newField[field.code]">
                                Questo campo è obbligatorio!
                            </span>
                        </div>
                    </div>
                    <div>
                        <button class="bg-green-700 p-4 rounded-xl mt-5" :disabled="!isFormValid" :class="{'cursor-pointer': isFormValid, 'cursor-not-allowed': !isFormValid}" @click="createField()">
                            Aggiungi Nuovo Terreno
                        </button>
                        <div v-if="created" class="mt-3">
                            <h1 class="text-green-400 text-xl font-light text-center">Nuovo terreno aggiunto con successo!</h1>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return{
            newField:
            {
                municipality: '',
                img: '',
                dimension: '',
                cadastral_sheet: '',
                cadastral_map: '',
                cadastral_parcel: '',
                ground_type: '',
                irrigation_type: '',
                offer_type: '',
                offer_fee: '',
                availability: false
            },
            formFields: [
                {
                    code: "municipality",
                    label: "Comune",
                    type: "text",
                    placeholder: "Inserisci il comune in cui si trova il terreno",
                    required: true
                },
                {
                    code: "img",
                    label: "Foto aerea",
                    type: "text",
                    placeholder: "Inserisci il link dell'immagine",
                    required: true
                },
                {
                    code: "dimension",
                    label: "Dimensione",
                    type: "number",
                    placeholder: "Inserisci la dimensione del terreno in ettari",
                    required: true
                },
                {
                    code: "cadastral_sheet",
                    label: "Foglio catastale",
                    type: "string",
                    placeholder: "Inserisci il foglio catastale del terreno",
                    required: true
                },
                {
                    code: "cadastral_map",
                    label: "Mappale catastale",
                    type: "string",
                    placeholder: "Inserisci il mappale catastale del terreno",
                    required: true
                },
                {
                    code: "cadastral_parcel",
                    label: "Parcella catastale",
                    type: "string",
                    placeholder: "Inserisci la parcella catastale del terreno",
                    required: true
                },
                {
                    code: "ground_type",
                    label: "Tipologia del terreno",
                    type: "select",
                    required: true,
                    options: [
                        {
                        value: "Argilloso",
                        label: "Argilloso"
                        },
                        {
                        value: "Sabbioso",
                        label: "Sabbioso"
                        },
                        {
                        value: "Ghiaioso",
                        label: "Ghiaioso"
                        },
                        {
                        value: "Tufo",
                        label: "Tufo"
                        }
                    ]
                },
                {
                    code: "irrigation_type",
                    label: "Tipologia di irrigazione",
                    type: "select",
                    required: true,
                    options: [
                        {
                        value: "A scorrimento",
                        label: "A scorrimento"
                        },
                        {
                        value: "Pozzo",
                        label: "Pozzo"
                        },
                        {
                        value: "Canale",
                        label: "Canale"
                        },
                        {
                        value: "Senz'acqua",
                        label: "Senz'acqua"
                        }
                    ]
                },
                {
                    code: "offer_type",
                    label: "Tipologia di offerta",
                    type: "select",
                    required: true,
                    options: [
                        {
                        value: "Vendita",
                        label: "Vendita"
                        },
                        {
                        value: "Affitto",
                        label: "Affitto"
                        },
                        {
                        value: "Affido gratuito",
                        label: "Affido gratuito"
                        }
                    ]
                },
                {
                    code: "offer_fee",
                    label: "Canone offerta",
                    type: "number",
                    placeholder: "Inserisci il canone di offerta del terreno",
                    required: true
                },
                {
                    code: "availability",
                    label: "Disponibilità",
                    type: "boolean",
                    required: true
                }
            ],
            created: false
        }
    },
    async mounted() {
        try {
            let responseField = await axios.get('http://localhost:8000/api/list');
            this.fields = responseField.data;
        } catch (err) {
            console.log(err);
        }
    },
    methods:{
        async createField(){
            let request = await axios.post('http://localhost:8000/api/create', this.newField);
            console.log(request.data)
            this.created = true;
        }
    },
    computed: {
        isFormValid() {
            let formIsValid = true;

            formIsValid = formIsValid && !!this.newField.municipality;
            formIsValid = formIsValid && !!this.newField.img;
            formIsValid = formIsValid && !!this.newField.dimension;
            formIsValid = formIsValid && !!this.newField.cadastral_sheet;
            formIsValid = formIsValid && !!this.newField.cadastral_map;
            formIsValid = formIsValid && !!this.newField.cadastral_parcel;
            formIsValid = formIsValid && !!this.newField.ground_type;
            formIsValid = formIsValid && !!this.newField.irrigation_type;
            formIsValid = formIsValid && !!this.newField.offer_type;
            formIsValid = formIsValid && !!this.newField.offer_fee;
            formIsValid = formIsValid && !!this.newField.availability;

            return formIsValid
        }
    }
}
</script>
