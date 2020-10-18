@extends('layouts.master')
@section('content')

    @include('message.msg')
    <?php
    $array = array();
    $arrays = array();
    $user = auth()->user()->id;
    $user_id = array();
    ?>
    <script
        src="{{asset('/public/js/5.js')}}"></script>
    <div class="row">
        <input name="id" id="id" value="{{$id->id}}" type="hidden">
        <div class="col-md-12">
            <div class="boxed">
                <div class="row">
                    <div class="col-md-12">
                        <br/>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <label>مشتری:</label>
                            </div>
                            <div class="col-md-6">
                                <label>
                                    @foreach($customers as $customer)
                                        @if($customer->id == $id->customer_id)
                                            {{$customer->name}}
                                        @endif
                                    @endforeach
                                </label>
                            </div>
                        </div>
                        <br/>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <label>محصول مورد شکایت:</label>
                            </div>
                            <div class="col-md-6">
                                <label>
                                    @foreach($details as $detail)
                                        @foreach($products as $product)
                                            @if($product->id == $detail->product_id)
                                                {{$detail->number}} عدد {{$product->label}} -
                                            @endif
                                        @endforeach
                                    @endforeach
                                </label>
                            </div>
                        </div>
                        <br/>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <label>تاریخ شکایت:</label>
                            </div>
                            <div class="col-md-6">
                                <label>
                                    {{$id->date}}
                                </label>
                            </div>
                        </div>
                        <br/>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <label>بار ارسالی:</label>
                            </div>
                            <div class="col-md-6">
                                <label>
                                    @foreach($details as $detail)
                                        @foreach($invoices as $invoice)
                                            @if($invoice->id == $detail->invoice_id)
                                                {{$invoice->invoiceNumber}} -
                                            @endif
                                        @endforeach
                                    @endforeach
                                </label>
                            </div>
                        </div>
                        <br/>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <label>موضوع:</label>
                            </div>
                            <div class="col-md-6">
                                <label>
                                    {{$id->title}}
                                </label>
                            </div>
                        </div>
                        <br/>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <label>کد ردیابی:</label>
                            </div>
                            <div class="col-md-6">
                                <label>{{$id->code}}</label>
                            </div>
                        </div>

                        <br/>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <label>مقدار ایراددار:</label>
                            </div>
                            <div class="col-md-6">
                                <label>{{$number}} عدد </label>
                            </div>
                        </div>
                        <br/>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <label>شرح شکایت:</label>
                            </div>
                            <div class="col-md-6">
                                <label>{{$id->description}}</label>
                            </div>
                        </div>
                        <br/>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <label>درخواست مشتری:</label>
                            </div>
                            <div class="col-md-6">
                                <label>{{$id->descriptionm}}</label>
                            </div>
                        </div>
                        <br/>
                    </div>
                </div>
            </div>
            <br/>
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        جزییات شکایات
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-fluid" id="mTable">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>تاریخ اقدام</th>
                            <th>اقدام کننده</th>
                            <th>مخاطب</th>
                            <th>رونوشت</th>
                            <th>عملیات</th>
                            <th>میزان اهمیت</th>
                            <th>توضیحات</th>
                            <th>پیوست</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $number =  1;
                        @endphp
                        @foreach($complaint_actions as $complaint_action)
                            <?php

                            $usersss = DB::table('audience_complaint_action')
                                ->where('id_complaint_action', $complaint_action->id)
                                ->get();

                            $usrsss = DB::table('copy_complaint_action')
                                ->where('id_complaint_action', $complaint_action->id)
                                ->get();

                            foreach ($usersss as $userrr) {
                                $array[] = $userrr->id_actioner;
                            }
                            foreach ($usrsss as $srsss) {
                                $arrays[] = $srsss->id_copy;
                            }
                            $user_id[] = $complaint_action->user_id;

                            ?>
                            @if($complaint_action->user_id == auth()->user()->id or
                             in_array($user,$array) or in_array($user,$arrays))
                                <tr>
                                    <td style="background-color: #e8ecff">{{$number++}}</td>
                                    <td>{{\Morilog\Jalali\Jalalian::forge($complaint_action->created_at)->format('Y/m/d')}}</td>
                                    <td>
                                        @foreach($users as $user)
                                            @if($complaint_action->user_id == $user->id)
                                                {{$user->name}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($audience_complaint_actions as $audience_complaint_action)
                                            @if($complaint_action->id == $audience_complaint_action->id_complaint_action)
                                                @foreach($users as $user)
                                                    @if($user->id == $audience_complaint_action->id_actioner)
                                                        {{$user->name}} -
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </td>


                                    <td>
                                        @foreach($copy_complaint_actions as $copy_complaint_action)
                                            @if($complaint_action->id == $copy_complaint_action->id_complaint_action)
                                                @foreach($users as $user)
                                                    @if($user->id == $copy_complaint_action->id_copy)
                                                        {{$user->name}} -
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </td>

                                    <td>{{$complaint_action->operation}}</td>
                                    <td>{{$complaint_action->uruency}}</td>
                                    <td>

                                        <a href="#" data-toggle="modal" data-target="#youModal"
                                           data-id="{{$complaint_action->id}}" class="modalLinkk">
                                            {{str_limit($complaint_action->description,30)}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#yourModal"
                                           data-id="{{$complaint_action->id}}" class="modalLink">
                                            {{DB::table('file_complaint_action')->where('id_complaint_action',$complaint_action->id)->count()}}</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    @if($id->status == 1)
                        @if(empty($user_id))
                            <a class="btn btn-primary" href="javascript:void(0)" id="new">ثبت اقدام جدید</a>
                        @elseif(in_array(auth()->user()->id,$user_id)
        or in_array(auth()->user()->id,$array))
                            <a class="btn btn-primary" href="javascript:void(0)" id="new">ثبت اقدام جدید</a>
                        @endif

                        @if(auth()->user()->id == $id->user_id)
                            <diV style="float: left">
                                <a class="btn btn-danger" href="javascript:void(0)" id="end">خاتمه شکایت</a>
                            </diV>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('Complaints.scripts.detail')
    @include('Complaints.modals.detail')
@endsection
