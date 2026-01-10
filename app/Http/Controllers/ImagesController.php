<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    public function store(Request $request, $gameId, $noteId)
    {
        $note = Note::find($noteId);

        $validatedData = $request->validate([
            'image' => 'required|image',
        ]);

        $file = $validatedData['image'];

        $originalName = basename($file->getClientOriginalName());

        $file->storeAs('note_images', $originalName, 'public');

        $imageModel = new Image();
        $imageModel->note_id = $note->id;
        $imageModel->image_name = $originalName;
        $imageModel->save();

        return redirect()->route('games.notes.edit', [$gameId, $noteId]);
    }

    public function destroy($gameId, $noteId, $imageId)
    {
        $image = Image::where('note_id', $noteId)->find($imageId);
        $image->delete();
        return redirect()->route('games.notes.edit', [$gameId, $noteId]);
    }
}
