<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// GET REQUESTS
// get visitor details
Route::get("/visitor", [VisitorController::class, "GetVisitorDetails"]);
// site info page route
Route::get("/siteinfo", [SiteInfoController::class, "AllSites"]);
// all category route
Route::get("/category", [CategoryController::class, "AllCategories"]);
// -----------------------------------------------------------------
// -----------------------------------------------------------------
// POST REQUESTS
// contact page route
Route::post("/contact", [ContactController::class, "CreateMessage"]);

// -----------------------------------------------------------------
// -----------------------------------------------------------------