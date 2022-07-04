@extends('layouts.master')
@section('title')
    {{__('main-trans.parents')}}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{__('main-trans.parents')}}
    @endsection

    @section('content')
        <!-- row -->
        <div class="row">
            <div class="col-md-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <livewire:my-parent/>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    @endsection
    @section('js')
        @livewireScripts
    @endsection
