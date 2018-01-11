
/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/

require('./bootstrap');

window.Vue = require('vue');

/**
* Next, we will create a fresh Vue application instance and attach it to
* the page. Then, you may begin adding components to this application
* or customize the JavaScript scaffolding to fit your unique needs.
*/
Vue.component('model-example',require('./components/ModelExample.vue'));

const app = new Vue({
    el: '#wp_pluginner',
    data: {
        nonce: '',
        ajax_url: window.wp_pluginner.ajax_url
    },
    created(){
        this.nonce = window.wp_pluginner.nonce;
        this.refreshNonce();
    },
    methods: {
        refreshNonce()
        {
            var _this = this;
            setTimeout(function() {
                var form_data = _this.buildFormData({'function':'refreshNonce'});
                axios.post(_this.ajax_url, form_data).then(response => {
                    if (response.data.success) {
                        _this.nonce = window.wp_pluginner.nonce = response.data.data.nonce;
                    }
                    _this.refreshNonce();
                });
            },(5 * 60 * 1000));
        },
        buildFormData(data)
        {
            let form_data = new FormData;
            form_data.set('action', 'wp_pluginner');
            form_data.set('nonce', this.nonce);
            _.forEach(data, function(value, key) {
                form_data.set(key, value);
            });
            return form_data;
        }
    }
});
