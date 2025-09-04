@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Category Details') }}
                    </h3>
                </div>

                <div class="card-actions">
                    <x-action.close route="{{ route('categories.index') }}" />
                </div>
            </div>
            <form action="{{ route('categories.update', $category->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                             <div class="card-body">
                                <h3 class="card-title">
                                    {{ __('Category Image') }}
                                </h3>

                                <img
                                    class="img-account-profile mb-2"
                                    src="{{ $category->image ? asset('storage/'.$category->image) : asset('assets/img/products/default.webp') }}"
                                    width="100"
                                    id="image-preview"
                                />

                                <div class="small font-italic text-muted mb-2">
                                    JPG or PNG no larger than 2 MB
                                </div>

                                <input
                                    type="file"
                                    accept="image/*"
                                    id="image"
                                    name="image"
                                    class="form-control @error('image') is-invalid @enderror"
                                    onchange="previewImage();"
                                >

                                @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <x-input
                                label="{{ __('Name') }}"
                                id="name"
                                name="name"
                                :value="old('name', $category->name)"
                                required
                            />

                            <x-input
                                label="{{ __('Slug') }}"
                                id="slug"
                                name="slug"
                                :value="old('slug', $category->slug)"
                                required
                            />
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="notes" class="form-label">
                                    {{ __('Description') }}
                                </label>

                                <textarea name="description"
                                            id="description"
                                            rows="5"
                                            class="form-control @error('description') is-invalid @enderror"
                                            placeholder="Category description..."
                                >{{ old('description', $category->description) }}</textarea>

                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer text-end">
                    <x-button type="submit">
                        {{ __('Update') }}
                    </x-button>

                    <x-button.back route="{{ route('categories.index') }}">
                        {{ __('Cancel') }}
                    </x-button.back>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@pushonce('page-scripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
<script>
    // Slug Generator
    const title = document.querySelector("#name");
    const slug = document.querySelector("#slug");
    title.addEventListener("keyup", function() {
        let preslug = title.value;
        preslug = preslug.replace(/ /g,"-");
        slug.value = preslug.toLowerCase();
    });
</script>
@endpushonce
