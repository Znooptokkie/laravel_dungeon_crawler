<script setup>
    import ChestPopup from "./ChestPopup.vue"

    defineProps({
        chestRoom: Object,
        showChestPopup: {
            type: Boolean,
            default: false
        },
        chestItems: {
            type: Array,
            default: () => []
        }
    })

    const emit = defineEmits(["close-popup"])
</script>

<template>
    <div class="chest-icon">
        <img
            v-if="chestRoom?.chestIsEmpty"
            src="/items/chest_open_empty.svg"
            alt="Lege kist"
            class="chest-svg"
        >

        <img
            v-else-if="chestRoom?.chestIsOpen"
            src="/items/chest_open_not_empty.svg"
            alt="Open kist"
            class="chest-svg"
        >

        <img
            v-else
            src="/items/chest.svg"
            alt="Dichte kist"
            class="chest-svg"
        >
    </div>

    <ChestPopup
        v-if="showChestPopup"
        :items="chestItems"
        @close="emit('close-popup')"
    />
</template>

<style scoped lang="scss">
    .chest-icon
    {
        position: absolute;
        top: 250px;
        left: 500px;
    }

    .chest-svg
    {
        width: 200px;
        height: 150px;
    }
</style>
