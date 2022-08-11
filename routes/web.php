<?php
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Admin\Dashboard\Index;
use Illuminate\Support\Facades\Route;

//=======================================> //sitemap//
Route::get('mySiteMapGenerate',[\App\Http\Controllers\Smpe::class,'index'])->name('siteMap');

//=======================================> //front routes//
Route::get('/verify/{phone}',\App\Http\Livewire\Auth\VerifyPhoneNumber::class)->name('Verify');
Route::get('/',\App\Http\Livewire\Front\Home\Index::class)->name('Home');
Route::get('logout', function () {  Auth::logout(); return redirect('/');})->name('logout');
Route::get('packages',App\Http\Livewire\Front\Category\ProductCategory::class)->name('Packages');
Route::get('pack/{product}',App\Http\Livewire\Front\Product\SingleProduct::class)->name('SingleProduct');
Route::get('page/{slug?}',\App\Http\Livewire\Front\Page\Index::class)->name('AllPages');
Route::get('demo/{slug?}',\App\Http\Livewire\Front\Demo\Index::class)->name('AllDemo');
Route::get('compair/{productId}',App\Http\Livewire\Front\Compare\Index::class)->name('compare');

//=======================================> //blog//
Route::get('blog',App\Http\Livewire\Front\Blog\Index::class)->name('FrontBlog');
Route::get('blog/category/{category}',App\Http\Livewire\Front\Blog\Category::class)->name('BlogCategory');
Route::get('blog/category/post/{post}',App\Http\Livewire\Front\Blog\Post::class)->name('FrontPost');

//=======================================> // user profile  routes//
Route::middleware('web')->middleware('auth')->group(function () {
    Route::get('checkout',App\Http\Livewire\Front\Order\Index::class)->name('CartOrders');
    Route::get('checkoutOrder/{id}',App\Http\Livewire\Front\Checkout\Index::class)->name('checkoutOrder');
    Route::get('payment',[App\Http\Controllers\Payment::class,'index'])->name('payment');
    Route::get('payment/callback',App\Http\Livewire\Front\Payment\Callback::class)->name('callback');
    Route::get('dashboard/profile',App\Http\Livewire\Front\Profile\Index::class)->name('Profile');
    Route::get('dashboard/profile/download',App\Http\Livewire\Front\Profile\Download::class)->name('Download');
    Route::get('download/{file}',[App\Http\Controllers\Download::class,'index'])->name('DownloadFile');
    Route::get('dashboard/orders',App\Http\Livewire\Front\Profile\Orders::class)->name('Orders');
    Route::get('dashboard/payment',App\Http\Livewire\Front\Profile\Pay::class)->name('DahboardPayment');
    Route::get('dashboard/order/detail/{order}',App\Http\Livewire\Front\Profile\DetailOrder::class)->name('DetailOrder');
    Route::get('dashboard/order/print/{order}',App\Http\Livewire\Front\Profile\PrintOrder::class)->name('PrintOrder');
    Route::get('dashboard/comment',App\Http\Livewire\Front\Profile\Comment::class)->name('UserComment');
});

//=======================================> // start admin routes//
Route::group(['middleware' => ['web','auth','Admin_panel']], function () {
    //=======================================> //role//
    Route::get('admin/roles',App\Http\Livewire\Admin\Role\Index::class)->name('Roles');
    Route::get('admin/role/add',App\Http\Livewire\Admin\Role\Add::class)->name('AddRole');
    Route::get('admin/role/edit/{role}',App\Http\Livewire\Admin\Role\Edit::class)->name('EditRole');

//=======================================> //dashboard//
    Route::get('admin/home',Index::class)->name('Dashboard');
//=======================================> //payments//
    Route::get('admin/payments',App\Http\Livewire\Admin\Payment\Index::class)->name('AdminPayment');

//=======================================> //send Email//
    Route::get('admin/notification/emails',App\Http\Livewire\Admin\Notification\Email\Index::class)->name('EmailNotification');
    Route::get('admin/notification/email/add',App\Http\Livewire\Admin\Notification\Email\Add::class)->name('AddEmailNotification');
    Route::get('admin/notification/email/edit/{edit}',App\Http\Livewire\Admin\Notification\Email\Edit::class)->name('EditEmailNotification');

//=======================================> //send sms//
    Route::get('admin/notification/sms',App\Http\Livewire\Admin\Notification\Sms\Index::class)->name('SmsNotification');
    Route::get('admin/notification/sms/add',App\Http\Livewire\Admin\Notification\Sms\Add::class)->name('AddSmsNotification');
    Route::get('admin/notification/sms/edit/{edit}',App\Http\Livewire\Admin\Notification\Sms\Edit::class)->name('editSmsNotification');

//=======================================> //blog//
    Route::get('admin/blogs',\App\Http\Livewire\Admin\Blog\Index::class)->name('Blogs.blog');
    Route::get('admin/blogs/trashed',\App\Http\Livewire\Admin\Blog\Trashed::class)->name('trashedBlog');
    Route::get('admin/blog/edit/{blog}',\App\Http\Livewire\Admin\Blog\Update::class)->name('EditBlog');
    Route::get('admin/blog/add',\App\Http\Livewire\Admin\Blog\Add::class)->name('Addblog');
    Route::get('admin/comments',\App\Http\Livewire\Admin\Comment\Index::class)->name('Coments');
    Route::get('admin/comment/edit/{edit}',\App\Http\Livewire\Admin\Comment\Edit::class)->name('editComents');

//=======================================> //log//
    Route::get('admin/adminlogs',\App\Http\Livewire\Admin\Log\Index::class)->name('AdminLogs');

//=======================================> //post//
    Route::get('admin/blog/posts',\App\Http\Livewire\Admin\Post\Index::class)->name('post.blog');
    Route::get('admin/posts/trashed',\App\Http\Livewire\Admin\Post\Trashe::class)->name('trashedPostBlog');
    Route::get('admin/blog/post/add',\App\Http\Livewire\Admin\Post\Add::class)->name('addPostBlog');
    Route::get('admin/blog/post/edit/{post}',\App\Http\Livewire\Admin\Post\Update::class)->name('EditPostBlog');

//=======================================> //category//
    Route::get('admin/categories',App\Http\Livewire\Admin\Category\Categories::class)->name('categories');
    Route::get('admin/category/trash',App\Http\Livewire\Admin\Category\Trashed::class)->name('Trashed');
    Route::get('admin/category/edit/{category}',App\Http\Livewire\Admin\Category\EditCategory::class)->name('EditCategory');
    Route::get('admin/addCategory',App\Http\Livewire\Admin\Category\Add::class)->name('AddCategory');

//=======================================> //pages//
    Route::get('admin/pages',\App\Http\Livewire\Admin\Page\Index::class)->name('pages');
    Route::get('admin/page/trash',\App\Http\Livewire\Admin\Page\Trashed::class)->name('page.trashed');
    Route::get('admin/page/add',\App\Http\Livewire\Admin\Page\Add::class)->name('page.add');
    Route::get('admin/page/edit/{page}',\App\Http\Livewire\Admin\Page\Update::class)->name('page.update');

//=======================================> //demos//
    Route::get('admin/demoes',\App\Http\Livewire\Admin\Demo\Index::class)->name('demoes');
    Route::get('admin/demo/trash',\App\Http\Livewire\Admin\Demo\Trashed::class)->name('demoTrashed');
    Route::get('admin/demo/add',\App\Http\Livewire\Admin\Demo\Add::class)->name('demoAdd');
    Route::get('admin/demo/edit/{demo}',\App\Http\Livewire\Admin\Demo\Update::class)->name('demoupdate');


//=======================================> //filter//
    Route::get('admin/filters',\App\Http\Livewire\Admin\Filter\Index::class)->name('Filters');
    Route::get('admin/filter/edit/{filter}',\App\Http\Livewire\Admin\Filter\Update::class)->name('editFilter');
    Route::get('admin/filters/add',\App\Http\Livewire\Admin\Filter\Add::class)->name('AddFilter');

//=======================================> //manufacturer//
    Route::get('admin/manufacturers',App\Http\Livewire\Admin\manufacturer\Manufactor::class)->name('Manufacturers');
    Route::get('admin/brand/edit/{manufacturer}',App\Http\Livewire\Admin\manufacturer\EditManufactor::class)->name('Editbrand');
    Route::get('admin/brand/add',App\Http\Livewire\Admin\manufacturer\Add::class)->name('AddBrand');

//=======================================> //attribute group//
    Route::get('admin/attributeGroups',App\Http\Livewire\Admin\attribute\Groups::class)->name('AttributeGroups');
    Route::get('admin/attributeGroup/edit/{attributeGroup}',App\Http\Livewire\Admin\attribute\Editgroup::class)->name('EditAttributeGroup');
    Route::get('admin/attribute/edit/{attribute}',App\Http\Livewire\Admin\attribute\Update::class)->name('EditAttribute');
    Route::get('admin/attributegroup/add',App\Http\Livewire\Admin\attribute\AddGroup::class)->name('AddAttributeGroup');
    Route::get('admin/attribute/add',App\Http\Livewire\Admin\attribute\Add::class)->name('AddAttribute');

//=======================================> //products//
    Route::get('admin/products',App\Http\Livewire\Admin\Product\Products::class)->name('Products');
    Route::get('admin/product/edit/{product}',App\Http\Livewire\Admin\Product\EditProduct::class)->name('EditProduct');
    Route::get('admin/product/add',App\Http\Livewire\Admin\Product\AddProduct::class)->name('AddProduct');
//=======================================> //No products//
    Route::get('admin/noProducts',App\Http\Livewire\Admin\Noproduct\Index::class)->name('NoProducts');

//=======================================> //warranties//
    Route::get('admin/warranty',\App\Http\Livewire\Admin\Product\Warranty\Index::class)->name('warrantys');
    Route::get('admin/warranty/update/{warranty}',\App\Http\Livewire\Admin\Product\Warranty\Update::class)->name('warranty.update');
    Route::get('admin/warranty/add',\App\Http\Livewire\Admin\Product\Warranty\Add::class)->name('warrantyAdd');

//=======================================> //newsletter//
    Route::get('admin/newsletter',\App\Http\Livewire\Admin\Newsletter\Index::class)->name('newsletter.index');
    Route::get('admin/social',\App\Http\Livewire\Admin\Social\Index::class)->name('social.index');

//================= > //discount Code//
    Route::get('admin/discount',\App\Http\Livewire\Admin\Discount\IndexDiscount::class)->name('discounts');
    Route::get('admin/discount/add',\App\Http\Livewire\Admin\Discount\Add::class)->name('AddDiscount');
    Route::get('admin/discount/edit/{edit}',\App\Http\Livewire\Admin\Discount\Edit::class)->name('EditDiscount');

//=======================================> //banner//
    Route::get('admin/banner',\App\Http\Livewire\Admin\Banner\Index::class)->name('banner.index');
    Route::get('admin/banner/update/{banner}',\App\Http\Livewire\Admin\Banner\Update::class)->name('banner.update');
    Route::get('admin/banner/add',\App\Http\Livewire\Admin\Banner\Add::class)->name('AddBanner');


//======================================= > //home design//
    Route::get('admin/modules',\App\Http\Livewire\Admin\Module\Index::class)->name('Modules');

//======================================= > // optios//
    Route::get('admin/options',\App\Http\Livewire\Admin\Option\Index::class)->name('SiteOptions');
    Route::get('admin/ProductComments',\App\Http\Livewire\Admin\Option\ProductComment::class)->name('ProductComment');
    Route::get('admin/ProductComment/edit/{edit}',\App\Http\Livewire\Admin\Option\ProductCommentEdit::class)->name('ProductCommentEdit');
    Route::get('admin/questions',\App\Http\Livewire\Admin\Option\Question::class)->name('Questions');
    Route::get('admin/question/edit/{edit}',\App\Http\Livewire\Admin\Option\EditQuestion::class)->name('editQuestion');

//======================================= > //menu//
    Route::get('admin/menus',\App\Http\Livewire\Admin\Menu\Index::class)->name('Menus');
    Route::get('admin/menu/add',\App\Http\Livewire\Admin\Menu\Add::class)->name('AddMenu');
    Route::get('admin/menu/edit/{menu}',\App\Http\Livewire\Admin\Menu\Edit::class)->name('EditMenu');

//======================================= > //contact//
    Route::get('admin/contacts',\App\Http\Livewire\Admin\Contact\Index::class)->name('contacts');
    Route::get('admin/contact/show/{show}',\App\Http\Livewire\Admin\Contact\Show::class)->name('showContact');

//======================================= > //footer option//
    Route::get('admin/footer',\App\Http\Livewire\Admin\Footer\Index::class)->name('FooterOptions');

//======================================= > //html//
    Route::get('admin/htmls',\App\Http\Livewire\Admin\Html\Index::class)->name('Htmls');
    Route::get('admin/html/add',\App\Http\Livewire\Admin\Html\Add::class)->name('AddHtml');
    Route::get('admin/html/edit/{html}',\App\Http\Livewire\Admin\Html\Update::class)->name('updateHtml');

//=======================================> //orders//
    Route::get('admin/orders',\App\Http\Livewire\Admin\Order\Index::class)->name('admin.orders.index');
    Route::get('admin/order/add',\App\Http\Livewire\Admin\Order\Add::class)->name('admin.orders.add');
    Route::get('admin/order/detailOrder/{detail}',\App\Http\Livewire\Admin\Order\Detail::class)->name('AdminDetailOrder');
    Route::get('admin/order/detailOrder/print/{detail}',\App\Http\Livewire\Admin\Order\PrintOrder::class)->name('AdminPrintOrder');


//======================================= > //users//
    Route::get('admin/users',\App\Http\Livewire\Admin\Users\Index::class)->name('Users');
    Route::get('admin/user/edit/{user}',\App\Http\Livewire\Admin\Users\Edit::class)->name('EditUser');
    Route::get('admin/user/Add',\App\Http\Livewire\Admin\Users\Add::class)->name('AddUser');


//======================================= > //Filemanager//
    Route::group(['prefix' => 'laravel-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
    Route::group(['prefix' => 'filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

//======================================= > //tools//
    Route::get('admin/tools',\App\Http\Livewire\Admin\Tools\Index::class)->name('admin.tools');
    Route::get('admin/update',\App\Http\Livewire\Admin\Update\Index::class)->name('admin.update');
//======================================= > //jetstream-profile//
    require_once __DIR__ . '/jetstream.php';
});
