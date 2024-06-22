<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\TestimonalController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\TalkController;
use App\Http\Controllers\TimeSlotController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\GalleryImageController;
use Illuminate\Support\Facades\Route;

Route::get('/get-conferences',[ConferenceController::class,'getConferences']);
Route::get('/get-newestConference',[ConferenceController::class,'getNewestConferenceWithAddress']);

Route::get('/get-speakers',[SpeakerController::class,'getSpeakersPublic']);
Route::get('/get-speaker-byId/{id}', [SpeakerController::class, 'getSpeakerById']);

Route::get('/get-stages', [StageController::class, 'getStages']);

Route::get('/get-talks', [TalkController::class, 'getTalks']);

Route::get('/get-timeSlots', [TimeSlotController::class, 'getTimeSlots']);
Route::get('/get-timeSlot-byStageId/{stage_id}', [TimeSlotController::class, 'getTimeSlotsByStageId']);

Route::get('/get-testimonals', [TestimonalController::class, 'getTestimonals']);
Route::get('/get-testimonials-byConference/{id}', [TestimonalController::class, 'getTestimonalsByConference']);

Route::get('/get-galleries', [GalleryController::class, 'getGalleries']);
Route::get('/get-gallery-byConference/{conferenceId}', [GalleryController::class, 'getGalleryByConferenceId']);

Route::get('/get-gallery-images-byGalleryId/{id}',[GalleryImageController::class,'getGalleryImagesByGalleryId']);

Route::get('/get-organizers', [OrganizerController::class, 'getOrganizers']);

Route::get('/get-partners', [PartnerController::class, 'getPartners']);

Route::get('/get-sponsors', [SponsorController::class, 'getSponsors']);

Route::get('/get-users/{id}',[UserController::class,'getUsersByConference']);

Route::post('/register-attendee', [RegistrationController::class, 'register']);
Route::post('/unregister-attendee', [RegistrationController::class, 'unregister']);

Route::get('/get-pages', [PageController::class, 'getPages']);
Route::get('/get-page/{id}', [PageController::class, 'getPage']);

Route::post('/auth/login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::get('/auth/logout', [AuthController::class, 'logout']);

    Route::get('/get-speakers-admin', [SpeakerController::class, 'getSpeakersAdmin']);
    Route::post('/create-speaker', [SpeakerController::class, 'createSpeaker']);
    Route::patch('/update-speaker/{id}', [SpeakerController::class, 'updateSpeaker']);
    Route::delete('/delete-speaker/{id}', [SpeakerController::class, 'deleteSpeaker']);

    Route::post('/create-stage', [StageController::class, 'createStage']);
    Route::patch('/update-stage/{id}', [StageController::class, 'updateStage']);
    Route::delete('/delete-stage/{id}', [StageController::class, 'deleteStage']);

    Route::get('/get-unassignedTalks', [TalkController::class, 'getUnassignedTalks']);
    Route::post('/create-talk', [TalkController::class, 'createTalk']);
    Route::patch('/update-talk/{id}', [TalkController::class, 'updateTalk']);
    Route::delete('/delete-talk/{id}', [TalkController::class, 'deleteTalk']);

    Route::post('/create-timeSlot', [TimeSlotController::class, 'createTimeSlot']);
    Route::patch('/update-timeSlot/{id}', [TimeSlotController::class, 'updateTimeSlot']);
    Route::delete('/delete-timeSlot/{id}', [TimeSlotController::class, 'deleteTimeSlot']);

    Route::post('/create-testimonal', [TestimonalController::class, 'createTestimonal']);
    Route::patch('/update-testimonal/{id}', [TestimonalController::class, 'updateTestimonal']);
    Route::delete('/delete-testimonal/{id}', [TestimonalController::class, 'deleteTestimonal']);

    Route::post('/create-gallery', [GalleryController::class, 'createGallery']);

    Route::post('/create-sponsor', [SponsorController::class, 'createSponsor']);

    Route::get('/get-registrationsMetric', [RegistrationController::class, 'getRegistrationsMetric']);
    Route::get('/get-sponsorsMetric', [SponsorController::class, 'getSponsorsMetric']);
    Route::get('/get-stagesMetric', [StageController::class, 'getStagesMetric']);
    Route::get('/get-talksMetric', [TalkController::class, 'getTalksMetric']);

    Route::post('/create-page', [PageController::class, 'createPage']);
});
