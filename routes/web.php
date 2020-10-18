<?php

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

Route::get('/', function () {
    return view('auth.login');
});


//RestPasswordUser
Route::post('/users/RestPassword', 'RestPasswordController@RestPassword')->name('admin.user.RestPassword');

Auth::routes();
//HomeController
Route::get('/home', 'HomeController@index')->name('home')->middleware('checkUser');
Route::get('/home/chart', 'HomeController@Chart')->name('home.chart')->middleware('checkUser');
Route::get('/home/chartsell', 'HomeController@ChartSell')->name('home.chart.sell')->middleware('checkUser');

Route::group(['middleware' => ['auth', 'web']], function () {

    Route::group(["namespace" => "Users"], function () {
        //UserController
        Route::post('/user/update', 'UserController@update')->name('admin.user.update');
        Route::get('/user/u/{id?}', 'UserController@u')->name('admin.user.u');
        Route::post('/user/reset', 'UserController@reset')->name('admin.user.reset.pass');
        Route::post('/user/avatar', 'UserController@avatar')->name('admin.user.avatar');
        Route::post('/user/store', 'UserController@store')->name('admin.user.store');
        Route::get('/user/wizard/{id?}', 'UserController@wizard')->name('admin.user.wizard');
        Route::get('/user/profile', 'UserController@profile')->name('admin.user.profile');
        Route::get('/user/show', 'UserController@show')->name('admin.user.show');
        Route::get('/user/disable/{id?}', 'UserController@disable')->name('admin.user.disable');
        Route::get('/user/edit/{id?}', 'UserController@edit')->name('admin.user.edit');
        Route::post('/users/update', 'UserController@updates')->name('admin.user.updates');
        Route::get('/users/lock', 'UserController@lock')->name('admin.user.lock');
        Route::get('/users/system/stop', 'UserController@stop')->name('admin.users.system.stop');
        Route::get('/users/system/start', 'UserController@start')->name('admin.users.system.start');
        Route::get('/users/system/backup', 'UserController@backup')->name('admin.users.system.backup');

        //RoleController
        Route::get('/role/wizard', 'RoleController@wizard')->name('admin.role.wizard');
        Route::post('/role/store', 'RoleController@store')->name('admin.role.store');
        Route::get('/role/show', 'RoleController@show')->name('admin.role.show');
        Route::get('/role/edit/{id?}', 'RoleController@edit')->name('admin.role.edit');
        Route::get('/role/copy/{id?}', 'RoleController@copy')->name('admin.role.copy');
        Route::post('/role/update', 'RoleController@update')->name('admin.role.update');
        Route::post('/role/uCopy', 'RoleController@uCopy')->name('admin.role.uCopy');
        Route::delete('/role/delete/{id?}', 'RoleController@delete')->name('admin.role.delete');
        Route::get('/permission/{id?}', 'RoleController@permission')->name('admin.user.permission');
        Route::post('/permission/Pstore', 'RoleController@Pstore')->name('admin.permission.store');
        Route::delete('/permission/Pdelete/{id?}', 'RoleController@Pdelete')->name('admin.permission.delete');
        Route::get('/permission/update/{id?}', 'RoleController@Pupdate')->name('admin.permission.update');


        //AlternativesController
        Route::get('/alternatives/wizard', 'AlternativesController@wizard')->name('admin.user.alternatives');
        Route::post('/alternatives/store', 'AlternativesController@store')->name('admin.user.alternatives.store');
        Route::get('/alternatives/view', 'AlternativesController@view')->name('admin.user.alternatives.view');
        Route::get('/alternatives/update/{id?}', 'AlternativesController@update')->name('admin.alternatives.update');
        Route::get('/alternatives/user', 'AlternativesController@user')->name('admin.alternatives.user');
        Route::delete('/alternatives/delete/{id?}', 'AlternativesController@delete')->name('admin.alternatives.delete');


    });

    Route::group(["namespace" => "Foundation"], function () {


        //StoreColorController
        Route::get('/storecolor/list', 'StoreColorController@list')->name('admin.storecolor.list');
        Route::post('/storecolor/store', 'StoreColorController@store')->name('admin.storecolor.store');
        Route::get('/storecolor/update/{id?}', 'StoreColorController@update')->name('admin.storecolor.update');
        Route::delete('/storecolor/delete/{id?}', 'StoreColorController@delete')->name('admin.storecolor.delete');


        //MasterbatchController
        Route::get('/Masterbatch/list', 'MasterbatchController@list')->name('admin.Masterbatch.list');
        Route::post('/Masterbatch/store', 'MasterbatchController@store')->name('admin.Masterbatch.store');
        Route::get('/Masterbatch/update/{id?}', 'MasterbatchController@update')->name('admin.Masterbatch.update');
        Route::delete('/Masterbatch/delete/{id?}', 'MasterbatchController@delete')->name('admin.Masterbatch.delete');


        //ModelProductController
        Route::get('/modelProduct/list', 'ModelProductController@list')->name('admin.model.product.list');
        Route::get('/modelProduct/update/{id?}', 'ModelProductController@update')->name('admin.model.product.update');
        Route::delete('/modelProduct/delete/{id?}', 'ModelProductController@delete')->name('admin.model.product.delete');
        Route::post('/modelProduct/store', 'ModelProductController@store')->name('admin.model.product.store');


        //InsertController
        Route::get('/insert/list', 'InserController@list')->name('admin.insert.list');
        Route::get('/insert/update/{id?}', 'InserController@update')->name('admin.insert.update');
        Route::delete('/insert/delete/{id?}', 'InserController@delete')->name('admin.insert.delete');
        Route::post('/insert/store', 'InserController@store')->name('admin.insert.store');


        //BomController
        Route::get('/bom/list', 'BomController@list')->name('admin.bom.list');
        Route::get('/bom/update/{id?}', 'BomController@update')->name('admin.bom.update');
        Route::get('/bom/detail/{id?}', 'BomController@detail')->name('admin.bom.detail');
        Route::delete('/bom/delete/{id?}', 'BomController@delete')->name('admin.bom.delete');
        Route::post('/bom/store', 'BomController@store')->name('admin.bom.store');
        Route::post('/store/bom', 'BomController@bom')->name('admin.bom.store.bom');
        Route::delete('/bom/deletep/{id?}', 'BomController@deletep')->name('admin.bom.deletep');
        Route::get('/bom/list/select', 'BomController@filter')->name('admin.bom.filter');


        //CommodityController
        Route::get('/commodity/list', 'CommodityController@list')->name('admin.commodity.list');
        Route::get('/commodity/update/{id?}', 'CommodityController@update')->name('admin.commodity.update');
        Route::delete('/commodity/delete/{id?}', 'CommodityController@delete')->name('admin.commodity.delete');
        Route::post('/commodity/store', 'CommodityController@store')->name('admin.commodity.store');
        Route::post('/commodity/edit', 'CommodityController@edit')->name('admin.commodity.edit');

        //ProductCharacteristicController
        Route::get('/ProductCharacteristic/list', 'ProductCharacteristicController@list')->name('admin.ProductCharacteristic.list');
        Route::get('/ProductCharacteristic/update/{id?}', 'ProductCharacteristicController@update')->name('admin.ProductCharacteristic.update');
        Route::delete('/ProductCharacteristic/delete/{id?}', 'ProductCharacteristicController@delete')->name('admin.ProductCharacteristic.delete');
        Route::post('/ProductCharacteristic/store', 'ProductCharacteristicController@store')->name('admin.ProductCharacteristic.store');
        Route::post('/ProductCharacteristic/edit', 'ProductCharacteristicController@edit')->name('admin.ProductCharacteristic.edit');
        Route::get('/ProductCharacteristic/delete/{id?}', 'ProductCharacteristicController@delete')->name('admin.ProductCharacteristic.delete');

        //ProductController
        Route::get('/Produoct/list', 'ProductController@list')->name('admin.product.lisret');
        Route::get('/Product/update/{id?}', 'ProductController@update')->name('admin.product.update');
        Route::get('/Product/list/select', 'ProductController@getcharacteristic')->name('admin.list.product');
        Route::get('/Product/list/selectu', 'ProductController@getcharacteristicu')->name('admin.list.productu');
        Route::post('/Product/store', 'ProductController@store')->name('admin.Product.store');
        Route::post('/Product/edit', 'ProductController@edit')->name('admin.Product.edit');
        Route::delete('/Product/delete/{id?}', 'ProductController@delete')->name('admin.Product.delete');

        //ModelController
        Route::get('/model/list', 'ModelController@list')->name('admin.models.list');
        Route::get('/model/update/{id?}', 'ModelController@update')->name('admin.models.update');
        Route::delete('/model/delete/{id?}', 'ModelController@delete')->name('admin.models.delete');
        Route::post('/model/store', 'ModelController@store')->name('admin.models.store');
        Route::post('/model/edit', 'ModelController@edit')->name('admin.models.edit');

        //DeviceController
        Route::get('/device/list', 'DeviceController@list')->name('admin.device.list');
        Route::post('/device/store', 'DeviceController@store')->name('admin.device.store');
        Route::get('/device/update/{id?}', 'DeviceController@update')->name('admin.device.update');
        Route::post('/device/edit', 'DeviceController@edit')->name('admin.device.edit');
        Route::get('/device/delete/{id?}', 'DeviceController@delete')->name('admin.device.delete');
        Route::delete('/device/delete/{id?}', 'DeviceController@delete')->name('admin.device.delete');

        //ColorController
        Route::get('/colorrrrr/listttt', 'ColorController@listttt')->name('admin.color.listt');
        Route::post('/color/store', 'ColorController@store')->name('admin.color.store');
        Route::post('/color/edit', 'ColorController@edit')->name('admin.color.edit');
        Route::delete('/color/delete/{id?}', 'ColorController@delete')->name('admin.color.delete');
        Route::get('/color/update/{id?}', 'ColorController@update')->name('admin.color.update');

        //FormatController
        Route::get('/format/list', 'FormatController@list')->name('admin.format.list');
        Route::get('/format/update/{id?}', 'FormatController@update')->name('admin.format.update');
        Route::post('/format/store', 'FormatController@store')->name('admin.format.store');
        Route::post('/format/edit', 'FormatController@edit')->name('admin.format.edit');
        Route::delete('/format/delete/{id?}', 'FormatController@delete')->name('admin.format.delete');

        //PolymericController
        Route::get('/polymeric/list', 'PolymericController@list')->name('admin.polymeric.list');
        Route::post('/polymeric/store', 'PolymericController@store')->name('admin.polymeric.store');
        Route::post('/polymeric/edit', 'PolymericController@edit')->name('admin.polymeric.edit');
        Route::get('/polymeric/delete/{id?}', 'PolymericController@delete')->name('admin.polymeric.delete');
        Route::get('/polymeric/update/{id?}', 'PolymericController@update')->name('admin.polymeric.update');
        Route::delete('/polymeric/delete/{id?}', 'PolymericController@delete')->name('admin.polymeric.delete');

        //SellerController
        Route::get('/seller/list', 'SellerController@list')->name('admin.seller.list');
        Route::post('/seller/store', 'SellerController@store')->name('admin.seller.store');
        Route::post('/seller/edit', 'SellerController@edit')->name('admin.seller.edit');
        Route::get('/seller/delete/{id?}', 'SellerController@delete')->name('admin.seller.delete');
        Route::get('/seller/update/{id?}', 'SellerController@update')->name('admin.seller.update');
        Route::delete('/seller/delete/{id?}', 'SellerController@delete')->name('admin.seller.delete');

        //MaterialsProduct
        Route::get('/matrial/list', 'MaterialsProduct@list')->name('admin.matrial.list');
        Route::post('/matrial/store', 'MaterialsProduct@store')->name('admin.matrial.store');
        Route::get('/matrial/update/{id?}', 'MaterialsProduct@update')->name('admin.matrial.update');
        Route::post('/matrial/edit', 'MaterialsProduct@edit')->name('admin.matrial.edit');
        Route::delete('/matrial/delete/{id?}', 'MaterialsProduct@delete')->name('admin.matrial.delete');
        Route::get('/matrial/checkbox/{id?}', 'MaterialsProduct@checkbox')->name('admin.matrial.checkbox');

        //ColorScrapController
        Route::get('/colorscrap/list', 'ColorScrapController@list')->name('admin.colorscrap.list');
        Route::post('/colorscrap/store', 'ColorScrapController@store')->name('admin.colorscrap.store');
        Route::get('/colorscrap/update/{id?}', 'ColorScrapController@update')->name('admin.colorscrap.update');
        Route::delete('/colorscrap/delete/{id?}', 'ColorScrapController@delete')->name('admin.colorscrap.delete');

        //ColorChangeController
        Route::get('/colorchange/list', 'ColorChangeController@list')->name('admin.colorchange.list');
        Route::post('/colorchange/store', 'ColorChangeController@store')->name('admin.colorchange.store');
        Route::get('/colorchange/update/{id?}', 'ColorChangeController@update')->name('admin.colorchange.update');
        Route::delete('/colorchange/delete/{id?}', 'ColorChangeController@delete')->name('admin.colorchange.delete');

        //AreasController
        Route::get('/areas/list', 'AreasController@list')->name('admin.areas.list');
        Route::post('/areas/store', 'AreasController@store')->name('admin.areas.store');
        Route::get('/areas/update/{id?}', 'AreasController@update')->name('admin.areas.update');
        Route::delete('/areas/delete/{id?}', 'AreasController@delete')->name('admin.areas.delete');


        //ProductionInformationController
        Route::get('/information/list', 'ProductionInformationController@list')->name('admin.information.list');
        Route::post('/information/store', 'ProductionInformationController@store')->name('admin.information.store');


    });

    Route::group(["namespace" => "Customer"], function () {

        //TypeCustomer
        Route::get('/customer/index', 'TypeCustomer@index')->name('admin.customer.type');
        Route::post('/customer/store', 'TypeCustomer@store')->name('admin.customer.store');
        Route::get('/customer/update/{id?}', 'TypeCustomer@update')->name('admin.customer.update');
        Route::delete('/customer/delete/{id?}', 'TypeCustomer@delete')->name('admin.customer.delete');

        //CustomerAccountController
        Route::get('/CustomerAccount/index', 'CustomerAccountController@index')->name('admin.CustomerAccount.index');
        Route::get('/CustomerAccount/detail', 'CustomerAccountController@detail')->name('admin.CustomerAccount.list.detail');
        Route::post('/CustomerAccount/store', 'CustomerAccountController@store')->name('admin.CustomerAccount.store');
        Route::post('/CustomerAccount/storee', 'CustomerAccountController@storee')->name('admin.CustomerAccount.storee');
        Route::post('/CustomerAccount/edit', 'CustomerAccountController@edit')->name('admin.CustomerAccount.edit');
        Route::post('/CustomerAccount/payment/update', 'CustomerAccountController@patmentupdate')->name('admin.CustomerAccount.payment.update');
        Route::get('/CustomerAccount/list/{id?}', 'CustomerAccountController@list')->name('admin.CustomerAccount.list');
        Route::get('/CustomerAccount/update/{id?}', 'CustomerAccountController@update')->name('admin.CustomerAccount.update');
        Route::get('/CustomerAccount/check/payment/{id?}', 'CustomerAccountController@checkpayment')->name('admin.CustomerAccount.check.payment');
        Route::delete('/CustomerAccount/delete/{id?}', 'CustomerAccountController@delete')->name('admin.CustomerAccount.delete');
        Route::get('/CustomerAccount/print', 'CustomerAccountController@print')->name('admin.customeraccount.print');


        //Customer
        Route::get('/customers/index', 'CustomerController@index')->name('admin.customers.index');
        Route::get('/customers/wizard', 'CustomerController@wizard')->name('admin.customers.wizard');
        Route::post('/customers/store', 'CustomerController@store')->name('admin.customers.store');
        Route::post('/customers/edit', 'CustomerController@edit')->name('admin.customers.edit');
        Route::get('/customers/update/{id?}', 'CustomerController@update')->name('admin.customers.update');
        Route::get('/customers/detaillist/{id?}', 'CustomerController@detaillist')->name('admin.customers.list.detail');
        Route::get('/customers/filter', 'CustomerController@filter')->name('admin.customers.filter');
        Route::delete('/customers/delete/{id?}', 'CustomerController@delete')->name('admin.customers.delete');
        Route::get('/customers/view/{id?}', 'CustomerController@view')->name('admin.customers.view');
        Route::get('/customers/deleteFileCertificate/{id?}', 'CustomerController@deleteFileCertificate')->name('admin.customers.delete.fileCertificate');
        Route::get('/customers/deleteFileCart/{id?}', 'CustomerController@deleteFileCart')->name('admin.customers.delete.fileCart');
        Route::get('/customers/deleteFileActivity/{id?}', 'CustomerController@deleteFileActivity')->name('admin.customers.delete.fileActivity');
        Route::get('/customers/deleteFileStore/{id?}', 'CustomerController@deleteFileStore')->name('admin.customers.delete.fileStore');
        Route::get('/customers/deleteFileOwnership/{id?}', 'CustomerController@deleteFileOwnership')->name('admin.customers.delete.fileOwnership');
        Route::get('/customers/deleteFileEstablished/{id?}', 'CustomerController@deleteFileEstablished')->name('admin.customers.delete.fileEstablished');
        Route::get('/customers/deleteFileSstore/{id?}', 'CustomerController@deleteFileSstore')->name('admin.customers.delete.fileSstore');
        Route::get('/customers/deleteFilePstore/{id?}', 'CustomerController@deleteFilePstore')->name('admin.customers.delete.filePstore');
        Route::get('/customers/deleteFileFinal/{id?}', 'CustomerController@deleteFileFinal')->name('admin.customers.delete.fileFinal');
        Route::get('/customers/list/checkcity', 'CustomerController@checkcity')->name('admin.list.check.city');
        Route::get('/customers/list/checkstate', 'CustomerController@checkstate')->name('admin.list.check.state');

        //Home
        Route::get('/customers/detail/information', 'CustomerController@information')->name('admin.customer.detail.information');
        Route::get('/customers/detail/information/list', 'CustomerController@informationList')->name('admin.customer.detail.information.list');
        Route::get('/customers/detail/traconesh', 'CustomerController@traconesh')->name('admin.customer.detail.traconesh.list');
        Route::get('/customers/detail/kharid', 'CustomerController@kharid')->name('admin.customer.detail.kharid.list');
        Route::get('/customers/detail/asnad', 'CustomerController@asnad')->name('admin.customer.detail.asnad.list');


    });

    Route::group(["namespace" => "Sell"], function () {


        //ProductQueueController
        Route::post('/productqueue/store', 'ProductQueueController@store')->name('admin.invoices.success.store');
        Route::get('/productqueue/list/{id?}', 'ProductQueueController@list')->name('admin.product.list.list');
        Route::get('/productqueue/wizard/{id?}', 'ProductQueueController@wizard')->name('admin.product.list.wizard');
        Route::get('/productqueue/sort', 'ProductQueueController@sort')->name('admin.product.list.sort');
        Route::post('productqueue/Soort', 'ProductQueueController@Soort')->name('admin.product.list.Soort');
        Route::post('productqueue/stored', 'ProductQueueController@stored')->name('admin.invoice.store.date');
        Route::post('/productqueue/list/store', 'ProductQueueController@Liststore')->name('admin.invoices.success.list.store');


        //InvoiceController
        Route::get('/invoice/index', 'InvoiceController@index')->name('admin.invoice.index');
        Route::get('/invoice/trash', 'InvoiceController@trash')->name('admin.invoice.trash');
        Route::get('/invoice/success', 'InvoiceController@success')->name('admin.invoice.success');
        Route::get('/invoice/wizard', 'InvoiceController@wizard')->name('admin.invoice.wizard');
        Route::get('/invoice/detail/{id?}', 'InvoiceController@detail')->name('admin.invoice.detail');
        Route::get('/invoice/detailsuccess/{id?}', 'InvoiceController@detailsuccess')->name('admin.invoice.detail.success');
        Route::get('/invoice/detailTrash/{id?}', 'InvoiceController@detailTrash')->name('admin.invoice.detailTrash');
        Route::post('/invoice/store', 'InvoiceController@store')->name('admin.invoice.store');
        Route::post('/storedetail/store', 'InvoiceController@storedetail')->name('admin.invoices.success.detail.store');
        Route::get('/invoice/update/{id?}', 'InvoiceController@update')->name('admin.invoice.update');
        Route::get('/invoice/update/product/{id?}', 'InvoiceController@updateproduct')->name('admin.invoice.product.update');
        Route::get('/invoice/PrintDetail/{id?}', 'InvoiceController@PrintDetail')->name('admin.print.detail');
        Route::get('/invoice/PrintDetailll/{id?}', 'InvoiceController@PrintDetailll')->name('admin.print.detailllll');
        Route::get('/invoice/PrintDetaill/{id?}', 'InvoiceController@PrintDetaill')->name('admin.print.detaill');
        Route::post('/invoice/product/edit', 'InvoiceController@editproduct')->name('admin.invoice.product.edit');
        Route::post('/invoice/edit', 'InvoiceController@edit')->name('admin.invoice.edit');
        Route::post('/invoice/confirm', 'InvoiceController@confirm')->name('admin.invoice.confirm.customer');
        Route::post('/invoice/delete', 'InvoiceController@delete')->name('admin.invoice.delete');
        Route::post('/invoice/paymentconfrim', 'InvoiceController@paymentconfrim')->name('admin.invoice.payment.confrim.store');
        Route::post('/invoice/scheduling', 'InvoiceController@scheduling')->name('admin.invoices.success.detail.scheduling');
        Route::get('/invoice/list/check/{id?}', 'InvoiceController@checked')->name('admin.invoice.payment.checked');
        Route::get('/invoice/print', 'InvoiceController@print')->name('admin.invoice.print');
        Route::delete('/invoice/AdminDelete/{id?}', 'InvoiceController@AdminDelete')->name('admin.invoice.AdminDelete');
        Route::get('/invoice/UpdateConfirm/{id?}', 'InvoiceController@UpdateConfirm')->name('admin.invoice.update.confirm');
        Route::get('/invoice/TrashAdmin/{id?}', 'InvoiceController@TrashAdmin')->name('admin.invoice.update.trash');
        Route::get('/invoice/RestoreDelete/{id?}', 'InvoiceController@RestoreDelete')->name('admin.invoice.RestoreDelete');
        Route::get('/bank/ShowDetail/{id?}', 'InvoiceController@ShowDetail')->name('admin.bank.show.bank');
        Route::get('/bank/Listprint', 'InvoiceController@Listprint')->name('admin.list.print');
        Route::get('/bank/Listrint', 'InvoiceController@Listrint')->name('admin.ListPrint.print');
        Route::get('/bank/CustomerValidate/{id?}', 'InvoiceController@CustomerValidate')->name('admin.invoice.customers.validate');
        Route::get('/bank/CustomerMany/{id?}', 'InvoiceController@CustomerMany')->name('admin.invoice.customers.many');
        Route::get('/invoice/price', 'InvoiceController@price')->name('admin.product.price');
        Route::get('/invoice/CheckPrint/{id?}', 'InvoiceController@CheckPrint')->name('admin.invoice.check.print');
        Route::get('/invoice/CheckSuccess/{id?}', 'InvoiceController@CheckSuccess')->name('admin.invoice.check.success');
        Route::get('/invoice/CheckCanceled/{id?}', 'InvoiceController@CheckCanceled')->name('admin.invoice.check.canceled');
        Route::post('/invoice/AdminSuccess', 'InvoiceController@AdminSuccess')->name('admin.invoice.admin.success');
        Route::post('/invoice/ValidateStore', 'InvoiceController@ValidateStore')->name('admin.invoice.customer.validate.store');
        Route::post('/invoice/ManyStore', 'InvoiceController@ManyStore')->name('admin.invoice.customer.many.store');
        Route::get('ajaxdata/massremove', 'InvoiceController@massremove')->name('ajaxdata.massremove');
        Route::get('invoice/trash/search', 'InvoiceController@search')->name('admin.invoice.trash.search');
        Route::get('invoice/list/time', 'InvoiceController@ListTime')->name('admin.invoice.success.list.time');
        Route::post('/invoice/cancel', 'InvoiceController@cancel')->name('admin.invoices.success.detail.cancel');
        Route::post('/invoice/savetolist', 'InvoiceController@savetolist')->name('admin.invoice.tolist.sotre.detail');
        Route::get('invoice/list/add', 'InvoiceController@ToList')->name('admin.invoice.add.tolist');


        //TargetController
        Route::get('/target/list', 'TargetController@list')->name('admin.target.list');
        Route::post('/target/store', 'TargetController@store')->name('admin.target.store');
        Route::get('/target/update/{id?}', 'TargetController@update')->name('admin.target.update');
        Route::delete('/target/delete/{id?}', 'TargetController@delete')->name('admin.target.delete');


        //SchedulingController
        Route::get('/Scheduling/list', 'SchedulingController@list')->name('admin.scheduling.list');
        Route::get('/Scheduling/success/{id?}', 'SchedulingController@success')->name('admin.scheduling.success');
        Route::get('/Scheduling/update/{id?}', 'SchedulingController@update')->name('admin.scheduling.update');
        Route::get('/Scheduling/exit/{id?}', 'SchedulingController@exit')->name('admin.scheduling.exit');
        Route::post('/Scheduling/store', 'SchedulingController@store')->name('admin.scheduling.store');
        Route::post('/Scheduling/StoreExit', 'SchedulingController@StoreExit')->name('admin.scheduling.store.exit');
        Route::post('/Scheduling/ExitFac', 'SchedulingController@ExitFac')->name('admin.scheduling.store.exit.fac');
        Route::get('/Scheduling/detail/list', 'SchedulingController@detaillist')->name('admin.scheduling.detail.list');
        Route::post('/Scheduling/update/date', 'SchedulingController@updatedate')->name('admin.scheduling.update.date');
        Route::post('/Scheduling/updatee/datee', 'SchedulingController@updatedatee')->name('admin.scheduling.update.datee');
        Route::post('/Scheduling/cancel/detail', 'SchedulingController@canceldetail')->name('admin.scheduling.cancel.detail');
        Route::get('/Scheduling/print/{id?}', 'SchedulingController@print')->name('admin.Scheduling.print');
        Route::post('/Scheduling/update/bargiri', 'SchedulingController@bargiri')->name('admin.scheduling.update.bargiri');
        Route::get('/Scheduling/ubargiri/{id?}', 'SchedulingController@ubargiri')->name('admin.scheduling.update.ubargiri');
        Route::get('/Scheduling/customer/{id?}', 'SchedulingController@customer')->name('admin.scheduling.update.customer');


        //SalesArchiveController
        Route::get('/SalesArchive/list', 'SalesArchiveController@list')->name('admin.salesarchive.list');


        //ReturnsController
        Route::get('/Returns/list', 'ReturnsController@list')->name('admin.returns.list');
        Route::post('/Returns/store', 'ReturnsController@store')->name('admin.returns.store');
        Route::post('/Returns/store/store', 'ReturnsController@storeinvoice')->name('admin.returns.store.stoore');
        Route::get('/Returns/store/{returns?}', 'ReturnsController@invoice')->name('admin.invoice.store.return');
        Route::get('/Returns/invoice', 'ReturnsController@number')->name('admin.invoice.number.return');
        Route::get('/Returns/product', 'ReturnsController@product')->name('admin.invoice.product.return');
        Route::get('/Returns/color', 'ReturnsController@color')->name('admin.invoice.color.return');
        Route::get('/Returns/totalnumber', 'ReturnsController@totalnumber')->name('admin.invoice.totalnumber.return');
        Route::post('/Returns/storee', 'ReturnsController@storee')->name('admin.returns.store.store');
        Route::post('/Returns/sttoree', 'ReturnsController@sttoree')->name('admin.returns.store.sttoree');
        Route::post('/Returns/store/barn', 'ReturnsController@barn')->name('admin.returns.store.store.barn');
        Route::get('/Returns/print/{id?}', 'ReturnsController@print')->name('admin.Returns.list.detail.print');
        Route::post('/Returns/store/manager', 'ReturnsController@manager')->name('admin.returns.store.manager');
        Route::post('/Returns/store/success', 'ReturnsController@success')->name('admin.returns.store.success.barn');
        Route::get('/Returns/dm/{id?}', 'ReturnsController@dm')->name('admin.returns.check.dm');
        Route::post('/Returns/store/admi', 'ReturnsController@admi')->name('admin.returns.store.manager.admi');
        Route::get('/Returns/stoore/admiin', 'ReturnsController@admiin')->name('admin.returns.store.manager.admii');
        Route::get('/Returns/chat/{id?}', 'ReturnsController@chat')->name('admin.return.check.chat');
        Route::get('/Returns/edit/update', 'ReturnsController@update')->name('admin.returns.edit.update');
        Route::post('/Returns/storee/update', 'ReturnsController@storeeupdate')->name('admin.returns.store.store.update');
        Route::get('/Returns/qr', 'ReturnsController@qr')->name('admin.returns.store.store.qr');
        Route::delete('/Returns/delete/{id?}', 'ReturnsController@delete')->name('admin.returns.delete');
        Route::post('/Returns/store/barn/admin', 'ReturnsController@barnadmin')->name('admin.returns.store.store.barn.admin');
        Route::get('/Returns/list/nosuccess', 'ReturnsController@nosuccess')->name('admin.returns.list.nosuccess');
        Route::get('/Returns/list/success/select', 'ReturnsController@select')->name('admin.returns.list.nosuccess.select');
        Route::get('/Returns/list/scheduling', 'ReturnsController@scheduling')->name('admin.returns.list.scheduling');
        Route::post('/Returns/list/store', 'ReturnsController@Liststore')->name('admin.returns.success.list.store');
        Route::get('/Returns/list/exit/{id?}', 'ReturnsController@exit')->name('admin.returns.exit');


        //ComplaintsController
        Route::post('/Complaints/store', 'ComplaintsController@store')->name('admin.Complaints.store');
        Route::post('/Complaints/store/detail', 'ComplaintsController@StoreDetail')->name('admin.Complaints.StoreDetail');
        Route::get('/Complaints/list', 'ComplaintsController@list')->name('admin.Complaints.list');
        Route::get('/Complaints/item', 'ComplaintsController@item')->name('admin.Complaints.list.item');
        Route::get('/Complaints/invoice', 'ComplaintsController@invoice')->name('admin.Complaints.list.invoice');
        Route::get('/Complaints/detail/{id?}', 'ComplaintsController@detail')->name('admin.Complaints.list.detail');
        Route::get('/Complaints/close', 'ComplaintsController@close')->name('admin.Complaints.close');
        Route::get('/Complaints/check', 'ComplaintsController@check')->name('admin.Complaints.check');
        Route::get('/Complaints/file', 'ComplaintsController@file')->name('admin.Complaints.file.check');
        Route::get('/Complaints/filedes', 'ComplaintsController@filedes')->name('admin.Complaints.file.check.des');


    });

    Route::group(["namespace" => "Setting"], function () {

        //InvoiceController
        Route::get('/setting/wizard', 'SettingController@wizard')->name('admin.setting.wizard');
        Route::post('/setting/store', 'SettingController@store')->name('admin.setting.store');

        //ReasonsToStopController
        Route::get('/Reasonstostop/list', 'ReasonsToStopController@list')->name('admin.Reasonstostop.list');
        Route::get('/Reasonstostop/update/{id?}', 'ReasonsToStopController@update')->name('admin.Reasonstostop.update');
        Route::delete('/Reasonstostop/delete/{id?}', 'ReasonsToStopController@delete')->name('admin.Reasonstostop.delete');
        Route::post('/Reasonstostop/store', 'ReasonsToStopController@store')->name('admin.Reasonstostop.store');
        Route::get('/Reasonstostop/list/select', 'ReasonsToStopController@getcharacteristic')->name('admin.list.Reasonstostop');


    });

    Route::group(["namespace" => "Admin"], function () {

        //BankController
        Route::get('/bank/list', 'BankController@list')->name('admin.bank.list');
        Route::get('/bank/update/{id?}', 'BankController@update')->name('admin.bank.update');
        Route::delete('/bank/delete/{id?}', 'BankController@delete')->name('admin.bank.delete');
        Route::post('/bank/store', 'BankController@store')->name('admin.bank.store');

        //SelectStoreController
        Route::get('/selectstore/list', 'SelectStoreController@list')->name('admin.selectstore.list');
        Route::post('/selectstore/store', 'SelectStoreController@store')->name('admin.selectstore.store');
        Route::get('/selectstore/update/{id?}', 'SelectStoreController@update')->name('admin.selectstore.update');
        Route::delete('/selectstore/delete/{id?}', 'SelectStoreController@delete')->name('admin.selectstore.delete');


    });

    Route::group(["namespace" => "Barn"], function () {

        //BarnColorController
        Route::get('/carncolor/list', 'BarnColorController@list')->name('admin.barncolor.list');
        Route::post('/carncolor/store', 'BarnColorController@store')->name('admin.barncolor.store');
        Route::get('/update/list/{id?}', 'BarnColorController@update')->name('admin.barncolor.update');

        //BarnMaterialController
        Route::get('/barnmaterial/list', 'BarnMaterialController@list')->name('admin.barnmaterial.list');
        Route::post('/barnmaterial/store', 'BarnMaterialController@store')->name('admin.barnmaterial.store');
        Route::get('/barnmaterial/update/list/{id?}', 'BarnMaterialController@update')->name('admin.barnmaterial.update');


        //BarnProductController
        Route::get('/barnproduct/list', 'BarnProductController@list')->name('admin.barnproduct.list');
        Route::get('/barnproduct/listtwo', 'BarnProductController@listtwo')->name('admin.barnproduct.listtwo');
        Route::get('/barnproduct/receiptproduct', 'BarnProductController@receiptproduct')->name('admin.receiptproduct.list');
        Route::get('/barnproduct/receiptwizard/{id?}', 'BarnProductController@receiptwizard')->name('admin.receiptproduct.wizard');
        Route::post('/barnproduct/store', 'BarnProductController@store')->name('admin.barnproduct.store');
        Route::get('/barnproduct/update/list/{id?}', 'BarnProductController@update')->name('admin.barnproduct.update');
        Route::post('/barnproduct/restore', 'BarnProductController@restore')->name('admin.barnproduct.restore');
        Route::get('/barnproduct/receiptreturn', 'BarnProductController@receiptreturn')->name('admin.receiptreturn.list');
        Route::post('/receiptreturn/restore', 'BarnProductController@restorereturn')->name('admin.receiptreturn.restore');
        Route::get('/receiptreturn/receiptreturns/{id?}', 'BarnProductController@receiptwizardreturn')->name('admin.receiptreturn.wizard');
        Route::get('/barnproduct/receiptamster', 'BarnProductController@receiptcarncolor')->name('admin.receiptamster.list');
        Route::get('/receiptcroncolor/receiptreturns/{id?}', 'BarnProductController@receiptwizardcroncolor')->name('admin.receiptcroncolor.wizard');
        Route::post('/receiptcroncolor/restore', 'BarnProductController@restorecarncolor')->name('admin.restorecarncolor.restore');
        Route::get('/receiptpolim/receiptamster', 'BarnProductController@receiptpolim')->name('admin.receiptpolim.list');
        Route::get('/receiptpolim/receiptreturns/{id?}', 'BarnProductController@receiptwizardpolim')->name('admin.receiptpolim.wizard');
        Route::post('/receiptpolim/restore', 'BarnProductController@restorepolim')->name('admin.receiptpolim.restore');
        Route::get('/receiptpolim/list/detail/factor', 'BarnProductController@ListList')->name('admin.receiptpolim.list.detail.factor');


        //BarnTemporaryController
        Route::get('/barntemporary/list', 'BarnTemporaryController@list')->name('admin.barntemporary.list');

        //BarnReturnsController
        Route::get('/barnreturn/list', 'BarnReturnsController@list')->name('admin.barnreturn.list');


        //TransferBarnController
        Route::get('/transferbarn/list', 'TransferBarnController@list')->name('admin.transferbarn.list');
        Route::get('/transferbarn/check', 'TransferBarnController@check')->name('admin.transferbarn.check');
        Route::post('/transferbarn/store', 'TransferBarnController@store')->name('admin.transferbarn.store');

        Route::post('/transferbarn/update', 'TransferBarnController@update')->name('admin.transferbarn.update');


        Route::get('/transferbarn/edit', 'TransferBarnController@edit')->name('admin.transferbarn.edit');







    });

    Route::group(["namespace" => "Report"], function () {

        //CustomerStatusReport
        Route::get('/CustomerStatusReport/list', 'CustomerStatusReportController@list')->name('admin.CustomerStatusReport.list');
        Route::get('CustomerStatusReport/print', 'CustomerStatusReportController@print')->name('admin.CustomerStatusReport.print');
        Route::get('/CustomerStatusReport/list/detail', 'CustomerStatusReportController@detail')->name('admin.CustomerStatusReport.list.detail');

        //ReportMonthly
        Route::get('/ReportMonthly/list', 'ReportMonthlyController@list')->name('admin.ReportMonthly.list');
        Route::get('/CustomerTransactions/list', 'ReportMonthlyController@CustomerTransactions')->name('admin.CustomerTransactions.list');
        Route::get('CustomerTransactions/print', 'CustomerStatusReportController@CustomerTransactionsPrint')->name('admin.CustomerTransactions.print');
        Route::get('/ReportMonthly/list/exit', 'ReportMonthlyController@ExitList')->name('admin.ReportMonthly.exit.list');
        Route::get('ReportMonthly/print/exit', 'ReportMonthlyController@ExitPrint')->name('admin.CustomerStatusReport.exit.print');





        Route::get('/ReportMonthly/list/tolid', 'ReportMonthlyController@Tolid')->name('admin.ReportMonthly.list.tolid');
        Route::get('/ReportMonthly/list/frosh', 'ReportMonthlyController@Frosh')->name('admin.ReportMonthly.list.frosh');
        Route::get('/ReportMonthly/list/mar', 'ReportMonthlyController@Mar')->name('admin.ReportMonthly.list.mar');


        Route::get('/ReportMonthly/list/asnad', 'ReportMonthlyController@asnad')->name('admin.ReportMonthly.list.asnad');


    });

    Route::group(["namespace" => "Payment"], function () {

        //PaymentsController
        Route::get('/payment/list', 'PaymentsController@list')->name('admin.payment.list');
        Route::get('/payment/detaillist', 'PaymentsController@detaillist')->name('admin.payment.detaillist');
        Route::get('/payment/paymentsuccess', 'PaymentsController@paymentsuccess')->name('admin.paymentsuccess.list');
        Route::get('/payment/list/list', 'PaymentsController@listdetail')->name('admin.payment.list.list');
        Route::get('payment/payment', 'PaymentsController@payment')->name('admin.payment.list.payment');
        Route::post('payment/storepament', 'PaymentsController@storepament')->name('admin.payment.store.storepament');
        Route::post('payment/store/admin', 'PaymentsController@StoreAdmin')->name('admin.payment.store.admin');
        Route::post('payment/factor', 'PaymentsController@factor')->name('admin.payment.delete.factor');
        Route::get('/payment/update/{id?}', 'PaymentsController@update')->name('admin.payment.update');
        Route::get('/paymentt/updatee/{id?}', 'PaymentsController@updatee')->name('admin.payment.updatee');
        Route::get('/payment/admin/trash/{id?}', 'PaymentsController@trash')->name('admin.payment.trash');
        Route::get('/payment/admin/edit/{id?}', 'PaymentsController@edit')->name('admin.payment.edit');
        Route::post('/payment/admin/update', 'PaymentsController@EditUpdate')->name('admin.payment.edit.update');
        Route::get('/payment/list/detail/factor', 'PaymentsController@ListList')->name('admin.payment.list.detail.factor');
        Route::get('/payment/list/detail/factor/detail', 'PaymentsController@ListListDetail')->name('admin.payment.list.detail.factor.detail');
        Route::get('/payment/list/detail/factor/payment', 'PaymentsController@ListListPayment')->name('admin.payment.list.detail.factor.payment');
        Route::get('/payment/check/list/{id?}', 'PaymentsController@CheckList')->name('admin.payment.check.list');
        Route::get('/payment/list/detail/factor/pack', 'PaymentsController@ListListpack')->name('admin.payment.list.detail.factor.pack');
        Route::get('/payment/statussort/statussort', 'PaymentsController@statussort')->name('admin.payment.list.detail.statussort');


        //BillsController
        Route::get('/bills/list', 'BillsController@list')->name('admin.bills.list');
        Route::get('/bills/detaillist', 'BillsController@detaillist')->name('admin.bills.detaillist');
        Route::get('/bills/success/admin/{id?}', 'BillsController@SuccessAdmin')->name('admin.payment.success.admin');
        Route::get('/bills/print/payment/{id?}', 'BillsController@PrintPayment')->name('admin.bills.print.detail');


        //PaymentDocumentController
        Route::get('/PaymentDocument/list', 'PaymentDocumentController@list')->name('admin.PaymentDocument.list');
        Route::get('/PaymentDocument/paymentlist/{id?}', 'PaymentDocumentController@paymentlist')->name('admin.CustomerAccount.check.payment.list');
        Route::post('/PaymentDocument/store/payment', 'PaymentDocumentController@store')->name('admin.CustomerAccount.store.payment');

        //RequestMoneyController
        Route::get('/RequestMoney/list', 'RequestMoneyController@list')->name('admin.RequestMoney.list');
        Route::post('/RequestMoney/store', 'RequestMoneyController@store')->name('admin.RequestMoney.store');
        Route::post('/RequestMoney/storestatus', 'RequestMoneyController@storestatus')->name('admin.RequestMoney.store.status');
        Route::delete('/RequestMoney/delete/{id?}', 'RequestMoneyController@delete')->name('admin.RequestMoney.delete');
        Route::get('/RequestMoney/update/{id?}', 'RequestMoneyController@update')->name('admin.RequestMoney.update');
        Route::get('/RequestMoney/admin/{id?}', 'RequestMoneyController@admin')->name('admin.RequestMoney.admin');
        Route::get('RequestMoney/CustomerTransactions', 'RequestMoneyController@CustomerTransactions')->name('admin.RequestMoney.CustomerTransactions');
        Route::get('/RequestMoney/list/select', 'RequestMoneyController@filter')->name('admin.RequestMoney.filter');


    });

    Route::group(["namespace" => "Manufacturing"], function () {

        //ProductionOrderController
        Route::get('/productionorder/list', 'ProductionOrderController@list')->name('admin.productionorder.list');
        Route::get('/productionorder/edit/{id?}', 'ProductionOrderController@edit')->name('admin.productionorder.edit');
        Route::get('/productionorder/wizard', 'ProductionOrderController@wizard')->name('admin.productionorder.wizard');
        Route::get('/productionorder/detail', 'ProductionOrderController@detail')->name('admin.productionorder.detail');
        Route::post('/productionorder/store', 'ProductionOrderController@store')->name('admin.productionorder.store');
        Route::post('/productionorder/update', 'ProductionOrderController@update')->name('admin.productionorder.update');
        Route::delete('/productionorder/delete/{id?}', 'ProductionOrderController@delete')->name('admin.productionorder.delete');


        //EventsMachineController
        Route::get('/eventsmachine/list', 'EventsMachineController@list')->name('admin.eventsmachine.list');
        Route::post('/eventsmachine/store', 'EventsMachineController@store')->name('admin.eventsmachine.store');
        //EventsFormatController
        Route::get('/eventsformat/list', 'EventsFormatController@list')->name('admin.eventsformat.list');
        Route::post('/eventsformat/store', 'EventsFormatController@store')->name('admin.eventsformat.store');
        //PMMachineController
        Route::get('/pmmachine/list', 'PMMachineController@list')->name('admin.pmmachine.list');
        Route::post('/pmmachine/store', 'PMMachineController@store')->name('admin.pmmachine.store');
        Route::get('/pmmachine/update/{id?}', 'PMMachineController@update')->name('admin.pmmachine.update');
        Route::delete('/pmmachine/delete/{id?}', 'PMMachineController@delete')->name('admin.pmmachine.delete');
        //PMFormatController
        Route::get('/pmformat/list', 'PMFormatController@list')->name('admin.pmformat.list');
        Route::post('/pmformat/store', 'PMFormatController@store')->name('admin.pmformat.store');
        Route::get('/pmformat/update/{id?}', 'PMFormatController@update')->name('admin.pmformat.update');
        Route::delete('/pmformat/delete/{id?}', 'PMFormatController@delete')->name('admin.pmformat.delete');

        //ProductionPlanningController
        Route::get('/pPlanning/list', 'ProductionPlanningController@list')->name('admin.pPlanning.list');
        Route::get('/pPlanning/deviceproduct1', 'ProductionPlanningController@deviceproduct1')->name('admin.pPlanning.deviceproduct1');
        Route::get('/pPlanning/deviceproductfalse1', 'ProductionPlanningController@deviceproductfalse1')->name('admin.pPlanning.deviceproductfalse1');
        Route::get('/pPlanning/Ldevice1', 'ProductionPlanningController@Ldevice1')->name('admin.device1.list');
        Route::get('/pPlanning/AddDevice1/{id?}', 'ProductionPlanningController@AddDevice1')->name('admin.pPlanning.AddDevice1');
        Route::get('/pPlanning/DeleteDevice1/{id?}', 'ProductionPlanningController@DeleteDevice1')->name('admin.pPlanning.DeleteDevice1');
        Route::post('pPlanning/SortDevice1', 'ProductionPlanningController@SortDevice1')->name('admin.device1.list.SortDevice1');

        Route::get('/pPlanning/deviceproduct2', 'ProductionPlanningController@deviceproduct2')->name('admin.pPlanning.deviceproduct2');
        Route::get('/pPlanning/deviceproductfalse2', 'ProductionPlanningController@deviceproductfalse2')->name('admin.pPlanning.deviceproductfalse2');
        Route::get('/pPlanning/Ldevice2', 'ProductionPlanningController@Ldevice2')->name('admin.device2.list');
        Route::get('/pPlanning/AddDevice2/{id?}', 'ProductionPlanningController@AddDevice2')->name('admin.pPlanning.AddDevice2');
        Route::get('/pPlanning/DeleteDevice2/{id?}', 'ProductionPlanningController@DeleteDevice2')->name('admin.pPlanning.DeleteDevice2');
        Route::post('pPlanning/SortDevice2', 'ProductionPlanningController@SortDevice2')->name('admin.device2.list.SortDevice2');

        Route::get('/pPlanning/deviceproduct3', 'ProductionPlanningController@deviceproduct3')->name('admin.pPlanning.deviceproduct3');
        Route::get('/pPlanning/deviceproductfalse3', 'ProductionPlanningController@deviceproductfalse3')->name('admin.pPlanning.deviceproductfalse3');
        Route::get('/pPlanning/Ldevice3', 'ProductionPlanningController@Ldevice3')->name('admin.device3.list');
        Route::get('/pPlanning/AddDevice3/{id?}', 'ProductionPlanningController@AddDevice3')->name('admin.pPlanning.AddDevice3');
        Route::get('/pPlanning/DeleteDevice3/{id?}', 'ProductionPlanningController@DeleteDevice3')->name('admin.pPlanning.DeleteDevice3');
        Route::post('pPlanning/SortDevice3', 'ProductionPlanningController@SortDevice3')->name('admin.device3.list.SortDevice3');

        Route::get('/pPlanning/deviceproduct4', 'ProductionPlanningController@deviceproduct4')->name('admin.pPlanning.deviceproduct4');
        Route::get('/pPlanning/Ldevice4', 'ProductionPlanningController@Ldevice4')->name('admin.device4.list');
        Route::get('/pPlanning/AddDevice4/{id?}', 'ProductionPlanningController@AddDevice4')->name('admin.pPlanning.AddDevice4');
        Route::get('/pPlanning/DeleteDevice4/{id?}', 'ProductionPlanningController@DeleteDevice4')->name('admin.pPlanning.DeleteDevice4');
        Route::post('pPlanning/SortDevice4', 'ProductionPlanningController@SortDevice4')->name('admin.device4.list.SortDevice4');

        Route::get('/pPlanning/deviceproduct5', 'ProductionPlanningController@deviceproduct5')->name('admin.pPlanning.deviceproduct5');
        Route::get('/pPlanning/Ldevice5', 'ProductionPlanningController@Ldevice5')->name('admin.device5.list');
        Route::get('/pPlanning/AddDevice5/{id?}', 'ProductionPlanningController@AddDevice5')->name('admin.pPlanning.AddDevice5');
        Route::get('/pPlanning/DeleteDevice5/{id?}', 'ProductionPlanningController@DeleteDevice5')->name('admin.pPlanning.DeleteDevice5');
        Route::post('pPlanning/SortDevice5', 'ProductionPlanningController@SortDevice5')->name('admin.device5.list.SortDevice5');

        //ViewProductController
        Route::get('/viewproduct/list', 'ViewProductController@list')->name('admin.viewproduct.list');

        //ManufacturingController
        Route::get('/Manufacturing/list', 'ManufacturingController@list')->name('admin.Manufacturing.list');
        Route::get('/Manufacturing/device1/list', 'ManufacturingController@deviceList1')->name('admin.Manufacturing.device1.list');
        Route::get('/Manufacturing/device1/detail1/{id?}', 'ManufacturingController@detail1')->name('admin.Manufacturing.device1.detail1');
        Route::get('/Manufacturing/device2/list', 'ManufacturingController@deviceList2')->name('admin.Manufacturing.device2.list');
        Route::get('/Manufacturing/device3/list', 'ManufacturingController@deviceList3')->name('admin.Manufacturing.device3.list');
        Route::get('/Manufacturing/device1/start/{id?}', 'ManufacturingController@start1')->name('admin.Manufacturing.device1.start');
        Route::post('/Manufacturing/device1/add', 'ManufacturingController@add1')->name('admin.Manufacturing.device1.add');
        Route::post('/Manufacturing/device1/check', 'ManufacturingController@check1')->name('admin.Manufacturing.device1.check');
        Route::get('/Manufacturing/device1/edit/{id?}', 'ManufacturingController@edit1')->name('admin.Manufacturing.device1.edit');
        Route::delete('/Manufacturing/delete1/{id?}', 'ManufacturingController@delete1')->name('admin.Manufacturing.device1.delete');

        //StopDeviceController
        Route::get('/stopdevice/list', 'StopDeviceController@list')->name('admin.devicestop.device1.list');

        Route::post('/stopdevice/device1/stop', 'StopDeviceController@stop1')->name('admin.Manufacturing.device1.stop');
        Route::delete('/stopdevice/delete1/{id?}', 'StopDeviceController@delete1')->name('admin.Manufacturing.device1.stop.delete');
        Route::get('/stopdevice/device1/edit/{id?}', 'StopDeviceController@edit1')->name('admin.Manufacturing.device1.stop.edit');


    });


    Route::get('/testttt', 'TestController@testttt');
    Route::get('/estttt', 'TestController@estttt');
    Route::get('/g', 'TestController@g');
    Route::get('/table', 'TestController@table');
    Route::get('/showDatatable', 'TestController@showDatatable')->name('showDatatable');
    Route::get('/refresh', 'TestController@refresh')->name('admin.table.refresh');
    Route::post('/updateOrder', 'TestController@updateOrder')->name('updateOrder');
    Route::get('/send', 'NotifController@tttt');


});


