@props([
    'name' => null,
])

<template x-if="errors[@js($name)]">
    <p class="mt-2 text-sm text-red-600" x-text="errors[@js($name)]"></p>
</template>
