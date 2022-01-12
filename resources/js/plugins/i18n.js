import { createI18n } from 'vue-i18n/dist/vue-i18n.cjs';
import messages from '~/lang/index.js';

export default createI18n({
    locale: document.documentElement.lang,
    legacy: false,
    globalInjection: true,
    messages,
    pluralRules: {
        ro: (choice, choicesLength) => {
            choice = Math.abs(choice);
            if ([0, 1].includes(choice)) {
                return choice;
            }

            const endsWith = choice % 100;
            if (1 <= endsWith && endsWith <= 19) {
                return Math.min(choicesLength - 1, 2);
            }

            return Math.min(choicesLength - 1, 3);
        },
    },
});
