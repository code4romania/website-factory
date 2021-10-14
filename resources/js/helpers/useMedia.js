import { route } from '@/helpers';
import axios from 'axios';

const ensureCallbacks = (callbacks = {}) => {
    ['beforeStart', 'onUploadProgress', 'onSuccess', 'onError'].forEach(
        (callback) => {
            if (callbacks.hasOwnProperty(callback)) {
                return;
            }

            callbacks[callback] = () => {};
        }
    );

    return callbacks;
};

export default function () {
    const fetchMedia = async (callbacks) => {
        const { onSuccess, onError } = ensureCallbacks(callbacks);

        return await axios
            .get(route('admin.media.index'))
            .then(onSuccess)
            .catch(onError);
    };

    const uploadMedia = (files, callbacks) => {
        const {
            beforeStart,
            onUploadProgress,
            onSuccess,
            onError,
        } = ensureCallbacks(callbacks);

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
        fetchMedia,
        uploadMedia,
        deleteMedia,
    };
}
