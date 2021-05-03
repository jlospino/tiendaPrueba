
<template>
    <div id="app">
        <search-component/>
        <h4 class="mt-4 mb-3"><b>LISTADO DE PEDIDOS</b></h4>
        <div v-if="orders.length">
            <div class="row no-gutters bg-white position-relative mb-2 card-1" v-for="(item, index) in orders" :key="index">
                <div class="col-md-12 position-static p-4 pl-md-0 pl-lg-4">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3 class="mt-0"><a :href="'showOrder/'+item.id"><b>COD({{ item.id }})</b> - {{item.userName.toUpperCase()}}</a></h3>
                            <ul>
                                <li v-for="product in item.products" :key="product.id"><h6 class="mb-0 fw-300" >{{product.name.toUpperCase()}}</h6></li>
                            </ul>
                        </div>
                        <div class="col-lg-4">
                            <h6 class="mb-0 mt-3 fw-300">{{ formatDate(item.date) }}</h6>
                            <h3><small>COP</small> {{formatPrice(item.total)}}</h3>
                            <p><span class="badge badge-warning font-weight-normal">{{ item.status }}</span></p>
                            <div class="mb-3">
                                <a :href="'showOrder/'+item.id" class="btn btn-primary px-5">Revisar Inventario</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <h4>No hay resultados para mostrar</h4>
        </div>
    </div>
</template>

<script>
    import SearchComponent from './SearchComponent.vue'
    import formatPrice from '../mixins/formatPriceMixin';
    import formatDate from '../mixins/formatDateMixin';
    export default {
        mixins: [formatPrice, formatDate],
        components: { SearchComponent },
        data() {
            return {
                orders: [],
            }
        },
        created(){
            axios.get('/getOrders').then(res=>{
                this.orders = res.data;
            })
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
