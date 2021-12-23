import { inject } from 'vue';
import { ensureCallbacks, route } from '@/helpers';
import axios from 'axios';

export default function () {
    const bus = inject('bus');

    const openMediaLibrary = (id, remaining, selected) => {
        bus.emit('media-library:open', {
            id, // field id
            remaining, // number of items that can still be selected
            selected, // array of selected item ids
        });
    };

    const fetchMedia = async (type, callbacks) => {
        const { onSuccess, onError } = ensureCallbacks(callbacks);

        return await axios
            .get(route(`admin.media.${type}`))
            .then(onSuccess)
            .catch(onError);
    };

    const uploadMedia = (files, callbacks) => {
        const { beforeStart, onUploadProgress, onSuccess, onError } =
            ensureCallbacks(callbacks);

        files.forEach((file) => {
            const payload = new FormData();
            payload.append('file', file);

            beforeStart(file);

            axios
                .post(route('admin.media.store'), payload, {
                    onUploadProgress: (progress) => {
                        progress.percentage = Math.round(
                            (progress.loaded / progress.total) * 100
                        );

                        onUploadProgress(progress);
                    },
                })
                .then(onSuccess)
                .catch(onError);
        });
    };

    const updateMedia = (id, data, callbacks) => {
        const { onSuccess, onError } = ensureCallbacks(callbacks);

        axios
            .put(route('admin.media.update', id), data)
            .then(onSuccess)
            .catch(onError);
    };

    const deleteMedia = (ids, callbacks) => {
        const { onSuccess, onError } = ensureCallbacks(callbacks);

        ids.forEach((id) => {
            axios
                .delete(route('admin.media.destroy', id))
                .then(onSuccess)
                .catch(onError);
        });
    };

    return {
        openMediaLibrary,
        fetchMedia,
        uploadMedia,
        updateMedia,
        deleteMedia,
    };
}
