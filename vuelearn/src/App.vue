<template>
  <div>
    <span>Work!</span>
    <button @click="getUsers">Get</button>
  </div>
</template>

<script>
import axios from 'axios';
  export default {
    data() {
      return {

      }
    },
    methods: {
      async getUsers() {
        try {
          const response = await axios.get('http://localhost:8000/');
          console.log(response);
        } catch(e) {
          alert('Error!');
        }
      }
    }
  }
</script>

<style>

</style>