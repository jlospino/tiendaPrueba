<template>
    <div class="row no-gutters bg-white position-relative mb-4 card-1 py-3 px-4">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-9">
                    <datepicker name="fecha" :language="es" v-model="date" placeholder="Elige Una Fecha">
                    </datepicker>
                </div>
                <div class="col-lg-3">
                    <button class="btn btn-primary px-5 mt-2" @click="getOrders()">Buscar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import { es } from 'vuejs-datepicker/dist/locale'
    export default {
        name: 'Search',
        data () {
            return {
                es: es,
                date: ''
            }
        },
        methods:{
            getOrders(){
                if(this.date){
                    let newdate = new Date(this.date)
                    newdate.setDate(newdate.getDate())
                    axios.get('/getOrders', {
                        params:{
                            date: newdate
                        }
                    }).then(res=>{
                        this.$parent.orders = res.data;
                    })
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        components: {
            Datepicker
        }
    }
</script>
