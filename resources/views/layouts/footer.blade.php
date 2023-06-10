<footer class="footer footer-black  footer-white ">
    <div class="container-fluid">
        <div class="row">
            <nav class="footer-nav">
                <ul>
                    <li>
                        <a href="{{ route('admin.login.get') }}" target="_blank">{{ __('Login') }}</a>
                    </li>
                    <li>
                        <a href="#" target="_blank">{{ __('Izesan') }}</a>
                    </li>
                    <li>
                        <a href="#" target="_blank">{{ __('Blog') }}</a>
                    </li>
                    <li>
                        <a href="#" target="_blank"></a>
                    </li>
                </ul>
            </nav>
            <div class="credits ml-auto">
                <span class="copyright">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>{{ __(', made with ') }}<i class="fa fa-heart heart"></i>{{ __(' by ') }}<a class="@if(Auth::guest()) text-white @endif" href="https://www.izesan.com" target="_blank">{{ __('Izesan!') }}</a>{{ __(' and ') }}<a class="@if(Auth::guest()) text-white @endif" target="_blank" href="https://www.izesan.com">{{ __('Izesan Dev Team') }}</a>
                </span>
            </div>
        </div>
    </div>
</footer>