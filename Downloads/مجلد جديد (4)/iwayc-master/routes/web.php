<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoController;


Route::get('theme',[HomeController::class,'theme'])->name('theme');

Route::prefix('profile')->name('profile.')->middleware('auth')->group(function () {
    Route::get('/',[ProfileController::class,'index'])->name('index');
    Route::get('/edit',[ProfileController::class,'edit'])->name('edit');
    Route::put('/update',[ProfileController::class,'update'])->name('update');
    Route::put('/update-password',[ProfileController::class,'update_password'])->name('update-password');
    Route::put('/update-phone',[ProfileController::class,'update_phone'])->name('update-phone');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    });

     //logo
   // Route::resource('Logo', 'LogoController');
   Route::prefix('logo')->name('logo.')->middleware('auth')->group(function () {
    Route::get('/',[LogoController::class,'index'])->name('index');
    Route::get('/edit',[LogoController::class,'edit'])->name('edit');
    Route::put('/update_image_icon1',[LogoController::class,'update_image_icon1'])->name('update_image_icon1');
    Route::put('/update_image_icon2',[LogoController::class,'update_image_icon2'])->name('update_image_icon2');
    Route::delete('/Logo', [LogoController::class, 'destroy'])->name('Logo.destroy');
});


    Route::get('/markAsRead', function(){
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('mark');
Route::prefix('CMS')->middleware('auth')->group(function () {

    //home
    Route::get('datatables/QMoney', 'HomeController@anyQueryMoney');

    Route::prefix('Menu')->group(function () {
        Route::get('{parent_id}', 'MenuController@getIndex');
        Route::get('add/{parent_id}', 'MenuController@getAdd');
        Route::post('add/{parent_id}', 'MenuController@postAdd');
        Route::get('show/{parent_id}', 'MenuController@getShow');
        Route::get('edit/{parent_id}', 'MenuController@getEdit');
        Route::post('edit/{parent_id}', 'MenuController@postEdit');
        Route::get('delete/{parent_id}', 'MenuController@getDelete');
        Route::get('showMenu/{parent_id}', 'MenuController@getShowMenu');
        Route::get('active/{parent_id}', 'MenuController@getActive');
        Route::get('ordered/{id}/{ord}', 'MenuController@getOrdered');

    });

Route::prefix('User')->group(function () {
        Route::get('', 'UserController@getIndex');
        Route::get('add', 'UserController@getAdd');
        Route::post('add', 'UserController@postAdd');
        Route::get('edit/{parent_id}', 'UserController@getEdit');
        Route::post('edit/{parent_id}', 'UserController@postEdit');
        Route::get('show/{parent_id}', 'UserController@getShow')->name('user.show');
        Route::get('delete/{parent_id}', 'UserController@getDelete');
        Route::get('permission/{parent_id}', 'UserController@getPermission');
        Route::post('permission/{parent_id}', 'UserController@postPermission');
        Route::get('perm/{parent_id}', 'UserController@getPerm');
        Route::post('perm/{parent_id}', 'UserController@postPerm');
        Route::post('permm/{parent_id}', 'UserController@postPermm');
        Route::get('active/{parent_id}', 'UserController@getActive');
    });


Route::prefix('Option')->group(function () {
        Route::get('{parent_id}', 'OptionController@getIndex');
        Route::get('add/{parent_id}', 'OptionController@getAdd');
        Route::post('add/{parent_id}', 'OptionController@postAdd');
        Route::get('show/{parent_id}', 'OptionController@getShow');
        Route::get('edit/{parent_id}', 'OptionController@getEdit');
        Route::post('edit/{parent_id}', 'OptionController@postEdit');
        Route::get('delete/{parent_id}', 'OptionController@getDelete');
        Route::get('active/{parent_id}', 'OptionController@getActive');
});


Route::get('datatables/Money', 'ActiveMethodController@anyMoney');
Route::resource('Money', 'MoneyYearController');
Route::get('Money/active/{id}', 'ActiveMethodController@getActiveMoney');
Route::get('Money/work/{id}', 'ActiveMethodController@getWorkMoney');
Route::get('delete/Money/{id}', 'MoneyYearController@getDelete');

Route::get('yearOfUser/{id}', 'ActiveMethodController@getUserYear');
Route::get('Section/{id}', 'ActiveMethodController@getSection');


Route::resource('english','English\EnglishController');
Route::get('datatables/English', 'English\EnglishController@anyEnglish');
Route::get('English/active/{id}', 'English\EnglishController@getActiveEnglish');
Route::get('delete/English/{id}', 'English\EnglishController@getDelete');


Route::resource('EnglishReg', 'English\EnglishRegController');
Route::get('datatables/EnglishReg', 'ActiveMethodController@anyEnglishReg');
Route::get('datatables/EnglishRegEnd', 'ActiveMethodController@anyEnglishRegEnd');
Route::get('EnglishRegEnd', 'English\EnglishRegController@getEnd');
Route::get('datatables/EnglishLevel', 'ActiveMethodController@anyEnglishLevel');
Route::get('pass/EnglishReg/{id}', 'English\EnglishRegController@isPass');
Route::get('withdrawal/EnglishReg/{id}', 'English\EnglishRegController@isWithdrawal');
Route::get('delete/EnglishReg/{id}', 'English\EnglishRegController@isDelete');
Route::get('add/EnglishReg/{id}', 'English\EnglishRegController@getEnglishReg');

// student controller
Route::get('datatables/Student', 'ActiveMethodController@anyStudent');
Route::get('datatables/YearStudent','ActiveMethodController@anyYearStudent');
Route::get('datatables/StudentRep', 'ActiveMethodController@anyStudentRep');
Route::get('student/StudentRep/{id}', 'ActiveMethodController@getStudentRep');
Route::resource('Student', 'StudentController');
Route::get('Student/active/{id}', 'ActiveMethodController@getActiveStudent');
Route::get('delete/Student/{id}', 'StudentController@getDelete');
Route::get('student/Student', 'StudentController@getStudent');
Route::get('YearStudents', 'StudentController@getYearStudents');


Route::get('datatables/CourseReport', 'ActiveMethodController@anyCourseReport');
Route::get('course/CourseReport/{id}', 'ActiveMethodController@getCourseReport');
Route::get('Rep/Course', 'CourseController@getCourseReport');
Route::get('datatables/Course', 'ActiveMethodController@anyCourse');
Route::get('datatables/TeacherC', 'ActiveMethodController@anyTeacherC');
Route::get('datatables/CourseReg', 'ActiveMethodController@anyCourseReg');



// teacher controller
Route::get('datatables/Teacher', 'ActiveMethodController@anyTeacher');
Route::resource('Teacher', 'TeacherController');
Route::get('Teacher/active/{id}', 'ActiveMethodController@getActiveTeacher');
Route::get('delete/Teacher/{id}', 'TeacherController@getDelete');



// Employee controller
Route::get('datatables/Employee', 'ActiveMethodController@anyEmployee');
Route::get('datatables/EmployeeS', 'ActiveMethodController@anyEmployeeSalary');
Route::resource('Employee', 'EmployeeController');
Route::get('Employee/active/{id}', 'ActiveMethodController@getActiveEmployee');
Route::get('Employee/smoke/{id}', 'ActiveMethodController@getSmokeEmployee');
Route::get('delete/Employee/{id}', 'EmployeeController@getDelete');
Route::get('salary/Employee', 'EmployeeController@getEmployeeSalary')->name('employee.salary');
Route::get('salary/Emp/{id}', 'EmployeeController@getEmpSalary');


// Archive controller
Route::get('datatables/Archive', 'ActiveMethodController@anyArchive');
Route::resource('Archive', 'ArchiveController');
Route::get('Archive/active/{id}', 'ActiveMethodController@getActiveArchive');
Route::get('delete/Archive/{id}', 'ArchiveController@getDelete');

// Certificate controller
Route::get('datatables/Certificate', 'ActiveMethodController@anyCertificate');
Route::get('datatables/oldCertificate', 'ActiveMethodController@anyOldCertificate');
Route::get('datatables/sharingCertificate', 'ActiveMethodController@anySharingCertificate');
Route::get('datatables/appreciationCertificate', 'ActiveMethodController@anyAppreciationCertificate');
Route::get('datatables/internationalCertificate', 'ActiveMethodController@anyInternationalCertificate');
Route::get('Certificate/Print/{id}/{opt}', 'ActiveMethodController@getPrintCertificate');
Route::resource('Certificate', 'CertificateController');
Route::get('delete/Certificate/{id}', 'CertificateController@getDelete');
Route::get('CertificateFilter', 'CertificateController@getYearFilter');
Route::get('RStudent/{id}', 'ActiveMethodController@getRStudent');
Route::get('TypeStudent/{type}', 'ActiveMethodController@getTypeStudent');


Route::get('datatables/LevelUp', 'ActiveMethodController@anyLevelUp');
Route::get('add/LevelUp/{id}', 'English\LevelUpController@getAdd');
Route::post('add/LevelUp', 'English\LevelUpController@postAdd');
Route::resource('LevelUp', 'English\LevelUpController');


Route::get('datatables/EnglishSal', 'ActiveMethodController@anyEnglishSal');
Route::resource('EnglishSal', 'English\EnglishSalController');
Route::get('delete/EnglishSal/{id}', 'English\EnglishSalController@isDelete');
Route::get('EnglishSal/Res/{id}/{opt}', 'ActiveMethodController@getResEnglishSal');




Route::get('datatables/Quota', 'ActiveMethodController@anyQuota');
Route::resource('Quota', 'QuotaController');
Route::get('delete/Quota/{id}', 'QuotaController@getDelete');
Route::get('QuotaFilter', 'QuotaController@getYearFilter');



Route::get('datatables/Absence', 'ActiveMethodController@anyAbsence');
Route::resource('Absence', 'AbsenceController');
Route::get('Absence/Out/{id}', 'ActiveMethodController@getOutAbsence');
Route::get('Absence/In/{id}', 'ActiveMethodController@getInAbsence');
Route::get('delete/Absence/{id}', 'AbsenceController@getDelete');


Route::get('datatables/AbsenceT', 'ActiveMethodController@anyAbsenceT');
Route::resource('AbsenceT', 'AbsenceTController');
Route::get('delete/AbsenceT/{id}', 'AbsenceTController@getDelete');
Route::get('AbsenceTFilter', 'AbsenceTController@getYearFilter');
Route::get('TCourse/{id}', 'ActiveMethodController@getTCourse');


Route::get('datatables/AbsenceS', 'ActiveMethodController@anyAbsenceS');
Route::resource('AbsenceS', 'AbsenceSController');
Route::get('delete/AbsenceS/{id}', 'AbsenceSController@getDelete');
Route::get('AbsenceSFilter', 'AbsenceSController@getYearFilter');
Route::get('SCourse/{id}', 'ActiveMethodController@getSCourse');



// شؤون الطلبه
Route::resource('Course', 'CourseController');
Route::get('Course/active/{id}', 'ActiveMethodController@getActiveCourse');
Route::get('Course/tratio/{id}', 'CourseController@getTeacherRatio');
Route::post('Course/tratio/{id}', 'CourseController@postTeacherRatio');
Route::get('delete/Course/{id}', 'CourseController@getDelete');
Route::get('teacher/Co/{id}', 'CourseController@getTeacherCo');
Route::get('CourseFilter', 'CourseController@getYearFilter');

Route::get('datatables/StudentCourseRep', 'ActiveMethodController@anyStudentCourseRep');
Route::get('student/StudentCourseRep', 'StudentCourseController@getStudent');
Route::get('course/StudentCourseRep/{id}', 'ActiveMethodController@getCourseRep');
Route::get('datatables/StudentCourse', 'ActiveMethodController@anyStudentCourse');
Route::get('withdrawal/StudentCourse/{id}', 'StudentCourseController@isWithdrawal');
Route::get('delete/StudentCourse/{id}', 'StudentCourseController@isDelete');
Route::get('add/StudentCourse/{id}', 'ActiveMethodController@getStudentCourse');
Route::post('add/StudentCourse/{id}', 'ActiveMethodController@postStudentCourse');
Route::resource('StudentCourse', 'StudentCourseController');
Route::get('StudentCourseFilter', 'StudentCourseController@getYearFilter');
Route::get('RStudentCourse/{id}', 'ActiveMethodController@getRStudentCourse');

// شؤون المعلمين
Route::get('teacher/Course', 'CourseController@getTeacherFees');
Route::get('datatables/ReceiptCourse', 'ActiveMethodController@anyReceiptCourse');
Route::resource('ReceiptCourse', 'ReceiptCourseController');
Route::get('delete/ReceiptCourse/{id}', 'ReceiptCourseController@getDelete');
Route::get('ReceiptCourseFilter', 'ReceiptCourseController@getYearFilter');
Route::get('RTeacher/{id}', 'ActiveMethodController@getRTeacher');
Route::get('datatables/QueryTeacher', 'QueryRepController@anyQueryTeacher');
Route::get('QueryTeacher', 'QueryRepController@getTeacher');
// الماليه
Route::get('datatables/Course', 'ActiveMethodController@anyCourse');
Route::get('course/CourseReport/{id}', 'ActiveMethodController@getCourseReport');
Route::get('Rep/Course', 'CourseController@getCourseReport');
Route::get('datatables/CourseReport', 'ActiveMethodController@anyCourseReport');
Route::get('datatables/CourseReg', 'ActiveMethodController@anyCourseReg');

// التسويق
Route::get('datatables/Offer', 'ActiveMethodController@anyOffer');
Route::resource('Offer', 'OfferController');
Route::get('Offer/active/{id}', 'ActiveMethodController@getActiveOffer');
Route::get('delete/Offer/{id}', 'OfferController@getDelete');
Route::get('datatables/Campaign', 'ActiveMethodController@anyCampaign');
Route::resource('Campaign', 'CampaignController');
Route::get('Campaign/active/{id}', 'ActiveMethodController@getActiveCampaign');
Route::get('delete/Campaign/{id}', 'CampaignController@getDelete');
Route::get('datatables/CampaignStudent', 'ActiveMethodController@anyCampaignStudent');
Route::get('delete/CampaignStudent/{id}', 'CampaignStudentController@getDelete');
Route::get('read/CampaignStudent/{id}', 'CampaignStudentController@getRead');
Route::get('CampaignStudent/{id}', 'CampaignStudentController@getIndex');
Route::get('getAll/CampaignStudent/{id}', 'CampaignStudentController@getAll');
Route::get('CampaignStudent/{id}/edit', 'CampaignStudentController@getEdit');
Route::post('CampaignStudent/{id}/edit', 'CampaignStudentController@postEdit');
Route::get('datatables/HowHear', 'ActiveMethodController@anyHowToHear');
Route::get('howToHear', 'StudentController@getHowToHear');


//  ادارة المهام العام
Route::get('datatables/Task', 'ActiveMethodController@anyTask');
Route::get('datatables/MyTask', 'ActiveMethodController@myTask');
Route::get('datatables/UserTask', 'ActiveMethodController@anyUserTask');
Route::get('datatables/AllUserTask', 'ActiveMethodController@allUserTask');
Route::get('datatables/AllEndTask', 'ActiveMethodController@allEndTask');
Route::get('datatables/EndTask', 'ActiveMethodController@anyEndTask');
Route::get('datatables/EndMyTask', 'ActiveMethodController@anyMyEndTask');
Route::get('datatables/RepTask', 'ActiveMethodController@anyRepTask');
Route::resource('Task', 'TaskController');
Route::get('Task/active/{id}', 'ActiveMethodController@getActiveTask');
Route::get('End/Task', 'TaskController@getEndTask');
Route::get('Rep/Task', 'TaskController@getRepTask');
Route::get('Report/Task/{id}', 'ActiveMethodController@getTaskRep');
Route::get('Sender/Task', 'TaskController@getUserTask');
Route::get('My/Task', 'TaskController@getMyTask');
Route::get('MyEnd/Task', 'TaskController@getEndMyTask');
Route::get('ShowMy/Task/{id}', 'TaskController@showMyTask');
Route::get('Task/startT/{id}', 'TaskController@getStart');
Route::get('Task/endT/{id}', 'TaskController@getEnd');
Route::post('Task/endTnotfy', 'TaskController@getEndnotify');
Route::post('Task/reminderTask', 'TaskController@reminderTask');
Route::post('Task/endTshow', 'TaskController@getEndshow');
Route::get('Task/ratio/{id}', 'TaskController@getRatio');
Route::post('Task/ratio/{id}', 'TaskController@postRatio');
Route::get('delete/Task/{id}', 'TaskController@getDelete');


// Withdrawal Controller
Route::get('Type/{id}', 'ActiveMethodController@getType');
Route::get('datatables/Withdrawal', 'ActiveMethodController@anyWithdrawal');
Route::resource('Withdrawal', 'WithdrawalController');
Route::get('delete/Withdrawal/{id}', 'WithdrawalController@getDelete');
Route::get('add/Withdrawal/{id}', 'WithdrawalController@getAdd');
Route::get('WithdrawalFilter', 'WithdrawalController@getYearFilter');


// ReceiptStudent Controller
Route::get('datatables/ReceiptStudent', 'ActiveMethodController@anyReceiptStudent');
Route::resource('ReceiptStudent', 'ReceiptStudentController');
Route::get('delete/ReceiptStudent/{id}', 'ReceiptStudentController@getDelete');
Route::get('add/ReceiptStudent/{id}', 'ReceiptStudentController@getCreate');
Route::get('ReceiptStudentFilter', 'ReceiptStudentController@getYearFilter');


//شؤون الموظفين
// ReceiptSalary Controller
        Route::get('IncomeBox/{id}', 'ActiveMethodController@getIncomeBox');
        Route::get('ExpenseBox/{id}', 'ActiveMethodController@getExpenseBox');
        Route::get('datatables/ReceiptSalary', 'ActiveMethodController@anyReceiptSalary');
        Route::resource('ReceiptSalary', 'ReceiptSalaryController');
        Route::get('delete/ReceiptSalary/{id}', 'ReceiptSalaryController@getDelete');
        Route::get('MonthSalary/{id}', 'ActiveMethodController@getMonthSalary');
        Route::get('MSalary/{id}', 'ActiveMethodController@getMSalary');
        Route::get('MMSalary/{id}', 'ActiveMethodController@getMMSalary');

//ReceiptAdvance Controller
        Route::get('datatables/ReceiptAdvance', 'ActiveMethodController@anyReceiptAdvance');
        Route::resource('ReceiptAdvance', 'ReceiptAdvanceController');
        Route::get('delete/ReceiptAdvance/{id}', 'ReceiptAdvanceController@getDelete');

//ReceiptReward Controller
        Route::get('datatables/ReceiptReward', 'ActiveMethodController@anyReceiptReward');
        Route::resource('ReceiptReward', 'ReceiptRewardController');
        Route::get('delete/ReceiptReward/{id}', 'ReceiptRewardController@getDelete');

//ReceiptWarranty Controller
        Route::get('datatables/ReceiptWarranty', 'ActiveMethodController@anyReceiptWarranty');
        Route::resource('ReceiptWarranty', 'ReceiptWarrantyController');
        Route::get('delete/ReceiptWarranty/{id}', 'ReceiptWarrantyController@getDelete');


//Salary Controller
        Route::get('datatables/Salary', 'ActiveMethodController@anySalary');
        Route::resource('Salary', 'SalaryController');
        Route::get('delete/Salary/{id}', 'SalaryController@getDelete');

//Static
        Route::get('datatables/Static', 'ActiveMethodController@anyStatic');
        Route::get('Static', 'ActiveMethodController@getStatic');
        Route::get('datatables/CatchReceiptBox', 'ActiveMethodController@anyCatchReceiptBox');
        Route::resource('CatchReceiptBox', 'CatchReceiptBoxController');
        Route::get('delete/CatchReceiptBox/{id}', 'CatchReceiptBoxController@getDelete');
        Route::get('datatables/CatchReceipt', 'ActiveMethodController@anyCatchReceipt');
        Route::resource('CatchReceipt', 'CatchReceiptController');
        Route::get('delete/CatchReceipt/{id}', 'CatchReceiptController@getDelete');
        Route::get('CatchReceiptFilter', 'CatchReceiptController@getYearFilter');
        Route::get('datatables/ReceiptBox', 'ActiveMethodController@anyReceiptBox');
        Route::resource('ReceiptBox', 'ReceiptBoxController');
        Route::get('delete/ReceiptBox/{id}', 'ReceiptBoxController@getDelete');

//جديد 2019
        Route::get('datatables/RecordDone', 'ActiveMethodController@anyRecordDone');
        Route::resource('RecordDone', 'RecordDoneController');
        Route::get('datatables/IncomeLevel', 'ActiveMethodController@anyIncomeLevel');
        Route::resource('IncomeLevel', 'IncomeLevelController');
        Route::get('IncomeLevel/active/{id}', 'ActiveMethodController@getActiveIncomeLevel');
        Route::get('datatables/QueryMoney', 'QueryRepController@anyQueryMoney');
        Route::get('QueryMoney', 'QueryRepController@getMoney')->name('QueryMoney');
        Route::get('datatables/QueryAdmin', 'QueryRepController@anyQueryAdmin');
        Route::get('QueryAdmin', 'QueryRepController@getAdmin')->name('QueryAdmin');
        Route::get('ApprovalRecord', 'ApprovalRecordController@index')->name('ApprovalRecord');
        Route::get('MyApprovalRecord', 'ApprovalRecordController@index')->name('MyApprovalRecord');
        Route::get('approve/ApprovalRecord/{id}', 'ApprovalRecordController@approve');
        Route::get('reject/ApprovalRecord/{id}', 'ApprovalRecordController@reject');
        Route::get('datatables/ApprovalRecord', 'ActiveMethodController@anyApprovalRecord');
        Route::get('datatables/QueryUser', 'ActiveMethodController@anyQueryUser');
        Route::get('QueryUser', 'QueryRepController@getUser')->name('QueryUser');
        Route::get('QueryUser', 'QueryRepController@getUser');

//التحصيل والشؤون القانونيه
Route::get('datatables/CollectionFees', 'ActiveMethodController@anyCollectionFees');
Route::resource('CollectionFees', 'CollectionFeesController');
Route::get('delete/CollectionFees/{id}', 'CollectionFeesController@getDelete');
Route::get('getAll/CollectionFees', 'CollectionFeesController@getAll');
Route::get('CollectionFees/active/{id}', 'ActiveMethodController@getActiveCollectionFees');
Route::get('datatables/CountClaim', 'ActiveMethodController@anyCountClaim');
Route::resource('CountClaim', 'CountClaimController');
Route::get('delete/CountClaim/{id}', 'CountClaimController@getDelete');
Route::get('add/CountClaim/{id}', 'CountClaimController@getAdd');
Route::post('add/CountClaim/{id}', 'CountClaimController@postAdd');
Route::get('datatables/CountWarning', 'ActiveMethodController@anyCountWarning');
Route::resource('CountWarning', 'CountWarningController');
Route::get('delete/CountWarning/{id}', 'CountWarningController@getDelete');
Route::get('add/CountWarning/{id}', 'CountWarningController@getAdd');
Route::post('add/CountWarning/{id}', 'CountWarningController@postAdd');
Route::get('datatables/LegalAffairs', 'ActiveMethodController@anyLegalAffairs');
Route::get('datatables/end/LegalAffairs', 'ActiveMethodController@anyLegalAffairsEnd');
Route::resource('LegalAffairs', 'LegalAffairsController');
Route::get('LegalAffairs/addCollect/{id}', 'LegalAffairsController@collectMoney');
Route::post('LegalAffairs/addCollect/{id}', 'LegalAffairsController@postCollectMoney');
Route::get('end/LegalAffairs', 'LegalAffairsController@getEnd');
Route::get('delete/LegalAffairs/{id}', 'LegalAffairsController@getDelete');
Route::get('add/LegalAffairs/{id}', 'LegalAffairsController@getAdd');
Route::post('add/LegalAffairs/{id}', 'LegalAffairsController@postAdd');
Route::get('LegalAffairs/active/{id}', 'ActiveMethodController@getActiveLegalAffairs');

Route::get('datatables/Box', 'ActiveMethodController@anyBox');
Route::get('datatables/BoxPer', 'ActiveMethodController@anyBoxPer');
Route::resource('Box', 'BoxController');
Route::get('Box/active/{id}', 'ActiveMethodController@getActiveBox');
Route::get('delete/Box/{id}', 'BoxController@getDelete');
Route::get('lock/Box/{id}', 'BoxController@getLock');
Route::get('BoxPer', 'BoxController@getIndex');
Route::get('BoxPer/{id}', 'BoxController@getAdd');
Route::post('BoxPer/{id}', 'BoxController@postAdd');
Route::post('Box/{id}', 'BoxController@show');

Route::get('datatables/BoxIncome/{id}', 'ActiveMethodController@anyBoxIncome');
Route::resource('BoxIncome', 'BoxIncomeController');
Route::get('delete/BoxIncome/{id}', 'BoxIncomeController@getDelete');
Route::get('create/BoxIncome/{id}', 'BoxIncomeController@getCreate');
Route::get('BoxIncomes/{id}', 'BoxIncomeController@getIndex');

Route::get('datatables/BoxExpense/{id}', 'ActiveMethodController@anyBoxExpense');
Route::resource('BoxExpense', 'BoxExpenseController');
Route::get('delete/BoxExpense/{id}', 'BoxExpenseController@getDelete');
Route::get('create/BoxExpense/{id}', 'BoxExpenseController@getCreate');


// المستودع
Route::get('datatables/Material', 'ActiveMethodController@anyMaterial');
Route::resource('Material', 'MaterialController');
Route::get('Material/active/{id}', 'ActiveMethodController@getActiveMaterial');
Route::get('delete/Material/{id}', 'MaterialController@getDelete');
Route::get('RSection/{id}', 'ActiveMethodController@getRSection');
Route::prefix('Quantity')->group(function () {
    Route::get('', 'QuantityController@getIndex');
    Route::get('{id}/add', 'QuantityController@getAdd');
    Route::post('{id}/add', 'QuantityController@postAdd');
    Route::get('edit/{id}', 'QuantityController@getEdit');
    Route::post('edit/{id}', 'QuantityController@postEdit');
    Route::get('delete/{id}', 'QuantityController@getDelete');
});
Route::get('datatables/Quantity', 'ActiveMethodController@anyQuantity');
Route::get('datatables/RepositoryIn', 'ActiveMethodController@anyRepositoryIn');
Route::resource('RepositoryIn', 'RepositoryInController');
Route::get('RepositoryIn/active/{id}', 'ActiveMethodController@getActiveRepositoryIn');
Route::get('delete/RepositoryIn/{id}', 'RepositoryInController@getDelete');
Route::get('RepSection/{id}', 'ActiveMethodController@getRepSection');
Route::get('RepMaterial/{id}', 'ActiveMethodController@getRepMaterial');
Route::get('datatables/RepositoryOut', 'ActiveMethodController@anyRepositoryOut');
Route::resource('RepositoryOut', 'RepositoryOutController');
Route::get('RepositoryOut/active/{id}', 'ActiveMethodController@getActiveRepositoryOut');
Route::get('delete/RepositoryOut/{id}', 'RepositoryOutController@getDelete');
Route::get('datatables/Repository', 'ActiveMethodController@anyRepository');
Route::resource('Repository', 'RepositoryController');
Route::get('Repository/active/{id}', 'ActiveMethodController@getActiveRepository');
Route::get('delete/Repository/{id}', 'RepositoryController@getDelete');
Route::prefix('RepositorySection')->group(function () {
    Route::get('{id}', 'RepSectionController@getIndex');
    Route::get('add/{id}', 'RepSectionController@getAdd');
    Route::post('add/{id}', 'RepSectionController@postAdd');
    Route::get('edit/{id}', 'RepSectionController@getEdit');
    Route::post('edit/{id}', 'RepSectionController@postEdit');
    Route::get('delete/{id}', 'RepSectionController@getDelete');
});

Route::resource('InventoryRepos', 'InventoryReposController');
     Route::post('InventoryRepo', 'InventoryReposController@InvenRepo');
Route::get('InventoryRepo', 'InventoryReposController@AllInvenRepo')->name('AllInvenRepo');
Route::get('IsAccept/{id}', 'InventoryReposController@isAccept');
Route::post('EndInventory', 'InventoryReposController@endInventory');
Route::get('/delete/InventoryRepos/{id}', 'InventoryReposController@getDelete');
Route::get('datatables/RepositoryInventory', 'ActiveMethodController@anyRepositoryInventory');

Route::get('datatables/RepInvRecord', 'ActiveMethodController@anyRepInvRecord');
Route::get('RepInvRecord', 'RepInvRecordController@getIndex');

Route::get('datatables/RepInventory', 'ActiveMethodController@anyRepInventory');
Route::get('add/RepInventory/{id}', 'RepInventoryController@getAdd');
     Route::post('add/RepInventory/{id}', 'RepInventoryController@postAdd');
Route::get('Rep/Inventory/{id}', 'RepInventoryController@getIndex');
Route::get('Done/Inventory/{id}', 'RepInventoryController@getDone');
Route::get('Accept/Inventory/{id}', 'RepInventoryController@getAccept');
Route::get('count_inv/{id}', 'RepInventoryController@count_inv');

});

require __DIR__.'/auth.php';
Route::get('/{page}', 'AdminController@index');





