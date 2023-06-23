<template>
  <div>
    <span>Work!</span>
    <button @click="getUsers">Get</button>
    <UserList :users="users"/>
  </div>
</template>

<script>
import axios from 'axios';
import UserList from './components/UserList.vue';
  export default {
    components: {
      UserList
    },
    data() {
      return {
        users: []
      }
    },
    methods: {
      async getUsers() {
        try {
          const response = await axios.get('http://localhost:8000/');
          this.users = response.data;
        } catch(e) {
          alert('Error!');
        }
      }
    }
  }
</script>

<style>

</style>