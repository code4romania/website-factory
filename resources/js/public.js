import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import persist from '@alpinejs/persist';
import form from '@/public/form';
import fileupload from '@/public/fileupload';
import budget from '@/public/budget';

import.meta.glob(['../images/**']);

Alpine.plugin(collapse);
Alpine.plugin(persist);

Alpine.data('form', form);
Alpine.data('fileupload', fileupload);
Alpine.directive('budget', budget);

window.Alpine = Alpine;
window.Alpine.start();
