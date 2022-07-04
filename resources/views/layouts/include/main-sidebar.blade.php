<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{route('index')}}">
                            <div class="pull-left"><i class="ti-home"></i><span
                                    class="right-nav-text">{{__('main-trans.dashboard')}}</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- menu title -->

                    <!-- Grades-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Grades-menu">
                            <div class="pull-left"><i class="fas fa-school"></i><span
                                    class="right-nav-text">{{__('main-trans.grades')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Grades-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('grades.index')}}">{{__('main-trans.grades_list')}}</a></li>

                        </ul>
                    </li>
                    <!-- classes-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#classes-menu">
                            <div class="pull-left"><i class="fa fa-building"></i><span
                                    class="right-nav-text">{{__('main-trans.classes')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="classes-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('class-room.index')}}">{{__('main-trans.list_classes')}}</a></li>
                        </ul>
                    </li>


                    <!-- sections-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                            <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                                    class="right-nav-text">{{__('main-trans.sections')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('sections.index')}}">{{__('main-trans.list_sections')}}</a></li>
                        </ul>
                    </li>


                    <!-- students-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu">
                            <div class="pull-left"><i class="fas fa-user-graduate"></i><span
                                    class="right-nav-text">{{__('main-trans.students')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="students-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('students.index')}}">{{__('main-trans.list_students')}}</a></li>
                            <li><a href="{{route('promotions.index')}}">{{__('main-trans.list_promotions')}}</a></li>
                            <li><a href="{{route('graduated.index')}}">{{__('main-trans.list_graduate')}}</a></li>
                        </ul>
                    </li>


                    <!-- Teachers-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                            <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i><span
                                    class="right-nav-text">{{__('main-trans.teachers')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('teachers.index')}}">{{__('main-trans.list_teachers')}}</a></li>
                        </ul>
                    </li>
                    <!-- Parents-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents-menu">
                            <div class="pull-left"><i class="fas fa-user-tie"></i><span
                                    class="right-nav-text">{{__('main-trans.parents')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Parents-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('parents.index')}}">{{__('main-trans.list_parents')}}</a></li>
                        </ul>
                    </li>

                    <!-- Accounts-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Accounts-menu">
                            <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span
                                    class="right-nav-text">{{__('main-trans.accounts')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Accounts-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('fees.index')}}">الرسوم الدراسية</a></li>
                            <li><a href="{{route('fees.invoices.index')}}">الفواتير</a></li>
                            <li><a href="{{route('students.receipts.index')}}">سندات القبض</a></li>
                            <li><a href="{{route('fees.processings.index')}}">استبعاد رسوم</a></li>
                            <li><a href="{{route('payments.index')}}">سندت الصرف</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
