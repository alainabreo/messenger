
require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue)

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('profile-form-component', require('./components/ProfileFormComponent.vue').default);
Vue.component('status-component', require('./components/StatusComponent.vue').default);
Vue.component('messenger-component', require('./components/MessengerComponent.vue').default);
Vue.component('message-conversation-component', require('./components/MessageConversationComponent.vue').default);
Vue.component('contact-component', require('./components/ContactComponent.vue').default);
Vue.component('contact-list-component', require('./components/ContactListComponent.vue').default);
Vue.component('active-conversation-component', require('./components/ActiveConversationComponent.vue').default);

const app = new Vue({
    el: '#app',
    methods: {
    	logout() {
    		document.getElementById('logout-form').submit();
    	}
    }
});
