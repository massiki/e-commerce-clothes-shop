@extends('layouts.admin')

@section('content')
  <div class="main-content-inner">
    <div class="main-content-wrap">
      <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Slider</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
          <li>
            <a href="{{ route('admin.home') }}">
              <div class="text-tiny">Dashboard</div>
            </a>
          </li>
          <li>
            <i class="icon-chevron-right"></i>
          </li>
          <li>
            <div class="text-tiny">Slider</div>
          </li>
        </ul>
      </div>

      <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
          <div class="wg-filter flex-grow">
            <form class="form-search" method="GET" action="{{ route('admin.sliders.index') }}">
              <fieldset class="name">
                <input type="text" placeholder="Search here..." class="" name="search" tabindex="2"
                  value="{{ request('search') }}" aria-required="true">
              </fieldset>
              <div class="button-submit">
                <button class="" type="submit"><i class="icon-search"></i></button>
              </div>
            </form>
          </div>
          <a class="tf-button style-1 w208" href="{{ route('admin.sliders.create') }}"><i class="icon-plus"></i>Add
            new</a>
        </div>
        <x-alert-success status="success" />
        <div class="wg-table table-all-user">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 30px">#</th>
                <th>Image</th>
                <th>Tagline</th>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Link</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($sliders as $slider)
                <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td class="pname">
                    <div class="image">
                      <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider Image" class="image"
                        style="max-width: 120px; max-height: 60px;">
                    </div>
                  </td>
                  <td>{{ $slider->tagline ?? '-' }}</td>
                  <td>{{ $slider->title ?? '-' }}</td>
                  <td>{{ $slider->subtitle ?? '-' }}</td>
                  <td>
                    <div class="list-icon-function" style="display: flex; gap: 6px;">
                      <a href="{{ $slider->link }}" target="_blank">
                        <div class="item eye">
                          <i class="icon-eye"></i>
                        </div>
                      </a>
                    </div>
                  </td>
                  <td>
                    <div class="list-icon-function" style="display: flex; gap: 6px;">
                      <a href="{{ route('admin.sliders.edit', $slider) }}">
                        <div class="item edit">
                          <i class="icon-edit-3"></i>
                        </div>
                      </a>
                      <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this slider?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="item text-danger delete"
                          style="background:none; border:none; padding:0;">
                          <i class="icon-trash-2"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center">No sliders found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="divider"></div>
      </div>
    </div>
  </div>
@endsection
