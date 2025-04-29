import Popper from '@popperjs/core/dist/umd/popper.js';
import jQuery from 'jquery';
import axios from 'axios';
import 'bootstrap';
import Swal from 'sweetalert2';

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.Popper = Popper;
window.$ = window.jQuery = jQuery;
window.Swal = Swal;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
