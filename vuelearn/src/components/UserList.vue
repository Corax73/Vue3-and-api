<template>
    <div class="users" v-for="user in users">
        <div>
            <strong>Name: {{ user.name }}</strong>
            <strong>Email: {{ user.email }}</strong>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            users: {
                type: Array,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>