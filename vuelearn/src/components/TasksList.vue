<template>
    <div class="task" v-for="task in tasks">
        <div>
            <p><strong><router-link :to="{name: 'task-edit', params: {id: task.id} }" :task="task">Title: {{ task.title }}</router-link></strong></p>
            <p><strong>Descriptions: {{ task.descriptions }}</strong></p>
            <p><strong>Importance: {{ task.importance }}</strong></p>
            <p><strong>Implementation: {{ task.implementation }}</strong></p>
            <button @click='deleteTask(task.id)'>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            tasks: {
                type: Array,
                required: true
            }
        },
        emits: ['deleteTask'],
        data() {
            return {
                id: '',
                task: Object
            }
        },
        methods: {
            deleteTask(taskId) {
                this.id = taskId;
                this.$emit('deleteTask', {
                    id: this.id
                });
            }
        }
    }
</script>

<style scoped>
.task {
    padding: 15px;
    border: 4px solid red;
    margin-top: 15px;
    border-radius: 8px;
}
</style>