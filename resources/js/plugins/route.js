import route from 'ziggy-js';

export default {
    install(Vue) {
        Vue.prototype.route = function (name, params = {}, absolute = true) {
            if (name.split('.')[0] === 'tenant' && this.$page.props.tenant) {
                params.org = this.$page.props.tenant.slug;
            }

            return route(name, params, absolute);
        };
    },
};
