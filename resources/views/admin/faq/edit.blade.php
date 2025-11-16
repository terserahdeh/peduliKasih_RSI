@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Edit FAQ: {{ $faq->question }}</h3>
    
    <form action="{{ route('admin.faqs.update', $faq->id_faq) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="question">Pertanyaan:</label>
            <input type="text" class="form-control" name="question" required 
                   value="{{ old('question', $faq->question) }}">
        </div>
        
        <div class="form-group">
            <label for="answer">Jawaban:</label>
            <textarea class="form-control" name="answer" rows="3" required>{{ old('answer', $faq->answer) }}</textarea>
        </div>

        <div class="form-group">
            <label for="is_active">Status Aktif:</label>
            <select class="form-control" name="is_active">
                <option value="1" {{ old('is_active', $faq->is_active) == 1 ? 'selected' : '' }}>Aktif (Tampil)</option>
                <option value="0" {{ old('is_active', $faq->is_active) == 0 ? 'selected' : '' }}>Nonaktif (Tidak Tampil)</option>
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Update FAQ</button>
        <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection