module.exports = {
    testEnvironment: 'jsdom',
    roots: ['<rootDir>/tests/Vue'],
    transform: {
        '.*\\.(vue)$': '@vue/vue3-jest',
        '^.+\\.js$': 'babel-jest',
    },
    moduleNameMapper: {
        '^@/(.*)$': '<rootDir>/resources/js/$1',
    },
};
