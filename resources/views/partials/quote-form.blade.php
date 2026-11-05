<form class="quote-form" method="post" action="{{ route('contact.send') }}">
    @csrf
    @if (session('sent'))
        <p class="form-ok wide">Thank you. Gulf Cut will contact you shortly about your project.</p>
    @endif
    <label>Name
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Your name" required>
    </label>
    <label>Phone
        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="05x xxx xxxx" required>
    </label>
    <label>Email
        <input type="email" name="email" value="{{ old('email') }}" placeholder="you@email.com" required>
    </label>
    <label>Site address
        <input type="text" name="address" value="{{ old('address') }}" placeholder="Area, Dubai">
    </label>
    <label class="wide">Service
        <select name="service">
            <option value="">Select a service</option>
            @php
                $labels = array_column(\App\Support\GulfCut::menu(), 'label');
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
    <label class="hp">Website
        <input type="text" name="website" tabindex="-1" autocomplete="off">
    </label>
    <input type="hidden" name="page" value="{{ $source ?? url()->current() }}">
    @error('name') <p class="form-err wide">{{ $message }}</p> @enderror
    @error('email') <p class="form-err wide">{{ $message }}</p> @enderror
    @error('phone') <p class="form-err wide">{{ $message }}</p> @enderror
    @if (session('mail_error'))
        <p class="form-err wide">The form could not be sent. Please call {{ \App\Support\GulfCut::PHONE_DISPLAY }} or WhatsApp us.</p>
    @endif
    <div class="form-actions">
        <button class="btn" type="submit">Get my quote</button>
        <a class="btn btn-line" href="https://wa.me/971505962816" target="_blank" rel="noopener">WhatsApp</a>
    </div>
</form>
