<template>
    <div class="edit-task">
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
    </div>
</template>

<script>
    export default {
        emits: ['updateData'],
        props: {
            creationAnswer: {
                type: String
            },
            task: {
                type: Array,
                required: true
            }
        },
        data() {
            return {
                title: '',
                descriptions: '',
                importance: 1,
                implementation: 0,
                click: false
            }
        },
        methods: {
            updateData() {
                this.$emit('updateData', {
                    title: this.title,
                    descriptions: this.descriptions,
                    importance: this.importance,
                    implementation: this.implementation
                });
            }
        }
    }
</script>

<style scoped>
.edit-task {
    padding: 15px;
    border: 4px solid blueviolet;
    margin-top: 15px;
    border-radius: 8px;
    display: none;
}
</style>