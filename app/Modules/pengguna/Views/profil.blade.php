@extends('layouts.app')

@section('main')
<div class="page-heading">
    <div class="page-title mb-4">
        <div class="row">
            <div class="col-12 col-md-6">
                <p class="kt-eyebrow mb-1">Profile</p>
                <h3 class="mb-0">Profil Pengguna</h3>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card kt-form-card">
            <div class="card-header">
                <span>Informasi Profil</span>
            </div>

            <div class="card-body">
                @include('include.flash')

                <form action="{{ route('pengguna.profile.update') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text"
                               name="username"
                               class="form-control"
                               value="{{ old('username', $pengguna->username) }}"
                               required>
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email', $pengguna->email) }}"
                               required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bio</label>
                        <textarea name="bio"
                                  class="form-control"
                                  rows="4">{{ old('bio', $pengguna->bio) }}</textarea>
                        @error('bio')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Profil</label>

                        @if($pengguna->role === 'talent')
                            @if($pengguna->talent && $pengguna->talent->photo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $pengguna->talent->photo) }}"
                                         width="100"
                                         height="100"
                                         style="object-fit: cover; border-radius: 50%;">
                                </div>
                            @endif
                        @else
                            @if($pengguna->profil)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/profil/' . $pengguna->profil) }}"
                                         width="100"
                                         height="100"
                                         style="object-fit: cover; border-radius: 50%;">
                                </div>
                            @endif
                        @endif

                        <input type="file"
                               name="profil"
                               class="form-control"
                               accept="image/*">

                        @error('profil')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>

                </form>
            </div>
        </div>
    </section>
</div>
@endsection