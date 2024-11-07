
import * as bootstrap from 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';  


import $ from 'jquery';


$(document).ready(function() {
    console.log('jQuery is working');
});

import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
