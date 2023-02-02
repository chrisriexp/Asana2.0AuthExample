<template>
    <NavBar :reminders=true />
</template>

<script>
import NavBar from '../components/navbar.vue'

export default{
    name: "Reminders",
    components: {
        NavBar
    }
}
</script>