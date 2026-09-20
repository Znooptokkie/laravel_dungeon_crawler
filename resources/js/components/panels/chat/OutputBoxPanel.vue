<script setup>
    import { ref, watch } from "vue";

const props = defineProps({
    message: String,
    messageID: Number
})

const outputStringsArray = ref([])

// Watch the messageID
// Because messageID is unique, there will always be an update
watch(
    () => props.messageID,
    (newMessageID) => {
        if (outputStringsArray.value.length === 10)
            outputStringsArray.value.shift()

        outputStringsArray.value.push(props.message)
    }
)
    

</script>

<template>
    <div class="chat-output-panel">
        <p v-for="message in outputStringsArray">
             {{ message }}
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