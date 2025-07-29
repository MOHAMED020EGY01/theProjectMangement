@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif
@if (session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif





<script>
    // لما الصفحة تخلص تحميل
    document.addEventListener('DOMContentLoaded', function () {
        const flash = document.getElementsByClassName('alert');
        if (flash) {
            // بعد 3 ثواني (3000 ميلي ثانية) يخفي الرسالة
            setTimeout(() => {
                flash.style.transition = 'opacity 0.5s ease';
                flash.style.opacity = '0';

                // بعد ما يختفي تدريجيًا، نشيله من الـ DOM
                setTimeout(() => {
                    flash.remove();
                }, 500);
            }, 3000);
        }
    });
</script>
