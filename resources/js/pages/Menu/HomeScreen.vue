<script setup>
    import { useForm } from '@inertiajs/vue3';

    const form = useForm({
        username: ''
    });

    function newGame()
    {
        form.post("/newPlayer")
    }

    function continueGame()
    {
        form.get("/continueGame")
    }

    function help()
    {

    }
</script>

<template>
    <div class="main-menu">
        <div class="menu-content">
            <h1>Dungeon Master</h1>

            <div class="menu-buttons">
                <button
                    command="show-modal"
                    commandfor="my-dialog"
                >
                    New Game
                </button>

                <button @click="continueGame">
                    Continue Game
                </button>

                <button @click="help">
                    Help
                </button>
            </div>
        </div>
    </div>

    <dialog id="my-dialog">
        <div class="new-game-form">
            <form @submit.prevent="newGame">
                <div class="form-content">
                    <label for="username">Username</label>

                    <input
                        type="text"
                        name="username"
                        id="username"
                        v-model="form.username"
                        autocomplete="off"
                    >
                </div>

                <div class="form-buttons">
                    <button
                        type="button"
                        commandfor="my-dialog"
                        command="close"
                    >
                        Cancel
                    </button>

                    <button type="submit">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </dialog>
</template>

<style scoped lang="scss">
@import '../../../css/variables';

.main-menu
{
    width: 100vw;
    height: 100vh;

    display: flex;
    justify-content: center;
    align-items: center;

    box-sizing: border-box;

    background: $color-stone;
    color: $color-text;

    font-family: $font-dungeon;
}

.menu-content
{
    display: flex;
    flex-direction: column;
    align-items: center;

    gap: 3rem;
}

h1
{
    margin: 0;

    font-size: 3rem;
    text-align: center;
}

.menu-buttons
{
    display: flex;
    flex-direction: column;

    width: 16rem;
    gap: .75rem;
}

button
{
    padding: .75rem 1rem;

    border: 1px solid $color-text;
    border-radius: 0;

    background: transparent;
    color: $color-text;

    font-family: $font-dungeon;
    font-size: 1rem;

    cursor: pointer;
}

button:hover
{
    background: $color-text;
    color: $color-stone;
}

dialog
{
    padding: 0;

    border: 1px solid $color-text;
    border-radius: 0;

    background: $color-stone;
    color: $color-text;

    font-family: $font-dungeon;
}

dialog::backdrop
{
    background: rgba(0, 0, 0, .75);
}

.new-game-form
{
    padding: 2rem;
}

form
{
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.form-content
{
    display: flex;
    flex-direction: column;
    gap: .5rem;
}

input
{
    padding: .75rem;

    border: 1px solid $color-text;
    border-radius: 0;

    outline: none;

    background: transparent;
    color: $color-text;

    font-family: $font-dungeon;
}

input:focus
{
    border-color: $color-text;
}

.form-buttons
{
    display: flex;
    justify-content: flex-end;
    gap: .75rem;
}
</style>
