import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import App from './Pages/App.vue'
import router from './router'

const app = createApp(App)
app.use(router)
app.mount('#app')
