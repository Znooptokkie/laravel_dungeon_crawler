<script setup>
    import RoomView from '../../components/dungeon/RoomView.vue';
    import PanelView from '@/components/panels/PanelView.vue';

    const props = defineProps({
        playerName: String,
        room: Number,
        lastInput: String,
        message: String,
        messageID: Number,
        hasChest: Boolean,
        chestOpened: Boolean,
    });

</script>

<template>
    <div class="page">
        <div class="dungeon">
            <RoomView
                :room="room"
                :has-chest="hasChest"
                :chest-opened="chestOpened"
            />
        </div>

        <div class="control-panel">
            <PanelView
                :message="props.message"
                :messageID="props.messageID"
                :player-name="props.playerName"
            />
        </div>
    </div>
</template>

<style scoped lang="scss">
    @import '../../../css/_variables';

    .page
    {
        height: 100vh;
        width: 100vw;
        display: flex;
        flex-direction: column;
        box-sizing: border-box;
    }

    .dungeon
    {
        flex: 3;
        width: 100%;
        min-height: 0;

        font-family: $font-dungeon;
        color: $color-text;
    }

    .control-panel
    {
        flex: 1;
        width: 100%;
        min-height: 0;

        display: flex;
    }
</style>
