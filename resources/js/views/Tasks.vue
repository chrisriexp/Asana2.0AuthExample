<template>
    <div class="w-full h-full z-0 absolute bg-custom-blue bg-opacity-10">
        <NavBar :tasks=true />

        <div class="w-[90%] grid h-fit px-6 pb-16 pt-8 shadow-newdrop bg-white rounded-xl mt-16 mx-auto mb-16 gap-6">
            <div class="flex w-full flow-root">
                <div @click="resetFilter()" class="w-fit h-fit float-left p-2 border-custom-gray border-[1px] border-opacity-20 rounded-lg group hover:cursor-pointer hover:bg-custom-blue">
                    <ArrowPathIcon class="h-6 text-custom-gray group-hover:text-white" />
                </div>

                <a href="/report-error" class="text-sm mt-2 float-right p-2 bg-custom-blue text-white rounded-lg">Submit New Error</a>
            </div>

            <div class="grid grid-cols-6 gap-8 w-full text-md text-custom-gray p-2 border-b-2 border-custom-gray border-opacity-40">
                <input @change="filterAppID()" v-model="appID" type="text" class="border-none focus:ring-0 focus:border-none p-0 m-0" placeholder="Application ID">
                <p class="hover:cursor-pointer">Carrier</p>
                <p class="col-span-2">Error Description</p>
                <div class="flex w-fit gap-2">
                    <p>API Error</p>
                    <input @change="filterAPI()" type="checkbox" id="apiFilter" class="focus:ring-0 rounded-lg my-auto focus:ring-offset-0 text-custom-blue">
                </div>
                <p>Date Submitted</p>
            </div>

            <div v-for="(task, index) in filterView" :key="index" class="bg-custom-blue bg-opacity-10 p-2 grid grid-cols-6 w-full h-fit rounded-lg border-custom-gray border-[1px] border-opacity-20 text-md text-custom-gray hover:bg-custom-blue hover:text-white hover:cursor-pointer">
                <p>{{ task.appID }}</p>
                <p>{{ task.carrier }}</p>
                <p class="col-span-2">{{ task.desc }}</p>
                <p v-if="task.api" class="uppercase px-4 rounded-md bg-green-400 ml-6 text-sm text-white w-fit text-center h-fit my-auto">yes</p>
                <p v-else class="uppercase px-4 rounded-md bg-red-400 ml-6 text-sm text-white w-fit text-center h-fit my-auto">no</p>
                <p>{{ moment(task.date).format("ddd, MMM Do YYYY, h:mm a") }}</p>
            </div>
        </div>

        <Footer class="bottom-0 absolute" />
    </div>
</template>

<script>
import axios from 'axios';
import moment from 'moment';
import NavBar from '../components/navbar.vue'
import Footer from '../components/footer.vue'
import { ArrowPathIcon } from '@heroicons/vue/24/outline'

export default{
    name: "Tasks",
    data() {
        return {
            appID: '',
            api: false,
            tasks: [],
            filterView: []
        }
    },
    created: async function () {
        this.moment = moment

        await axios.get('/api/tasks')
        .then(response => {
            response.data.forEach(item => {
                this.tasks.push({id: item.id, appID: item.appID, carrier: item.carrier, desc: item.desc, api: item.api, date: item.created_at})
            })
        })

        this.filterView = this.tasks
    },
    methods: {
        filterAppID(){
            this.filterView = []

            this.tasks.forEach(task => {
                if(task.appID.includes(this.appID)){
                    this.filterView.push({id: task.id, appID: task.appID, carrier: task.carrier, desc: task.desc, api: task.api, date: task.created_at})
                }
            })
        },
        filterAPI(){
            this.api = !this.api

            if(this.api){
                this.filterView = []
                this.tasks.forEach(task => {
                    if(task.api){
                        this.filterView.push({id: task.id, appID: task.appID, carrier: task.carrier, desc: task.desc, api: task.api, date: task.created_at})
                    }
                })
            } else {
                this.filterView = []
                this.tasks.forEach(task => {
                    if(!task.api){
                        this.filterView.push({id: task.id, appID: task.appID, carrier: task.carrier, desc: task.desc, api: task.api, date: task.created_at})
                    }
                })
            }
        },
        resetFilter(){
            this.appID = '',
            this.api = false,
            document.getElementById('apiFilter').checked = false
            this.filterView = this.tasks
        }
    },
    components: {
        NavBar,
        ArrowPathIcon,
        Footer
    }
}
</script>