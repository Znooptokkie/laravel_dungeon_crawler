<script setup>
    import DoorAsset from '../assets/DoorAsset.vue';

    defineProps({
        dungeonLevel: Number,
        doors: Array,
        hasChest: Boolean,
        chestOpened: Boolean,
        boss: { type: Object, default: null },
    });
</script>

<template>
    <div class="room">
        <h1>Dungeon Level {{ dungeonLevel }}</h1>
        <svg class="room-outline" viewBox="0 0 1000 600" preserveAspectRatio="none">
            <path
                d="M 0 600 L 250 300 L 750 300 L 1000 600"
                stroke="black"
                stroke-width=4
            />
            <path
                d="M 250 300 L 250 0"
                stroke="black"
                stroke-width=3
            />
            <path
                d="M 750 300 L 750 0"
                stroke="black"
                stroke-width=3
            />
        </svg>
        <!-- <BossEntity v-if="boss" :name="boss.name" :hp="boss.hp" :max-hp="boss.maxHp" /> -->

        <div class="doors">
            <DoorAsset
                v-for="door in doors"
                :key="door.door_id"
                :side="door.pivot.door_side"
                :locked="door.is_locked"
            />
        </div>

            <!-- <ChestAsset v-if="hasChest" :opened="chestOpened" /> -->

        <!-- <p class="message">{{ message }}</p> -->
    </div>
</template>

<style scoped lang="scss">
    @import '../../../css/_variables';

    .room
    {
        position: relative;
        height: 100%;
        width: 100%;
        background: $color-bg-dark;
        border: 2px solid $color-stone-light;
        // border-radius: 6px;
        text-align: center;
    }

    .doors
    {
        position: absolute;
        inset: 0;
    }

    .message
    {
        color: $color-text-muted;
        margin-top: $spacing-md;
    }

    .room-outline
    {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;

        path
        {
            fill: $color-stone;
        }
    }
</style>
