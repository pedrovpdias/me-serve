import axios from 'axios';

axios.defaults.withCredentials = true; // Enable sending cookies with cross-origin requests 
axios.defaults.withXSRFToken = true; // Enable sending CSRF token with cross-origin requests

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

