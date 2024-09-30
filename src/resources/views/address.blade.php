@extends('layouts.app')

@section('content')
<div class="container">
    <h1>配送先変更</h1>
    <form action="{{ route('address.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="post_code">郵便番号</label>
            <input type="text" name="post_code" id="post_code" class="form-control" value="{{ old('post_code', auth()->user()->post_code) }}" required>
        </div>

        <div class="form-group">
            <label for="address">住所</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', auth()->user()->address) }}" required>
        </div>

        <div class="form-group">
            <label for="building">建物名（第二住所）</label>
            <input type="text" name="building" id="building" class="form-control" value="{{ old('building', auth()->user()->building) }}">
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection