


<div class="container mt-5">
    <h3>Tambah FAQ Baru</h3>
    
    <form action="{{ route('admin.faq.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="question">Pertanyaan:</label>
            <input type="text" class="form-control" name="question" required value="{{ old('question') }}">
        </div>
        
        <div class="form-group">
            <label for="answer">Jawaban:</label>
            <textarea class="form-control" name="answer" rows="3" required>{{ old('answer') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan FAQ</button>
        <a href="{{ route('admin.faq.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    h3 {
        font-size: 1.875rem;
        font-weight: bold;
        color: #111827;
        margin-bottom: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        transition: all 0.15s ease-in-out;
    }

    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    /* Custom scrollbar for textarea */
    textarea.form-control::-webkit-scrollbar {
        width: 8px;
    }

    textarea.form-control::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    textarea.form-control::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 4px;
    }

    textarea.form-control::-webkit-scrollbar-thumb:hover {
        background: #a0aec0;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border-radius: 0.5rem;
        transition: all 0.15s ease-in-out;
        border: none;
        cursor: pointer;
        text-decoration: none;
        margin-right: 0.5rem;
    }

    .btn-primary {
        background-color: #3b82f6;
        color: white;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .btn-primary:hover {
        background-color: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 6px 8px -1px rgba(0, 0, 0, 0.15);
    }

    .btn-secondary {
        background-color: #f3f4f6;
        color: #374151;
    }

    .btn-secondary:hover {
        background-color: #e5e7eb;
        color: #374151;
        text-decoration: none;
    }

    form {
        background: white;
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }
</style>
