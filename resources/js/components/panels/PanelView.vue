<script setup>
    import InputBoxPanel from './chat/InputBoxPanel.vue';
    import OutputBoxPanel from './chat/OutputBoxPanel.vue';
    import MinimapPanel from './navigating/MinimapPanel.vue';
    import CombatLevelPanel from './stats/CombatLevelPanel.vue';
    import StatPointPanel from './stats/StatPointPanel.vue';
    import StatsPanel from './stats/StatsPanel.vue';

    const props = defineProps({
        message: String,
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
        room: Object
    })
</script>

<template>
    <div class="chat-panel">
        <OutputBoxPanel
            :message="props.message"
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
</style>
