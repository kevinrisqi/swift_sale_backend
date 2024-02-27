@if (session('success'))
    <div class="alert alert-success alert-dismissible show fade" id="success-alert">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>x</span>
            </button>
            <p>{{ session('success') }}</p>
        </div>
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('success-alert').remove();
        }, 5000);
    </script>
@endif
