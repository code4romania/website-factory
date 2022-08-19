import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import persist from '@alpinejs/persist';
import form from '@/public/form';

Alpine.plugin(collapse);
Alpine.plugin(persist);

Alpine.data('form', form);

window.Alpine = Alpine;
window.Alpine.start();
