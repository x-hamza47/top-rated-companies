</body>

<script src = "https://code.jquery.com/jquery-3.6.0.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

document.querySelectorAll('.alert').forEach(function(alert) {
setTimeout(() => {
alert.classList.add('opacity-0', 'transition', 'duration-500');
setTimeout(() => alert.remove(), 1500);
}, 4000);
});

// Manual close
document.querySelectorAll('.close-alert').forEach(function(btn) {
btn.addEventListener('click', function() {
const alert = btn.closest('.alert');
alert.classList.add('opacity-0', 'transition', 'duration-500');
setTimeout(() => alert.remove(), 500);
});
});
</script>
<script src="{{ asset('dashboard-assets/js/script.js') }}"></script>
@stack('scripts')

</html>
