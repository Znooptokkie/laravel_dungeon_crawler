<script setup>
    import InputBoxPanel from './chat/InputBoxPanel.vue';
    import OutputBoxPanel from './chat/OutputBoxPanel.vue';
    import InventoryPanel from './inventory/InventoryPanel.vue';
    import MinimapPanel from './navigating/MinimapPanel.vue';
    import CombatLevelPanel from './stats/CombatLevelPanel.vue';
    import StatPointPanel from './stats/StatPointPanel.vue';
    import StatsPanel from './stats/StatsPanel.vue';

    const props = defineProps({
        messages: Array,
        messageID: Number,
        playerName: String,
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
        enemyDetails: Array,
        enemyRoom: Array,
    })
</script>

<template>
    <div class="chat-panel">
        <OutputBoxPanel
            :messages="props.messages"
            :messageID="props.messageID"
            :player-name="playerName"
        />

        <InputBoxPanel/>
    </div>
    <div class="stats-panel">
        <CombatLevelPanel
            :combat-level="props.combatLevel"
        />

        <StatsPanel
            :hitpoints="props.hitpoints"
            :magic="props.magic"
            :stamina="props.stamina"
            :attack="props.attack"
            :defence="props.defence"
            :lockpicking="props.lockpicking"
        />

        <StatPointPanel
            :points-left="props.pointsLeft"
        />
    </div>
    <div class="map-panel">
        <MinimapPanel
            :room-info="props.roomInfo"
            :direction="props.direction"
            :room="props.room"
            :enemy-room="props.enemyRoom"
        />
    </div>
    <div class="inventory-panel">
        <InventoryPanel
            :inventory-items="props.inventoryItems"
        />
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
        gap: .3rem;
    }

    .stats-panel
    {
        display: flex;
        flex-direction: column;
        gap: .3rem;
        // flex: 1;
        width: 10%;
        min-height: 0;
        display: flex;
        flex-direction: column;
        margin-bottom: .3rem;
    }

    .inventory-panel
    {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: .25rem;
        padding: .25rem;
        background: $color-stone;
        width: 34%; // Waarde klopt niet, maar werkt voor mijn pc
    }
</style>
