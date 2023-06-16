<section aria-label="footer" class="subfooter">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-xs-12">
                @if (! empty(settings('logo.white')))
                    <div class="logo">
                        <img alt="logo" src="{{ image_uri(settings('logo.white'), '160') }}">
                    </div>
                @endif

                @if (! empty(settings('company.description')))
                    <p>{{ translation(settings('company.description')) }}</p>
                @endif
            </div>


            <div class="col-md-4 col-xs-12 col-md-offset-1">
                <div class="title-h3 title-h">{!! translation(settings('contacts.title', [])) !!}</div>
                <address>
                    {!! translation(settings('contacts.text', [])) !!}
                </address>
            </div>

            <div class="col-md-3 col-xs-12 pull-right">
                <div class="title-h3 title-h">{!! translation(settings('subscribe.title', [])) !!}</div>
                <div>
                    <form action="{{ route('form.feedback') }}" id="feedbackForm" method="post" name="subscribe">
                        <div style="display: flex; height: 40px">
                            <input class="subscribfield subscribeemail" id="subscribeemail" name="email" type="text" placeholder="{{ translation(settings('subscribe.email_placeholder', [])) }}">

                            <button class="btn-form" id="feedbackSubmit" type="submit" style="background: #ffb600; height: 40px; width: fit-content; padding: 0 20px; margin: 0 5px;">
                                {{ translation(settings('subscribe.button_text', [])) }}
                            </button>
                        </div>

                        <div class="success" id="mailSendSuccess">
                            {!! translation(settings('subscribe.success_send_message', [])) !!}
                        </div>

                        <div class="error" id="mailSendFail">
                            {!! translation(settings('subscribe.fail_send_message', [])) !!}
                        </div>

                        <div class="error" id="formErrors" style="margin-bottom: 0"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="white">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
               {!! __('&copy; :company :year. all reserved design by on3step', ['company' => config('app.name'), 'year' => date('Y')]) !!}
            </div>

            <div class="col-md-6">
                <div class="right">
                    <div class="social-icons">
                        @foreach(settings('socials', []) as $item)
                            <a href="{{ $item['url'] }}" title="{{ translation($item['name'] ?? []) }}" rel="nofollow" target="_blank">
                                <span class="{{ $item['icon'] }}"></span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div id="totop">
    <span class="ti-angle-up"></span>
</div>
