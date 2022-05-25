/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */



window.Vue = require('vue');
window.myAlert = require('./alerts');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('paramters-value', require('./components/ParametersValue.vue').default);
Vue.component('password-btn', require('./components/generatePassword.vue').default);
Vue.component('alerting', require('./components/Alerting.vue').default);
Vue.component('modal', require('./components/modal.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.deleteResource = async (endPoint, id, reload = true) => {
    let result = await myAlert.Confirmation()
    if (result.isConfirmed) {
        let req = await fetch(endPoint + '/' + id, {
            method: 'delete',
            headers: {
                'X-CSRF-TOKEN': document.querySelector("meta[name=token]").content,
                'accept': 'application/json',
            }
        });

        if (req.ok) {
            myAlert.correct('Eliminado!')
            if (reload) {
                window.location.reload();
            }
            return true
        } else {

            alert('Error al eliminar')
            return false
        }
    }

}

const app = new Vue({
    el: '#app',
});
