<script setup>
    const { side } = defineProps({
        side: {
            type: String,
            default: "left",
        },
    });

    // defineProps({
    //     side: { type: String, default: 'left' }, // 'left' of 'right', puur voor de spiegeling van de deurknop
    // });


    function drawDoors()
    {
        let doorPath = ""
        // let position = { x: 0, y: 0 }
        
        if (side === "front")
        {
            doorPath = "M 0 200 L 0 0 L 100 0 L 100 200"
            // position.x = 450
            // position.y = 550
        }
        else if (side === "left")
        {
            doorPath = "M 0 200 L 0 50 L 100 0 L 100 150"
        }
        else
        {
            doorPath = "M 0 150 L 0 0 L 100 50 L 100 200"
        }

        return doorPath
    }

</script>

<template>
    <svg viewBox="0 0 100 200" class="door-asset">
        <path 
            :d="drawDoors()"
            fill="none"
            stroke="white"
            cx=""
        />
    </svg>
</template>

<style scoped lang="scss">
    @import '../../../css/_variables';

    .door-asset
    {
        width: 80px;
        height: auto;
    }
</style>