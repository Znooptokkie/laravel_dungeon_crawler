<script setup>
    import InputBoxPanel from './chat/InputBoxPanel.vue';
    import OutputBoxPanel from './chat/OutputBoxPanel.vue';

    const props = defineProps({
        message: String,
        messageID: Number
    })
</script>

<template>
    <div class="chat-panel">
        <OutputBoxPanel 
            :message="props.message" 
            :messageID="props.messageID"    
        />

        <InputBoxPanel/>
    </div>
</template>

<style scoped lang="scss">
    @import "../../../css/variables";
    
    .chat-panel
    {
        width: 40%;
        min-height: 0;
        display: flex;
        flex-direction: column;
    }
</style>