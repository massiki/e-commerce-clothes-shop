@extends('layouts.admin')

@section('content')
  <div class="main-content-inner">
    <div class="main-content-wrap">

      <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Contact</h3>
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
            <div class="text-tiny">Contact</div>
          </li>
        </ul>
      </div>

      <div class="wg-box">
        {{-- Success Alert --}}
        <x-alert-success status="success" />

        <div class="wg-table table-all-user mt-3">
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th class="text-center" style="width: 30px">#</th>
                  <th class="pb-1" style="width: 150px">Name</th>
                  <th style="width: 125px">Phone</th>
                  <th style="width: 250px">Email</th>
                  <th>Message</th>
                  <th style="width: 120px">Date</th>
                  <th style="width: 60px">Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($contacts as $contact)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="pb-1">{{ $contact->name }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->message }}</td>
                    <td>{{ $contact->created_at ? $contact->created_at->format('d M Y H:i') : '-' }}</td>
                    <td class="text-center">
                      <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-transparent border-0 p-0 m-0"
                          onclick="return confirm('Are you sure you want to delete this contact message?');">
                          <div class="item text-danger delete">
                            <i class="icon-trash-2"></i>
                          </div>
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7" class="text-center">No contact messages found.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
          {{ $contacts->links('pagination::bootstrap-5') }}
        </div>
      </div>
    </div>
  </div>
@endsection
