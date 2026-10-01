<script setup>
    defineProps({
        hitpoints: Number,
        magic: Number,
        stamina: Number,
        attack: Number,
        defence: Number,
        lockpicking: Number,
    })
</script>

<template>
    <div class="stats-panel-skills">
        <div class="stat-row">
            <p class="stat-first">Hitpoint lvl:</p>
            <p class="stat-sec">{{ hitpoints }}</p>
        </div>
         <div class="stat-row">
            <p class="stat-first">Magic lvl:</p>
            <p class="stat-sec">{{ magic }}</p>
         </div>
        <div class="stat-row">
            <p class="stat-first">Stamina lvl:</p>
            <p class="stat-sec">{{ stamina }}</p>
         </div>
        <div class="stat-row">
            <p class="stat-first">Attack lvl:</p>
            <p class="stat-sec">{{ attack }}</p>
         </div>
        <div class="stat-row">
            <p class="stat-first">Defence lvl:</p>
            <p class="stat-sec">{{ defence }}</p>
         </div>
        <div class="stat-row">
            <p class="stat-first">Lockpick lvl:</p>
            <p class="stat-sec">{{ lockpicking }}</p>
         </div>
    </div>
</template>

<style scoped lang="scss">
    @import "../../../../css/variables";

    .stats-panel-skills
    {
        background: $color-stone;
        border: 2px solid $color-stone-light;

        p
        {
            font-family: $font-dungeon;
            font-weight: bold;
            font-size: 1.1rem;
            color: $color-text-muted;
        }

        .stat-row
        {
            display: flex;
            flex-direction: row;
            padding: .2rem;

            .stat-first
            {
                flex: 1;
            }

            .stat-sec
            {
                width: 20px;
                text-align: center;
            }
        }
    }
</style>
