<template>
    <form @submit.prevent="login">
        <input type="text" v-model='form.email'>
        <input type="text" v-model='form.password'>
        <input type="submit" value="Submit">
    </form>
</template>

<script>
import axios from 'axios';

export default{
    name: "Login",
    data() {
        return {
            form: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        async login() {
            await axios.post('/api/login', this.form)
            .then(response => {
                if(response.data.success){
                    localStorage.setItem('token', response.data.data.token)
                    this.$router.push({name: 'Dashboard'})
                }
            })
            .catch(error => {
                console.log(error)
            })
        }
    }
}
</script>