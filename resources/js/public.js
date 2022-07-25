import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import form from '@/public/form';

Alpine.plugin(collapse);

Alpine.data('form', form);

window.Alpine = Alpine;
window.Alpine.start();
