<h4>
    {{ __('backend/settings.form.website') }}
</h4>

<div class="form-group row">
    <label for="gold_fees" class="col-sm-4 col-form-label">
        {{ __('backend/auctionshouse.form.gold-fees') }}
    </label>
    <div class="col-md-4">
        <input type="number"
               class="form-control {{ $errors->has('gold_fees') ? ' is-invalid' : '' }}"
               id="gold_fees" name="gold_fees"
               value="{{ $data['gold_fees'] ?? Request::old('gold_fees') }}">
        <small class="form-text text-muted">
            {{ __('backend/auctionshouse.form.gold-fees-help') }}
        </small>
        @if ($errors->has('gold_fees'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('gold_fees') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="col-12 pb-5">
    <hr class="mt-2 mb-3">
    <div class="d-flex flex-wrap float-right">
        <button class="btn btn-style-1 btn-primary float-right" type="submit">
            {{ __('backend/auctionshouse.form.save') }}
        </button>
    </div>
</div>
