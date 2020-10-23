<!doctype html>
<title>Site Maintenance</title>
<style>
  body { text-align: center; padding: 150px; }
  h1 { font-size: 50px; }
  body { font: 20px Helvetica, sans-serif; color: #333; }
  article { display: block; text-align: left; width: 650px; margin: 0 auto; }
  a { color: #dc8100; text-decoration: none; }
  a:hover { color: #333; text-decoration: none; }
</style>

<article>
    <h1>@lang('user.We&rsquo;ll_be_back_soon!')</h1>
    <div>
    @if($setting)
    {!! $setting->system_message !!}
    @endif
    <a href="mailto:@if($setting){{$setting->email}}@endif"> @lang('user.contact_us')</a></p>
       <p>&mdash; The Team</p>
        </div>
</article>
