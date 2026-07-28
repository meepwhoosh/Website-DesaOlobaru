<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Visitor;
use Carbon\Carbon;

class VisitorController extends Controller
{
    public function index()
    {
        $totalVisitors = Visitor::count();
        $visitorsToday = Visitor::whereDate('created_at', Carbon::today())->count();
        $visitorsThisWeek = Visitor::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $visitorsThisMonth = Visitor::whereMonth('created_at', Carbon::now()->month)
                                     ->whereYear('created_at', Carbon::now()->year)
                                     ->count();

        $visitorLogs = Visitor::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.pengunjung.index', compact(
            'totalVisitors',
            'visitorsToday',
            'visitorsThisWeek',
            'visitorsThisMonth',
            'visitorLogs'
        ));
    }
    public function reset()
    {
        Visitor::truncate();
        return redirect()->back()->with('success', 'Semua data pengunjung berhasil dihapus.');
    }
}
