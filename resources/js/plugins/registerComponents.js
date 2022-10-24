export default {
    install(Vue) {
        const componentFiles = import.meta.globEager('../components/**/*.vue');

        Object.entries(componentFiles).forEach(([path, component]) => {
            if (!component.default.hasOwnProperty('name')) {
                return console.error(
                    `Component ${path} missing 'name' property. Skipping...`
                );
            }

            Vue.component(component.default.name, component.default);
        });
    },
};
