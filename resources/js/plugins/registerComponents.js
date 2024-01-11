export default {
    install(Vue) {
        const componentFiles = import.meta.glob('../components/**/*.vue', { eager: true });

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
