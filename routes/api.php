<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\TestimonalController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\TalkController;
use App\Http\Controllers\TimeSlotController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\GalleryImageController;
use Illuminate\Support\Facades\Route;

Route::get('/get-speakers',[SpeakerController::class,'getSpeakersPublic']);
Route::get('/get-speakers-admin', [SpeakerController::class, 'getSpeakersAdmin']);
Route::get('/get-speakers-byConference/{id}',[SpeakerController::class,'getSpeakersByConference']);
Route::get('/get-speaker-byId/{id}', [SpeakerController::class, 'getSpeakerById']);

Route::get('/get-conferences',[ConferenceController::class,'getConferences']);
Route::get('/get-conference-byId/{id}',[ConferenceController::class,'getConferenceById']);
Route::get('/get-newestConference',[ConferenceController::class,'getNewestConference']);
Route::post('/create-conference',[ConferenceController::class,'createConference']);
Route::patch('/update-conference/{id}', [ConferenceController::class, 'updateConference']);
Route::delete('/delete-conference/{id}', [ConferenceController::class, 'deleteConference']);

Route::get('/get-gallery-images',[GalleryImageController::class,'getGalleryImages']);
Route::get('/get-gallery-image-byId/{id}', [GalleryImageController::class, 'getGalleryImageById']);
Route::get('/get-gallery-images-byGalleryId/{id}',[GalleryImageController::class,'getGalleryImagesByGalleryId']);
Route::post('/create-gallery-image', [GalleryImageController::class, 'createGalleryImage']);
Route::patch('/update-gallery-image/{id}', [GalleryImageController::class, 'updateGalleryImage']);
Route::delete('/delete-gallery-image/{id}', [GalleryImageController::class, 'deleteGalleryImage']);

Route::get('/get-users/{id}',[UserController::class,'getUsers']);
Route::get('/get-user-byId/{id}', [UserController::class, 'getUserById']);
Route::post('/create-user', [UserController::class, 'createUser']);
Route::patch('/update-user/{id}', [UserController::class, 'updateUser']);
Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']);

Route::get('/get-testimonals', [TestimonalController::class, 'getTestimonals']);
Route::get('/get-testimonials-byConference/{id}', [TestimonalController::class, 'getTestimonalsByConference']);
Route::get('/get-testimonals-byId/{id}', [TestimonalController::class, 'getTestimonalById']);

Route::get('/get-organizers', [OrganizerController::class, 'getOrganizers']);
Route::get('/get-organizer-byId/{id}', [OrganizerController::class, 'getOrganizerById']);
Route::post('/create-organizer', [OrganizerController::class, 'createOrganizer']);
Route::patch('/update-organizer/{id}', [OrganizerController::class, 'updateOrganizer']);
Route::delete('/delete-organizer/{id}', [OrganizerController::class, 'deleteOrganizer']);

Route::get('/get-stages', [StageController::class, 'getStages']);
Route::get('/get-stage-byId/{id}', [StageController::class, 'getStageById']);

Route::get('/get-talks', [TalkController::class, 'getTalks']);
Route::get('/get-talk-byId/{id}', [TalkController::class, 'getTalkById']);

Route::get('/get-timeSlots', [TimeSlotController::class, 'getTimeSlots']);
Route::get('/get-timeSlot-byId/{id}', [TimeSlotController::class, 'getTimeSlotById']);
Route::post('/create-timeSlot', [TimeSlotController::class, 'createTimeSlot']);
Route::patch('/update-timeSlot/{id}', [TimeSlotController::class, 'updateTimeSlot']);
Route::delete('/delete-timeSlot/{id}', [TimeSlotController::class, 'deleteTimeSlot']);

Route::get('/get-partners', [PartnerController::class, 'getPartners']);
Route::get('/get-partner-byId/{id}', [PartnerController::class, 'getPartnerById']);
Route::post('/create-partner', [PartnerController::class, 'createPartner']);
Route::patch('/update-partner/{id}', [PartnerController::class, 'updatePartner']);
Route::delete('/delete-partner/{id}', [PartnerController::class, 'deletePartner']);

Route::get('/get-addresses', [AddressController::class, 'getAddresses']);
Route::get('/get-address-byId/{id}', [AddressController::class, 'getAddressById']);
Route::post('/create-address', [AddressController::class, 'createAddress']);
Route::patch('/update-address/{id}', [AddressController::class, 'updateAddress']);
Route::delete('/delete-address/{id}', [AddressController::class, 'deleteAddress']);

Route::get('/get-locations', [LocationController::class, 'getLocations']);
Route::get('/get-location-byId/{id}', [LocationController::class, 'getLocationById']);
Route::post('/create-location', [LocationController::class, 'createLocation']);
Route::patch('/update-location/{id}', [LocationController::class, 'updateLocation']);
Route::delete('/delete-location/{id}', [LocationController::class, 'deleteLocation']);

Route::get('/get-galleries', [GalleryController::class, 'getGalleries']);
Route::get('/get-gallery-byConference/{conferenceId}', [GalleryController::class, 'getGalleryByConferenceId']);
Route::get('/get-gallery-byId/{id}', [GalleryController::class, 'getGalleryById']);
Route::patch('/update-gallery/{id}', [GalleryController::class, 'updateGallery']);
Route::delete('/delete-gallery/{id}', [GalleryController::class, 'deleteGallery']);

Route::post('/register-attendee', [RegistrationController::class, 'register']);
Route::post('/unregister-attendee', [RegistrationController::class, 'unregister']);
Route::get('/get-registrations', [RegistrationController::class, 'getRegistrations']);
Route::get('/get-registration-byId/{id}', [RegistrationController::class, 'getRegistrationById']);
Route::post('/create-registration', [RegistrationController::class, 'createRegistration']);
Route::patch('/update-registration/{id}', [RegistrationController::class, 'updateRegistration']);
Route::delete('/delete-registration/{id}', [RegistrationController::class, 'deleteRegistration']);

Route::get('/get-sponsors', [SponsorController::class, 'getSponsors']);
Route::get('/get-sponsor-byId/{id}', [SponsorController::class, 'getSponsorById']);
Route::patch('/update-sponsor/{id}', [SponsorController::class, 'updateSponsor']);
Route::delete('/delete-sponsor/{id}', [SponsorController::class, 'deleteSponsor']);

Route::post('/auth/login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::get('/auth/logout', [AuthController::class, 'logout']);

    Route::post('/create-testimonal', [TestimonalController::class, 'createTestimonal']);
    Route::patch('/update-testimonal/{id}', [TestimonalController::class, 'updateTestimonal']);
    Route::delete('/delete-testimonal/{id}', [TestimonalController::class, 'deleteTestimonal']);
    Route::delete('/delete-stage/{id}', [StageController::class, 'deleteStage']);
    Route::post('/create-stage', [StageController::class, 'createStage']);
    Route::patch('/update-stage/{id}', [StageController::class, 'updateStage']);
    Route::post('/create-sponsor', [SponsorController::class, 'createSponsor']);
    Route::post('/create-talk', [TalkController::class, 'createTalk']);
    Route::patch('/update-talk/{id}', [TalkController::class, 'updateTalk']);
    Route::delete('/delete-talk/{id}', [TalkController::class, 'deleteTalk']);
    Route::post('/create-speaker', [SpeakerController::class, 'createSpeaker']);
    Route::patch('/update-speaker/{id}', [SpeakerController::class, 'updateSpeaker']);
    Route::delete('/delete-speaker/{id}', [SpeakerController::class, 'deleteSpeaker']);
    Route::post('/create-gallery', [GalleryController::class, 'createGallery']);
    Route::get('/get-registrationsMetric', [RegistrationController::class, 'getRegistrationsMetric']);
    Route::get('/get-sponsorsMetric', [SponsorController::class, 'getSponsorsMetric']);
    Route::get('/get-stagesMetric', [StageController::class, 'getStagesMetric']);
    Route::get('/get-stagesMetric', [StageController::class, 'getStagesMetric']);
    Route::get('/get-talksMetric', [TalkController::class, 'getTalksMetric']);
});
