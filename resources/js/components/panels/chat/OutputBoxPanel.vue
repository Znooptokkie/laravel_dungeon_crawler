<script setup>
    import { ref, watch } from "vue";

    const props = defineProps({
        message: String,
        messageID: Number,
        playerName: String,
    })

    const outputStringsArray = ref([]);

    outputStringsArray.value.push(props.message);

    watch(
        () => props.messageID,
        () => {
            while (outputStringsArray.value.length >= 10)
                outputStringsArray.value.shift()

            outputStringsArray.value.push(props.message)
        }
    )
</script>

<template>
    <div class="chat-output-panel">
        <p v-for="(message, index) in outputStringsArray" :key="index">
            <span v-if="message.includes(playerName)">
                {{ message.split(playerName)[0] }}<strong>{{ playerName }}</strong>{{ message.split(playerName)[1] }}
            </span>

            <span v-else>
                {{ message }}
            </span>
        </p>
    </div>
</template>

<style scoped lang="scss">
    @import "../../../../css/variables";

    .chat-output-panel
    {
        flex: 1;
        min-height: 0;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 0 .5rem .5rem;
        background: $color-stone;
        color: $color-text-muted;
    }

    p
    {
        font-family: $font-dungeon;
    }
</style>
