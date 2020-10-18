<?php


namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

use App\Detail;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Morilog\Jalali\Jalalian;
use Response;
use Validator;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\MsgError;
use function App\Providers\MsgSuccess;


class UserController extends Controller
{
    /**
     * بررسی انلاینی پرسنل *
     */
    public function isOnline()
    {
        return \Cache::has('active' . $this->id);
    }

    /**
     * نمایش فرم ثبت نام کاربر *
     */
    public function wizard()
    {
        $roles = Role::all();
        return view('users.wizard', compact('roles'));
    }

    /**
     *ثبت نام کاربر جدید در سیستم*
     */
    public function store(Request $request)
    {


        if (!empty($request->id)) {
            $user = User::find($request->id);
            if ($user->email != $request->email) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'phone' => 'required',
                    'email' => 'required|unique:users',
                ], [
                    'email.unique' => 'کاربری با این نام کاربری در سیستم موجود است.',
                    'email.required' => 'پر کردن فیلد نام کاربری الزامی میباشد.',
                ]);
            } else
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'phone' => 'required',
                    'email' => 'required',
                ], [
                    'email.required' => 'پر کردن فیلد نام کاربری الزامی میباشد.',
                ]);
        } else
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'phone' => 'required',
                'password' => 'required',
                'email' => 'required|unique:users',
            ], [
                'email.unique' => 'کاربری با این نام کاربری در سیستم موجود است.',
                'email.required' => 'پر کردن فیلد نام کاربری الزامی میباشد.',
            ]);


        if (!empty($request->id)) {
            if (!empty($request->password)) {
                $password = \Hash::make($request->password);
            } else {
                $password = $user->password;
            }
        } else {
            $password = \Hash::make($request->password);

        }
        if ($request->hasFile('sign')) {
            $file = $request->file('sign');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $sign = $request->file('sign')->move('public/upload/sign/', $name);
        } else {
            $sign = null;
        }
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $avatar = $request->file('avatar')->move('public/upload/avatar/', $name);
        } else {
            $avatar = null;
        }


        if ($validator->passes()) {

            $users = User::updateOrCreate(['id' => $request->id],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => $password,
                    'avatar' => $avatar,
                    'sign' => $sign,
                ]);
            $users->roles()->sync($request->input('roles'));
            return response()->json(['success' => 'Product saved successfully.']);
        }
        return Response::json(['errors' => $validator->errors()]);

    }

    /**
     * نمایش پروفایل پرسنل *
     */
    public function profile()
    {
        return view('profile.profile');
    }

    /**
     *ویرایش مشخصات کاربران*
     */
    public function update(Request $request)
    {
        $users = User::where('id', $request->id)->get();
        foreach ($users as $user)
            if ($user->email != $request->input('email')) {
                $this->validate($request, [
                    'email' => 'required|unique:users',
                ], [
                    'email.unique' => 'کاربری با این کد ملی در سیستم موجود است.',
                    'email.required' => 'پر کردن فیلد کد ملی الزامی میباشد.',
                ]);
            }
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);
        $user = User::find($user->id)->update([
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
        ]);
        if ($user) {
            return MsgSuccess('مشخصات شما با موفقیت ویرایش شد');
        } else
            return back();
    }

    /**
     *ویرایش گلمه عبور کاربران*
     */
    public function reset(Request $request)
    {
        $this->validate($request, [
            'old_pass' => 'required',
            'new_pass' => 'required',
        ]);
        $input = $request->all();
        $users = User::where('id', $request->id)->get();
        foreach ($users as $user)
            if (!Hash::check($input['old_pass'], $user->password)) {
                return MsgError('کلمه عبور قبلی صحیح نمیباشد');
            } else {
                $user = User::find($user->id)->update([
                    'password' => Hash::make($request->input('new_pass')),
                ]);
                if ($user) {
                    return MsgSuccess('کلمه عبور شما با موفقیت ویرایش شد');
                } else
                    return back();
            }
    }

    /**
     *ویرایش تصویر کاربران*
     */
    public function avatar(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'mimes:jpeg,jpg,png|required',
        ]);
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $avatar = $request->file('avatar')->move('public/upload/avatar/', $name);
        }
        $users = User::where('id', $request->id)->get();
        foreach ($users as $user)
            $user = User::find($user->id)->update([
                'avatar' => $avatar,
            ]);
        if ($user) {
            return MsgSuccess('تصویر پروفایل شما با موفقیت ویرایش شد');
        } else
            return back();
    }

    /**
     *نمایش لیست کاربران*
     */
    public function show(Request $request)
    {
        $roles = Role::all();
        if ($request->ajax()) {
            $data = \DB::select( \DB::raw("SELECT * FROM view_role_user") );

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('online', function ($row) {
                    $online = url('/public/icon/online.png');
                    $offline = url('/public/icon/offline.png');
                    if (\Cache::has('active' . $row->user_id)) {
                        return '<img src="' . $online . '" title="انلاین" width="20">';
                    } else
                        return '<img src="' . $offline . '" title="افلاین" width="20">';
                })
                ->addColumn('status', function ($row) {
                    $active = url('/public/icon/icons8-checked-user-male.png');
                    $notActive = url('/public/icon/icons8-checked-user-male-40.png');
                    if ($row->status == null) {
                        return '<img src="' . $active . '" title="فعال" width="20">';
                    } else
                        return '<img src="' . $notActive . '" title="غیرفعال" width="20">';
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action', 'online', 'status'])
                ->make(true);
        }
        return view('users.list', compact('roles'));
    }

    /**
     *نمایش لیست کاربران*
     */
    public function disable(Request $request)
    {
        $sStatus = User::where('id', $request->id)->get();
        foreach ($sStatus as $status)
            if ($status->status == null) {
                $ok = User::find($status->id)->update([
                    'status' => 1,
                ]);
                if ($ok) {
                    return response()->json(['errors' => 'تمام فعالیت های کاربر با موفقیت غیر فعال شد']);
                }
            } else {
                $success = User::find($status->id)->update([
                    'status' => null,
                ]);
                if ($success) {
                    return response()->json(['success' => 'تمام فعالیت های کاربر با موفقیت فعال شد']);
                }
            }
    }

    /**
     *نمایش فرم ویرایش کاربران*
     */
    public function edit(User $id)
    {
        $role = \DB::table('role_user')->where('user_id', $id->id)
            ->pluck('role_id')
            ->all();
        if (!empty($role)) {
            foreach ($id->roles as $role)
                $rol = $role->id;
        } else {
            $rol = null;
        }
        $roles = Role::all();
        return view('users.edit', compact('roles', 'id', 'rol'));

    }

    /**
     *ویرایش کاربران*
     */
    public function updates(Request $request)
    {

        $user = User::find($request->input('id'));
        if ($user->email != $request->input('email')) {
            $this->validate($request, [
                'email' => 'required|unique:users',
            ], [
                'email.unique' => 'کاربری با این نام کاربری در سیستم موجود است.',
                'email.required' => 'پر کردن فیلد نام کاربری الزامی میباشد.',
            ]);
        }
        if (!empty($request->input('avatar'))) {
            $this->validate($request, [
                'avatar' => 'mimes:jpeg,jpg,png',
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
            ], [
                'email.required' => 'پر کردن فیلد نام کاربری الزامی میباشد.',
            ]);
        } else
            $this->validate($request, [
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',

            ], [
                'email.required' => 'پر کردن فیلد نام کاربری الزامی میباشد.',
            ]);
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $avatar = $request->file('avatar')->move('public/upload/avatar/', $name);
        } else {
            $avatar = $user->avatar;
        }

        if ($request->hasFile('sign')) {
            $file = $request->file('sign');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $sign = $request->file('sign')->move('public/upload/sign/', $name);
        } else {
            $sign = null;
        }

        if (!empty($request->input('password'))) {
            $pass = Hash::make($request->input('password'));
        } else {
            $pass = $user->password;
        }
        $update = $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => $pass,
            'avatar' => $avatar,
            'sign' => $sign,
        ]);
        if ($update) {
            $delete = \DB::table('role_user')->where('user_id', $request->id)->delete();
            if ($delete) {
                $success = $user->roles()->sync($request->input('roles'));
                if ($success) {
                    return MsgSuccess('مشخصات کاربر با موفقیت ویرایش شد');
                }
            }
        }

    }

    /**
     *  قفل صفحه*
     */
    public function lock()
    {
        return view('lock.lock');
    }

    /**
     * ارسال کبمه عبور جدید برای کاربران
     */
    public function RestPassword(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
        ], [
            'phone.required' => 'لطفا شماره ثبت شده در سیستم را وارد کنید',
        ]);
        $users = User::where('phone', $request->input('phone'))->get();
        foreach ($users as $user)
            if ($user) {
                $password = rand(999999, 000000);
                session()->flash('pass-success', 'کلمه عبور جدید با موفقیت برای شما ارسال شد');
                return back();
            }
        session()->flash('pass-error', 'شماره وارد شده اشتباه است کاربری با این شماره در سیستم موجود نمیباشد');
        return back();
    }

    /**
     * متوقف کردن نرم افزار*
     */
    public function stop()
    {

        $exit = \DB::table('users')->update([
            'exit' => 1,
        ]);
        if ($exit) {
            $user = User::where('id', auth()->user()->id)->get();
            foreach ($user as $use)
                $success = User::find($use->id)->update([
                    'exit' => null,
                ]);
            if ($success) {
                return response()->json(['success' => 'سیستم اماده بازسازی میباشد']);
            }
        } else {
            return Response::json(['errors' => 'در حال حاضر امکان توقف سرویس های نرم افزار ممکن نیست']);
        }

    }

    /**
     * شروع کار نرم افزار *
     */
    public function start()
    {
        $exit = \DB::table('users')->update([
            'exit' => null,
        ]);
        if ($exit) {
            return response()->json(['success' => 'نرم افزار با موفقیت راه اندازی شد']);
        } else {
            return Response::json(['errors' => 'تمام سرویس های نرم افزار در حال اجرا هستند نیازی به راه اندازی نیست']);
        }
    }

    /**
     * اکشن های دیتا تیبل *
     */
    public function actions($row)
    {

        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->user_id . '" data-original-title="ویرایش"
                       class="editProduct">
                       <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                      </a>&nbsp;&nbsp;';

        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->user_id . '" data-original-title="فعال و غیر فعال کردن کاربر"
                       class="status">
                        <i class="fa fa-lock fa-lg" title="فعال و غیر فعال کردن کاربر"></i>
                       </a>';

        return $btn;
    }

    /**
     * ویرایش مشخصات کاربران *
     */
    public function u($id)
    {
        $role_users = \DB::table('role_user')
            ->where('user_id', $id)
            ->get();
        foreach ($role_users as $role_user)
            $roles = Role::where('id', $role_user->role_id)->get();
        $product = User::find($id);
        return response()->json(['product' => $product, 'roles' => $roles]);


    }

//    function convertPersianNumbersToEnglish($input)
//    {
//        $persian = ['۰', '۱', '۲', '۳', '۴', '٤', '۵', '٥', '٦', '۶', '۷', '۸', '۹'];
//        $english = [0, 1, 2, 3, 4, 4, 5, 5, 6, 6, 7, 8, 9];
//        return str_replace($english, $persian, $input);
//    }

    public function backup()
    {
        \Artisan::call('backup:run --only-db');
        return response()->json(['success' => 'عملیات پشتیبان گیری با موفقیت انجام شد']);
    }

}

