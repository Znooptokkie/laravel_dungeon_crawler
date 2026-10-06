<script setup>
    const props = defineProps({
        inventoryItems: Object
    })

    const inventoryItemsArray = []
    for (let i = 0; i < 12; i++)
    {
        const slot = i + 1;
        const inventoryItem = props.inventoryItems.find(item => item.slot === slot);

        if (inventoryItem)
            inventoryItemsArray.push(inventoryItem);
        else
            inventoryItemsArray.push("null");
    }
    // console.log(props.inventoryItems[0].icon_url)
</script>

<template>
    <div v-for="(item, index) in inventoryItemsArray" :key="index" class="inventory-slot">
        <p v-if="item.quantity > 0" class="item-quantity">{{ item.quantity }}</p>
        <img v-if="item" :src="item.icon_url" class="item-icon">
    </div>
</template>

<style scoped lang="scss">
    @import "../../../../css/variables";

    .inventory {
        // display: grid;
        // grid-template-columns: repeat(5, 1fr);
    }

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
