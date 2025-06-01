<?php

use App\Http\Controllers\QuizController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Submission;

Route::get('/quiz/result/{submission}', function (Submission $submission) {
    return view('quiz.result', [
        'submission' => $submission,
    ]);
})->name('quiz.result');

Route::get('/update-db', function(){
    $buffer = [];
    $i = \Illuminate\Support\Facades\Artisan::call('migrate:fresh');

    return $i;
});


Route::get('/', function () {
    if (Auth::check()) {
        // Redirect to the appropriate dashboard based on user role
        if (Auth::user()->isAdmin()) {
            return redirect()->route('filament.admin.pages.dashboard');
        } elseif (Auth::user()->isTeacher()) {
            return redirect()->route('filament.teacher.pages.dashboard');
        } elseif (Auth::user()->isStudent()) {
            return redirect()->route('filament.student.pages.dashboard');
        }else{
            // throw exception
            abort(403, 'Unauthorized action.');
        }
    }

    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes');
    Route::get('quizzes/pass', [QuizController::class, 'pass'])->name('quizzes.pass');
});

require __DIR__.'/auth.php';
