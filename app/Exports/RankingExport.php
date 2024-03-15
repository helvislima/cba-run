<?php
namespace App\Exports;

use App\Models\Enrollment;
use App\Models\Ranking;
use App\Models\Run;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class RankingExport implements FromView, ShouldAutoSize, WithColumnFormatting
{
    public function view(): View
    {
        $currentRun = Run::orderByDesc('id')->first();
        $ranking = Ranking::where('run_id', 1)->orderBy('time')->get();
        return view('components.ranking-table-component', [
            'ranking' => $ranking,
            'is_export' => true,
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'E' => 'helvis'
        ];
    }
}
