<template>
    <NavBar :dashboard=true />
</template>

<script>
import NavBar from '../components/navbar.vue'

export default{
    name: "Dashboard",
    components: {
        NavBar
    }
}
</script>