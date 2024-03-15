<?php
namespace App\Exports;

use App\Models\Enrollment;
use App\Models\Run;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EnrollmentExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $currentRun = Run::orderByDesc('id')->first();
        $enrollments = Enrollment::where('run_id', $currentRun->id)->get();

        return view('components.enrollment-table-component', [
            'enrollments' => $enrollments,
        ]);
    }
}
