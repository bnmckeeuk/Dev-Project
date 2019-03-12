/*eslint-disable */

import Vue from 'vue';
import Vuex from 'vuex';


const axios = require('axios');

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        services: [],
        items: [],
        graph: [],
    },
    
    getters: {
        allServices: state => state.services,
        individualService: state => state.items,
        getGraph: state => state.graph,
    },
    mutations: {
        ADD_SERVICE(state, item){state.services.push(item)},
        ADD_ITEM(state, item){state.items = item},
        CLEAR_SERVICES(state){state.services = []},
        CLEAR_ITEMS(state){state.items = []},
        CLEAR_GRAPH(state){state.graph = []},
        SET_GRAPH(state, graphData){state.graph = graphData}
    },
    actions: {
        getServices(context)
        {
            context.commit('CLEAR_SERVICES');
            axios.get('/vue-dev/process.php', {
                params: {
                    endpoint: '/api/services'
                }
            }).then( function(response)
            {
                
                if(!response.data.message)
                {
                    let service = response.data.services; 
                    service.forEach(function(item)
                    {
                        context.commit('ADD_SERVICE', item); 
                        
                    })
                }
            })
            .catch( function(error)
            {
                //console.log(error); 
            })
        },
        getItem(context, itemId)
        {
            let param = itemId;

                axios.get('/vue-dev/process.php', {
                    params: {
                        endpoint: '/api/services/'+param+'/service' 
                    }
                }).then( function(response)
                {
                    if(response.data)
                    {
                        let serviceItem = response.data; 
                        context.commit('ADD_ITEM', serviceItem); 
                       
                       
                    }
                })
                .catch( function(error)
                {
                    alert(error); 
                })
        },
        serviceGraph(context, itemId)
        {   
            context.commit('CLEAR_GRAPH'); 
            let param = itemId; 

            axios.get('/vue-dev/process.php', {
                    params: {
                        endpoint: '/api/services/'+param+'/graph/bandwidth' 
                    }
                }).then( function(response)
                {
                    if(response.data)
                    {
                        let serviceGraph = response.data; 
                        context.commit('SET_GRAPH', serviceGraph); 
                    }
                })
                .catch( function(error)
                {
                    alert(error); 
                })
        }
        
        
    }
});