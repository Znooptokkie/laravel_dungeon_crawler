<script setup>
    const props = defineProps({
        enemyLevel: {
            type: Number,
            default: 1
        },
        enemyName: {
            type: String,
            default: ""
        },
        enemyIcon: {
            type: String,
            default: ""
        }
    });

    console.log(props.enemyIcon)
</script>

<template>
    <div class="enemy-icon">
        <h2>{{ enemyName }} lvl {{ enemyLevel }}</h2>
        <img
            :src="props.enemyIcon"
            alt="Enemy"
            class="enemy-svg"
        >
    </div>
</template>

<style scoped lang="scss">
    @import '../../../css/_variables';

    h2
    {
        font-size: 1rem;
    }

    .enemy-icon
    {
        position: absolute;
        top: 200px;
        right: 500px;
    }

    .enemy-svg
    {
        width: 100px;
        height: 100px;
    }
</style>
