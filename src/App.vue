<template>
  <div id="app" class="app-container">
    
   <router-view></router-view>
  </div>
</template>

<script>
//import Services from './components/Services.vue'

export default {
  name: 'app',
  
}
</script>

<style>
#app {
  font-family: 'Source Sans Pro', sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #555;
  margin-top: 2em;
}

* {
    box-sizing: border-box; 
}

body {
    background: #f5f5f5;
}

.app-container {
    max-width: 1200px;
    margin: auto; 
    padding: 1em;
    background:#fff;
}
</style>
