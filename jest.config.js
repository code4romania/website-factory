module.exports = {
    // preset: 'ts-jest',
    // globals: {},
    // testEnvironment: 'jsdom',
    // transform: {
    //     '^.+\\.vue$': 'vue-jest',
    //     '^.+\\js$': 'babel-jest',
    // },
    // moduleFileExtensions: ['vue', 'js', 'json', 'jsx', 'ts', 'tsx', 'node'],

    // /////////////////////////////////////////////
    // testRegex: 'tests/js/.*.spec.js$',

    // moduleNameMapper: {
    //     '^@/(.*)$': '<rootDir>/resources/js/$1',
    // },
    roots: ['<rootDir>/tests/Vue'],
    transform: {
        '.*\\.(vue)$': '<rootDir>/node_modules/vue-jest',
        '^.+\\.js$': '<rootDir>/node_modules/babel-jest',
    },

    moduleNameMapper: {
        '^@/(.*)$': '<rootDir>/resources/js/$1',
    },
};
