<template>
    <div class="service-container">
        <button class="standard-link" @click.prevent="goBack">
            Back To Overview
        </button>

        <h1>{{service.name}}</h1>

        <div class="service-columns">
            <div>
                <ul class="service-list">
                    <li><strong class="service-title">Status: {{service.status}}</strong></li>
                    <li><strong class="service-title">Vlan:</strong> {{service.vlan}}</li>
                    <li><strong class="service-title">Bandwidth:</strong> {{service.bandwidth}}</li>
                    <li><strong class="service-title">Type: </strong> {{service.type}}</li>
                </ul>

                <p>Bandwidth Graph:</p>
                <br>
                <img class="bandwidth-graph" v-bind:src="graph">
               
            </div>
            <div>
                <ul class="service-list">

                    <li class="spacer"><strong class="service-title">Port: </strong>

                        <ul class="service-list">
                            <li><strong class="service-title">Name: </strong> {{service.port.name}}</li>
                            <li><strong class="service-title">Datacentre Name: </strong> {{service.port.datacentre_datacentre_name}}</li>
                            <li><strong class="service-title">Datacentre City: </strong> {{service.port.datacentre_city}}</li>
                            <li><strong class="service-title">Speed:</strong> {{service.port.speed}}</li>
                            <li><strong class="service-title">Committed Bandwidth: </strong>{{service.port.committed_bandwidth}}</li>
                            <li><strong class="service-title">Remaining Bandwidth: </strong>{{service.port.remaining_bandwidth}}</li>
                            <li><strong class="service-title">Utilisation:</strong> {{service.port.utilisation}}</li>
                            <li><strong class="service-title">Status: </strong> {{service.port.status}}</li>
                        </ul>
                    </li>
                </ul>
            </div>

            
            <div v-if="service.type !='Microsoft Azure'">
                <ul class="service-list">
                    <li class="spacer"><strong class="service-title">B Port: </strong>

                        <ul class="service-list">
                            <li><strong class="service-title">Name: </strong> {{service.b_port.name}}</li>
                            <li><strong class="service-title">Datacentre Name: </strong> {{service.b_port.datacentre_datacentre_name}}</li>
                            <li><strong class="service-title">Datacentre City: </strong> {{service.b_port.datacentre_city}}</li>
                            <li><strong class="service-title">Speed:</strong> {{service.b_port.speed}}</li>
                            <li><strong class="service-title">Committed Bandwidth: </strong>{{service.b_port.committed_bandwidth}}</li>
                            <li><strong class="service-title">Remaining Bandwidth: </strong>{{service.b_port.remaining_bandwidth}}</li>
                            <li><strong class="service-title">Utilisation:</strong> {{service.b_port.utilisation}}</li>
                            <li><strong class="service-title">Status: </strong> {{service.b_port.status}}</li>
                        </ul>
                   </li>
                </ul>
            </div>
            
        </div>
     
    </div>

</template>

<script>

    export default {
        name: 'Item',
        computed: {
            service() {return this.$store.getters.individualService},
            graph() { 
                let str = this.$store.getters.getGraph; 
                let src = 'data:image/svg+xml;base64,'+str.graph;
                return src;
            },
        },
        mounted: function(){
            let itemId = this.$route.params.id;
            
            this.$store.dispatch('getItem', itemId);
            this.$store.dispatch('serviceGraph', itemId);
        },
        methods: {
            goBack(){
                window.history.go(-1);
            }
        }

       
    }
</script>

<style scoped>

    .bandwidth-graph {
        max-width: 100%;
        display: block;
        margin: auto;
    }

    .service-container {
        max-width: 1200px;
        margin: auto;
    }

    .service-columns {
        display: grid; 
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); 
        padding-top: 3em;
        grid-gap: 1em;
        
    }

    .service-columns > div {
        padding: 1em;
        border: 1px solid #eee;
    }

    .service-title {
        font-weight: 600; 
    }

    .service-list {
        list-style: none;
        margin: 0;
        padding:0; 
    }

    .service-list li {
        margin: 0 0 1.5em;
    }

    .service-list li ul {
        margin-left: 1em;
    }

    .service-list .spacer .service-title {
        margin: 0 0 1.5em;
        display: block;
    }

    h1 {
        color:#2d2d2d;
        text-align: center;
    }


    .standard-link {
        border: 0;
        background: #3f9ad8;
        padding: 1em;
        font-size: 1em;
        border-radius: 3px;
        margin: 1em 0;
        cursor: pointer;
        transition: background 350ms ease;
        display: block;
        text-decoration: none;
        color:#fff;
        text-align: center;
    }

    .standard-link:hover {
        background: #2b8fd3; 
        transition: background 350ms ease;
    }

    .standard-link span {
        color:#fff;
        border-bottom: 1px solid #fff;
    }
</style>