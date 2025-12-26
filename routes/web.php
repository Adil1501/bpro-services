<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/test', function() {
    return '<h1>Admin Test Pagina</h1><p>Als je dit ziet, werkt de middleware!</p>';
})->middleware(['auth', 'admin']);

require __DIR__.'/auth.php';


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
        ->name('dashboard');
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::post('users/{user}/toggle-admin', [App\Http\Controllers\Admin\UserController::class, 'toggleAdmin'])
        ->name('users.toggle-admin');
    Route::resource('news', App\Http\Controllers\Admin\NewsController::class);
    Route::resource('tags', App\Http\Controllers\Admin\TagController::class)
        ->except(['show']);
    Route::resource('faqs', App\Http\Controllers\Admin\FaqController::class);
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class)
        ->except(['show']);
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('portfolios', \App\Http\Controllers\Admin\PortfolioController::class);
    Route::post('portfolios/{portfolio}/toggle-featured', [\App\Http\Controllers\Admin\PortfolioController::class, 'toggleFeatured'])
         ->name('portfolios.toggle-featured');
    Route::get('quotes', [\App\Http\Controllers\Admin\QuoteController::class, 'index'])
         ->name('quotes.index');
    Route::get('quotes/{quote}', [\App\Http\Controllers\Admin\QuoteController::class, 'show'])
         ->name('quotes.show');
    Route::post('quotes/{quote}/status', [\App\Http\Controllers\Admin\QuoteController::class, 'updateStatus'])
         ->name('quotes.update-status');
    Route::post('quotes/{quote}/assign', [\App\Http\Controllers\Admin\QuoteController::class, 'assign'])
         ->name('quotes.assign');
    Route::post('quotes/{quote}/update-quote', [\App\Http\Controllers\Admin\QuoteController::class, 'updateQuote'])
         ->name('quotes.update-quote');
    Route::post('quotes/{quote}/comment', [\App\Http\Controllers\Admin\QuoteController::class, 'addComment'])
         ->name('quotes.add-comment');
    Route::post('quotes/{quote}/send', [\App\Http\Controllers\Admin\QuoteController::class, 'sendQuote'])
         ->name('quotes.send');
    Route::delete('quotes/{quote}', [\App\Http\Controllers\Admin\QuoteController::class, 'destroy'])
         ->name('quotes.destroy');
    Route::post('quotes/bulk-action', [\App\Http\Controllers\Admin\QuoteController::class, 'bulkAction'])
         ->name('quotes.bulk-action');
        Route::get('contact-messages', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])
         ->name('contact-messages.index');
    Route::get('contact-messages/{contactMessage}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'show'])
         ->name('contact-messages.show');
    Route::post('contact-messages/{contactMessage}/notes', [\App\Http\Controllers\Admin\ContactMessageController::class, 'updateNotes'])
         ->name('contact-messages.update-notes');
    Route::post('contact-messages/{contactMessage}/mark-read', [\App\Http\Controllers\Admin\ContactMessageController::class, 'markAsRead'])
         ->name('contact-messages.mark-read');
    Route::post('contact-messages/{contactMessage}/mark-unread', [\App\Http\Controllers\Admin\ContactMessageController::class, 'markAsUnread'])
         ->name('contact-messages.mark-unread');
    Route::post('contact-messages/{contactMessage}/archive', [\App\Http\Controllers\Admin\ContactMessageController::class, 'archive'])
         ->name('contact-messages.archive');
    Route::post('contact-messages/{contactMessage}/replied', [\App\Http\Controllers\Admin\ContactMessageController::class, 'markAsReplied'])
         ->name('contact-messages.mark-replied');
    Route::delete('contact-messages/{contactMessage}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])
         ->name('contact-messages.destroy');
    Route::post('contact-messages/bulk-action', [\App\Http\Controllers\Admin\ContactMessageController::class, 'bulkAction'])
         ->name('contact-messages.bulk-action');
    Route::post('contact-messages/{contactMessage}/notes', [\App\Http\Controllers\Admin\ContactMessageController::class, 'updateNotes'])
     ->name('contact-messages.update-notes');
    Route::post('contact-messages/{contactMessage}/archive', [\App\Http\Controllers\Admin\ContactMessageController::class, 'archive'])
        ->name('contact-messages.archive');
    Route::post('contact-messages/{contactMessage}/replied', [\App\Http\Controllers\Admin\ContactMessageController::class, 'markAsReplied'])
        ->name('contact-messages.mark-replied');
});

Route::post('/portfolio/{portfolio}/like', [\App\Http\Controllers\PortfolioLikeController::class, 'toggle'])
     ->name('portfolio.like')
     ->middleware('auth');

Route::get('/offerte-aanvragen', [\App\Http\Controllers\QuoteRequestController::class, 'create'])
     ->name('quote.create');
Route::post('/offerte-aanvragen', [\App\Http\Controllers\QuoteRequestController::class, 'store'])
     ->name('quote.store');
Route::get('/offerte-aanvragen/success', [\App\Http\Controllers\QuoteRequestController::class, 'success'])
     ->name('quote.success');

Route::middleware('auth')->group(function () {
    Route::get('/mijn-offertes', [\App\Http\Controllers\QuoteRequestController::class, 'myQuotes'])
         ->name('quote.my-quotes');
    Route::get('/mijn-offertes/{quote}', [\App\Http\Controllers\QuoteRequestController::class, 'showMyQuote'])
         ->name('quote.show-my-quote');
});
