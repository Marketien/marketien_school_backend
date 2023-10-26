import './bootstrap';
import { createApp } from 'vue';

import Payment from './components/payment.vue';

// window.axios = require('axios');
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


createApp(Payment).mount('#app');

// const app = createApp({});
// app.component('payment-form', Payment);
// app.use(Toaster).mount('#app');
