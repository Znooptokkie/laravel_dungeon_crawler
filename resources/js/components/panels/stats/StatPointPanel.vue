<script setup>
    defineProps({
        pointsLeft: Number
    })
</script>

<template>
    <div class="stats-panel-points">
        <div class="stat-row">
            <p class="stat-first">Points Left:</p>
            <p class="stat-sec">{{ pointsLeft }}</p>
        </div>
    </div>
</template>

<style scoped lang="scss">
    @import "../../../../css/variables";

    .stats-panel-points
    {
        background: $color-stone;
        height: 100%;
        display: flex;
        align-items: center;
        border: 1px solid $color-stone-light;

        p
        {
            font-family: $font-dungeon;
            font-weight: bold;
            font-size: 1.1rem;
            color: $color-text-muted;
            padding: .25rem;
        }

        .stat-row
        {
            width: 100%;
            display: flex;
            flex-direction: row;

            .stat-first
            {
                flex: 1;
            }

            .stat-sec
            {
                width: 20px;
                text-align: center;
                flex-shrink: 0;
            }
        }
    }
</style>
