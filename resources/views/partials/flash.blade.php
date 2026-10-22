@if (session('success'))
  <div data-alert class="fixed inset-x-0 top-24 z-50 mx-auto flex w-fit max-w-[92vw] items-center gap-2 rounded-full bg-primary px-5 py-3 text-sm font-medium text-primary-foreground shadow-lift">
    <x-icon name="check-circle" class="w-4 h-4 text-gold" />
    {{ session('success') }}
  </div>
@endif
@if (session('reset_success'))
  <div data-alert class="fixed inset-x-0 top-24 z-50 mx-auto flex w-fit max-w-[92vw] items-center gap-2 rounded-full bg-primary px-5 py-3 text-sm font-medium text-primary-foreground shadow-lift">
    <x-icon name="check-circle" class="w-4 h-4 text-gold" />
    Password berhasil diperbarui, silakan login kembali.
  </div>
@endif
@if (session('error'))
  <div data-alert class="fixed inset-x-0 top-24 z-50 mx-auto flex w-fit max-w-[92vw] items-start gap-2 rounded-2xl bg-destructive px-5 py-3 text-sm font-medium text-white shadow-lift">
    <x-icon name="alert-circle" class="mt-0.5 h-4 w-4 shrink-0" />
    <span>{{ session('error') }}</span>
  </div>
@endif