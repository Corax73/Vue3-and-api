<template>
  <div>
    <span>Work!</span>
    <button @click="getTasks">Get</button>
    <TasksList :tasks="tasks"/>
    <CreateTask @newData="createTask" :creationAnswer="creationAnswer" />
  </div>
</template>

<script>
import axios from 'axios';
import TasksList from './components/TasksList.vue';
import CreateTask from './components/CreateTask.vue';
axios.defaults.headers.common['Accept'] = 'application/json';
  export default {
    components: {
      TasksList, CreateTask
    },
    data() {
      return {
        creationAnswer: '',
        tasks: [],
        newTask: {
          title: '',
          descriptions: '',
          importance: '',
          implementation: ''
        }
      }
    },
    methods: {
      async getTasks() {
        try {
          const response = await axios.get('http://localhost:8000/all');
          this.tasks = response.data;
        } catch(e) {
          alert('Error!');
        }
      },
      async createTask(data) {
        try {
          const response = await axios.post('http://localhost:8000/create', data)
          .then(response => {
            this.creationAnswer = response.data;
          })
        } catch(e) {
          alert('Error!');
        }
      }
    }
  }
</script>

<style>

</style>