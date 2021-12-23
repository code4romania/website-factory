import axios from 'axios';
import { ensureCallbacks, route } from '@/helpers';


export default function () {
    const fetchData = async (type, callbacks) => {
        const { onSuccess, onError } = ensureCallbacks(callbacks);

        return await axios
            .get(route(`admin.${type}.collection`))
            .then(onSuccess)
            .catch(onError);
    }

    return {
        fetchData,
    };
}
