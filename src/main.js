import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue';
import store from './store';
import Services from './components/Services.vue';
import Item from './Item.vue'; 

Vue.config.productionTip = false

Vue.use(VueRouter);


// Define routes
const routes = [
    { name: 'home', path: '/', component: Services },
    { name: 'item', path: '/item/:id', component: Item }
]
  
  // Register routes
  const router = new VueRouter({
    routes,
  })


new Vue({
    el: '#app',
    store,
    Services,
    render: h => h(App),
    router
});
