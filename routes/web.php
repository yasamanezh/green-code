<?php
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Admin\Dashboard\Index;
use Illuminate\Support\Facades\Route;

//=======================================> //sitemap//
Route::get('mySiteMapGenerate',[\App\Http\Controllers\Smpe::class,'index'])->name('siteMap');

//=======================================> //front routes//
Route::get('/',\App\Http\Livewire\Front\Home\Index::class)->name('Home');
Route::get('/services',\App\Http\Livewire\Front\Service\Index::class)->name('services');
Route::get('/contact',\App\Http\Livewire\Front\Contact\Index::class)->name('contact');
Route::get('/about',\App\Http\Livewire\Front\About\Index::class)->name('about');
//=======================================> // start admin routes//
Route::group(['middleware' => ['web','auth','Admin_panel']], function () {
    //=======================================> //role//
    Route::get('admin/roles',App\Http\Livewire\Admin\Role\Index::class)->name('Roles');
    Route::get('admin/role/add',App\Http\Livewire\Admin\Role\Add::class)->name('AddRole');
    Route::get('admin/role/edit/{role}',App\Http\Livewire\Admin\Role\Edit::class)->name('EditRole');

//=======================================> //dashboard//
    Route::get('admin/home',Index::class)->name('Dashboard');

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



//=======================================> //newsletter//
    Route::get('admin/newsletter',\App\Http\Livewire\Admin\Newsletter\Index::class)->name('newsletter.index');
    Route::get('admin/social',\App\Http\Livewire\Admin\Social\Index::class)->name('social.index');




//======================================= > // optios//
    Route::get('admin/options',\App\Http\Livewire\Admin\Option\Index::class)->name('SiteOptions');
    Route::get('admin/ProductComments',\App\Http\Livewire\Admin\Option\ProductComment::class)->name('ProductComment');
    Route::get('admin/ProductComment/edit/{edit}',\App\Http\Livewire\Admin\Option\ProductCommentEdit::class)->name('ProductCommentEdit');
    Route::get('admin/questions',\App\Http\Livewire\Admin\Option\Question::class)->name('Questions');
    Route::get('admin/question/edit/{edit}',\App\Http\Livewire\Admin\Option\EditQuestion::class)->name('editQuestion');



//======================================= > //licence//
    Route::get('admin/licences',\App\Http\Livewire\Admin\Licence\Index::class)->name('Licences');
    Route::get('admin/licence/add',\App\Http\Livewire\Admin\Licence\Add::class)->name('AddLicence');
    Route::get('admin/licence/edit/{edit}',\App\Http\Livewire\Admin\Licence\Edit::class)->name('EditLicence');



//======================================= > //contact//
    Route::get('admin/contacts',\App\Http\Livewire\Admin\Contact\Index::class)->name('contacts');
    Route::get('admin/contact/show/{show}',\App\Http\Livewire\Admin\Contact\Show::class)->name('showContact');


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
