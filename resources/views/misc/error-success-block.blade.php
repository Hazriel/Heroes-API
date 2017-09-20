<div class="row">
@if ($errors->any())
    <div class="col-lg-12">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
</div>
<div class="row">
    @if(session()->has('success'))
        <div class="col-lg-12">
            <div class="alert alert-success">
                <p>{{ session()->get('success') }}</p>
            </div>
        </div>
    @endif
</div>
