<template>
    <div class="task" v-for="task in tasks">
        <div>
            <p><strong>Title: {{ task.title }}</strong></p>
            <p><strong>Descriptions: {{ task.descriptions }}</strong></p>
            <p><strong>Importance: {{ task.importance }}</strong></p>
            <p><strong>Implementation: {{ task.implementation }}</strong></p>
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
        }
    }
</script>

<style scoped>

</style>