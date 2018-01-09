
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
Vue.component('file-upload',require('./components/FileUpload.vue'));

const app = new Vue({
    el: '#thewppluginner',
    data: {csrfToken: ''},
    created(){
      this.csrfToken = window.csrfToken;
      this.refreshToken();
    },
    methods: {
      refreshToken(){
        var _this = this;
        setTimeout(function() {
          axios.post(window.thewppluginner.ajax_url+'/check-alive').then(response => {
            _this.csrfToken = window.csrfToken = response.data.csrfToken;
            _this.refreshToken();
          });
        },(5 * 60 * 1000));
      }
    }
});
