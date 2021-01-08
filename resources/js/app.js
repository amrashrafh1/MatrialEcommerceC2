/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
var pageURL = $(location).attr("href");
if(pageURL.includes("/admin") || pageURL.includes("/seller")) {
    window.Vue    = require('vue');
}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
/* Vue.component('create-product', require('./components/Admin/products/CreateProduct.vue').default);
Vue.component('edit-product', require('./components/Admin/products/EditProduct.vue').default);
Vue.component('variations-product', require('./components/Admin/products/Variations.vue').default);
Vue.component('edit-variations', require('./components/Admin/products/EditVariations.vue').default);
Vue.component('select-variation', require('./components/Admin/products/SelectVariations.vue').default); */
if(pageURL.includes("/admin") || pageURL.includes("/seller")) {
Vue.component('shipping-type', require('./components/Admin/Shipping.vue').default);
Vue.component('shipping-edit', require('./components/Admin/Shipping-edit.vue').default);
Vue.component('weather', require('./components/Admin/Weather.vue').default);
}
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
if(pageURL.includes("/admin") || pageURL.includes("/seller")) {

const app     = new Vue({
    el        : '#app',
});
}
