<template>
    <div
        class="flex flex-col items-center justify-between w-full text-sm gap-y-4 gap-x-8"
    >
        <p v-text="$t('help.ask.info')" />
        <a
            href="https://calendly.com/civictech911"
            target="_blank"
            className="whitespace-nowrap w-full justify-center flex items-center px-3 py-2 leading-none border border-transparent text-sm shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
        >
            <span v-text="$t('help.ask.action')" />

            <icon
                name="System/external-link-line"
                class="ml-2 -mr-0.5 h-4 w-4"
            />
        </a>
    </div>
</template>

<script>
    export default {
        name: 'HelpAsk',
    };
</script>
