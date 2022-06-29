import { inject } from 'vue';
import { ensureCallbacks, route } from '@/helpers';
import axios from 'axios';
import { v4 as uuid } from 'uuid';

export default function () {
    const bus = inject('bus');

    const openMediaLibrary = (id, remaining, selected, allowed) => {
        bus.emit('media-library:open', {
            id, // field id
            remaining, // number of items that can still be selected
            selected, // array of selected item ids
            allowed, // string, allowed item type
        });
    };

    const fetchMedia = async (type, page, callbacks) => {
        const { onSuccess, onError } = ensureCallbacks(callbacks);

        return await axios
            .get(route(`admin.media.${type}`, { page }))
            .then(onSuccess)
            .catch(onError);
    };

    const uploadMedia = (files, callbacks) => {
        const { beforeStart, onUploadProgress, onSuccess, onError } =
            ensureCallbacks(callbacks);

        files.forEach((file) => {
            const payload = new FormData();

            const id = uuid();

            payload.append('file', file);
            payload.append('replaces', id);

            beforeStart(file, id);

            axios
                .post(route('admin.media.store'), payload, {
                    onUploadProgress: (progress) => {
                        progress.percentage = Math.round(
                            (progress.loaded / progress.total) * 100
                        );

                        onUploadProgress(progress, id);
                    },
                })
                .then((response) => onSuccess(response, id))
                .catch((error) => onError(error, id));
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
