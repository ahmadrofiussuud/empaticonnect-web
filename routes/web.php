
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SmartMatchController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Find Helpers (Public)
Route::get('/find-helpers', [SmartMatchController::class, 'findHelpers'])->name('helpers.search');
Route::get('/helpers/{id}', [SmartMatchController::class, 'show'])->name('helpers.show');

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard - Role-based routing
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->isGuardian()) {
            return redirect()->route('guardian.dashboard');
        } elseif ($user->isHelper()) {
            return redirect()->route('helper.dashboard');
        } else {
            return redirect()->route('admin.dashboard');
        }
    })->name('dashboard');

    Route::get('/guardian/dashboard', [DashboardController::class, 'guardianDashboard'])->name('guardian.dashboard');
    Route::get('/helper/dashboard', [DashboardController::class, 'helperDashboard'])->name('helper.dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

    // Beneficiaries (Guardians only)
    Route::resource('beneficiaries', BeneficiaryController::class);

    // Bookings
    Route::resource('bookings', BookingController::class)->except(['edit', 'update', 'destroy']);
    Route::post('/bookings/{id}/update-status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
    Route::post('/bookings/{id}/check-in', [BookingController::class, 'checkIn'])->name('bookings.checkIn');
    Route::post('/bookings/{id}/check-out', [BookingController::class, 'checkOut'])->name('bookings.checkOut');
    Route::post('/bookings/{id}/sos', [BookingController::class, 'sendSOS'])->name('bookings.sos');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

