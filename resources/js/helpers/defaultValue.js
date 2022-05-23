export default function (type) {
    const match = type.toString().match(/^\s*function (\w+)/);

    type = match ? match[1] : String;

    return {
        Array: [],
        Boolean: false,
        Date: new Date(),
        Number: 0,
        Object: {},
        String: null,
    }[type];
}
