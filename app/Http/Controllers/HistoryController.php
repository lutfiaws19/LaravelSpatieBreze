<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Antrian;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = History::all();
        return view('history.index', compact('histories'));
    }

    public function destroy($id)
    {
        $history = History::findOrFail($id);
        $history->delete();

        return redirect()->route('history.index')->with('success', 'History berhasil dihapus!');
    }
}
