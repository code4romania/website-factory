// tests/js/Counter.spec.js
import { mount } from '@vue/test-utils';
import FormInput from '@/components/Form/Input.vue';

describe('FormInput.vue', () => {
    it('has a default value of null', () => {
        const wrapper = mount(FormInput);

        expect(wrapper.vm.modelValue).toBe(null);
    });

    it('accepts a string', () => {
        const wrapper = mount(FormInput, {
            props: {
                modelValue: 'test',
            },
        });

        expect(wrapper.vm.modelValue).toBe('test');
    });

    it('accepts a number', () => {
        const wrapper = mount(FormInput, {
            props: {
                modelValue: 42,
            },
        });

        expect(wrapper.vm.modelValue).toBe(42);
    });
});
