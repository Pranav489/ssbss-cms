<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HeroSlideController;
use App\Http\Controllers\Api\ImpactMetricController;
use App\Http\Controllers\Api\ProgramController;
use App\Http\Controllers\Api\JoinMissionController;
use App\Http\Controllers\Api\AboutUsController;
use App\Http\Controllers\Api\DocumentCategoryController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\ProgramPageController;
use App\Http\Controllers\Api\ContactPageController;
use App\Http\Controllers\Api\ContactInquiryController;






Route::get('/hero-slides', [HeroSlideController::class, 'index']);
Route::get('/hero-slides/{slug}', [HeroSlideController::class, 'show']);
Route::get('/impact-metrics', [ImpactMetricController::class, 'index']);
Route::get('/impact-metrics/highlighted', [ImpactMetricController::class, 'highlighted']);
Route::get('/programs', [ProgramController::class, 'index']);
Route::get('/programs/featured', [ProgramController::class, 'featured']);
Route::get('/programs/{slug}', [ProgramController::class, 'show']);
Route::get('/join-mission', [JoinMissionController::class, 'index']);
Route::get('/about-us', [AboutUsController::class, 'index']);
Route::get('/document-categories', [DocumentCategoryController::class, 'index']);
Route::get('/documents', [DocumentController::class, 'index']);
Route::get('/documents/{id}', [DocumentController::class, 'show']);
Route::get('/documents/{id}/download', [DocumentController::class, 'download'])->name('documents.download');
Route::get('/gallery', [GalleryController::class, 'index']);
Route::get('/gallery/featured', [GalleryController::class, 'featured']);
Route::get('/gallery/categories', [GalleryController::class, 'categories']);
Route::get('/program-pages', [ProgramPageController::class, 'index']);
Route::get('/program-pages/categories', [ProgramPageController::class, 'categories']);
Route::get('/program-pages/{slug}', [ProgramPageController::class, 'show']);
Route::get('/contact-page', [ContactPageController::class, 'index']);
Route::post('/contact-inquiries', [ContactInquiryController::class, 'store']);
Route::get('/contact-inquiries/stats', [ContactInquiryController::class, 'stats']);

