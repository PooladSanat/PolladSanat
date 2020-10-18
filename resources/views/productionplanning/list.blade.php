@extends('layouts.master')
<style>


    @-webkit-keyframes spaceboots {
        0% {
            -webkit-transform: translate(2px, 1px) rotate(0deg);
        }
        10% {
            -webkit-transform: translate(-1px, -2px) rotate(-1deg);
        }
        20% {
            -webkit-transform: translate(-3px, 0px) rotate(1deg);
        }
        30% {
            -webkit-transform: translate(0px, 2px) rotate(0deg);
        }
        40% {
            -webkit-transform: translate(1px, -1px) rotate(1deg);
        }
        50% {
            -webkit-transform: translate(-1px, 2px) rotate(-1deg);
        }
        60% {
            -webkit-transform: translate(-3px, 1px) rotate(0deg);
        }
        70% {
            -webkit-transform: translate(2px, 1px) rotate(-1deg);
        }
        80% {
            -webkit-transform: translate(-1px, -1px) rotate(1deg);
        }
        90% {
            -webkit-transform: translate(2px, 2px) rotate(0deg);
        }
        100% {
            -webkit-transform: translate(1px, -2px) rotate(-1deg);
        }
    }

    .shake:hover,
    .shake:focus {
        -webkit-animation-name: spaceboots;
        -webkit-animation-duration: 0.8s;
        -webkit-transform-origin: 50% 50%;
        -webkit-animation-iteration-count: infinite;
        -webkit-animation-timing-function: linear;
    }
</style>
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        برنامه ریزی خطوط تولید
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="form-group">

                            <div class="row">
                                @if(!empty($Status_Device1))
                                    @if($Status_Device1 == 'true')
                                        <div class="col-md-4">
                                            <label>{{$Name_Device1->name}}</label>
                                            <a href="javascript:void(0)" id="device1"
                                            >
                                                <img class="shake" title="فعال"
                                                     src="{{asset('/public/icon/BT-order.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <label>{{$Name_Device1->name}}</label>
                                            <a href="javascript:void(0)" id="falsedevice1">
                                                <img title="غیرفعال"
                                                     src="{{asset('/public/icon/BT-off.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @endif
                                @endif
                                @if(!empty($Status_Device2))
                                    @if($Status_Device2 == 'true')
                                        <div class="col-md-4">
                                            <label>{{$Name_Device2->name}}</label>
                                            <a href="javascript:void(0)" id="device2">
                                                <img class="shake" title="فعال"
                                                     src="{{asset('/public/icon/BT-order.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <label>{{$Name_Device2->name}}</label>
                                            <a href="javascript:void(0)" id="falsedevice2">
                                                <img title="غیرفعال"
                                                     src="{{asset('/public/icon/BT-off.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @endif
                                @endif
                                @if(!empty($Status_Device3))
                                    @if($Status_Device3 == 'true')
                                        <div class="col-md-4">
                                            <label>{{$Name_Device3->name}}</label>
                                            <a href="javascript:void(0)" id="device3">
                                                <img class="shake" title="فعال"
                                                     src="{{asset('/public/icon/BT-order.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <label>{{$Name_Device3->name}}</label>
                                            <a href="javascript:void(0)" id="falsedevice3">
                                                <img title="غیرفعال"
                                                     src="{{asset('/public/icon/BT-off.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @endif
                                @endif

                                @if(!empty($Status_Device4))
                                    @if($Status_Device4 == 'true')
                                        <div class="col-md-4">
                                            <br/>
                                            <label>{{$Name_Device4->name}}</label>
                                            <a href="javascript:void(0)" id="device4">
                                                <img class="shake" title="فعال"
                                                     src="{{asset('/public/icon/BT-order.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <label>{{$Name_Device4->name}}</label>
                                            <a href="#">
                                                <img title="غیرفعال"
                                                     src="{{asset('/public/icon/BT-off.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @endif
                                @endif
                                @if(!empty($Status_Device5))
                                    @if($Status_Device5 == 'true')
                                        <div class="col-md-4">
                                            <label>{{$Name_Device5->name}}</label>
                                            <a href="javascript:void(0)" id="device5">
                                            <img class="shake" title="فعال"
                                                     src="{{asset('/public/icon/BT-order.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <label>{{$Name_Device5->name}}</label>
                                            <a href="#">
                                                <img title="غیرفعال"
                                                     src="{{asset('/public/icon/BT-off.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @endif
                                @endif
                                @if(!empty($Status_Device6))
                                    @if($Status_Device6 == 'true')
                                        <div class="col-md-4">
                                            <label>{{$Name_Device6->name}}</label>
                                            <a href="#">
                                                <img class="shake" title="فعال"
                                                     src="{{asset('/public/icon/BT-order.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <label>{{$Name_Device6->name}}</label>
                                            <a href="#">
                                                <img title="غیرفعال"
                                                     src="{{asset('/public/icon/BT-off.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @endif
                                @endif

                                @if(!empty($Status_Device7))
                                    @if($Status_Device7 == 'true')
                                        <br/>
                                        <div class="col-md-4">
                                            <label>{{$Name_Device7->name}}</label>
                                            <a href="#">
                                                <img class="shake" title="فعال"
                                                     src="{{asset('/public/icon/BT-order.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <label>{{$Name_Device7->name}}</label>
                                            <a href="#">
                                                <img title="غیرفعال"
                                                     src="{{asset('/public/icon/BT-off.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @endif
                                @endif
                                @if(!empty($Status_Device8))
                                    @if($Status_Device8 == 'true')
                                        <div class="col-md-4">
                                            <label>{{$Name_Device8->name}}</label>
                                            <a href="#">
                                                <img class="shake" title="فعال"
                                                     src="{{asset('/public/icon/BT-order.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <label>{{$Name_Device8->name}}</label>
                                            <a href="#">
                                                <img title="غیرفعال"
                                                     src="{{asset('/public/icon/BT-off.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @endif
                                @endif
                                @if(!empty($Status_Device9))
                                    @if($Status_Device9 == 'true')
                                        <div class="col-md-4">
                                            <label>{{$Name_Device9->name}}</label>
                                            <a href="#">
                                                <img class="shake" title="فعال"
                                                     src="{{asset('/public/icon/BT-order.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <label>{{$Name_Device9->name}}</label>
                                            <a href="#">
                                                <img title="غیرفعال"
                                                     src="{{asset('/public/icon/BT-off.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @endif
                                @endif

                                @if(!empty($Status_Device10))
                                    @if($Status_Device10 == 'true')
                                        <div class="col-md-4">
                                            <br/>
                                            <label>{{$Name_Device10->name}}</label>
                                            <a href="#">
                                                <img class="shake" title="فعال"
                                                     src="{{asset('/public/icon/BT-order.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <label>{{$Name_Device10->name}}</label>
                                            <a href="#">
                                                <img title="غیرفعال"
                                                     src="{{asset('/public/icon/BT-off.png')}}"
                                                     width="100">
                                            </a>
                                        </div>
                                    @endif
                                @endif


                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('productionplanning.modals.modal')
    @include('productionplanning.scripts.script')
@endsection
