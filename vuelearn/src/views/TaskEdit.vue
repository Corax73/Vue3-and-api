<template>
        <div>
        <span>Work1!</span>
        <label for="title">Title</label>
            <p><input type="text" v-model='title' placeholder="{{ task.title }}"></p>
            <label for="descriptions">Descriptions</label>
            <p><input type="textarea" v-model='descriptions' placeholder="{{ task.descriptions }}"></p>
            <label for="importance">Importance</label>
            <p><input type="number" v-model='importance' min="1" max="5" placeholder="{{ task.importance }}"></p>
            <label for="implementation">Implementation</label>
            <p><input type="number" v-model='implementation' min="0" max="1" placeholder="{{ task.implementation }}"></p>
            <button type="submit" @click='updateData'>Edit</button>
        <div>{{ creationAnswer }}</div>
        <p><strong><router-link :to="{name: 'home'}">Home</router-link></strong></p>
    </div>
</template>

<script>
    export default {
        props: {
            task: {
                //type: Array,
                required: true
            }
        }        
    }
</script>

<style lang="scss" scoped>

</style>