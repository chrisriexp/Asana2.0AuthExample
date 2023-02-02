<template>
    <div class="bg-[#F9F6F0] w-full h-screen pt-16">
        <div v-if="!submitted" class="grid gap-12 w-fit h-fit py-8 px-24 rounded-xl bg-white shadow-newdrop mx-auto">
            <img src="../../assets/logo.png" class="h-[50px]" alt="RocketAutomation Logo">

            <div class="grid gap-10">
                <div class="grid gap-2 w-full h-fit">
                    <label for="appID" class="text-md text-custom-gray opacity-50 font-medium">Application ID <span class="text-red-400">*</span></label>
                    <input type="text" v-model="appID" v-mask="['RFAA#####']" class="bg-[#F8FAFC] border-custom-gray border-[1px] border-opacity-20 text-custom-gray rounded-lg focus:ring-0 focus:border-custom-gray focus:border-opacity-20">
                </div>

                <div v-for="(carrier, index) in carriers" :key="index" class="grid gap-4 w-full">
                    <div class="grid gap-2">
                        <label :for="'carrierName'+index" class="text-md text-custom-gray opacity-50 font-medium" >Carrier Select <span class="text-red-400">*</span></label>
                        <select v-model="carriers[index].name" :name="'carrierName'+index" :id="'carrierName'+index" class="bg-[#F8FAFC] border-custom-gray border-[1px] border-opacity-20 text-custom-gray rounded-lg focus:ring-0 focus:border-custom-gray focus:border-opacity-20">
                            <option value="" disabled>Select Carrier</option>
                            <option value="aon">Aon Edge</option>
                            <option value="beyond">Beyond Floods</option>
                            <option value="dual">Dual</option>
                        </select>
                    </div>

                    <div class="grid gap-2">
                        <label :for="'carrierDesc'+index" class="text-md text-custom-gray opacity-50 font-medium" >Error Description <span class="text-red-400">*</span></label>
                        <textarea v-model="carriers[index].desc" :name="'carrierDesc'+index" :id="'carrierDesc'+index" rows="3" class="bg-[#F8FAFC] border-custom-gray border-[1px] border-opacity-20 text-custom-gray rounded-lg focus:ring-0 focus:border-custom-gray focus:border-opacity-20"></textarea>
                    </div>

                    <TrashIcon @click="deleteCarrier(index)" v-if="carriers.length > 1" class="text-red-500 h-8 font-bold hover:cursor-pointer" />
                </div>

                <button @click="addCarrier($event)" class="w-fit text-custom-gray bg-white border-custom-gray border-2 border-opacity-20 rounded-lg p-2 font-semibold hover:text-white hover:bg-custom-gray">Add Additional Carrier Error</button>
            </div>

            <button @click="submit()" class="text-white bg-custom-blue rounded-lg p-2 font-semibold">Submit</button>
        </div>

        <div v-else class="grid gap-12 w-fit h-fit py-8 px-24 rounded-xl bg-white shadow-newdrop mx-auto mt-16">
            <img src="../../assets/logo.png" class="h-[50px]" alt="RocketAutomation Logo">

            <div class="grid gap-2">
                <h2 class="text-custom-blue font-semibold text-2xl text-center">Thank you for submitted the error!</h2>
                <p class="text-custom-gray text-md text-center">Thanks to you we will be able to continue keeping <br> the Rocket Automation system running A1.</p>
            </div>
        </div>
    </div>
</template>

<script>
import {mask} from 'vue-the-mask'
import { TrashIcon } from '@heroicons/vue/24/outline'
import axios from 'axios'


export default{
    name: "ReportError",
    data(){
        return {
            appID: 'RFAA',
            carriers: [
                {
                    name: '',
                    desc: ''
                }
            ],
            valid: true,
            submitted: false,
        }
    },
    methods: {
        addCarrier(e){
            this.carriers.push({name: '', desc: ''})
        },
        deleteCarrier(index){
            this.carriers.splice(index, 1)
        },
        submit(){
            this.valid = true

            if(this.appID.length < 9){
                alert('Please enter application id.')
                this.valid = false
                return
            }
            
            this.carriers.forEach(carrier => {
                if(carrier.name == '' || carrier.desc == ''){
                    alert('Please enter all carrier names and error description.')
                    this.valid = false
                }
            })

            if(this.valid){
                this.carriers.forEach(carrier => {
                    let isAPI = false
                    const apiCarriers = ['aon', 'beyond']

                    apiCarriers.forEach(api => {
                        if(!isAPI){
                            if(api == carrier.name){
                                isAPI = true
                            }
                        }
                    })

                    axios.post('/api/task/add', {
                        "appID": this.appID,
                        'carrier': carrier.name,
                        'desc': carrier.desc,
                        'api': isAPI
                    })
                })

                this.submitted = true
                return
            }
        }
    },
    directives: {mask},
    components: {
        TrashIcon
    }
}
</script>