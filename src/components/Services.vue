
<template>
    <div class="service-items">
        <div v-for="item in items" :key=item.id>
            <div class="main-heading">
                <h2>{{item.name}}</h2>
            </div> 
            <div class="sub-heading">
                <p><strong>Type:</strong> {{item.type}}</p> 
            </div>

            <div class="service-items__content">
                
                <h3 class="service-items__content-heading">Port Details:</h3>
          
                <ul class="port-list">
                    <li>
                        <strong>Name: </strong> {{item.port.name}}
                    </li>
                    <li>
                        <strong>Datacentre: </strong> {{item.port.datacentre_name}}
                    </li>
                    <li>
                        <strong>Speed: </strong> {{item.port.speed}}
                    </li>
                    <li>
                        <strong>Committed Bandwidth: </strong> {{item.port.committed_bandwidth}}
                    </li>
                    <li>
                        <strong>Remaining Bandwidth: </strong> {{item.port.remaining_bandwidth}}
                    </li>
                    <li>
                        <strong>Status: </strong> {{item.port.status}}
                    </li>
                </ul>

                <router-link class="standard-link" :to="{name: 'item', params: {id: item.id}}">
                    <span>Load Full Information</span>
                </router-link>
            </div>
            
           

        </div>
    </div>
</template>


<style scoped>
    .service-items {
        display: grid; 
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); 
        grid-gap: 2em;
    }

    .service-items > div {
        box-shadow: 0px 2px 4px 0px rgba(0,0,0,0.3); 
        border-radius: 3px;
        padding: 0;
    }

    .service-items__content {
        padding: 0 1.5em 1.5em;
    }

    .service-items__content-heading {
        margin: 1.5em 0;
    }

    .main-heading {
        margin: 0 auto; 
        background: #444;
        text-align: center;
        padding: 1em;
    }

    .main-heading h2 {
        margin: 0; 
        color:#fff;
    }

    .sub-heading {
        color: #444;
        background: #e7e7e7;
        padding: 1em; 
    }

    .sub-heading p {
        margin: 0;
    }

    .port-list {
        list-style: none; 
        margin: 0; 
        padding: 0; 
        border: 1px solid #f5f5f5;
    }

    .port-list li {
        padding: 0.5em 1em;
        border-bottom: 1px solid #f5f5f5;
    }

    .port-list li:nth-last-child(1)
    {
        border-bottom: 0;
    }

    .standard-link {
        border: 0;
        background: #3f9ad8;
        padding: 1em;
        font-size: 1em;
        border-radius: 3px;
        margin: 1em 0 0 auto;
        cursor: pointer;
        transition: background 350ms ease;
        display: block;
        text-decoration: none;
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

<script>

    export default {
        name: 'Services',
        computed: {
            items() {return this.$store.getters.allServices}
        },
        mounted: function(){
            this.$store.dispatch('getServices');
        },
        methods: {
            loadServiceInformation(itemId)
            {
                this.$store.dispatch('loadItem', itemId);
            }
        }
    }

</script>