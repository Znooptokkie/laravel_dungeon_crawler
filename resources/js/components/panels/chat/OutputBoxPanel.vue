<script setup>
    import { ref, watch } from "vue";

    const props = defineProps({
        messages: Array,
        messageID: Number,
    })

    const outputStringsArray = ref([...props.messages]);

    watch(
        () => props.messageID,
        () => {
            for (const message of props.messages)
            {
                while (outputStringsArray.value.length >= 10)
                    outputStringsArray.value.shift()

                outputStringsArray.value.push(message)
            }
        }
    )
</script>

<template>
    <div class="chat-output-panel">
        <p v-for="(message, index) in outputStringsArray" :key="index">
            <span
                v-for="(part, partIndex) in message"
                :key="partIndex"
                :style="{
                    color: part.color,
                    fontWeight: part.bold ? 'bold' : 'normal'
                }"
            >
                {{ part.text }}
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
