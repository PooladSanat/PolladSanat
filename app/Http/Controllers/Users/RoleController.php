<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;
use Response;
use UxWeb\SweetAlert\SweetAlert;
use Validator;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\MsgSuccess;

class RoleController extends Controller
{
    /**
     * نمایش فرم ثبت بخش جدید*
     */
    public function wizard()
    {
        $permissions = Permission::all();
        return view('roles.wizard', compact('permissions'));

    }

    /**
     * در این بخش اطلاعات  از فرم گرفته میشود  و در حدولهای مربوط به سطح دسترسی در دیتا بیس ذخیره میشود*
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'نام نقش را وارد کنید',
        ]);

        if ($validator->passes()) {
            Role::updateOrCreate(['id' => $request->product_id],
                [
                    'name' => $request->name,
                ]);
            return response()->json(['success' => 'Product saved successfully.']);
        }
        return Response::json(['errors' => $validator->errors()]);

    }

    /**
     *نمایش لیست بخش ها*
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('date', function ($row) {
                    $date = Jalalian::forge($row->created_at)->format('Y/m/d');
                    return $date;
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('roles.show');
    }

    /**
     *نمایش فرم ویرایش بخش ها*
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $rolePermission = \DB::table("permission_role")
            ->where("permission_role.role_id", $id)
            ->pluck("permission_role.permission_id", "permission_role.permission_id")
            ->all();
        $permissions = Permission::get();
        return view('roles.edit', compact('permissions', 'role', 'rolePermission'));
    }

    public function copy($id)
    {
        $role = Role::find($id);
        $rolePermission = \DB::table("permission_role")
            ->where("permission_role.role_id", $id)
            ->pluck("permission_role.permission_id", "permission_role.permission_id")
            ->all();
        $permissions = Permission::get();
        return view('roles.copy', compact('permissions', 'role', 'rolePermission'));
    }

    /**
     *به روزرسانی بخش ها*
     */
    public function update(Request $request)
    {
        $role = Role::find($request->id);
        $role->name = $request->input('name');
        $role->save();
        $success = $role->permissions()->sync($request->input('permission'));
        if ($success) {
            return MsgSuccess('نقش با موفقیت در سیستم ویرایش شد');
        }
    }

    public function uCopy(Request $request)
    {
        $role = new Role();
        $role->name = $request->input('name');
        $role->save();
        $success = $role->permissions()->sync($request->input('permission'));
        if ($success) {
            return MsgSuccess('نقش با موفقیت در سیستم ثبت شد');
        }
    }

    /**
     *حذف بخش ها*
     */
    public function delete($id)
    {
        $post = Role::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }

    /**
     *نمایش فرم دسترسی ها*
     */
    public function permission(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $this->actio($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('permissions.wizard');
    }

    /**
     *ثبت دسترسی های حدید در سیستم*
     */
    public function Pstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'label' => 'required',
            'name' => 'required',
        ], [
            'label.required' => 'لطفا مسیر دسترسی را وارد کنید',
            'name.required' => 'لطفا نام دسترسی را وارد کنید',
        ]);
        if ($validator->passes()) {
            Permission::updateOrCreate(['id' => $request->product_id],
                [
                    'name' => $request->name,
                    'label' => $request->label,
                ]);
            return response()->json(['success' => 'Product saved successfully.']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * حذف دسترسی ها*
     */
    public function Pdelete($id)
    {
        $post = Permission::findOrFail($id);
        $post->delete();
        return response()->json($post);
    }

    /**
     * ویرایش دسترسی ها*
     */
    public function Pupdate($id)
    {
        $product = Permission::find($id);
        return response()->json($product);

    }

    /**
     * اکشن های دیتا تیبل*
     */
    public function actions($row)
    {
        $btn = '<a href="' . route('admin.role.edit', $row->id) . '">
                       <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                       </a>&nbsp;&nbsp;';

        $btn .= '<a href="' . route('admin.role.copy', $row->id) . '">
        <i class="fa fa-copy fa-lg" title="کپی"></i>
                       </a>&nbsp;&nbsp;';

        $ro = DB::table('role_user')->where('role_id', $row->id)->first();
        if (empty($ro)) {
            $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="حذف"
                       class="deleteProduct">
                        <i class="fa fa-trash fa-lg" title="حذف"></i>
                       </a>';
        }


        return $btn;

    }

    public function actio($row)
    {

        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="editProduct">
                       <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                       </a>&nbsp;&nbsp;';
        $pers = DB::table('permission_role')->where('permission_id', $row->id)->first();
        if (empty($pers)) {
            $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="حذف"
                       class="deleteProduct">
                       <i class="fa fa-trash fa-lg" title="حذف"></i>
                       </a>';
        }
        return $btn;

    }


}
