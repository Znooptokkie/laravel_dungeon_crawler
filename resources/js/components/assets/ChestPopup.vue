<script setup>
    defineProps({
        items: {
            type: Array,
            default: () => []
        }
    })

    const emit = defineEmits(["close"])
</script>

<template>
    <div class="chest-popup-overlay" @click.self="emit('close')">
        <div class="chest-popup">

            <h2 class="chest-title">Chest</h2>

            <p v-if="items.length === 0">
                This chest is empty.
            </p>

            <div v-else class="chest-items">
                <div
                    v-for="(entry, index) in items"
                    :key="entry.item.item_id ?? index"
                    class="chest-item"
                >
                    <img
                        :src="entry.item.icon_url"
                        :alt="entry.item.name"
                        class="item-icon"
                    />
                    <span class="item-name">{{ entry.item.name }}</span>
                    <span class="item-quantity">{{ entry.quantity }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
    @import '../../../css/_variables';

    .chest-popup-overlay
    {
        position: fixed;
        inset: 0;
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        // background: rgba(0, 0, 0, 0.7);
        pointer-events: none;
    }

    .chest-popup
    {
        position: relative;
        width: 500px;
        max-width: 90%;
        max-height: 80vh;
        overflow-y: auto;
        padding: 24px;
        pointer-events: auto;
        background: $color-stone;
        border: 5px solid $color-stone-light;
    }

    .chest-items
    {
        display: flex;
        // flex-direction: row;
        gap: 12px;
    }

    .chest-title
    {
        color: $color-text-muted;
        margin: 0;
    }

    .chest-item
    {
        position: relative;
        width: 127.5px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 12px;
        border: 4px solid $color-stone-light;
    }

    .item-icon
    {
        width: 75%;
        align-self: center;
    }

    .item-name
    {
            color: $color-text-muted;
        // font-size: 1.25rem;
        font-weight: bold;
    }

    .item-quantity
    {
        position: absolute;
        top: 5px;
        left: 5px;
        color: $color-text-muted;
        font-size: 1.25rem;
        font-weight: bold;
    }
</style>
