import axios from 'axios';
import Alpine from 'alpinejs';

export default function () {
    const composeKey = (parent, key) =>
        parent ? parent + '[' + key + ']' : key;

    const append = (formData, key, value) => {
        if (Array.isArray(value)) {
            return Array.from(value.keys()).forEach((index) =>
                append(
                    formData,
                    composeKey(key, index.toString()),
                    value[index]
                )
            );
        } else if (value instanceof Date) {
            return formData.append(key, value.toISOString());
        } else if (value instanceof File) {
            return formData.append(key, value, value.name);
        } else if (value instanceof Blob) {
            return formData.append(key, value);
        } else if (typeof value === 'boolean') {
            return formData.append(key, value ? '1' : '0');
        } else if (typeof value === 'string') {
            return formData.append(key, value);
        } else if (typeof value === 'number') {
            return formData.append(key, `${value}`);
        } else if (value === null || value === undefined) {
            return formData.append(key, '');
        }

        objectToFormData(value, formData, key);
    };

    const objectToFormData = (source, formData = null, parentKey = null) => {
        formData = formData || new FormData();

        for (const key in source) {
            append(formData, composeKey(parentKey, key), source[key]);
        }

        return formData;
    };

    return {
        form: Alpine.reactive({}),
        errors: Alpine.reactive({}),
        processing: false,
        success: false,
        message: null,
        initializeField(defaultValue = null) {
            this.form[this.$el.name] = defaultValue;
            this.errors[this.$el.name] = null;
        },

        resetState() {
            this.success = false;
            this.message = null;

            for (const key in this.errors) {
                this.errors[key] = null;
            }
        },

        get errorList() {
            return Object.values(this.errors).filter(Boolean);
        },

        submit() {
            this.resetState();

            this.processing = true;

            axios
                .post(this.$el.action, objectToFormData(this.form), {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                })
                .then((response) => {
                    if (response.data.hasOwnProperty('redirect')) {
                        return this.redirect(response.data.redirect);
                    }

                    this.success = true;
                    this.message = response.data.message;

                    window.scrollTo({
                        top: this.$el.offsetTop - 40,
                        behavior: 'smooth',
                    });
                })
                .catch(({ response }) => {
                    this.success = false;
                    this.message = response.data.message;

                    if (response.status == 422) {
                        for (const key in response.data.errors) {
                            this.errors[key] = response.data.errors[key][0];
                        }
                    }
                })
                .finally(() => {
                    setTimeout(() => {
                        this.processing = false;
                    }, 500);
                });
        },

        redirect(target) {
            const form = document.createElement('form');

            form.action = target.url;
            form.method = target.method;

            Object.entries(target.data).forEach(([name, value]) => {
                const input = document.createElement('input');

                input.type = 'hidden';
                input.name = name;
                input.value = value;

                form.appendChild(input);
            });

            document.body.appendChild(form);

            form.submit();
        },
    };
}
