<script setup>
    import { onMounted, watch } from "vue"

    const props = defineProps({
        roomInfo: Array,
        direction: Number,
        room: Object
    })

    // Positie veranderd afhankelijk van de direction de speler loopt
    const roomValues = {
        0: {x: 0, y: -120},
        1: {x: 120, y: 0},
        2: {x: 0, y: 120},
        3: {x: -120, y: 0}
    }

    const roomPositions = {}

    function drawRoom(xValue, yValue)
    {
        const svgNS = "http://www.w3.org/2000/svg"
        const path = document.createElementNS(svgNS, "path")
        const svg = document.getElementById("minimap-svg")

        path.setAttribute(
            "d",
            `M ${560 + xValue} ${1200 + yValue}
             L ${560 + xValue} ${1100 + yValue}
             L ${660 + xValue} ${1100 + yValue}
             L ${660 + xValue} ${1200 + yValue}
             Z`
        )

        path.setAttribute("fill", "none")
        path.setAttribute("stroke", "#948d7f")
        path.setAttribute("stroke-width", "10")

        svg.appendChild(path)
    }

    function createRooms()
    {
        const visitedRooms = []

        function drawHallways(currentX, currentY, direction)
        {
            const svgNS = "http://www.w3.org/2000/svg"
            const path = document.createElementNS(svgNS, "path")
            const svg = document.getElementById("minimap-svg")

            if (direction == 0)
            {
                path.setAttribute(
                    "d",
                    `M ${600 + currentX} ${1100 + currentY}
                     L ${620 + currentX} ${1100 + currentY}
                     L ${620 + currentX} ${1080 + currentY}
                     L ${600 + currentX} ${1080 + currentY}
                     Z`
                )
            }
            else if (direction == 1)
            {
                path.setAttribute(
                    "d",
                    `M ${660 + currentX} ${1140 + currentY}
                     L ${680 + currentX} ${1140 + currentY}
                     L ${680 + currentX} ${1160 + currentY}
                     L ${660 + currentX} ${1160 + currentY}
                     Z`
                )
            }
            else if (direction == 2)
            {
                path.setAttribute(
                    "d",
                    `M ${600 + currentX} ${1200 + currentY}
                     L ${620 + currentX} ${1200 + currentY}
                     L ${620 + currentX} ${1220 + currentY}
                     L ${600 + currentX} ${1220 + currentY}
                     Z`
                )
            }
            else if (direction == 3)
            {
                path.setAttribute(
                    "d",
                    `M ${560 + currentX} ${1140 + currentY}
                     L ${540 + currentX} ${1140 + currentY}
                     L ${540 + currentX} ${1160 + currentY}
                     L ${560 + currentX} ${1160 + currentY}
                     Z`
                )
            }

            path.setAttribute("fill", "#948d7f")
            path.setAttribute("stroke", "none")
            path.setAttribute("stroke-width", "5")

            svg.appendChild(path)
        }

        function drawRooms(roomId, currentX, currentY, startDirection)
        {
            if (visitedRooms.includes(roomId))
                return

            visitedRooms.push(roomId)

            roomPositions[roomId] = {
                x: currentX,
                y: currentY
            }

            drawRoom(currentX, currentY)

            const roomDoors = props.roomInfo.filter(
                door => door.room_id == roomId
            )

            for (let i = 0; i < roomDoors.length; i++)
            {
                const door = roomDoors[i]

                let newDirection = startDirection

                if (door.door_side == "right")
                {
                    newDirection = (startDirection + 1) % 4
                }
                else if (door.door_side == "left")
                {
                    newDirection = (startDirection - 1 + 4) % 4
                }
                else if (door.door_side == "back")
                {
                    newDirection = (startDirection + 2) % 4
                }

                const newCoords = roomValues[newDirection]

                const newX = currentX + newCoords.x
                const newY = currentY + newCoords.y

                const nextRoom = props.roomInfo.find(
                    nextDoor =>
                        nextDoor.door_id == door.door_id &&
                        nextDoor.room_id != roomId
                )

                if (nextRoom)
                {
                    drawHallways(
                        currentX,
                        currentY,
                        newDirection
                    )

                    drawRooms(
                        nextRoom.room_id,
                        newX,
                        newY,
                        newDirection
                    )
                }
            }
        }

        drawRooms(1, 0, 0, 0)
    }

    function playerLocation(direction)
    {
        const svg = document.getElementById("minimap-svg")

        const oldPlayerPointer = document.getElementById("player-pointer")

        if (oldPlayerPointer)
            oldPlayerPointer.remove()

        const svgNS = "http://www.w3.org/2000/svg"
        const path = document.createElementNS(svgNS, "path")

        path.setAttribute("id", "player-pointer")

        const currentRoom = roomPositions[props.room.room_id]

        if (!currentRoom)
            return

        const currentX = currentRoom.x
        const currentY = currentRoom.y

        if (direction == 0 || direction == null)
        {
            path.setAttribute(
                "d",
                `M ${610 + currentX} ${1128 + currentY}
                 L ${628 + currentX} ${1160 + currentY}
                 L ${610 + currentX} ${1148 + currentY}
                 L ${592 + currentX} ${1160 + currentY}
                 Z`
            )
        }
        else if (direction == 1)
        {
            path.setAttribute(
                "d",
                `M ${632 + currentX} ${1150 + currentY}
                 L ${600 + currentX} ${1168 + currentY}
                 L ${612 + currentX} ${1150 + currentY}
                 L ${600 + currentX} ${1132 + currentY}
                 Z`
            )
        }
        else if (direction == 2)
        {
            path.setAttribute(
                "d",
                `M ${610 + currentX} ${1172 + currentY}
                 L ${592 + currentX} ${1140 + currentY}
                 L ${610 + currentX} ${1152 + currentY}
                 L ${628 + currentX} ${1140 + currentY}
                 Z`
            )
        }
        else if (direction == 3)
        {
            path.setAttribute(
                "d",
                `M ${588 + currentX} ${1150 + currentY}
                 L ${620 + currentX} ${1132 + currentY}
                 L ${608 + currentX} ${1150 + currentY}
                 L ${620 + currentX} ${1168 + currentY}
                 Z`
            )
        }

        path.setAttribute("fill", "red")
        path.setAttribute("stroke", "none")

        svg.appendChild(path)
    }

    function drawLegenda()
    {
        const svgNS = "http://www.w3.org/2000/svg"
        const svg = document.getElementById("minimap-svg")

        const path = document.createElementNS(svgNS, "path")

        path.setAttribute(
            "d",
            `M -20 30
             L 10 90
             L -20 68
             L -50 90
             Z`
        )

        path.setAttribute("fill", "red")
        path.setAttribute("stroke", "none")

        svg.appendChild(path)

        const text = document.createElementNS(svgNS, "text")

        text.setAttribute("x", "50")
        text.setAttribute("y", "80")
        text.setAttribute("fill", "#948d7f")
        text.setAttribute("font-size", "66")
        text.setAttribute("font-family", "sans-serif")
        text.setAttribute("font-weight", "bold")

        text.textContent = "Player"

        svg.appendChild(text)
    }

    onMounted(() => {
        createRooms()
        playerLocation(props.direction, null)
        drawLegenda()
    })

    watch(
        [
            () => props.direction,
            () => props.room?.room_id
        ],
        ([newDirection]) =>
        {
            playerLocation(newDirection)
        }
    )

</script>

<template>
    <div class="minimap-panel">
        <svg viewBox="0 0 1220 1220" width="100%" height="100%" id="minimap-svg">

        </svg>
    </div>
</template>

<style scoped lang="scss">
    @import "../../../../css/variables";

    .minimap-panel
    {
        background: $color-stone;
        height: 100%;
        width: 275px;
        border: 1px solid $color-stone-light;
    }
</style>
