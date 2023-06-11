<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="http://www.dev.izesan.com" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/favicon.png">
            </div>
        </a>
        <a href="http://www.dev.izesan.com" class="simple-text logo-normal">
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
           
            <li class="{{ $elementActive == 'index' ? 'active' : '' }}">
                <a href="{{ route('admin.activity.index') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>{{ __('List Activities') }}</p>
                </a>
            </li>

            <li class="{{ $elementActive == 'list' ? 'active' : '' }}">
                <a href="{{ route('admin.activity.list') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>{{ __('List Activities') }}</p>
                </a>
            </li>

            <li class="{{ $elementActive == 'language' || $elementActive == 'lang' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                    <i class="nc-icon nc-single-02"></i>
                    <p>
                            {{ __('Languages Upload') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="laravelExamples">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'yoruba' ? 'active' : '' }}">
                            <a href="">
                                <i class="nc-icon nc-single-02"></i>
                                <span class="sidebar-normal">{{ __(' Yoruba ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'igbo' ? 'active' : '' }}">
                            <a href="">
                                <i class="nc-icon nc-single-02"></i>
                                <span class="sidebar-normal">{{ __(' Igbo') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>
