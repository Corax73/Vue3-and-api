<template>
  <div>
    <span>Work!</span>
    <button @click="getTasks">Get</button>
    <TasksList @deleteTask='deletingTask' :tasks="tasks"/>
    <CreateTask @newData='createTask' @getForm='showFormToCreate' :creationAnswer="creationAnswer" />
  </div>
</template>

<script>
import axios from 'axios';
import TasksList from './components/TasksList.vue';
import CreateTask from './components/CreateTask.vue';
axios.defaults.headers.common['Accept'] = 'application/json';
  export default {
    emits: ['newData', 'deleteTask', 'getForm'],
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
          this.creationAnswer = '';
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
          this.getTasks();
        } catch(e) {
          alert('Error!');
        }
      },
      async deletingTask(data) {
        try {
          const response = await axios.post('http://localhost:8000/delete', data)
          .then(response => {
            this.creationAnswer = response.data;
          })
          this.getTasks();
        } catch(e) {
          alert('Error!');
        }
      },
      showFormToCreate(data) {
        data.ref.style = data.visibility;
      }
    }
  }
</script>

<style>

</style>