<div id="confirm-modal" class="fixed inset-0 z-[100] hidden">
  <div class="absolute inset-0 bg-black/40"></div>
  <div class="relative z-[101] max-w-md w-[90%] mx-auto mt-32 bg-white rounded-xl shadow-2xl border border-gray-200">
    <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-3">
      <div class="w-9 h-9 rounded-full bg-red-100 text-red-600 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zM9 7a1 1 0 012 0v4a1 1 0 11-2 0V7zm1 8a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" clip-rule="evenodd" /></svg>
      </div>
      <h3 class="text-base font-semibold text-gray-900" id="confirm-title">Konfirmasi</h3>
    </div>
    <div class="px-5 py-4">
      <p class="text-sm text-gray-700" id="confirm-message">Anda yakin?</p>
    </div>
    <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-end gap-2">
      <button type="button" id="confirm-cancel" class="px-4 py-2 rounded-lg border text-gray-700 hover:bg-gray-50">Batal</button>
      <button type="button" id="confirm-ok" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">Ya, Lanjut</button>
    </div>
  </div>
</div>
