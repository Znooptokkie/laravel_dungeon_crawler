<script setup>
    import { computed } from "vue"

    const props = defineProps({
        inventoryItems: {
            type: Array,
            default: () => []
        }
    })

    const inventoryItemsArray = computed(() => {
        const items = []

        for (let i = 0; i < 12; i++) {
            const slot = i + 1

            const inventoryItem = props.inventoryItems.find(
                item => item.slot === slot
            )

            if (inventoryItem) {
                items.push(inventoryItem)
            } else {
                items.push(null)
            }
        }

        return items
    })
</script>

<template>
    <div
        v-for="(item, index) in inventoryItemsArray"
        :key="index"
        class="inventory-slot"
    >
        <p
            v-if="item && item.quantity > 0"
            class="item-quantity"
        >
            {{ item.quantity }}
        </p>

        <img
            v-if="item"
            :src="item.icon_url"
            class="item-icon"
        >
    </div>
</template>

<style scoped lang="scss">
    @import "../../../../css/variables";

    .inventory-slot
    {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100px;
        height: 108px;
        border: 1px solid $color-stone-light;
    }

    .item-quantity
    {
        position: absolute;
        top: 0;
        left: 0;
        margin: .2rem 0 0 .2rem;
        font-family: $font-dungeon;
        font-weight: bold;
        color: $color-text-muted;
        font-size: 1.25rem;
    }

    .item-icon
    {
        width: 80px;
        height: 840x;
    }
</style>
