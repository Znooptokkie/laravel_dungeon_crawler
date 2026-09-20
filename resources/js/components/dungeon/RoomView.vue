<script setup>
    import DoorAsset from '../assets/DoorAsset.vue';
    // import ChestAsset from '../assets/ChestAsset.vue';
    // import BossEntity from '../entities/BossEntity.vue';

    defineProps({
        room: Number,
        message: String,
        hasChest: Boolean,
        chestOpened: Boolean,
        boss: { type: Object, default: null }, // { name, hp, maxHp } — later toegevoegd vanuit de backend
    });
</script>

<template>
    <div class="room">
        <h1>Kamer {{ room }}</h1>
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
                <DoorAsset side="front" />
                <DoorAsset side="right" />
            </div>

            <!-- <ChestAsset v-if="hasChest" :opened="chestOpened" /> -->

        <p class="message">{{ message }}</p>
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
        display: flex;
        justify-content: center;
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