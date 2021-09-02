import { createI18n } from 'vue-i18n';

import messages from '~/lang/index.js';

export default createI18n({
    locale: document.documentElement.lang,
    // fallbackLocale: 'en',
    messages,
    pluralizationRules: {
        /**
         * @param choice {number} a choice index given by the input to $tc: `$tc('path.to.rule', choiceIndex)`
         * @param choicesLength {number} an overall amount of available choices
         * @returns a final choice index to select plural word by
         */
        ro: (choice, choicesLength) => {
            if (choice === 1) {
                return 0;
            }

            if (choice === 0) {
                return 1;
            }

            let endsWith = choice % 100;

            if (1 <= endsWith && endsWith <= 19) {
                return 1;
            }

            return 2;
        },
    },
});
