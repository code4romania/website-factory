const requireComponent = require.context(
    // The relative path of the components folder
    '@/components',
    // Whether or not to look in subfolders
    true,
    // The regular expression used to match base component filenames
    /[A-Z]\w+\.(vue|js)$/
);

export default {
    install(Vue) {
        requireComponent.keys().forEach((fileName) => {
            const component = requireComponent(fileName);

            if (!component.default.hasOwnProperty('name')) {
                return console.error(
                    `Component ${fileName} missing 'name' property. Skipping...`
                );
            }

            Vue.component(component.default.name, component.default);
        });
    },
};
