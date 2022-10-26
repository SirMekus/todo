import { registerEventListeners, lazyLoadImages, on, showSpinner, removeSpinner, showCanvass } from "mmuo"
import * as bootstrap from '~bootstrap';
import axios from 'axios';
import lodash from 'lodash';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

window.addEventListener("DOMContentLoaded", function() {
    registerEventListeners()
    lazyLoadImages()

    document.addEventListener('admin_logout', (event) => {
        location.href=event.detail.data.url
    });

    document.addEventListener('activity_trigger', (response) => {
        location.reload()
    });

    on('.logout-form', 'click', function(event){
        event.preventDefault();
        
        if(document.querySelector(".close-alert")){
            document.querySelector(".close-alert").click(); 
        }

        showSpinner()

        var clickedLink = event.currentTarget;
    
        var href = clickedLink.getAttribute("href");

        axios
        .request({
            url: href,
            method: 'POST',
            headers: {
              'X-Requested-With': 'XMLHttpRequest'
            },
          })
        .then((response) => {
            location.href=response.data.url
        }).catch((error) => {
            showCanvass("<div class='text-danger'>"+error.response.data.message +"</div>")
        }).then(() => {
            removeSpinner()
        });
    })
    
}, false);


try {
window.bootstrap =  bootstrap;
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = axios

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';