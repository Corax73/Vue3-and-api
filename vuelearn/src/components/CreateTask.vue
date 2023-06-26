<template>
    <div class="create-task">
        <div>
            <label for="title">Title</label>
            <p><input type="text" v-model='title'></p>
            <label for="descriptions">Descriptions</label>
            <p><input type="textarea" v-model='descriptions'></p>
            <label for="importance">Importance</label>
            <p><input type="number" v-model='importance' min="1" max="5"></p>
            <label for="implementation">Implementation</label>
            <p><input type="number" v-model='implementation' min="0" max="1"></p>
            <button type="submit" @click='newData'>Create</button>
        </div>
        <div>{{ creationAnswer }}</div>
    </div>
</template>

<script>
    export default {
        props: {
            creationAnswer: {
                type: String
            }
        },
        data () {
            return {
                title: '',
                descriptions: '',
                importance: 1,
                implementation: 0
            }
        },
        methods: {
            newData () {
                this.$emit('newData', {
                    title: this.title,
                    descriptions: this.descriptions,
                    importance: this.importance,
                    implementation: this.implementation
                })
            }
        }
    }
    
</script>

<style scoped>

</style>