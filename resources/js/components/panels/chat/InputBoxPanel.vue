<script setup>
    import { ref, onMounted } from 'vue';
    import { useForm } from '@inertiajs/vue3';

    const commandInput = ref('');
    const form = useForm({ input: '' });

    function move()
    {
        form.input = commandInput.value;
        form.post('/dungeon/input');
        commandInput.value = '';
    }
    // Zorg dat 100% het inputveld altijd gefocused bij starten van dungeon
    onMounted(() =>
    {
        document.querySelector('.chat-input-panel input')?.focus();
    });
</script>

<template>
    <div class="chat-input-panel">
        <form @submit.prevent="move">
            <input
                v-model="commandInput"
                type="text"
                placeholder="Type a command..."
                autofocus
            >
        </form>
    </div>
</template>

<style scoped lang="scss">
    @import "../../../../css/variables";

    .chat-input-panel
    {
        flex-shrink: 0;
    }

    form
    {
        display: flex;
    }

    input
    {
        flex: 1;
        background: $color-stone;
        color: $color-text-muted;
        caret-color: $color-text-muted;
        border: 1px solid $color-stone-light;
        padding: .5rem;
        font-family: $font-dungeon;
        font-size: 1rem;

        &:focus
        {
            outline: none;
            font-family: $font-dungeon;
        }
    }
</style>
