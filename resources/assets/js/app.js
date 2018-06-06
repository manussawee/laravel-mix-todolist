import App from './App.vue';
import { routes } from './routes.js';

const router = new VueRouter({ routes });

new Vue({
  router,
  render: h => h(App)
}).$mount('#app');