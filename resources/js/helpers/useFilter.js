import latinize from 'latinize';

export default function () {
    const filterPredicate = (option, search) => {
        return latinize(option).match(
            new RegExp(
                latinize(search).replace(/[.*+?^${}()|[\]\\]/g, '\\$&'),
                'i'
            )
        );
    };

    return {
        filterPredicate,
    };
}
