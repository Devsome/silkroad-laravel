<form method="POST" action="{{ route('site-settings-update-backend') }}"
      enctype="multipart/form-data">
    @csrf
    <h4>
        {{ __('backend/settings.form.website') }}
    </h4>
    <div class="form-group row pt-2">
        <label class="col-sm-4 col-form-label">
            {{ __('backend/settings.form.registration-open') }}
        </label>
        <div class="col-sm-8">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="custom-control custom-checkbox d-block pt-2">
                    <input class="custom-control-input {{ $errors->has('registration_close') ? ' is-invalid' : '' }}"
                           type="checkbox" id="registration_close" name="registration_close"
                    @if(array_key_exists('registration_close', $data))
                        {{ $data['registration_close'] ? 'checked' : '' }}
                            @endif>
                    <label class="custom-control-label" for="registration_close">
                        {{ __('backend/settings.form.registration-open-checkbox') }}
                    </label>
                    @if ($errors->has('registration_close'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('registration_close') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="sro_silk_name" class="col-sm-4 col-form-label">
            {{ __('backend/settings.form.silk-name') }}
        </label>
        <div class="col-md-4">
            <input type="text"
                   class="form-control {{ $errors->has('sro_silk_name') ? ' is-invalid' : '' }}"
                   id="sro_silk_name" name="sro_silk_name"
                   value="{{ $data['sro_silk_name'] ?? Request::old('sro_silk_name') }}">
            @if ($errors->has('sro_silk_name'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('sro_silk_name') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="facebook_url" class="col-sm-4 col-form-label">
            {{ __('backend/settings.form.facebook-url') }}
        </label>
        <div class="col-md-4">
            <input type="text"
                   class="form-control {{ $errors->has('facebook_url') ? ' is-invalid' : '' }}"
                   id="facebook_url" name="facebook_url"
                   value="{{ $data['facebook_url'] ?? Request::old('facebook_url') }}">
            <small id="facebook_url" class="form-text text-muted">
                {{ __('backend/settings.form.facebook-url-helper') }}
            </small>
            @if ($errors->has('facebook_url'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('facebook_url') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="youtube_url" class="col-sm-4 col-form-label">
            {{ __('backend/settings.form.youtube-url') }}
        </label>
        <div class="col-md-4">
            <input type="text"
                   class="form-control {{ $errors->has('youtube_url') ? ' is-invalid' : '' }}"
                   id="youtube_url" name="youtube_url"
                   value="{{ $data['youtube_url'] ?? Request::old('youtube_url') }}">
            <small id="youtube_url" class="form-text text-muted">
                {{ __('backend/settings.form.youtube-url-helper') }}
            </small>
            @if ($errors->has('youtube_url'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('youtube_url') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="contact_email" class="col-sm-4 col-form-label">
            {{ __('backend/settings.form.contact-email') }}
        </label>
        <div class="col-md-4">
            <input type="email"
                   class="form-control {{ $errors->has('contact_email') ? ' is-invalid' : '' }}"
                   id="contact_email" name="contact_email"
                   value="{{ $data['contact_email'] ?? Request::old('contact_email') }}">
            <small id="contact_email" class="form-text text-muted">
                {{ __('backend/settings.form.contact-email-helper') }}
            </small>
            @if ($errors->has('contact_email'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('contact_email') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="discord_id" class="col-sm-4 col-form-label">
            {{ __('backend/settings.form.discord-id') }}
        </label>
        <div class="col-md-4">
            <input type="number"
                   class="form-control {{ $errors->has('discord_id') ? ' is-invalid' : '' }}"
                   id="discord_id" name="discord_id"
                   value="{{ $data['discord_id'] ?? Request::old('discord_id') }}">
            <small id="discord_id" class="form-text text-muted">
                {{ __('backend/settings.form.discord-id-help') }}
            </small>
            @if ($errors->has('discord_id'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('discord_id') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <hr class="mt-2">
    <h4>
        {{ __('backend/settings.form.fortress') }}
    </h4>

    <div class="form-group row pt-2">
        <label class="col-sm-4 col-form-label">
            {{ __('backend/settings.form.fortress-jangan-enabled') }}
        </label>
        <div class="col-sm-8">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="custom-control custom-checkbox d-block pt-2">
                    <input class="custom-control-input {{ $errors->has('jangan_fortress') ? ' is-invalid' : '' }}"
                           type="checkbox" id="jangan_fortress" name="jangan_fortress"
                    @if(array_key_exists('jangan_fortress', $data))
                        {{ $data['jangan_fortress'] ? 'checked' : '' }}
                            @endif>
                    <label class="custom-control-label" for="jangan_fortress">
                        {{ __('backend/settings.form.fortress-disable') }}
                    </label>
                    @if ($errors->has('jangan_fortress'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('jangan_fortress') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row pt-2">
        <label class="col-sm-4 col-form-label">
            {{ __('backend/settings.form.fortress-bandit-enabled') }}
        </label>
        <div class="col-sm-8">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="custom-control custom-checkbox d-block pt-2">
                    <input class="custom-control-input {{ $errors->has('bandit_fortress') ? ' is-invalid' : '' }}"
                           type="checkbox" id="bandit_fortress" name="bandit_fortress"
                    @if(array_key_exists('bandit_fortress', $data))
                        {{ $data['bandit_fortress'] ? 'checked' : '' }}
                            @endif>
                    <label class="custom-control-label" for="bandit_fortress">
                        {{ __('backend/settings.form.fortress-disable') }}
                    </label>
                    @if ($errors->has('bandit_fortress'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('bandit_fortress') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row pt-2">
        <label class="col-sm-4 col-form-label">
            {{ __('backend/settings.form.fortress-hotan-enabled') }}
        </label>
        <div class="col-sm-8">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="custom-control custom-checkbox d-block pt-2">
                    <input class="custom-control-input {{ $errors->has('hotan_fortress') ? ' is-invalid' : '' }}"
                           type="checkbox" id="hotan_fortress" name="hotan_fortress"
                    @if(array_key_exists('hotan_fortress', $data))
                        {{ $data['hotan_fortress'] ? 'checked' : '' }}
                            @endif>
                    <label class="custom-control-label" for="hotan_fortress">
                        {{ __('backend/settings.form.fortress-disable') }}
                    </label>
                    @if ($errors->has('hotan_fortress'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('hotan_fortress') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row pt-2">
        <label class="col-sm-4 col-form-label">
            {{ __('backend/settings.form.fortress-constantinople-enabled') }}
        </label>
        <div class="col-sm-8">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="custom-control custom-checkbox d-block pt-2">
                    <input class="custom-control-input {{ $errors->has('constantinople_fortress') ? ' is-invalid' : '' }}"
                           type="checkbox" id="constantinople_fortress" name="constantinople_fortress"
                    @if(array_key_exists('constantinople_fortress', $data))
                        {{ $data['constantinople_fortress'] ? 'checked' : '' }}
                            @endif>
                    <label class="custom-control-label" for="constantinople_fortress">
                        {{ __('backend/settings.form.fortress-disable') }}
                    </label>
                    @if ($errors->has('constantinople_fortress'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('constantinople_fortress') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <hr class="mt-2">
    <h4>
        {{ __('backend/settings.form.silkroad') }}
    </h4>
    <p class="text-capitalize">
        {{ __('backend/settings.form.required-fields') }}
    </p>

    <div class="form-row">
        <div class="form-group col-lg-2 col-md-3 col-sm-4">
            <label for="sro_content_id" class="col-form-label">
                {{ __('backend/settings.form.sro-content-id') }}
            </label>
            <input type="number"
                   class="form-control {{ $errors->has('sro_content_id') ? ' is-invalid' : '' }}"
                   id="sro_content_id" name="sro_content_id"
                   value="{{ $data['sro_content_id'] ?? Request::old('sro_content_id') }}" placeholder="22">
            <small id="sro_content_id" class="form-text text-muted">
                {{ __('backend/settings.form.sro-content-id-help') }}
            </small>
            @if ($errors->has('sro_content_id'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('sro_content_id') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-lg-2 col-md-3 col-sm-4">
            <label for="sro_max_server" class="col-form-label">
                {{ __('backend/settings.form.sro-max-server') }}
            </label>
            <input type="number"
                   class="form-control {{ $errors->has('sro_max_server') ? ' is-invalid' : '' }}"
                   id="sro_max_server" name="sro_max_server"
                   value="{{ $data['sro_max_server'] ?? Request::old('sro_max_server') }}" placeholder="1000">
            @if ($errors->has('sro_max_server'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('sro_max_server') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-lg-2 col-md-3 col-sm-4">
            <label for="sro_cap" class="col-form-label">
                {{ __('backend/settings.form.sro-cap') }}
            </label>
            <input type="number"
                   class="form-control {{ $errors->has('sro_cap') ? ' is-invalid' : '' }}"
                   id="sro_cap" name="sro_cap"
                   value="{{ $data['sro_cap'] ?? Request::old('sro_cap') }}" placeholder="110">
            @if ($errors->has('sro_cap'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('sro_cap') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-lg-2 col-md-3 col-sm-4">
            <label for="sro_exp" class="col-form-label">
                {{ __('backend/settings.form.sro-exp') }}
            </label>
            <input type="number"
                   class="form-control {{ $errors->has('sro_exp') ? ' is-invalid' : '' }}"
                   id="sro_exp" name="sro_exp"
                   value="{{ $data['sro_exp'] ?? Request::old('sro_exp') }}" placeholder="1">
            @if ($errors->has('sro_exp'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('sro_exp') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-lg-2 col-md-3 col-sm-4">
            <label for="sro_exp_gold" class="col-form-label">
                {{ __('backend/settings.form.sro-exp-gold') }}
            </label>
            <input type="number"
                   class="form-control {{ $errors->has('sro_exp_gold') ? ' is-invalid' : '' }}"
                   id="sro_exp_gold" name="sro_exp_gold"
                   value="{{ $data['sro_exp_gold'] ?? Request::old('sro_exp_gold') }}" placeholder="1">
            @if ($errors->has('sro_exp_gold'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('sro_exp_gold') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-lg-2 col-md-3 col-sm-4">
            <label for="sro_exp_drop" class="col-form-label">
                {{ __('backend/settings.form.sro-exp-drop') }}
            </label>
            <input type="number"
                   class="form-control {{ $errors->has('sro_exp_drop') ? ' is-invalid' : '' }}"
                   id="sro_exp_drop" name="sro_exp_drop"
                   value="{{ $data['sro_exp_drop'] ?? Request::old('sro_exp_drop') }}" placeholder="1">
            @if ($errors->has('sro_exp_drop'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('sro_exp_drop') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-lg-2 col-md-3 col-sm-4">
            <label for="sro_exp_job" class="col-form-label">
                {{ __('backend/settings.form.sro-exp-job') }}
            </label>
            <input type="number"
                   class="form-control {{ $errors->has('sro_exp_job') ? ' is-invalid' : '' }}"
                   id="sro_exp_job" name="sro_exp_job"
                   value="{{ $data['sro_exp_job'] ?? Request::old('sro_exp_job') }}" placeholder="1">
            @if ($errors->has('sro_exp_job'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('sro_exp_job') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-lg-2 col-md-3 col-sm-4">
            <label for="sro_exp_party" class="col-form-label">
                {{ __('backend/settings.form.sro-exp-party') }}
            </label>
            <input type="number"
                   class="form-control {{ $errors->has('sro_exp_party') ? ' is-invalid' : '' }}"
                   id="sro_exp_party" name="sro_exp_party"
                   value="{{ $data['sro_exp_party'] ?? Request::old('sro_exp_party') }}" placeholder="1">
            @if ($errors->has('sro_exp_party'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('sro_exp_party') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-lg-2 col-md-3 col-sm-4">
            <label for="sro_ip_limit" class="col-form-label">
                {{ __('backend/settings.form.sro-ip-limit') }}
            </label>
            <input type="number"
                   class="form-control {{ $errors->has('sro_ip_limit') ? ' is-invalid' : '' }}"
                   id="sro_ip_limit" name="sro_ip_limit"
                   value="{{ $data['sro_ip_limit'] ?? Request::old('sro_ip_limit') }}" placeholder="1">
            @if ($errors->has('sro_ip_limit'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('sro_ip_limit') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-lg-2 col-md-3 col-sm-4">
            <label for="sro_hwid_limit" class="col-form-label">
                {{ __('backend/settings.form.sro-hwid-limit') }}
            </label>
            <input type="number"
                   class="form-control {{ $errors->has('sro_hwid_limit') ? ' is-invalid' : '' }}"
                   id="sro_hwid_limit" name="sro_hwid_limit"
                   value="{{ $data['sro_hwid_limit'] ?? Request::old('sro_hwid_limit') }}" placeholder="1">
            @if ($errors->has('sro_hwid_limit'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('sro_hwid_limit') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="col-12">
        <hr class="mt-2 mb-3">
        <div class="form-group row">
            <label for="youtube_url" class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 col-form-label">
                {{ __('backend/settings.form.signature-title') }}
            </label>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="custom-file">
                    <input type="file" name="image_id" class="custom-file-input @error('image_id') is-invalid @enderror"
                           id="image_id">
                    <label class="custom-file-label"
                           for="image_id">{{ __('backend/settings.form.signature-help') }}
                    </label>
                    @if($errors->has('image_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('image_id') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12 text-center">
                <u>
                    {{ __('backend/settings.form.signature-information') }}
                </u>
            </div>
            <div class="col-12">
                <div class="container-fluid mt-3">
                    @if(array_key_exists('signature', $data) && $data['signature'] !== '')
                        <img src="{{ Storage::disk('images')->url($data['signature']) }}"
                             class="img-fluid"/>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 pb-5">
        <hr class="mt-2 mb-3">
        <div class="d-flex flex-wrap float-right">
            <button class="btn btn-style-1 btn-primary float-right" type="submit">
                {{ __('backend/settings.form.save') }}
            </button>
        </div>
    </div>
</form>

