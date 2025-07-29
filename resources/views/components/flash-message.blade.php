<x-slot name="style">
    <style>
        .toast-message {
            position: fixed;
            top: 20px;
            right: 20px;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.5s ease-out;
            overflow: hidden;
            min-width: 250px;
        }

        .toast-message.hide {
            opacity: 0;
            pointer-events: none;
        }

        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 4px;
            background-color: rgba(255, 255, 255, 0.7);
            width: 100%;
            animation: toastProgress 3s linear forwards;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        @keyframes toastProgress {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }
    </style>
</x-slot>
<x-slot name="scriptHead">
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const toasts = document.getElementsByClassName('toast-message');
            if (toasts.length > 0) {
                Array.from(toasts).forEach(toast => {
                    setTimeout(() => {
                        toast.classList.add('hide');
                    }, 3000);
                });
            }
        });
    </script>
</x-slot>


@if(session('success'))
<div class="toast-message bg-success">
    <i class="fa fa-check-circle m-2"></i>{{ session('success') }}
    <div class="toast-progress"></div>
</div>
@endif
@if (session('warning'))
<div class="toast-message bg-danger">
    <i class="fa fa-exclamation-circle m-2"></i>{{ session('warning') }}
    <div class="toast-progress"></div>
</div>
@endif
@if (session('info'))
<div class="toast-message bg-info">
    <i class="fa fa-info-circle m-2"></i>{{ session('info') }}
    <div class="toast-progress"></div>
</div>
@endif
@if (session('error'))
<div class="toast-message bg-danger">
    <i class="fa fa-exclamation-circle m-2"></i>{{ session('error') }}
    <div class="toast-progress"></div>
</div>
@endif





