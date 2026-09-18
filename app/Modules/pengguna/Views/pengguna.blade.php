@extends('layouts.app')

@section('page-css')
@endsection

@section('main')

<div class="page-heading">

```
<div class="page-title mb-4">

    <div class="row align-items-end mb-2">

        <div class="col-12 col-md-6 order-md-1 order-last">

            <p class="kt-eyebrow mb-1">
                Data Management
            </p>

            <h3 class="mb-0">
                {{ $title }}
            </h3>

        </div>

        <div class="col-12 col-md-6 order-md-2 order-first">

            <nav
                aria-label="breadcrumb"
                class="breadcrumb-header float-start float-lg-end"
            >

                <ol class="breadcrumb">

                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                    <li
                        class="breadcrumb-item active"
                        aria-current="page"
                    >
                        {{ $title }}
                    </li>

                </ol>

            </nav>

        </div>

    </div>

</div>

<section class="section">

    <div class="card kt-table-card">

        <div class="card-body">

            <div class="row align-items-center mb-3 g-2">

                <div class="col-12 col-md-9">

                    <form
                        action="{{ route('pengguna.index') }}"
                        method="get"
                    >

                        <div class="form-group has-icon-left position-relative kt-search-input">

                            <input
                                type="text"
                                class="form-control rounded-pill"
                                value="{{ request()->get('search') }}"
                                name="search"
                                placeholder="Search"
                            >

                            <div class="form-control-icon">
                                <i class="fa fa-search"></i>
                            </div>

                        </div>

                    </form>

                </div>

                <div class="col-12 col-md-3 text-md-end">
                    {!! button('pengguna.create', $title) !!}
                </div>

            </div>

            @include('include.flash')

            <div class="table-responsive-md col-12">

                <table
                    class="table table-hover align-middle kt-table"
                    id="table1"
                >

                    <thead>

                        <tr>

                            <th width="15">
                                No
                            </th>

                            <td>
                                Pengguna
                            </td>

                            <td>
                                Email
                            </td>

                            <td>
                                Role
                            </td>

                            <th width="20%">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @php
                            $no = $data->firstItem();
                        @endphp

                        @forelse ($data as $item)

                            <tr>

                                <td>
                                    {{ $no++ }}
                                </td>

                                {{-- FOTO + USERNAME --}}
                                <td>

                                    <div
                                        style="
                                            display: flex;
                                            align-items: center;
                                            gap: 12px;
                                            min-width: 200px;
                                        "
                                    >

                                       @if ($item->talent && $item->talent->photo)

    <img
        src="{{ asset('storage/' . $item->talent->photo) }}"
        alt="Profil {{ $item->username }}"
        width="45"
        height="45"
        style="
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
        "
    >

@elseif ($item->profil)

    <img
        src="{{ asset('storage/profil/' . $item->profil) }}"
        alt="Profil {{ $item->username }}"
        width="45"
        height="45"
        style="
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
        "
    >

@else

    <div
        style="
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #f1f1f1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
        "
    >
        <i class="fa fa-user"></i>
    </div>

@endif

                                        <div>

                                            <div
                                                style="
                                                    font-weight: 600;
                                                    color: #25396f;
                                                    line-height: 1.4;
                                                "
                                            >
                                                {{ $item->username }}
                                            </div>

                                        </div>

                                    </div>

                                </td>

                                {{-- EMAIL --}}
                                <td>
                                    {{ $item->email }}
                                </td>

                                {{-- ROLE --}}
                                <td>
                                    {{ $item->role }}
                                </td>

                                {{-- AKSI --}}
                                <td>

                                    {!! button('pengguna.show', '', $item->id) !!}

                                    {!! button('pengguna.edit', $title, $item->id) !!}

                                    {!! button('pengguna.destroy', $title, $item->id) !!}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="text-center"
                                >
                                    <i>No data.</i>
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{ $data->links() }}

        </div>

    </div>

</section>
```

</div>
@endsection

@section('page-js')
@endsection

@section('inline-js')
@endsection