<template>
    <div>
        <div class="row no-gutters bg-white position-relative mb-2 card-1" v-for="(item, index) in products" :key="index">
            <div class="col-md-3 mb-md-0 p-md-3">
                <img :src="'data:image/jpeg;base64,'+`${item.photo}`" class="w-100" alt="Imagen">
            </div>
            <div class="col-md-9 position-static p-4 pl-md-0 pl-lg-4">
                <div class="row">
                    <div class="col-lg-8">
                        <h3 class="mt-0"><a :href="'product/'+item.slug">{{item.name.toUpperCase()}}</a></h3>
                        <p class="font-light">{{item.description}}</p>
                    </div>
                    <div class="col-lg-4">
                        <h6 class="mb-0 mt-3 fw-300">Precio de venta sugerido</h6>
                        <h3><small>COP</small> {{formatPrice(item.price)}}</h3>
                        <h6 class="fw-300" style="color:#666"><b class="fb-400">{{item.quantity}} Unidades Disponibles</b></h6>
                        <p><span class="badge badge-success font-weight-normal">{{item.category}}</span></p>
                        <!--<span v-if="item.userId">
                            <div class="mb-3">
                                <a :href="'edit/'+item.slug" class="btn btn-success">Editar</a>
                            </div>
                            <div class="mb-3">
                                <button @click="deleteProduct(item, index)" class="btn btn-danger">Eliminar</button>
                            </div>
                        </span>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                products: [],
            }
        },
        created(){
            axios.get('/getProducts').then(res=>{
            this.products = res.data;
            })
        },
        methods: {
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
            deleteProduct(product, index){
                const confirmacion = confirm(`Eliminar producto ${product.name}`);
                if(confirmacion){
                    axios.delete(`/delete/${product.id}`)
                    .then(()=>{
                        this.products.splice(index, 1);
                    })
                }
            },
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
