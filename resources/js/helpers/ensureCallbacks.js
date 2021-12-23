export default function (callbacks = {}) {
    ['beforeStart', 'onUploadProgress', 'onSuccess', 'onError'].forEach(
        (callback) => {
            if (callbacks.hasOwnProperty(callback)) {
                return;
            }

            callbacks[callback] = () => {};
        }
    );

    return callbacks;
}
