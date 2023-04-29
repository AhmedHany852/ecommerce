@if ($errors->any())
    <div class="alert alert-danger">
        <h3>Error Occured!</h3>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <x-form.input label="Store Name" class="form-control-lg" role="input" name="name" :value="$store->name" />
</div>
<div class="form-group">
    <x-form.input label="slug " class="form-control-lg" role="input" name="slug" :value="$store->slug" />
</div>
<div class="form-group">
    <label for="">Description</label>
    <x-form.textarea name="description" :value="$store->description" />
</div>
<div class="form-group">
    <x-form.label id="image">logo image</x-form.label>
    <x-form.input type="file" name="logo_image" accept="logo_image/*" />
    @if ($store->logo_image)
        <img src="{{ asset('storage/' . $store->image) }}" alt="" height="60">
    @endif
</div>
<div class="form-group">
    <x-form.label id="image">cover image </x-form.label>
    <x-form.input type="file" name="cover_image" accept="cover_image/*" />
    @if ($store->cover_image)
        <img src="{{ asset('storage/' . $store->image) }}" alt="" height="60">
    @endif
</div>
<div class="form-group">
    <label for="">Status</label>
    <div>
        <x-form.radio name="status" :checked="$store->status" :options="['active' => 'Active', 'archived' => 'Archived']" />
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>
