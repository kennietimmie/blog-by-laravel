require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// $(document).ready(function() {
//   $('select[multiple]').select2({
//     placeholder: 'Select an option'
//   });
// });

Echo.channel('activities')
.listen('.activity-monitor', (e) => console.log(e))