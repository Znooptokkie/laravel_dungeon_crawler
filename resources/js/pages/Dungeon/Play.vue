<script setup>
    import RoomView from '../../components/dungeon/RoomView.vue';
    import PanelView from '@/components/panels/PanelView.vue';

    const props = defineProps({
        playerName: String,
        dungeonLevel: Number,
        doors: Array,
        lastInput: String,
        message: String,
        messageID: Number,
        hasChest: Boolean,
        chestOpened: Boolean,
        combatLevel: Number,
        hitpoints: Number,
        magic: Number,
        stamina: Number,
        attack: Number,
        defence: Number,
        lockpicking: Number,
        pointsLeft: Number,
        roomInfo: Array,
        direction: Number,
        room: Object,
        inventoryItems: Object,
    });

</script>

<template>
    <div class="page">
        <div class="dungeon">
            <RoomView
                :dungeon-level="dungeonLevel"
                :doors="doors"
                :has-chest="hasChest"
                :chest-opened="chestOpened"
            />
        </div>

        <div class="control-panel">
            <PanelView
                :message="props.message"
                :messageID="props.messageID"
                :player-name="props.playerName"
                :combat-level="props.combatLevel"
                :hitpoints="props.hitpoints"
                :magic="props.magic"
                :stamina="props.stamina"
                :attack="props.attack"
                :defence="props.defence"
                :lockpicking="props.lockpicking"
                :points-left="props.pointsLeft"
                :room-info="props.roomInfo"
                :direction="props.direction"
                :room="props.room"
                :inventory-items="props.inventoryItems"
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
        background: $color-bg-dark;
    }

    .dungeon
    {
        flex: 3;
        width: 100%;
        min-height: 0;
        font-family: $font-dungeon;
        color: $color-text;
        margin-bottom: .2rem;
    }

    .control-panel
    {
        flex: 1;
        width: 100%;
        min-height: 0;
        display: flex;
        gap: .3rem;
        margin: .3rem;
    }
</style>
