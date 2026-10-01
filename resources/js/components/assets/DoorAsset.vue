<script setup>
    const props = defineProps({
        side: {
            type: String,
            default: "left",
        },
        locked: {
            type: Boolean,
            default: false,
        },
    });

    function drawDoors()
    {
        let doorPath = "";

        if (props.side === "front")
        {
            doorPath = "M 0 250 L 0 0 L 200 0 L 200 250";
        }
        else if (props.side === "left")
        {
            doorPath = "M 0 365 L 0 100 L 150 0 L 150 250";
        }
        else if (props.side === "right")
        {
            doorPath = "M 150 250 L 150 0 L 300 100 L 300 365";
        }
        else
        {
            doorPath = "M 0 0 L 0 10 L 200 10 L 200 0 Z"
        }

        return doorPath;
    }
</script>

<template>
    <div
        class="door"
        :class="[
            `door-${props.side}`,
            { locked: props.locked }
        ]"
    >
        <svg
            viewBox="100 0 100 200"
            class="door-asset"
        >
            <!-- Deur -->
            <path
                :d="drawDoors()"
                class="door-panel"
            />

            <!-- Binnenste rand -->
            <path
                :d="drawDoors()"
                class="door-frame"
            />

            <!-- Deurklink -->
            <circle
                v-if="props.side === 'left'"
                cx="82"
                cy="105"
                r="4"
                class="door-handle"
            />
        </svg>
    </div>
</template>

<style scoped lang="scss">
    @import '../../../css/_variables';

    .door
    {
        position: absolute;
        width: 100px;
        height: 200px;

        // filter: drop-shadow(0 4px 5px rgba(0, 0, 0, 0.7));
    }

    .door-asset
    {
        display: block;
        width: 100%;
        height: 100%;
        overflow: visible;
    }

    .door-panel
    {
        fill: $color-door-unlocked;
        stroke: black;
        stroke-width: 5;
        stroke-linejoin: round;
    }

    .door-frame
    {
        fill: none;
        stroke: black;
        stroke-width: 2;
        stroke-linejoin: round;
    }

    .door-handle
    {
        fill: red;
        stroke: $color-stone;
        stroke-width: 2;
    }

    .door.locked
    {
        .door-panel
        {
            fill: darken($color-bg-dark, 5%);
        }

        .door-frame
        {
            stroke: $color-text-muted;
        }
    }

    .door-left
    {
        left: 17%;
        top: 26%;
    }

    .door-right
    {
        right: 17%;
        top: 26%;
    }

    .door-front
    {
        left: 50%;
        top: 0;

        transform: translateY(53%);
    }

    .door-back
    {
        left: 50%;
        bottom: 0;
        transform: translateY(95%);
    }
</style>
