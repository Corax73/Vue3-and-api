<template>
    <button @click="getForm">Form to create</button>
    <div class="create-task" ref="form">
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
        emits: ['newData', 'getForm'],
        props: {
            creationAnswer: {
                type: String
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
            newData() {
                this.$emit('newData', {
                    title: this.title,
                    descriptions: this.descriptions,
                    importance: this.importance,
                    implementation: this.implementation
                });
            },
            getForm() {
                if (!this.click) {
                    this.$emit('getForm', {
                        visibility: 'display: block;',
                        ref: this.$refs.form
                    });
                    this.click = true;
                } else if (this.click) {
                    this.$emit('getForm', {
                        visibility: 'display: none;',
                        ref: this.$refs.form
                    });
                    this.click = false;
                }
            }
        }
    }
    
</script>

<style scoped>
.create-task {
    padding: 15px;
    border: 4px solid blueviolet;
    margin-top: 15px;
    border-radius: 8px;
    display: none;
}
</style>