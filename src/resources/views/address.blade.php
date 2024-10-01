@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/address.css') }}" />
@endsection

@section('content')
<div class="container">
    <h2>住所の変更</h2>
    <form action="{{ route('address.update', ['id' => $id]) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form__inner-text">
            <label for="post_code">郵便番号</label>
            <input type="text" name="post_code" id="post_code" class="form-control" value="{{ old('post_code', auth()->user()->post_code) }}" required>
        </div>

        <div class="form__inner-text">
            <label for="address">住所</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', auth()->user()->address) }}" required>
        </div>

        <div class="form__inner-text">
            <label for="building">建物名</label>
            <input type="text" name="building" id="building" class="form-control" value="{{ old('building', auth()->user()->building) }}">
        </div>

        <div class="form__button">
            <button type="submit">更新する</button>
          </div>
    </form>
</div>
@endsection