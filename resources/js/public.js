import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import persist from '@alpinejs/persist';
import form from '@/public/form';
import budget from '@/public/budget';

import '~/images/favicon.png';

Alpine.plugin(collapse);
Alpine.plugin(persist);

Alpine.data('form', form);
Alpine.directive('budget', budget);

window.Alpine = Alpine;
window.Alpine.start();
