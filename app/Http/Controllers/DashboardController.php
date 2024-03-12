<?php

namespace App\Http\Controllers;

use App\Models\Run;
use App\Models\Unit;
use App\Models\User;
use App\Models\Ranking;
use Illuminate\View\View;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request): mixed
    {
        $currentRun = Run::orderByDesc('id')->first();
        $runId = $request->query('run_id') ?? $currentRun->id;
        if($request->unit_id) {
            $enrollments = Enrollment::where('unit_id', $request->unit_id)->where('run_id', $runId)->get();
        } else {
            $enrollments = Enrollment::where('run_id', $runId)->get();
        }
        $units = Unit::all();
        $runs = Run::orderByDesc('id')->get();

        return view('dashboard', [
            'enrollments' => $enrollments,
            'units' => $units,
            'runs' => $runs,
            'runId' => $runId
        ]);
    }

    public function ranking(Request $request): mixed
    {
        $currentRun = Run::orderByDesc('id')->first();
        $runId = $request->query('run_id') ?? $currentRun->id;
        $unitNameFiltered = '';
        if($request->unit_id) {
            $ranking = Ranking::where('unit_id', $request->unit_id)->where('run_id', $runId)->orderBy('time')->get();
            $unitNameFiltered = Unit::find($request->unit_id)?->name;
        } else {
            $ranking = Ranking::where('run_id', $runId)->orderBy('time')->get();
        }
        $units = Unit::all();
        $runs = Run::orderByDesc('id')->get();
        return view('ranking', [
            'units' => $units,
            'ranking' => $ranking,
            'unitNameFiltered' => $unitNameFiltered,
            'runs' => $runs,
            'runId' => $runId
        ]);
    }
}
