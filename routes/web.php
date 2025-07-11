<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\qa\QaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\qa\mrm\MrmController;
use App\Http\Controllers\qa\pdf\PdfController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\qa\mrm\MailController;
use App\Http\Controllers\qa\capa\CapaController;
use App\Http\Controllers\qa\risk\RiskController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\qa\excel\ExcelController;
use App\Http\Controllers\qa\users\UsersController;
use App\Http\Controllers\manager\ManagerController;
use App\Http\Controllers\officer\OfficerController;
use App\Http\Controllers\qa\recall\RecallController;
use App\Http\Controllers\director\DirectorController;
use App\Http\Controllers\qa\users\ApprovalController;
use App\Http\Controllers\guest\GuestFeedbackController;
use App\Http\Controllers\qa\ia\InternalAuditController;
use App\Http\Controllers\qa\users\Activationcontroller;
use App\Http\Controllers\qa\ccm\ChangeControlController;
use App\Http\Controllers\qa\feedback\FeedbackController;
use App\Http\Controllers\qa\documents\DocumentController;
use App\Http\Controllers\manager\mrm\ManagerMrmController;
use App\Http\Controllers\manager\pdf\ManagerPdfController;
use App\Http\Controllers\officer\pdf\OfficerPdfController;
use App\Http\Controllers\qa\complaint\ComplaintController;
use App\Http\Controllers\qa\deviation\DeviationController;
use App\Http\Controllers\qa\recall\RecallClosureController;
use App\Http\Controllers\director\mrm\DirectorMrmController;
use App\Http\Controllers\director\pdf\DirectorPdfController;
use App\Http\Controllers\manager\capa\ManagerCapaController;
use App\Http\Controllers\manager\risk\ManagerRiskController;

use App\Http\Controllers\officer\capa\OfficerCapaController;
use App\Http\Controllers\officer\risk\OfficerRiskController;
use App\Http\Controllers\manager\ccm\ManagerChangeController;
use App\Http\Controllers\officer\ccm\OfficerChangeController;
use App\Http\Controllers\director\capa\DirectorCapaController;
use App\Http\Controllers\director\risk\DirectorRiskController;
use App\Http\Controllers\director\ccm\DirectorChangeController;
use App\Http\Controllers\director\recall\DirectorRecallController;
use App\Http\Controllers\qa\Training\TrainingAndFeedbackController;
use App\Http\Controllers\manager\feedback\ManagerFeedbackController;
use App\Http\Controllers\director\ia\DirectorInternalAuditController;
use App\Http\Controllers\manager\documents\ManagerDocumentController;
use App\Http\Controllers\officer\documents\OfficerDocumentController;
use App\Http\Controllers\qa\document_control\DocumentationController;
use App\Http\Controllers\director\feedback\DirectorFeedbackController;
use App\Http\Controllers\manager\complaint\ManagerComplaintController;
use App\Http\Controllers\manager\deviation\ManagerDeviationController;
use App\Http\Controllers\officer\complaint\OfficerComplaintController;
use App\Http\Controllers\officer\deviation\OfficerDeviationController;
use App\Http\Controllers\director\documents\DirectorDocumentController;
use App\Http\Controllers\director\complaint\DirectorComplaintController;
use App\Http\Controllers\director\deviation\DirectorDeviationController;
use App\Http\Controllers\director\recall\DirectorRecallClosureController;
use App\Http\Controllers\manager\training\ManagerTrainingAndFeedbackController;
use App\Http\Controllers\officer\training\OfficerTrainingAndFeedbackController;
use App\Http\Controllers\director\training\DirectorTrainingAndFeedbackController;
use App\Http\Controllers\manager\document_control\ManagerDocumentationController;
use App\Http\Controllers\officer\document_control\OfficerDocumentationController;
use App\Http\Controllers\director\document_control\DirectorDocumentationController;


//=============login======================================================================================

Route::get('/', [LoginController::class, 'index'])->name('index');
Route::post('/login', [LoginController::class, 'login'])->name('login');


//=============registration===============================================================================

Route::get('/register', [RegisterController::class, 'view'])->name('register')->middleware('register');
Route::post('/registration', [RegisterController::class, 'register'])->name('register.store')->middleware('register.store');


// //=============logout=====================================================================================

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');




//============= QA Routes =========================================================================


//============= Dashboard =========================================================================

Route::get('/qa/dashboard', [QaController::class, 'dashboard'])->name('qa.dashboard')->middleware(['web', 'Qa']);


//============= Users =========================================================================

Route::get('/qa/users/view', [UsersController::class, 'users'])->name('qa.users.view')->middleware(['web', 'Qa']);

Route::get('/qa/users/form', [UsersController::class, 'usersform'])->name('qa.users.usersform')->middleware(['web', 'Qa']);

Route::post('/qa/users/form/create', [UsersController::class, 'create'])->name('qa.users.usersform.create')->middleware(['web', 'Qa']);

Route::get('/qa/users/singleView/{id}', [UsersController::class, 'single'])->name('qa.users.single')->middleware(['web', 'Qa']);

Route::get('/qa/users/edit/{id}', [UsersController::class, 'edit'])->name('qa.users.edit')->middleware(['web', 'Qa']);

Route::post('/qa/users/upate/{id}', [UsersController::class, 'update'])->name('qa.users.update')->middleware(['web', 'Qa']);

Route::get('/qa/users/delete/{id}', [UsersController::class, 'delete'])->name('qa.users.delete')->middleware(['web', 'Qa']);

// ========= Active, Deactive, Approve, Dis-approve ===========================================

Route::post('/qa/users/approve/{id}', [ApprovalController::class, 'approve'])->name('qa.users.approve')->middleware(['web', 'Qa']);

Route::post('/qa/users/disapprove/{id}', [ApprovalController::class, 'disapprove'])->name('qa.users.disapprove')->middleware(['web', 'Qa']);

Route::post('/qa/users/active/{id}', [Activationcontroller::class, 'active'])->name('qa.users.active')->middleware(['web', 'Qa']);

Route::post('/qa/users/deactive/{id}', [Activationcontroller::class, 'deactive'])->name('qa.users.deactive')->middleware(['web', 'Qa']);


//  ========= import and  export  excell sheets ===========================================

Route::get('/qa/users/export-excel', [ExcelController::class, 'export'])->name('qa.users.export.excel')->middleware(['web', 'Qa']);

Route::post('/qa/users/import-excel', [ExcelController::class, 'import'])->name('qa.users.import.excel')->middleware(['web', 'Qa']);



// ========= Policy Documents ===========================================

Route::get('/qa/document/policy/view', [DocumentController::class, 'policyview'])->name('qa.document.policy.view')->middleware(['web', 'Qa']);

Route::get('/qa/document/policy/form', [DocumentController::class, 'policyform'])->name('qa.document.policy.form')->middleware(['web', 'Qa']);

Route::post('/qa/document/policy/create', [DocumentController::class, 'policycreate'])->name('qa.document.policy.create')->middleware(['web', 'Qa']);

Route::get('/qa/document/policy/edit/{id}', [DocumentController::class, 'policyedit'])->name('qa.document.policy.edit')->middleware(['web', 'Qa']);

Route::post('/qa/document/policy/update/{id}', [DocumentController::class, 'policyupdate'])->name('qa.document.policy.update')->middleware(['web', 'Qa']);

Route::get('/qa/document/policy/delete/{id}', [DocumentController::class, 'policydelete'])->name('qa.document.policy.delete')->middleware(['web', 'Qa']);


// ================================================  SOPs  =======================================================

// ==================  QA  ===========================================

Route::get('/qa/sop/policy/view', [DocumentController::class, 'sopview'])->name('qa.document.sop.view')->middleware(['web', 'Qa']);

Route::get('/qa/sop/policy/form', [DocumentController::class, 'sopform'])->name('qa.document.sop.form')->middleware(['web', 'Qa']);

Route::post('/qa/sop/policy/create', [DocumentController::class, 'sopcreate'])->name('qa.document.sop.create')->middleware(['web', 'Qa']);

Route::get('/qa/sop/policy/edit/{id}', [DocumentController::class, 'sopedit'])->name('qa.document.sop.edit')->middleware(['web', 'Qa']);

Route::post('/qa/sop/policy/update/{id}', [DocumentController::class, 'sopupdate'])->name('qa.document.sop.update')->middleware(['web', 'Qa']);

Route::get('/qa/sop/policy/delete/{id}', [DocumentController::class, 'sopdelete'])->name('qa.document.sop.delete')->middleware(['web', 'Qa']);


// ==================  TS  ===========================================

Route::get('/ts/sop/policy/view', [DocumentController::class, 'tssopview'])->name('qa.document.sop.ts.view')->middleware(['web', 'Qa']);

Route::get('/ts/sop/policy/form', [DocumentController::class, 'tssopform'])->name('qa.document.sop.ts.form')->middleware(['web', 'Qa']);

Route::post('/ts/sop/policy/create', [DocumentController::class, 'tssopcreate'])->name('qa.document.sop.ts.create')->middleware(['web', 'Qa']);

Route::get('/ts/sop/policy/edit/{id}', [DocumentController::class, 'tssopedit'])->name('qa.document.sop.ts.edit')->middleware(['web', 'Qa']);

Route::post('/ts/sop/policy/update/{id}', [DocumentController::class, 'tssopupdate'])->name('qa.document.sop.ts.update')->middleware(['web', 'Qa']);

Route::get('/ts/sop/policy/delete/{id}', [DocumentController::class, 'tssopdelete'])->name('qa.document.sop.ts.delete')->middleware(['web', 'Qa']);


// ==================  SC  ===========================================

Route::get('/sc/sop/policy/view', [DocumentController::class, 'scsopview'])->name('qa.document.sop.sc.view')->middleware(['web', 'Qa']);

Route::get('/sc/sop/policy/form', [DocumentController::class, 'scsopform'])->name('qa.document.sop.sc.form')->middleware(['web', 'Qa']);

Route::post('/sc/sop/policy/create', [DocumentController::class, 'scsopcreate'])->name('qa.document.sop.sc.create')->middleware(['web', 'Qa']);

Route::get('/sc/sop/policy/edit/{id}', [DocumentController::class, 'scsopedit'])->name('qa.document.sop.sc.edit')->middleware(['web', 'Qa']);

Route::post('/sc/sop/policy/update/{id}', [DocumentController::class, 'scsopupdate'])->name('qa.document.sop.sc.update')->middleware(['web', 'Qa']);

Route::get('/sc/sop/policy/delete/{id}', [DocumentController::class, 'scsopdelete'])->name('qa.document.sop.sc.delete')->middleware(['web', 'Qa']);




// ========= Product Complaint ===========================================

Route::get('/qa/complaint/view', [ComplaintController::class, 'complaint'])->name('qa.complaint.view')->middleware(['web', 'Qa']);

Route::get('/qa/complaint/form', [ComplaintController::class, 'complaintform'])->name('qa.complaint.form')->middleware(['web', 'Qa']);

Route::post('/qa/complaint/create', [ComplaintController::class, 'create'])->name('qa.complaint.create')->middleware(['web', 'Qa']);

Route::get('/qa/complaint/edit/{id}', [ComplaintController::class, 'edit'])->name('qa.complaint.edit')->middleware(['web', 'Qa']);

Route::post('/qa/complaint/update/{id}', [ComplaintController::class, 'update'])->name('qa.complaint.update')->middleware(['web', 'Qa']);

Route::get('/qa/complaint/delete/{id}', [ComplaintController::class, 'delete'])->name('qa.complaint.delete')->middleware(['web', 'Qa']);

Route::get('/qa/complaint/read/{id}', [ComplaintController::class, 'markasread'])->name('qa.complaint.read')->middleware(['web', 'Qa']);


// ========= PDF Print and Download ===========================================

Route::get('/qa/complaint/print{id}', [PdfController::class, 'printComplaint'])->name('qa.complaint.print')->middleware(['web', 'Qa']);

Route::get('/qa/complaint/download/{id}', [PdfController::class, 'downloadComplaint'])->name('qa.complaint.download')->middleware(['web', 'Qa']);


// ========= Risk Assessment ===========================================

Route::get('/qa/risk/view', [RiskController::class, 'risk'])->name('qa.risk.view')->middleware(['web', 'Qa']);

Route::get('/qa/risk/form', [RiskController::class, 'riskform'])->name('qa.risk.form')->middleware(['web', 'Qa']);

Route::post('/qa/risk/create', [RiskController::class, 'create'])->name('qa.risk.create')->middleware(['web', 'Qa']);

Route::get('/qa/risk/edit/{id}', [RiskController::class, 'edit'])->name('qa.risk.edit')->middleware(['web', 'Qa']);

Route::post('/qa/risk/update/{id}', [RiskController::class, 'update'])->name('qa.risk.update')->middleware(['web', 'Qa']);

Route::get('/qa/risk/delete/{id}', [RiskController::class, 'delete'])->name('qa.risk.delete')->middleware(['web', 'Qa']);

Route::get('/qa/risk/verify/{id}', [RiskController::class, 'riskverify'])->name('qa.risk.verify')->middleware(['web', 'Qa']);

Route::get('/qa/risk/review/{id}', [RiskController::class, 'riskreview'])->name('qa.risk.review')->middleware(['web', 'Qa']);

Route::get('/qa/risk/approve/{id}', [RiskController::class, 'riskapprove'])->name('qa.risk.approve')->middleware(['web', 'Qa']);

// ========= PDF Print and Download ===========================================

Route::get('/qa/risk/print{id}', [PdfController::class, 'printRisk'])->name('qa.risk.print')->middleware(['web', 'Qa']);

Route::get('/qa/risk/download/{id}', [PdfController::class, 'downloadRisk'])->name('qa.risk.download')->middleware(['web', 'Qa']);



// ========= Customer Feedback ===========================================

Route::get('/qa/feedback/view', [FeedbackController::class, 'feedback'])->name('qa.feedback.view')->middleware(['web', 'Qa']);

Route::get('/qa/feedback/form', [FeedbackController::class, 'feedbackform'])->name('qa.feedback.form')->middleware(['web', 'Qa']);

Route::post('/qa/feedback/create', [FeedbackController::class, 'create'])->name('qa.feedback.create')->middleware(['web', 'Qa']);

Route::get('/qa/feedback/delete/{id}', [FeedbackController::class, 'delete'])->name('qa.feedback.delete')->middleware(['web', 'Qa']);

// ========= PDF Print and Download ===========================================

Route::get('/qa/feedback/print{id}', [PdfController::class, 'printFeedback'])->name('qa.feedback.print')->middleware(['web', 'Qa']);

Route::get('/qa/feedback/download/{id}', [PdfController::class, 'downloadFeedback'])->name('qa.feedback.download')->middleware(['web', 'Qa']);

//  ========= export excel sheets ===========================================

Route::get('/qa/feedback/export-excel', [ExcelController::class, 'exportfeedback'])->name('qa.feedback.export.excel')->middleware(['web', 'Qa']);








// ========= Management Review Agenda ===========================================

Route::get('/qa/mrm/agenda/view', [MrmController::class, 'agendaview'])->name('qa.mrm.agenda.view')->middleware(['web', 'Qa']);

Route::get('/qa/mrm/agenda/form', [MrmController::class, 'agendaform'])->name('qa.mrm.agenda.form')->middleware(['web', 'Qa']);

Route::post('/qa/mrm/agenda/create', [MrmController::class, 'agendacreate'])->name('qa.mrm.agenda.create')->middleware(['web', 'Qa']);

Route::get('/qa/mrm/agenda/edit/{id}', [MrmController::class, 'agendaedit'])->name('qa.mrm.agenda.edit')->middleware(['web', 'Qa']);

Route::post('/qa/mrm/agenda/update/{id}', [MrmController::class, 'agendaupdate'])->name('qa.mrm.agenda.update')->middleware(['web', 'Qa']);

Route::get('/qa/mrm/agenda/delete/{id}', [MrmController::class, 'agendadelete'])->name('qa.mrm.agenda.delete')->middleware(['web', 'Qa']);

Route::get('/qa/mrm/agenda/prepare/{id}', [MrmController::class, 'agendaprepare'])->name('qa.mrm.agenda.prepare')->middleware(['web', 'Qa']);

Route::get('/qa/mrm/agenda/approve/{id}', [MrmController::class, 'agendaapprove'])->name('qa.mrm.agenda.approve')->middleware(['web', 'Qa']);

Route::get('/qa/mrm/agenda/mail/{id}', [MailController::class, 'agendamail'])->name('qa.mrm.agenda.mail')->middleware(['web', 'Qa']);


// ========= PDF Print and Download ==============================================

Route::get('/qa/mrm/agenda/print{id}', [PdfController::class, 'printAgenda'])->name('qa.mrm.agenda.print')->middleware(['web', 'Qa']);

Route::get('/qa/mrm/agenda/download/{id}', [PdfController::class, 'downloadAgenda'])->name('qa.mrm.agenda.download')->middleware(['web', 'Qa']);




// ========= Management Review Minutes ===========================================

Route::get('/qa/mrm/minutes/view/{id}', [MrmController::class, 'minutesview'])->name('qa.mrm.minutes.view')->middleware(['web', 'Qa']);

Route::get('/qa/mrm/minutes/form/{id}', [MrmController::class, 'minutesform'])->name('qa.mrm.minutes.form')->middleware(['web', 'Qa']);

Route::post('/qa/mrm/minutes/create', [MrmController::class, 'minutescreate'])->name('qa.mrm.minutes.create')->middleware(['web', 'Qa']);

Route::get('/qa/mrm/minutes/edit/{id}', [MrmController::class, 'minutesedit'])->name('qa.mrm.minutes.edit')->middleware(['web', 'Qa']);

Route::post('/qa/mrm/minutes/update/{id}', [MrmController::class, 'minutesupdate'])->name('qa.mrm.minutes.update')->middleware(['web', 'Qa']);

Route::get('/qa/mrm/minutes/delete/{id}', [MrmController::class, 'minutesdelete'])->name('qa.mrm.minutes.delete')->middleware(['web', 'Qa']);

Route::get('/qa/mrm/minutes/prepare/{id}', [MrmController::class, 'minutesprepare'])->name('qa.mrm.minutes.prepare')->middleware(['web', 'Qa']);

Route::get('/qa/mrm/minutes/approve/{id}', [MrmController::class, 'minutesapprove'])->name('qa.mrm.minutes.approve')->middleware(['web', 'Qa']);

Route::get('/qa/mrm/minutes/mail/{id}', [MailController::class, 'minutesmail'])->name('qa.mrm.minutes.mail')->middleware(['web', 'Qa']);

// ========= PDF Print and Download ==============================================

Route::get('/qa/mrm/minutes/print{id}', [PdfController::class, 'printMinutes'])->name('qa.mrm.minutes.print')->middleware(['web', 'Qa']);

Route::get('/qa/mrm/minutes/download/{id}', [PdfController::class, 'downloadMinutes'])->name('qa.mrm.minutes.download')->middleware(['web', 'Qa']);



// ========= Management Review Attendance ===========================================

Route::get('/qa/mrm/attendance/view/{id}', [MrmController::class, 'attendanceview'])->name('qa.mrm.attendance.view')->middleware(['web', 'Qa']);

Route::get('/qa/mrm/attendance/form/{id}', [MrmController::class, 'attendanceform'])->name('qa.mrm.attendance.form')->middleware(['web', 'Qa']);

Route::post('/qa/mrm/attendance/create', [MrmController::class, 'attendancecreate'])->name('qa.mrm.attendance.create')->middleware(['web', 'Qa']);

Route::get('/qa/mrm/attendance/prepare/{id}', [MrmController::class, 'attendanceprepare'])->name('qa.mrm.attendance.prepare')->middleware('Qa');

Route::get('/qa/mrm/attendance/edit/{id}', [MrmController::class, 'attendanceedit'])->name('qa.mrm.attendance.edit')->middleware(['web', 'Qa']);

Route::post('/qa/mrm/attendance/update/{id}', [MrmController::class, 'attendanceupdate'])->name('qa.mrm.attendance.update')->middleware(['web', 'Qa']);

Route::get('/qa/mrm/attendance/delete/{id}', [MrmController::class, 'attendancedelete'])->name('qa.mrm.attendance.delete')->middleware(['web', 'Qa']);

// ========= PDF Print and Download ==============================================

Route::get('/qa/mrm/attendance/print{id}', [PdfController::class, 'printAttendance'])->name('qa.mrm.attendance.print')->middleware(['web', 'Qa']);

Route::get('/qa/mrm/attendance/download/{id}', [PdfController::class, 'downloadAttendance'])->name('qa.mrm.attendance.download')->middleware(['web', 'Qa']);







// ========= Internal Audit Schedule ===========================================

Route::get('/qa/internalaudit/schedule/view', [InternalAuditController::class, 'scheduleview'])->name('qa.ia.schedule.view')->middleware(['web', 'Qa']);

Route::get('/qa/internalaudit/schedule/form', [InternalAuditController::class, 'scheduleform'])->name('qa.ia.schedule.form')->middleware(['web', 'Qa']);

Route::post('/qa/internalaudit/schedule/create', [InternalAuditController::class, 'schedulecreate'])->name('qa.ia.schedule.create')->middleware(['web', 'Qa']);

Route::get('/qa/internalaudit/schedule/prepare/{id}', [InternalAuditController::class, 'scheduleprepare'])->name('qa.ia.schedule.prepare')->middleware(['web', 'Qa']);

Route::get('/qa/internalaudit/schedule/approve/{id}', [InternalAuditController::class, 'scheduleapprove'])->name('qa.ia.schedule.approve')->middleware(['web', 'Qa']);

Route::get('/qa/internalaudit/schedule/edit/{id}', [InternalAuditController::class, 'scheduleedit'])->name('qa.ia.schedule.edit')->middleware(['web', 'Qa']);

Route::post('/qa/internalaudit/schedule/update/{id}', [InternalAuditController::class, 'scheduleupdate'])->name('qa.ia.schedule.update')->middleware(['web', 'Qa']);

Route::get('/qa/internalaudit/schedule/delete/{id}', [InternalAuditController::class, 'scheduledelete'])->name('qa.ia.schedule.delete')->middleware(['web', 'Qa']);

// ========= PDF Print and Download ==============================================

Route::get('/qa/internalaudit/schedule/print{id}', [PdfController::class, 'printIaSchedule'])->name('qa.ia.schedule.print')->middleware(['web', 'Qa']);

Route::get('/qa/internalaudit/schedule/download/{id}', [PdfController::class, 'downloadIaSchedule'])->name('qa.ia.schedule.download')->middleware(['web', 'Qa']);


// ========= Internal Audit Report ===========================================

Route::get('/qa/internalaudit/report/view', [InternalAuditController::class, 'reportview'])->name('qa.ia.report.view')->middleware(['web', 'Qa']);

Route::get('/qa/internalaudit/report/form', [InternalAuditController::class, 'reportform'])->name('qa.ia.report.form')->middleware(['web', 'Qa']);

Route::post('/qa/internalaudit/report/create', [InternalAuditController::class, 'reportcreate'])->name('qa.ia.report.create')->middleware(['web', 'Qa']);

Route::get('/qa/internalaudit/report/prepare/{id}', [InternalAuditController::class, 'reportprepare'])->name('qa.ia.report.prepare')->middleware(['web', 'Qa']);

Route::get('/qa/internalaudit/report/approve/{id}', [InternalAuditController::class, 'reportapprove'])->name('qa.ia.report.approve')->middleware(['web', 'Qa']);

Route::get('/qa/internalaudit/report/edit/{id}', [InternalAuditController::class, 'reportedit'])->name('qa.ia.report.edit')->middleware(['web', 'Qa']);

Route::post('/qa/internalaudit/report/update/{id}', [InternalAuditController::class, 'reportupdate'])->name('qa.ia.report.update')->middleware(['web', 'Qa']);

Route::get('/qa/internalaudit/report/delete/{id}', [InternalAuditController::class, 'reportdelete'])->name('qa.ia.report.delete')->middleware(['web', 'Qa']);

// ========= PDF Print and Download ==============================================

Route::get('/qa/internalaudit/report/print{id}', [PdfController::class, 'printIaReport'])->name('qa.ia.report.print')->middleware(['web', 'Qa']);

Route::get('/qa/internalaudit/report/download/{id}', [PdfController::class, 'downloadIaReport'])->name('qa.ia.report.download')->middleware(['web', 'Qa']);



// ========= Change Contorl Management ===========================================

Route::get('/qa/changecontrol/view', [ChangeControlController::class, 'changeview'])->name('qa.ccm.view')->middleware(['web', 'Qa']);

Route::get('/qa/changecontrol/form', [ChangeControlController::class, 'changeform'])->name('qa.ccm.form')->middleware(['web', 'Qa']);

Route::post('/qa/changecontrol/create', [ChangeControlController::class, 'changecreate'])->name('qa.ccm.create')->middleware(['web', 'Qa']);

Route::get('/qa/changecontrol/initiate/{id}', [ChangeControlController::class, 'changeinitiate'])->name('qa.ccm.initiate')->middleware(['web', 'Qa']);

Route::get('/qa/changecontrol/review/{id}', [ChangeControlController::class, 'changereview'])->name('qa.ccm.review')->middleware(['web', 'Qa']);

Route::get('/qa/changecontrol/approve/{id}', [ChangeControlController::class, 'changeapprove'])->name('qa.ccm.approve')->middleware(['web', 'Qa']);

Route::get('/qa/changecontrol/verify/{id}', [ChangeControlController::class, 'changeverify'])->name('qa.ccm.verify')->middleware(['web', 'Qa']);

Route::get('/qa/changecontrol/close/{id}', [ChangeControlController::class, 'changeclose'])->name('qa.ccm.close')->middleware(['web', 'Qa']);

Route::get('/qa/changecontrol/edit/{id}', [ChangeControlController::class, 'changeedit'])->name('qa.ccm.edit')->middleware(['web', 'Qa']);

Route::post('/qa/changecontrol/update/{id}', [ChangeControlController::class, 'changeupdate'])->name('qa.ccm.update')->middleware(['web', 'Qa']);

Route::get('/qa/changecontrol/delete/{id}', [ChangeControlController::class, 'changedelete'])->name('qa.ccm.delete')->middleware(['web', 'Qa']);

// ========= PDF Print and Download ==============================================

Route::get('/qa/changecontrol/print{id}', [PdfController::class, 'printForm'])->name('qa.ccm.print')->middleware('Qa');

Route::get('/qa/changecontrol/{id}', [PdfController::class, 'downloadForm'])->name('qa.ccm.download')->middleware('Qa');



// ========= Recall Information ===========================================

Route::get('/qa/recall/view', [RecallController::class, 'recallview'])->name('qa.recall.view')->middleware(['web', 'Qa']);

Route::get('/qa/recall/form', [RecallController::class, 'recallform'])->name('qa.recall.form')->middleware(['web', 'Qa']);

Route::post('/qa/recall/create', [RecallController::class, 'recallcreate'])->name('qa.recall.create')->middleware(['web', 'Qa']);

Route::get('/qa/recall/review/{id}', [RecallController::class, 'recallreview'])->name('qa.recall.review')->middleware(['web', 'Qa']);

Route::get('/qa/recall/approve/{id}', [RecallController::class, 'recallapprove'])->name('qa.recall.approve')->middleware(['web', 'Qa']);

Route::get('/qa/recall/edit/{id}', [RecallController::class, 'recalledit'])->name('qa.recall.edit')->middleware(['web', 'Qa']);

Route::post('/qa/recall/update/{id}', [RecallController::class, 'recallupdate'])->name('qa.recall.update')->middleware(['web', 'Qa']);

Route::get('/qa/recall/delete/{id}', [RecallController::class, 'recalldelete'])->name('qa.recall.delete')->middleware(['web', 'Qa']);

// ========= PDF Print and Download ==============================================

Route::get('/qa/recall/information/print{id}', [PdfController::class, 'printRecallInfo'])->name('qa.recall.info.print')->middleware(['web', 'Qa']);

Route::get('/qa/recall/information/download{id}', [PdfController::class, 'downloadRecallInfo'])->name('qa.recall.info.download')->middleware(['web', 'Qa']);



// ========= Recall Closure ===========================================

Route::get('/qa/closure/view', [RecallClosureController::class, 'closureview'])->name('qa.closure.view')->middleware(['web', 'Qa']);

Route::get('/qa/closure/form', [RecallClosureController::class, 'closureform'])->name('qa.closure.form')->middleware(['web', 'Qa']);

Route::post('/qa/closure/create', [RecallClosureController::class, 'closurecreate'])->name('qa.closure.create')->middleware(['web', 'Qa']);

Route::get('/qa/closure/review/{id}', [RecallClosureController::class, 'closurereview'])->name('qa.closure.review')->middleware(['web', 'Qa']);

Route::get('/qa/closure/approve/{id}', [RecallClosureController::class, 'closureapprove'])->name('qa.closure.approve')->middleware(['web', 'Qa']);

Route::get('/qa/closure/edit/{id}', [RecallClosureController::class, 'closureedit'])->name('qa.closure.edit')->middleware(['web', 'Qa']);

Route::post('/qa/closure/update/{id}', [RecallClosureController::class, 'closureupdate'])->name('qa.closure.update')->middleware(['web', 'Qa']);

Route::get('/qa/closure/delete/{id}', [RecallClosureController::class, 'closuredelete'])->name('qa.closure.delete')->middleware(['web', 'Qa']);

// ========= PDF Print and Download ==============================================

Route::get('/qa/closure/print{id}', [PdfController::class, 'printRecallClosure'])->name('qa.closure.print')->middleware('Qa');

Route::get('/qa/closure/download/{id}', [PdfController::class, 'downloadRecallClosure'])->name('qa.closure.download')->middleware('Qa');




// ========= Deviation Management ===========================================

Route::get('/qa/deviation/view', [DeviationController::class, 'view'])->name('qa.deviation.view')->middleware(['web', 'Qa']);

Route::get('/qa/deviation/form', [DeviationController::class, 'form'])->name('qa.deviation.form')->middleware(['web', 'Qa']);

Route::post('/qa/deviation/create', [DeviationController::class, 'create'])->name('qa.deviation.create')->middleware(['web', 'Qa']);

Route::get('/qa/deviation/edit/{id}', [DeviationController::class, 'edit'])->name('qa.deviation.edit')->middleware(['web', 'Qa']);

Route::post('/qa/deviation/update/{id}', [DeviationController::class, 'update'])->name('qa.deviation.update')->middleware(['web', 'Qa']);

Route::get('/qa/deviation/delete/{id}', [DeviationController::class, 'delete'])->name('qa.deviation.delete')->middleware(['web', 'Qa']);

Route::get('/qa/deviation/verify/{id}', [DeviationController::class, 'verify'])->name('qa.deviaiton.verify')->middleware('Qa');

Route::get('/qa/deviation/review/{id}', [DeviationController::class, 'review'])->name('qa.deviation.review')->middleware('Qa');

Route::get('/qa/deviation/approve/{id}', [DeviationController::class, 'approve'])->name('qa.deviation.approve')->middleware('Qa');

Route::get('/qa/deviation/committeeReview/{id}', [DeviationController::class, 'committeeReview'])->name('qa.deviation.creview')->middleware('Qa');

Route::get('/qa/deviation/confirm/{id}', [DeviationController::class, 'confirm'])->name('qa.deviation.confirm')->middleware('Qa');

Route::get('/qa/deviation/close/{id}', [DeviationController::class, 'close'])->name('qa.deviation.close')->middleware('Qa');

// ========= PDF Print and Download ==============================================

Route::get('/qa/deviation/print{id}', [PdfController::class, 'printDeviation'])->name('qa.deviation.print')->middleware('Qa');

Route::get('/qa/deviation/download/{id}', [PdfController::class, 'downloadDeviation'])->name('qa.deviation.download')->middleware('Qa');


// =================================== CAPA ===========================================

Route::get('/qa/capa/view', [CapaController::class, 'view'])->name('qa.capa.view')->middleware('Qa');

Route::get('/qa/capa/form', [CapaController::class, 'form'])->name('qa.capa.form')->middleware('Qa');

Route::post('/qa/capa/create', [CapaController::class, 'create'])->name('qa.capa.create')->middleware('Qa');

Route::get('/qa/capa/edit/{id}', [CapaController::class, 'edit'])->name('qa.capa.edit')->middleware('Qa');

Route::post('/qa/capa/update/{id}', [CapaController::class, 'update'])->name('qa.capa.update')->middleware('Qa');

Route::get('/qa/capa/delete/{id}', [CapaController::class, 'delete'])->name('qa.capa.delete')->middleware('Qa');

Route::get('/qa/capa/initiate/{id}', [CapaController::class, 'initiate'])->name('qa.capa.initiate')->middleware('Qa');

Route::get('/qa/capa/verify/{id}', [CapaController::class, 'verify'])->name('qa.capa.verify')->middleware('Qa');

Route::get('/qa/capa/review/{id}', [CapaController::class, 'review'])->name('qa.capa.review')->middleware('Qa');

Route::get('/qa/capa/approve/{id}', [CapaController::class, 'approve'])->name('qa.capa.approve')->middleware('Qa');

Route::get('/qa/capa/close/{id}', [CapaController::class, 'close'])->name('qa.capa.close')->middleware('Qa');

// ========= PDF Print and Download ==============================================

Route::get('/qa/capa/print{id}', [PdfController::class, 'printCapa'])->name('qa.capa.print')->middleware('Qa');

Route::get('/qa/capa/download/{id}', [PdfController::class, 'downloadCapa'])->name('qa.capa.download')->middleware('Qa');




// ========= Training Attendance  ===========================================

Route::get('/qa/training/attendance/view', [TrainingAndFeedbackController::class, 'triningAttendanceView'])->name('qa.training.attendance.view')->middleware('Qa');

Route::get('/qa/ts/training/attendance/view', [TrainingAndFeedbackController::class, 'TsTriningAttendanceView'])->name('qa.ts.training.attendance.view')->middleware('Qa');

Route::get('/qa/sc/training/attendance/view', [TrainingAndFeedbackController::class, 'ScTriningAttendanceView'])->name('qa.sc.training.attendance.view')->middleware('Qa');

Route::get('/qa/training/attendance/form', [TrainingAndFeedbackController::class, 'triningAttendanceForm'])->name('qa.training.attendance.form')->middleware('Qa');

Route::post('/qa/training/attendance/create', [TrainingAndFeedbackController::class, 'triningAttendanceCreate'])->name('qa.training.attendance.create')->middleware('Qa');

Route::get('/qa/training/attendance/trainersign/{id}', [TrainingAndFeedbackController::class, 'trinerAttendance'])->name('qa.training.attendance.trainersign')->middleware('Qa');

Route::get('/qa/training/attendance/traineesign/{id}', [TrainingAndFeedbackController::class, 'trineeAttendance'])->name('qa.training.attendance.traineesign')->middleware('Qa');

Route::get('/qa/training/attendance/edit/{id}', [TrainingAndFeedbackController::class, 'triningAttendanceEdit'])->name('qa.training.attendance.edit')->middleware('Qa');

Route::post('/qa/training/attendance/update/{id}', [TrainingAndFeedbackController::class, 'triningAttendanceUpdate'])->name('qa.training.attendance.update')->middleware('Qa');

Route::get('/qa/training/attendance/delete/{id}', [TrainingAndFeedbackController::class, 'triningAttendanceDelete'])->name('qa.training.attendance.delete')->middleware('Qa');

// ========= PDF Print and Download ==============================================

Route::get('/qa/training/attendance/print{id}', [PdfController::class, 'printTrainingAttendance'])->name('qa.training.attendance.print')->middleware('Qa');

Route::get('/qa/training/attendance/download/{id}', [PdfController::class, 'downloadTrainingAttendance'])->name('qa.training.attendance.download')->middleware('Qa');


// ========= Annual Training Plan   ===========================================

Route::get('/qa/training/plan/view', [TrainingAndFeedbackController::class, 'trainingPlanView'])->name('qa.training.plan.view')->middleware('Qa');

Route::get('/qa/ts/training/plan/view', [TrainingAndFeedbackController::class, 'TsTrainingPlanView'])->name('qa.ts.training.plan.view')->middleware('Qa');

Route::get('/qa/sc/training/plan/view', [TrainingAndFeedbackController::class, 'ScTrainingPlanView'])->name('qa.sc.training.plan.view')->middleware('Qa');

Route::get('/qa/training/plan/form', [TrainingAndFeedbackController::class, 'trainingPlanForm'])->name('qa.training.plan.form')->middleware('Qa');

Route::post('/qa/training/plan/create', [TrainingAndFeedbackController::class, 'trainingPlanCreate'])->name('qa.training.plan.create')->middleware('Qa');

Route::get('/qa/training/plan/edit/{id}', [TrainingAndFeedbackController::class, 'trainingPlanEdit'])->name('qa.training.plan.edit')->middleware('Qa');

Route::post('/qa/training/plan/update/{id}', [TrainingAndFeedbackController::class, 'trainingPlanUpdate'])->name('qa.training.plan.update')->middleware('Qa');

Route::get('/qa/training/plan/delete/{id}', [TrainingAndFeedbackController::class, 'trainingPlanDelete'])->name('qa.training.plan.delete')->middleware('Qa');

// ========= PDF Print and Download ==============================================

Route::get('/qa/training/plan/print{id}', [PdfController::class, 'printTrainingPlan'])->name('qa.training.plan.print')->middleware('Qa');

Route::get('/qa/training/plan/download/{id}', [PdfController::class, 'downloadTrainingPlan'])->name('qa.training.plan.download')->middleware('Qa');



// ========= New Employee Training Plan   ===========================================

Route::get('/qa/training/new-employee/view', [TrainingAndFeedbackController::class, 'newEmployeeTrainingView'])->name('qa.training.new-employee.view')->middleware('Qa');

Route::get('/qa/ts/training/new-employee/view', [TrainingAndFeedbackController::class, 'TsNewEmployeeTrainingView'])->name('qa.ts.training.new-employee.view')->middleware('Qa');

Route::get('/qa/sc/training/new-employee/view', [TrainingAndFeedbackController::class, 'ScNewEmployeeTrainingView'])->name('qa.sc.training.new-employee.view')->middleware('Qa');

Route::get('/qa/training/new-employee/form', [TrainingAndFeedbackController::class, 'newEmployeeTrainingForm'])->name('qa.training.new-employee.form')->middleware('Qa');

Route::post('/qa/training/new-employee/create', [TrainingAndFeedbackController::class, 'newEmployeeTrainingCreate'])->name('qa.training.new-employee.create')->middleware('Qa');

Route::get('/qa/training/new-employee/edit/{id}', [TrainingAndFeedbackController::class, 'newEmployeeTrainingEdit'])->name('qa.training.new-employee.edit')->middleware('Qa');

Route::post('/qa/training/new-employee/update/{id}', [TrainingAndFeedbackController::class, 'newEmployeeTrainingUpdate'])->name('qa.training.new-employee.update')->middleware('Qa');

Route::get('/qa/training/new-employee/delete/{id}', [TrainingAndFeedbackController::class, 'newEmployeeTrainingDelete'])->name('qa.training.new-employee.delete')->middleware('Qa');

// ========= PDF Print and Download ==============================================

Route::get('/qa/training/new-employee/print{id}', [PdfController::class, 'printNewEmployeeTraining'])->name('qa.training.new-employee.print')->middleware('Qa');

Route::get('/qa/training/plan/new-employee/{id}', [PdfController::class, 'downloadNewEmployeeTraining'])->name('qa.training.new-employee.download')->middleware('Qa');







// ============================================= Documentation Control ======================================================

// ========= Change Request ===========================================

Route::get('/qa/document-control/change-request/view', [DocumentationController::class, 'changeView'])->name('qa.doc-control.change.view')->middleware('Qa');

Route::get('/qa/ts/document-control/change-request/view', [DocumentationController::class, 'TschangeView'])->name('qa.ts.doc-control.change.view')->middleware('Qa');

Route::get('/qa/sc/document-control/change-request/view', [DocumentationController::class, 'ScchangeView'])->name('qa.sc.doc-control.change.view')->middleware('Qa');

Route::get('/qa/document-control/change-request/form', [DocumentationController::class, 'changeForm'])->name('qa.doc-control.change.form')->middleware('Qa');

Route::post('/qa/document-control/change-request/create', [DocumentationController::class, 'changeCreate'])->name('qa.doc-control.change.create')->middleware('Qa');

Route::get('/qa/document-control/change-request/edit/{id}', [DocumentationController::class, 'changeEdit'])->name('qa.doc-control.change.edit')->middleware('Qa');

Route::post('/qa/document-control/change-request/update/{id}', [DocumentationController::class, 'changeUpdate'])->name('qa.doc-control.change.update')->middleware('Qa');

Route::get('/qa/document-control/change-request/delete/{id}', [DocumentationController::class, 'changeDelete'])->name('qa.doc-control.change.delete')->middleware('Qa');

Route::get('/qa/document-control/change-request/verify/{id}', [DocumentationController::class, 'changeVerify'])->name('qa.doc-control.change.verify')->middleware('Qa');

Route::get('/qa/document-control/change-request/approve/{id}', [DocumentationController::class, 'changeApprove'])->name('qa.doc-control.change.approve')->middleware('Qa');

// ========= PDF Print and Download ===========================================

Route::get('/qa/document-control/change-request/print{id}', [PdfController::class, 'printChange'])->name('qa.doc-control.change.print')->middleware('Qa');

Route::get('/qa/document-control/change-request/download/{id}', [PdfController::class, 'downloadChange'])->name('qa.doc-control.change.download')->middleware('Qa');



// ========= Number Issuance ===========================================

Route::get('/qa/document-control/issuance/view', [DocumentationController::class, 'issueView'])->name('qa.doc-control.issue.view')->middleware('Qa');

Route::get('/qa/ts/document-control/issuance/view', [DocumentationController::class, 'TsissueView'])->name('qa.ts.doc-control.issue.view')->middleware('Qa');

Route::get('/qa/sc/document-control/issuance/view', [DocumentationController::class, 'ScissueView'])->name('qa.sc.doc-control.issue.view')->middleware('Qa');

Route::get('/qa/document-control/issuance/form', [DocumentationController::class, 'issueForm'])->name('qa.doc-control.issue.form')->middleware('Qa');

Route::post('/qa/document-control/issuance/create', [DocumentationController::class, 'issueCreate'])->name('qa.doc-control.issue.create')->middleware('Qa');

Route::get('/qa/document-control/issuance/edit/{id}', [DocumentationController::class, 'issueEdit'])->name('qa.doc-control.issue.edit')->middleware('Qa');

Route::post('/qa/document-control/issuance/update/{id}', [DocumentationController::class, 'issueUpdate'])->name('qa.doc-control.issue.update')->middleware('Qa');

Route::get('/qa/document-control/issuance/delete/{id}', [DocumentationController::class, 'issueDelete'])->name('qa.doc-control.issue.delete')->middleware('Qa');

Route::get('/qa/document-control/issuance/verify/{id}', [DocumentationController::class, 'issueVerify'])->name('qa.doc-control.issue.verify')->middleware('Qa');

Route::get('/qa/document-control/issuance/review/{id}', [DocumentationController::class, 'issueReview'])->name('qa.doc-control.issue.review')->middleware('Qa');

Route::get('/qa/document-control/issuance/approve/{id}', [DocumentationController::class, 'issueApprove'])->name('qa.doc-control.issue.approve')->middleware('Qa');

// ========= PDF Print and Download ===========================================

Route::get('/qa/document-control/issuance/print{id}', [PdfController::class, 'printIssue'])->name('qa.doc-control.issue.print')->middleware('Qa');

Route::get('/qa/document-control/issuance/download/{id}', [PdfController::class, 'downloadIssue'])->name('qa.doc-control.issue.download')->middleware('Qa');



// ========= Obsolescence ===========================================

Route::get('/qa/document-control/obsolescence/view', [DocumentationController::class, 'obsolescenceView'])->name('qa.doc-control.obsolescence.view')->middleware('Qa');

Route::get('/qa/ts/document-control/obsolescence/view', [DocumentationController::class, 'TsobsolescenceView'])->name('qa.ts.doc-control.obsolescence.view')->middleware('Qa');

Route::get('/qa/sc/document-control/obsolescence/view', [DocumentationController::class, 'ScobsolescenceView'])->name('qa.sc.doc-control.obsolescence.view')->middleware('Qa');

Route::get('/qa/document-control/obsolescence/form', [DocumentationController::class, 'obsolescenceForm'])->name('qa.doc-control.obsolescence.form')->middleware('Qa');

Route::post('/qa/document-control/obsolescence/create', [DocumentationController::class, 'obsolescenceCreate'])->name('qa.doc-control.obsolescence.create')->middleware('Qa');

Route::get('/qa/document-control/obsolescence/edit/{id}', [DocumentationController::class, 'obsolescenceEdit'])->name('qa.doc-control.obsolescence.edit')->middleware('Qa');

Route::post('/qa/document-control/obsolescence/update/{id}', [DocumentationController::class, 'obsolescenceUpdate'])->name('qa.doc-control.obsolescence.update')->middleware('Qa');

Route::get('/qa/document-control/obsolescence/delete/{id}', [DocumentationController::class, 'obsolescenceDelete'])->name('qa.doc-control.obsolescence.delete')->middleware('Qa');

Route::get('/qa/document-control/obsolescence/verify/{id}', [DocumentationController::class, 'obsolescenceVerify'])->name('qa.doc-control.obsolescence.verify')->middleware('Qa');

Route::get('/qa/document-control/obsolescence/review/{id}', [DocumentationController::class, 'obsolescenceReview'])->name('qa.doc-control.obsolescence.review')->middleware('Qa');

Route::get('/qa/document-control/obsolescence/approve/{id}', [DocumentationController::class, 'obsolescenceApprove'])->name('qa.doc-control.obsolescence.approve')->middleware('Qa');

// ========= PDF Print and Download ===========================================

Route::get('/qa/document-control/obsolescence/print{id}', [PdfController::class, 'printObsolescence'])->name('qa.doc-control.obsolescence.print')->middleware('Qa');

Route::get('/qa/document-control/obsolescence/download/{id}', [PdfController::class, 'downloadObsolescence'])->name('qa.doc-control.obsolescence.download')->middleware('Qa');



// ========= Master Index - Internal ===========================================

Route::get('/qa/document-control/master-index/internal/view', [DocumentationController::class, 'internalView'])->name('qa.doc-control.mi-internal.view')->middleware('Qa');

Route::get('/qa/ts/document-control/master-index/internal/view', [DocumentationController::class, 'TsinternalView'])->name('qa.ts.doc-control.mi-internal.view')->middleware('Qa');

Route::get('/qa/sc/document-control/master-index/internal/view', [DocumentationController::class, 'ScinternalView'])->name('qa.sc.doc-control.mi-internal.view')->middleware('Qa');


















//==================================================== Director =========================================================================

Route::get('/director/dashboard', [DirectorController::class, 'dashboard'])->name('director.dashboard')->middleware('Director');


// =========================== Policy Documents ===========================================

Route::get('/director/document/policy/view', [DirectorDocumentController::class, 'policyview'])->name('director.document.policy.view')->middleware('Director');


// ================================================  SOPs  =======================================================

// ==================  QA  ===========================================
Route::get('/director/sop/policy/view', [DirectorDocumentController::class, 'sopview'])->name('director.document.sop.view')->middleware('Director');


// ==================  TS  ===========================================

Route::get('/director/ts/sop/policy/view', [DirectorDocumentController::class, 'tssopview'])->name('director.document.sop.ts.view')->middleware('Director');


// ==================  SC  ===========================================

Route::get('/director/sc/sop/policy/view', [DirectorDocumentController::class, 'scsopview'])->name('director.document.sop.sc.view')->middleware('Director');



// ========= Product Complaint ===========================================

Route::get('/director/complaint/view', [DirectorComplaintController::class, 'complaint'])->name('director.complaint.view')->middleware(['web', 'Director']);

// Route::get('/qa/complaint/read/{id}', [ComplaintController::class, 'markasread'])->name('qa.complaint.read')->middleware(['web', 'Qa']);

// ========= PDF Print and Download ===========================================

Route::get('/director/complaint/print{id}', [DirectorPdfController::class, 'printComplaint'])->name('director.complaint.print')->middleware(['web', 'Director']);

Route::get('/director/complaint/download/{id}', [DirectorPdfController::class, 'downloadComplaint'])->name('director.complaint.download')->middleware(['web', 'Director']);


// ========= Risk Assessment ===========================================

Route::get('/director/risk/view', [DirectorRiskController::class, 'risk'])->name('director.risk.view')->middleware(['web', 'Director']);

Route::get('/director/risk/approve/{id}', [DirectorRiskController::class, 'riskapprove'])->name('director.risk.approve')->middleware(['web', 'Director']);

// ========= PDF Print and Download ===========================================

Route::get('/director/risk/print{id}', [DirectorPdfController::class, 'printRisk'])->name('director.risk.print')->middleware(['web', 'Director']);

Route::get('/director/risk/download/{id}', [DirectorPdfController::class, 'downloadRisk'])->name('director.risk.download')->middleware(['web', 'Director']);

// ========= Customer Feedback ===========================================

Route::get('/director/feedback/view', [DirectorFeedbackController::class, 'feedback'])->name('director.feedback.view')->middleware(['web', 'Director']);

// ========= PDF Print and Download ===========================================

Route::get('/director/feedback/print{id}', [DirectorPdfController::class, 'printFeedback'])->name('director.feedback.print')->middleware(['web', 'Director']);

Route::get('/director/feedback/download/{id}', [DirectorPdfController::class, 'downloadFeedback'])->name('director.feedback.download')->middleware(['web', 'Director']);



// ========= Management Review Agenda ===========================================

Route::get('/director/mrm/agenda/view', [DirectorMrmController::class, 'agendaview'])->name('director.mrm.agenda.view')->middleware(['web', 'Director']);

Route::get('/director/mrm/agenda/approve/{id}', [DirectorMrmController::class, 'agendaapprove'])->name('director.mrm.agenda.approve')->middleware(['web', 'Director']);

// ========= PDF Print and Download ==============================================

Route::get('/director/mrm/agenda/print{id}', [DirectorPdfController::class, 'printAgenda'])->name('director.mrm.agenda.print')->middleware(['web', 'Director']);

Route::get('/director/mrm/agenda/download/{id}', [DirectorPdfController::class, 'downloadAgenda'])->name('director.mrm.agenda.download')->middleware(['web', 'Director']);


// ========= Management Review Minutes ===========================================

Route::get('/director/mrm/minutes/view/{id}', [DirectorMrmController::class, 'minutesview'])->name('director.mrm.minutes.view')->middleware(['web', 'Director']);

Route::get('/director/mrm/minutes/approve/{id}', [DirectorMrmController::class, 'minutesapprove'])->name('director.mrm.minutes.approve')->middleware(['web', 'Director']);


// ========= PDF Print and Download ==============================================

Route::get('/director/mrm/minutes/print{id}', [DirectorPdfController::class, 'printMinutes'])->name('director.mrm.minutes.print')->middleware(['web', 'Director']);

Route::get('/director/mrm/minutes/download/{id}', [DirectorPdfController::class, 'downloadMinutes'])->name('director.mrm.minutes.download')->middleware(['web', 'Director']);


// ========= Management Review Attendance ===========================================

Route::get('/director/mrm/attendance/view/{id}', [DirectorMrmController::class, 'attendanceview'])->name('director.mrm.attendance.view')->middleware(['web', 'Director']);

Route::get('/director/mrm/attendance/sign/{id}', [DirectorMrmController::class, 'attendancesign'])->name('director.mrm.attendance.sign')->middleware('Director');

// ========= PDF Print and Download ==============================================

Route::get('/director/mrm/attendance/print{id}', [DirectorPdfController::class, 'printAttendance'])->name('director.mrm.attendance.print')->middleware(['web', 'Director']);

Route::get('/director/mrm/attendance/download/{id}', [DirectorPdfController::class, 'downloadAttendance'])->name('director.mrm.attendance.download')->middleware(['web', 'Director']);


// ========= Internal Audit Schedule ===========================================

Route::get('/director/internalaudit/schedule/view', [DirectorInternalAuditController::class, 'scheduleview'])->name('director.ia.schedule.view')->middleware('Director');

Route::get('/director/internalaudit/schedule/approve/{id}', [DirectorInternalAuditController::class, 'scheduleapprove'])->name('director.ia.schedule.approve')->middleware('Director');

// ========= PDF Print and Download ==============================================

Route::get('/director/internalaudit/schedule/print{id}', [DirectorPdfController::class, 'printIaSchedule'])->name('director.ia.schedule.print')->middleware('Director');

Route::get('/director/internalaudit/schedule/download/{id}', [DirectorPdfController::class, 'downloadIaSchedule'])->name('director.ia.schedule.download')->middleware('Director');


// ========= Internal Audit Report ===========================================


Route::get('/director/internalaudit/report/view', [DirectorInternalAuditController::class, 'reportview'])->name('director.ia.report.view')->middleware('Director');

Route::get('/director/internalaudit/report/approve/{id}', [DirectorInternalAuditController::class, 'reportapprove'])->name('director.ia.report.approve')->middleware('Director');

// ========= PDF Print and Download ==============================================

Route::get('/director/internalaudit/report/print{id}', [DirectorPdfController::class, 'printIaReport'])->name('director.ia.report.print')->middleware('Director');

Route::get('/director/internalaudit/report/download/{id}', [DirectorPdfController::class, 'downloadIaReport'])->name('director.ia.report.download')->middleware('Director');



// ========= Recall Information ===========================================

Route::get('/director/recall/view', [DirectorRecallController::class, 'recallview'])->name('director.recall.view')->middleware('Director');

Route::get('/director/recall/approve/{id}', [DirectorRecallController::class, 'recallapprove'])->name('director.recall.approve')->middleware('Director');

// ========= PDF Print and Download ==============================================

Route::get('/director/recall/information/print{id}', [DirectorPdfController::class, 'printRecallInfo'])->name('director.recall.info.print')->middleware('Director');

Route::get('/director/recall/information/download{id}', [DirectorPdfController::class, 'downloadRecallInfo'])->name('director.recall.info.download')->middleware('Director');


// ========= Recall Closure ===========================================

Route::get('/director/closure/view', [DirectorRecallClosureController::class, 'closureview'])->name('director.closure.view')->middleware('Director');

Route::get('/director/closure/approve/{id}', [DirectorRecallClosureController::class, 'closureapprove'])->name('director.closure.approve')->middleware('Director');

// ========= PDF Print and Download ==============================================

Route::get('/director/closure/print{id}', [DirectorPdfController::class, 'printRecallClosure'])->name('director.closure.print')->middleware('Director');

Route::get('/director/closure/download/{id}', [DirectorPdfController::class, 'downloadRecallClosure'])->name('director.closure.download')->middleware('Director');

// ========= Change Contorl Management ===========================================

Route::get('/director/changecontrol/view', [DirectorChangeController::class, 'changeview'])->name('director.ccm.view')->middleware('Director');

Route::get('/director/changecontrol/approve/{id}', [DirectorChangeController::class, 'changeapprove'])->name('director.ccm.approve')->middleware('Director');

Route::get('/director/changecontrol/close/{id}', [DirectorChangeController::class, 'changeclose'])->name('director.ccm.close')->middleware('Director');


// ========= PDF Print and Download ==============================================

Route::get('/director/changecontrol/print{id}', [DirectorPdfController::class, 'printForm'])->name('director.ccm.print')->middleware('Director');

Route::get('/director/changecontrol/{id}', [DirectorPdfController::class, 'downloadForm'])->name('director.ccm.download')->middleware('Director');


// ========= Deviation Management ===========================================

Route::get('/director/deviation/view', [DirectorDeviationController::class, 'view'])->name('director.deviation.view')->middleware('Director');

Route::get('/director/deviation/approve/{id}', [DirectorDeviationController::class, 'approve'])->name('director.deviation.approve')->middleware('Director');

Route::get('/director/deviation/close/{id}', [DirectorDeviationController::class, 'close'])->name('director.deviation.close')->middleware('Director');

// ========= PDF Print and Download ==============================================

Route::get('/director/deviation/print{id}', [DirectorPdfController::class, 'printDeviation'])->name('director.deviation.print')->middleware('Director');

Route::get('/director/deviation/download/{id}', [DirectorPdfController::class, 'downloadDeviation'])->name('director.deviation.download')->middleware('Director');


// =================================== CAPA ===========================================

Route::get('/director/capa/view', [DirectorCapaController::class, 'view'])->name('director.capa.view')->middleware('Director');

Route::get('/director/capa/verify/{id}', [DirectorCapaController::class, 'verify'])->name('director.capa.verify')->middleware('Director');

Route::get('/director/capa/approve/{id}', [DirectorCapaController::class, 'approve'])->name('director.capa.approve')->middleware('Director');

Route::get('/director/capa/close/{id}', [DirectorCapaController::class, 'close'])->name('director.capa.close')->middleware('Director');

// ========= PDF Print and Download ==============================================

Route::get('/director/capa/print{id}', [DirectorPdfController::class, 'printCapa'])->name('director.capa.print')->middleware('Director');

Route::get('/director/capa/download/{id}', [DirectorPdfController::class, 'downloadCapa'])->name('director.capa.download')->middleware('Director');


// ========= Training Attendance  ===========================================

Route::get('/director/training/attendance/view', [DirectorTrainingAndFeedbackController::class, 'triningAttendanceView'])->name('director.training.attendance.view')->middleware('Director');

Route::get('/director/ts/training/attendance/view', [DirectorTrainingAndFeedbackController::class, 'TsTriningAttendanceView'])->name('director.ts.training.attendance.view')->middleware('Director');

Route::get('/director/sc/training/attendance/view', [DirectorTrainingAndFeedbackController::class, 'ScTriningAttendanceView'])->name('director.sc.training.attendance.view')->middleware('Director');

// ========= PDF Print and Download ==============================================

Route::get('/director/training/attendance/print{id}', [DirectorPdfController::class, 'printTrainingAttendance'])->name('director.training.attendance.print')->middleware('Director');

Route::get('/director/training/attendance/download/{id}', [DirectorPdfController::class, 'downloadTrainingAttendance'])->name('director.training.attendance.download')->middleware('Director');



// ========= Annual Training Plan   ===========================================

Route::get('/director/training/plan/view', [DirectorTrainingAndFeedbackController::class, 'trainingPlanView'])->name('director.training.plan.view')->middleware('Director');

Route::get('/director/ts/training/plan/view', [DirectorTrainingAndFeedbackController::class, 'TsTrainingPlanView'])->name('director.ts.training.plan.view')->middleware('Director');

Route::get('/director/sc/training/plan/view', [DirectorTrainingAndFeedbackController::class, 'ScTrainingPlanView'])->name('director.sc.training.plan.view')->middleware('Director');


// ========= PDF Print and Download ==============================================

Route::get('/director/training/plan/print{id}', [DirectorPdfController::class, 'printTrainingPlan'])->name('director.training.plan.print')->middleware('Director');

Route::get('/director/training/plan/download/{id}', [DirectorPdfController::class, 'downloadTrainingPlan'])->name('director.training.plan.download')->middleware('Director');



// // ========= New Employee Training Plan   ===========================================

Route::get('/director/training/new-employee/view', [DirectorTrainingAndFeedbackController::class, 'newEmployeeTrainingView'])->name('director.training.new-employee.view')->middleware('Director');

Route::get('/director/ts/training/new-employee/view', [DirectorTrainingAndFeedbackController::class, 'TsNewEmployeeTrainingView'])->name('director.ts.training.new-employee.view')->middleware('Director');

Route::get('/director/sc/training/new-employee/view', [DirectorTrainingAndFeedbackController::class, 'ScNewEmployeeTrainingView'])->name('director.sc.training.new-employee.view')->middleware('Director');

// ========= PDF Print and Download ==============================================

Route::get('/director/training/new-employee/print{id}', [DirectorPdfController::class, 'printNewEmployeeTraining'])->name('director.training.new-employee.print')->middleware('Director');

Route::get('/director/training/plan/new-employee/{id}', [DirectorPdfController::class, 'downloadNewEmployeeTraining'])->name('director.training.new-employee.download')->middleware('Director');







// ============================================= Documentation Control ======================================================

// ========= Change Request ===========================================

Route::get('/director/document-control/change-request/view', [DirectorDocumentationController::class, 'changeView'])->name('director.doc-control.change.view')->middleware('Director');

Route::get('/director/ts/document-control/change-request/view', [DirectorDocumentationController::class, 'TschangeView'])->name('director.ts.doc-control.change.view')->middleware('Director');

Route::get('/director/sc/document-control/change-request/view', [DirectorDocumentationController::class, 'ScchangeView'])->name('director.sc.doc-control.change.view')->middleware('Director');

Route::get('/director/document-control/change-request/approve/{id}', [DirectorDocumentationController::class, 'changeApprove'])->name('director.doc-control.change.approve')->middleware('Director');

// ========= PDF Print and Download ===========================================

Route::get('/director/document-control/change-request/print{id}', [DirectorPdfController::class, 'printChange'])->name('director.doc-control.change.print')->middleware('Director');

Route::get('/director/document-control/change-request/download/{id}', [DirectorPdfController::class, 'downloadChange'])->name('director.doc-control.change.download')->middleware('Director');




// ========= Number Issuance ===========================================

Route::get('/director/document-control/issuance/view', [DirectorDocumentationController::class, 'issueView'])->name('director.doc-control.issue.view')->middleware('Director');

Route::get('/director/ts/document-control/issuance/view', [DirectorDocumentationController::class, 'TsissueView'])->name('director.ts.doc-control.issue.view')->middleware('Director');

Route::get('/director/sc/document-control/issuance/view', [DirectorDocumentationController::class, 'ScissueView'])->name('director.sc.doc-control.issue.view')->middleware('Director');

Route::get('/director/document-control/issuance/approve/{id}', [DirectorDocumentationController::class, 'issueApprove'])->name('director.doc-control.issue.approve')->middleware('Director');

// ========= PDF Print and Download ===========================================

Route::get('/director/document-control/issuance/print{id}', [DirectorPdfController::class, 'printIssue'])->name('director.doc-control.issue.print')->middleware('Director');

Route::get('/director/document-control/issuance/download/{id}', [DirectorPdfController::class, 'downloadIssue'])->name('director.doc-control.issue.download')->middleware('Director');



// ========= Obsolescence ===========================================

Route::get('/director/document-control/obsolescence/view', [DirectorDocumentationController::class, 'obsolescenceView'])->name('director.doc-control.obsolescence.view')->middleware('Director');

Route::get('/director/ts/document-control/obsolescence/view', [DirectorDocumentationController::class, 'TsobsolescenceView'])->name('director.ts.doc-control.obsolescence.view')->middleware('Director');

Route::get('/director/sc/document-control/obsolescence/view', [DirectorDocumentationController::class, 'ScobsolescenceView'])->name('director.sc.doc-control.obsolescence.view')->middleware('Director');

Route::get('/director/document-control/obsolescence/approve/{id}', [DirectorDocumentationController::class, 'obsolescenceApprove'])->name('director.doc-control.obsolescence.approve')->middleware('Director');

// ========= PDF Print and Download ===========================================

Route::get('/director/document-control/obsolescence/print{id}', [DirectorPdfController::class, 'printObsolescence'])->name('director.doc-control.obsolescence.print')->middleware('Director');

Route::get('/director/document-control/obsolescence/download/{id}', [DirectorPdfController::class, 'downloadObsolescence'])->name('director.doc-control.obsolescence.download')->middleware('Director');


// ========= Master Index - Internal ===========================================

Route::get('/director/document-control/master-index/internal/view', [DirectorDocumentationController::class, 'internalView'])->name('director.doc-control.mi-internal.view')->middleware('Director');

Route::get('/director/ts/document-control/master-index/internal/view', [DirectorDocumentationController::class, 'TsinternalView'])->name('director.ts.doc-control.mi-internal.view')->middleware('Director');

Route::get('/director/sc/document-control/master-index/internal/view', [DirectorDocumentationController::class, 'ScinternalView'])->name('director.sc.doc-control.mi-internal.view')->middleware('Director');



























//==================================================== Manager =========================================================================

Route::get('/manager/dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard')->middleware(['web', 'Manager']);



// ========= Policy Documents ===========================================

Route::get('/m/document/policy/view', [ManagerDocumentController::class, 'policyview'])->name('m.document.policy.view')->middleware('Manager');



// ================================================  SOPs  =======================================================

// ==================  TS  ===========================================

Route::get('/m/ts/sop/view', [ManagerDocumentController::class, 'tssopview'])->name('m.document.sop.ts.view')->middleware('Manager');

Route::get('/m/ts/sop/form', [ManagerDocumentController::class, 'tssopform'])->name('m.document.sop.ts.form')->middleware(['Manager']);

Route::post('/m/ts/sop/create', [ManagerDocumentController::class, 'tssopcreate'])->name('m.document.sop.ts.create')->middleware(['Manager']);

Route::get('/m/ts/sop/edit/{id}', [ManagerDocumentController::class, 'tssopedit'])->name('m.document.sop.ts.edit')->middleware(['Manager']);

Route::post('/m/ts/sop/update/{id}', [ManagerDocumentController::class, 'tssopupdate'])->name('m.document.sop.ts.update')->middleware(['Manager']);

Route::get('/m/ts/sop/delete/{id}', [ManagerDocumentController::class, 'tssopdelete'])->name('m.document.sop.ts.delete')->middleware(['Manager']);


// ==================  SC  ===========================================

Route::get('/m/sc/sop/policy/view', [ManagerDocumentController::class, 'scsopview'])->name('m.document.sop.sc.view')->middleware('Manager');

Route::get('/m/sc/sop/form', [ManagerDocumentController::class, 'scsopform'])->name('m.document.sop.sc.form')->middleware(['Manager']);

Route::post('/m/sc/sop/create', [ManagerDocumentController::class, 'scsopcreate'])->name('m.document.sop.sc.create')->middleware(['Manager']);

Route::get('/m/sc/sop/edit/{id}', [ManagerDocumentController::class, 'scsopedit'])->name('m.document.sop.sc.edit')->middleware(['Manager']);

Route::post('/m/sc/sop/update/{id}', [ManagerDocumentController::class, 'scsopupdate'])->name('m.document.sop.sc.update')->middleware(['Manager']);

Route::get('/m/sc/sop/delete/{id}', [ManagerDocumentController::class, 'scsopdelete'])->name('m.document.sop.sc.delete')->middleware(['Manager']);




// ========= Product Complaint ===========================================

Route::get('/manager/complaint/view', [ManagerComplaintController::class, 'complaint'])->name('manager.complaint.view')->middleware('Manager');

Route::get('/manager/complaint/form', [ManagerComplaintController::class, 'complaintform'])->name('manager.complaint.form')->middleware(['web', 'Manager']);

Route::post('/manager/complaint/create', [ManagerComplaintController::class, 'create'])->name('manager.complaint.create')->middleware(['web', 'Manager']);

// Route::get('/qa/complaint/read/{id}', [ComplaintController::class, 'markasread'])->name('qa.complaint.read')->middleware(['web', 'Qa']);

// ========= PDF Print and Download ===========================================

Route::get('/manager/complaint/print{id}', [ManagerPdfController::class, 'printComplaint'])->name('manager.complaint.print')->middleware(['web', 'Manager']);

Route::get('/manager/complaint/download/{id}', [ManagerPdfController::class, 'downloadComplaint'])->name('manager.complaint.download')->middleware(['web', 'Manager']);




// ========= Risk Assessment ===========================================

Route::get('/manager/risk/view', [ManagerRiskController::class, 'risk'])->name('manager.risk.view')->middleware(['web', 'Manager']);

Route::get('/manager/risk/form', [ManagerRiskController::class, 'riskform'])->name('manager.risk.form')->middleware(['web', 'Manager']);

Route::post('/manager/risk/create', [ManagerRiskController::class, 'create'])->name('manager.risk.create')->middleware(['web', 'Manager']);

Route::get('/manager/risk/edit/{id}', [ManagerRiskController::class, 'edit'])->name('manager.risk.edit')->middleware(['web', 'Manager']);

Route::post('/manager/risk/update/{id}', [ManagerRiskController::class, 'update'])->name('manager.risk.update')->middleware(['web', 'Manager']);

Route::get('/manager/risk/verify/{id}', [ManagerRiskController::class, 'riskverify'])->name('manager.risk.verify')->middleware(['web', 'Manager']);

// ========= PDF Print and Download ===========================================

Route::get('/manager/risk/print{id}', [ManagerPdfController::class, 'printRisk'])->name('manager.risk.print')->middleware(['web', 'Manager']);

Route::get('/manager/risk/download/{id}', [ManagerPdfController::class, 'downloadRisk'])->name('manager.risk.download')->middleware(['web', 'Manager']);




// ========= Customer Feedback ===========================================


// ========= TS ===========================================
Route::get('/manager/ts/feedback/view', [ManagerFeedbackController::class, 'tsfeedback'])->name('m.ts.feedback.view')->middleware('Manager');


// ========= INS ===========================================
Route::get('/manager/ins/feedback/view', [ManagerFeedbackController::class, 'insfeedback'])->name('m.ins.feedback.view')->middleware('Manager');


// ========= IOL ===========================================
Route::get('/manager/iol/feedback/view', [ManagerFeedbackController::class, 'iolfeedback'])->name('m.iol.feedback.view')->middleware('Manager');


// ========= DE ===========================================
Route::get('/manager/de/feedback/view', [ManagerFeedbackController::class, 'defeedback'])->name('m.de.feedback.view')->middleware('Manager');


// ========= PDF Print and Download ===========================================

Route::get('/manager/feedback/print{id}', [ManagerPdfController::class, 'printFeedback'])->name('m.feedback.print')->middleware('Manager');

Route::get('/manager/feedback/download/{id}', [ManagerPdfController::class, 'downloadFeedback'])->name('m.feedback.download')->middleware('Manager');




// ========= Management Review Attendance ===========================================

Route::get('/manager/mrm/attendance/view', [ManagerMrmController::class, 'attendanceview'])->name('manager.mrm.attendance.view')->middleware('Manager');

Route::get('/manager/mrm/attendance/sign/{id}', [ManagerMrmController::class, 'attendancesign'])->name('manager.mrm.attendance.sign')->middleware('Manager');

// ========= PDF Print and Download ==============================================

Route::get('/manager/mrm/attendance/print{id}', [ManagerPdfController::class, 'printAttendance'])->name('manager.mrm.attendance.print')->middleware('Manager');





// ========= Change Contorl Management ===========================================

Route::get('/manager/changecontrol/view', [ManagerChangeController::class, 'changeview'])->name('manager.ccm.view')->middleware('Manager');

Route::get('/manager/changecontrol/verify/{id}', [ManagerChangeController::class, 'changeverify'])->name('manager.ccm.verify')->middleware('Manager');

Route::get('/manager/changecontrol/review/{id}', [ManagerChangeController::class, 'changereview'])->name('manager.ccm.review')->middleware('Manager');

Route::get('/manager/changecontrol/edit/{id}', [ManagerChangeController::class, 'changeedit'])->name('manager.ccm.edit')->middleware('Manager');

Route::post('/manager/changecontrol/update/{id}', [ManagerChangeController::class, 'changeupdate'])->name('manager.ccm.update')->middleware('Manager');

Route::get('/manager/changecontrol/delete/{id}', [ManagerChangeController::class, 'changedelete'])->name('manager.ccm.delete')->middleware('Manager');

// ========= PDF Print and Download ==============================================

Route::get('/manager/changecontrol/print{id}', [ManagerPdfController::class, 'printForm'])->name('manager.ccm.print')->middleware('Manager');

Route::get('/manager/changecontrol/{id}', [ManagerPdfController::class, 'downloadForm'])->name('manager.ccm.download')->middleware('Manager');


// ========= Deviation Management ===========================================

Route::get('/manager/deviation/view', [ManagerDeviationController::class, 'view'])->name('manager.deviation.view')->middleware('Manager');

Route::get('/manager/deviation/form', [ManagerDeviationController::class, 'form'])->name('manager.deviation.form')->middleware('Manager');

Route::post('/manager/deviation/create', [ManagerDeviationController::class, 'create'])->name('manager.deviation.create')->middleware('Manager');

Route::get('/manager/deviation/edit/{id}', [ManagerDeviationController::class, 'edit'])->name('manager.deviation.edit')->middleware('Manager');

Route::post('/manager/deviation/update/{id}', [ManagerDeviationController::class, 'update'])->name('manager.deviation.update')->middleware('Manager');

Route::get('/manager/deviation/delete/{id}', [ManagerDeviationController::class, 'delete'])->name('manager.deviation.delete')->middleware('Manager');

Route::get('/manager/deviation/verify/{id}', [ManagerDeviationController::class, 'verify'])->name('manager.deviaiton.verify')->middleware('Manager');

Route::get('/manager/deviation/committeeReview/{id}', [ManagerDeviationController::class, 'committeeReview'])->name('manager.deviation.creview')->middleware('Manager');

Route::get('/manager/deviation/confirm/{id}', [ManagerDeviationController::class, 'confirm'])->name('manager.deviation.confirm')->middleware('Manager');

// ========= PDF Print and Download ==============================================

Route::get('/manager/deviation/print{id}', [ManagerPdfController::class, 'printDeviation'])->name('manager.deviation.print')->middleware('Manager');

Route::get('/manager/deviation/download/{id}', [ManagerPdfController::class, 'downloadDeviation'])->name('manager.deviation.download')->middleware('Manager');



// =================================== CAPA ===========================================

Route::get('/manager/capa/view', [ManagerCapaController::class, 'view'])->name('manager.capa.view')->middleware('Manager');

Route::get('/manager/capa/form', [ManagerCapaController::class, 'form'])->name('manager.capa.form')->middleware('Manager');

Route::post('/manager/capa/create', [ManagerCapaController::class, 'create'])->name('manager.capa.create')->middleware('Manager');

Route::get('/manager/capa/edit/{id}', [ManagerCapaController::class, 'edit'])->name('manager.capa.edit')->middleware('Manager');

Route::post('/manager/capa/update/{id}', [ManagerCapaController::class, 'update'])->name('manager.capa.update')->middleware('Manager');

Route::get('/manager/capa/delete/{id}', [ManagerCapaController::class, 'delete'])->name('manager.capa.delete')->middleware('Manager');

Route::get('/manager/capa/verify/{id}', [ManagerCapaController::class, 'verify'])->name('manager.capa.verify')->middleware('Manager');

// ========= PDF Print and Download ==============================================

Route::get('/manager/capa/print{id}', [ManagerPdfController::class, 'printCapa'])->name('manager.capa.print')->middleware('Manager');

Route::get('/manager/capa/download/{id}', [ManagerPdfController::class, 'downloadCapa'])->name('manager.capa.download')->middleware('Manager');




// ========= Training Attendance  ===========================================

Route::get('/manager/training/attendance/view', [ManagerTrainingAndFeedbackController::class, 'TriningAttendanceView'])
    ->name('manager.training.attendance.view')
    ->middleware('Manager');

Route::get('/manager/training/attendance/form', [ManagerTrainingAndFeedbackController::class, 'triningAttendanceForm'])
    ->name('manager.training.attendance.form')
    ->middleware('Manager');

Route::post('/manager/training/attendance/create', [ManagerTrainingAndFeedbackController::class, 'triningAttendanceCreate'])
    ->name('manager.training.attendance.create')
    ->middleware('Manager');

Route::get('/manager/training/attendance/trainersign/{id}', [ManagerTrainingAndFeedbackController::class, 'trinerAttendance'])
    ->name('manager.training.attendance.trainersign')
    ->middleware('Manager');

Route::get('/manager/training/attendance/traineesign/{id}', [ManagerTrainingAndFeedbackController::class, 'trineeAttendance'])
    ->name('manager.training.attendance.traineesign')
    ->middleware('Manager');

Route::get('/manager/training/attendance/edit/{id}', [ManagerTrainingAndFeedbackController::class, 'triningAttendanceEdit'])
    ->name('manager.training.attendance.edit')
    ->middleware('Manager');

Route::post('/manager/training/attendance/update/{id}', [ManagerTrainingAndFeedbackController::class, 'triningAttendanceUpdate'])
    ->name('manager.training.attendance.update')
    ->middleware('Manager');

Route::get('/manager/training/attendance/delete/{id}', [ManagerTrainingAndFeedbackController::class, 'triningAttendanceDelete'])
    ->name('manager.training.attendance.delete')
    ->middleware('Manager');

// ========= PDF Print and Download ==============================================

Route::get('/manager/training/attendance/print/{id}', [ManagerPdfController::class, 'printTrainingAttendance'])
    ->name('manager.training.attendance.print')
    ->middleware('Manager');

Route::get('/manager/training/attendance/download/{id}', [ManagerPdfController::class, 'downloadTrainingAttendance'])
    ->name('manager.training.attendance.download')
    ->middleware('Manager');



// ========= Annual Training Plan   ===========================================

Route::get('/manager/training/plan/view', [ManagerTrainingAndFeedbackController::class, 'trainingPlanView'])->name('manager.training.plan.view')->middleware('Manager');

Route::get('/manager/training/plan/form', [ManagerTrainingAndFeedbackController::class, 'trainingPlanForm'])->name('manager.training.plan.form')->middleware('Manager');

Route::post('/manager/training/plan/create', [ManagerTrainingAndFeedbackController::class, 'trainingPlanCreate'])->name('manager.training.plan.create')->middleware('Manager');

Route::get('/manager/training/plan/edit/{id}', [ManagerTrainingAndFeedbackController::class, 'trainingPlanEdit'])->name('manager.training.plan.edit')->middleware('Manager');

Route::post('/manager/training/plan/update/{id}', [ManagerTrainingAndFeedbackController::class, 'trainingPlanUpdate'])->name('manager.training.plan.update')->middleware('Manager');

Route::get('/manager/training/plan/delete/{id}', [ManagerTrainingAndFeedbackController::class, 'trainingPlanDelete'])->name('manager.training.plan.delete')->middleware('Manager');

// ========= PDF Print and Download ==============================================

Route::get('/manager/training/plan/print{id}', [ManagerPdfController::class, 'printTrainingPlan'])->name('manager.training.plan.print')->middleware('Manager');

Route::get('/manager/training/plan/download/{id}', [ManagerPdfController::class, 'downloadTrainingPlan'])->name('manager.training.plan.download')->middleware('Manager');



// // ========= New Employee Training Plan   ===========================================

Route::get('/manager/training/new-employee/view', [ManagerTrainingAndFeedbackController::class, 'newEmployeeTrainingView'])->name('manager.training.new-employee.view')->middleware('Manager');

Route::get('/manager/training/new-employee/form', [ManagerTrainingAndFeedbackController::class, 'newEmployeeTrainingForm'])->name('manager.training.new-employee.form')->middleware('Manager');

Route::post('/manager/training/new-employee/create', [ManagerTrainingAndFeedbackController::class, 'newEmployeeTrainingCreate'])->name('manager.training.new-employee.create')->middleware('Manager');

Route::get('/manager/training/new-employee/edit/{id}', [ManagerTrainingAndFeedbackController::class, 'newEmployeeTrainingEdit'])->name('manager.training.new-employee.edit')->middleware('Manager');

Route::post('/manager/training/new-employee/update/{id}', [ManagerTrainingAndFeedbackController::class, 'newEmployeeTrainingUpdate'])->name('manager.training.new-employee.update')->middleware('Manager');

Route::get('/manager/training/new-employee/delete/{id}', [ManagerTrainingAndFeedbackController::class, 'newEmployeeTrainingDelete'])->name('manager.training.new-employee.delete')->middleware('Manager');

// ========= PDF Print and Download ==============================================

Route::get('/manager/training/new-employee/print{id}', [ManagerPdfController::class, 'printNewEmployeeTraining'])->name('manager.training.new-employee.print')->middleware('Manager');

Route::get('/manager/training/plan/new-employee/{id}', [ManagerPdfController::class, 'downloadNewEmployeeTraining'])->name('manager.training.new-employee.download')->middleware('Manager');






// ============================================= Documentation Control ======================================================

// ========= Change Request ===========================================

Route::get('/manager/document-control/change-request/view', [ManagerDocumentationController::class, 'changeView'])->name('manager.doc-control.change.view')->middleware('Manager');

Route::get('/manager/document-control/change-request/form', [ManagerDocumentationController::class, 'changeForm'])->name('manager.doc-control.change.form')->middleware('Manager');

Route::post('/manager/document-control/change-request/create', [ManagerDocumentationController::class, 'changeCreate'])->name('manager.doc-control.change.create')->middleware('Manager');

Route::get('/manager/document-control/change-request/edit/{id}', [ManagerDocumentationController::class, 'changeEdit'])->name('manager.doc-control.change.edit')->middleware('Manager');

Route::post('/manager/document-control/change-request/update/{id}', [ManagerDocumentationController::class, 'changeUpdate'])->name('manager.doc-control.change.update')->middleware('Manager');

Route::get('/manager/document-control/change-request/delete/{id}', [ManagerDocumentationController::class, 'changeDelete'])->name('manager.doc-control.change.delete')->middleware('Manager');

Route::get('/manager/document-control/change-request/verify/{id}', [ManagerDocumentationController::class, 'changeVerify'])->name('manager.doc-control.change.verify')->middleware('Manager');

Route::get('/manager/document-control/change-request/approve/{id}', [ManagerDocumentationController::class, 'changeApprove'])->name('manager.doc-control.change.approve')->middleware('Manager');

// ========= PDF Print and Download ===========================================

Route::get('/manager/document-control/change-request/print{id}', [ManagerPdfController::class, 'printChange'])->name('manager.doc-control.change.print')->middleware('Manager');

Route::get('/manager/document-control/change-request/download/{id}', [ManagerPdfController::class, 'downloadChange'])->name('manager.doc-control.change.download')->middleware('Manager');




// ========= Number Issuance ===========================================

Route::get('/manager/document-control/issuance/view', [ManagerDocumentationController::class, 'issueView'])->name('manager.doc-control.issue.view')->middleware('Manager');

Route::get('/manager/document-control/issuance/form', [ManagerDocumentationController::class, 'issueForm'])->name('manager.doc-control.issue.form')->middleware('Manager');

Route::post('/manager/document-control/issuance/create', [ManagerDocumentationController::class, 'issueCreate'])->name('manager.doc-control.issue.create')->middleware('Manager');

Route::get('/manager/document-control/issuance/edit/{id}', [ManagerDocumentationController::class, 'issueEdit'])->name('manager.doc-control.issue.edit')->middleware('Manager');

Route::post('/manager/document-control/issuance/update/{id}', [ManagerDocumentationController::class, 'issueUpdate'])->name('manager.doc-control.issue.update')->middleware('Manager');

Route::get('/manager/document-control/issuance/delete/{id}', [ManagerDocumentationController::class, 'issueDelete'])->name('manager.doc-control.issue.delete')->middleware('Manager');

Route::get('/manager/document-control/issuance/verify/{id}', [ManagerDocumentationController::class, 'issueVerify'])->name('manager.doc-control.issue.verify')->middleware('Manager');

// ========= PDF Print and Download ===========================================

Route::get('/manager/document-control/issuance/print{id}', [ManagerPdfController::class, 'printIssue'])->name('manager.doc-control.issue.print')->middleware('Manager');

Route::get('/manager/document-control/issuance/download/{id}', [ManagerPdfController::class, 'downloadIssue'])->name('manager.doc-control.issue.download')->middleware('Manager');




// ========= Obsolescence ===========================================

Route::get('/manager/document-control/obsolescence/view', [ManagerDocumentationController::class, 'obsolescenceView'])->name('manager.doc-control.obsolescence.view')->middleware('Manager');

Route::get('/manager/document-control/obsolescence/form', [ManagerDocumentationController::class, 'obsolescenceForm'])->name('manager.doc-control.obsolescence.form')->middleware('Manager');

Route::post('/manager/document-control/obsolescence/create', [ManagerDocumentationController::class, 'obsolescenceCreate'])->name('manager.doc-control.obsolescence.create')->middleware('Manager');

Route::get('/manager/document-control/obsolescence/edit/{id}', [ManagerDocumentationController::class, 'obsolescenceEdit'])->name('manager.doc-control.obsolescence.edit')->middleware('Manager');

Route::post('/manager/document-control/obsolescence/update/{id}', [ManagerDocumentationController::class, 'obsolescenceUpdate'])->name('manager.doc-control.obsolescence.update')->middleware('Manager');

Route::get('/manager/document-control/obsolescence/delete/{id}', [ManagerDocumentationController::class, 'obsolescenceDelete'])->name('manager.doc-control.obsolescence.delete')->middleware('Manager');

Route::get('/manager/document-control/obsolescence/verify/{id}', [ManagerDocumentationController::class, 'obsolescenceVerify'])->name('manager.doc-control.obsolescence.verify')->middleware('Manager');

// ========= PDF Print and Download ===========================================

Route::get('/manager/document-control/obsolescence/print{id}', [ManagerPdfController::class, 'printObsolescence'])->name('manager.doc-control.obsolescence.print')->middleware('Manager');

Route::get('/manager/document-control/obsolescence/download/{id}', [ManagerPdfController::class, 'downloadObsolescence'])->name('manager.doc-control.obsolescence.download')->middleware('Manager');



// ========= Master Index - Internal ===========================================

Route::get('/manager/document-control/master-index/internal/view', [ManagerDocumentationController::class, 'internalView'])->name('manager.doc-control.mi-internal.view')->middleware('Manager');

































//==================================================== Officer =========================================================================

Route::get('/officer/dashboard', [OfficerController::class, 'dashboard'])->name('officer.dashboard')->middleware(['web', 'Officer']);



// ================================================  SOPs  =======================================================

// ==================  TS  ===========================================

Route::get('/o/ts/sop/policy/view', [OfficerDocumentController::class, 'tssopview'])->name('o.document.sop.ts.view')->middleware('Officer');


// ==================  SC  ===========================================

Route::get('/o/sc/sop/policy/view', [OfficerDocumentController::class, 'scsopview'])->name('o.document.sop.sc.view')->middleware('Officer');



// ========= Product Complaint ===========================================

Route::get('/officer/complaint/form', [OfficerComplaintController::class, 'complaintform'])->name('officer.complaint.form')->middleware(['web', 'Officer']);

Route::post('/officer/complaint/create', [OfficerComplaintController::class, 'create'])->name('officer.complaint.create')->middleware(['web', 'Officer']);

// Route::get('/qa/complaint/read/{id}', [ComplaintController::class, 'markasread'])->name('qa.complaint.read')->middleware(['web', 'Qa']);


// ========= Risk Assessment ===========================================

Route::get('/officer/risk/view', [OfficerRiskController::class, 'risk'])->name('officer.risk.view')->middleware(['web', 'Officer']);

Route::get('/officer/risk/form', [OfficerRiskController::class, 'riskform'])->name('officer.risk.form')->middleware(['web', 'Officer']);

Route::post('/officer/risk/create', [OfficerRiskController::class, 'create'])->name('officer.risk.create')->middleware(['web', 'Officer']);

Route::get('/officer/risk/edit/{id}', [OfficerRiskController::class, 'edit'])->name('officer.risk.edit')->middleware(['web', 'Officer']);

Route::post('/officer/risk/update/{id}', [OfficerRiskController::class, 'update'])->name('officer.risk.update')->middleware(['web', 'Officer']);

// ========= PDF Print and Download ===========================================

Route::get('/officer/risk/print{id}', [OfficerPdfController::class, 'printRisk'])->name('officer.risk.print')->middleware(['web', 'Officer']);

Route::get('/officer/risk/download/{id}', [OfficerPdfController::class, 'downloadRisk'])->name('officer.risk.download')->middleware(['web', 'Officer']);


// ========= Change Contorl Management ===========================================

Route::get('/officer/changecontrol/view', [OfficerChangeController::class, 'changeview'])->name('officer.ccm.view')->middleware('Officer');

Route::get('/officer/changecontrol/form', [OfficerChangeController::class, 'changeform'])->name('officer.ccm.form')->middleware('Officer');

Route::post('/officer/changecontrol/create', [OfficerChangeController::class, 'changecreate'])->name('officer.ccm.create')->middleware('Officer');

Route::get('/officer/changecontrol/initiate/{id}', [OfficerChangeController::class, 'changeinitiate'])->name('officer.ccm.initiate')->middleware('Officer');

Route::get('/officer/changecontrol/edit/{id}', [OfficerChangeController::class, 'changeedit'])->name('officer.ccm.edit')->middleware('Officer');

Route::post('/officer/changecontrol/update/{id}', [OfficerChangeController::class, 'changeupdate'])->name('officer.ccm.update')->middleware('Officer');

Route::get('/officer/changecontrol/delete/{id}', [OfficerChangeController::class, 'changedelete'])->name('officer.ccm.delete')->middleware('Officer');

// ========= PDF Print and Download ==============================================

Route::get('/officer/changecontrol/print{id}', [OfficerPdfController::class, 'printForm'])->name('officer.ccm.print')->middleware('Officer');

Route::get('/officer/changecontrol/{id}', [OfficerPdfController::class, 'downloadForm'])->name('officer.ccm.download')->middleware('officer');


// ========= Deviation Management ===========================================

Route::get('/officer/deviation/view', [OfficerDeviationController::class, 'view'])->name('officer.deviation.view')->middleware(['web', 'Officer']);

Route::get('/officer/deviation/form', [OfficerDeviationController::class, 'form'])->name('officer.deviation.form')->middleware(['web', 'Officer']);

Route::post('/officer/deviation/create', [OfficerDeviationController::class, 'create'])->name('officer.deviation.create')->middleware(['web', 'Officer']);

Route::get('/officer/deviation/edit/{id}', [OfficerDeviationController::class, 'edit'])->name('officer.deviation.edit')->middleware(['web', 'Officer']);

Route::post('/officer/deviation/update/{id}', [OfficerDeviationController::class, 'update'])->name('officer.deviation.update')->middleware(['web', 'Officer']);

// ========= PDF Print and Download ==============================================

Route::get('/officer/deviation/print{id}', [OfficerPdfController::class, 'printDeviation'])->name('officer.deviation.print')->middleware('Officer');

Route::get('/officer/deviation/download/{id}', [OfficerPdfController::class, 'downloadDeviation'])->name('officer.deviation.download')->middleware('Officer');




// =================================== CAPA ===========================================

Route::get('/officer/capa/view', [OfficerCapaController::class, 'view'])->name('officer.capa.view')->middleware('Officer');

Route::get('/officer/capa/form', [OfficerCapaController::class, 'form'])->name('officer.capa.form')->middleware('Officer');

Route::post('/officer/capa/create', [OfficerCapaController::class, 'create'])->name('officer.capa.create')->middleware('Officer');

Route::get('/officer/capa/edit/{id}', [OfficerCapaController::class, 'edit'])->name('officer.capa.edit')->middleware('Officer');

Route::post('/officer/capa/update/{id}', [OfficerCapaController::class, 'update'])->name('officer.capa.update')->middleware('Officer');

Route::get('/officer/capa/delete/{id}', [OfficerCapaController::class, 'delete'])->name('officer.capa.delete')->middleware('Officer');

Route::get('/officer/capa/initiate/{id}', [OfficerCapaController::class, 'initiate'])->name('officer.capa.initiate')->middleware('Officer');

// ========= PDF Print and Download ==============================================

Route::get('/officer/capa/print{id}', [OfficerPdfController::class, 'printCapa'])->name('officer.capa.print')->middleware('Officer');

Route::get('/officer/capa/download/{id}', [OfficerPdfController::class, 'downloadCapa'])->name('officer.capa.download')->middleware('Officer');





// ========= Training Attendance  ===========================================

Route::get('/officer/training/attendance/view', [OfficerTrainingAndFeedbackController::class, 'triningAttendanceView'])
    ->name('officer.training.attendance.view')
    ->middleware('Officer');

Route::get('/officer/training/attendance/traineesign/{id}', [OfficerTrainingAndFeedbackController::class, 'trineeAttendance'])
    ->name('officer.training.attendance.traineesign')
    ->middleware('Officer');


// ========= PDF Print and Download ==============================================

Route::get('/officer/training/attendance/print/{id}', [OfficerPdfController::class, 'printTrainingAttendance'])
    ->name('officer.training.attendance.print')
    ->middleware('Officer');

Route::get('/officer/training/attendance/download/{id}', [OfficerPdfController::class, 'downloadTrainingAttendance'])
    ->name('officer.training.attendance.download')
    ->middleware('Officer');



// ============================================= Documentation Control ======================================================

// ========= Change Request ===========================================

Route::get('/officer/document-control/change-request/view', [OfficerDocumentationController::class, 'changeView'])->name('officer.doc-control.change.view')->middleware('Officer');

Route::get('/officer/document-control/change-request/form', [OfficerDocumentationController::class, 'changeForm'])->name('officer.doc-control.change.form')->middleware('Officer');

Route::post('/officer/document-control/change-request/create', [OfficerDocumentationController::class, 'changeCreate'])->name('officer.doc-control.change.create')->middleware('Officer');

Route::get('/officer/document-control/change-request/edit/{id}', [OfficerDocumentationController::class, 'changeEdit'])->name('officer.doc-control.change.edit')->middleware('Officer');

Route::post('/officer/document-control/change-request/update/{id}', [OfficerDocumentationController::class, 'changeUpdate'])->name('officer.doc-control.change.update')->middleware('Officer');

// ========= PDF Print and Download ===========================================

Route::get('/officer/document-control/change-request/print{id}', [OfficerPdfController::class, 'printChange'])->name('officer.doc-control.change.print')->middleware('Officer');

Route::get('/officer/document-control/change-request/download/{id}', [OfficerPdfController::class, 'downloadChange'])->name('officer.doc-control.change.download')->middleware('Officer');









// ========= Number Issuance ===========================================

Route::get('/officer/document-control/issuance/view', [OfficerDocumentationController::class, 'issueView'])->name('officer.doc-control.issue.view')->middleware('Officer');

Route::get('/officer/document-control/issuance/form', [OfficerDocumentationController::class, 'issueForm'])->name('officer.doc-control.issue.form')->middleware('Officer');

Route::post('/officer/document-control/issuance/create', [OfficerDocumentationController::class, 'issueCreate'])->name('officer.doc-control.issue.create')->middleware('Officer');

Route::get('/officer/document-control/issuance/edit/{id}', [OfficerDocumentationController::class, 'issueEdit'])->name('officer.doc-control.issue.edit')->middleware('Officer');

Route::post('/officer/document-control/issuance/update/{id}', [OfficerDocumentationController::class, 'issueUpdate'])->name('officer.doc-control.issue.update')->middleware('Officer');

// ========= PDF Print and Download ===========================================

Route::get('/officer/document-control/issuance/print{id}', [OfficerPdfController::class, 'printIssue'])->name('officer.doc-control.issue.print')->middleware('Officer');

Route::get('/officer/document-control/issuance/download/{id}', [OfficerPdfController::class, 'downloadIssue'])->name('officer.doc-control.issue.download')->middleware('Officer');















// ========= Obsolescence ===========================================

Route::get('/officer/document-control/obsolescence/view', [OfficerDocumentationController::class, 'obsolescenceView'])->name('officer.doc-control.obsolescence.view')->middleware('Officer');

Route::get('/officer/document-control/obsolescence/form', [OfficerDocumentationController::class, 'obsolescenceForm'])->name('officer.doc-control.obsolescence.form')->middleware('Officer');

Route::post('/officer/document-control/obsolescence/create', [OfficerDocumentationController::class, 'obsolescenceCreate'])->name('officer.doc-control.obsolescence.create')->middleware('Officer');

Route::get('/officer/document-control/obsolescence/edit/{id}', [OfficerDocumentationController::class, 'obsolescenceEdit'])->name('officer.doc-control.obsolescence.edit')->middleware('Officer');

Route::post('/officer/document-control/obsolescence/update/{id}', [OfficerDocumentationController::class, 'obsolescenceUpdate'])->name('officer.doc-control.obsolescence.update')->middleware('Officer');

// ========= PDF Print and Download ===========================================

Route::get('/officer/document-control/obsolescence/print{id}', [OfficerPdfController::class, 'printObsolescence'])->name('officer.doc-control.obsolescence.print')->middleware('Officer');

Route::get('/officer/document-control/obsolescence/download/{id}', [OfficerPdfController::class, 'downloadObsolescence'])->name('officer.doc-control.obsolescence.download')->middleware('Officer');








// ========= Master Index - Internal ===========================================

Route::get('/officer/document-control/master-index/internal/view', [OfficerDocumentationController::class, 'internalView'])->name('officer.doc-control.mi-internal.view')->middleware('Officer');
























//==================================================== Guest =========================================================================

// ========= Customer Feedback ===========================================

Route::get('/guest/feedback/form', [GuestFeedbackController::class, 'feedbackform'])->name('guest.feedback.add');

Route::post('/guest/feedback/create', [GuestFeedbackController::class, 'create'])->name('guest.feedback.create')->middleware(['web']);






// ====================== remove Web middleware =====================
    // as this is already assigned by laravel to web routes


// ================================ in case if no route is selected ================================

// Route::fallback(function () {
//     // ...
// });


// ======= Route Groups =====
// Middleware
// Controllers
// Route Prefixes
// Route Name Prefixes


// ======= Same Middleware for two different Roles =====

// Route::put('/post/{id}', function (string $id) {
//     // ...
// })->middleware('role:editor,publisher');


// debug = false for production environment
