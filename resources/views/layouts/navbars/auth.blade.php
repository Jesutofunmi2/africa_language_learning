<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/favicon.png">
            </div>
        </a>
        <a href="#" class="simple-text logo-normal">
            {{ __('Izesan!') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">

            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>

            <li class="{{ $elementActive == 'language' ? 'active' : '' }}">
                <a href="{{ route('admin.language.index') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>{{ __('Create Language') }}</p>
                </a>
            </li>
           
            <li class="{{ $elementActive == 'topic' ? 'active' : '' }}">
                <a href="{{ route('admin.topic.index') }}">
                    <i class="nc-icon nc-app"></i>
                    <p>{{ __('Create Topic') }}</p>
                </a>
            </li>

            <li class="{{ $elementActive == 'admin' ? 'active' : '' }}">
                <a href="{{ route('admin.register.get') }}">
                    <i class="nc-icon nc-box"></i>
                    <p>{{ __('Create Admin') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'teacher' ? 'active' : '' }}">
                <a href="{{ route('admin.teacher.index') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>{{ __('Create Teacher') }}</p>
                </a>
            </li>

            <li class="{{ $elementActive == 'question' ? 'active' : '' }}">
                <a href="{{ route('admin.question.index')}}">
                    <i class="nc-icon nc-badge"></i>
                    <p>{{ __('Create Question') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'course' ? 'active' : '' }}">
                <a href="{{ route('admin.course.index')}}">
                    <i class="nc-icon nc-box"></i>
                    <p>{{ __('Create Course') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'section' ? 'active' : '' }}">
                <a href="{{ route('admin.section.index')}}">
                    <i class="nc-icon nc-box"></i>
                    <p>{{ __('Create Section') }}</p>
                </a>
            </li>

            <li class="{{ $elementActive == 'answere' ? 'active' : '' }}">
                <a href="">
                    <i class="nc-icon nc-box"></i>
                    <p>{{ __('Create Answere') }}</p>
                </a>
            </li>
            
            <li class="{{ $elementActive == 'school' ? 'active' : '' }}">
                <a href="{{ route('admin.school.index')}}">
                    <i class="nc-icon nc-box"></i>
                    <p>{{ __('Create School') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'student' ? 'active' : '' }}">
                <a href="">
                    <i class="nc-icon nc-box"></i>
                    <p>{{ __('Create Student') }}</p>
                </a>
            </li>

            <li class="{{ $elementActive == 'option' ? 'active' : '' }}">
                <a href="{{ route('admin.option.index')}}">
                    <i class="nc-icon nc-box"></i>
                    <p>{{ __('Create Option') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'role' ? 'active' : '' }}">
                <a href="{{ route('admin.role.index')}}">
                    <i class="nc-icon nc-box"></i>
                    <p>{{ __('Create Role') }}</p>
                </a>
            </li>

            <li class="{{ $elementActive == 'permission' ? 'active' : '' }}">
                <a href="{{ route('admin.permission.index')}}">
                    <i class="nc-icon nc-box"></i>
                    <p>{{ __('Create Permission') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
