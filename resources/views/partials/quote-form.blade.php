@php $g = \App\Support\GulfCut::class; @endphp
<form class="quote-form" method="post" action="{{ route('contact.send') }}" data-track="quote-form">
    @csrf
    <label>Name
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Your name" autocomplete="name" maxlength="120" required>
    </label>
    <label>Phone
        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="05x xxx xxxx" autocomplete="tel" inputmode="tel" maxlength="40" required>
    </label>
    <label>Email
        <input type="email" name="email" value="{{ old('email') }}" placeholder="you@email.com" autocomplete="email" maxlength="160" required>
    </label>
    <label>Site address
        <input type="text" name="address" value="{{ old('address') }}" placeholder="Area, Dubai" autocomplete="street-address" maxlength="200">
    </label>
    <label class="wide">Service
        <select name="service">
            <option value="">Select a service</option>
            @php
                $labels = array_column($g::menu(), 'label');
                $chosen = old('service', $preset ?? '');
            @endphp
            @if ($chosen !== '' && ! in_array($chosen, $labels, true))
                <option value="{{ $chosen }}" selected>{{ $chosen }}</option>
            @endif
            @foreach ($labels as $option)
                <option value="{{ $option }}" @selected($chosen === $option)>{{ $option }}</option>
            @endforeach
        </select>
    </label>
    <label class="wide">Project details
        <textarea name="details" maxlength="1000" placeholder="Opening size, wall thickness, site access">{{ old('details') }}</textarea>
    </label>
    <label class="hp" aria-hidden="true">Website
        <input type="text" name="website" tabindex="-1" autocomplete="off">
    </label>
    <input type="hidden" name="page" value="{{ $source ?? url()->current() }}">
    @if ($errors->any())
        <div class="form-err wide" role="alert">
            @foreach ($errors->all() as $message)
                <p>{{ $message }}</p>
            @endforeach
        </div>
    @endif
    @if (session('mail_error'))
        <p class="form-err wide" role="alert">The form could not be sent. Please call {{ $g::PHONE_DISPLAY }} or WhatsApp us.</p>
    @endif
    <div class="form-actions">
        <button class="btn" type="submit">Get my quote</button>
        <a class="btn btn-line" href="{{ $g::WHATSAPP }}" target="_blank" rel="noopener" data-track="whatsapp">WhatsApp</a>
    </div>
</form>
