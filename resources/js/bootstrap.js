import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import.meta.glob([
    "../favicons/**.svg",
    "../favicons/**.png",
    "../favicons/**.ico",
    "../favicons/**.webmanifest",
]);
