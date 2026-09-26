<form class="quote-form" method="post" action="{{ route('contact.send') }}">
    @csrf
    @if (session('sent'))
        <p class="form-ok">Thank you. Gulf Cut will contact you shortly about your project.</p>
    @endif
    <label>Name
        <input type="text" name="name" value="{{ old('name') }}" required>
    </label>
    <label>Email
        <input type="email" name="email" value="{{ old('email') }}" required>
    </label>
    <label>Phone Number
        <input type="tel" name="phone" value="{{ old('phone') }}" required>
    </label>
    <label>Address
        <input type="text" name="address" value="{{ old('address') }}">
    </label>
    <label>Services
        <select name="service">
            <option value="">Select a service</option>
            @foreach (['Core Cutting', 'Wall Saw Cutting', 'Floor Saw Cutting', 'Wire Saw Cutting', 'Concrete Scanning', 'Chemical Anchoring', 'Civil Work'] as $option)
                <option value="{{ $option }}" @selected(old('service') === $option)>{{ $option }}</option>
            @endforeach
        </select>
    </label>
    @error('name') <p class="form-err">{{ $message }}</p> @enderror
    @error('email') <p class="form-err">{{ $message }}</p> @enderror
    @error('phone') <p class="form-err">{{ $message }}</p> @enderror
    <button class="btn" type="submit">Send</button>
</form>
