<template>
    <router-view></router-view>
</template>

<script>
export default{
    name: "App"
}
</script>

<style>
#app {
  font-family: 'Montserrat', sans-serif;
}

@media (-webkit-device-pixel-ratio: 1.25) {
    :root {
      zoom: 0.8;
    }
}

/* Chrome, Safari, Edge, Opera */
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
/* Firefox */
input[type="number"] {
    -moz-appearance: textfield;
}
</style>