<?php

namespace App\Http\Controllers;

use App\Models\Run;
use App\Models\Unit;
use App\Models\User;
use App\Models\Ranking;
use Illuminate\View\View;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendUserConfirmedEnrollmentEmail;

class RegisterController extends Controller
{
    public function register(Request $request): mixed
    {
        $code = $request->code;
        $user = null;
        if($code) {
            $user = User::where('code', $code)->first();
            if(!$user) {
                return redirect()->back()->withError(['Esta matrícula não existe']);
            }
        }
        return view('welcome', [
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $user = User::where('code', $request->code)->first();
        $currentRun = Run::orderByDesc('id')->first();
        if($user) {
            $currentRun = Run::orderByDesc('id')->first();
            $totalRegistered = Enrollment::where('unit_id', $user->unit_id)->where('run_id', $currentRun->id)->count();
            $availableVacancie = Unit::where('id', $user->unit_id)->first()->vacancies;
            if(($totalRegistered + 1) <= $availableVacancie) {
                $hasEnrollment = Enrollment::where('user_code', $user->code)->exists();
                if($hasEnrollment) {
                    return redirect()->back()->withError(['Você já realizou esta inscrição']);
                } else {
                    $enrollment = Enrollment::create([
                        'user_id' => $user->id,
                        'user_name' => $user->name,
                        'unit_id' => $user->unit_id,
                        'unit' => $user->unit,
                        'tshirt' => $request->tshirt,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'run_id' => $currentRun->id,
                        'user_code' => $user->code,
                    ]);

                    //Mail::to($request->email)->send(new SendUserConfirmedEnrollmentEmail($user, $enrollment));
                    return redirect()->back()->withSuccess(['Sua inscrição foi efetuada com sucesso!']);
                }
            } else {
                return redirect()->back()->withError(['O número de vagas foi atingido para esta unidade']);
            }
        }
    }

    public function registerTime(Request $request)
    {
        $code = $request->code;
        $user = null;
        if($code) {
            $user = User::where('code', $code)->first();
            if(!$user) {
                return redirect()->back()->withError(['Esta matrícula não existe']);
            }
        }
        return null;
        return view('register-time', [
            'user' => $user
        ]);
    }

    public function saveTime(Request $request)
    {
        $user = User::where('code', $request->code)->first();
        if($user) {
            $currentRun = Run::orderByDesc('id')->first();
            $hasRanking = Ranking::where('user_id', $user->id)->exists();
            if($hasRanking) {
                return redirect()->back()->withError(['Você já cadastrou o seu tempo']);
            } else {
                $photo = $request->photo;
                $fileName = (round(microtime(true)*1000)).'.'.$photo->extension();
                $path = $photo->move(public_path('uploads'), $fileName);

                $ranking = Ranking::create([
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'unit_id' => $user->unit_id,
                    'unit' => $user->unit,
                    'time' => $request->time,
                    'photo' => $fileName,
                    'run_id' => $currentRun->id,
                ]);
                return redirect()->back()->withSuccess(['O cadastro do seu tempo foi efetuada com sucesso!']);
            }
        }
    }
}
