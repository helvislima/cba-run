<?php

namespace App\Http\Controllers;

use App\Exports\EnrollmentExport;
use App\Exports\RankingExport;
use App\Models\Run;
use App\Models\Unit;
use App\Models\Ranking;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public function enrollmentExport()
    {
        return Excel::download(new EnrollmentExport, 'matriculas_'.time().'.xlsx');
    }
    public function rankingExport()
    {
        return Excel::download(new RankingExport, 'ranking_'.time().'.xlsx');
    }
}
