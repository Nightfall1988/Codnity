@extends('layouts.app')

@section('content')
<div id="list" style="display: flex; justify-content: center;">
    <article-table v-bind:articles="{{ json_encode($articles) }}"></article-table>
  </div>
  
@endsection
