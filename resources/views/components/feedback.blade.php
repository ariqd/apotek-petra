<div class="row">
    <div class="col-12">
        @if(@session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-info-circle"></i> Success!</strong> {!! @session('info') !!}
        </div>
        @endif

        @if(@session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-exclamation-circle"></i> Warning!</strong> {{ @session('error') }}
        </div>
        @endif

        @if(count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-exclamation-circle"></i> Please correct your input data :</strong>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
