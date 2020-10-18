<?php

namespace App\Http\Controllers\Users;

use App\Alternatives;
use App\Commodity;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;
use Morilog\Jalali\Jalalian;
use Response;
use Yajra\DataTables\DataTables;
use function App\Providers\MsgError;
use function App\Providers\MsgSuccess;

class AlternativesController extends Controller
{
    /**
     * نمایش فرم جابجایی*
     */
    public function wizard(Request $request)
    {
        $users = User::all();
        if ($request->ajax()) {
            $data = Alternatives::whereNull('status')->orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('alternatives', function ($row) {
                    $user = User::find($row->alternate_id);
                    return $user->name;
                })
                ->addColumn('action', function ($row) {
                    return $this->actions($row);
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('alternatives.list', compact('users'));
    }

    /**
     *ثبت جایگزین*
     * در این قسمت اطلاعات از صفحه جایجایی دریافت میشود و پس از ولدیت کردن شروع به ذخیره اطلاعات  در جدول مربوطه میشویم*
     */
    public function store(Request $request)
    {
//        if (empty($request->product_id)) {
//            if ($request->user_id == $request->alternate_id) {
//                return Response::json(['errors' => 'انتخاب فرد جایگزین اشتباه است لطفا در انتخاب فرد جایگزین دقت کنید']);
//            }
//            if ($request->from > $request->ToDate or $request->from == $request->ToDate) {
//                return Response::json(['errors' => 'تاریخ انتخاب شده اشتباه است لطفا در انتخاب تاریخ جایگزینی دقت کنید']);
//            }
//            $check_users = Alternatives::whereNull('status')->get();
//            foreach ($check_users as $check_user) {
//                if (!empty($check_user)) {
//                    if ($check_user->user_id == $request->alternate_id) {
//                        return Response::json(['errors' => 'پرسنلی که برای جانشینی انتخاب کرده اید در مرخصی میباشد']);
//                    }
//                    if ($check_user->alternate_id == $request->user_id) {
//                        return Response::json(['errors' => 'پرسنل مرود نظر به عنوان جانشین در سیستم ثبت شده است']);
//                    }
//                    if ($check_user->alternate_id == $request->alternate_id and $check_user->user_id == $request->user_id) {
//                        return Response::json(['errors' => 'این جایگزنی در سیستم ثبت شده است و فعال میباشد']);
//                    }
//                }
//            }
//        }
//        if ($request->user_id == $request->alternate_id) {
//            return Response::json(['errors' => 'انتخاب فرد جایگزین اشتباه است لطفا در انتخاب فرد جایگزین دقت کنید']);
//        }
//        if ($request->from > $request->ToDate or $request->from == $request->ToDate) {
//            return Response::json(['errors' => 'تاریخ انتخاب شده اشتباه است لطفا در انتخاب تاریخ جایگزینی دقت کنید']);
//        }
//        $check_users = Alternatives::whereNull('status')->get();
//        foreach ($check_users as $check_user) {
//            if (!empty($check_user)) {
//                if ($check_user->user_id == $request->alternate_id) {
//                    return Response::json(['errors' => 'پرسنلی که برای جانشینی انتخاب کرده اید در مرخصی میباشد']);
//                }
//                if ($check_user->alternate_id == $request->user_id) {
//                    return Response::json(['errors' => 'پرسنل مرود نظر به عنوان جانشین در سیستم ثبت شده است']);
//                }
//            }
//        }


        $success = Alternatives::updateOrCreate(['id' => $request->product_id],
            [
                'user_id' => $request->user_id,
                'alternate_id' => $request->alternate_id,
                'from' => $request->from,
                'ToDate' => $request->ToDate,
            ]);
        if ($success) {
            $role_users = \DB::table('role_user')
                ->where('user_id', $request->input('user_id'))
                ->get();
            foreach ($role_users as $role_user)
                $duplicate = \DB::table('role_user')
                    ->where([
                        'user_id' => $request->input('alternate_id'),
                        'role_id' => $role_user->role_id,
                    ])->first();
            if (!$duplicate) {
                \DB::table('role_user')->insert([
                    'user_id' => $request->input('alternate_id'),
                    'role_id' => $role_user->role_id,
                    'label' => "1",
                ]);
                return Response::json(['success' => 'جایگزینی با موفقیت ثبت شد و اعلان برای کاربران ارسال خواهد شد']);
            } else {
                return Response::json(['success' => 'جایگزینی با موفقیت ثبت شد و اعلان برای کاربران ارسال خواهد شد']);
            }
        }

    }

    /**
     * حذف مشخصات گروه کالایی *
     */
    public function delete($id)
    {
        $post = Alternatives::findOrFail($id);
        \DB::table('role_user')
            ->where('user_id', $post->alternate_id)
            ->whereNotNull('label')->delete();
        $post->delete();
        return response()->json($post);
    }

    /**
     * ویرایش مشخصات گروه کالایی *
     */
    public function update($id)
    {
        $product = Alternatives::find($id);
        return response()->json($product);
    }

    /**
     * تایید مشاهده توفیکیشن مربوط به جابجایی *
     */
    public function view(Request $request)
    {
        $alternatives = Alternatives::where('alternate_id', auth()->user()->id)
            ->whereNull('view')->get();
        foreach ($alternatives as $alternative)
            $success = Alternatives::find($alternative->id)->update([
                'view' => 1,
            ]);
        if ($success) {
            return back();
        }
    }

    /**
     * اکشن های دیتا تیبل *
     */
    public function actions($row)
    {
        $success = url('/public/icon/icons8-edit-144.png');
        $delete = url('/public/icon/icons8-delete-bin-96.png');

        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="ویرایش"
                       class="editProduct">
                       <i class="fa fa-edit fa-lg" title="ویرایش"></i>
                       </a>&nbsp;&nbsp;';

        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"
                      data-id="' . $row->id . '" data-original-title="حذف"
                       class="deleteProduct">
                       <i class="fa fa-trash fa-lg" title="حذف"></i>
                       </a>';

        return $btn;

    }

    public function user(Request $request)
    {
        $users = \DB::table("users")
            ->where("id", '!=', $request->user_id)
            ->pluck("name", "id");
        return response()->json($users);

    }


}
