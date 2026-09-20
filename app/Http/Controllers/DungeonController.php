<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DungeonController extends Controller
{
    // Toon de huidige kamer
public function index()
{
    return Inertia::render('Dungeon/Play', [
        'room' => session('room', 1),
        'lastInput' => session('last_input', ''),
        'message' => session('message', 'Je staat bij de ingang van de dungeon.'),
        "messageID" => session("message_id", 0)
    ]);
}

    // Tel 1 bij de "room" op
    // Stuur terug naar index() zodat nieuwe kamer getoond wordt
public function move(Request $request)
{
    $validated = $request->validate(['input' => 'required|string|max:100']);
    $input = strtolower($validated['input']);

    $room = session('room', 1);

    $messageID = session("message_id", 0) + 1;

    if (str_contains($input, 'link') || str_contains($input, 'recht')) {
        $room++;
        $message = "Je loopt door.";
    } else {
        $message = 'Dat commando begrijp ik niet. Probeer "links" of "rechts".';
    }

    session(['room' => $room]);
    session(['last_input' => $validated['input']]);
    session(['message' => $message]);
    session(["message_id" => $messageID]);

    return redirect()->route('dungeon.play');
}
}