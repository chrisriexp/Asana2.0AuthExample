<template>
    <div class="w-full h-fit bg-white py-4 border-b-2 border-custom-gray border-opacity-20">
        <div class="w-[90%] mx-auto flex flow-root">
            <div class="float-left w-fit h-full">
                <img src="../../assets/logo.png" class="h-[40px] my-auto" alt="Rocket Automation Logo">
            </div>

            <div class="flex float-right items-center mt-2 gap-8 text-custom-gray font-medium text-md">
                <a href="/dashboard" :class="dashboard ? 'text-custom-blue border-custom-blue' : 'border-transparent' " class="p-[1px] hover:text-custom-blue border-b-2 hover:border-custom-blue hover:border-b-2">Dashboard</a>
                <a href="/tasks" :class="tasks ? 'text-custom-blue border-custom-blue' : 'border-transparent' " class="p-[1px] hover:text-custom-blue border-b-2 hover:border-custom-blue hover:border-b-2">Tasks</a>
                <a href="/notes" :class="notes ? 'text-custom-blue border-custom-blue' : 'border-transparent' " class="p-[1px] hover:text-custom-blue border-b-2 hover:border-custom-blue hover:border-b-2">Notes</a>
                <a href="/reminders" :class="reminders ? 'text-custom-blue border-custom-blue' : 'border-transparent' " class="p-[1px] hover:text-custom-blue border-b-2 hover:border-custom-blue hover:border-b-2">Reminder</a>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    name: "NavBar",
    data(){
        return{

        }
    },
    props: {
        dashboard: Boolean,
        tasks: Boolean,
        notes: Boolean,
        reminders: Boolean
    }
}
</script>