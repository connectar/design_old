
<div>
@if(!$ticket->status == App\ENUMS\TicketEnum::STATUS_CLOSED)
<div style="margin-bottom:100px;background-color:#0e1e3a;padding:20px 15px;border-radius:10px;" class="custom-padding-mobile-for-from">
<form wire:submit='storeReply()' method="post">
  @csrf
    <label for="chat" class="sr-only">Your message</label>
    <div style="display:flex;align-items:center;">
        <textarea wire:model.prevent="message" id="chat" rows="2" class="border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600
          dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          style="display:block;width:100%;margin:5px 30px 5px 5px;padding:10px;border-radius:10px;background-color:#172b4c;color:white;"
          placeholder="{{__('new_trans.ticket.replies.message_placeholder')}}" ></textarea>
            <button wire:loading.attr="disabled" type="submit" style="display:inline-flex;justify-content:center;padding:15px;margin:20px;"
            class="text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
            <svg class="w-5 h-5 rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z"/>
            </svg>
            <span class="sr-only">Send message</span>
        </button>
      </form>
      @if($ticket->is_resolved == App\ENUMS\TicketEnum::IS_RESOLVED_FALSE)
      <button type="button"  class="btn btn-success py-3  rounded-circle" wire:loading.attr="disabled" wire:click="markAsSolved(1)">
        <i class="fa fa-check fa-lg"></i>
      </button>
      <span wire:loading class="px-3">
        <i class="fa fa-spinner fa-spin fa-lg"></i>
      </span>
      @else
      <button type="button"  class="btn btn-danger py-3  rounded-circle" wire:loading.attr="disabled" wire:click="markAsSolved(0)">
        <i class="fa fa-times fa-lg"></i>
      </button>
      <span wire:loading class="px-3">
        <i class="fa fa-spinner fa-spin fa-lg"></i>
      </span>
      @endif
    </div>
    <div class="px-4 ">
      @error('message')
      <span class="error text-danger">{{ $message }}</span>
      @enderror
    </div>
  </div>
  @endif
</div>

@push('styles')
<style>
.sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
}

.flex {
    display: flex;
}

.items-center {
    align-items: center;
}

.px-3 {
    padding-left: 0.75rem;
    padding-right: 0.75rem;
}

.py-2 {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
}

.rounded-lg {
    border-radius: 0.5rem;
}

.bg-gray-50 {
    background-color: #f9fafb;
}

.dark:bg-gray-700 {
    background-color: #4a4a4a;
}

.text-gray-500 {
    color: #6b7280;
}

.text-gray-900 {
    color: #111827;
}

.cursor-pointer {
    cursor: pointer;
}

.hover:text-gray-900:hover {
    color: #111827;
}

.hover:bg-gray-100:hover {
    background-color: #f3f4f6;
}

.dark:text-gray-400 {
    color: #cbd5e0;
}

.dark:hover:text-white:hover {
    color: #ffffff;
}

.dark:hover:bg-gray-600 {
    background-color: #374151;
}

.w-5 {
    width: 1.25rem;
}

.h-5 {
    height: 1.25rem;
}

.sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
}

.block {
    display: block;
}

.mx-4 {
    margin-left: 1rem;
    margin-right: 1rem;
}

.p-2.5 {
    padding: 1.625rem;
}

.w-full {
    width: 100%;
}

.border {
    border: 1px solid #e5e7eb;
}

.border-gray-300 {
    border-color: #d1d5db;
}

.focus\:ring-blue-500:focus {
    outline: 2px auto #2563eb;
    outline-offset: 2px;
}

.focus\:border-blue-500:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 2px #2563eb;
}

.dark:bg-gray-800 {
    background-color: #1f2937;
}

.dark:border-gray-600 {
    border-color: #374151;
}

.dark:placeholder-gray-400::placeholder {
    color: #9ca3af;
}

.dark:text-white {
    color: #ffffff;
}

.dark:focus\:ring-blue-500:focus {
    outline: 2px auto #2563eb;
    outline-offset: 2px;
}

.dark:focus\:border-blue-500:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 2px #2563eb;
}

.text-sm {
    font-size: 0.875rem;
}

.text-blue-600 {
    color: #3b82f6;
}

.rounded-full {
    border-radius: 9999px;
}

.rotate-90 {
    transform: rotate(90deg);
}

.form-container {
    max-width: 400px;
    margin: 0 auto;
}

/* Media Query for smaller screens */
@media (max-width: 768px) {
    .form-container {
        max-width: 100%;
    }
    .custom-padding-mobile-for-from
    {
      padding:4px!important;
    }
}
</style>
@endpush
@push('scripts')
<script>
function expandTextarea(textarea) {
    textarea.style.height = "auto";
    textarea.style.height = (textarea.scrollHeight) + "px";
}

function handleEnter(event) {
    if (event.key === "Enter" && !event.shiftKey) {
        event.preventDefault();
        const textarea = event.target;
        textarea.value += "\n";
        expandTextarea(textarea);
    }
}

</script>

@endpush
