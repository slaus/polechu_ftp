@extends('web.layouts.main')

@push('meta')
    @include('web.includes.meta', ['seo' => $seo])
@endpush

@push('styles')
<style>
    .contact-icon {
        display: block;
        padding: 5px;
        margin-right: 8px;
        height: 26px;
        width: 26px;
    }

    .contact-icon i {
        font-size: 18px;
        text-shadow: none;
    }

    .contact-icon img {
        width: 20px;
        height: 20px;
        margin-bottom: 6px;
    }

    .team-wrap {
        display: flex;
        flex-wrap: wrap;
    }

    .team-item {
        width: 350px;
        margin: 15px;
    }

</style>
@endpush

@push('scripts')

@endpush

@section('content')
    <section id="subheader" @if(! empty($content['banner']['image'])) style="background: url('{{ image_uri($content['banner']['image']) }}') top fixed;background-size: cover;" @endif>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title-h1 title-h">{{ translation($content['banner']['title'] ?? $page['name'] ?? []) }}</h1>
                </div>

                <div class="col-md-12">
                    <div class="devider-page">
                        <div class="devider-img-right">
                        </div>
                    </div>
                </div>

                <div class="col-md-12 center">
                    <ul class="subdetail">
                        <li>
                            <a href="{{ route('page') }}">{{ __('Home') }}</a>
                        </li>

                        <li class="sep">/</li>

                        <li>{{ translation($page['name'] ?? []) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @if (! empty(employees()))
        <section class="whitepage">
            <div class="container">
                <div class="row">
                    @if (! empty($content['employees']['title']) || ! empty($content['employees']['subtitle']))
                        <div class="col-md-12">
                            <div class="text-center">
                                @if (! empty($content['employees']['title']))
                                    <h2 class="title-h2 title-h">{{ translation($content['employees']['title']) }}</h2>
                                    <span class="devider-center"></span>
                                @endif

                                @if (! empty($content['employees']['subtitle']))
                                    <div class="title-h3 title-h">{{ translation($content['employees']['subtitle']) }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="space-double" style="height: 40px;"></div>
                    @endif

                    <div class="onStep" data-animation="fadeInUp" data-time="300">
                        <div class="team-wrap">
                            @foreach(employees() as $employee)
                                <div class="team-item">
                                    <div class="team" style="background-image:url('{{ image_uri($employee['image'], '540') }}')">
                                        <div class="hovereffect">
                                            <div>
                                                <div class="overlay ">
                                                    <div class="content">
                                                        <div class="heading" style="padding: 0 0 15px 0;">
                                                            {{ translation($employee['name'] ?? []) }}
                                                            <span class="devider-recent"></span>
                                                        </div>

                                                        @if (! empty($employee['position']))
                                                            <div class="subheading" style="padding: 0 0 15px 0;">{{ translation($employee['position']) }}</div>
                                                        @endif

                                                        @if (! empty($employee['details']['contacts']))
                                                            <div style="padding:  0 0 15px 0; display: flex; justify-content: center; align-items: center;">
                                                                @foreach($employee['details']['contacts'] as $contact)
                                                                    @if (! empty($contact['type']))
                                                                        @if ($contact['type'] == 'facebook')
                                                                            <a href="{{ $contact['value'] }}" title="{{ translation($contact['name'] ?? []) }}" class="contact-icon" target="_blank" rel="nofollow">
                                                                                <i class="ti-facebook"></i>
                                                                            </a>
                                                                        @elseif ($contact['type'] == 'instagram')
                                                                            <a href="{{ $contact['value'] }}" title="{{ translation($contact['name'] ?? []) }}" class="contact-icon" target="_blank" rel="nofollow">
                                                                                <i class="ti-instagram"></i>
                                                                            </a>
                                                                        @elseif ($contact['type'] == 'phone')
                                                                            <a href="tel:{{ $contact['value'] }}" title="{{ translation($contact['name'] ?? []) }}" class="contact-icon" rel="nofollow">
                                                                                <i class="ti-mobile"></i>
                                                                            </a>
                                                                        @elseif ($contact['type'] == 'email')
                                                                            <a href="mailto:{{ $contact['value'] }}" title="{{ translation($contact['name'] ?? []) }}" class="contact-icon" rel="nofollow">
                                                                                <i class="ti-email"></i>
                                                                            </a>
                                                                        @elseif ($contact['type'] == 'telegram')
                                                                            <a href="https://t.me/{{ $contact['value'] }}" title="{{ translation($contact['name'] ?? []) }}" class="contact-icon" rel="nofollow">
                                                                                <img src="/images/telegram.svg" alt="telegram" />
                                                                            </a>
                                                                        @elseif ($contact['type'] == 'viber')
                                                                            <a href=viber://contact?number={{ $contact['value'] }}" title="{{ translation($contact['name'] ?? []) }}" class="contact-icon" rel="nofollow">
                                                                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAACQElEQVR4nMXVSYiPYRgA8BnbWLIk2fclWS4O4yAXnJyEEjkoTsJFDYkURVlC4mDNxZI01kkOIgckS0mRg2QZu8aSIYefXj1/Xp//yDLluXzfs+/PW1HxPwCdMQ/7cA31aPQdGoN2NWTmotPvGG6JlXiNWsxHNXqjKpOrClp1yBwNnRVo0ZTxpHQKFzHkL7Ieiks4kQeTC2zB2bLMAMzGe1zGQrQp8NviHDZWFBj90YCBgbfDXnwIes9MtgMm4CRuoE/B1uDQ6ZsTl2F/hm/EYbTHZmzKMngb/RmO5bheJpODWJITTmNGhteXIkCvMNoq8NTcpXiSZCKTBQUHM1GXE25hRIY/wID4n4Y7qIwMHmJyOElZTkzNLTgYjZs54Tm6ZXiqf038P8OkjDc+AkiZvEFHvCs46J70csLnUgkCHxVl6hjO1hQMzCr3zfit8SknpNFrXxDaha1R56epLBmvMg+oCOiRdHLCveJyoQvuRw/GhZO1qVy4m8oSE/ZthH/VgzpMKSM4JnowPc079kS/pibD4aChjN6sdBVywmLsaCLdMZHJtuJBi6X7UEbnUGlISoQUzcty6Wbl2hmzvySNMPrhCHZXZJBK/dMmB2M1zhS3MgeMTAZjTB9jQ7o/hVt0Hut/UMxGqzaO1b9c02NNBhnvQQ1e4MAvjHWIpo9NZwLH8SpuU/n3oGAgLZgMH4RH2Yv2Lkp0JRZxTtL505S/OkBX3MaiPzLwGw4+YhguYF2zGg8Hq+JMb0+nodkdNBd8ATPWf0oj34gaAAAAAElFTkSuQmCC" />
                                                                            </a>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        @endif

                                                        @if (! empty($employee['description']))
                                                            <div class="description" style="white-space: initial; padding: 0 0 15px 0;">
                                                                {!! translation($employee['description']) !!}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (! empty($content['seo']['title']) || ! empty($content['seo']['text']))
        <section aria-label="about" class="about-history" style="padding-top: 40px; padding-bottom: 40px">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <article>
                            <div class="title-h2 title-h">{!! translation($content['seo']['title'] ?? []) !!}</div>
                            <span class="devider-cont"></span>

                            {!! translation($content['seo']['text'] ?? []) !!}
                        </article>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
