<template>
    <NavBar :notes=true />
</template>

<script>
import NavBar from '../components/navbar.vue'

export default{
    name: "Notes",
    components: {
        NavBar
    }
}
</script>