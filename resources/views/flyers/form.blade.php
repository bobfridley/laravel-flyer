@inject('countries', 'App\Http\Utilities\Country')

<div class="row">
    <div class="col-md-6">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="street">Street:</label>
            <input type="text" id="street" name="street" class="form-control" placeholder="Street" value="{{ old('street') }}" required>
        </div>

        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" id="city" name="city" class="form-control" placeholder="City" value="{{ old('city') }}" required>
        </div>

        <div class="form-group">
            <label for="zip">Zip/Postal Code:</label>
            <input type="text" id="zip" name="zip" class="form-control" placeholder="Zip/Postal Code" value="{{ old('zip') }}" required>
        </div>

        <div class="form-group">
            <label for="country">Country:</label>
            <select id="country" name="country" class="form-control">
                @foreach ($countries::all() as $country => $code)
                    <option value="{{ $code }}">{{ $country }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="state">State:</label>
            <input type="text" id="state" name="state" class="form-control" placeholder="State" value="{{ old('state') }}" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="price">Sale Price:</label>
            <input type="text" id="price" name="price" class="form-control" placeholder="Sale Price" value="{{ old('price') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control" rows="10" placeholder="Description" required>{{ old('description') }}</textarea>
        </div>
    </div>

    <div class="col-md-12">
        <hr>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create Flyer</button>
        </div>
    </div>
</div>