<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderPaymentController;
use App\Http\Controllers\WhatsAppController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Auth\OtpResetPasswordController;
use App\Http\Controllers\CateringController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderTrackingController;

// ==========================================
// MENU ROUTES
// ==========================================

Route::get('/menu', function (Request $request) {
    $query = Product::where('is_active', true);

    if ($search = $request->input('search')) {
        $searchTerm = '%' . strtolower($search) . '%';

        $query->where(function ($q) use ($searchTerm) {
            $q->whereRaw('LOWER(name) LIKE ?', [$searchTerm])
                ->orWhereRaw('LOWER(description) LIKE ?', [$searchTerm]);
        });
    }

    $products = $query->latest()->get();

    return view('menu.index', compact('products'));
})->name('menu.index');

Route::get('/menu/category/{category}', [ProductController::class, 'byCategory'])->name('menu.category');

Route::get('/menu/nasibox', function () {
    $products = Product::where('is_active', true)
        ->where('category', 'Nasi Box')
        ->latest()
        ->get();

    return view('menu.nasibox', compact('products'));
})->name('menu.nasibox');

Route::get('/menu/tumpeng', function () {
    $products = Product::where('is_active', true)
        ->where('category', 'Tumpeng')
        ->latest()
        ->get();

    return view('menu.tumpeng', compact('products'));
})->name('menu.tumpeng');

Route::get('/menu/prasmanan', function () {
    $products = Product::where('is_active', true)
        ->where('category', 'Prasmanan')
        ->latest()
        ->get();

    return view('menu.prasmanan', compact('products'));
})->name('menu.prasmanan');

Route::get('/menu/bakery', function () {
    $products = Product::where('is_active', true)
        ->where('category', 'Bakery')
        ->latest()
        ->get();

    return view('menu.bakery', compact('products'));
})->name('menu.bakery');

Route::get('/menu/snackbox', function () {
    $products = Product::where('is_active', true)
        ->where('category', 'Snack Box')
        ->latest()
        ->get();

    return view('menu.snackbox', compact('products'));
})->name('menu.snackbox');

Route::get('/menu/snackbox/{id}', function ($id) {
    $limitKue = $id;

    $daftarKue = [
        ['id' => 1, 'nama' => 'Risol Mayo Premium', 'harga' => 3500, 'gambar' => 'risol-mayo.png'],
        ['id' => 2, 'nama' => 'Lemper Ayam Spesial', 'harga' => 3500, 'gambar' => 'lemper.png'],
        ['id' => 3, 'nama' => 'Pastel Ayam Sayur', 'harga' => 3000, 'gambar' => 'pastel.png'],
        ['id' => 4, 'nama' => 'Sosis Solo Daging Sapi', 'harga' => 3500, 'gambar' => 'sosis-solo.png'],
        ['id' => 5, 'nama' => 'Kroket Kentang Ayam', 'harga' => 3500, 'gambar' => 'kroket.png'],
        ['id' => 6, 'nama' => 'Arem-arem Isi Daging', 'harga' => 3000, 'gambar' => 'arem-arem.png'],
        ['id' => 7, 'nama' => 'Kue Sus Fla Vanila', 'harga' => 3000, 'gambar' => 'sus.png'],
        ['id' => 8, 'nama' => 'Brownies Potong Almond', 'harga' => 4000, 'gambar' => 'brownies.png'],
        ['id' => 9, 'nama' => 'Kue Lumpur Surga', 'harga' => 3500, 'gambar' => 'kue-lumpur.png'],
        ['id' => 10, 'nama' => 'Nagasari Daun Pisang', 'harga' => 2500, 'gambar' => 'nagasari.png'],
        ['id' => 11, 'nama' => 'Dadar Gulung Unti Kelapa', 'harga' => 2500, 'gambar' => 'dadar-gulung.png'],
        ['id' => 12, 'nama' => 'Bolu Kukus Mekar', 'harga' => 2500, 'gambar' => 'bolu-kukus.png'],
        ['id' => 13, 'nama' => 'Pie Buah Segar', 'harga' => 4500, 'gambar' => 'pie-buah.png'],
        ['id' => 14, 'nama' => 'Lapis Legit Potong', 'harga' => 4000, 'gambar' => 'lapis-legit.png'],
        ['id' => 15, 'nama' => 'Puding Sutra Cup', 'harga' => 4000, 'gambar' => 'puding.png'],
    ];

    return view('menu.snackbox-detail', compact('limitKue', 'daftarKue'));
})->name('snackbox.detail');

Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

// ==========================================
// GENERAL & STATIC PAGES
// ==========================================

Route::get('/', function () {
    $popularProducts = OrderItem::selectRaw('product_id, product_name_snapshot, SUM(qty) as total_sold')
        ->groupBy('product_id', 'product_name_snapshot')
        ->orderByDesc('total_sold')
        ->take(3)
        ->get()
        ->map(function ($item) {
            return Product::where('name', $item->product_name_snapshot)
                ->where('is_active', true)
                ->first();
        })
        ->filter()
        ->values();

    if ($popularProducts->count() < 3) {
        $existingIds = $popularProducts->pluck('id')->toArray();

        $tambahan = Product::where('is_active', true)
            ->whereNotIn('id', $existingIds)
            ->latest()
            ->take(3 - $popularProducts->count())
            ->get();

        $popularProducts = $popularProducts->concat($tambahan);
    }

    return view('welcome', compact('popularProducts'));
})->name('welcome');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/catering', function () {
    return view('catering');
})->name('catering');

Route::post('/catering/store', [CateringController::class, 'store'])->name('catering.store');

Route::view('/about', 'about')->name('about');

// ==========================================
// AUTH & OTP GUEST
// ==========================================

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

// OTP login dibuat di luar guest supaya tetap bisa dipakai saat proses login OTP.
Route::get('otp', [OtpController::class, 'index'])->name('otp');
Route::post('/otp/verify-login', [OtpController::class, 'verify'])->name('otp.verify-login');
Route::post('/otp/resend', [OtpController::class, 'resend'])->name('otp.resend');

// ==========================================
// PRODUCTS
// ==========================================

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

// ==========================================
// CART
// ==========================================

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{cartKey}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{cartKey}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// ==========================================
// CHECKOUT
// ==========================================

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
    Route::post('/checkout/payment', [CheckoutController::class, 'saveCheckoutData'])->name('checkout.payment.save');
    Route::get('/checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
    Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
});

Route::get('/orders/{order}/payment', [OrderPaymentController::class, 'show'])->name('orders.payment.show');
Route::post('/orders/{order}/payment-proof', [OrderPaymentController::class, 'uploadProof'])->name('orders.payment.proof');
Route::get('/orders/{order}/whatsapp', [WhatsAppController::class, 'redirect'])->name('orders.whatsapp');

// ==========================================
// PAYMENT (MIDTRANS)
// ==========================================

Route::get('/payment/{orderId}', [PaymentController::class, 'show'])->name('payment.show');
Route::get('/payment/success/{orderId}', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/check-status/{orderId}', [PaymentController::class, 'checkStatus'])->name('payment.checkStatus');
Route::post('/midtrans/notification', [PaymentController::class, 'notification'])->name('midtrans.notification');

// ==========================================
// DASHBOARD AFTER LOGIN
// ==========================================

Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==========================================
// AUTH LOGGED IN
// ==========================================

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.edit.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/my-orders', [OrderTrackingController::class, 'index'])->name('orders.tracking');
    Route::get('/my-orders/{order}', [OrderTrackingController::class, 'show'])->name('orders.show');
});

// ==========================================
// OTP RESET PASSWORD
// ==========================================

Route::get('/otp/verify', [OtpResetPasswordController::class, 'showVerifyForm'])
    ->name('password.otp.verify'); 

Route::post('/otp/send', [OtpResetPasswordController::class, 'sendOtp'])
    ->name('otp.send');

Route::post('/otp/verify', [OtpResetPasswordController::class, 'verifyOtpAndReset'])
    ->name('password.otp.submit');

// ==========================================
// ADMIN
// ==========================================

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        $totalOrders = Order::count();
        $totalRevenue = Order::whereIn('status', ['paid', 'processing', 'completed'])->sum('total');
        $pendingOrders = Order::where('status', 'pending_payment')->count();
        $totalProducts = Product::where('is_active', true)->count();

        $recentOrders = Order::latest()->take(5)->get();

        $popularProducts = OrderItem::selectRaw('product_id, product_name_snapshot, SUM(qty) as total_sold')
            ->groupBy('product_id', 'product_name_snapshot')
            ->orderByDesc('total_sold')
            ->take(3)
            ->get();

        $revenueByDay = Order::selectRaw("DATE(created_at) as date, SUM(total) as total")
            ->whereIn('status', ['paid', 'processing', 'completed'])
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $statusCounts = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'pendingOrders',
            'totalProducts',
            'recentOrders',
            'popularProducts',
            'revenueByDay',
            'statusCounts'
        ));
    })->name('dashboard');

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/export', [AdminOrderController::class, 'export'])->name('orders.export');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');

    Route::patch('/orders/{id}/mark-paid', [AdminOrderController::class, 'markPaid'])->name('orders.markPaid');
    Route::patch('/orders/{id}/mark-processing', [AdminOrderController::class, 'markProcessing'])->name('orders.markProcessing');
    Route::patch('/orders/{id}/mark-completed', [AdminOrderController::class, 'markCompleted'])->name('orders.markCompleted');
    Route::patch('/orders/{id}/cancel', [AdminOrderController::class, 'cancel'])->name('orders.cancel');

    Route::get('/product', [AdminProductController::class, 'index'])->name('product');
    Route::get('/product/create', [AdminProductController::class, 'create'])->name('product.create');
    Route::post('/product', [AdminProductController::class, 'store'])->name('product.store');
    Route::get('/product/{product}/edit', [AdminProductController::class, 'edit'])->name('product.edit');
    Route::patch('/product/{product}', [AdminProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{product}', [AdminProductController::class, 'destroy'])->name('product.destroy');

});
