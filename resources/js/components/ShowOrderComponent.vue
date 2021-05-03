<template>
<div>
    <h3 class="mb-3"><b>Orden No. {{ id }} </b></h3>
        <div class="row">
            <div class="col-lg-3">
                <div class="no-gutters bg-white position-relative mb-4 card-1 py-3 px-4">
                    <div class="mb-2 mt-2">
                        <b>Fecha Entrega</b><br>
                        <label>{{ formatDate(order.created_at) }}</label>
                    </div>
                    <div class="mb-2">
                        <b>Cliente</b><br>
                        <label>{{ this.user}}</label>
                    </div>
                    <div class="mb-2">
                        <b>Estado</b><br>
                        <label>{{ order.status }}</label>
                    </div>
                </div>
                <a href="/" class="btn btn-success col-lg-8">Volver</a>
            </div>
            <div class="col-lg-9">
                <div class="row no-gutters bg-white position-relative mb-4 card-1 py-3 px-4">
                    <div class="col-lg-12">
                        <h3 class="font-weight-bold mb-4">PRODUCTOS PARA ALISTAMIENTO</h3>
                        <table class="table table-hover table-bordered table-success">
                            <thead>
                                <th>Cod</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                            </thead>
                            <tbody>
                                <tr v-for="product in order.products" :key="product.id">
                                    <template v-if="product.pivot.quantity <= product.quantity">
                                        <td>{{ product.id }}</td>
                                        <td>{{ product.name }}</td>
                                        <td>{{ product.pivot.quantity }} DE {{ product.quantity }} DISPONIBLES </td>
                                        <td><b>COP</b> {{ formatPrice(product.price) }}</td>
                                        <td><b>COP</b> {{ formatPrice(product.price * product.pivot.quantity) }}</td>
                                    </template>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row no-gutters bg-white position-relative mb-4 card-1 py-3 px-4">
                    <div class="col-lg-12">
                        <h3 class="font-weight-bold mb-4">PRODUCTOS POR ABASTECER</h3>
                        <table class="table table-hover table-bordered table-warning">
                            <thead>
                                <th>Cod</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                                <th>Proveedor</th>
                            </thead>
                            <tbody>
                                <tr v-for="product in order.products" :key="product.id">
                                    <template v-if="product.pivot.quantity > product.quantity">
                                        <td>{{ product.id }}</td>
                                        <td>{{ product.name }}</td>
                                        <td>{{ product.pivot.quantity }} DE {{ product.quantity }} DISPONIBLES</td>
                                        <td><b>COP</b> {{ formatPrice(product.price) }}</td>
                                        <td><b>COP</b> {{ formatPrice(product.price * product.pivot.quantity) }}</td>
                                        <td :title="product.vendor.contact_name +' - '+ product.vendor.contact_phone">
                                            {{ product.vendor.name }}
                                        </td>
                                    </template>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import formatPrice from '../mixins/formatPriceMixin';
    import formatDate from '../mixins/formatDateMixin';

    export default {
        mixins: [formatPrice, formatDate],
        data() {
            return {
                order: [],
                user: '',
            }
        },
        created(){
            axios.get('/getOrderById/'+this.id+'').then(res=>{
                this.user = res.data.user.name.toUpperCase();
                this.order = res.data;
            })
        },
        name: 'show-order',
        props: {
            id: Number
        }
    }
</script>
