<script setup>
    import { useForm } from '@inertiajs/vue3';

    const form = useForm();

    function newGame()
    {

    }

    function continueGame()
    {
        // console.log("continuewadsfs")
        form.get("/dungeon")
    }

    function help()
    {

    }
</script>

<template>
    <div class="main-menu">
        <button 
            command="show-modal"
            commandfor="my-dialog">New Game</button>
        <button @click="continueGame">Continue Game</button>
        <button @click="help">Help</button>
    </div>

    <dialog id="my-dialog">
        <div class="new-game-form">
            <form action=""></form>
        </div>
        <div>
            <button commandfor="my-dialog" command="close">Cancel</button>
            <button commandfor="my-dialog" command="close">Create</button>
        </div>
    </dialog>
</template>