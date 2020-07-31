@extends('Admin.layouts.app', ['activePage' => 'Search page', 'titlePage' => trans('admin.ac.search')])

@section('content')
    <div class="container-fluid mt-6 pt-8">
        <div class="col-md-12">
            <div class="card light bordered">
                <div class="card-header">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">Search</span>
                    </div>
                </div>
                <div class="card-body">
            There are {{ $allResult->count() }} results.

            @foreach($allResult->groupByType() as $type => $modelSearchResults)
                <h2>{{ $type }}</h2>
                @foreach($modelSearchResults as $searchResult)
                    <ul>
                        <a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a>
                    </ul>
                @endforeach
            @endforeach
                </div>
            </div>
        </div>
    </div>
    @endsection
