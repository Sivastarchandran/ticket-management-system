// import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

// Echo.channel('chat')
//     .listen('MessageSent', (e) => {
//         console.log('Message received: ', e.message);
//         // Handle the received message (e.g., update the UI)
//     });


import './bootstrap';
import Alpine from 'alpinejs';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Alpine = Alpine;
Alpine.start();

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,
});


// Echo.private('chat')
//     .listen('MessageSent', (e) => {
//         console.log('Message received: ', e.message);
//     });

// Echo.channel('tickets')
//     .listen('TicketCreated', (event) => {
//         console.log('Ticket Created:', event.ticket);
//     });

Echo.channel('tickets')
    .listen('TicketCreated', (event) => {
        console.log('Ticket Created:', event.ticket);
    });

    window.Echo.channel('chat')
    .listen('MessageSent', (e) => {
        console.log('Message received:', e.message);
    });

