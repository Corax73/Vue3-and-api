<template>
        <div>
            <span>Work1!</span>
            <div v-if="task" class="content">
            <label for="title">Title</label>
            <p><input type="text" v-model.trim="title" :placeholder="task.title"></p>
            <label for="descriptions">Descriptions</label>
            <p><input type="textarea" v-model.trim="descriptions" :placeholder="task.descriptions"></p>
            <label for="importance">Importance</label>
            <p><input type="number" v-model.trim="importance" min="1" max="5" :placeholder="task.importance"></p>
            <label for="implementation">Implementation</label>
            <p><input type="number" v-model.trim="implementation" min="0" max="1" :placeholder="task.implementation"></p>
            <button type="submit" @click='updateTask'>Edit</button>
            </div>
        <div>{{ creationAnswer }}</div>
        <p><strong><router-link :to="{name: 'home'}">Home</router-link></strong></p>
    </div>
</template>

<script>
import axios from 'axios';
axios.defaults.headers.common['Accept'] = 'application/json';
    export default {
        data() {
            return {
                id: '',
                creationAnswer: '',
                title: '',
                descriptions: '',
                importance: '',
                implementation: '',
                task: {
                    title: '',
                    descriptions: '',
                    importance: '',
                    implementation: ''
                }
            }
        },
        async beforeCreate() {
            let id = {
                id: this.$route.params.id
            }
            let resp;
            try {
                await axios.post('http://localhost:8000/get-one-task', id)
                .then(response => (resp = response));
                this.task = resp.data[0];
            } catch(e) {
                alert('Error!');
            }
        },
        methods: {
            async updateTask() {
                let newData = {
                    id: this.task.id,
                    title: this.title ? this.title : this.task.title,
                    descriptions: this.descriptions ? this.descriptions : this.task.descriptions,
                    importance: this.importance ? this.importance : this.task.importance,
                    implementation: this.implementation ? 1 : 0
                };
                try {
                    const response = await axios.post('http://localhost:8000/update', newData)
                    .then(response => {
                        this.creationAnswer = response.data;
                    })
                } catch(e) {
                    alert('Error!');
                }
            },
        }
    }
</script>

<style lang="scss" scoped>

</style>