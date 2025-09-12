/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import Vue from 'vue'
import axios from 'axios'
import toastr from 'toastr'

toastr.options = {
  "positionClass": "toast-bottom-right",
  "showMethod": 'slideDown',
  "hideMethod": 'slideUp',
  "closeMetho":  'slideUp',
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "30000",
  "timeOut": "10000",
  "extendedTimeOut": "30000",
  "showEasing": "swing",
  "hideEasing": "linear",
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('Errors',require('./components/Errors.vue').default);
const app = new Vue({
    el: '#app',
    mounted(){
      if(action == 'createVentas'){
        this.getStock();
      }
      if(action == 'editVentas'){
        this.totalVentaEdit = totalVenta;
      }
    },

    data:{
    	stock:[],
      coloresVenta: [],
      tallasVenta: [],
      modelo: '',
      color: '',
      talla: '',
      buscar:'',
      cantidad: 1,
      precio: '',
      descuento: 0,
      itemsVenta: [],
      stockAux: null,
      itemStock: null,
      codigoProducto: null,
      productoVenta: null,
      codigoCliente: null,
      bcliente: null,
      errors: [],
      estadoVenta: 1,
      valorAbonoVenta: 0,
      totalVentaEdit:0,
    },

    methods:{
      formatNumber(number){
        return new Intl.NumberFormat("es-CO").format(number);
      },

      buscarProducto(){
        this.stock = this.stock.filter(
          item =>{ 
            return item.stock.id;
        })
      },

	    getStock(){
	        axios.get('/get_stock').then(response => {
	         this.stock = response.data.stock;
        }).catch(error => {
            toastr.error('Ocurrio un error al obtener el stock!');
        });
    },
    searchProducto(){
      if(this.codigoProducto != '' && this.codigoProducto != null){ 
        this.errors = [];
      axios.post('/searchProducto',{
          codigoProducto: this.codigoProducto
      }).then((response) =>{
         this.productoVenta = response.data.producto;
      }).catch((error) =>{
        console.log(error);
        this.productoVenta = null;
        this.errors = error.response.data.errors;
        toastr.error('Ocurrio un error al buscar el producto');
      });
    }else{
      alert('Debe ingresar un codigo de producto');
      toastr.error('Debe ingresar un codigo de producto');
    }
    },

    searchCliente(){
      if(this.codigoCliente != '' && this.codigoCliente != null){ 
        this.errors = [];
      axios.post('/searchCliente',{
          codigoCliente: this.codigoCliente
      }).then((response) =>{
         this.bcliente = response.data.cliente;
      }).catch((error) =>{
        console.log(error);
        this.bcliente = null;
      alert('No existe el documento de cliente');
      });
    }else{
      alert('Debe ingresar un documento de cliente');
      toastr.error('Debe ingresar un codigo de producto');
    }
    },
    /*
    changeModelo(){
      this.coloresVenta=[];
      for (var i = this.stock.length - 1; i >= 0; i--) {
        if(this.stock[i].modelo_venta.id == this.modelo){
        if(!this.coloresVenta.some(e => e.id === this.stock[i].color_venta.id)){
          var item = this.stock[i].color_venta;
          item.ref = this.stock[i].color_venta.id;
          this.coloresVenta.push(item);
        }
         }
      
        }
    },

    changeColor(){
      this.tallasVenta=[];
      for (var i = this.stock.length - 1; i >= 0; i--) {
        if(this.stock[i].color_venta.id == this.color &&
        this.stock[i].modelo_venta.id == this.modelo){
        if(!this.tallasVenta.some(e => e.id === this.stock[i].color_venta.id)){
          var item = this.stock[i].talla_venta;
          item.referencia = this.stock[i].id;
          this.tallasVenta.push(item);
        }
         }
      
        }
    },
    changeTalla(){
      var stockAuxArr = this.stock.filter((item) => item.id_modelo == this.modelo 
        && item.id_color == this.color && item.id_talla == this.talla);
      this.stockAux = stockAuxArr[0];

    },
    */
    addProducto(){
      if(this.productoVenta != null && this.productoVenta != ''){ 
      if (!this.itemsVenta.some(e => e.id === this.productoVenta.id)) {
        this.productoVenta.cantidadVenta = this.cantidad;
        this.productoVenta.descuento = (this.descuento == null || this.descuento == '') ? 0 : this.descuento;
        this.itemsVenta.push(this.productoVenta);
        this.productoVenta = null;
        this.cantidad = 1;
        this.precio = '';
        this.descuento = '';
      }else{
        toastr.error('Ya tienes añadido este item a la venta!');
        this.productoVenta = null;
        this.cantidad = 1;
        this.estado = '';
        this.descuento = '';
      }
    }
    },
    validarAbonoVenta(){
        if(this.valorAbonoVenta >= this.totalVenta){
          alert('El abono no puede ser mayor o igual al total de la venta');
          this.valorAbonoVenta = 0;
        }
    },
        validarAbonoVentaEdit(){
        if(this.valorAbonoVenta > this.totalVentaEdit){
          alert('El abono no puede ser mayor al saldo de la venta');
          this.valorAbonoVenta = 0;
        }
    },
},
computed:{
  productosVenta(){
    var productos = [];
    for (var i = this.stock.length - 1; i >= 0; i--) {
      if(!productos.some(e => e.id === this.stock[i].modelo_venta.id)){
        productos.push(this.stock[i].modelo_venta);
      }
    }
    return productos;
  },
  totalVenta(){
    var total = 0;
    for (var i = this.itemsVenta.length - 1; i >= 0; i--) {
      total += ((this.itemsVenta[i].p_venta * this.itemsVenta[i].cantidadVenta) - this.itemsVenta[i].descuento);
    }
    return total;
  },
  productoVentaDescripcion(){
    return `Modelo: ${this.productoVenta.modelo.nombre}<br> Color: ${this.productoVenta.color.nombre}<br> Talla: ${this.productoVenta.talla.nombre}`;
  },
  clienteDescripcion(){
    return `Cédula: ${this.bcliente.id}<br> Nombre: ${this.bcliente.nombres}<br> Apellido: ${this.bcliente.apellidos}`;
  }
},

});



