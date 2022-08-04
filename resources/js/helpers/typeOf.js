// Using this function instead of the builtin typeof because
//      typeof [] is 'object' instead of 'array'
export default function (value) {
    let type = toString.call(value).match(/\[object (\w+)\]/)[1];

    return {
        Array,
        Boolean,
        Date,
        Number,
        Object,
        String,
    }[type];
}
