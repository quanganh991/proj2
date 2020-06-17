<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/locate','HomeController@locate');
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
//Đăng nhập
Route::get('/login','LoginController@login');
Route::get('/login-check','LoginController@login_check');
Route::get('/logout','LoginController@logout');

//Đăng ký
Route::get('/signup','SignupController@signup');
Route::get('/signup-check','SignupController@signup_check');

//Tìm kiếm
Route::get('/search','SearchController@search');
Route::get('/search-result','SearchController@searchResult');
Route::get('/detail/{id_product}','SearchController@showDetail');

//chọn category brach/main
Route::get('/main-result','CategorySearchController@mainSearch');
Route::get('/branch-result/{id_main}','CategorySearchController@branchSearch');
Route::get('/product-result/{id_branch}','CategorySearchController@productSearch');

//cart
Route::get('/save-cart','CartController@addToCart');
Route::get('/show-cart','CartController@showCart');
Route::get('/update-cart-quantity','CartController@updateCartQuantity');

Route::get('/delete-from-cart/{rowID}','CartController@deleteFromCart');
Route::get('/destroy-cart','CartController@destroyCart');

//pay
Route::get('/previewOrder','PayController@previewOrder');
Route::get('/pay','PayController@noteDetail');
Route::get('/save-customer-payment','PayController@saveCustomerPayment');

//user personal information
Route::get('/change-information','UserInformationController@changeUserInformation');
Route::get('/alter-user-information','UserInformationController@alterUserInformation');

//comment
Route::get('/comment','ProductController@comment');
Route::get('/rating','ProductController@rating');

//đơn hàng
//đơn hàng chi tiết của user
Route::get('/user-view-order-detail/{id_oder}','OrderController@viewUserOrderDetail');

//đơn hàng tổng quát của user
Route::get('/user-view-order','OrderController@viewUserOrder');
Route::get('/user-cancel-order/{id_oder}','OrderController@cancelUserOrder');

//tin tức
Route::get('/list-news-for-user','NewsController@listNewsForUser');
Route::get('/detail-news-for-user/{id_news}','NewsController@detailNewsForUser');
//thông báo về đơn hàng
Route::get('/user-view-notification','NotificationController@viewAllController');
Route::get('/user-mark-notification-as-read/{id_notification}','NotificationController@markAsRead');
//Phía Admin
//welcome
Route::get('/welcome-admin','LoginController@welcomeAdmin');
//Thêm sản phẩm
Route::get('/add-branch-category','AdminController\AddController@addBranchCategory');
Route::get('/save-branch-category','AdminController\AddController@saveBranchCategory');

Route::get('/add-main-category','AdminController\AddController@addMainCategory');
Route::get('/save-main-category','AdminController\AddController@saveMainCategory');

Route::get('/add-product','AdminController\AddController@addProduct');
Route::get('/save-product','AdminController\AddController@saveProduct');
//sửa, sóa branch
Route::get('/all-branch-category','AdminController\ShowController@showAllBranchCategory');
Route::get('/unactive-branch-category/{id_category_branch}','AdminController\DeleteController@unactiveBranchCategory');
Route::get('/active-branch-category/{id_category_branch}','AdminController\DeleteController@activeBranchCategory');
Route::get('/edit-branch-category/{id_category_branch}','AdminController\EditController@editBranchCategory');
Route::get('/submit-edit-branch','AdminController\EditController@submitEditBranch');
//sửa main
Route::get('/all-main-category','AdminController\ShowController@showAllMainCategory');
Route::get('/edit-main-category/{id_main}','AdminController\EditController@editMainCategory');
Route::get('/submit-edit-main','AdminController\EditController@submitEditMain');
//sửa, xóa product
Route::get('/all-product','AdminController\ShowController@showAllProduct');
Route::get('/unactive-product/{id_product}','AdminController\DeleteController@unactiveProduct');
Route::get('/active-product/{id_product}','AdminController\DeleteController@activeProduct');
Route::get('/edit-product/{id_product}','AdminController\EditController@editProduct');
Route::get('/submit-edit-product','AdminController\EditController@submitEditProduct');

//đối tác giao hàng
Route::get('/all-partner-delivery','AdminController\PartnerController@showAllPartnerDelivery');
Route::get('/edit-partner-delivery/{id_partner_delivery}','AdminController\PartnerController@editPartnerDelivery');
Route::get('/submit-partner-delivery','AdminController\PartnerController@submitPartnerDelivery');
Route::get('/save-partner-delivery','AdminController\PartnerController@savePartnerDelivery');

//đơn hàng
//đơn hàng chi tiết
Route::get('/view-order-detail/{id_oder}','AdminController\OrderController@viewOrderDetail');
Route::get('/edit-order-detail/{id_oder_detail}','AdminController\OrderController@editOrderDetail');
Route::get('/submit-edit-order-detail','AdminController\OrderController@submitEditOrderDetail');

//đơn hàng tổng quát
Route::get('/view-order','AdminController\OrderController@viewOrder');
Route::get('/approve-order/{id_oder}','AdminController\OrderController@approveOrder');
Route::get('/unapprove-order/{id_oder}','AdminController\OrderController@unApproveOrder');
Route::get('/succeed-order/{id_oder}','AdminController\OrderController@succeedOrder');
//comment
Route::get('/admin-comment','AdminController\AdminController@adminComment');
Route::get('/delete-admin-comment/{id_admin_comment}','AdminController\AdminController@deleteAdminComment');
//quản lý người dùng

//hiển thị danh sách người dùng
Route::get('/display-user','AdminController\UserController@displayUser');

//block người dùng
Route::get('/block-user/{id_customer}','AdminController\UserController@blockUser');
Route::get('/unblock-user/{id_customer}','AdminController\UserController@unBlockUser');

//xóa bình luận
Route::get('/delete-comment/{id_comment}','AdminController\UserController@deleteComment');

//thêm admin
Route::get('/add-admin','AdminController\AdminController@addAdmin');
Route::get('/save-admin','AdminController\AdminController@saveAdmin');

//tin tức
//thêm tin tức
Route::get('/add-news','AdminController\NewsController@addNews');
Route::get('/save-news','AdminController\NewsController@saveNews');
//hiển thị danh sách tin tức
Route::get('/display-all-news','AdminController\NewsController@displayAllNews');

//chỉnh sửa tin tức
Route::get('/edit-news/{id_news}','AdminController\NewsController@editNews');
Route::get('/submit-edit-news','AdminController\NewsController@submitEditNews');

//xóa tin tức
Route::get('/active-news/{id_news}','AdminController\NewsController@activeNews');
Route::get('/unactive-news/{id_news}','AdminController\NewsController@unactiveNews');

//thay đổi thông tin cá nhân admin
Route::get('/change-admin-information','AdminController\AdminController@changeAdminInformation');
Route::get('/alter-admin-information','AdminController\AdminController@alterAdminInformation');

//thống kê
Route::get('/access-quantity','AdminController\StatisticController@accessQuantity');    //thống kê lượt truy cập
Route::get('/revenue','AdminController\StatisticController@revenue');    //doanh thu
//phiên
Route::get('/view-all-session','AdminController\SessionController@viewAllSession');
